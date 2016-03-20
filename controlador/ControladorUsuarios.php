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
require_once '../facades/FacadeArchivo.php';
require_once '../modelo/dao/ArchivoDAO.php';
require_once '../modelo/dto/LoginDTO.php';
require_once '../facades/FacadeProyectos.php';
require_once '../modelo/dao/ProyectosDAO.php';

//  Registrar Usuarios
if (isset($_POST['crearUsuario'])) {
    $idUsuario='DEFAULT';
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
    $hoy = date('Y-m-d');
    $fecha_actual = new DateTime($hoy);
    $fecha_Nac = new DateTime($fecha);
    if ($fecha_actual <= $fecha_Nac) {
       header("location: ../vista/registrarUsuario?mensajeError=La Fecha de Nacimiento No Puede Ser Futura"); 
   }else{
    //Enviar correo de confirmacion
    $correoDTO = new CorreosDTO();    
    $correoDTO->setRemitente("productivitymanagersoftware@gmail.com");
    $correoDTO->setNombreRemitente("Productivity Manager");
    $correoDTO->setAsunto("Registro Productivity Manager");
    $correoDTO->setContrasena("adsi2015");
    $correoDTO->setDestinatario($email);
    $correoDTO->setContenido("Bienvenido Su usuario de ingreso es: ".$identificacion."<br>Su contraseña de ingreso es: ".$contrasena.'<br>'.'<br>'
        .'<font style="color: #83AF44; font-size: 11px; font-weight:bold; font-family: Sans-Serif;font-style:italic; " >Prductivity Manager Software'
        . '© Todos los derechos reservados 2015.'
        . '<br>'.'Bogotá, Colombia'
        . '<br>'.'Teléfono: +57 3015782659'
        . '<br>'.'https://www.facebook.com/productivitymanager'
        . '<br>'.'https://twitter.com/Productivity_Mg'
        . '</font>');
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
    if($mensaje2!='true'){
        header("location: ../vista/registrarUsuario?mensajeError=" . $mensaje2);
    }else if($mensaje2=='true'){
        $mensaje2='Usuario Registrado Con Éxito';
    //  Insertar tabla de usuarios login    
        $logeo = $facadeUsuario->insertarLogeo($dto);  
        $mensajeCorreo=$confirmacion;    
    //Consecutivo de Usuario
        $consecutivos = $facadeUsuario->consecutivoUsuario();
        header("location: ../vista/registrarUsuario?mensaje=" . $mensaje2 . "&consecutivo=" .$consecutivos."&foto=".$msg."&correo=".$mensajeCorreo);
    }
}
}
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
    header("Location: ../vista/listarUsuarios?modificado=" . $mensaje);
}//  Eliminar 
else if (isset($_GET['idEliminar'])) {
    $facadeUsuario = new FacadeUsuarios();
    $mensaje3 = $facadeUsuario->desactivarUsuario($_GET['idEliminar'], 'Inactivo');
    header("Location: ../vista/listarUsuarios?modificado=" . $mensaje3);
}//  Consultar
else if (isset($_GET['idConsultar'])) {
    $facadeUsuario = new FacadeUsuarios();
    session_start();  
    $_SESSION['datosUsuario'] = $facadeUsuario->consultarUsuario($_GET['idConsultar']);   
 header("Location: ../vista/listarUsuarios?#verUsuario");
}else if (isset($_GET['idConsultarInactivo'])) {
    $facadeUsuario = new FacadeUsuarios();
    session_start();  
    $_SESSION['datosUsuarioInactivo'] = $facadeUsuario->consultarUsuarioInactivo($_GET['idConsultarInactivo']);
 header("Location: ../vista/listarUsuariosInactivos?#verUsuario");
} 
//Activar Usuarios Inactivos Bloqueados
else if (isset($_GET['idActivar'])) {
    $facadeUsuario = new FacadeUsuarios();
    
    $datos = $facadeUsuario->consultarUsuarioInactivo($_GET['idActivar']);
    $email = $datos['email'];
    $identificacion = $datos['identificacion'];
    $correoDTO = new CorreosDTO();    
    $correoDTO->setRemitente("productivitymanagersoftware@gmail.com");
    $correoDTO->setNombreRemitente("Productivity Manager");
    $correoDTO->setAsunto("Registro Productivity Manager");
    $correoDTO->setContrasena("adsi2015");
    $correoDTO->setDestinatario($email);
    $correoDTO->setContenido("Ha sido reintegrado Su usuario de ingreso es: ".$identificacion.'<br>Puede acceder con su anterior contraseña, sino la recuerda solicite código de ingreso <br>'
        .'<font style="color: #83AF44; font-size: 11px; font-weight:bold; font-family: Sans-Serif;font-style:italic; " >Prductivity Manager Software'
                    . '© Todos los derechos reservados 2015.'
                    . '<br>'.'Bogotá, Colombia'
                    . '<br>'.'Teléfono: +57 3015782659'
                    . '<br>'.'https://www.facebook.com/productivitymanager'
                    . '<br>'.'https://twitter.com/Productivity_Mg'
    . '</font>');
    $facadeCorreo = new FacadeCorreos();
    $confirmacion=$facadeCorreo->EnvioCorreo($correoDTO);
    if ($confirmacion!='True') {
       $mensajeCorreo=$confirmacion;  
       $mensaje2="Error no se pudo realizar la activación";
       $consecutivos = 0;
       header("Location: ../vista/listarUsuarios?modificado=" . $mensaje2);
    } else {        
    //insertar imagen
        $mensaje3 = $facadeUsuario->activarUsuario($_GET['idActivar'], 'Activo');
    header("Location: ../vista/listarUsuarios?modificado=" . $mensaje3); 
    }
    
} // Ascender Usuarios
else  if (isset($_POST['ascender'])) {
     $facadeUsuario = new FacadeUsuarios();     
        $mensaje = $facadeUsuario->ascenderUsuario($_POST['selectRol'], $_POST['identificacion']);
        $mensaje2 = $facadeUsuario->actualizarArea($_POST['id'], $_POST['selectArea']);
    
    header("Location: ../vista/listarUsuarios?modificado=" . $mensaje.' y '.$mensaje2); 
  }
