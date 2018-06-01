<!DOCTYPE html>
<!--
VER BANDEJA MENSAJES ENVIADOS
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
        <title>MENSAJES ENVIADOS</title>
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
            // TITULO PAGINA
            echo"<h1>MENSAJES ENVIADOS</h1>";
            echo"<br><br><br><br>";
            
            //LLAMADA DE VARIABLES POR SESSION NECESARIAS PARA LAS FUNCIONES
            $username = $_SESSION["username"];
            
            //CON LA SIGUIENTE FUNCION MUESTRO TODOS LOS MENSAJES FILTRADOS POR NOMBRE DE USUARIO.
            $mostrarmensajes = selectMessageSender($username);
            echo"<table>";
            echo"<tr>";
            echo"<td>DESTINATARIO</td><td>FECHA</th><td>ASUNTO</td>";
            echo"</tr>";
            // CON EL SIGUIENTE BUCLE WHILW MUESTRO LOS DATOS.
            while ($fila = mysqli_fetch_assoc($mostrarmensajes)){
                echo"<tr>";
                echo"<td>"; echo$fila['receiver'];echo"</td>";
                echo"<td>"; echo$fila['date'];echo"</td>";
                echo"<td>"; echo$fila['subject'];echo"</td>";
                echo"</tr>";
            }
            
            echo"</table>";
                

                
            
        }else{
            echo"No hay ningun usuario logeado";
        }
        ?>
        </center> 
    </body>
</html>
