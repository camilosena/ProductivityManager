<?php

class FacadeProyectos {

    private $conexionBase;
    private $proyectosDAO;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->proyectosDAO = new ProyectosDAO;
    }

    public function creacionProyectos(ProyectosDTO $proyectoDTO) {
        return $this->proyectosDAO->crearProyecto($proyectoDTO, $this->conexionBase);
    }

    public function numeroProyecto() {
        return $this->proyectosDAO->numeroProyecto($this->conexionBase);
    }

    public function proyectoSinEstudio() {
        return $this->proyectosDAO->proyectoSinEstudio($this->conexionBase);
    }

    public function proyectoEnEjecucion() {
        return $this->proyectosDAO->proyectoEnEjecucion($this->conexionBase);
    }

    public function listadoProyectos() {
        return $this->proyectosDAO->listarProyectos($this->conexionBase);
    }

    public function consultarProyecto($idProyecto) {
        return $this->proyectosDAO->obtenerProyecto($idProyecto, $this->conexionBase);
    }

    public function clienteDeProyecto($idProyecto) {
        return $this->proyectosDAO->obtenerClienteProyecto($idProyecto, $this->conexionBase);
    }

    public function actualizarProyecto(ProyectosDTO $proyectosDTO) {
        return $this->proyectosDAO->ModificarProyecto($proyectosDTO, $this->conexionBase);
    }

    public function gerenteDeProyecto($idProyecto) {
        return $this->proyectosDAO->obtenerGerenteEncargado($idProyecto, $this->conexionBase);
    }

    public function clienteAsignado($idProyecto) {
        return $this->proyectosDAO->obtenerClienteAsignado($idProyecto, $this->conexionBase);
    }

    public function cambiarEstadoProyecto($estado, $idProyecto) {
        return $this->proyectosDAO->cambiarEstadoProyecto($estado, $idProyecto, $this->conexionBase);
    }

    public function progresoProyectos() {
        return $this->proyectosDAO->progresoProyectos($this->conexionBase);
    }

    public function asignarUsuarioProyecto($idUsuario, $idProyecto) {
        return $this->proyectosDAO->asignarUsuarioProyecto($idUsuario, $idProyecto, $this->conexionBase);
    }

    public function insertarProductoProyecto($idProducto, $idProyecto, $cantidad) {
        return $this->proyectosDAO->insertarProductoProyecto($idProducto, $idProyecto, $cantidad, $this->conexionBase);
    }

    public function obtenerProductoProyecto($idProyecto) {
        return $this->proyectosDAO->obtenerProductoProyecto($idProyecto, $this->conexionBase);
    }

    public function insertarMateriaProyecto($idMateria, $idProyecto, $total, $provision) {
        return $this->proyectosDAO->insertarMateriaProyecto($idMateria, $idProyecto, $total, $provision, $this->conexionBase);
    }

    public function insertarProcesoProyecto($idProyecto, $idProceso, $totalTiempo, $totalPrecio, $totalEmp, $prov) {
        return $this->proyectosDAO->insertarProcesosProyecto($idProyecto, $idProceso, $totalTiempo, $totalPrecio, $totalEmp, $prov, $this->conexionBase);
    }
    public function obtenerDatoProductoProyecto($idProyecto) {
        return $this->proyectosDAO->obtenerDatoProductoProyecto($idProyecto,$this->conexionBase);
    }
    public function obtenerUtilidadProducto($idProducto) {
        return $this->proyectosDAO->obtenerUtilidadProducto($idProducto,$this->conexionBase);
    }

     public function cambiarFechaFinProyecto($fechaFin, $idProyecto) {
        return $this->proyectosDAO->cambiarFechaFinProyecto($fechaFin, $idProyecto, $this->conexionBase);
    }
    function listarProyectoPorPersonal($idUsuario){
        
        return $this->proyectosDAO->listarProyectoPorPersonal($idUsuario, $this->conexionBase);
    }
    function ejecucionProyecto($idProyecto, $porcentaje){
        
        return $this->proyectosDAO->ejecucionProyecto($idProyecto, $porcentaje, $this->conexionBase);
    }
    
}
