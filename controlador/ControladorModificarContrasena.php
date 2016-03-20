<?php   

    require_once '../modelo/dao/ModificarContrasenaDAO.php';  
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../facades/FacadeModificarContrasena.php';
  
    
     if(isset($_POST['modificarContrasena'])){  
       if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
         // echo '<h2>Please check the the captcha form.</h2>';
          $mensaje="Verifica el Captcha de seguridad";
                        header("location: ../vista/modificarContrasena?mensaje=".$mensaje);
          exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeJoxoTAAAAAPzwJZIMROIHNr5v8Kf00iaKnL-p&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>You are spammer ! Get the @$%K out</h2>';
          $mensaje="Selecciona el Captcha de seguridad";
                        header("location: ../vista/modificarContrasena?mensaje=".$mensaje);
        }else
        {
         $modificarContrasena= new ModificarContrasenaDAO();
         $facadeModificarContrasena = new FacadeModificarContrasena();  
         session_start();
         $validaInfo=$facadeModificarContrasena->validarContrasena($_POST['passOld'], $_SESSION['id']);
         if($validaInfo!=null){
             if ($_POST['passNew']==$_POST['passConfirm']) {
                 
        $nueva=$_POST['passNew'];
           $facadeModificarContrasena->modificaContrasena($nueva, $_SESSION['id']);
           $mensaje="Contraseña Actualizada";
        header("location: ../vista/listarProyectos?mensaje=".$mensaje);
                }
                    else {
                         $mensaje="Las contraseñas no coinciden";    
                         header("location: ../vista/modificarContrasena?mensaje=".$mensaje);
                    }
         }
            else{
                $mensaje="La contraseña actual es incorrecta";    
            header("location: ../vista/modificarContrasena?mensaje=".$mensaje);
         }
                              
             
      }  
                    
     }
     
     