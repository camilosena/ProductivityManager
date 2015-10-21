<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CrearRolDTO
 *
 * @author Jorge M. Izquierdo N
 */
class CrearRolDTO {
    private $IdRol;
    private $Rol;
    private $permiso;
  
   
  /* function __construct($IdRol, $Rol, $permiso) {
       $this->IdRol = $IdRol;
       $this->Rol = $Rol;
       $this->permiso = $permiso;
       
   }*/

      function getIdRol() {
       return $this->IdRol;
   }

   function setIdRol($IdRol) {
       $this->IdRol = $IdRol;
   }

      function getRol() {
       return $this->Rol;
   }

   function setRol($Rol) {
       $this->Rol = $Rol;
   }

   
   
   function getPermiso() {
       return $this->permiso;
   }

   function getEstado() {
       return $this->estado;
   }

   function setPermiso($permiso) {
       $this->permiso = $permiso;
   }

   function setEstado($estado) {
       $this->estado = $estado;
   }


   
   
}
