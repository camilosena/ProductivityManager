<?php


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
