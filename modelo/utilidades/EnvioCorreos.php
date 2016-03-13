<?php
require_once  'attach_mailer/AttachMailer.php'; 
class EnvioCorreos {
    public function EnviarCorreo(CorreosDTO $dto) {       

$mailer = new AttachMailer("Productivity-Manager@mail.com", $dto->getDestinatario(), $dto->getAsunto(), $dto->getContenido());

if($dto->getArchivos()==''){
	$dto->setArchivos('../img/logo.png');
}
$mailer->attachFile($dto->getArchivos());
$resultado = ($mailer->send() ? "True": "True");
return $resultado;
	}
}