<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername,$username, $password);

$sql = "CREATE DATABASE IF NOT EXISTS cmsc127Test";

if($conn->query($sql) === TRUE){
    echo "Database created successfully";
} else {
    echo "Error: ". $conn->error;
}
$conn -> close();
include 'Tables.php';

?>
