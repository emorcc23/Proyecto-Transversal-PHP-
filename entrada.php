<!DOCTYPE html>
<!--
BANDEA DE ENTRADA
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
        <title>BANDEJA DE ENTRADA</title>
    </head>
    <body>
        <center>
        <?php
        if(isset($_SESSION["username"])){
            //USUARIO Y CIERRE DE SESION
            echo"</center>";
            echo"User: ";
            echo$_SESSION['username'];
            cerraSession2();
            echo"<center>";
            echo"<br><br><br><br>";
            
            echo"<h1>BANDEJA DE ENTRADA</h1>";
            echo"<br><br><br><br>";
            //RECOJO LA VARIABLE DE USUARIO, DESPUES DECLARO UNA VARIABLE 'C' PARA 
            //PONER COMO CONSULTA CUANDO SE ENTRA A LA BANDEJA DE ENTRADA.  
            $username = $_SESSION["username"];            
            //GUARDO EN LA VARIABLE $MOSTRARMENSAJE LA FUNCION QUE MUESTRA TODOS LOS DATOS 
            //DE LA TABALA MESSAGE DE LA BASE DE DATOS.        
            $mostrarmensajes = selectMessage($username);
            echo"<table>";
            echo"<tr>";
            echo"<td>EMISOR</td><td>FECHA</th><td>ESTADO</td><td>ASUNTO</td>";
            echo"</tr>";
            while ($fila = mysqli_fetch_assoc($mostrarmensajes)){
                echo"<tr>";
                echo"<td>"; echo$fila['sender'];echo"</td>";
                echo"<td>"; echo$fila['date'];echo"</td>";
                echo"<td>"; echo$fila['read'];echo"</td>";
                echo"<td>"; echo$fila['subject'];echo"</td>";
                echo"<form method='POST'>";
                echo"<td><input type='hidden' name='idmessage' value='".$fila['idmessage']."'>";
                echo"<input type='submit' name='next' value='leer'></td>";
                echo"</form>";
                echo"</tr>";
            }
            echo"</table>";
            //DESPUES DE GUARDAR EN UN CAMPO OCULTO EL ID DE MENSAJE, LO UTILIZO 
            //PARA SABER QUE MENSAJE ABRIR DESPUES DEL FORMULARIO.      
            if(isset($_POST['next'])){
                $username = $_SESSION["username"];
                $idmessage = $_POST['idmessage'];
                
                $username = $_SESSION["username"];
                $tipoevento = "C";
                alta_evento($username, $tipoevento);
            
                $body = Mensaje($idmessage);
                echo"<br><br><br><br>";
                echo$body;
                $estadomensaje = 1;
                //UNA VEZ LEIDO EL MENSAJE CAMBIO DE NO LEIDO A LEIDO EL MENSAJE.
                cambiarEstadomensaje($estadomensaje, $idmessage);
            }

                
            
        }else{
            echo"No hay ningun usuario logeado";
        }
        ?>
        </center> 
    </body>
</html>
