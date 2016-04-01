<!DOCTYPE html>
<html lang="en">
<head>
    <title>Productivity Manager</title>
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
    <link href="js/toastr.css" rel="stylesheet"/>
    <script src="js/toastr.js"></script>    
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>    
    <script src="js/validaciones.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>  
    <link rel="stylesheet" href="css/animate.css">
</head>
<body>
  <?php 
     require_once 'modelo/utilidades/browser.php';
        $browser = new browser();
        $navegador = $browser->getBrowser($_SERVER['HTTP_USER_AGENT']);
          if($navegador!='Google Chrome' && $navegador!='Safari'){
          ?>
           <script language="JavaScript" type="text/javascript">
                    window.onload = function () {
                        Command: toastr["error"]("<?php echo 'Esta utilizando '.$navegador.'<br> Para una correcta visualización utilice Google Chrome o Safai' ?>")

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
                            "timeOut": "9000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
            </script>
          <?php } ?> 
    <div id='cssmenu' style="text-align:center">        
        <ul>
         <li><a href='indexEnglish.php'><span><i class="fa fa-home fa-lg"></i>  </span></a></li>
         <li><a href='ourClients.html'><span><i class="fa fa-users fa-lg"></i>  </span></a></li>
         <li><a href='contactUs'><span><i class="fa fa-envelope-o fa-lg"></i>  </span></a></li>
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
        <a href="indexEnglish.php"><img src="img/logo.png" class="logo animated slideInLeft" width="190px" height="110px"></a>
        <a href="#" class="menu_icon" id="menu_icon"></a>
        <nav id="nav_menu" class="animated slideInDown">
            <ul>
                <li><a href="indexEnglish.php">Home</a></li>					
                <li><a href="ourClients.html">Our Clients</a></li>
                <li><a href="contactUs">Contact Us</a></li>
            </ul>
        </nav>
        <ul class="social animated slideInRight">
            <li><a class="fb" href="https://www.facebook.com/productivitymanager"></a></li>
            <li><a class="twitter" href="https://twitter.com/Productivity_Mg"></a></li>
            <li><a class="gplus" href="mailto:productivitymanagersoftware@gmail.com"></a></li>
        </ul>
    </div>
</header>
<nav class="migas"><br>
    <span itemscope >
        <a href="index.php" title="Ir a la página de inicio" itemprop="url"><span itemprop="title">Spanish</span></a> <font style="margin-left:10px;">|</font> 
        <span itemprop="child" itemscope>  
            <a href="indexEnglish.php" title="Go to Home" itemprop="url">
                <span itemprop="title">English</span>              
            </a>             
        </span> 
    </span>                   
</nav>      
<div id="panelIzq2">
    <div class="caption">	
        <form class="box login animated zoomIn"  action="controlador/ControladorLogin.php" method="post">                    	
            <fieldset class="boxBody">
                <label for="usuario" class="tag">User:</label>
                <input id="usuario" name="user" type="text" tabindex="1" placeholder="1012377890" autofocus maxlength="12" minlength="3" 
                               title="Enter number identification" required pattern= [0-9]{3,12}>
                        <label for="contrasena" class="tag"> Password:</label>
                        <input id="contrasena" name="pass" type="password" tabindex="2" maxlength="25"  required>
                <a href="#openModal" class="rLink" tabindex="3">Forgot Your Password?</a>
            </fieldset>	
            <div>
                <label><input type="checkbox" tabindex="5">Do Not Sign Out</label>
                <button type="submit" class="btnLogin" name="ingreso"tabindex="6" >Login</button>
            </div>                    
        </form>              
        <?php
        if (isset($_GET['mensaje'])) {
            echo '<script>
            Command: toastr["error"]("' . $_GET['mensaje'] . '")
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-center",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"}
          </script>';
      }
      ?>  
  </div>
