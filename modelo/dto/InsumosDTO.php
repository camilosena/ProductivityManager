<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InsumosDTO
 *
 * @author Jorge M. Izquierdo N
 */
class InsumosDTO {
    //put your code here
    
    private $id;
    private $nombre;
    private $medida;
    private $precio;
    
//    function __construct($id, $nombre, $medida, $precio) {
//        $this->id = $id;
//        $this->nombre = $nombre;
//        $this->medida = $medida;
//        $this->precio = $precio;
//    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getMedida() {
        return $this->medida;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setMedida($medida) {
        $this->medida = $medida;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }



}
