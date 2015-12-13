<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactenosDTO
 *
 * @author Jorge M. Izquierdo N
 */
class ContactenosDTO {
    //put your code here
    
  private $idContacto;
  private $idPersona;
  private $empresa;
  private $modo;
  private $razon;
  private $idPais;
  function __construct($idContacto, $idPersona, $empresa, $modo, $razon, $idPais) {
      $this->idContacto = $idContacto;
      $this->idPersona = $idPersona;
      $this->empresa = $empresa;
      $this->modo = $modo;
      $this->razon = $razon;
      $this->idPais = $idPais;
  }
  function getIdContacto() {
      return $this->idContacto;
  }

  function getIdPersona() {
      return $this->idPersona;
  }

  function getEmpresa() {
      return $this->empresa;
  }

  function getModo() {
      return $this->modo;
  }

  function getRazon() {
      return $this->razon;
  }

  function getIdPais() {
      return $this->idPais;
  }

  function setIdContacto($idContacto) {
      $this->idContacto = $idContacto;
  }

  function setIdPersona($idPersona) {
      $this->idPersona = $idPersona;
  }

  function setEmpresa($empresa) {
      $this->empresa = $empresa;
  }

  function setModo($modo) {
      $this->modo = $modo;
  }

  function setRazon($razon) {
      $this->razon = $razon;
  }

  function setIdPais($idPais) {
      $this->idPais = $idPais;
  }


}
