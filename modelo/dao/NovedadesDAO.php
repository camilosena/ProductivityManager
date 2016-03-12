<?php

class NovedadesDAO {

    public function crearNovedad(NovedadesDTO $objetoNov, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare("insert into novedades values(DEFAULT,?,?,?,?,now(),?,?,?,?)");
            $query->bindParam(1, $objetoNov->getIdUsuario());
            $query->bindParam(2, $objetoNov->getIdProyecto());
            $query->bindParam(3, $objetoNov->getCategoria());
            $query->bindParam(4, $objetoNov->getDescripcion());            
            $query->bindParam(5, $objetoNov->getArchivo());
            $query->bindParam(6, $objetoNov->getSolucion());
            $query->bindParam(7, $objetoNov->getFechaSolucion());
            $query->bindParam(8, $objetoNov->getEstadoSolucion());
            
            $query->execute();
            $mensaje = "Novedad Registrada";
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
            $query = $cnn->prepare("select *, nombreProyecto from novedades 
join proyectos on idProyecto = proyectos_idProyecto");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
}
public function consultarNovedad($idNovedad,PDO $cnn) {
        try {            
            $query = $cnn->prepare("select *, nombreProyecto from novedades,proyectos where idNovedad=? and Proyectos_idProyecto=idProyecto");
            $query->bindParam(1, $idNovedad);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
}
function consultarGerenteParaEnvarNovedadPorCorreo($idProyecto, PDO $cnn){
          try {            
            $query = $cnn->prepare("select idUsuario, email, concat(nombres,' ', apellidos) as nombre, rol from personas
join usuarioPorProyecto on idUsuario = usuarioAsignado
join proyectos on proyectoAsignado = idProyecto and idproyecto = ?
join usuarios on idLogin = identificacion
join roles on idRoles = rolesId and rol = 'Gerente' or rol = 'Administrador' ");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }  
    
}
function consultarAreaUsuarioEnSesion($idUsuario, PDO $cnn){
                      try {            
            $query = $cnn->prepare(" select areas_idAreas, nombreArea from personas 
join areas on idAreas = areas_idAreas and idUsuario =?");
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
}
function solucionarNovedad($solucion, $idNovedad, PDO $cnn){
        try {            
            $query = $cnn->prepare("update novedades set estadoSolucion= 'Solucionado', solucionNovedad= ?,fechaSolucionNovedad = current_date() where idNovedad =?");
            $query->bindParam(1, $solucion);
            $query->bindParam(2, $idNovedad);
            $query->execute();
            $mensaje = "Novedad Solucionada";
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
    
}
function estadoNovedad($idNovedad, PDO $cnn){
               try {            
            $query = $cnn->prepare(" select estadoSolucion from novedades where idNovedad =?");
            $query->bindParam(1, $idNovedad);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        } 
    
}
}
