<!DOCTYPE html>
<!--
Pagina de contacto.
-->

<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosContacto.css">
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
                    <p>Contacto</p>
                    <div id="informulario">
                        <form>
                            <p class="pe">Nombre:</p>
                            <p><input type="text"></p>
                            <p class="pe">Apellidos:</p>
                            <p><input type="text"></p>
                            <p class="pe">Email:</p>
                            <p><input type="email"></p>
                            <p class="pe">Teléfono:</p>
                            <p><input type="tel"></p>
                            <p>¿Cómo nos ha conocido?</p>
                            <p><select name="conocer">
                                <option value="">Ubicación</option>
                                <option value="">Cliente-Excliente</option>
                                <option value="">Recomendación</option>
                                <option value="">Internet</option>
                                <option value="">Otro</option>
                            </select></p>
                            <div id="comentario">
                            <p>Comentario:</p>
                                <p><textarea id="textarea">
                                
                                </textarea></p>
                            </div>
                            <input type="submit" value="Enviar">
                        </form>
                        <div id="informacion">
                            <p id="titulo">Ooh Music</p>
                            <p class="infoo">Teléfono: 93 301 25 68</p>
                            <p class="infoo">Fax: 93 301 25 68</p>
                            <p class="infoo">E-Mail: info@oohmusic.com</p>
                            <p></p>
                            <p class="infoo">C/. Pelai, 8</p>
                            <p class="infoo">08001</p>
                            <p></p>
                            <p></p>
                            <p class="infoo">Horario: Lunes a viernes de 7:45 a 20:30</p>
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