<?php


/**
 * Description of ControllerForgetPassword
 *
 * @author Jorge M. Izquierdo N
 */

    require_once '../modelo/dao/ForgetPasswordDAO.php';  
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../facades/FacadeForgetPassword.php';
    require_once '../PHPmailer.php';
    require_once '../SMTP.php';
  
    
     if(isset($_POST['solicitarContrasena'])){  
         $forgetpassword= new ForgetPasswordDAO();
         $facadeForgetpassword = new FacadeForgetPassword(); 
         $mail = new PHPmailer();
         $validaInfo=$facadeForgetpassword->validateUser($_POST['user'], $_POST['email']);
         
        if($validaInfo!=null){
             if ($_POST['email']==$_POST['emailConfirm']) {
                 $passNew='prueba';
                 $facadeForgetpassword->updatePassword($passNew, $_POST['user']);                
                 $body = "El codigo de ingreso es: ".$passNew;
                  $mail->setFrom('jmizquierdo@misena.edu.co', 'Productiviti Manager');
                  $mail->addReplyTo('jmizquierdo@misena.edu.co', 'Productiviti Manager');
                  $address = $_POST['email'];
                  $mail->addAddress($address, $_POST['user']);
                  $mail->Subject = "¿Olvidó su contraseña?";
                  $mail->Body = "El codigo de ingreso es: ".$passNew;
                  $mail->AltBody = "El codigo de ingreso es: ".$passNew;                  
                    if(!$mail->Send()) {
                    $mensaje2= "Error al enviar el mensaje: " . $mail->ErrorInfo;
                    } else {
                        $mensaje="Se envio un codigo de ingreso al correo registrado"." ".$_POST['email'];
                    }
                             header("location: ../index.php?mensaje=".$mensaje." ".$mensaje2);
                }
                    else {
                         $mensaje="Los correos no coinciden";    
                         header("location: ../index.php?mensaje=".$mensaje.'#openModal');
                    }
         }
            else{
                $mensaje="Usuario o correo no registrado";    
            header("location: ../index.php?mensaje=".$mensaje.'#openModal');
         }
     }
