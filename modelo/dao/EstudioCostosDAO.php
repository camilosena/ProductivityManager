<?php

class EstudioCostosDAO {
      public function generarEstudioCostos(EstudioCostosDTO $estudioDTO,PDO $cnn) {
        $mensaje="";
        try{
            $sentencia= $cnn->prepare("INSERT INTO estudiodecostos VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?,?)");            
            $sentencia->bindParam(1, $estudioDTO->getIdProyectoSolicitado());
            $sentencia->bindParam(2, $estudioDTO->getIdGerenteCargo());
            $sentencia->bindParam(3, $estudioDTO->getMateriaPrima());
            $sentencia->bindParam(4, $estudioDTO->getManoObraDirecta());
            $sentencia->bindParam(5, $estudioDTO->getManoObraIndirecta());
            $sentencia->bindParam(6, $estudioDTO->getGastos());
            $sentencia->bindParam(7, $estudioDTO->getCosto());
            $sentencia->bindParam(8, $estudioDTO->getUtilidad());
            $sentencia->bindParam(9, $estudioDTO->getCantidadEmpleados());
            $sentencia->bindParam(10, $estudioDTO->getObservaciones());
            $sentencia->bindParam(11, $estudioDTO->getViabilidad());
            $sentencia->execute();
            $mensaje="Genero Estudio de Costos";
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
        return $mensaje;
    }
}
