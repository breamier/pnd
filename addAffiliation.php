<?php
include 'Connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $affName = $_POST["affName"];
    $affType = $_POST["affType"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $country = $_POST["country"];
    $infoTypes = $_POST["infoType"]; 
    $infoDescs = $_POST["infoDesc"];

    $add_aff = "INSERT INTO `affiliation`(`AffiliationID`, `Name`, `Type`, `City`, `Province`, `Country`)
        VALUES ('', '$affName', '$affType', '$city', '$province', '$country')";

    if($conn->query($add_aff) === TRUE){
        echo "Added Affiliation";
    } else {
        echo "Error";
    }

    $aff_id = $conn->insert_id;

    for($i = 0; $i < count($infoTypes); $i++){
        $sql_contactInfo = "INSERT INTO `contactinformation`(`Type`, `Description`, `IndividualID`, `AffiliationID`)
            VALUES ('$infoTypes[$i]', '$infoDescs[$i]', NULL, '$aff_id')";

        if($conn->query($sql_contactInfo) === TRUE){
            echo "Added to Contact Info Table Successfully";
        }

        $sql_affContact = "INSERT INTO `affiliation_contactinfo`(`AffiliationID`, `Type`, `Description`)
            VALUES ('$aff_id', '$infoTypes[$i]', '$infoDescs[$i]')";

        if($conn->query($sql_affContact) === TRUE){
            echo "Added to Affiliation Contact Table Successfully";
        }
    }
}

?>