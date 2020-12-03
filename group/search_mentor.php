<?php
require_once "../connect.php";

if (isset($_GET['term'])) {
   $query = "SELECT * FROM mentor WHERE name LIKE '{$_GET['term']}%' LIMIT 25";
    $result = mysqli_query($conn, $query);
 
    if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {    
         $id = $user['id'];
         $name = $user['name'];     
         $res[] = "$id-$name";
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
