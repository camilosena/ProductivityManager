<?php

class FacadePermisos {
    private $conexion=null;
    private $permisosDAO=null;
    
    function __construct() {
        $this->conexion = Conexion::getConexion(); 
        $this->permisosDAO= new PermisosDAO;
    }
    
     public function menuGeneral($IdRol){
    return $this->permisosDAO->menuGeneral($IdRol,$this->conexion);
    }
    
    public function permisoProyecto($IdRol){
    return $this->permisosDAO->permisosProyectos($IdRol,$this->conexion);
    }
    
     public function permisoNovedad($IdRol){
    return $this->permisosDAO->permisosNovedades($IdRol,$this->conexion);
    }
    
     public function permisoPersonal($IdRol){
    return $this->permisosDAO->permisosPersonal($IdRol,$this->conexion);
    }
    
     public function permisoAuditoria($IdRol){
    return $this->permisosDAO->permisosAuditorias($IdRol,$this->conexion);
    }
    
    public function permisoCliente($IdRol){
    return $this->permisosDAO->permisosClientes($IdRol,$this->conexion);
    }
    public function permisoRoles($IdRol){
    return $this->permisosDAO->permisosRoles($IdRol,$this->conexion);
    }
    public function permisoInsumos($IdRol){
    return $this->permisosDAO->permisosInsumos($IdRol,$this->conexion);
    }
    public function permisoProcesos($IdRol){
    return $this->permisosDAO->permisosProcesos($IdRol,$this->conexion);
    }
    public function permisoProductos($IdRol){
    return $this->permisosDAO->permisosProductos($IdRol,$this->conexion);
    }
    
}