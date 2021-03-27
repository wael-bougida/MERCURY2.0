<?php  
//  $connect = new mysqli('localhost','tuanpham', 'test1234', 'Housing' );
$connect = new mysqli('localhost','group19','pXHcA0', 'group19');
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT name FROM Students WHERE name LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["name"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>Student Not Found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  

