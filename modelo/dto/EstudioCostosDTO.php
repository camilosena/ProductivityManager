<?php

class EstudioCostosDTO {
    private $idProyectoSolicitado;
    private $costoManoDeObra;
    private $costoProduccion;
    private $costoProyecto;
    private $utilidad;
    private $tiempoEstimado;
    private $viabilidad;
    private $observaciones;

    /**
     * EstudioCostosDTO constructor.
     * @param $idProyectoSolicitado
     * @param $observaciones
     * @param $viabilidad
     * @param $tiempoEstimado
     * @param $utilidad
     * @param $costoProyecto
     * @param $costoProduccion
     * @param $costoManoDeObra
     */
    public function __construct($idProyectoSolicitado, $observaciones, $viabilidad, $tiempoEstimado, $utilidad, $costoProyecto, $costoProduccion, $costoManoDeObra)
    {
        $this->idProyectoSolicitado = $idProyectoSolicitado;
        $this->observaciones = $observaciones;
        $this->viabilidad = $viabilidad;
        $this->tiempoEstimado = $tiempoEstimado;
        $this->utilidad = $utilidad;
        $this->costoProyecto = $costoProyecto;
        $this->costoProduccion = $costoProduccion;
        $this->costoManoDeObra = $costoManoDeObra;
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
    public function getViabilidad()
    {
        return $this->viabilidad;
    }

    /**
     * @param mixed $viabilidad
     */
    public function setViabilidad($viabilidad)
    {
        $this->viabilidad = $viabilidad;
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

