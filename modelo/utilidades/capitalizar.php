<?php
require_once '../utilidades/Conexion.php';

$cnn = Conexion::getConexion();
			 try {
                $sentencia = $cnn->prepare("UPDATE proyectos SET nombreProyecto = CONCAT(UCASE(LEFT(nombreProyecto, 1)),LCASE(SUBSTRING(nombreProyecto, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
            try {
                $sentencia = $cnn->prepare("UPDATE personas SET nombres = CONCAT(UCASE(LEFT(nombres, 1)),LCASE(SUBSTRING(nombres, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
            try {
                $sentencia = $cnn->prepare("UPDATE personas SET apellidos = CONCAT(UCASE(LEFT(apellidos, 1)),LCASE(SUBSTRING(apellidos, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
             try {
                $sentencia = $cnn->prepare("UPDATE personas SET direccion = CONCAT(UCASE(LEFT(direccion, 1)),LCASE(SUBSTRING(direccion, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
            try {
                $sentencia = $cnn->prepare("UPDATE materiaprima SET descripcionMateria = CONCAT(UCASE(LEFT(descripcionMateria, 1)),LCASE(SUBSTRING(descripcionMateria, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
             try {
                $sentencia = $cnn->prepare("UPDATE materiaprima SET unidadDeMedida = CONCAT(UCASE(LEFT(unidadDeMedida, 1)),LCASE(SUBSTRING(unidadDeMedida, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
             try {
                $sentencia = $cnn->prepare("UPDATE novedades SET descripcionNovedad = CONCAT(UCASE(LEFT(descripcionNovedad, 1)),LCASE(SUBSTRING(descripcionNovedad, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
             try {
                $sentencia = $cnn->prepare("UPDATE novedades SET solucionNovedad = CONCAT(UCASE(LEFT(solucionNovedad, 1)),LCASE(SUBSTRING(solucionNovedad, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
             try {
                $sentencia = $cnn->prepare("UPDATE procesos SET tipoProceso = CONCAT(UCASE(LEFT(tipoProceso, 1)),LCASE(SUBSTRING(tipoProceso, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
             try {
                $sentencia = $cnn->prepare("UPDATE productos SET nombreProducto = CONCAT(UCASE(LEFT(nombreProducto, 1)),LCASE(SUBSTRING(nombreProducto, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }
               try {
                $sentencia = $cnn->prepare("UPDATE productos SET descripcionProducto = CONCAT(UCASE(LEFT(descripcionProducto, 1)),LCASE(SUBSTRING(descripcionProducto, 2)));");
                $sentencia->execute();
                    } catch (Exception $ex) {
                        $mensaje ='Error Capitaliza.';
                    }