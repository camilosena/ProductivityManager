<?php

class EstudioCostosDAO {
      public function generarEstudioCostos(EstudioCostosDTO $estudioDTO,PDO $cnn) {
        $mensaje="";
        try{
            $sentencia= $cnn->prepare("INSERT INTO estudiodecostos VALUES(DEFAULT,?,?,?,?,?,?,?,?,?)");
            $sentencia->bindParam(1, $estudioDTO->getIdProyectoSolicitado());
            $sentencia->bindParam(2, $estudioDTO->getIdGerenteCargo());
            $sentencia->bindParam(3, $estudioDTO->getCostoManoDeObra());
            $sentencia->bindParam(4, $estudioDTO->getCostoProduccion());
            $sentencia->bindParam(5, $estudioDTO->getCostoProyecto());
            $sentencia->bindParam(6, $estudioDTO->getUtilidad());
            $sentencia->bindParam(7, $estudioDTO->getTiempoEstimado());
            $sentencia->bindParam(8, $estudioDTO->getViabilidad());
            $sentencia->bindParam(9, $estudioDTO->getObservaciones());
            $sentencia->execute();
            $mensaje="Estudio de Costos Generado con Éxito";
            return $mensaje;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }

    public function costoManoDeObra($idProyecto,PDO $cnn) {
        try{
            $sentencia= $cnn->prepare("SELECT sum(totalPrecioProceso)from procesosporproyecto where idProyecto_proyectos=?");
            $sentencia->bindParam(1,$idProyecto);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }

    public function costoProduccion($idProyecto,PDO $cnn) {
        try{
            $sentencia= $cnn->prepare("SELECT sum(valorTotal)from materiaprimaporproyecto where proyectos_idProyecto=?");
            $sentencia->bindParam(1,$idProyecto);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }

    public function tiempoEstimado($idProyecto,PDO $cnn) {
        try{
            $sentencia= $cnn->prepare("SELECT sum(totalTiempoProceso) from procesosporproyecto where idProyecto_proyectos=?");
            $sentencia->bindParam(1,$idProyecto);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }

    public function empleadosSolicitados($idProyecto,PDO $cnn) {
        try{
            $sentencia= $cnn->prepare("SELECT sum(totalEmpleadosProceso) from procesosporproyecto where idProyecto_proyectos=?");
            $sentencia->bindParam(1,$idProyecto);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }
}
