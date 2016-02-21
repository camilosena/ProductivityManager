<?php

    require_once '../facades/FacadeProyectos.php';
    require_once '../modelo/dao/ProyectosDAO.php';
    require_once '../modelo/utilidades/Conexion.php';
    require_once '../modelo/utilidades/EnvioCorreos.php';
    require_once '../PHPMailer/PHPMailerAutoload.php';
    require_once '../facades/FacadeCorreos.php';
    require_once '../modelo/dto/CorreosDTO.php';
    require_once '../facades/FacadeUsuarios.php';
    require_once '../modelo/dao/UsuarioDAO.php';
class CorreoFinProyecto {
    
function enviarCorreoFinProyecto(){
    $facadeProyectos = new FacadeProyectos();
    $facadeUsuarios = new FacadeUsuarios();
    $datos = $facadeProyectos->listadoProyectos();
    foreach ($datos as $dato){
        $idProyecto = $dato['idProyecto'];
        $porcentaje = $dato['ejecutado'];  
        $nombreProyecto = $dato['nombreProyecto'];
        $estado = $dato['estadoProyecto'];
    if ($porcentaje == 100 && $estado=='Finalizado') {
                    $correo = $facadeUsuarios->correosPorProyecto($idProyecto);
                    foreach ($correo as $correos){
                    $email = $correos['email'];
                    //envio de correo
                    $correoDTO = new CorreosDTO();    
                    $correoDTO->setRemitente("productivitymanagersoftware@gmail.com");
                    $correoDTO->setNombreRemitente("Productivity Manager");
                    $correoDTO->setAsunto("Finalización del proyecto N° ".$idProyecto." ".$nombreProyecto);
                    $correoDTO->setContrasena("adsi2015");
                    $correoDTO->setDestinatario($email);
                    $correoDTO->setContenido("Sres.<br>"
                            ."Se les informa que el proyecto ".$nombreProyecto. " a finalizado el día de hoy <br>"
                        .'<font style="color: #83AF44; font-size: 11px; font-weight:bold; font-family: Sans-Serif;font-style:italic; " >Prductivity Manager Software'
                                    . '© Todos los derechos reservados 2015.'
                                    . '<br>'.'Bogotá, Colombia'
                                    . '<br>'.'Teléfono: +57 3015782659'
                                    . '<br>'.'https://www.facebook.com/productivitymanager'
                                    . '<br>'.'https://twitter.com/Productivity_Mg'
                    . '</font>');
                    $facadeCorreo = new FacadeCorreos();
                    $confirmacion=$facadeCorreo->EnvioCorreo($correoDTO);
                    if ($confirmacion!='True') {
                       $mensajeCorreo=$confirmacion;  
                       $mensaje2="Error no se pudo enviar el correo ";
                       $consecutivos = 0;
                    } else {        
                    //mensaje enviado
                   $facadeProyectos->cambiarEstadoProyecto('Archivado', $idProyecto);
               }       
        }

       }

     }

    }

}
