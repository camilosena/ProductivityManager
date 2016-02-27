<?php


class FacadeInsumos {

    //put your code here
    private $conexionBase = null;
    private $insumoDAO = null;

    function __construct() {
        $this->conexionBase = Conexion::getConexion();
        $this->insumoDAO = new InsumosDAO();
    }

    function agregarInsumo(InsumosDTO $Idto) {

        return $this->insumoDAO->agregarInsumo($Idto, $this->conexionBase);
    }

    function listarInsumos() {

        return $this->insumoDAO->listarInsumos($this->conexionBase);
    }

    function consecutivoInsumos() {

        return $this->insumoDAO->consecutivoInsumos($this->conexionBase);
    }

    function eliminarInsumos($idEliminar) {

        return $this->insumoDAO->eliminarInsumo($idEliminar, $this->conexionBase);
    }

    function consultarAsignacion() {

        return $this->insumoDAO->consultarAsignación($this->conexionBase);
    }

    function obtenerInsumos($idProducto) {

        return $this->insumoDAO->obtenerInsumos($idProducto, $this->conexionBase);
    }

    function obtenerInsumosPorID($idMateriaPrima) {

        return $this->insumoDAO->obtenerInsumoPorID($idMateriaPrima, $this->conexionBase);
    }


    function consultarMateriaPrima($idMateriaPrima) {

        return $this->insumoDAO->consultarrMateriaPrima($idMateriaPrima, $this->conexionBase);
    }

        function modificarMateriaPrima(InsumosDTO $Idto) {

        return $this->insumoDAO->modificarMateriaPrima($Idto, $this->conexionBase);
    }

        function relacionMateriaPrimaProyecto($idProyecto) {

        return $this->insumoDAO->relacionMateriaPrimaProyecto($idProyecto, $this->conexionBase);
    }
}
