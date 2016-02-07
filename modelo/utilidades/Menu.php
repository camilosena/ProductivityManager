<?php

class Menu {
    
            
    function permisosMenu(){
            require_once '../modelo/dao/LoginDAO.php';
            require_once '../modelo/dao/PermisosDAO.php';
            require_once '../modelo/utilidades/Conexion.php';
            require_once '../facades/FacadeLogin.php';
            require_once '../facades/FacadePermisos.php';
            $facadePermmisos = new FacadePermisos;
            $menuGeneral = $facadePermmisos->menuGeneral($_SESSION['rol']);
            $proyecto = $facadePermmisos->permisoProyecto($_SESSION['rol']);
            $novedad = $facadePermmisos->permisoNovedad($_SESSION['rol']);
            $persona = $facadePermmisos->permisoPersonal($_SESSION['rol']);
            $audita = $facadePermmisos->permisoAuditoria($_SESSION['rol']);
            $clientes = $facadePermmisos->permisoCliente($_SESSION['rol']);
            $roles = $facadePermmisos->permisoRoles($_SESSION['rol']);
            $insumos = $facadePermmisos->permisoInsumos($_SESSION['rol']);
            $procesos = $facadePermmisos->permisoProcesos($_SESSION['rol']);
            $productos = $facadePermmisos->permisoProductos($_SESSION['rol']);
    
        ?>
    <div>
     <ul id="cbp-tm-menu" class="cbp-tm-menu">
                      <?php 
                        foreach ($menuGeneral as $general) {
                      ?>
                        <li>
                          <a href="#"><?php echo $general['nombreRuta'] ?> </a>
                            <?php  if ($general['nombreRuta'] == 'Proyectos') { ?>
                            <ul class="cbp-tm-submenu">
                            <?php  foreach ($proyecto as $pagina) { ?>
                            <li><a href="<?php echo $pagina['URL'] ?>" class="cbp-tm-icon-archive"><?php echo $pagina['nombreRuta']?></a></li>
                          <?php }?>
                          </ul>
                          <?php }?>
                          <?php  if ($general['nombreRuta'] == 'Novedades') { ?>
                            <ul class="cbp-tm-submenu">
                            <?php  foreach ($novedad as $pagina) { ?>
                            <li><a href="<?php echo $pagina['URL'] ?>" class="cbp-tm-icon-pencil"><?php echo $pagina['nombreRuta']?></a></li>
                          <?php }?>
                          </ul>
                          <?php }?>
                          <?php  if ($general['nombreRuta'] == 'Personal') { ?>
                            <ul class="cbp-tm-submenu">
                            <?php  foreach ($persona as $pagina) { ?>
                            <li><a href="<?php echo $pagina['URL'] ?>" class="cbp-tm-icon-users"><?php echo $pagina['nombreRuta']?></a></li>
                          <?php }?>
                          </ul>
                          <?php }?>
                          <?php  if ($general['nombreRuta'] == 'Clientes') { ?>
                            <ul class="cbp-tm-submenu">
                            <?php  foreach ($clientes as $pagina) { ?>
                            <li><a href="<?php echo $pagina['URL'] ?>" class="cbp-tm-icon-users"><?php echo $pagina['nombreRuta']?></a></li>
                          <?php }?>
                          </ul>
                          <?php }?>
                          <?php  if ($general['nombreRuta'] == 'Roles') { ?>
                            <ul class="cbp-tm-submenu">
                            <?php  foreach ($roles as $pagina) { ?>
                            <li><a href="<?php echo $pagina['URL'] ?>" class="cbp-tm-icon-users"><?php echo $pagina['nombreRuta']?></a></li>
                          <?php }?>
                          </ul>
                          <?php }?>
                          <?php  if ($general['nombreRuta'] == 'Materia Prima') { ?>
                            <ul class="cbp-tm-submenu">
                            <?php  foreach ($insumos as $pagina) { ?>
                            <li><a href="<?php echo $pagina['URL'] ?>" class="cbp-tm-icon-link"><?php echo $pagina['nombreRuta']?></a></li>
                          <?php }?>
                          </ul>
                          <?php }?>
                          <?php  if ($general['nombreRuta'] == 'Procesos') { ?>
                            <ul class="cbp-tm-submenu">
                            <?php  foreach ($procesos as $pagina) { ?>
                            <li><a href="<?php echo $pagina['URL'] ?>" class="cbp-tm-icon-clock"><?php echo $pagina['nombreRuta']?></a></li>
                          <?php }?>
                          </ul>
                          <?php }?>
                          <?php  if ($general['nombreRuta'] == 'Productos') { ?>
                            <ul class="cbp-tm-submenu">
                            <?php  foreach ($productos as $pagina) { ?>
                            <li><a href="<?php echo $pagina['URL'] ?>" class="cbp-tm-icon-cog"><?php echo $pagina['nombreRuta']?></a></li>
                          <?php }?>
                          </ul>
                          <?php }?>

                        </li>
                        <?php }?>
                      </ul>
                    </div>
                    <script src="../js/cbpTooltipMenu.min.js"></script>
                    <script>
                      var menu = new cbpTooltipMenu( document.getElementById( 'cbp-tm-menu' ) );
                    </script>
     <?php   
    }
}
?>