<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contáctenos</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main_responsive.css">
	<link rel="stylesheet" type="text/css" href="css/stylesNavTop.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script type="text/javascript" src="js/script2.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/carouFredSel.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/toastr.js"></script>
    <link href="js/toastr.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css">
    <script>
        $(document).ready(function () {
            $("#selectPais").on("change", function () {
                $.ajax({
                    url: "peticiones_ajax/ajax_listar_indicativos.php",
                    method: "POST",
                    data: {
                        paisSelected: $(this).val(),
                        accion: "listarIndicativo"
                    },
                    success: function (data) {
                        $("#selectIndicativo").html(data);
                    },
                    error: function (error) {
                        alert(error);
                    }
                });
                    //alert($(this).val());
                });
        });
    </script>
</head>
<body>
    <div id='cssmenu' style="text-align:center">        
        <ul>
         <li><a href='index.php'><span><i class="fa fa-home fa-lg"></i>  </span></a></li>
         <li><a href='nuestrosClientes.html'><span><i class="fa fa-users fa-lg"></i>  </span></a></li>
         <li><a href='contactecnos'><span><i class="fa fa-envelope-o fa-lg"></i>  </span></a></li>
     </ul>       
 </div>  
 <style type="text/css">
   header nav{
    overflow: hidden;
    display: inline-block;
    margin: 20px 0 0 40px;
    padding: 30px 40px;
    border-left: 1px #000 solid;
    z-index: 9999;
    height: 80px;
}
header nav ul{
   list-style: none;
}

header nav ul li{
    float: left;
    margin-left: 20px;
    font-size: 12px;
    font-family: 'lato_regular', arial;
    letter-spacing: 1px;
}

header nav ul li:first-child{
    margin-left: 0;
}

header nav ul li a {
    text-decoration: none; 
    font-weight: bold;   
    color: #000;    
}

header nav ul li a:hover{
    color: #83AF44;
}

header nav ul li a:active{
    text-decoration: underline;
}
</style>  
<header>
  <div class="wrapper">
     <a href="index.php"><img src="img/logo.png" class="logo animated slideInLeft" width="190px" height="110px"></a>
     <a href="#" class="menu_icon" id="menu_icon"></a>
     <nav id="nav_menu" class="animated slideInDown">
        <ul>
           <li><a href="index.php">Inicio</a></li>					
           <li><a href="nuestrosClientes.html">Nuestros Clientes</a></li>
           <li><a href="contactecnos">Contáctenos</a></li>
       </ul>
   </nav>
   <ul class="social animated slideInRight">
    <li><a class="fb" href="https://www.facebook.com/productivitymanager"></a></li>
    <li><a class="twitter" href="https://twitter.com/Productivity_Mg"></a></li>
    <li><a class="gplus" href="mailto:productivitymanagersoftware@gmail.com"></a></li>
</ul>
</div>
</header>
<div id="panelIzq2" class="animated zoomIn">
    <?php
    require_once './facades/FacadeContactenos.php';
    require_once './modelo/dao/ContactenosDAO.php';
    require_once './modelo/utilidades/Conexion.php';
    $facadeContactenos = new FacadeContactenos();

    ?>
    <div class="caption">		
     <h2 class="h330">Contáctese con nosotros:</h2><br>	
     <p class="obligatorios" style="margin-left:20%;"> Los campos marcados con asterisco ( </p><p class="obligatoriosD"> ) son obligatorios.</p><br><br>
     <form class="formRegistro" id="formContact" method="post" action="controlador/ControladorContactenos.php"> 				    	
        <label class="tag" for="txtName"><span id="lab_valName" class="h331">Nombre </span></label>
        <input class="input" name="nombre" type="text" maxlength="64" id="txtName" class="field1" autofocus required pattern= "[A-Za-z]{3,20}">
        <span id="valName" style="color:Red;visibility:hidden;"></span>
        <br>
        <label class="tag" for="txtSurname"><span id="lab_valSurname" class="h331">Apellidos </span></label>
        <input class="input" name="apellidos" type="text" maxlength="64" id="txtSurname" class="field1" required pattern= "[A-Za-z]{3,20}">
        <span id="valSurname" style="color:Red;visibility:hidden;"></span>
        <br>
        <label class="tag" for="txtCompany"><span id="lab_valCompany" class="h331">Empresa </span></label>
        <input class="input" name="empresa" type="text" maxlength="64" id="txtCompany" class="field1" required pattern= "[A-Za-z]{3,40}">
        <span id="valCompany" style="color:Red;visibility:hidden;"></span>
        <br>
        <label class="tag" for="txtEmail"><span id="lab_valEmail" class="h331">Email </span></label>
        <input class="input" name="email" type="email" maxlength="128" id="txtEmail" class="field1" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
        <span id="valEmail" style="color:Red;visibility:hidden;"></span>
        <br>
        <label class="tag" for="selCountry"><span id="lab_valCountry" class="h331">País </span></label>
        <select class="input" name="pais" id="selectPais" class="list_menu" required>
           <option value="0" disabled selected> - Seleccionar - </option>
           <?php
           $paises = $facadeContactenos->listarPaises();
           foreach ($paises as $pais) {
            echo '<option value="'.$pais['idPais'].'" >'.$pais['nombrePais'].' </option>';
        }


        ?>
    </select>
    <span id="valCountry" style="color:Red;visibility:hidden;"></span>
    <br>
    <label class="tag" for="selPrefix"><span id="lab_valPhone" class="h331">Teléfono </span></label>
    <select class="input3" name="indicativo" id="selectIndicativo" class="list_menu_small"  readonly>
   </select>
   <input class="input2" name="telefono" type="text" maxlength="15" id="txtPhone">
   <span id="valPhone" style="color:Red;visibility:hidden;"></span>
   <div id="divPhoneData" style="display:none;">
    <label class="tag_msg" id="lblPhoneData">&nbsp;</label>