</div>					
<div id="openModal" class="modalDialog" title="Password Recovery"><div>
    <a href="#close" title="Close" class="close">X</a><br>                  
    <h2 class="h330">Password Recovery:</h2><br>
    <p class="obligatorios">All fields below are mandatory.</p><br><br>                
    <form class="formRegistro" id="formContrasenaEg" method="Post" action="controlador/ControllerForgetPassword.php"> 

        <p style="font-weight: bold">  </p><hr>     
        <label for="identificacion" class="tag"><span id="valCompany" style="color:Red;visibility:hidden;"></span> User (Identification):</label>
        <input id="identificacion" name="user" type="text" tabindex="6"  required title="Don´t speecials characters (\ / : * ? «< > |)" pattern= [0-9]{3,10} autofocus>
        <br>
        <label for="email" class="tag"><span id="valCompany" style="color:Red;visibility:hidden;"></span> E-mail:</label>
        <input id="email" name="email" type="text" tabindex="7"  required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
        <br>   
        <label for="email2" class="tag"><span id="valCompany" style="color:Red;visibility:hidden;"></span> Confirm E-mail:</label>
        <input id="email2" name="emailConfirm" type="text" tabindex="8"  required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
        <br>
        <div style="margin-left: 17%;" class="g-recaptcha" data-sitekey="6LeJoxoTAAAAAN7PHq-ehaFexLnhNiCuFEpIqpbS"></div>
        <button type="submit" name="solicitarContrasena" tabindex="9" class="boton-verde">Password Request</button><br>
    </form>   


</div>                          

</div>		
<div id="panelDer">
    <div class="wrapper">			
        <section class="billboard animated zoomIn">	
            <section class="testimonials wrapper">
                <span class="sep_line sep_top">
                </span>

                <div class="testi_slider" id="tslider">
                            <div class="t">
                                <h2>Who Are We?</h2>
                                <p>Productivity Manager The system is developed in 2015; It is focused on 
                                    improving the productivity of enterprises, using transparent and modern 
                                    objectives; taking control of projects, costs, time and resources used.
                                </p>
                                <p class="author">Productivity Manager &copy; 2015</p>
                            </div>
                            <div class="t">
                                <h2><br><br>Who Are We?</h2>
                                <p>
                                    Oriented short-term benefits generating an increase in production which will favor the employee and the Employer.
                                </p>
                                <p class="author">Productivity Manager &copy; 2015</p>
                            </div>
                            <div class="t">
                                <h2>Mission</h2>
                                <p>
                                    Provide technology and software solutions for society through research, partnership, training, 
                                    certification and committed staff; allowing efficiently and systematically maximize productivity 
                                    and resources, generating welfare and profitability.
                                </p>
                                <p class="author">Productivity Manager &copy; 2015</p>
                            </div>
                            <div class="t">
                                <h2>Vision</h2>
                                <p>
                                    It is recognized as one of the top 10 technology companies and software development in Colombia 
                                    and Latin America, specialized in providing solutions through research and innovation, 
                                    covering all sectors of society, especially the industrial sector.
                                </p>
                                <p class="author">Productivity Manager &copy; 2015</p>
                            </div>
                            <div class="t">
                                <p>
                                    <br>Productivity Manager &copy; 2015
                                    <br><br>All rights reserved.
                                </p>
                                <p class="author">
                                    Developed by:<br>
                                    Camilo Arias González - Analyst / Developer<br>
                                    Jorge Izquierdo - Analyst / Developer<br>
                                    Howard Mosquera - Analyst / Developer<br>
                                </p>
                            </div>
                        </div>
                 <div id="t_navigation"></div>
                 <span class="sep_line sep_bottom"></span>
             </section><!--  End Testimonials  -->
         </section>
     </div>
 </div>
 <footer class="footer-distributed">
    <div class="footer-left">
        <span><img src="img/logoEscala.png" width="210" height="120"></span>
        <p class="footer-links">
            <a href="indexEnglish.php">Home</a>
            ·
            <a href="ourClients.html">Customers</a>
            ·
            <a href="indexEnglish.php">¿Who Are We?</a>					
            ·
            <a href="contactUs">Contact</a>
        </p>
        <p class="footer-company-name">Productivity Manager &copy; 2015</p>
    </div>
    <div class="footer-center">
        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>Street 65 Number 13 - 21</span> Bogotá, Colombia</p>
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
            To increase productivity is absolutely necessary to incorporate the best workers
        </p>
        <div class="footer-icons">
            <a href="https://www.facebook.com/productivitymanager"><img src="img/facebookFoot.png"></a>
            <a href="https://twitter.com/Productivity_Mg"><img src="img/twitterFoot.png"></a>					
            <a href="mailto:productivitymanagersoftware@gmail.com"></i><img src="img/gmailFoot.png"></a>
        </div>
    </div>
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