<?php
require_once 'bbdd.php';
?>
<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosRlocal.css">
        <script type="text/javascript" src="funciones.js"></script>

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
                    <?php
                    if (isset($_POST['name'])) {
                        extract($_POST);
                        if (usuarioexiste($username) > 0) {
                            echo"Error. El usuario que deseas dar de alta ya existe.";
                        } else {


                            if (registrar_local($username, $pass1, $name, $mail, $phone, $city, $location, "", $aforo) == "ok") {
                                echo"<script>alert('Se ha registrado el local correctamente')</script>";
                                header("Refresh:0; url=login.php");
                            } else {
                                echo"Error registrando local.<br>";
                            }
                        }
                    } else {
                        ?>
                        <form method="post" onsubmit="return verificapass()">  
                            <table>
                                <tr>
                                    <td>
                                        <p>Nombre:</p>
                                        <p><input type="text" name="name" required></p>
                                    </td>
                                    <td>
                                        <p>Nombre de usuario:</p>
                                        <p><input type="text" name="username" required></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Email:</p>
                                        <p><input type="email" name="mail"></p>
                                    </td>
                                    <td>

                                        <p>Contraseña:</p>
                                        <p><input type="password" name="pass1" id="pass1" required></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Teléfono:</p>
                                        <p><input type="tel" name="phone"></p>
                                    </td>
                                    <td>
                                        <p>Repetir contraseña:</p>
                                        <p><input type="password" name="pass2" id="pass2" required></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Ciudad:</p>
                                        <p><select name="city" required>-->
    <?php
    $ciudades = leeciudades("Barcelona");
    while ($fila = mysqli_fetch_assoc($ciudades)) {
        extract($fila);
        echo"<option value='$id_ciudad'>$nombre</option>";
    }
    ?>
                                            </select></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Ubicación:</p>
                                        <p><input type="text" name="location" required></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Imagen:</p>
                                        <p><input type="button" value="Seleccionar imagen"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Aforo:</p>
                                        <p><input type="number" name="aforo" required></p>
                                    </td>
                                </tr>
                            </table>
                            <br><br><br>
                            <p><input type="submit" value="Registrarme como local" id="button"></p>
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