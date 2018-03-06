<?php

function dimenombre($usuario)
{
    $c = conectar();
    $select="select nombre from login where usuario='$usuario';";
    $resultado = mysqli_query($c,$select);
    if($fila = mysqli_fetch_assoc($resultado))
    {
        extract($fila);
        return $nombre;
    }
    else
    {
        return -1;
    }
}

function dimeapellidoa($usuario,$tipo)
{
   
}

function dimeapellidob($usuario,$tipo)
{
    
}

function dimetipousuario($usuario)
{
    $c = conectar();
    $select="select tipo from login where usuario='$usuario';";
    $resultado = mysqli_query($c,$select);
    if($fila = mysqli_fetch_assoc($resultado))
    {
        extract($fila);
        return $tipo;
    }
    else
    {
        return -1;
    }
}

function compruebainicio($usuario,$pass)
{
    $c = conectar();
    $select="select count(id_usuario) as cuantos from login where usuario='$usuario' and pass='$pass';";
    $resultado = mysqli_query($c,$select);
    $fila = mysqli_fetch_assoc($resultado);
    extract($fila);
    return $cuantos;
}

function usuarioexiste($usuario)
{
    $c = conectar();
    $select="select count(id_usuario) as cuantos from login where usuario='$usuario';";
    $resultado = mysqli_query($c,$select);
    $fila = mysqli_fetch_assoc($resultado);
    extract($fila);
    return $cuantos;
}

function leeciudades($provincia)
{
    $c = conectar();
    $select="select nombre from ciudad where provincia='$provincia';";
    $resultado = mysqli_query($c,$select);
    desconectar($c);
    return $resultado;
}

function dimeidciudad($ciudad)
{
    $c = conectar();
    $select="select id_ciudad from ciudad where nombre='$ciudad';";
    $resultado = mysqli_query($c,$select);
    if($fila=mysqli_fetch_assoc($resultado))
    {
        extract($fila);
        return $id_ciudad;
    }
    else
    {
        return -1;
    }
    desconectar($c);
}

function registrar_local($usuario,$pass,$tipo,$nombre,$email,$telefono,$ciudad,$ubicacion,$imagen,$aforo)
{
    $idusuario = registrar_login($usuario,$pass,$tipo,$nombre,$email,$telefono,$ciudad);
    if($idusuario != -1)
    {
        $c = conectar();
        $insert = "insert into localm (id_usuario,ubicacion,imagen,aforo,destacado) values ($idusuario,'$ubicacion','$imagen',$aforo,0);";
        if (mysqli_query($c, $insert)) {
            $resultado =  "ok";
        } else {
            $resultado = mysqli_error($c);
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
    $idciudad = dimeidciudad($ciudad);
    if($idciudad!=-1)
    {
        $c = conectar();
        $insert = "insert into login (usuario,pass,tipo,nombre,email,telefono,ciudad) values ('$usuario','$pass',$tipo,'$nombre','$email','$telefono',$idciudad);";
        if (mysqli_query($c, $insert)) {
            $resultado =  mysqli_insert_id($c);
        } else {
            echo"Error añadiendo login.";
            $resultado = -1;
        }
        desconectar($c);
        return $resultado;
    }
    else
    {
        echo"Error consultando el id de ciudad.";
        return -1;
    } 
}

// Función que conecta a la base de datos 
function conectar() {
    $conexion = mysqli_connect("localhost", "arturv", "ticmysql82", "musica");
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