<?php


class ProductosDTO {
    //put your code here
    private $idProducto;
    private $nombre;
    private $imagen;
    private $estado;
    private $descripción;
    Private $porcentaje;
    private $iva;
    
//    function __construct($idProducto, $nombre, $imagen, $descripción) {
//        $this->idProducto = $idProducto;
//        $this->nombre = $nombre;
//        $this->imagen = $imagen;
//        $this->descripción = $descripción;
//    }
    function getIdProducto() {
        return $this->idProducto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getDescripción() {
        return $this->descripción;
    }
    function getEstado() {
        return $this->estado;
    }

    function getPorcentaje() {
        return $this->porcentaje;
    }
    function getIva() {
        return $this->iva;
    }

    function setIva($iva) {
        $this->iva = $iva;
    }
    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setPorcentaje($porcentaje) {
        $this->porcentaje = $porcentaje;
    }

    
    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setDescripción($descripción) {
        $this->descripción = $descripción;
    }


    
}
