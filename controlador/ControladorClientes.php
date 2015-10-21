<?php

require_once '../modelo/dto/UsuarioDTO.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../modelo/dto/ClienteDTO.php';
require_once '../modelo/dao/ClienteDAO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../facades/FacadeCliente.php';

//  Registrar Cliente
if (isset($_POST['agregarCliente'])) {
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $dto = new UsuarioDTO($idUsuario, $identificacion, $nombre, $apellido, $direccion, $telefono, $fecha, $email);
    //insertar logo
        if ($_FILES['uploadedfile']['name'] == '') {
            $dto->setFoto('logo.png');
        } else {
            $dto->setFoto($_FILES['uploadedfile']['name']);
        }
    $uploadedfileload = "true";
    $uploadedfile_size = $_FILES['uploadedfile']['size'];    
        if ($_FILES['uploadedfile']['size'] > 300000) {
            $msg = $msg . "El archivo es mayor a 300KB, debe reducirlo antes de subirlo<BR>";
            $uploadedfileload = "false";
            $dto->setFoto('logo.png');
        }

        if (!($_FILES['uploadedfile']['type'] == "image/jpeg" || $_FILES['uploadedfile']['type'] == "image/gif" || $_FILES['uploadedfile']['type'] == "image/png")) {
            $msg = $msg . " Tu archivo tiene que ser JPG / GIF / PNG. Otros archivos no son permitidos<BR>";
            $uploadedfileload = "false";
            $dto->setFoto('logo.png');
        }

        $file_name = $_FILES['uploadedfile']['name'];
        $add = "../fotos/$file_name";
        if ($uploadedfileload == "true") {
            if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $add)) {
                $msg= " Ha sido subido satisfactoriamente";
            } else {
                $msg= "Error al subir el archivo";
            }
    }else{ 
        $msg;        
    }
    $facadeUsuario = new FacadeUsuarios();
    $mensaje = $facadeUsuario->insertarUsuario($dto);
    //  Insertar a tabla de Clientes    
    $razonSocial = $_POST['nombreCompania'];
    $nit = $_POST['nit'];
    $sectorEmpresarial = $_POST['sectorEmp'];
    $sectorEconomico = $_POST['sectorEco'];
    $telefonoFijo = $_POST['telefonoFijo'];    
    $dtoCliente = new ClienteDTO($razonSocial, $nit, $sectorEmpresarial, $sectorEconomico, $facadeUsuario->consecutivoUsuario(), $telefonoFijo);
    $facadeCliente = new FacadeCliente;
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
    header("Location: ../vista/clientesInactivos.php?mensaje3=" . $mensaje3);
}// Activar Cliente
else if (isset($_GET['idActivarCliente'])) {
    $facadeUsuario = new FacadeUsuarios();
    $mensaje3 = $facadeUsuario->activarUsuario($_GET['idActivarCliente'], 'Activo');
    header("Location: ../vista/clientesActivos.php?mensaje3=" . $mensaje3);
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
    