<?php 
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password,"cmsc127Test");

include 'Tables.php';

$conn->close();