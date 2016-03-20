<?php

require_once '../modelo/dto/UsuarioDTO.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../modelo/dto/ClienteDTO.php';
require_once '../modelo/dao/ClienteDAO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../facades/FacadeCliente.php';
require_once '../modelo/dto/ImagenesDTO.php';
require_once '../modelo/utilidades/GestionImagenes.php';

//  Registrar Cliente
if (isset($_POST['agregarCliente'])) {
    $idUsuario = 'DEFAULT';
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $estado = 'Activo';    
    $razonSocial = $_POST['nombreCompania'];
        $nit = $_POST['nit'];
        $sectorEmpresarial = $_POST['sectorEmp'];
        $sectorEconomico = $_POST['sectorEco'];
        $telefonoFijo = $_POST['telefonoFijo'];    
    $facadeCliente = new FacadeCliente;
    $area = $facadeCliente->obtenerAreaCliente();
    $fUsuario = new FacadeUsuarios();
    $result = $fUsuario->verificarUsuarioRegistrado($identificacion);
    $result2 = $facadeCliente->verificarClienteRegistrado($nit);
    if ($result !='' || $result2 !='') {
        $mensajeUsuario="Este Cliente Ya Existe";
          header("location: ../vista/agregarCliente?mensajeError=".$mensajeUsuario);
    
}else{
    

   //insertar Logo Corporativo
        if ($_FILES['uploadedfile']['name'] == '') {
            $foto ='perfil.png';
        } else {
            $foto = $_FILES['uploadedfile']['name'];
        }
        $carpeta = "fotos";
        $nombreImagen = $_FILES['uploadedfile']['name'];
        $tamano = $_FILES['uploadedfile']['size'];
        $tipo = $_FILES['uploadedfile']['type'];
        $nombreTemporal = $_FILES['uploadedfile']['tmp_name'];
        $dtoImagen = new ImagenesDTO($tamano, $tipo, $nombreImagen, $nombreTemporal, $carpeta);
       $cargaFoto = new GestionImagenes();
       $msg =$cargaFoto->subirImagen($dtoImagen); 
       //Insertar Tabla Personas
    $facadeUsuario = new FacadeUsuarios();
    $dto = new UsuarioDTO($idUsuario, $identificacion, $nombre, $apellido, $direccion, $telefono, $fecha, $email, $estado, $foto, $contrasena, $rol, $area);
    $mensajeUsuario = $facadeUsuario->registrarUsuario($dto);
    if($mensajeUsuario!='true'){
        header("location: ../vista/agregarCliente?mensajeError=".$mensajeUsuario);
    }else if($mensajeUsuario=='true') {
        $mensajeUsuario = 'Cliente Registrado Con Éxito';
        //  Insertar a tabla de Clientes
        $dtoCliente = new ClienteDTO($razonSocial, $nit, $sectorEmpresarial, $sectorEconomico, $facadeUsuario->consecutivoUsuario(), $telefonoFijo);
        $mensaje = $facadeCliente->insertarCliente($dtoCliente);
        header("location: ../vista/clientesActivos?mensaje=" . $mensaje . "&consecutivo=" . $facadeUsuario->consecutivoUsuario() . "&logo=" . $msg);
    }
}
}//  Modificar Cliente
else if (isset($_GET['modificarCliente'])) {
    $uDTO = new UsuarioDTO($_GET['idCliente'], $_GET['identificacion'], $_GET['nombre'], ($_GET['apellido']), $_GET['direccion'], $_GET['telefono'], $_GET['fechaNacimiento'], $_GET['email']);
    $facadeUsuario = new FacadeUsuarios();
    $mensaje = $facadeUsuario->actualizarUsuario($uDTO);
    //  Actualizar a tabla de Clientes     
    $dtoCliente = new ClienteDTO(ucwords($_GET['nombreCompania']), $_GET['nit'], $_GET['sectorEmp'], $_GET['sectorEco'], $_GET['idCliente'], $_GET['telefonoFijo']);
    $facadeCliente = new FacadeCliente;
    $mensaje2 = $facadeCliente->actualizarCliente($dtoCliente);
    header("Location: ../vista/clientesActivos?modificaCliente=" . $mensaje2);
}//  Desactivar Cliente
else if (isset($_GET['idDesactivarCliente'])) {
    $facadeUsuario = new FacadeUsuarios();
    $mensaje3 = $facadeUsuario->desactivarUsuario($_GET['idDesactivarCliente'], 'Inactivo');
    header("Location: ../vista/clientesInactivos?modificaCliente=" . $mensaje3);
}// Activar Cliente
else if (isset($_GET['idActivarCliente'])) {
    $facadeUsuario = new FacadeUsuarios();
    $mensaje3 = $facadeUsuario->activarUsuario($_GET['idActivarCliente'], 'Activo');
    header("Location: ../vista/clientesActivos?modificaCliente=" . $mensaje3);
}
//  Consultar Cliente
else if (isset($_GET['idConsultarCliente'])) {
    session_start();
    $facadeUsuario = new FacadeUsuarios;
    $_SESSION['dtoUsuario'] = $facadeUsuario->consultarRepresentante($_GET['idConsultarCliente']);
    $FacadeCliente = new FacadeCliente;
    $_SESSION['dtoCliente'] = $FacadeCliente->consultarCliente($_GET['idConsultarCliente']);
    if ($_SESSION['dtoUsuario']['estado'] == 'Activo') {
        header("Location: ../vista/clientesActivos?&#verUsuario");
    } else if ($_SESSION['dtoUsuario']['estado'] == 'Inactivo') {
        header("Location: ../vista/clientesInactivos?&#verUsuario");
    }
}
    