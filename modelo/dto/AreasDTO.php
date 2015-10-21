<?php

class AreasDTO {
    private $idArea;
    private $NombreArea;
    private $idRol;
    
//    function __construct($idArea, $NombreArea, $idRol) {
//        $this->idArea = $idArea;
//        $this->NombreArea = $NombreArea;
//        $this->idRol = $idRol;
//    }
    function getIdArea() {
        return $this->idArea;
    }

    function getNombreArea() {
        return $this->NombreArea;
    }

    function getIdRol() {
        return $this->idRol;
    }

    function setIdArea($idArea) {
        $this->idArea = $idArea;
    }

    function setNombreArea($NombreArea) {
        $this->NombreArea = $NombreArea;
    }

    function setIdRol($idRol) {
        $this->idRol = $idRol;
    }


}
