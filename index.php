<html lang="es">
    <head>
        <title>OohMusic</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="funciones.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
        <?php
        session_start();
        require_once 'bbdd.php';
        require_once 'funciones.php';
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
                    <article>
                        <h4>Conciertos</h4>
                        <div class="listas">
                            <form method="POST">  
                                Buscar: <input id="buscador" type="text" name="buscador" required>
                                <input type="submit" value="buscar" name="buscar2">
                            </form>
                            <?php
                            if (isset($_POST["buscar2"])) {
                                extract($_POST);

                                $resuBusqueda = buscador($buscador);
                                if ($resuBusqueda == -1) {
                                    echo"<br><h1>no encontro nada con este nombre</h1><br>";
                                } else {
                                    echo"<br>";
                                    extract($resuBusqueda);
                                    muestraUsuariosTipo($tipo);
                                    echo"<br>";
                                    echo"<br>Nombre: $nombre<br>";
                                    echo"<br>Email: $email<br>";
                                    if ($tipo == 1) {
                                        echo"<br><h1>Datos Proximo concierto</h1><br>";
                                        $r = mirarConciertosLocal2($nombre, $id_usuario);
                                        while ($fila = mysqli_fetch_assoc($r)) {
                                            extract($fila);
                                            echo"<p>Fecha: $fecha - Artista: $nombreart - Pago: $pago</p>";
                                        }
                                    } 
                                }
                            }
                            ?>
                        </div>

                    </article>
                    <article id="buscador">
                        <p>
                        <form method="POST">  
                            Buscar: <input id="buscador" type="text" name="buscador" required>
                            <input type="submit" value="buscar" name="buscar">
                        </form>

<?php
if (isset($_POST["buscar"])) {
    extract($_POST);

    $resuBusqueda = buscador($buscador);
    if ($resuBusqueda == -1) {
        echo"<br><h1>no encontro nada con este nombre</h1><br>";
    } else {
        echo"<br>";
        extract($resuBusqueda);
        muestraUsuariosTipo($tipo);
        echo"<br>";
        echo"<br>Nombre: $nombre<br>";
        echo"<br>Email: $email<br>";
        $datosconciertos = mirarConciertosLocal($nombre, $id_usuario);
        if ($datosconciertos == -1) {
            if ($tipo == 1) {
                echo"<br>No hay programados conciertos en este local<br>";
            }
        } else {
            extract($datosconciertos);
            echo"<br><h1>Datos Proximo concierto</h1><br>";
            echo"<br>Fecha: $fecha<br>";
            echo"<br>Artista: $nombreart<br>";
            echo"<br>Pago: $pago<br>";
            $nomgenero = mirarGeneroId($genero);
            echo"<br>Genero: $nomgenero<br>";
        }
    }
}
?>


                        </p>
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
if (isset($_GET['cerrar'])) {
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