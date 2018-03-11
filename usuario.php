<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosFan.css">
    </head>
    <body>
        <header>
            <div class="contenedor">
                <h1 class="icon-music">Ooh Music</h1>
                <input type="checkbox" id="menu-bar">
                <label class="icon-menu" for="menu-bar"></label>
                <nav class="menu">
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li class="submenu"><a href="">Registro <span class="icon-down-dir"></span></a>
                            <ul class="submenuu">
                                <li><a href="rmusicos.php">Regístrate como músico</a></li>
                                <li><a href="rlocales.php">Regístrate como local</a></li>
                                <li><a href="rfan.php">Regístrate como fan</a></li>
                            </ul>
                        </li>
                        <li><a href="musicos.php">Musicos</a></li>
                        <li><a href="locales.php">Locales</a></li>
                        <li><a href="fans.php">Fans</a></li>
                        <li><a href="contacto.php">Contacto</a></li>
                    </ul>
                    
                </nav>
            </div>
        </header>       
        <main>
            <section id="banner">
                <?php
                require_once 'bbdd.php';
                session_start();
                $mostrar=0;
                if(isset($_POST['username']))
                {
                    extract($_POST);
                    if(compruebainicio($username,$pass)==1)
                    {
                        $_SESSION['username']=$username;
                        $_SESSION['tipo']=dimetipousuario($username);
                        $mostrar=1;
                    }
                    else
                    {
                        echo"Nombre de usuario o contraseña incorrectos.<br>";
                    }
                }
                elseif(isset($_SESSION['username']))
                {
                    //por seguridad compruebo si el usuario existe
                    if(usuarioexiste($_SESSION['username'])>0)
                    {
                        $mostrar=1;
                    }
                    else
                    {
                        echo"El usuario ya no existe.<br>";
                    }
                }
                else
                {
                    echo"No puedes entrar aquí.<br>";
                }
                if($mostrar==1)
                {
                 
                    ?>
                    <img src="Imagenes/banner.jpg">
                    <div id="centro"> 
                        <p>Bienvenido</p>
                        <div id="usuario">
                            <?php
                            extract($_SESSION);
                            switch($tipo)
                            {
                                case 0:
                                    echo"Usuario Administador.<br>";
                                    break;
                                case 1:
                                    echo"Local musical<br>";
                                    break;
                                case 2:
                                    echo"Músico<br>";
                                    break;
                                case 3:
                                    echo"Fan<br>";
                                    break;
                            } 
                            $nombre = dimenombre($username);
                            
                            echo"<p>$nombre</p>";
                            
                            if($tipo==2 || $tipo==3)
                            {
                                $apellidoa=dimeapellidoa($username,$tipo);
                                $apellidob=dimeapellidob($username,$tipo);
                                echo"<p><b>Apellidos:</b> $apellidoa $apellidob";
                            }
                            ?>
                            
                            <hr>
                            <div id="info">
                                <img src="Imagenes/usuario.png">
                            </div>
                        </div>
                       <div id="menu">
                            <ul>
                                <li><a href="miperfillocal.php">Perfil</a></li>
                                <li><a href="#">Fotos</a></li>
                                <li><a href="#">Mensajes</a></li>
                                <li><a href="#">Configuración</a></li>
                                <li><a href="#">Cerrar sesión</a></li>
                            </ul>
                        </div>
                        <div id="titulonoticias">
                            <p>Últimas noticias</p>
                        </div>
                        <div id="noticias">
                        </div>
                    </div>  
                    <?php                
                } 
                ?>
                        
            </section>
        </main>
        <footer>
            <div class="contenedor">
                <p class="copy">Ooh Music &copy; 2018</p>
                <div class="sociales">
                    <a class="icon-facebook-squared" href="#"></a>
                    <a class="icon-twitter" href="#"></a>
                    <a class="icon-instagram" href="#"></a>
                    <a class="icon-gmail" href="#"></a>
                </div>
            </div>
            
        </footer>
    </body>
</html>