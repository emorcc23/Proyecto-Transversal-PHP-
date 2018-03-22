<?php
    session_start(); 
    require_once 'bbdd.php';
    require_once 'funciones.php';
?>
<!DOCTYPE html>
<!--
Pagina de locales.
-->
<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosMiperfilLocal.css">
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
                <img src="Imagenes/banner.jpg">
                <div id="centro"> 
                    <p>Datos de mi perfil</p>
                    <div id="usuario">
                        <?php
                        muestradatoslocal();
                        
                        ?>
                    </div>
                        
                    <div id="menu">
                        <ul>
                            <li><a href="usuariolocal.php">Perfil</a></li>
                            <li><a href="#">Fotos</a></li>
                            <li><a href="#">Mensajes</a></li>
                            <li><a href="miperfillocal.php">Configuración</a></li>
                       
                            <li><a href="index.php?cerrar=1" value=''>Cerrar sesión</a></li>
                        </ul>
                    </div>
    <script>
                        function abrirParametros() {
                            var ventana=open('','','status=yes,width=400,height=250,menubar=yes');
                            ventana.document.write("<style>");
                            ventana.document.write("backgound: rgba(51,51,51,0.8);")
                            ventana.document.write("</style>");
                            ventana.document.write("\x3Cscript type='text/javascript' src='funciones.js'>\x3C/script>");
                            ventana.document.write("<form method='post' action='modipass.php' onsubmit='return verificapass();'>");
                            ventana.document.write("<p>Introduce tu contraseña actual:</p>");
                            ventana.document.write("<p><input type='password' name='passactual' required></p>");
                            ventana.document.write("<p>Introduce la nueva contraseña:</p>");
                            ventana.document.write("<p><input type='password' name='pass1' id='pass1' required></p>");
                            ventana.document.write("<p>Repite tu nueva contraseña:</p>");
                            ventana.document.write("<p><input type='password' name='pass2' id='pass2' required></p>");
                            ventana.document.write("<p><input type='submit' value='Cambiar contraseña'></p>");
                            ventana.document.write("</form>");
                        }
                    </script>
                    <?php
                    if(isset($_POST['name']))
                    {
                        extract($_POST);
                        extract($_SESSION);
                        //Hacer la modificación.
                        if(modificaperfillocal($username,$name,$email,$phone,$city,$location,'',$aforo)=="ok")
                        {
                            echo"<script>alert('Modificación realizada')</script>";
                            
                        }
                        else
                        {
                            echo"Error modificando perfil de local.<br>";
                        }  
                    } 
                 
                        
                    ?>
                    <div id="miperfil">
                        <p id="tituloperfil">Modificar datos</p>
                        <div id="formulariodatos">
                            <form method="post">  
                                <table>
                                    <?php
                                    
                                    if(isset($_SESSION['username']))
                                    {
                                        extract($_SESSION);
                                        $perfil=leeperfillocal($username);
                                        if($datos=mysqli_fetch_assoc($perfil))
                                        {
                                            extract($datos);
                                            echo"<tr><td><p>Nombre:<input type='text' id='nombre' name='name' value='$nombre' required></p></td>";
                                            echo"<td><p>Ubicación:<input type='text' name='location' value='$ubicacion' required></p></td></tr>";   
                                            echo"<tr><td><p>Email:<input type='email' name='email' value='$email' required></p></td>";      
                                            echo"<td><p>Aforo:<input type='number' name='aforo' value='$aforo' required></p></td></tr>";
                                            echo"<tr><td><p>Teléfono:<input type='tel' name='phone' value='$telefono' required></p></td>";
                                            echo"<td><p>Nombre de usuario:$username</p></td></tr>";
                                            echo"<tr><td><p>Ciudad:<select id='select' name='city'>";
                                            $ciudades = leeciudades("Barcelona");
                                            while($fila = mysqli_fetch_assoc($ciudades))
                                            {
                                                extract($fila);
                                                if ($id_ciudad==$ciudad)
                                                {
                                                    echo"<option value='$id_ciudad' selected>$nombre</option>";
                                                }
                                                else
                                                {
                                                    echo"<option value='$id_ciudad'>$nombre</option>";
                                                }
                                                
                                            }
                                            
                                            echo"</select></p></td>";
                                            
                                            echo"<td><p>Imagen:<input type='button' value='Seleccionar imagen'></p></td></tr>";
                                        }
                                        else
                                        {
                                            echo"El usuario se ha eliminado.<br>";
                                        }
                                    }
                                    else
                                    {
                                        echo"No puedes entrar aquí.<br>";
                                    }
                                    
                                    
                                ?>
                                </table>
                                <br><br><br>
                                <p><input type="button" value="Cambiar contraseña" id="contraseña" onClick="abrirParametros()"></p>
                            <p><input type="submit" value="Modificar datos de perfil" id="button"></p>
                    </form>
                        </div>
                    </div>
                 
                </div>
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