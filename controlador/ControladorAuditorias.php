<?php
require_once '../modelo/dao/AuditoriaDAO.php';
require_once '../modelo/dto/AuditoriaDTO.php';
require_once '../facades/FacadeAuditorias.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/dto/ImagenesDTO.php';
require_once '../modelo/utilidades/GestionImagenes.php';
require_once '../modelo/dto/CorreosDTO.php';
require_once '../PHPMailer/PHPMailerAutoload.php';
require_once '../modelo/utilidades/EnvioCorreos.php';
require_once '../facades/FacadeProyectos.php';
require_once '../modelo/dao/ProyectosDAO.php';
require_once '../facades/FacadeCorreos.php';
require_once '../modelo/utilidades/EnvioCorreos.php';

if(isset($_POST['crearAuditoria'])){
    session_start();
    $facadeUsuario = new FacadeUsuarios;
    $facadeAdutoria = new FacadeAuditorias();
    $facadeProyecto = new FacadeProyectos();
    
    $idUsuario=$facadeUsuario->usuarioEnSesion($_SESSION['id']);
    $nombreUsuario=$_SESSION['nombre'];
    $idProyecto=$_POST['idProyecto'];
    $descripcion=$_POST['descripcion'];
    
    $archivoAuditoria=$_FILES['uploadedfile']['name'];
     $ejecucion = $_POST['ejecucion'];
     $presupuesto = $_POST['presupuesto'];
     $insumos = $_POST['insumos'];
     $calidad = $_POST['calidad'];
     $procesos = $_POST['procesos'];
     $empleados = $_POST['empleados'];
     
     $auditoria= ($ejecucion + $presupuesto +  $insumos +  $calidad + $procesos + $empleados)/6;
     if ($auditoria >= 90) {
         $producto = $auditoria."%  Excelente";
     }else
     if ($auditoria < 90 & $auditoria >=47) {
         $producto = $auditoria."% Plan de Mejoramiento";
     }else
     if ($auditoria < 47) {
         $producto = $auditoria."% Comite Evaluador";
     }
    $objetoDTO = new AuditoriaDTO($idAuditoria, $idUsuario, $idProyecto, $descripcion, $producto, $archivoAuditoria, $ejecucion, $presupuesto, $insumos, $calidad, $procesos, $empleados);
    
    //Insertar Evidencia Auditor�a
    if ($_FILES['uploadedfile']['name'] == '') {
        $foto ='auditoria.png';
    } else {
        $foto = $_FILES['uploadedfile']['name'];
    }
    $carpeta = "evidencias";
    $nombreImagen = $_FILES['uploadedfile']['name'];
    $tamano = $_FILES['uploadedfile']['size'];
    $tipo = $_FILES['uploadedfile']['type'];
    $nombreTemporal = $_FILES['uploadedfile']['tmp_name'];
    $dtoImagen = new ImagenesDTO($tamano, $tipo, $nombreImagen, $nombreTemporal, $carpeta);
    $cargaFoto = new GestionImagenes();
    $msg =$cargaFoto->subirImagen($dtoImagen);
    // enviar correo 
    $proyectos = $facadeProyecto->consultarProyecto($idProyecto);
    $numeros = $facadeAdutoria->cantidadAuditoriasPorProyecto($idProyecto);
    $numero = $numeros['numero'];
    $datos = $facadeAdutoria->consultarGerenteParaEnvarAuditoriaPorCorreo($idProyecto);
    $email = $datos['email'];
    $proyecto = $proyectos['nombreProyecto'];
    $nombreGerente = $datos['nombre'];
    $fecha = "hoy";
    $correoDTO = new CorreosDTO();    
    $correoDTO->setRemitente("productivitymanagersoftware@gmail.com");
    $correoDTO->setNombreRemitente("Productivity Manager");
    $correoDTO->setAsunto("Auditoria N° ".$numero." al proyecto ". $proyecto);
    $correoDTO->setContrasena("adsi2015");
    $correoDTO->setDestinatario($email);
    $correoDTO->setContenido("Estimado señor: ".$nombreGerente.",<br> Se generó la auditoria N° ".$numero." el día ".$fecha." con las siguientes observaciones: "
            . $descripcion.'<br>'
            ."Auditor ".$nombreUsuario."<br><br>"
            ."Adjunto encontrara un archivo con la evidencia.".'<br>'
        .'<font style="color: #83AF44; font-size: 11px; font-weight:bold; font-family: Sans-Serif;font-style:italic; " >Prductivity Manager Software'
                    . '© Todos los derechos reservados 2015.'
                    . '<br>'.'Bogotá, Colombia'
                    . '<br>'.'Teléfono: +57 3015782659'
                    . '<br>'.'https://www.facebook.com/productivitymanager'
                    . '<br>'.'https://twitter.com/Productivity_Mg'
    . '</font>');
    $archivo = '../'.$carpeta.'/'.$nombreImagen;
    $correoDTO->setArchivos($archivo);
    $facadeCorreo = new FacadeCorreos();
    $confirmacion=$facadeCorreo->EnvioCorreo($correoDTO);
    if ($confirmacion!='True') {
       $mensajeCorreo=$confirmacion;  
       $mensaje2="Error no se pudo generar la novedad";
       $consecutivos = 0;
       header("Location: ../vista/listarNovedades.php?errorPermiso=" . $mensajeCorreo);
    } else {        
    //mensaje enviado
         $message= $facadeAdutoria->insertarAuditoria($objetoDTO);
    header("location: ../vista/generarAuditoria.php?auditoria=".$message);
    }
    }else if (isset($_GET['idAuditoria'])) {
    $facadeAdutoria = new FacadeAuditorias();
    session_start();
    $_SESSION['datosAuditoria'];
    $_SESSION['datosAuditoria'] = $facadeAdutoria->consultarAuditoria($_GET['idAuditoria']);
    header("Location: ../vista/listarAuditorias.php?&#verAuditoria");
    }