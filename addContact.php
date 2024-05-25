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

    // retrieves last inserted contact id
    $idv_id = $conn->insert_id;
    
    for($i = 0 ; $i < count($infoTypes); $i++){
        $sql_contactInfo = "INSERT INTO `contactinformation`(`Type`, `Description`, `IndividualID`, `AffiliationID`)
            VALUES ('$infoTypes[$i]', '$infoDescs[$i]', '$idv_id', NULL)";

        if($conn->query($sql_contactInfo) === TRUE){
            echo "Added to Contact Info Table Successfully";
        }

        $sql_idvContact = "INSERT INTO `individual_contactinfo`(`IndividualID`, `Type`, `Description`)
            VALUES ('$idv_id', '$infoTypes[$i]', '$infoDescs[$i]')";

        if($conn->query($sql_idvContact) === TRUE){
            echo "Added to Individual Contact Table Successfully";
        }
    }   
}
?>