<?php
include 'Connect.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $affName = $_GET["affName"];
    $affType = $_GET["affType"];
    $city = $_GET["city"];
    $province = $_GET["province"];
    $country = $_GET["country"];

    $add_aff = "INSERT INTO `affiliation`(`AffiliationID`, `Name`, `Type`, `City`, `Province`, `Country`)
        VALUES ('', '$affName', '$affType', '$city', '$province', '$country')";

    if($conn->query($add_aff) === TRUE){
        echo "Added Affiliation";
    } else {
        echo "Error";
    }
}

?>