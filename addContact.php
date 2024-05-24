<?php
include 'Connect.php';

if($_SERVER["REQUEST_METHOD" == "POST"]){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $infoTypes = $_POST['infoType'];
    $infoDescs = $_POST['infoDesc'];

    
    for ($i = 0; $i < count($infoTypes); $i++) {
        $infoType = $infoTypes[$i];
        $infoDesc = $infoDescs[$i];
    }

    $sql = "INSERT INTO ";
}
?>