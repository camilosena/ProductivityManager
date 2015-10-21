<?php

class ClienteDTO {
    private $razonSocial;
    private $nit;
    private $sectorEmpresarial;
    private $sectorEconomico;   
    private $idUsuario;
    private $telefonoFijo;
    
    function __construct($razonSocial, $nit, $sectorEmpresarial, $sectorEconomico, $idUsuario, $telefonoFijo) {
        $this->razonSocial = $razonSocial;
        $this->nit = $nit;
        $this->sectorEmpresarial = $sectorEmpresarial;
        $this->sectorEconomico = $sectorEconomico;
        $this->idUsuario = $idUsuario;
        $this->telefonoFijo = $telefonoFijo;
    }

    function getRazonSocial() {
        return $this->razonSocial;
    }

    function getNit() {
        return $this->nit;
    }

    function getSectorEmpresarial() {
        return $this->sectorEmpresarial;
    }

    function getSectorEconomico() {
        return $this->sectorEconomico;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getTelefonoFijo() {
        return $this->telefonoFijo;
    }

    function setRazonSocial($razonSocial) {
        $this->razonSocial = $razonSocial;
    }

    function setNit($nit) {
        $this->nit = $nit;
    }

    function setSectorEmpresarial($sectorEmpresarial) {
        $this->sectorEmpresarial = $sectorEmpresarial;
    }

    function setSectorEconomico($sectorEconomico) {
        $this->sectorEconomico = $sectorEconomico;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setTelefonoFijo($telefonoFijo) {
        $this->telefonoFijo = $telefonoFijo;
    }


}
