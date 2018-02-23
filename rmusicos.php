<!DOCTYPE html>
<!--
Esta es la pagina para registrar usaurios. 
-->
<!DOCTYPE html>
<!--
Pagina login
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
                        <p>Usuario</p>
                        <p><input type="text" required></p>
                        <p>Nombre</p>
                        <p><input type="text" required></p>
                        <p>Apellido</p>
                        <p><input type="text" ></p>
                        <p>Apellido</p>
                        <p><input type="text"></p>
                        <p>Telefono</p>
                        <p><input type="number" required></p>
                        <p>Email</p>
                        <p><input type="text" required></p>
                        <p>Web</p>
                        <p><input type="text"></p>
                        <p>Componentes</p>
                        <p><input type="number" min="1" required></p>
                        <p>Nombre(Artistico)</p>
                        <p><input type="text"></p>
                        <p>Genero</p>
                        <p><input type="text" required></p>
                        <p>Contraseña</p>
                        <p><input type="password"></p>
                        <p><input type="submit" value="siguiente" name=""></p>
                    </nav>    
                        
                </div>
            </section>
            
        </main>
    </body>
</html>
