<?php

/**
 * Created by PhpStorm.
 * User: Camilo Arias Gonzalez
 * Date: 15/11/15
 * Time: 8:13 PM
 */
class UtilidadDAO extends FacadeProyectos{
    public function calculoUtilidad($idProyecto){
       $arreglo = parent::obtenerProductoProyecto($idProyecto);
        $utilidadesProductos = array();
        foreach ($arreglo as $todo) {
            $gananciaProducto = parent::obtenerUtilidadProducto($todo['Productos_idProductos']);
            $utilidadesProductos['utilidad'.$todo['Productos_idProductos']] =($todo['cantidadProductos']*$gananciaProducto);
        }
        return  $utilidadesProductos;
    }
}