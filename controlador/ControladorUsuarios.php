<?php
require_once '../modelo/dto/UsuarioDTO.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../modelo/dto/EmpleadoDTO.php';
require_once '../modelo/dao/EmpleadoDAO.php';
require_once '../modelo/dto/GerenteDTO.php';
require_once '../modelo/dto/JefeDTO.php';
require_once '../modelo/dao/JefeDAO.php';
require_once '../modelo/dto/CorreosDTO.php';
require_once '../modelo/dto/ImagenesDTO.php';
require_once '../modelo/dao/GerenteDAO.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/utilidades/GestionImagenes.php';
require_once '../modelo/utilidades/EnvioCorreos.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../facades/FacadeGerente.php';
require_once '../facades/FacadeJefe.php';
require_once '../facades/FacadeEmpleado.php';

//  Registrar Usuarios
if (isset($_POST['crearUsuario'])) {
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fechaNacimiento'];
    $email = $_POST['email'];       
    $dto = new UsuarioDTO($idUsuario, $identificacion, $nombre, $apellido, $direccion, $telefono, $fecha, $email);    
    //insertar logo
        if ($_FILES['uploadedfile']['name'] == '') {
            $dto->setFoto('perfil.png');
        } else {
            $dto->setFoto($_FILES['uploadedfile']['name']);
        }
        $carpeta = "fotos";
        $nombreImagen = $_FILES['uploadedfile']['name'];
        $tamano = $_FILES['uploadedfile']['size'];
        $tipo = $_FILES['uploadedfile']['type'];
        $nombreTemporal = $_FILES['uploadedfile']['tmp_name'];
        $dtoImagen = new ImagenesDTO($tamano, $tipo, $nombreImagen, $nombreTemporal, $carpeta);
       $cargaFoto = new GestionImagenes();
       $mensajeFoto =$cargaFoto->subirImagen($dtoImagen);
    $dto->setEstado("Activo");
    $facadeUsuario = new FacadeUsuarios();
    $mensaje = $facadeUsuario->insertarUsuario($dto);
    //  Insertar tabla de users login
    $dto->setRol($_POST['tipoUsuario']);
    $dto->setContrasena($_POST['password']);
    $logeo = $facadeUsuario->insertarLogeo($dto);
    //  Insertar a tabla de  GerentesDeProyecto
    if ($dto->getRol() == 1) {
        $perfil = $_POST['perfil'];
        $dtoGerente = new GerenteDTO($perfil, $facadeUsuario->consecutivoUsuario());
        $facateGerente = new FacadeGerente;
        $mensaje2 = $facateGerente->insertarGerente($dtoGerente);
    } //  Insertar a tabla de  Jefes
        else if ($dto->getRol() == 2) {
        $areaJefe = $_POST['areaJefe'];
        $dtoJefe = new JefeDTO($areaJefe, $facadeUsuario->consecutivoUsuario());
        $facadeJefe = new FacadeJefe;
        $mensaje2 = $facadeJefe->insertarJefe($dtoJefe);
    } //  Insertar a tabla de  Empleados
        else if ($dto->getRol() == 3) {
        $cargoEmpleado = $_POST['cargoEmpleado'];
        $dtoEmpleado = new EmpleadoDTO($cargoEmpleado, $facadeUsuario->consecutivoUsuario());
        $facadeEmpleado = new FacadeEmpleado;
        $mensaje2 = $facadeEmpleado->insertarEmpleado($dtoEmpleado);
    }
header("location: ../vista/registrarUsuario.php?mensaje=" . $mensaje2 . "&consecutivo=" . $facadeUsuario->consecutivoUsuario()."&foto=".$msg);
}//  Modificar
else if (isset($_GET['modificar'])) {
    $uDTO = new UsuarioDTO($_GET['id'], $_GET['identificacion'], $_GET['nombre'], ($_GET['apellido']), $_GET['direccion'], $_GET['telefono'], $_GET['fechaNacimiento'], $_GET['email']);
    $facadeUsuario = new FacadeUsuarios();
    $mensaje = $facadeUsuario->actualizarUsuario($uDTO);
    $uDTO->setRol($_GET['tipoUser']);
    if ($uDTO->getRol() == 'Gerente') {
        $dtoGerente = new GerenteDTO;
        $FacadeGerente = new FacadeGerente;
        $dtoGerente->setPerfil($_GET['perfil']);
        $dtoGerente->setIdUsuario($_GET['id']);
        $mensaje = $FacadeGerente->actualizarGerente($dtoGerente);
    } else if ($uDTO->getRol() == 'Jefe') {
        $dtoJefe = new JefeDTO;
        $FacadeJefe = new FacadeJefe;
        $dtoJefe->setAreaJefe($_GET['areaJefe']);
        $dtoJefe->setIdUsuario($_GET['id']);
        $mensaje = $FacadeJefe->actualizarJefe($dtoJefe);
    } else if ($uDTO->getRol() == 'Empleado') {
        $dtoEmpleado = new EmpleadoDTO;
        $FacadeEmpleado = new FacadeEmpleado;
        $dtoEmpleado->setCargoEmpleado($_GET['cargoEmpleado']);
        $dtoEmpleado->setIdUsuario($_GET['id']);
        $mensaje = $FacadeEmpleado->actualizarEmpleado($dtoEmpleado);
    }
    header("Location: ../vista/listarUsuarios.php?modificado=" . $mensaje);
}//  Eliminar 
else if (isset($_GET['idEliminar'])) {
    $facadeUsuario = new FacadeUsuarios();
    $mensaje3 = $facadeUsuario->desactivarUsuario($_GET['idEliminar'], 'Inactivo');
    echo $mensaje3;
    header("Location: ../vista/listarUsuarios.php?mensaje3=" . $mensaje3);
}//  Consultar
else if (isset($_GET['idConsultar'])) {
    $facadeUsuario = new FacadeUsuarios();
    $usuario = $facadeUsuario->consultarUsuario($_GET['idConsultar']);
    header("Location: ../vista/listarUsuarios.php?usuario=" . $usuario['idUsuario'] . "&identificacion=" . $usuario['identificacion'] . "&nombre=" . $usuario['nombres'] .
            "&apellido=" . $usuario['apellidos'] . "&direccion=" . $usuario['direccion'] . "&telefono=" . $usuario['telefono'] . "&fecha=" . $usuario['fechaNacimiento'] .
            "&rol=" . $usuario['rol'] . "&email=" . $usuario['email'] . "&areaSector=" . $usuario['AreaSector'] . "&#verUsuario");
} //Activar Usuarios Inactivos Bloqueados
else if (isset($_GET['idActivar'])) {
    $facadeUsuario = new FacadeUsuarios();
    $mensaje3 = $facadeUsuario->activarUsuario($_GET['idActivar'], 'Activo');
    echo $mensaje3;
    header("Location: ../vista/listarUsuarios.php?modificado=" . $mensaje3);
} // Ascender Usuarios
else  if (isset($_GET['ascender'])) {
     $facadeUsuario = new FacadeUsuarios();
     $uDTO = new UsuarioDTO();
        $mensaje = $facadeUsuario->ascenderUsuario($_GET['selectRol'], $_GET['identificacion']);
    $uDTO->setRol($_GET['selectRol']);
    if ($uDTO->getRol() == 'Gerente') {
        $dtoGerente = new GerenteDTO;
        $FacadeGerente = new FacadeGerente;
        $dtoGerente->setPerfil($_GET['selectArea']);
        $dtoGerente->setIdUsuario($_GET['id']);
        $mensaje = $FacadeGerente->actualizarGerente($dtoGerente);
    } else if ($uDTO->getRol() == 'Jefe') {
        $dtoJefe = new JefeDTO;
        $FacadeJefe = new FacadeJefe;
        $dtoJefe->setAreaJefe($_GET['selectArea']);
        $dtoJefe->setIdUsuario($_GET['id']);
        $mensaje = $FacadeJefe->actualizarJefe($dtoJefe);
    } else if ($uDTO->getRol() == 'Empleado') {
        $dtoEmpleado = new EmpleadoDTO;
        $FacadeEmpleado = new FacadeEmpleado;
        $dtoEmpleado->setCargoEmpleado($_GET['selectArea']);
        $dtoEmpleado->setIdUsuario($_GET['id']);
        $mensaje = $FacadeEmpleado->actualizarEmpleado($dtoEmpleado);
    }
    header("Location: ../vista/listarUsuarios.php?modificado=" . $mensaje); 
    }
    