</div>
<br>
<label class="tag2" for="selReference"><span class="h331">¿Cómo nos conoció?</span></label>
<select class="input" name="modo" id="selReference" class="list_menu">
 <option value="0"> - Seleccionar - </option>							
 <option value="Blog o Foro">Blog o Foro</option>
 <option value="Email">Email</option>
 <option value="Referencia:colega">Referencia:colega</option>
 <option value="Google">Google</option>
 <option value="Facebook">Facebook</option>
 <option value="LinkedIn">LinkedIn</option>
 <option value="Twitter">Twitter</option>
</select><br>
<label class="tag" style="position:relative;bottom:50px" for="selReference"><span class="h331">Motivo:</span></label>
<textarea class="input4" name="motivo" required></textarea>
<button type="submit" onclick="return pregunta()" name="contactarme" class="boton-verde">Enviar Información</button><br>
</form>		
<script src="js/additional-methods.min.js" type="text/javascript"></script>
                <script src="js/jquery.validate.min.js" type="text/javascript"></script>
                <script src="js/validacionesContacto.js"></script>		
</div>
</div>
<script language="JavaScript"> 
  function pregunta(){ 
   if (confirm('Afirmo que la información ingresada es verdadera')){ 
        return true;
    } else {
    return false;
    }  
} 
</script> 
<div id="panelDer" class="animated zoomIn">
 <div class="wrapper">		
    <br>	
    <section class="billboard">	
        <br><br>
        <script src="http://maps.googleapis.com/maps/api/js"></script>
        <script>
           function initialize()
           {
             var mapProp = {
               center: new google.maps.LatLng(4.651876, -74.062751),
               zoom:17,
               mapTypeId: google.maps.MapTypeId.ROADMAP
           };
           var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
           var marcador = new google.maps.Marker({
            /*Creamos un marcador*/
            position: new google.maps.LatLng(4.651876, -74.062751), /*Lo situamos en nuestro punto */
            map: map, /* Lo vinculamos a nuestro mapa */
            title: "Estamos Aqui" 
        })

       }

       function loadScript()
       {
         var script = document.createElement("script");
         script.type = "text/javascript";
         script.src = "http://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
         document.body.appendChild(script);
     }

     window.onload = loadScript;
 </script>
 <div id="googleMap"></div>
</section>
</div>
</div>                                              
<footer class="footer-distributed">
 <div class="footer-left">
    <span><img src="img/logoEscala.png" width="210" height="120"></span>
    <p class="footer-links">
        <a href="index.php">Inicio</a>
        ·
        <a href="nuestrosClientes.html">Clientes</a>
        ·
        <a href="index.php">¿Quienes Somos?</a>                   
        ·
        <a href="contactecnos">Contacto</a>
    </p>
    <p class="footer-company-name">Productivity Manager &copy; 2015</p>
</div>
<div class="footer-center">
    <div>
        <i class="fa fa-map-marker"></i>
        <p><span>Calle 65 No 13 - 21</span> Bogotá, Colombia</p>
    </div>
    <div>
        <i class="fa fa-phone"></i>
        <p>+57 301 5782659</p>
    </div>
    <div>
       <i class="fa fa-envelope"></i>
       <p><a href="mailto:productivitymanagersoftware@gmail.com">productivitymanagersoftware@gmail.com</a></p>
   </div>
</div>
<div class="footer-right">
    <p class="footer-company-about">
       <span>Productivity Manager</span>
       Para aumentar la Productividad es absolutamente necesario incorporar a los mejores trabajadores
   </p>
   <div class="footer-icons">
    <a href="https://www.facebook.com/productivitymanager"><img src="img/facebookFoot.png"></a>
    <a href="https://twitter.com/Productivity_Mg"><img src="img/twitterFoot.png"></a>					
    <a href="mailto:productivitymanagersoftware@gmail.com"></i><img src="img/gmailFoot.png"></a>
</div>
</div>
    <?php if (isset($_GET['Solicitud'])) { ?>
            <script language="JavaScript" type="text/javascript">
                window.onload = function () {
                    Command: toastr["info"]("<?php echo $_GET['Solicitud']; ?>")

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-full-width",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
<?php } ?>
        </script>
</footer>
</body>
  <script>
        $(document).ready(function(){
        //eliminamos el scroll de la pagina
        $("body").css({"overflow-y":"hidden"});
        //guardamos en una variable el alto del que tiene tu browser que no es lo mismo que del DOM
        var alto=$(window).height();
        //agregamos en el body un div que sera que ocupe toda la pantalla y se muestra encima de todo
        $("body").append('<div id="pre-load-web"><div id="imagen-load"><img src="img/loader.gif" alt=""></div></div>'); 
        //le damos el alto 
       $("#pre-load-web").css({height:alto+"px"}); 
       //esta sera la capa que esta dento de la capa que muestra un gif 
       $("#imagen-load").css({"margin-top":(alto/2)-30+"px"}); 
        })     
        $(window).load(function(){ 
        $("#pre-load-web").fadeOut(1000,function() { //eliminamos la capa de precarga $(this).remove();
        //permitimos scroll 
        $("body").css({"overflow-y":"auto"}); }); 
         
        })
    </script>
    <style>
    #pre-load-web {width:100%;position:absolute;background:#fff;left:0px;top:0px;z-index:100000}
    /*aqui centramos la imagen si coloco margin left -30 es por que la imagen mide 60 */
    #pre-load-web #imagen-load{left:48%;margin-left:-30px;position:absolute}
    </style>
</html>