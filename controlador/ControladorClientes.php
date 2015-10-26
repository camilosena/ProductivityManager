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
    $idUsuario = '';
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $estado = 'Activo';        
    $facadeCliente = new FacadeCliente;
    $area = $facadeCliente->obtenerAreaCliente();
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
    //  Insertar a tabla de Clientes    
    $razonSocial = $_POST['nombreCompania'];
    $nit = $_POST['nit'];
    $sectorEmpresarial = $_POST['sectorEmp'];
    $sectorEconomico = $_POST['sectorEco'];
    $telefonoFijo = $_POST['telefonoFijo'];    
    $dtoCliente = new ClienteDTO($razonSocial, $nit, $sectorEmpresarial, $sectorEconomico, $facadeUsuario->consecutivoUsuario(), $telefonoFijo);    
    $mensaje = $facadeCliente->insertarCliente($dtoCliente);
    header("location: ../vista/clientesActivos.php?mensaje=" . $mensaje . "&consecutivo=" . $facadeUsuario->consecutivoUsuario(). "&logo=".$msg);
}//  Modificar Cliente
else if (isset($_GET['modificarCliente'])) {
    $uDTO = new UsuarioDTO($_GET['idCliente'], $_GET['identificacion'], $_GET['nombre'], ($_GET['apellido']), $_GET['direccion'], $_GET['telefono'], $_GET['fechaNacimiento'], $_GET['email']);
    $facadeUsuario = new FacadeUsuarios();
    $mensaje = $facadeUsuario->actualizarUsuario($uDTO);
    //  Actualizar a tabla de Clientes     
    $dtoCliente = new ClienteDTO(ucwords($_GET['nombreCompania']), $_GET['nit'], $_GET['sectorEmp'], $_GET['sectorEco'], $_GET['idCliente'], $_GET['telefonoFijo']);
    $facadeCliente = new FacadeCliente;
    $mensaje2 = $facadeCliente->actualizarCliente($dtoCliente);
    header("Location: ../vista/clientesActivos.php?modificaCliente=" . $mensaje2);
}//  Desactivar Cliente
else if (isset($_GET['idDesactivarCliente'])) {
    $facadeUsuario = new FacadeUsuarios();
    $mensaje3 = $facadeUsuario->desactivarUsuario($_GET['idDesactivarCliente'], 'Inactivo');
    header("Location: ../vista/clientesInactivos.php?modificaCliente=" . $mensaje3);
}// Activar Cliente
else if (isset($_GET['idActivarCliente'])) {
    $facadeUsuario = new FacadeUsuarios();
    $mensaje3 = $facadeUsuario->activarUsuario($_GET['idActivarCliente'], 'Activo');
    header("Location: ../vista/clientesActivos.php?modificaCliente=" . $mensaje3);
}
//  Consultar Cliente
else if (isset($_GET['idConsultarCliente'])) {
    $facadeUsuario = new FacadeUsuarios;
    $usuario = $facadeUsuario->consultarRepresentante($_GET['idConsultarCliente']);
    $FacadeCliente = new FacadeCliente;
    $cliente = $FacadeCliente->consultarCliente($_GET['idConsultarCliente']);
    if ($usuario['estado'] == 'Activo') {
        header("Location: ../vista/clientesActivos.php?usuario=" . $usuario['idUsuario'] . "&identificacion=" . $usuario['identificacion'] . "&nombre=" . $usuario['nombres'] .
                "&apellido=" . $usuario['apellidos'] . "&direccion=" . $usuario['direccion'] . "&telefono=" . $usuario['telefono'] .
                "&email=" . $usuario['email'] ."&foto=" . $usuario['foto']. "&empresa=" . $cliente['nombreCompania'] . "&nit=" . $cliente['nit'] . "&secEmp=" . $cliente['sectorEmpresarial'] . "&secEco=" . $cliente['sectorEconomico'] .
                "&pbx=" . $cliente['telefonoFijo'] . "&estado=" . $usuario['estado'] . "&#verUsuario");
    } else if ($usuario['estado'] == 'Inactivo') {
        header("Location: ../vista/clientesInactivos.php?usuario=" . $usuario['idUsuario'] . "&identificacion=" . $usuario['identificacion'] . "&nombre=" . $usuario['nombres'] .
                "&apellido=" . $usuario['apellidos'] . "&direccion=" . $usuario['direccion'] . "&telefono=" . $usuario['telefono'] .
                "&email=" . $usuario['email'] . "&foto=" . $usuario['foto']. "&empresa=" . $cliente['nombreCompania'] . "&nit=" . $cliente['nit'] . "&secEmp=" . $cliente['sectorEmpresarial'] . "&secEco=" . $cliente['sectorEconomico'] .
                "&pbx=" . $cliente['telefonoFijo'] . "&estado=" . $usuario['estado'] . "&#verUsuario");
    }
}
    