<?php

//Desarrollador: Álvaro
//Muestra los datos de perfil de fan
function muestradatosfan() {
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

//Desarrolador Isain
//Muestra los datos del perfil del musico
function muestradatosmusico(){
    extract($_SESSION);
    if($tipo == 2){
        echo"Musicos";
    }
    
    $nombre = dimenombre($username);
    
    echo"<p>$nombre</p>";
    echo"<hr>";
     echo"<div id='info'>";
    echo"<img src='Imagenes/usuario.png'>";
    echo"</div>";

}

//Desarrollador Artur
//Muestra los datos del perfil del local en los campos informativos.
function muestradatoslocal()
{
    extract($_SESSION);
    switch($tipo)
    {
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

//funcion para cerrar session
function cerraSession(){    
      session_destroy();
      echo"Sesión cerrada";
}

function cerraSession2(){
    echo"<form action='' method='POST'>";
    echo"<input type='submit' name='cerrar' value='CERRAR SESION'>";
    echo"</form>";
                
    if(isset($_POST["cerrar"])){
      session_destroy();
//      header("Location: index.php");
      echo"sesion cerrada";
      header("Refresh:3; url=index.php");
      exit;
    }
}
?>