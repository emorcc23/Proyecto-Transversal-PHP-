<!DOCTYPE html>
<!--
Esta es la pagina para registrar locales. 
-->
<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estiloslogin.css">
    </head>
    <body>
        <header>
            <div class="contenedor">
                <h1 class="icon-music">Ooh Music</h1>
                <input type="checkbox" id="menu-bar">
                <label class="icon-menu" for="menu-bar"></label>
                <nav class="menu">
                    <a href="index.php">Inicio</a>
                    <a href="login.php">Login</a>
                    <a href="rmusicos.php">Registro</a>
                    <a href="musicos.php">Musicos</a>
                    <a href="locales.php">Locales</a>
                    <a href="fans.php">Fans</a>
                    <a href="contacto.php">Contacto</a>
                </nav>
            </div>
        </header>

        <main>
            <section id="banner">
                <img src="Imagenes/banner.jpg">
                <div class="contenedor">
                    <nav class="login">
                        <form action="" method="POST">
                            <p>Usuario</p>
                            <p><input type="text" name="user" required></p>
                            <p>Nombre</p>
                            <p><input type="text" name="name" required></p>
                            <p>Ciudad</p>
                            <p><input type="text" name="city"></p>
                            <p>Ubicacion</p>
                            <p><input type="text" name="ubication"></p>
                            <p>Email</p>
                            <p><input type="text" name="email" required></p>
                            <p>Telefono</p>
                            <p><input type="number" name="phone" required></p>
                            <p>Imagen</p>
                            <p><input type="text" name="image"></p>
                            <p>Aforo</p>
                            <p><input type="number" name="capacity" min="1" required></p>
                            <p>Nombre(Artistico)</p>
                            <p><input type="text" name="nickname"></p>
                            <p>Genero</p>
                            <p><input type="text" name="gender" required></p>
                            <p>Contraseña</p>
                            <p><input type="password" name="pass"></p>
                            <p>Contraseña</p>
                            <p><input type="password" name="pass2"></p>
                            <p><input type="submit" value="siguiente" name="next"></p>
                        </form>
                    </nav>    

                </div>
            </section>

        </main>

        <?php
        if (isset($_POST["next"])) {
            $user = $_POST["user"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $surname2 = $_POST["surname2"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $pass = $_POST["pass"];
            $pass2 = $_POST["pass2"];
            $city = $_POST["city"];
        }
        ?>
    </body>
</html>
