<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InsumosPorProducto
 *
 * @author Jorge M. Izquierdo N
 */
class InsumosPorProductoDTO {
    //put your code here
    private $idProdcuto;
    private $idInsumo;
    private $cantidad;
    
    function getIdProdcuto() {
        return $this->idProdcuto;
    }

    function getIdInsumo() {
        return $this->idInsumo;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function setIdProdcuto($idProdcuto) {
        $this->idProdcuto = $idProdcuto;
    }

    function setIdInsumo($idInsumo) {
        $this->idInsumo = $idInsumo;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }


}
