<?php


class EnvioCorreos {

    public function EnviarCorreo(CorreosDTO $dto, $nombreRemitente) {
        $mail = new PHPMailer();        
        $mail->isSMTP();//Correo del remitente
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $dto->getRemitente();
        $mail->Password = $dto->getContrasena();
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;        
        $mail->setFrom($dto->getRemitente(), $nombreRemitente);//Correo del destinatario
        $mail->addAddress($dto->getDestinatario());
        $mail->addReplyTo($dto->getRemitente(), $nombreRemitente);
        $mail->addAttachment($dto->getArchivos()); //Adjuntar Archivos
        $mail->isHTML(true);        
        $mail->Subject = $dto->getAsunto();//Cuerpo del correo
        $mail->Body = $dto->getContenido();
        $dto.=$nombreRemitente.''
                . '';
        if (!$mail->send()) {
            $mensaje2 = 'No se pudo enviar el correo ' . 'Error: ' . $mail->ErrorInfo;
        } else {
            $mensaje2 = 'True';
        }
        return $mensaje2;
    }
}
