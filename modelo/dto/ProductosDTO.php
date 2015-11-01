<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductosDTO
 *
 * @author Jorge M. Izquierdo N
 */
class ProductosDTO {
    //put your code here
    private $idProducto;
    private $nombre;
    private $imagen;
    private $estado;
    private $descripción;
    Private $porcentaje;
    
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
