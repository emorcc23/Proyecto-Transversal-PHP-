<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
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
        <title></title>
    </head>
    <body>
        <center>
        <?php
        if(isset($_SESSION["username"])){
                echo"</center>";
                echo"User: ";
                echo$_SESSION['username'];
                echo"<br>";
                echo"<center>";
                
                echo"<h1>BIENVENIDO A LA PAGINA DE USUARIOS</h1>";
                echo"<br><br><br><br>";
                echo"<form action='' method='POST'>";
                echo"<p><a href='enviar.php'>ENVIAR UN MENSAJE</p>";
                echo"<p><a href='entrada.php'>CONSULTAR BANDEJA DE ENTRADA</p>";
                echo"<p><a href='enviados.php'>CONSULTA MENSAJES ENVIADOS</p>";
                echo"</form>";
                
                
                
            
        }else{
            echo"No hay ningun usuario logeado";
        }
        ?>
        </center>    
    </body>
</html>

