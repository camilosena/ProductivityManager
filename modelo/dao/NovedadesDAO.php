<?php

class NovedadesDAO {

    public function crearNovedad(NovedadesDTO $objetoNov, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare("insert into novedades values(DEFAULT,?,?,?,?,now(),?)");
            $query->bindParam(1, $objetoNov->getIdUsuario());
            $query->bindParam(2, $objetoNov->getIdProyecto());
            $query->bindParam(3, $objetoNov->getCategoria());
            $query->bindParam(4, $objetoNov->getDescripcion());            
            $query->bindParam(5, $objetoNov->getArchivo());
            $query->execute();
            $mensaje = "Novedad Generada";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }
    
    public function usuarioCreaNovedad($logueado, PDO $cnn) {
        try {
            $query = $cnn->prepare('SELECT idUsuario from usuarios, users where idLogin=? and identificacion = idLogin');
            $query->bindParam(1, $logueado);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
          $mensaje = $ex->getMessage();
        }
        $cnn = NULL;      
    }
    
    public function numeroNovedad(PDO $cnn) {
        try{
        $query=$cnn->prepare("SELECT max(idNovedad) FROM novedades");
        $query->execute();   
        $id = $query->fetchColumn();
        return ('00'.($id+1));
   } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn=NULL;        
    }
      public function listarNovedades(PDO $cnn) {
        try {            
            $query = $cnn->prepare("select n.idNovedad, p.nombreProyecto, n.categoria, n.descripcion, n.fecha
                                    from novedades as n
                                    inner join proyectos as p
                                    on n.Proyectos_idProyecto=p.idProyecto");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
}
public function consultarNovedad($idNovedad,PDO $cnn) {
        try {            
            $query = $cnn->prepare("select * from novedades,proyectos where idNovedad=? and Proyectos_idProyecto=idProyecto");
            $query->bindParam(1, $idNovedad);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
}
}
