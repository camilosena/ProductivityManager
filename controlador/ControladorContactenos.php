<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../modelo/utilidades/Conexion.php';
require_once '../modelo/utilidades/EnvioCorreos.php';
require_once '../PHPMailer/PHPMailerAutoload.php';
require_once '../facades/FacadeCorreos.php';
require_once '../modelo/dto/CorreosDTO.php';
require_once '../facades/FacadeUsuarios.php';
require_once '../modelo/dao/UsuarioDAO.php';
require_once '../modelo/dto/UsuarioDTO.php';
require_once '../facades/FacadeContactenos.php';
require_once '../modelo/dao/ContactenosDAO.php';
require_once '../modelo/dto/ContactenosDTO.php';
$facadeUsuario = new FacadeUsuarios();
$facadeContactenos = new FacadeContactenos();
if (isset($_POST['contactarme'])) {
    $nombres = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $empresa = $_POST['empresa'];
    $telefono = $_POST['indicativo'].$_POST['telefono'];
    $email = $_POST['email'];   
    $idPais = $_POST['pais'];
    $telefono = $_POST['telefono'];
    $modo = $_POST['modo'];
    $razon = $_POST['motivo'];
    $numeros = $facadeContactenos->cantidadSolicitudes();
    $numero = $numeros['numero'];
    //envio de correo 
    $correoDTO = new CorreosDTO();    
    $correoDTO->setRemitente("productivitymanagersoftware@gmail.com");
    $correoDTO->setNombreRemitente("Productivity Manager");
    $correoDTO->setAsunto("Solicitud de contacto N° ".$numero);
    $correoDTO->setContrasena("adsi2015");
    $correoDTO->setDestinatario("servicioalclientepms@gmail.com");
    $correoDTO->setContenido("El señor ".$nombres. " ". $apellidos.", de la empresa ".$empresa." solicita ser contactado al número de telefono +".$telefono
            ." o al correo electronico ".$email.'<br>'
            ."La razón de esta solicitud es: ".$razon."<br><br>"
            ."Por favor realizar el contacto lo mas pronto posible para brinda la información solicitada.".'<br>'
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
       $mensaje2="Error no se pudo generar la solicitud";
       $consecutivos = 0;
       header("location: ../contactecnos?Solicitud=Intente Nuevamente");
    } else {        
    //mensaje enviado
    
        $idContacto = $numero;
        $contactenosDTO = new ContactenosDTO($idContacto, $nombres, $apellidos, $empresa, $email, $idPais, $telefono, $modo, $razon);
        $mensaje2 = $facadeContactenos->guardarContacto($contactenosDTO,$numero);

    header("location: ../contactecnos?Solicitud=Gracias por escribirnos. Pronto será contactado para responder a su solicitud.");
}
}