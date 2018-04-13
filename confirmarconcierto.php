<?php
   session_start();
     require_once 'bbdd.php';
     require_once 'funciones.php';
     extract($_SESSION);
     $error=0;
     if(isset($_SESSION['username']))
     {
          if(isset($_POST['concierto']))
          {
                if(compruebaconciertoesdelocal($_SESSION['username'],$_POST['concierto'])=="ok")
                {
                    extract($_POST);
                    if(confirmaconcierto($concierto, $musico)=="ok")
                    {
                        echo"Concierto confirmado.<br>";
                    }
                    else
                    {
                        echo"Error confirmando el concierto. Verifica que no se haya confirmado antes.<br>";
                    }
                }
                else
                {
                    $error=1;
                }
          }
          else
          {
              if(isset($_GET['id']))
              {
                if(compruebaconciertoesdelocal($_SESSION['username'],$_GET['id'])=="ok")
                {
                     $datosconcierto=infoconcierto($_GET['id']);
                 
                 
                     if($datos=mysqli_fetch_assoc($datosconcierto))
                     {
                        extract($datos);
                        echo"<b>Nombre:</b>$nombre<br>";
                        echo"<b>Fecha:</b>$fecha<br>";
                        echo"<b>Hora:</b>$hora<br>";
                        $ngenero=dimenombregenero($genero);
                        $estadop=cualestado($estado);
                        echo"<b>Género:</b>$ngenero<br>";
                        echo"<b>Estado:</b>$estadop<br>";
                        if($estado==0)
                        {
                            echo"<h2>Músicos que han propuesto su actuación.</h2><br>";
                            $listamusicos = listamusicospropuestos($_GET['id']);
                            echo"<form method='post'>";
                            $conta=0;
                            while($lista = mysqli_fetch_assoc($listamusicos))
                            {
                                extract($lista);
                                if($conta==0)
                                {
                                   echo"<input type='radio' name='musico' value=$musico checked>$nombreart $nombre $apellidoa $apellidob<br>";         
                                }
                                else
                                {
                                    echo"<input type='radio' name='musico' value=$musico>$nombreart $nombre $apellidoa $apellidob<br>";
                                }   
                                $conta++;
                            }
                            $concierto=$_GET['id'];
                            echo"<input type='hidden' value=$concierto name='concierto'>";
                            echo"<input type='submit' value='Confirmar músico y concierto'></form>";
                         }
                         else
                         {
                             echo"El concierto ya no está por confirmar.<br>";
                         }        
                    }
                    else
                     {  
                         echo"Concierto eliminado.<br>";
                     }
                 }
                else
                {
                     $error=1;
                 }
             }    
            else
            {
                 $error=1;
             }
        }
         
     }
     else
     {
         $error=1;
     }
     if($error==1)
     {
         echo"No puedes entrar aquí.<br>";
     }
     
     
 ?>