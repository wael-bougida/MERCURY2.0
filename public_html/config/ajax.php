<?php  
    require_once 'db_connect.php';
    if(isset($_POST["query"]))  
    {  
         $output = '';  
         $query = "SELECT name FROM Colleges WHERE name LIKE '%".$_POST["query"]."%'";  
         $result = mysqli_query($conn, $query);  
         $output = '<ul class="list-group">';  
         if(mysqli_num_rows($result) > 0)  
         {  
              while($row = mysqli_fetch_array($result))  
              {  
                   $output .= '<li class="list-group-item">'.$row["name"].'</li>';  
              }  
         }  
         else  
         {  
              $output .= '<li class="list-group-item">College Not Found</li>';  
         }  
         $output .= '</ul>';  
         echo $output;  
    }  

