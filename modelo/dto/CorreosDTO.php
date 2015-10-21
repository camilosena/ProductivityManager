<?php

class CorreosDTO {    
    private $remitente;
    private $contrasena;
    private $destinatario;
    private $asunto;
    private $contenido;
    private $archivos;   
    private $nombreRemitente;
    
//    function __construct($remitente, $contrasena, $destinatario, $asunto, $contenido, $archivos) {
//        $this->remitente = $remitente;
//        $this->contrasena = $contrasena;
//        $this->destinatario = $destinatario;
//        $this->asunto = $asunto;
//        $this->contenido = $contenido;
//        $this->archivos = $archivos;
//    }

    function getRemitente() {
        return $this->remitente;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function getDestinatario() {
        return $this->destinatario;
    }

    function getAsunto() {
        return $this->asunto;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getArchivos() {
        return $this->archivos;
    }

    function getNombreRemitente() {
        return $this->nombreRemitente;
    }

    function setNombreRemitente($nombreRemitente) {
        $this->nombreRemitente = $nombreRemitente;
    }

    function setRemitente($remitente) {
    $this->remitente = $remitente;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }

    function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setArchivos($archivos) {
        $this->archivos = $archivos;
    }


   
}
    