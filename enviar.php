<!DOCTYPE html>
<!--
ENVIAR MENSAJE 
-->
<?php
require_once 'msgbbdd.php';
require_once 'bbdd.php';
require_once 'funciones.php';
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ENVIAR MENSAJE</title>
    </head>
    <body>
        <center>
        <?php
        if(isset($_SESSION["username"])){
            echo"</center>";
            echo"User: ";
            echo$_SESSION['username'];
            cerraSession2();
            echo"<center>";
            echo"<br><br><br><br>";
            
            
                echo"<h1>ENVIAR MENSAJE</h1>";
                echo"<br><br><br><br>";
                echo"<form action='' method='POST'>";
                
                echo"Remitente:<select name='remitente'>";
                //CON LA SIGUIENTE FUNCION Y EL BUCLE WHILE METO TODOS LOS USUARIOS DE LA 
                //BASE DE DATOS EN UN SELECT.
                $nombres = selectNameuser();
                while($fila = mysqli_fetch_assoc($nombres)){
                echo"<option>";
                echo $fila ["username"];
                echo"</option>";
                }
                echo"</select>";
                echo"<br><br>";
                
                echo"Asunto:<input type='text' name='asunto' required>";
                echo"<br><br>";
                
                echo"Escriba el mail acontinuacion:<br><textarea name='texto' rows='12' cols='50' required>Escribe...
                </textarea>";
                echo"<br><br>";
                
                echo"<input type='submit' name='next' value='enviar'>";
                echo"<br><br>";
                
                echo"</form>";
                
                if(isset($_POST["next"])){
                    $remitente = $_POST["remitente"];
                    $asunto    = $_POST["asunto"]; 
                    $texto     = $_POST["texto"];
                    
                    // CON LA SIGUIENTE FUNCION Y CON AYUDA DE LAS VARIABLES RECOJIDAS DEL FORMULARIO
                    // INSERTO EN LA BASE DE DATOS EN MENSAJE QUE SE QUEIRE ENVIAR.
                    
                    $username = $_SESSION["username"];
                    //CON LA SIGUIENTE VARIABLE $TIPOEVENTO Y LA FUNCION ALTA_EVENTO CAMBIO 
                    //A TIPO REDACCION "R" EL ESTADO DEL MENSAJE.
                    $tipoevento = "R";
                    alta_evento($username, $tipoevento);
                
                
                    $enviado  = insertarMensaje($username, $remitente, $asunto, $texto);
                    
                    if($enviado == "ok"){
                        echo"Mensaje enviado satisfactoriamente";
                    }else{
                        echo"Error al enviar el mensaje $enviado";
                    }
                    
                }
 
            
        }else{
            echo"No hay ningun usuario logeado";
        }
        ?>
        </center>
    </body>
</html>

