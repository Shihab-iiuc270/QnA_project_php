<?php
$host = "localhost";
$username = "root";
$password = "";
$database= "discuss";

$conn = new mysqli($host,$username,$password,$database);

if($conn->connect_error){
    die("connection failed : ". $conn->connect_error);
}

// echo "db conected";

?>