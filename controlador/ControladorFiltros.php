<?php
require_once '../modelo/dao/FiltrosDAO.php';
require_once '../modelo/dto/UsuarioDTO.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../facades/FacadeFiltros.php';
require_once '../modelo/dto/ProyectosDTO.php';
require_once '../modelo/dao/ProyectosDAO.php';
require_once '../facades/FacadeProyectos.php';
require_once '../modelo/dto/ClienteDTO.php';
require_once '../modelo/dao/ClienteDAO.php';
require_once '../facades/FacadeCliente.php';
require_once '../modelo/utilidades/Conexion.php';

if (isset($_POST['buscarUsuarios'])) {
    session_start();
    $usuarioDTO = new UsuarioDTO($idUsuario, $identificacion, $nombre, $apellido, $direccion, $telefono, $fecha, $email, $estado, $foto, $contrasena, $rol, $area);
    $usuarioDTO->setIdUsuario($_POST['idUser']);
    $usuarioDTO->setIdentificacion($_POST['identification']);
    $usuarioDTO->setNombre($_POST['names']);
    $usuarioDTO->setApellido($_POST['lastNames']);
    $usuarioDTO->setRol($_POST['rol']);    
    $usuarioDTO->setTelefono($_POST['phone']); 
    $filtro = new FacadeFiltros;
    $_SESSION['filtroBusqueda'] = $filtro->filtrarUsuarios($usuarioDTO);
    if (empty($_SESSION['filtroBusqueda'])) {
        $mensaje = "No Se Encontraron Coincidencias";
    } else {
        $mensaje = "Registros Encontrados";
    }
    header("location: ../vista/listarUsuarios?mensajeFiltro=" .
            $mensaje . "&busqueda=true");
} elseif (isset($_POST['buscarProyectos'])) {
    session_start();
    $proyectoDTO = new ProyectosDTO;
    $proyectoDTO->setIdProyecto($_POST['idProject']);
    $proyectoDTO->setNombreProyecto($_POST['nameProject']);
    $proyectoDTO->setFechaInicio($_POST['dateB']);
    $proyectoDTO->setFechaFin($_POST['dateE']);
    $proyectoDTO->setEstado($_POST['state']);    
    $proyectoDTO->setEjecucion($_POST['exec']); 
    $filtro = new FacadeFiltros;
    if($_SESSION['rol']!='Empleado'){
        $_SESSION['filtroProyectos'] = $filtro->filtrarProyectos($proyectoDTO);
    }else{
        $_SESSION['filtroProyectos'] = $filtro->filtrarProyectos2($proyectoDTO,$_SESSION['id']);
    }
    if (empty($_SESSION['filtroProyectos'])) {
        $mensaje = "No Se Encontraron Coincidencias";
    } else {
        $mensaje = "Registros Encontrados";
    }
    header("location: ../vista/listarProyectos?mensajeFiltro=" .
            $mensaje . "&busquedaProject=true");
} elseif (isset($_POST['buscarActivos'])) {
    session_start();
    $clienteDTO = new ClienteDTO;
    $clienteDTO->setIdUsuario($_POST['idClient']);
    $clienteDTO->setNit($_POST['nit']);
    $clienteDTO->setRazonSocial($_POST['names']);
    $clienteDTO->setTelefonoFijo($_POST['phone']);
    $clienteDTO->setSectorEconomico($_POST['secEco']);    
    $clienteDTO->setSectorEmpresarial($_POST['secEmp']); 
    $filtro = new FacadeFiltros;
    $_SESSION['filtroActivos'] = $filtro->filtrarClientesActivos($clienteDTO);
    if (empty($_SESSION['filtroActivos'])) {
        $mensaje = "No Se Encontraron Coincidencias";
    } else {
        $mensaje = "Registros Encontrados";
    }
    header("location: ../vista/clientesActivos?mensajeFiltro=" .
            $mensaje . "&busquedaActivos=true");
} elseif (isset($_POST['buscarInactivos'])) {
    session_start();
    $clienteDTO = new ClienteDTO;
    $clienteDTO->setIdUsuario($_POST['idClient']);
    $clienteDTO->setNit($_POST['nit']);
    $clienteDTO->setRazonSocial($_POST['names']);
    $clienteDTO->setTelefonoFijo($_POST['phone']);
    $clienteDTO->setSectorEconomico($_POST['secEco']);    
    $clienteDTO->setSectorEmpresarial($_POST['secEmp']); 
    $filtro = new FacadeFiltros;
    $_SESSION['filtroInactivos'] = $filtro->filtrarClientesInactivos($clienteDTO);
    if (empty($_SESSION['filtroInactivos'])) {
        $mensaje = "No Se Encontraron Coincidencias";
    } else {
        $mensaje = "Registros Encontrados";
    }
    header("location: ../vista/clientesInactivos?mensajeFiltro=" .
            $mensaje . "&busquedaInactivos=true");

// Filtros Novedades Howard

} elseif (isset($_POST['buscarNovedades'])) {
    session_start();
    $NovedadDTO = new NovedadesDTO;
    $NovedadDTO->setIdUsuario($_POST['idClient']);
    $NovedadDTO->setNit($_POST['nit']);
    $NovedadDTO->setRazonSocial($_POST['names']);
    $NovedadDTO->setTelefonoFijo($_POST['phone']);
    $NovedadDTO->setSectorEconomico($_POST['secEco']);
    $NovedadDTO->setSectorEmpresarial($_POST['secEmp']);
    $filtro = new FacadeFiltros;
    $_SESSION['filtroInactivos'] = $filtro->filtrarClientesInactivos($NovedadDTO);
    if (empty($_SESSION['filtroInactivos'])) {
        $mensaje = "No Se Encontraron Coincidencias";
    } else {
        $mensaje = "Registros Encontrados";
    }
    header("location: ../vista/listarNovedades.php?mensajeFiltro=" .
        $mensaje . "&busquedaInactivos=true");
}
