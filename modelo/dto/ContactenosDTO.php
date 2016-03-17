<?php

class ContactenosDTO {
    //put your code here
    
  private $idContacto;
  private $nombres;
  private $apellidos;
  private $empresa;
  private $email;
  private $idPais;
  private $telefono;
  private $modo;
  private $razon;
 
  function __construct($idContacto, $nombres, $apellidos, $empresa, $email, $idPais, $telefono, $modo, $razon) {
      $this->idContacto = $idContacto;
      $this->nombres = $nombres;
      $this->apellidos = $apellidos;
      $this->empresa = $empresa;
      $this->email = $email;
      $this->idPais = $idPais;
      $this->telefono = $telefono;
      $this->modo = $modo;
      $this->razon = $razon;
  }
  function getIdContacto() {
      return $this->idContacto;
  }

  function getNombres() {
      return $this->nombres;
  }

  function getApellidos() {
      return $this->apellidos;
  }

  function getEmpresa() {
      return $this->empresa;
  }

  function getEmail() {
      return $this->email;
  }

  function getIdPais() {
      return $this->idPais;
  }

  function getTelefono() {
      return $this->telefono;
  }

  function getModo() {
      return $this->modo;
  }

  function getRazon() {
      return $this->razon;
  }

  function setIdContacto($idContacto) {
      $this->idContacto = $idContacto;
  }

  function setNombres($nombres) {
      $this->nombres = $nombres;
  }

  function setApellidos($apellidos) {
      $this->apellidos = $apellidos;
  }

  function setEmpresa($empresa) {
      $this->empresa = $empresa;
  }

  function setEmail($email) {
      $this->email = $email;
  }

  function setIdPais($idPais) {
      $this->idPais = $idPais;
  }

  function setTelefono($telefono) {
      $this->telefono = $telefono;
  }

  function setModo($modo) {
      $this->modo = $modo;
  }

  function setRazon($razon) {
      $this->razon = $razon;
  }



}
