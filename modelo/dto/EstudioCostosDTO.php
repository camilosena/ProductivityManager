<?php

class EstudioCostosDTO {
    private $idProyectoSolicitado;
    private $idGerenteCargo;
    private $costoManoDeObra;
    private $costoProduccion;
    private $costoProyecto;
    private $utilidad;
    private $tiempoEstimado;
    private $totalTrabajadores;
    private $observaciones;

    /**
     * EstudioCostosDTO constructor.
     * @param $idProyectoSolicitado
     * @param $idGerenteCargo
     * @param $costoManoDeObra
     * @param $costoProduccion
     * @param $costoProyecto
     * @param $utilidad
     * @param $tiempoEstimado
     * @param $totalTrabajadores
     * @param $observaciones
     */
    public function __construct($idProyectoSolicitado, $idGerenteCargo, $costoManoDeObra, $costoProduccion, $costoProyecto, $utilidad, $tiempoEstimado, $totalTrabajadores, $observaciones)
    {
        $this->idProyectoSolicitado = $idProyectoSolicitado;
        $this->idGerenteCargo = $idGerenteCargo;
        $this->costoManoDeObra = $costoManoDeObra;
        $this->costoProduccion = $costoProduccion;
        $this->costoProyecto = $costoProyecto;
        $this->utilidad = $utilidad;
        $this->tiempoEstimado = $tiempoEstimado;
        $this->totalTrabajadores = $totalTrabajadores;
        $this->observaciones = $observaciones;
    }

    /**
     * @return mixed
     */
    public function getIdProyectoSolicitado()
    {
        return $this->idProyectoSolicitado;
    }

    /**
     * @param mixed $idProyectoSolicitado
     */
    public function setIdProyectoSolicitado($idProyectoSolicitado)
    {
        $this->idProyectoSolicitado = $idProyectoSolicitado;
    }

    /**
     * @return mixed
     */
    public function getIdGerenteCargo()
    {
        return $this->idGerenteCargo;
    }

    /**
     * @param mixed $idGerenteCargo
     */
    public function setIdGerenteCargo($idGerenteCargo)
    {
        $this->idGerenteCargo = $idGerenteCargo;
    }

    /**
     * @return mixed
     */
    public function getCostoManoDeObra()
    {
        return $this->costoManoDeObra;
    }

    /**
     * @param mixed $costoManoDeObra
     */
    public function setCostoManoDeObra($costoManoDeObra)
    {
        $this->costoManoDeObra = $costoManoDeObra;
    }

    /**
     * @return mixed
     */
    public function getCostoProduccion()
    {
        return $this->costoProduccion;
    }

    /**
     * @param mixed $costoProduccion
     */
    public function setCostoProduccion($costoProduccion)
    {
        $this->costoProduccion = $costoProduccion;
    }

    /**
     * @return mixed
     */
    public function getCostoProyecto()
    {
        return $this->costoProyecto;
    }

    /**
     * @param mixed $costoProyecto
     */
    public function setCostoProyecto($costoProyecto)
    {
        $this->costoProyecto = $costoProyecto;
    }

    /**
     * @return mixed
     */
    public function getUtilidad()
    {
        return $this->utilidad;
    }

    /**
     * @param mixed $utilidad
     */
    public function setUtilidad($utilidad)
    {
        $this->utilidad = $utilidad;
    }

    /**
     * @return mixed
     */
    public function getTiempoEstimado()
    {
        return $this->tiempoEstimado;
    }

    /**
     * @param mixed $tiempoEstimado
     */
    public function setTiempoEstimado($tiempoEstimado)
    {
        $this->tiempoEstimado = $tiempoEstimado;
    }

    /**
     * @return mixed
     */
    public function getTotalTrabajadores()
    {
        return $this->totalTrabajadores;
    }

    /**
     * @param mixed $totalTrabajadores
     */
    public function setTotalTrabajadores($totalTrabajadores)
    {
        $this->totalTrabajadores = $totalTrabajadores;
    }

    /**
     * @return mixed
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param mixed $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }


}

