<?php
require_once 'bbdd.php';
session_start();
if(isset($_GET['id']))
{
    $correcto=0;
    if(isset($_SESSION['username']))
    {
        extract($_SESSION);
         $tipousuario=dimetipousuario($username);
         if($tipousuario==1)
         {
             $correcto=1;
             if(bajaconcierto($_GET['id'])=="ok")
             {
                 echo"Concierto eliminado.<br>";
             }       
         }       
    }
    if($correcto==0)
    {
        echo"No puedes entrar aquí.<br>";
    }
}
?>
