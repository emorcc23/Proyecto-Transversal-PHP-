<!DOCTYPE html>
<!--
Esta es la pagina para registrar fans. 
-->

<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosRfan.css">
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
                            <form>  
                                <table>
                                    <tr>
                                        <td>
                                            <p>Nombre:</p>
                                            <p><input type="text" name="name"></p>
                                        </td>
                                        <td>
                                            <p>Nombre de usuario:</p>
                                            <p><input type="text" name="username"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Primer apellido:</p>
                                            <p><input type="text" name="surname1"></p>
                                        </td>
                                        <td>
                                            <p>Contraseña:</p>
                                            <p><input type="password" name="pass1"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Segundo apellido:</p>
                                            <p><input type="text" name="surname2"></p>
                                        </td>
                                        <td>
                                            <p>Repetir contraseña:</p>
                                            <p><input type="password"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Teléfono:</p>
                                            <p><input type="tel" name="phone"></p>
                                        </td>
                                        <td>
                                            <p>Imagen:</p>
                                            <p><input type="button" value="Seleccionar imagen"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Email:</p>
                                            <p><input type="mail" name="mail"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Ciudad:</p>
                                            <p><select name="city">
                                                    <option value="barcelona">
                                                        Barcelona
                                                    </option>
                                                    <option value="madrid">
                                                        Madrid
                                                    </option>
                                                    <option value="sevilla">
                                                        Sevilla
                                                    </option>
                                                </select></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Dirección:</p>
                                            <p><input type="text" name="address"></p>
                                        </td>
                                    </tr>
                                </table>
                            <br><br><br>
                            <p><input type="submit" value="Registrarme como fan" id="button"></p>
                    </form>
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

        <?php
        if (isset($_POST["boton"])) {
            
            $username = $_POST['username'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $name = $_POST['name'];
            $surname1 = $_POST['surname1'];
            $surname2 = $_POST['surname2'];
            $phone = $_POST['phone'];
            $mail = $_POST['mail'];
            $city = $_POST ['city'];
            $address = $_POST['address'];
            
            echo "Nombre de usuario: $username";
            echo "<br>";
            echo "Contraseña 1: $pass1";
            echo "<br>";
            echo "Contraseña 2: $pass2";
            echo "<br>";
            echo "Nombre: $name";
            echo "<br>";
            echo "Apellido 1: $surname1";
            echo "<br>";
            echo "Apellido 2: $surname2";
            echo "<br>";
            echo "Teléfono: $phone";
            echo "<br>";
            echo "Email: $mail";
            echo "<br>";
            echo "Ciudad: $city";
            echo "<br>";
            echo "Direccion: $address";
        }
        ?>
    </body>
</html>
