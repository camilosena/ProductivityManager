<?php

class ProyectosDAO {

    public function crearProyecto(ProyectosDTO $proyectoDTO, PDO $cnn) {
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("INSERT INTO proyectos VALUES(?,?,?,?,?,0,?)");
            $sentencia->bindParam(1, $proyectoDTO->getIdProyecto());
            $sentencia->bindParam(2, $proyectoDTO->getNombreProyecto());
            $sentencia->bindParam(3, $proyectoDTO->getFechaInicio());
            $sentencia->bindParam(4, $proyectoDTO->getFechaFin());
            $sentencia->bindParam(5, $proyectoDTO->getEstado());
            $sentencia->bindParam(6, $proyectoDTO->getObservaciones());
            $sentencia->execute();
            $mensaje = "Proyecto Creado con Éxito";
            return $mensaje;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }

    public function numeroProyecto(PDO $cnn) {
        try {
            $query = $cnn->prepare("SELECT max(idProyecto) FROM proyectos");
            $query->execute();
            $id = $query->fetchColumn();
            return ('0' . ($id + 1));
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }

    public function proyectoSinEstudio(PDO $cnn) {
        try {
            $query = $cnn->prepare("SELECT idProyecto, nombreProyecto from proyectos where estado='Sin Estudio Costos'");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }

    public function proyectoEnEjecucion(PDO $cnn) {
        try {
            $query = $cnn->prepare('SELECT idProyecto, nombreProyecto from proyectos where estadoProyecto="Ejecución"');
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }

    public function listarProyectos(PDO $cnn) {
        try {
            $query = $cnn->prepare("Select * from proyectos");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
    }

    public function obtenerProyecto($idProyecto, PDO $cnn) {
        try {
            $query = $cnn->prepare("Select * from proyectos where idProyecto=?");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    public function obtenerClienteProyecto($idProyecto, PDO $cnn) {
        try {
            $query = $cnn->prepare("SELECT idCliente,nombreCompania from clientes,personas,usuarioPorProyecto where  idCliente=idUsuario and idUsuario=usuarioAsignado and proyectoAsignado=?");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    public function ModificarProyecto(ProyectosDTO $proyectoDTO, PDO $cnn) {
        $mensaje = "";
        try {
            $query = $cnn->prepare("UPDATE  proyectos SET nombreProyecto=?, fechaInicio=?, observaciones=? where idProyecto=?");
            $query->bindParam(1, $proyectoDTO->getNombreProyecto());
            $query->bindParam(2, $proyectoDTO->getFechaInicio());
            $query->bindParam(3, $proyectoDTO->getObservaciones());
            $query->bindParam(4, $proyectoDTO->getIdProyecto());
            $query->execute();
            $mensaje = "Proyecto Actualizado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = null;
        return $mensaje;
    }

    public function obtenerGerenteEncargado($idProyecto, PDO $cnn) {
        try {
            $query = $cnn->prepare("Select idUsuario,identificacion, concat(nombres,' ',apellidos) nombre,direccion,telefono,fechaNacimiento,email,rol, nombreArea
from usuarios, personas, roles, usuarioPorProyecto,areas
 where idUsuario=usuarioAsignado and proyectoAsignado=? and identificacion=idLogin and 
 rolesId=idRoles and idAreas=areas_idAreas and rol!='Empleado'");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    public function obtenerClienteAsignado($idProyecto, PDO $cnn) {
        try {
            $query = $cnn->prepare("Select idCliente,nit, nombreCompania,sectorEmpresarial, sectorEconomico, telefonoFijo,
idUsuario,identificacion, concat(nombres,' ',apellidos) nombre,direccion,telefono,email,foto
from clientes, personas, usuarioPorProyecto
where idUsuario=idCliente and idUsuario=usuarioAsignado and proyectoAsignado=?");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetch();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    function cambiarEstadoProyecto($estado, $idProyecto, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare("UPDATE  proyectos SET estadoProyecto=? where idProyecto=?");
            $query->bindParam(1, $estado);
            $query->bindParam(2, $idProyecto);
            $query->execute();
            $mensaje = 'Cambio Estado de Proyecto';
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    public function progresoProyectos(PDO $cnn) {
        try {
            $query = $cnn->prepare("call ProgresoProyectos()");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    public function asignarUsuarioProyecto($idUsuario, $idProyecto, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare("call asignarUsuarioProyecto(?,?)");
            $query->bindParam(1, $idUsuario);
            $query->bindParam(2, $idProyecto);
            $query->execute();
            $mensaje = ' Asignado a Proyecto: ' . $idProyecto;
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }

    public function insertarProductoProyecto($idProducto, $idProyecto, $cantidad, PDO $cnn) {
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("INSERT INTO productoPorProyecto VALUES(?,?,?)");
            $sentencia->bindParam(1, $idProducto);
            $sentencia->bindParam(2, $idProyecto);
            $sentencia->bindParam(3, $cantidad);
            $sentencia->execute();
            $mensaje = "Productos Asociados con Éxito";
            return $mensaje;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }

    public function obtenerProductoProyecto($idProyecto, PDO $cnn) {
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("SELECT * FROM productoPorProyecto where proyectosIdProyecto=?");
            $sentencia->bindParam(1, $idProyecto);
            $sentencia->execute();
            return $sentencia->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }

    public function insertarMateriaProyecto($idMateria, $idProyecto, $total, $provision, PDO $cnn) {
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("INSERT INTO materiaPrimaPorProyecto VALUES(?,?,?,?)");
            $sentencia->bindParam(1, $idMateria);
            $sentencia->bindParam(2, $idProyecto);
            $sentencia->bindParam(3, $total);
            $sentencia->bindParam(4, $provision);
            $sentencia->execute();
            $mensaje = "Materia Prima Asociada con Exito";
            return $mensaje;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }

    public function insertarProcesosProyecto($idProyecto, $idProceso, $totalTiempo, $totalPrecio, $totalEmp, $prov, PDO $cnn) {
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("INSERT INTO procesosPorProyecto VALUES(?,?,?,?,?,?)");
            $sentencia->bindParam(1, $idProyecto);
            $sentencia->bindParam(2, $idProceso);
            $sentencia->bindParam(3, $totalTiempo);
            $sentencia->bindParam(4, $totalPrecio);
            $sentencia->bindParam(5, $totalEmp);
            $sentencia->bindParam(6, $prov);
            $sentencia->execute();
            $mensaje = "Procesos Asociados con Exito";
            return $mensaje;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }
    public function obtenerDatoProductoProyecto($idProyecto, PDO $cnn) {
        $mensaje = "";
        try {
            $sentencia = $cnn->prepare("SELECT dt.*, cantidadProductos FROM productos dt, productoPorProyecto where proyectosIdProyecto=? and
idProductos = Productos_idProductos");
            $sentencia->bindParam(1, $idProyecto);
            $sentencia->execute();
            return $sentencia->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }
    public function obtenerUtilidadProducto($idProducto, PDO $cnn) {
        try {
            $sentencia = $cnn->prepare("select ganancia from productos where idProductos = ?");
            $sentencia->bindParam(1, $idProducto);
            $sentencia->execute();
            return $sentencia->fetchColumn();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }

        public function cambiarFechaFinProyecto($fechaFin, $idProyecto, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare("UPDATE  proyectos SET fechaFin=? where idProyecto=?");
            $query->bindParam(1, $fechaFin);
            $query->bindParam(2, $idProyecto);
            $query->execute();
            $mensaje = 'Cambio Estado de Proyecto';
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    function listarProyectoPorPersonal($idUsuario, PDO $cnn){
       $mensaje = '';
        try {
            $query = $cnn->prepare("select * from proyectos
join usuarioPorProyecto on idProyecto = proyectoAsignado and usuarioAsignado = ? limit 20");
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null; 
        
    }
        function listarProyectoPorPersonal2($idUsuario, PDO $cnn){
       $mensaje = '';
        try {
            $query = $cnn->prepare("select * from proyectos, personas, usuarioPorProyecto 
where idProyecto = proyectoAsignado and usuarioAsignado = idUsuario and identificacion = ?");
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null; 
        
    }
    function ejecucionProyecto($idProyecto,$porcentaje, PDO $cnn){
        $mensaje = '';
        try {
            $query = $cnn->prepare("update proyectos set ejecutado = ? where idProyecto = ?");
            $query->bindParam(1, $porcentaje);
            $query->bindParam(2, $idProyecto);
            $query->execute();
            $mensaje = 'Actualizado';
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
    function cantidadUsuariosPorProyecto($idProyecto, PDO $cnn){
               $mensaje = '';
        try {
            $query = $cnn->prepare("select count(usuarioAsignado) as cantidad from usuarioPorProyecto 
join personas on usuarioAsignado = idUsuario and proyectoAsignado = ?
join usuarios on identificacion = idLogin
join roles on rolesId = idRoles and rol = 'Empleado'");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null; 
        
    }
    function totalUsuariosPorProyecto($idProyecto, PDO $cnn){
                $mensaje = '';
        try {
            $query = $cnn->prepare("SELECT totalTrabajadores FROM estudioDeCostos where idProyectoSolicitado = ?");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null; 
        
    }
    function cantidadProyectosAsignados($idUsuario, PDO $cnn){

                       $mensaje = '';
        try {
            $query = $cnn->prepare("select count(proyectoAsignado) as cantidad from usuarioPorProyecto 
join proyectos on idProyecto = proyectoAsignado and usuarioAsignado = ? and estadoProyecto = 'Ejecución' ");
            $query->bindParam(1, $idUsuario);
            $query->execute();
            return $query->fetchColumn();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null; 
    }

        function graficoCostosAnuales($anio, PDO $cnn){

                       $mensaje = '';
        try {
            $query = $cnn->prepare("SELECT sum(costoProyecto) suma, month(fechaFin) mes from estudioDeCostos, proyectos 
                where idProyecto = idProyectoSolicitado and fechaFin 
                 BETWEEN '".$anio."0101' AND '".$anio."1231' group by month(fechaFin)");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null; 
    }
            function graficoEstadosAnuales($anio, $estado, PDO $cnn){

                       $mensaje = '';
        try {
            $query = $cnn->prepare("SELECT count(idProyecto) cantidad,estadoProyecto from  proyectos 
                where estadoProyecto = 'Finalizado' and fechaFin 
                 BETWEEN '".$anio."0101' AND '".$anio."1231'
                 or estadoProyecto = 'Cancelado' and fechaFin 
                 BETWEEN '".$anio."0101' AND '".$anio."1231' group by estadoProyecto");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null; 
    }

        function cambiarObservacionesProyecto($observaciones, $idProyecto, PDO $cnn) {
        $mensaje = '';
        try {
            $query = $cnn->prepare("UPDATE  proyectos SET observaciones=? where idProyecto=?");
            $query->bindParam(1, $observaciones);
            $query->bindParam(2, $idProyecto);
            $query->execute();
            $mensaje = 'Cambio Observaciones de Proyecto';
            return $mensaje;
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
        public function proyectoEnEjecucionEmpleado($empleado, PDO $cnn) {
            $idsAsignados = array();
        try {
            $query = $cnn->prepare('SELECT proyectoAsignado FROM usuarioPorProyecto WHERE usuarioAsignado=?');
            $query->bindParam(1, $empleado);
            $query->execute();
            foreach($query->fetchAll() as $asignados){
                $idsAsignados[]=$asignados['proyectoAsignado'];
            }
            $stringSt = array();
            for ($i=0; $i < count($idsAsignados); $i++) { 
                $stringSt[]='and idProyecto!= ?';
            }
            $cantidadCompara = implode(" ", $stringSt);
            $query2 = $cnn->prepare('SELECT idProyecto, nombreProyecto from proyectos where estadoProyecto="Ejecución" '.$cantidadCompara);
            for ($i=0; $i < count($idsAsignados); $i++) { 
                $query2->bindParam($i+1, $idsAsignados[$i]);
            }
            
            $query2->execute();
            return $query2->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $cnn = NULL;
    }

        public function obtenerEmpleadosPro($idProyecto, PDO $cnn) {
        try {
            $query = $cnn->prepare("Select idUsuario,identificacion, concat(nombres,' ',apellidos) nombre,direccion,telefono,fechaNacimiento,email,rol, nombreArea
from usuarios, personas, roles, usuarioPorProyecto,areas
 where idUsuario=usuarioAsignado and proyectoAsignado=? and identificacion=idLogin and 
 rolesId=idRoles and idAreas=areas_idAreas and rol='Empleado'");
            $query->bindParam(1, $idProyecto);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        $cnn = null;
    }
}
