<?php

class AuditoriaDAO {

    function crearAuditoria (AuditoriaDTO $objetoAud, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare("insert into auditorias values(DEFAULT,?,?,now(),?,?,?,?,?,?,?,?,?,?)");
            $query->bindParam(1, $objetoAud->getIdProyecto());
            $query->bindParam(2, $objetoAud->getIdUsuario());
            $query->bindParam(3, $objetoAud->getDescripcion());            
            $query->bindParam(4, $objetoAud->getProducto());
            $query->bindParam(5, $objetoAud->getArchivoAuditoria());
            $query->bindParam(6, $objetoAud->getEjecucion());
            $query->bindParam(7, $objetoAud->getPresupuesto());
            $query->bindParam(8, $objetoAud->getInsumos());
            $query->bindParam(9, $objetoAud->getCalidad());
            $query->bindParam(10, $objetoAud->getProcesos());
            $query->bindParam(11, $objetoAud->getEmpleados());
            $query->bindParam(12, $objetoAud->getResultado());
            $query->execute();
            $mensaje = "Resultado de la auditoria: ".$objetoAud->getProducto()."% ".$objetoAud->getResultado();
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
            $query = $cnn->prepare("SELECT *, concat(nombres, ' ', apellidos) as nombre, nombreProyecto FROM auditorias
join personas on idUsuario = gerenteAuditoria 
join proyectos on proyectoAuditado  = idProyecto");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
      }

    public function consultarAuditoria($idAuditoria,PDO $cnn) {
        try {
            $query = $cnn->prepare("SELECT a.idAuditoria, p.estadoProyecto, concat(u.nombres,' ',u.apellidos) nombre, a.producto, p.nombreProyecto, a.fecha, a.observacionesAuditoria, a.producto, a.archivoAuditoria
                                    FROM  proyectos as p
                                    inner join auditorias as a
                                    inner join personas as u
                                    on p.idProyecto=a.proyectoAuditado
                                    and a.gerenteAuditoria=idUsuario
                                    where idAuditoria=?");
            $query->bindParam(1, $idAuditoria);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }
    function cantidadAuditoriasPorProyecto ($idProyecto, PDO $cnn){
        try {
            $query = $cnn->prepare("select count(idAuditoria) as numero from auditorias where proyectoAuditado =?");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        
    }
    function consultarGerenteParaEnvarAuditoriaPorCorreo($idProyecto, PDO $cnn){
          try {            
            $query = $cnn->prepare("select idUsuario, email, concat(nombres,' ', apellidos) as nombre, rol from personas
join usuarioporproyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto and idproyecto = ?
join usuarios on idLogin = identificacion
join roles on idRoles = rolesId and rol = 'Gerente'");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }  
    
}
  function cantidadAuditoriasMeses($mes, PDO $cnn){
          try {            
            $query = $cnn->prepare("select count(idAuditoria) from auditorias");
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }  
    
    }

      function cantidadAuditoriasPorEstado($resultado, PDO $cnn){
          try {            
            $query = $cnn->prepare("select count(idAuditoria) from auditorias where resultadoAuditoria =? ");
            $query->bindParam(1, $resultado);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }  
    
    }
}