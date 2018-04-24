<?php  
 $connect = mysqli_connect("localhost", "root", "", "musica");  
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM login WHERE usuario LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["usuario"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>User Not Found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?>

