<?php
require_once  'attach_mailer/AttachMailer.php'; 
class EnvioCorreos {
    public function EnviarCorreo(CorreosDTO $dto) {       

$mailer = new AttachMailer("carias520@misena.edu.co", "ariasgonzalezcamilo@gmail.com", "asunto", "hello contenido del mensaje");
$mailer->attachFile($dto->getArchivos());
$resultado = ($mailer->send() ? "True": "True");
return $resultado;
	}
}