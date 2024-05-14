<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername,$username, $password);

$sql = "CREATE DATABASE cmsc127Test";

$conn->query($sql);
include 'Tables.php';

$conn -> close();
