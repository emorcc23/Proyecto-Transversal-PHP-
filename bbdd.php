<?php

//Desarrollador:Artur
//Elimina un usuario de la tabla principal login
function borralogin($usuario)
{
    $c=conectar();
    $delete = "DELETE FROM login WHERE usuario='$usuario';";
    if (mysqli_query($c, $delete)) {
        return "ok";
    }
    else
    {
        return false;
    }
        
}

//Desarrollador:Artur
//Devuelve el nombre de un usuario
function dimenombre($usuario)
{
    //Conectar con la base de datos
    $c = conectar();
    $select="select nombre from login where usuario='$usuario';";
    $resultado = mysqli_query($c,$select);
    desconectar($c);
    //Si existe el usuario entra en el if
    if($fila = mysqli_fetch_assoc($resultado))
    {
        extract($fila);
        //La función devuelve el nombre del usuario.
        return $nombre;
    }
    else
    {
        //Si no existe el usuario devuelve -1. Este caso no debería cumplirse.
        return -1;
    }
}

function dimeapellidoa($usuario,$tipo)
{
   
}

function dimeapellidob($usuario,$tipo)
{
    
}

//Desarrollador: Artur
//Devuelve el tipo de un usuario
function dimetipousuario($usuario)
{
    //Conexión base de datos
    $c = conectar();
    //Consulta sql
    $select="select tipo from login where usuario='$usuario';";
    $resultado = mysqli_query($c,$select);
    //Enrtra en el if si existe el usuario
    desconectar($c);
    if($fila = mysqli_fetch_assoc($resultado))
    {
        extract($fila);
        //Devuelve el tipo del usuario
        return $tipo;
    }
    else
    {
        //Devuelve -1 si no existe
        return -1;
    }
}

//Desarrollador: Artur
//Comprueba si el usuario y password son correctos
function compruebainicio($usuario,$pass)
{
    //Conectar base de datos
    $c = conectar();
    //Consulta sql cuantos usuarios hay con ese usuario y password.
    $select="select count(id_usuario) as cuantos from login where usuario='$usuario' and pass='$pass';";
    $resultado = mysqli_query($c,$select);
    $fila = mysqli_fetch_assoc($resultado);
    //Devuelve el número de usuarios con ese usuario y password que pueden ser 0 o 1.
    extract($fila);
    desconectar($c);
    return $cuantos;
}

//Desarrollador: Artur
//Detecta si un usuario existe en la base de datos
function usuarioexiste($usuario)
{
    //Conectar base de datos
    $c = conectar();
    //Consulta sql cuantos usuarios hay con es nombre de usuario.
    $select="select count(id_usuario) as cuantos from login where usuario='$usuario';";
    $resultado = mysqli_query($c,$select);
    $fila = mysqli_fetch_assoc($resultado);
    //Devuelve 0 si el usuario no existe o 1 si existe. No pueden haber más de 1.
    extract($fila);
    desconectar($c);
    return $cuantos;
}

//Desarrollador: Artur
//Devuelve la lista de ciudades de una provincia en concreto.
function leeciudades($provincia)
{
    //Conectar base de datos.
    $c = conectar();
    //Consulta sql ciudades de provincia concreta
    $select="select nombre from ciudad where provincia='$provincia';";
    $resultado = mysqli_query($c,$select);
    desconectar($c);
    desconectar($c);
    return $resultado;
}

//Desarrollador: Artur
//Devuelve el ID de una ciudad especificando el nombre.
function dimeidciudad($ciudad)
{
    //Conectar base de datos
    $c = conectar();
    //Consulta sql
    $select="select id_ciudad from ciudad where nombre='$ciudad';";
    $resultado = mysqli_query($c,$select);
    //Entra en el if si se encuentra la ciudad
    desconectar($c);
    if($fila=mysqli_fetch_assoc($resultado))
    {
        extract($fila);
        return $id_ciudad;
        //Devuelve id ciudad
    }
    else
    {
        //Si no se encuentra la ciudad devuelve -1
        return -1;
    }
    desconectar($c);
}

//Desarrollador: Artur
//Da de alta un local en la base de datos con todos sus campos.
function registrar_local($usuario,$pass,$tipo,$nombre,$email,$telefono,$ciudad,$ubicacion,$imagen,$aforo)
{
    //Se da de alta el usuario en la tabla principal de login
    //El método registrar_login devuelve el identificador del alta.
    $idusuario = registrar_login($usuario,$pass,$tipo,$nombre,$email,$telefono,$ciudad);
    if($idusuario != -1)
    {
        //Conectar base de datos
        $c = conectar();
        //Insert para añadir los datos específicos de local en la tabla localm
        $insert = "insert into localm (id_usuario,ubicacion,imagen,aforo,destacado) values ($idusuario,'$ubicacion','$imagen',$aforo,0);";
        if (mysqli_query($c, $insert)) {
            //Si todo ha ido bien se devuelve ok
            $resultado =  "ok";
        } else {
            //Caso de error insertando el local
            $resultado = mysqli_error($c);
            //Por seguridad borro el registro principal ya que no se ha podido añadir el relacionado.
            borralogin($usuario);
        }
        desconectar($c);
        return $resultado;
    }
    else
    {
        //Caso en que ha habido un problema añadiendo el usuario.
        echo"Error añadiendo login.<br>";
        $resultado = -1;
    }
}

//Desarrollador: Artur
//Función que da de alta un usuario, sirve tanto para local, como para músico y fan.
//Se añaden los campos comunes.
function registrar_login($usuario,$pass,$tipo,$nombre,$email,$telefono,$ciudad)
{
    //Se obtiene el id de la ciudad partiendo del nombre.
    $idciudad = dimeidciudad($ciudad);
    if($idciudad!=-1)
    {
        //Conectar base de datos
        $c = conectar();
        //Insert sql registro tabla login
        $insert = "insert into login (usuario,pass,tipo,nombre,email,telefono,ciudad) values ('$usuario','$pass',$tipo,'$nombre','$email','$telefono',$idciudad);";
        if (mysqli_query($c, $insert)) {
            //Si el insert ha ido bien se devuelve el id autonumérico generado en el alta.
            $resultado =  mysqli_insert_id($c);
        } else {
            //Caso de error en el alta.
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

//Desarrollador: Artur
// Función que conecta a la base de datos 
function conectar() {
    $conexion = mysqli_connect("localhost", "arturv", "ticmysql82", "musica");
    // Si no ha ido bien la conexión
    if (!$conexion) {
        die("No se ha podido establecer la conexión");
    }
    return $conexion;
}

//Desarrollador: Artur
// Función que cierra una conexión con la base de datos
function desconectar($conexion) {
    mysqli_close($conexion);
}

?>