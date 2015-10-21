<?php

class ImagenesDTO {
    private $tamano;
    private $tipo;
    private $nombreImagen;
    private $nombreTemporal;
    private $carpeta;
    
    function __construct($tamano, $tipo, $nombreImagen, $nombreTemporal, $carpeta) {
        $this->tamano = $tamano;
        $this->tipo = $tipo;
        $this->nombreImagen = $nombreImagen;
        $this->nombreTemporal = $nombreTemporal;
        $this->carpeta = $carpeta;
    }
    
    function getTamano() {
        return $this->tamano;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getNombreImagen() {
        return $this->nombreImagen;
    }

    function getNombreTemporal() {
        return $this->nombreTemporal;
    }

    function getCarpeta() {
        return $this->carpeta;
    }

    function setTamano($tamano) {
        $this->tamano = $tamano;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setNombreImagen($nombreImagen) {
        $this->nombreImagen = $nombreImagen;
    }

    function setNombreTemporal($nombreTemporal) {
        $this->nombreTemporal = $nombreTemporal;
    }

    function setCarpeta($carpeta) {
        $this->carpeta = $carpeta;
    }



}
