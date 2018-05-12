<!DOCTYPE html>
<!--
Esta es la pagina para registrar musicos. 
-->
<!DOCTYPE html>
<?php
require_once 'bbdd.php';
require_once 'funciones.php';
?>
<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosRmusico.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="funciones.js"></script>
    </head>
    <body>
        <header>
            <div class="contenedor">
                <h1 class="icon-music">Ooh Music</h1>
                <!-- Segundo -->
                <input type="checkbox" id="menu-user">
                <label id="label1" class="icon-user-circle" for="menu-user"></label>
                <!-- Primero -->
                <input type="checkbox" id="menu-bar">
                <label class="icon-menu" for="menu-bar"></label>
                <nav class="menuuser">
                    <a href="#">Mi perfil</a>
                    <a href="index.php">Cerrar sesión</a>
                </nav>
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
                <div id="formulario">
                    <script>
                        function verificar() {
                            var pass1 = document.getElementById("pass1").value;
                            var pass2 = document.getElementById("pass2").value;
                            if (pass1 != pass2) {
                                alert("Las contraseñas no son iguales");
                                return false;
                            }

                    </script>
                    <?php
                    if (isset($_POST['next'])) {
                        extract($_POST);
                        $target_file=subefoto();
                        
                        if (usuarioexiste($username) > 0) {
                            echo "<script>alert('Error. El usuario que deseas dar de alta ya existe')</script>";
                            //echo"Error. El usuario que deseas dar de alta ya existe.";
                        } else {
                            $idgenero = dimeidgenero($gender);
                            if (registrar_musico($username, $pass1, 2, $name, $mail, $phone, $city, $surname1, $surname2, $web, $nickname, $components, $idgenero,$target_file) == "ok") {
                                echo"<script>alert('Se ha registrado el musico correctamente')</script>";
                                header("Refresh:0; url=login.php");
                                //echo"Se ha registrado el musico correctamente";
                                
                            } else {
                                echo "<script>alert('Error al registrar músico')</script>";
                                //echo"Error al registrar musico";
                            }
                        }
                    } else {
                        ?>
                        <form action="" method="POST" onsubmit="verificar();" enctype="multipart/form-data">  
                            <table>
                                <tr>
                                    <td>
                                        <p>Nombre:</p>
                                        <p><input type="text" name="name" ></p>
                                    </td>
                                    <td>
                                        <p>Nombre de usuario:</p>
                                        <p><input type="text" name="username" ></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Primer apellido:</p>
                                        <p><input type="text" name="surname1" ></p>
                                    </td>
                                    <td>
                                        <p>Contraseña:</p>
                                        <p><input type="password" name="pass1" id="pass1" ></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Segundo apellido:</p>
                                        <p><input type="text" name="surname2" ></p>
                                    </td>
                                    <td>
                                        <p>Repetir contraseña:</p>
                                        <p><input type="password" name="pass2" id="pass2"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Teléfono:</p>
                                        <p><input type="tel" name="phone" ></p>
                                    </td>
                                    <td>
                                        <p>Nombre artístico:</p>
                                        <p><input type="text" name="nickname" ></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Email:</p>
                                        <p><input type="email" name="mail" ></p>
                                    </td>
                                    <td>
                                        <p>Componentes del grupo:</p>
                                        <p><input type="number" name="components" ></p>
                                    </td>
                                     <td>
                                        <p>Imagen:</p>
                                        <p>
                                            <input type="file" accept=".jpeg,.png" name="fileupload" id="fileupload">
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <p>Provincia:</p><p><select id="provincia">
                                            <?php
                                                $provincias = dimeprovincias();
                                                $cont=0;
                                                while($fila=mysqli_fetch_assoc($provincias))
                                                {
                                                    extract($fila);
                                                    if($cont==0)
                                                    {
                                                        $primeraprovincia = $provincia;
                                                        $cont++;
                                                    }
                                                    echo"<option value='$provincia'>$provincia</option>";
                                                }
                                            ?>
       
                                            </select></p>
                                        <p>Ciudad:</p>
                                        <p><select name="city" id="city" required>
                                                <?php
                                                
                                                $ciudades = leeciudades($primeraprovincia);
                                                while ($fila = mysqli_fetch_assoc($ciudades)) {
                                                    extract($fila);
                                                    echo"<option value='$id_ciudad'>$nombre</option>";
                                                }
                                                ?>
                                            </select></p>
                                    </td>
                                    <td>
                                        <p>Web:</p>
                                        <p><input type="text" name="web" ></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <p>Género:</p>
                                        <p><select name="gender">
                                                <option value="clasica">Clásica</option>    
                                                <option value="Hip hop">Hip hop</option>
                                                <option value="rock">Rock</option>
                                                <option value="electronica">Electrónica</option>
                                            </select></p>
                                    </td>
                                </tr>
                            </table>
                            <br><br><br>
                            <p><input type="submit" value="Registrarme como músico" id="button" name="next" ></p>
                        </form>
                        <?php
                    }
                    ?>

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
