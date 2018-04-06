<h1>Añadir concierto.</h1>
<?php
    session_start();
    require_once 'bbdd.php';
    if (isset($_SESSION['username'])) {
        if(isset($_POST['nombre']))
        {                   
            extract($_POST);
            extract($_SESSION);
            $id_usuario = dimeidusuario($username);
            if(anadeconcierto($nombre, $fecha, $hora, $pago, $id_usuario, $gender)=="ok")
            {
                echo"Alta de concierto realizada.<br>";
            }
            else
            {
                echo"Error en alta de concierto.<br>";
            }
        }
        else
        {
            ?>
            <form method="post">    
            <b>Nombre</b><input type="text" name="nombre"><br>
            <b>Fecha</b><input type="date" name="fecha"><br>
            <b>Hora</b><input type="time" name="hora"><br>
            <b>Pago</b><input type="number" name="pago"><br>
            <?php
            echo"<b>Genero:</b><select id='select' name='gender'>";
            $generos=muestrageneros();
            while($fila = mysqli_fetch_assoc($generos)){
                extract($fila);
                echo"<option value='$id_genero'>$nombre</option>";
            } 
            echo"</select>";
           ?> 
            <input type="submit" value="Enviar">
            </form>
            
            <?php  
        }
    }
    else
    {
        echo"Sesión no iniciada.<br>";
    }   
?>

