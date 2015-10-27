<?php

class AuditoriaDAO {

    public function crearAuditoria (AuditoriaDTO $objetoAud, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare("insert into auditorias values(DEFAULT,?,?,now(),?,?)");
            $query->bindParam(1, $objetoAud->getIdProyecto());
            $query->bindParam(2, $objetoAud->getIdUsuario());
            $query->bindParam(3, $objetoAud->getDescripcion());            
            $query->bindParam(4, $objetoAud->getProducto());
            $query->execute();
            $mensaje = "Auditoria Generada";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }

    public function numeroAudoria(PDO $cnn) {
        try{
            $query=$cnn->prepare("SELECT max(idAuditoria) FROM auditorias");
            $query->execute();
            $id = $query->fetchColumn();
            return ('00'.($id+1));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;
    }
    public function listarAuditorias(PDO $cnn) {
        try {
            $query = $cnn->prepare("SELECT a.idAuditoria, p.estadoProyecto, concat(u.nombres,' ',u.apellidos) nombre, a.producto, p.nombreProyecto, a.fecha, a.observacionesAuditoria
                                    FROM  proyectos as p
                                    inner join auditorias as a
                                    inner join personas as u
                                    on p.idProyecto=a.proyectoAuditado
                                    and a.gerenteAuditoria=idUsuario");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
      }
}