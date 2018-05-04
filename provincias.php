<?php
    require_once 'bbdd.php';
    require_once 'funciones.php';
     if(isset($_POST['provincia']))
     {
            $ciudades = leeciudades($_POST['provincia']);
            $arrayciudades = conviertearray($ciudades);
            echo json_encode($arrayciudades);
            exit();
    }
        
?>
