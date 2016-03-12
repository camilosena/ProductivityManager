<?php


    require_once '../modelo/dao/ForgetPasswordDAO.php';
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../facades/FacadeForgetPassword.php';
    require_once '../PHPMailer/PHPMailerAutoload.php';
    require_once '../modelo/utilidades/EnvioCorreos.php';
    require_once '../modelo/dto/CorreosDTO.php';

  
    
     if(isset($_POST['solicitarContrasena'])){ 
     if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
         // echo '<h2>Please check the the captcha form.</h2>';
          $mensaje="Verifica el Captcha de seguridad";
                        header("location: ../index.php?error=".$mensaje.'#openModal');
          exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeJoxoTAAAAAPzwJZIMROIHNr5v8Kf00iaKnL-p&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>You are spammer ! Get the @$%K out</h2>';
          $mensaje="Selecciona el Captcha de seguridad";
                        header("location: ../index.php?error=".$mensaje.'#openModal');
        }else
        {
         // echo '<h2>Thanks for posting comment.</h2>';
        
         $forgetpassword= new ForgetPasswordDAO();
         $facadeForgetpassword = new FacadeForgetPassword(); 
         $mail = new PHPmailer();
         $dto = new CorreosDTO();
         $validaInfo=$facadeForgetpassword->validateUser($_POST['user'], $_POST['email']);
         
        if($validaInfo!=null){

            $dto->setRemitente('productivitymanagersoftware@gmail.com');
            $dto->setContrasena('adsi2015');
            $nombreRemitente = 'Productivity Manager';
            $dto->setDestinatario($_POST['email']);
            $dto->setAsunto('¿Olvidó su Contraseña?');

              if ($_POST['email']==$_POST['emailConfirm']) {
                 $passNew = $facadeForgetpassword->RamdomCode();

                 $body = "Su código de ingreso es: ".'<font color = "green" FACE="courier" size="12" >'.$passNew. '</font>';
                   $body.='<br>'.'<br>'.'<font style="color: red; font-size: 13px; font-weight:bold; font-family: Sans-Serif;" >!Por favor recuerde cambiar la contraseña¡</font>';
                    $body.='<br>'.'<br>'.'<font style="color: #83AF44; font-size: 11px; font-weight:bold; font-family: Sans-Serif;font-style:italic;">Prductivity Manager Software'
                    . '© Todos los derechos reservados 2015.'
                    . '<br>'.'Bogotá, Colombia'
                    . '<br>'.'Teléfono: +57 3015782659'
                    . '<br>'.'https://www.facebook.com/productivitymanager'
                    . '<br>'.'https://twitter.com/Productivity_Mg'
                    . '</font>';
                 $correo = new EnvioCorreos();
                 $dto->setContenido($body);


                 $confirmación=$correo->EnviarCorreo($dto, $nombreRemitente);
                 if ($confirmación=='True') {
                     $facadeForgetpassword->updatePassword($passNew, $_POST['user']);
                     $mensaje2='Información enviada a: '." ".$dto->getDestinatario();
                 }else{

                     $mensaje2=$confirmación;
                 }
                  header("location: ../index.php?mensaje=".$mensaje." ".$mensaje2);
                }
                    else {
                         $mensaje="Los correos no coinciden";
                        header("location: ../index.php?error=".$mensaje.'#openModal');
                    }
         }
            else{
                $mensaje="Usuario o correo no registrado";
            header("location: ../index.php?error=".$mensaje.'#openModal');
         }
        } 
     }
