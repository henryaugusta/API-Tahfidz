<?php
$servername = "localhost";
$username = "root";
// $password = "TNr42wLYqw3I9g71Xe";
$password = "";
$database = "tahfidz";

$conn = new mysqli($servername, $username, $password, $database);
$connect = mysqli_connect($servername, $username, $password, $database);

function getConnection(){
$servername = "localhost";
$username = "root";
$password = "";
$database = "tahfidz";

$conn = new mysqli($servername, $username, $password, $database);
$connect = mysqli_connect($servername, $username, $password, $database);

    if($conn->connect_error){
        $conn==null;
    }
    return $conn;
}
?>
