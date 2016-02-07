<?php

class FacadeReportes {
    //put your code here
    

    private $conexionBase;
    private $reportesDAO;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->reportesDAO = new ReportesDAO();
    }
    
    function ProyectoPorCliente($idCliente){
        return $this->reportesDAO->ProyectosPorCliente($idCliente, $this->conexionBase);
        
    }
    
    function ProductosPorCliente($idCliente){
        return $this->reportesDAO->ProductosPorCliente($idCliente, $this->conexionBase);
    }
    function reporteProyectoPorCliente($idCliente){
        return $this->reportesDAO->reporteProyectoPorCliente($idCliente, $this->conexionBase);
    }
    function reporteProyectoPorClienteProyecto($idCliente, $idProyecto){
     return $this->reportesDAO->reporteProyectoPorClienteProyecto($idCliente, $idProyecto, $this->conexionBase);
    }
    function reporteProyectoPorEstado($estado){
        return $this->reportesDAO->reporteProyectoPorEstado($estado, $this->conexionBase);
    }
    function reporteProyectoPorProyecto($idProyecto){
        return $this->reportesDAO->reporteProyectoPorProyecto($idProyecto, $this->conexionBase);
    }
    function reporteProyectoPorProducto($idProducto){
        return $this->reportesDAO->reporteProyectoPorProducto($idProducto, $this->conexionBase);
    }
    function reporteTodosProyectos(){
        return $this->reportesDAO->reporteTodosProyectos($this->conexionBase);
    }
}
