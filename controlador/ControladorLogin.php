<?php   

    require_once '../modelo/dao/LoginDAO.php';  
    require_once '../modelo/dao/PermisosDAO.php';
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../facades/FacadeLogin.php';
    require_once '../facades/FacadePermisos.php';
    
     if(isset($_POST['ingreso'])){        
         $facadeLogin = new FacadeLogin;        
         $validaInfo=$facadeLogin->validarUser($_POST['user'], $_POST['pass']);
            $var= count($validaInfo);
         if ($var>1) {
             session_start();
             $_SESSION['id']=$validaInfo['idLogin'];
             $_SESSION['rol']=$validaInfo['rol'];
             $facadePermmisos= new FacadePermisos;                       
             header("location: ../vista/listarProyectos.php?bienvenida=Bienvenido ".$_SESSION['rol']);
         }
         else{
             $mensaje="Usuario o contraseña incorrecta";
             header("location: ../index.php?error=".$mensaje);
         }                 
     }
     
      if(isset($_GET['idCerrar'])){ 
          session_start();
          unset($_SESSION['id']);
           unset($_SESSION['rol']);
           session_destroy();
           header("location: ../index.php");
      }