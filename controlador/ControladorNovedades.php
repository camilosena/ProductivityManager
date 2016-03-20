<?php
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/NovedadesDAO.php';
require_once '../modelo/dto/NovedadesDTO.php';
require_once '../facades/FacadeNovedades.php';
require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/dto/ImagenesDTO.php';
require_once '../modelo/utilidades/GestionImagenes.php';
require_once '../modelo/dto/CorreosDTO.php';
require_once '../facades/FacadeCorreos.php';
require_once '../modelo/utilidades/EnvioCorreos.php';
require_once '../PHPMailer/PHPMailerAutoload.php';
$facadeUsuario = new FacadeUsuarios;
$facadeNovedad = new FacadeNovedades();
if(isset($_POST['crearNovedad'])){
    session_start();
    
    $idUsuario=$facadeUsuario->usuarioEnSesion($_SESSION['id']);
    $nombreUsuario = $_SESSION['nombre'];
    $idProyecto=$_POST['idProyecto'];
    $categoria=$_POST['categoria'];
    $descripcion=$_POST['descripcion'];
    $archivo=$_FILES['uploadedfile']['name'];
    $solucion = "";
    $estadoSolucion = "Pendiente";
    $fechaSolucion = 0;
    $fecha="";
    $idNovedad="";
    $objetoDTO = new NovedadesDTO($idNovedad, $idUsuario, $idProyecto, $categoria, $descripcion, $archivo, $fecha, $solucion, $fechaSolucion, $estadoSolucion);

    //Insertar Evidencia Novedades
    if ($_FILES['uploadedfile']['name'] == '') {
        $foto ='novedad.png';
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
    if($msg!='True'){
         header("location: ../vista/agregarNovedad?errorPermiso=Archivo No Valido");
    }else{
        $datos  = $facadeNovedad->consultarGerenteParaEnvarNovedadPorCorreo($idProyecto);
        $usuario = $facadeNovedad->consultarAreaUsuarioEnSesion($idUsuario);
        $email = $datos['email'];
        $nombreGerente = $datos['nombre'];
        $area = $usuario['nombreArea'];
        //Envio de Correo
    $correoDTO = new CorreosDTO();    
    $correoDTO->setRemitente("productivitymanagersoftware@gmail.com");
    $correoDTO->setNombreRemitente("Productivity Manager");
    $correoDTO->setAsunto("Novedad de ".$categoria." creada por ". $nombreUsuario);
    $correoDTO->setContrasena("adsi2015");
    $correoDTO->setDestinatario($email);
    $correoDTO->setContenido("Estimado señor ".$nombreGerente.",<br> Desde el area de ".$area." se generó una novedad de ".$categoria." con las siguientes observaciones: <br> "
            . $descripcion.'<br>'
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
       header("Location: ../vista/listarNovedades?errorPermiso=" . $mensajeCorreo.$mensaje2);
    } else {        
    //mensaje enviado
         $message= $facadeNovedad->insertarNovedad($objetoDTO);
    header("location: ../vista/agregarNovedad?novedad=".$message."&evidencia=".$msg);
    }
   
    }
}else if (isset($_GET['idNovedad'])) {

    session_start();
    $_SESSION['datoNovedad'] = $facadeNovedad->consultarNovedad($_GET['idNovedad']);

    header("Location: ../vista/listarNovedades?&#verUsuario");
}else
if (isset ($_GET['idSolucionar'])) {
    session_start();
    $_SESSION['solucionNovedad'] = $facadeNovedad->consultarNovedad($_GET['idSolucionar']);
   header("Location: ../vista/listarNovedades?#solucionarNovedad");
}else
if (isset ($_POST['solucionarNovedad'])) {
    session_start();
    $solucion = $_POST['solucion'];
    $idNovedad = $_SESSION['solucionNovedad']['idNovedad'];
    $novedad = $facadeNovedad->consultarNovedad($idNovedad);
    $idEmpleado = $novedad['usuarios_idUsuario'];
    $datos = $facadeUsuario->consultarUsuario($idEmpleado);
    $email = $datos['email'];
    $categoria = $novedad['categoria'];
    $nombreEmpleado = $datos['nombre'];
    $fecha = $novedad['fechaNovedad'];
    $proyecto = $novedad['nombreProyecto'];
    $idProyecto = $novedad['proyectos_idProyecto'];
    $datosGerente  = $facadeNovedad->consultarGerenteParaEnvarNovedadPorCorreo($idProyecto);
    $gerenteEncargado = $datosGerente['nombre'];
    //Envio de Correo
    $correoDTO = new CorreosDTO();    
    $correoDTO->setRemitente("productivitymanagersoftware@gmail.com");
    $correoDTO->setNombreRemitente("Productivity Manager");
    $correoDTO->setAsunto("Solución de la novedad de ".$categoria." del proyecto ". $proyecto);
    $correoDTO->setContrasena("adsi2015");
    $correoDTO->setDestinatario($email);
    $correoDTO->setContenido("Estimado  ".$nombreEmpleado.",<br> se ha dado solución a la novedad de ".$categoria." generada el  ".$fecha." con las siguientes observaciones: "
            . $solucion.'<br><br>'
            .$gerenteEncargado.'<br>'
            ."Gerente de Proyecto"
            ."".'<br>'
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
       header("Location: ../vista/listarNovedades?errorPermiso=" . $mensajeCorreo);
    } else {        
    //mensaje enviado
     $mensaje = $facadeNovedad->solucionarNovedad($solucion, $idNovedad);
     header("Location: ../vista/listarNovedades?mensaje=".$mensaje);
    }

}
