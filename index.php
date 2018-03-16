<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
        <?php
            session_start();
        ?>
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
                <div class="contenedor">
                    <h2>Música para todos</h2>
                    <p>Nuevos conciertos en tu ciudad</p>
                    <a href="#">Leer más</a>
                </div>
            </section>

            <section id="bienvenidos">
                <h2>Bienvenidos</h2>
                <p>En nuestra página podrás disfrutar de todos los conciertos de tu ciudad con solo un clik, apoyar a tus artistas favoritos o hacerte fan.</p>
            </section>
            
            <section id="blog">
                <h3>Aquí tienes a nuestros locales y músicos ¡Échales un ojo!</h3>
                <div class="contenedor">
                    <article>
                        <h4>Locales</h4>
                        <div class="listas">
                            <?php
                            require_once 'bbdd.php';
                            $locales = listalocalesordenadosporciudad();
                            while ($ellocal = mysqli_fetch_assoc($locales)) {
                                extract($ellocal);
                                echo"<p>$nombre - $ciudad</p><hr>";
                            }
                            ?>

                        </div>
                    </article>
                    <article>
                        <h4>Músicos</h4>
                        <div class="listas">
                            <?php
                            $listamusicos = ordenarMusicosPorGenero();
                            while ($musicos = mysqli_fetch_assoc($listamusicos)) {
                                extract($musicos);
                                echo"<p>$nombreart - $nombre</p><hr>";
                            }
                            ?>


                        </div>
                    </article>
                </div>
            </section>

            <section id="info">
                <h3>¡Vívelo! No solo es música...</h3>
                <div class="contenedor">
                    <div class="info-music">
                        <img src="Imagenes/clasica.jpg">
                        <h4>Música clásica</h4>
                    </div>
                    <div class="info-music">
                        <img src="Imagenes/hiphop.jpg">
                        <h4>Musica Hip Hop</h4>
                    </div>
                    <div class="info-music">
                        <img src="Imagenes/rock.jpg">
                        <h4>Música Rock</h4>
                    </div>
                    <div class="info-music">
                        <img src="Imagenes/electronica.jpg">
                        <h4>Música electrónica</h4>
                    </div>
                </div>
            </section>
            <?php
                if(isset($_GET['cerrar']))
                {
                    cerraSession();
                }
            ?>
            
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