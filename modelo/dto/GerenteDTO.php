<?php

class GerenteDTO {
    
   private $perfil;
   private $idUsuario;
   
   function __construct($perfil, $idUsuario) {
       $this->perfil = $perfil;
       $this->idUsuario = $idUsuario;
   }

   function setPerfil($perfil) {
       $this->perfil = $perfil;
   }

   function setIdUsuario($idUsuario) {
       $this->idUsuario = $idUsuario;
   }

      
  function getPerfil() {
      return $this->perfil;
  }

  function getIdUsuario() {
      return $this->idUsuario;
  }

}
