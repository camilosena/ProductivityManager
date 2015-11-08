<?php

class Session {

    function Session($pagActual) {
        if (empty($_SESSION['rol']) && empty($_SESSION['id'])) {
            header("location: ../index.php?error=Debe Iniciar Sesión");
        } else {
            require_once '../modelo/dao/LoginDAO.php';
            require_once '../facades/FacadeLogin.php';
            require_once '../modelo/utilidades/Conexion.php';
            $facadeLogueado = new FacadeLogin;
            $paginas = $facadeLogueado->seguridadPaginas($_SESSION['rol']);            
            $total = count($paginas);
            foreach ($paginas as $todas) {
                if ($pagActual != $todas['url']) {
                    $total--;
                }
            }
            if ($total == 0) {
                header("location: ../403.html");
            }            
        }
    }

}
