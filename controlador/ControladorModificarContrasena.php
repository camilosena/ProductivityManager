<?php   

    require_once '../modelo/dao/ModificarContrasenaDAO.php';  
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../facades/FacadeModificarContrasena.php';
  
    
     if(isset($_POST['modificarContrasena'])){  
         $modificarContrasena= new ModificarContrasenaDAO();
         $facadeModificarContrasena = new FacadeModificarContrasena();  
         session_start();
         $validaInfo=$facadeModificarContrasena->validarContrasena($_POST['passOld'], $_SESSION['id']);
         if($validaInfo!=null){
             if ($_POST['passNew']==$_POST['passConfirm']) {
                 
        $nueva=$_POST['passNew'];
           $facadeModificarContrasena->modificaContrasena($nueva, $_SESSION['id']);
           $mensaje="Contraseña Actualizada";
        header("location: ../vista/listarProyectos.php?mensaje=".$mensaje);
                }
                    else {
                         $mensaje="Las contraseñas no coinciden";    
                         header("location: ../vista/modificarContrasena.php?mensaje=".$mensaje);
                    }
         }
            else{
                $mensaje="La contraseña actual es incorrecta";    
            header("location: ../vista/modificarContrasena.php?mensaje=".$mensaje);
         }
                              
             
        
                    
     }
     
     