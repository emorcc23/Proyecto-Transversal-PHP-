<?php

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

//Desarrollador:Isain Alvaro
//Ordenar Musicos ordenados por genero musical
function ordenarMusicosPorGenero(){
    $c = conectar();
    $select = "select musico.nombreart from musico inner join genero on musico.genero = genero.id_genero order by genero.id_genero;";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

//Desarrollador:Isain
//Registrar un musico
function dimeidgenero($gender) {
    $c = conectar();
    $select = "select id_genero from genero where nombre='$gender'";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    if ($fila = mysqli_fetch_assoc($resultado)) {
        extract($fila);
        return $id_genero;
    } else {
        // sino no encuentra nada devuelve -1
        return -1;
    }
}

//Desarrollador:Isain
//Registrar un musico
function registrar_musico($usuario, $pass, $tipo, $nombre, $email, $telefono, $ciudad, $surname1, $surname2, $web, $nickname, $components, $gender) {

    //llamamos a la funcion de registrar_login para obtener el idusuario
    $idusuario = registrar_login($usuario, $pass, $tipo, $nombre, $email, $telefono, $ciudad);
    if ($idusuario != -1) {
        $c = conectar();
        $insert = "INSERT INTO `musica`.`musico` (`id_usuario`, `apellidoa`, `apellidob`, `web`, `nombreart`, `componentes`, `destacado`,`genero`) VALUES ('$idusuario', '$surname1', '$surname2', '$web', '$nickname', '$components', '0','$gender')";
        if (mysqli_query($c, $insert)) {
            $resultado = "ok";
        } else {
            $resultado = mysqli_error($c);
            borralogin($usuario);
        }
        desconectar($c);
        return $resultado;
    } else {
        echo"Error añadiendo el musico";
        $resultado = -1;
    }
}

//Desarrollador:Isain
//Registrar un fan
function registrar_fan($usuario, $pass, $tipo, $nombre, $email, $telefono, $ciudad, $surname1, $surname2, $address, $imagen) {
    // con la funcionregistrar_login obtenemos el id de usuario, despues damos de alta el fan en su respectiva tabla.
    $idusuario = registrar_login($usuario, $pass, $tipo, $nombre, $email, $telefono, $ciudad);
    if ($idusuario != -1) {
        $c = conectar();
        $insert = "insert into fan(id_usuario,apellidoa,apellidob,direccion,imagen) values ('$idusuario','$surname1','$surname2','$address','$imagen')";
        if (mysqli_query($c, $insert)) {
            $resultado = "ok";
        } else {
            $resultado = mysqli_error($c);
            borralogin($usuario);
        }
        desconectar($c);
        return $resultado;
    } else {
        echo"Error añadiendo el fan";
        $resultado = -1;
    }
}

//Desarrollador:Artur
//Destacar o des-destacar un local
function destacalocal($usuario, $destacado) {
    //Conectar base de datos
    $c = conectar();
    if ($destacado) {
        $valor = "true";
    } else {
        $valor = "false";
    }
    //Sentencia sql
    $update = "update localm set destacado=$valor where usuario='$usuario';";
    if (mysqli_query($c, $update)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

//Desarrollador:Artur
//Modifica el password de un usuario
//Se necesita el password antiguo por seguridad
function modificarpassword($usuario, $passantiguo, $pass) {
    $c = conectar();
    $update = "update login set pass='$pass' where usuario='$usuario' and pass='$passantiguo';";
    if (mysqli_query($c, $update)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

//Desarrollado:Artur
//Obtiene la lista de locales ordenados por ciudad
function listalocalesordenadosporciudad() {
    $c = conectar();
    $select = "select login.nombre as nombre, ciudad.nombre as ciudad from login inner join ciudad on login.ciudad = ciudad.id_ciudad where tipo = 1 order by ciudad.nombre;";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

//Desarrollador:Artur
//Obtiene el identificador de un usuario
function dimeidusuario($usuario) {
    //Conectar base de datos
    $c = conectar();
    //Consulta sql
    $select = "select id_usuario from login where usuario='$usuario';";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    if ($fila = mysqli_fetch_assoc($resultado)) {
        //Devuelve el id de usuario
        $id_usuario = $fila['id_usuario'];
        return $id_usuario;
    } else {
        //Si el usuario no existe devuelve -1
        return -1;
    }
}

//Desarrollador:Artur
//Modifica los datos de un perfil de local
function modificaperfillocal($usuario, $nombre, $email, $telefono, $ciudad, $ubicacion, $imagen, $aforo) {
    //Conectar base de datos
    $c = conectar();
    //Obtengo el id del usuario
    $id_usuario = dimeidusuario($usuario);
    //Actualizo los campos de la tabla login
    $update = "update login set nombre='$nombre', email='$email', telefono='$telefono',ciudad=$ciudad where id_usuario=$id_usuario;";
    if (mysqli_query($c, $update)) {
        //Actualizo los campos de la tabla localm
        $update = "update localm set ubicacion='$ubicacion', imagen='$imagen', aforo = $aforo where id_usuario='$id_usuario';";
        if (mysqli_query($c, $update)) {
            $resultado = "ok";
        } else {
            $resultado = mysqli_error($c);
        }
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

//Desarrollador:Artur
//Lee todos los datos del perfil de un local de la base de datos.
function leeperfillocal($usuario) {
    //Conectar con la base de datos
    $c = conectar();
    //Consulta sql con dos inner join evita código.
    $select = "select login.tipo as tipo,login.nombre as nombre,login.email as email,login.telefono as telefono, login.ciudad as ciudad, localm.ubicacion as ubicacion, localm.aforo as aforo, localm.destacado as destacado, localm.imagen as imagen from login inner join localm on login.id_usuario=localm.id_usuario where login.usuario='$usuario';";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    //Se devuelve el resultado de la consulta.
    return $resultado;
}

//Desarrollador:Artur
//Elimina un usuario de la tabla principal login
function borralogin($usuario) {
    $c = conectar();
    $delete = "DELETE FROM login WHERE usuario='$usuario';";
    desconectar($c);
    if (mysqli_query($c, $delete)) {
        return "ok";
    } else {
        return mysqli_error($c);
    }
}

//Desarrollador:Artur
//Devuelve el nombre de un usuario
function dimenombre($usuario) {
    //Conectar con la base de datos
    $c = conectar();
    $select = "select nombre from login where usuario='$usuario';";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    //Si existe el usuario entra en el if
    if ($fila = mysqli_fetch_assoc($resultado)) {
        extract($fila);
        //La función devuelve el nombre del usuario.
        return $nombre;
    } else {
        //Si no existe el usuario devuelve -1. Este caso no debería cumplirse.
        return -1;
    }
}

function dimeapellidoa($usuario, $tipo) {
    
}

function dimeapellidob($usuario, $tipo) {
    
}

//Desarrollador: Artur
//Devuelve el tipo de un usuario
function dimetipousuario($usuario) {
    //Conexión base de datos
    $c = conectar();
    //Consulta sql
    $select = "select tipo from login where usuario='$usuario';";
    $resultado = mysqli_query($c, $select);
    //Enrtra en el if si existe el usuario
    desconectar($c);
    if ($fila = mysqli_fetch_assoc($resultado)) {
        extract($fila);
        //Devuelve el tipo del usuario
        return $tipo;
    } else {
        //Devuelve -1 si no existe
        return -1;
    }
}

//Desarrollador: Artur
//Comprueba si el usuario y password son correctos
function compruebainicio($usuario, $pass) {
    //Conectar base de datos
    $c = conectar();
    //Consulta sql cuantos usuarios hay con ese usuario y password.
    $select = "select count(id_usuario) as cuantos from login where usuario='$usuario' and pass='$pass';";
    $resultado = mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($resultado);
    //Devuelve el número de usuarios con ese usuario y password que pueden ser 0 o 1.
    extract($fila);
    desconectar($c);
    return $cuantos;
}

//Desarrollador: Artur
//Detecta si un usuario existe en la base de datos
function usuarioexiste($usuario) {
    //Conectar base de datos
    $c = conectar();
    //Consulta sql cuantos usuarios hay con es nombre de usuario.
    $select = "select count(id_usuario) as cuantos from login where usuario='$usuario';";
    $resultado = mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($resultado);
    //Devuelve 0 si el usuario no existe o 1 si existe. No pueden haber más de 1.
    extract($fila);
    desconectar($c);
    return $cuantos;
}

//Desarrollador: Artur
//Devuelve la lista de ciudades de una provincia en concreto.
function leeciudades($provincia) {
    //Conectar base de datos.
    $c = conectar();
    //Consulta sql ciudades de provincia concreta
    $select = "select id_ciudad,nombre from ciudad where provincia='$provincia';";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

//Desarrollador: Artur
//Devuelve el ID de una ciudad especificando el nombre.
function dimeidciudad($ciudad) {
    //Conectar base de datos
    $c = conectar();
    //Consulta sql
    $select = "select id_ciudad from ciudad where nombre='$ciudad';";
    $resultado = mysqli_query($c, $select);
    //Entra en el if si se encuentra la ciudad
    desconectar($c);
    if ($fila = mysqli_fetch_assoc($resultado)) {
        extract($fila);
        return $id_ciudad;
        //Devuelve id ciudad
    } else {
        //Si no se encuentra la ciudad devuelve -1
        return -1;
    }
}

//Desarrollador: Artur
//Da de alta un local en la base de datos con todos sus campos.
function registrar_local($usuario, $pass, $nombre, $email, $telefono, $ciudad, $ubicacion, $imagen, $aforo) {
    //Se da de alta el usuario en la tabla principal de login
    //El método registrar_login devuelve el identificador del alta.
    $tipo=1;
    $idusuario = registrar_login($usuario, $pass, $tipo, $nombre, $email, $telefono, $ciudad);
    if ($idusuario != -1) {
        //Conectar base de datos
        $c = conectar();
        //Insert para añadir los datos específicos de local en la tabla localm
        $insert = "insert into localm (id_usuario,ubicacion,imagen,aforo,destacado) values ($idusuario,'$ubicacion','$imagen',$aforo,0);";
        if (mysqli_query($c, $insert)) {
            //Si todo ha ido bien se devuelve ok
            $resultado = "ok";
        } else {
            //Caso de error insertando el local
            $resultado = mysqli_error($c);
            //Por seguridad borro el registro principal ya que no se ha podido añadir el relacionado.
            borralogin($usuario);
        }
        desconectar($c);
    } else {
        //Caso en que ha habido un problema añadiendo el usuario.
        echo"Error añadiendo login.<br>";
        $resultado = -1;
    }
    return $resultado;
}

//Desarrollador: Artur
//Función que da de alta un usuario, sirve tanto para local, como para músico y fan.
//Se añaden los campos comunes.
function registrar_login($usuario, $pass, $tipo, $nombre, $email, $telefono, $ciudad) {
    //Conectar base de datos
    $c = conectar();
    //Insert sql registro tabla login
    $insert = "insert into login (usuario,pass,tipo,nombre,email,telefono,ciudad) values ('$usuario','$pass',$tipo,'$nombre','$email','$telefono','$ciudad');";
    if (mysqli_query($c, $insert)) {
        //Si el insert ha ido bien se devuelve el id autonumérico generado en el alta.
        $resultado = mysqli_insert_id($c);
    } else {
        //Caso de error en el alta  
        echo"Error añadiendo login.";
        $resultado = -1;
    }
    desconectar($c);
    return $resultado;
}

//Desarrollador: Artur
// Función que conecta a la base de datos 
function conectar() {
    include('mysqlpass.php');
    $conexion = mysqli_connect("localhost", $userbd, $passbd, "musica");
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
