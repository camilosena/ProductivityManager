<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author Jorge M. Izquierdo N
 */
class Prueba {
    
            
    function permisosMenu(){
            require_once '../modelo/dao/CrearRolDAO.php';
                        require_once '../modelo/dto/CrearRolDTO.php';
                        require_once '../facades/FacadeCreateRol.php';
                        require_once '../modelo/utilidades/Conexion.php';

                        $facadeCreateRol = new FacadeCreateRol();
                        $idRol = $facadeCreateRol->obtenerID($_GET['id']);
                        $nombre = $facadeCreateRol->ObtenerNombreRol($_GET['id']);
                        $all = $facadeCreateRol->ListarPermisos();
                        $PPRol = $facadeCreateRol->ObtenerPermisosPorRol($_GET['id']);
    
        
       foreach ($all as $unit){
                                
                                if ($unit['nivel'] == 1) {
                                    echo '<li>'.$unit['nombreRuta'].'</li>';
                                    if ($unit['nivel'] > 1) {
                                        echo '<li tab="1">'.$unit['nombreRuta'].'</li>';

                                    } echo '</ul></li>';
                                }
                                }
//                                if ($general['nombreRuta'] == 'Novedades') {
//                                    echo '<ul class="dos">';
//                                    foreach ($idRol as $pagina) {
//                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
//                                    } echo '</ul></li>';
//                                }
//                                if ($general['nombreRuta'] == 'Personal') {
//                                    echo '<ul class="tres">';
//                                    foreach ($persona as $pagina) {
//                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
//                                    } echo '</ul></li>';
//                                }
//                                if ($general['nombreRuta'] == 'Auditorias') {
//                                    echo '<ul class="cuatro">';
//                                    foreach ($audita as $pagina) {
//                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
//                                    } echo '</ul></li>';
//                                }
//                                if ($general['nombreRuta'] == 'Clientes') {
//                                    echo '<ul class="cinco">';
//                                    foreach ($clientes as $pagina) {
//                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
//                                    } echo '</ul></li>';
//                                }
//                                if ($general['nombreRuta'] == 'Roles') {
//                                    echo '<ul class="seis">';
//                                    foreach ($roles as $pagina) {
//                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
//                                    } echo '</ul></li>';
//                                }
//                                if ($general['nombreRuta'] == 'Insumos') {
//                                    echo '<ul class="siete">';
//                                    foreach ($insumos as $pagina) {
//                                        echo'<li><a href="' . $pagina['URL'] . '">' . $pagina['nombreRuta'] . '</a></li>';
//                                    } echo '</ul></li>';
//                                }
                            }
        
    
}
