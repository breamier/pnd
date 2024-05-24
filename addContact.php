<?php
include 'Connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $infoTypes = $_POST["infoType"]; 
    $infoDescs = $_POST["infoDesc"];

    list($year, $month, $day) = explode('-', $birthdate);

    $sql = "INSERT INTO `Individual`(`Fname`, `LName`, `Month`, `Day`, `Year`, `IndividualID`, `Gender`)
            VALUES ('$fname', '$lname', '$month', '$day', '$year', '', '$gender')";

    if($conn->query($sql) === TRUE){
        echo "Added Individual Info";
    } else {
        echo "Error";
    }

    $idv_id = $conn->insert_id; // used later on for adding contact info and affiliations   

}
?>