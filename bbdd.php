<?php

function registrar_local($usuario,$pass,$tipo,$nombre,$email,$telefono,$ciudad,$ubicacion,$imagen,$aforo,$destacado)
{
    $idusuario = registrar_login($usuario,$pass,$tipo,$nombre,$email,$telefono,$ciudad);
    if($idusuario != -1)
    {
        $c = conectar();
        $insert = "insert into localm (id_usuario,ubicacion,imagen,aforo,destacado) values ($idusuario,'$ubicacion','$imagen',$aforo,$destacado);";
        if (mysqli_query($c, $insert)) {
            $resultado =  "ok";
        } else {
            $resultado = mysqli_error();
        }
        desconectar($c);
        return $resultado;
    }
    else
    {
        echo"Error añadiendo login.<br>";
        $resultado = -1;
    }
  
   
}

function registrar_login($usuario,$pass,$tipo,$nombre,$email,$telefono,$ciudad)
{
    $c = conectar();
    $insert = "insert into login (usuario,pass,tipo,nombre,email,telefono,ciudad) values ('$usuario','$pass',$tipo,'$nombre','$email','$telefono',$ciudad);";
    if (mysqli_query($c, $insert)) {
        $resultado =  mysql_insert_id();
    } else {
        $resultado = -1;
    }
    desconectar($c);
    return $resultado;
}

// Función que conecta a la base de datos 
function conectar() {
    $conexion = mysqli_connect("localhost", "arturv", "ticmysql82", "stukemon");
    // Si no ha ido bien la conexión
    if (!$conexion) {
        die("No se ha podido establecer la conexión");
    }
    return $conexion;
}

// Función que cierra una conexión con la base de datos
function desconectar($conexion) {
    mysqli_close($conexion);
}

?>