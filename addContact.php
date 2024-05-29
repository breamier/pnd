<?php
include 'dbConnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $infoTypes = $_POST["infoType"]; 
    $infoDescs = $_POST["infoDesc"];
    $affiliations = $_POST["affiliation"];
    $roles = $_POST["role"];
    $interests = $_POST['interest'];

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

    for($j = 0; $j < count($affiliations); $j++){
        $sql_connection = "INSERT INTO `connection` (`ConnectionID`, `Role`)
            VALUES ('', '$roles[$j]')";

        if($conn->query($sql_connection) === TRUE){
            echo 'Added Connection and Role';
        }

        $conn_id = $conn->insert_id;

        $sql_establishes = "INSERT INTO `establishes`(`IndividualID`, `ConnectionID`)
            VALUES ('$idv_id', '$conn_id')";
        if($conn->query($sql_establishes) === TRUE){
            echo 'Added to Establishes';
        }
        $sql_partof = "INSERT INTO `partof`(`AffiliationID`, `ConnectionID`)
            VALUES ('$affiliations[$j]', '$conn_id')";
        if($conn->query($sql_partof) === TRUE){
            echo 'Added to partof relation';
        }
    }

    for($z = 0; $z < count($interests); $z++){
        $sql_assoc_id = "INSERT INTO `associnterest`(`AssocIntID`) VALUES('')";
        if($conn->query($sql_assoc_id)){
            echo "Inserted assoc_id";
        }

        $assoc_id = $conn->insert_id;

        $sql_idv_assoc = "INSERT INTO `individual_associnterest`(`AssocIntID`, `IndividualID`)
            VALUES('$assoc_id', '$idv_id')";

        if($conn->query($sql_idv_assoc) === TRUE){
            echo "Linked Indiv to Assoc";
        }
        $sql_assoc_int = "INSERT INTO `interest_associnterest`(`InterestID`, `AssocIntID`)
            VALUES ('".$interests[$z]."', '$assoc_id')";
        if($conn->query($sql_assoc_int) === TRUE){
            echo "Added Interest and AssocID";
        }   
    }

}
?>