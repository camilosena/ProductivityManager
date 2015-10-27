<?php

class GestionImagenes {

    public function subirImagen(ImagenesDTO $dto) {
        $uploadedfileload = "true";        
        if ($dto->getTamano() > 900000) {
            $msg = $msg . "El archivo es mayor a 900KB, debe reducirlo antes de subirlo<BR>";
            $uploadedfileload = "false";            
        }
        if (!($dto->getTipo() == "image/jpeg" || $dto->getTipo() == "image/gif" || $dto->getTipo() == "image/png")) {
            $msg = $msg . " Tu archivo tiene que ser JPG / GIF / PNG. Otros archivos no son permitidos<BR>";
            $uploadedfileload = "false";
        }
        $file_name = $dto->getNombreImagen();
        $add = "../".$dto->getCarpeta()."/$file_name";
        if ($uploadedfileload == "true") {
            if (move_uploaded_file($dto->getNombreTemporal(), $add)) {
              return  $msg = "True";
            } else {
              return  $msg = "Error al subir el archivo";
            }
        } else {
             return $msg;
        }
    }
}
