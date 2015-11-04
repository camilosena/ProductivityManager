<?php

class AuditoriaDTO {

    private $idAuditoria;
    private $idUsuario;
    private $idProyecto;
    private $descripcion;   
    private $producto;

    /**
     * AuditoriaDTO constructor.
     * @param $idUsuario
     * @param $idProyecto
     * @param $descripcion
     * @param $producto
     */
    public function __construct($idUsuario, $idProyecto, $descripcion, $producto)
    {
        $this->idUsuario = $idUsuario;
        $this->idProyecto = $idProyecto;
        $this->descripcion = $descripcion;
        $this->producto = $producto;
    }


    function getProducto() {
        return $this->producto;
    }

    function setProducto($producto) {
        $this->producto = $producto;
    }

        public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdProyecto()
    {
        return $this->idProyecto;
    }

    public function setIdProyecto($idProyecto)
    {
        $this->idProyecto = $idProyecto;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getIdAuditoria()
    {
        return $this->idAuditoria;
    }

    /**
     * @param mixed $idAuditoria
     */
    public function setIdAuditoria($idAuditoria)
    {
        $this->idAuditoria = $idAuditoria;
    }


}