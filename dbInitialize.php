<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EMPNDa";

$conn = new mysqli($servername,$username, $password);

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

if($conn->query($sql) === TRUE){
    echo "Database created successfully";
} else {
    echo "Error: ". $conn->error;
}
$conn -> close();
include 'dbTables.php';

?>