else if($_FILES['cambiaImagen']['name']!=''){
    if ($_FILES['cambiaImagen']['name'] == '') {
            $foto ='perfil.png';
        } else {
            $foto = $_FILES['cambiaImagen']['name'];
        }
        $carpeta = "fotos";
        $nombreImagen = $_FILES['cambiaImagen']['name'];
        $tamano = $_FILES['cambiaImagen']['size'];
        $tipo = $_FILES['cambiaImagen']['type'];
        $nombreTemporal = $_FILES['cambiaImagen']['tmp_name'];
        $dtoImagen = new ImagenesDTO($tamano, $tipo, $nombreImagen, $nombreTemporal, $carpeta);
       $cargaFoto = new GestionImagenes();
       $msg =$cargaFoto->subirImagen($dtoImagen);      
       if($msg =='True'){        
        session_start();                
         $facadeUsser = new FacadeUsuarios();
         $massage = $facadeUsser->actualizarFoto($foto,$_SESSION['id']);
         header("location: ../vista/listarProyectos?mensaje=".$massage);
       }else{
         header("location: ../vista/listarProyectos?mensajeFoto=".$msg);
       }
}else
if (isset ($_POST['subir'])) {
     $table = 'personas';
        $file = realpath($_FILES['archivo']['tmp_name']);
        $file = str_replace('\\', '/', $file);
        $facadeArchivo = new FacadeArchivo();
        $mensaje = $facadeArchivo->cargarArchivo($table, $file);
        
    $fUsuario = new FacadeUsuarios();
    $datos = $fUsuario->consultarUsuariosPorArchivo();
    $contrasena = "inicial";
    $rol = 0;
    
    $lDTO = new LoginDTO();
    foreach ($datos as $dato){
        $idLogin = $dato['identificacion'];
        $lDTO->setIdLogin($idLogin);
        $lDTO->setContrasena($contrasena);
        $lDTO->setRol($rol);
        $mensaje = $fUsuario->actualizarLogin($lDTO);  
    }
     header("Location: ../vista/listarUsuariosInactivos?mensale = ".$mensaje);
    
}else
if (isset ($_GET['idAsociados'])) {
    
    $FacadeProyectos = new FacadeProyectos();
    $facadeUsuario = new FacadeUsuarios();
    session_start();  
    $_SESSION['datosUsuario'] = $facadeUsuario->consultarUsuario($_GET['idAsociados']);  
    $_SESSION['datosProyectos'] = $FacadeProyectos->listarProyectoPorPersonal($_GET['idAsociados']);   
 header("Location: ../vista/listarUsuarios?#verProyectos");
}