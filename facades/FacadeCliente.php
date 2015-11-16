<?php

class FacadeCliente {
    private $conexionBase = null;
    private $clienteDAO = null;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->clienteDAO = new ClienteDAO;
    }

    public function insertarCliente(ClienteDTO $clienteDTO) {
        return $this->clienteDAO->insertarCliente($clienteDTO, $this->conexionBase);
    }

    public function consultarCliente($idCliente) {
        return $this->clienteDAO->obtenerCliente($idCliente, $this->conexionBase);
    }
    
    public function obtenerAreaCliente() {
    return $this->clienteDAO->obtenerAreaCliente($this->conexionBase);
    }

    public function actualizarCliente(ClienteDTO $clienteDTO) {
        return $this->clienteDAO->ModificarCliente($clienteDTO, $this->conexionBase);
    }

    public function totalClientes() {
        return $this->clienteDAO->cantidadClientes($this->conexionBase);
    }
    
    public function listadoClientesActivos(){
        return $this->clienteDAO->listarClientesActivos($this->conexionBase);
    }
    
    public function listadoClientesInactivos(){
        return $this->clienteDAO->listarClientesInactivos($this->conexionBase);
    }
    function verificarClienteRegistrado($nit)
    {

        return $this->clienteDAO->verificarClienteRegistrado($nit, $this->conexionBase);
    }
}
