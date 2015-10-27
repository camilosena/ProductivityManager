<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Productivity Manager</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/main_responsive.css">
        <link rel="stylesheet" type="text/css" href="css/stylesNavTop.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/script2.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/carouFredSel.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <link href="js/toastr.css" rel="stylesheet"/>
        <script src="js/toastr.js"></script>    
    </head>
    <body>
    <div id='cssmenu' style="text-align:center">        
        <ul>
           <li><a href='indexEnglish.php'><span><i class="fa fa-home fa-lg"></i>  </span></a></li>
           <li><a href='ourClients.html'><span><i class="fa fa-users fa-lg"></i>  </span></a></li>
           <li><a href='contactUs.php'><span><i class="fa fa-envelope-o fa-lg"></i>  </span></a></li>
        </ul>       
    </div>    
        <header>
            <div class="wrapper">
                <a href="indexEnglish.php"><img src="img/logo.png" class="logo" width="190px" height="110px"></a>
                <a href="#" class="menu_icon" id="menu_icon"></a>
                <nav id="nav_menu">
                    <ul>
                        <li><a href="indexEnglish.php">Home</a></li>					
                        <li><a href="ourClients.html">Our Clients</a></li>
                        <li><a href="contactUs.php">Contact Us</a></li>
                    </ul>
                </nav>
                <ul class="social">
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
                <form class="box login"  action="controlador/ControladorLogin.php" method="post">                    	
                    <fieldset class="boxBody">
                        <label for="usuario" class="tag">User:</label>
                        <input id="usuario" name="user" type="text" tabindex="1" placeholder="1012377890" autofocus 
                               title="Enter Number Identification"  required pattern= [0-9]{3,10}>
                        <label for="contrasena" class="tag"> Password:</label>
                        <input id="contrasena" name="pass" type="password" tabindex="2"  required 
                               title="Don´t characters :  (\ / : * ? «< > |)" pattern= "[A-Za-z0-9]{1,15}" >
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
        <div id="openModal" class="modalDialog" title="Recuperar Contraseña"><div>
                <a href="#close" title="Close" class="close">X</a><br>					
                <form class="formRegistro"  action="indexEnglish.php">                    
                    <fieldset class="boxBody">
                        <center><h5>Password Recovery:<h5></center><br>
                                    <label for="usuarioConfirma" class="tag">User:</label>
                                    <input id="usuarioConfirma" class="input" type="text" tabindex="7" placeholder="1012377890" autofocus
                                           title="Enter your ID" required pattern= [0-9]{3,10} ""/>

                                    <label  class="tag" for="correo">E-mail:</label>
                                    <input class="input" id="correo" type="text" tabindex="8" placeholder="jrodriguez@muebleslaoficina.com" autofocus title="Enter your password" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" /> 
                                    <label for="correo2" class="tag">Confirm mail:</label>
                                    <input id="correo2" class="input" type="text" tabindex="9" placeholder="jrodriguez@muebleslaoficina.com" title="Enter your password"  autofocus required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />                         													
                                    <button type="submit" class="boton-verde" onclick="pregunta()"  tabindex="10">Password Request</button>			
                                    </fieldset>	
                                    </form>						
                                    </form>
                                    </div>
                                    </div>			
                                    <div id="panelDer">
                                        <div class="wrapper">			
                                            <section class="billboard">	
                                                <section class="testimonials wrapper">
                                                    <span class="sep_line sep_top">
                                                    </span>

                                                    <h2>Who Are We?</h2>
                                                    <div class="testi_slider" id="tslider">
                                                        <div class="t">		
                                                            <p>
                                                                Productivity Manager &copy; 2015
                                                            </p>							
                                                            <p class="author">
                                                                Camilo Arias González - Analyst / Developer<br>
                                                                Jorge Izquierdo - Analyst / Developer<br>
                                                                Howard Mosquera - Analyst / Developer<br>
                                                            </p>
                                                        </div>
                                                        <div class="t">
                                                            <p>
                                                                The Productivity Manager system is developed in 2015;
                                                                It is focused on improving business productivity. 
                                                                Modern transparent and focused objectives; taking control of projects, 
                                                                costs, time and used resources.
                                                            </p>									
                                                        </div>
                                                        <div class="t">
                                                            <p>Generating short term benefits that promote a 
                                                                productive increase of Employee and Employer.</p>
                                                            <p class="author">
                                                               Productivity Manager &copy; 2015
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
                                                <a href="index.php">Home</a>
                                                ·
                                                <a href="nuestrosClientes.html">Customers</a>
                                                ·
                                                <a href="index.php">¿Who Are We?</a>					
                                                ·
                                                <a href="contactecnos.html">Contact</a>
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
                       </html>