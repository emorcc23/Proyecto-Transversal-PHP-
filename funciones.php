<?php
//Desarrollador: Isain
//Muestra Usuario segun tipo
function muestraUsuariosTipo($tipo){
    switch ($tipo){
        case 1:
            echo"<p>Local</p>";
            break;
        case 2:
            echo"<p>Musico</p>";
            break;
        case 3:
            echo"<p>Fan</p>";
            break;
        default;
    }
}

//Desarrollador:Artur
//Devuelve el nombre de un género por el id
function dimenombregenero($idgenero)
{
    $c = conectar();
    //Sentencia SQL. No se leen todos los campos, solo los principales.
    $select = "select nombre from genero where id_genero=$idgenero;";
    $resultado = mysqli_query($c, $select);
    if($fila=mysqli_fetch_assoc($resultado))
    {
        $salida = $fila['nombre'];
    }
    else
    {
        $salida="no";
    }
    desconectar($c);
    return $salida;
}

//Desarrollador: Artur
//Muestra cual es el estado del concierto según el código
function cualestado($num)
{
    switch($num)
    {
        case 0:$cual="Propuesto sin músico";
            break;
        case 1:$cual="Por confirmar";
            break;
        case 2:$cual="Programado";
            break;
        case 3:$cual="Cancelado";
            break;
        default:
    }
    return $cual;
}

//Desarrollador: Álvaro
//Muestra los datos de perfil de fan
function muestradatosfan() {
    if (isset($_SESSION['tipo'])) {
        extract($_SESSION);
        if ($tipo == 3) {
            echo "Fan<br>";
            $nombre = dimenombre($username);
            echo "<p>$nombre</p>";
            echo "<hr>";
            echo "<div id='info'>";
            echo "<img src='Imagenes/usuario.png'>";
            echo "</div>";
        }
    }
}

//Desarrolador Isain
//Muestra los datos del perfil del musico
function muestradatosmusico() {
    if (isset($_SESSION['tipo'])) {
        extract($_SESSION);
        if ($tipo == 2) {
            echo"Musicos";
        }

        $nombre = dimenombre($username);

        echo"<p>$nombre</p>";
        echo"<hr>";
        echo"<div id='info'>";
        echo"<img src='Imagenes/usuario.png'>";
        echo"</div>";
    }
}

//Desarrollador Artur
//Muestra los datos del perfil del local en los campos informativos.
function muestradatoslocal() {
    if (isset($_SESSION['tipo'])) {
        extract($_SESSION);
        switch ($tipo) {
            case 0:
                echo"Usuario Administador.<br>";
                break;
            case 1:
                echo"Local musical<br>";
                break;
            case 2:
                echo"Músico<br>";
                break;
            case 3:
                echo"Fan<br>";
                break;
        }
        $nombre = dimenombre($username);

        echo"<p>$nombre</p>";
        echo"<hr>";
        echo"<div id='info'>";
        echo"<img src='Imagenes/usuario.png'>";
        echo"</div>";
    }
}

//funcion para cerrar session
function cerraSession() {
    session_destroy();
    echo"Sesión cerrada";
}

function cerraSession2() {
    echo"<form action='' method='POST'>";
    echo"<input id='botoncerrar' type='submit' name='cerrar' value='CERRAR SESSION'>";
    echo"</form>";

    if (isset($_POST["cerrar"])) {
        session_destroy();
//      header("Location: index.php");
        echo"<script>alert('sesion cerrada')</script>";
        header("Refresh:1; url=index.php");
        exit;
    }
}
?>
