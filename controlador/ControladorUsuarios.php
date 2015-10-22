<?php
require_once '../modelo/dto/UsuarioDTO.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../modelo/dao/LoginDAO.php';
require_once '../modelo/dto/CorreosDTO.php';
require_once '../modelo/dto/ImagenesDTO.php';
require_once '../modelo/utilidades/GestionImagenes.php';
require_once '../modelo/dto/CorreosDTO.php';
require_once '../modelo/utilidades/EnvioCorreos.php';
require_once '../PHPMailer/PHPMailerAutoload.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../facades/FacadeCorreos.php';
require_once '../facades/FacadeLogin.php';

//  Registrar Usuarios
if (isset($_POST['crearUsuario'])) {
    $idUsuario='';
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fechaNacimiento'];
    $email = $_POST['email'];       
    $estado = 'Activo';
    $rol=$_POST['selectRol'];
    $contrasena=$_POST['password'];
    $area=$_POST['selectArea'];
    //Enviar correo de confirmacion
    $correoDTO = new CorreosDTO();    
    $correoDTO->setRemitente("productivitymanagersoftware@gmail.com");
     $correoDTO->setNombreRemitente("Productivity Manager");
    $correoDTO->setAsunto("Registro Productivity Manager");
    $correoDTO->setContrasena("adsi2015");
    $correoDTO->setDestinatario($email);
    $correoDTO->setContenido("Bienvenido Su usuario de ingreso es: ".$identificacion."<br>Su contraseña de ingreso es: ".$contrasena);
    $facadeCorreo = new FacadeCorreos();
    $confirmacion=$facadeCorreo->EnvioCorreo($correoDTO);
    if ($confirmacion!='True') {
       $mensajeCorreo=$confirmacion;  
       $mensaje2="Error no se pudo realizar el registro";
       $consecutivos = 0;
    } else {        
    //insertar imagen
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
    $dto = new UsuarioDTO($idUsuario, $identificacion, $nombre, $apellido, $direccion, $telefono, $fecha, $email, $estado, $foto, $contrasena, $rol, $area);       
    $facadeUsuario = new FacadeUsuarios();
    //Insertar Tabla de personas
    $mensaje2 = $facadeUsuario->registrarUsuario($dto);
    //  Insertar tabla de usuarios login    
    $logeo = $facadeUsuario->insertarLogeo($dto);  
    $mensajeCorreo=$confirmacion;    
    //Consecutivo de Usuario
    $consecutivos = $facadeUsuario->consecutivoUsuario();
    }
    header("location: ../vista/registrarUsuario.php?mensaje=" . $mensaje2 . "&consecutivo=" .$consecutivos."&foto=".$msg."&correo=".$mensajeCorreo);
}//  Modificar
else if (isset($_POST['modificar'])) {
     $idUsuario=$_POST['id'];
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fechaNacimiento'];
    $email = $_POST['email'];       
    $uDTO = new UsuarioDTO($idUsuario, $identificacion, $nombre, $apellido, $direccion, $telefono, $fecha, $email, $estado, $foto, $contrasena, $rol, $area);    
    $facadeUsuario = new FacadeUsuarios();
    $mensaje = $facadeUsuario->actualizarUsuario($uDTO);   
    $facadeLogin = new FacadeLogin;
    $msg2 = $facadeLogin->modificarLogin($uDTO);
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
    session_start();  
    $_SESSION['datosUsuario'] = $facadeUsuario->consultarUsuario($_GET['idConsultar']);   
 header("Location: ../vista/listarUsuarios.php?#verUsuario");
} //Activar Usuarios Inactivos Bloqueados
else if (isset($_GET['idActivar'])) {
    $facadeUsuario = new FacadeUsuarios();
    $mensaje3 = $facadeUsuario->activarUsuario($_GET['idActivar'], 'Activo');
    echo $mensaje3;
    header("Location: ../vista/listarUsuarios.php?modificado=" . $mensaje3);
} // Ascender Usuarios
else  if (isset($_POST['ascender'])) {
     $facadeUsuario = new FacadeUsuarios();     
        $mensaje = $facadeUsuario->ascenderUsuario($_POST['selectRol'], $_POST['identificacion']);
        $mensaje2 = $facadeUsuario->actualizarArea($_POST['id'], $_POST['selectArea']);
    
    header("Location: ../vista/listarUsuarios.php?modificado=" . $mensaje.$mensaje2); 
  }
    