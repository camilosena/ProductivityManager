<?php

class FacadeFiltros {
  private $conexionBase = null;
    private $filtroDao = null;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->filtroDao = new FiltrosDAO;
    }

    public function filtrarUsuarios(UsuarioDTO $usuarioDTO) {
        return $this->filtroDao->busqueda($usuarioDTO, $this->conexionBase);
    }
    
     public function filtrarProyectos(ProyectosDTO $proyectoDTO) {
        return $this->filtroDao->busquedaProyectos($proyectoDTO, $this->conexionBase);
    }
    
    public function filtrarClientesActivos(ClienteDTO $clienteDTO) {
        return $this->filtroDao->busquedaClientesActivos($clienteDTO, $this->conexionBase);
    }
    
    public function filtrarClientesInactivos(ClienteDTO $clienteDTO) {
        return $this->filtroDao->busquedaClientesInactivos($clienteDTO, $this->conexionBase);
    }
}
