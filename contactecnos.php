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
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/script2.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/carouFredSel.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="../js/validaciones.js"></script>
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/main_responsive.css">
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/carouFredSel.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <link rel="stylesheet" href="../js/jquery.dataTables.css">
        <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../js/table.js"></script>
        <link href="../js/toastr.css" rel="stylesheet"/>
        <script src="../js/toastr.js"></script>
        <script src="../js/validaciones.js"></script>
        <link rel="stylesheet" type="text/css" href="fonts/fonts.css">
        <link rel="stylesheet" type="text/css" href="../css/stylesNavTop.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/script2.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <script src="../js/modernizr.custom.js"></script>
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
           <li><a href='contactecnos.php'><span><i class="fa fa-envelope-o fa-lg"></i>  </span></a></li>
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
			<a href="index.php"><img src="img/logo.png" class="logo" width="190px" height="110px"></a>
			<a href="#" class="menu_icon" id="menu_icon"></a>
			<nav id="nav_menu">
				<ul>
					<li><a href="index.php">Inicio</a></li>					
					<li><a href="nuestrosClientes.html">Nuestros Clientes</a></li>
					<li><a href="contactecnos.php">Contáctenos</a></li>
				</ul>
			</nav>
				<ul class="social">
				<li><a class="fb" href="https://www.facebook.com/productivitymanager"></a></li>
				<li><a class="twitter" href="https://twitter.com/Productivity_Mg"></a></li>
				<li><a class="gplus" href="mailto:productivitymanagersoftware@gmail.com"></a></li>
			</ul>
		</div>
	</header>
		<div id="panelIzq2">
                    <?php
                    require_once './facades/FacadeContactenos.php';
                    require_once './modelo/dao/ContactenosDAO.php';
                    require_once './modelo/utilidades/Conexion.php';
                    $facadeContactenos = new FacadeContactenos();
                    
                    ?>
			<div class="caption">		
			<h2 class="h330">Contáctese con nosotros:</h2><br>			
					<form class="formRegistro" method="post" action="#">					    	
                        <label class="tag" for="txtName"><span id="lab_valName" class="h331">Nombre </span></label>
                        <input class="input" name="txtName" type="text" maxlength="64" id="txtName" class="field1" autofocus required pattern= "[A-Za-z]{3,20}">
                        <span id="valName" style="color:Red;visibility:hidden;"></span>
                        <br>
                        <label class="tag" for="txtSurname"><span id="lab_valSurname" class="h331">Apellidos </span></label>
                        <input class="input" name="txtSurname" type="text" maxlength="64" id="txtSurname" class="field1" required pattern= "[A-Za-z]{3,20}">
                        <span id="valSurname" style="color:Red;visibility:hidden;"></span>
                        <br>
                        <label class="tag" for="txtCompany"><span id="lab_valCompany" class="h331">Empresa </span></label>
                        <input class="input" name="txtCompany" type="text" maxlength="64" id="txtCompany" class="field1" required pattern= "[A-Za-z]{3,40}">
                        <span id="valCompany" style="color:Red;visibility:hidden;"></span>
                        <br>
                        <label class="tag" for="txtEmail"><span id="lab_valEmail" class="h331">Email </span></label>
                        <input class="input" name="txtEmail" type="text" maxlength="128" id="txtEmail" class="field1" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                        <span id="valEmail" style="color:Red;visibility:hidden;"></span>
                        <br>
                        <label class="tag" for="selCountry"><span id="lab_valCountry" class="h331">País </span></label>
                        <select class="input" name="selectPais" id="selectPais" class="list_menu">
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
                        <select class="input3" name="selectIndicativo" id="selectIndicativo" class="list_menu_small">
									<option value=" "> - Seleccionar -  </option>
									
			</select>
                    	<input class="input2" name="txtPhone" type="text" maxlength="15" id="txtPhone">
                        <span id="valPhone" style="color:Red;visibility:hidden;"></span>
                        <div id="divPhoneData" style="display:none;">
                            <label class="tag_msg" id="lblPhoneData">&nbsp;</label>
                        </div>
                        <br>
                        <label class="tag" for="selReference"><span class="h331">¿Cómo nos conoció?</span></label>
                        <select class="input" name="selReference" id="selReference" class="list_menu">
							<option value="0"> - Seleccionar - </option>							
							<option value="2">Blog o Foro</option>
							<option value="3">Email</option>
							<option value="4">Referencia:colega</option>
							<option value="5">Referencia:amigo</option>
							<option value="6">Google</option>
							<option value="7">Facebook</option>
							<option value="8">LinkedIn</option>
							<option value="9">Twitter</option>
					</select><br>			
			<button type="submit" onclick="pregunta()" class="boton-verde">Enviar Información</button><br>
				        </form>				
					</div>
				</div>
				<script language="JavaScript"> 
						function pregunta(){ 
						   if (confirm('Afirmo que la información ingresada es verdadera')){ 
						       
						   } 
						} 
						</script> 
	<div id="panelDer">
			<div class="wrapper">			
				<section class="billboard">	
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
                                        <a href="contactecnos.html">Contacto</a>
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
		</footer>
</body>
</html>