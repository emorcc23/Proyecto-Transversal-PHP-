<!DOCTYPE html>
<!--
Esta es la pagina para registrar musicos. 
-->
<!DOCTYPE html>
<?php
require_once 'bbdd.php';
?>
<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosRmusico.css">
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
                        if (usuarioexiste($username) > 0) {
                            echo"Error. El usuario que deseas dar de alta ya existe.";
                        } else {
                            $idgenero = dimeidgenero($gender);
                            if (registrar_musico($username, $pass1, 2, $name, $mail, $phone, $city, $surname1, $surname2, $web, $nickname, $components, $idgenero) == "ok") {
                                echo"Se ha registrado el musico correctamente";
                            } else {
                                echo"Error al registrar musico";
                            }
                        }
                    } else {
                        ?>
                        <form action="" method="POST" onsubmit="verificar();">  
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
                                </tr>
                                <tr>
                                    <td>
                                        <p>Ciudad:</p>
                                        <p><select name="city">
                                                <?php
                                                $ciudades = leeciudades("Barcelona");
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
