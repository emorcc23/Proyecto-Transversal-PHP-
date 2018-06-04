<!--FUNCIONES PARA LA BASE DE DATOS -->

<?php
//Funcion para ver cuantos mensaje estan pendientes por leer.
function mensajeSinLeer($username){
    $c = conectar2();
    $select = "select count(*) as sinleer from message where message.read = 0 and receiver like '$username';";
    $resultado = mysqli_query($c, $select);
    if($fila = mysqli_fetch_assoc($resultado)){
        extract($fila);
        $resultado = $sinleer;
    }else{
        $resultado = mysqli_error($c);
    }
    desconectar2($c);
    return $resultado;
    
}

//Funcion que muestra los mensajes enviados del usuario logeado.
function selectMessageSender($username){
    $c = conectar2();
    $select = "select idmessage,sender,receiver,date,message.read,subject from message where sender='$username' order by date desc;";
    $resultado = mysqli_query($c, $select);
    desconectar2($c);
    return $resultado;
}
//Function que cambia el estado del mensaje:
function cambiarEstadomensaje($estadomensaje,$idmessage){
    $c = conectar2();
    $update = "update message set message.read=$estadomensaje where idmessage=$idmessage;";
    if(mysqli_query($c, $update)){
        $resultado = "ok";
    }else{
        $resultado = mysqli_error($c);
    }
    desconectar2($c);
    return $resultado;
}

//Funcion que muestra el mensaje segun usuario;
function Mensaje($idmessage){
    $c = conectar2();
    $select = "select body from message where idmessage=$idmessage;";
    $resultado = mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($resultado);
    desconectar2($c);
    return $fila['body'];
}

//Funcion que muestra los mensajes recibidos del usuario logeado.
function selectMessage($username){
    $c = conectar2();
    $select = "select idmessage,sender,date,message.read,subject from message where receiver='$username' order by date desc;";
    $resultado = mysqli_query($c, $select);
    desconectar2($c);
    return $resultado;
}

//Funcion para dar de alta un evento
function alta_evento($username,$tipoevento){
    $c = conectar2();
    $insert = "insert into event (user, date, type) values('$username',now(),'$tipoevento')";
    if(mysqli_query($c, $insert)){
        $resultado = "ok";
    }else{
        $resultado = mysqli_error($c);
    }
    desconectar2($c);
    return $resultado;
    
} 

//Funcion que inserta el envio de mensaje en la base de datos
function insertarMensaje($username,$remitente,$asunto,$texto){
    $c = conectar2();
    $insert = "insert into message (sender,receiver,date,message.read,subject,body) values ('$username','$remitente',now(),'pendiente','$asunto','$texto')";
    if(mysqli_query($c, $insert)){
        $resultado = "ok";
    }else{
        $resultado = mysqli_error($c);
    }
    desconectar2($c);
    return $resultado;
    
}

//Funcion que muestra todos los usuarios de la base de datos
function selectNameuser(){
    $c = conectar2();
    $select = "select username from user";
    $resultado = mysqli_query($c, $select);
    desconectar2($c);
    return $resultado;
}

// Funcion para dar de alta usuario
function alta_usuarios($username,$pass,$name,$surname){
    $c = conectar2();
    $select = "insert into user values('$username','$pass','$name','$surname','0')";
    if(mysqli_query($c, $select)){
        $resultado = "ok";
    }else{
        $resultado = mysqli_error($c);
    }
    desconectar2($c);
    return $resultado;
}

// funcion para desconectar la conexion
function desconectar2($conexion){
    mysqli_close($conexion);
}

// Funcion para conectar a la base de datos
function conectar2(){
    $conexion = mysqli_connect("localhost", "root", "ticmysql82", "msg");
    if(!$conexion){
        die("No se ha establecido conexion");
    }
    return $conexion;   
}



?>