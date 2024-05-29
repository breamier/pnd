<?php
include 'dbConnect.php';

$id = $_GET['id'];
$connID = 

$sql = "SELECT AssocIntID FROM individual_associnterest WHERE IndividualID = $id";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $assocID = $row['AssocIntID'];
        $sql = "DELETE FROM interest_associnterest WHERE AssocIntID = $assocID";
        if($conn->query($sql) === TRUE){
                echo "Deleted 1";
            }

        $sql = "DELETE FROM individual_associnterest WHERE AssocIntID = $assocID";
        if($conn->query($sql) === TRUE){
                echo "Deleted 2";
            }

        $sql = "DELETE FROM associnterest WHERE AssocIntID = $assocID";
        if($conn->query($sql) === TRUE){
                echo "Deleted 3";
            }
    }
}

$sql = "SELECT ConnectionID FROM establishes WHERE IndividualID = $id";
$result1 = $conn->query($sql);

if($result->num_rows > 0){
    while($row1 = $result1->fetch_assoc()){
        $connID = $row1['ConnectionID'];
        // needs to delete multiple rows
        $sql = "DELETE FROM partof WHERE ConnectionID = $connID";
        if($conn->query($sql) === TRUE){
                echo "Deleted 6";
            }

        $sql = "DELETE FROM establishes WHERE IndividualID = $id";
        if($conn->query($sql) === TRUE){
                echo "Deleted 7";
            }

        $sql = "DELETE FROM connection WHERE ConnectionID = $connID";
        if($conn->query($sql) === TRUE){
                echo "Deleted 8";
            }
    }
}



$sql = "DELETE FROM individual_contactinfo WHERE IndividualID = $id";
if($conn->query($sql) === TRUE){
        echo "Deleted 4";
    }

$sql = "DELETE FROM contactinformation WHERE IndividualID = $id";
if($conn->query($sql) === TRUE){
        echo "Deleted 5";
    }

$sql = "DELETE FROM individual WHERE IndividualID = $id";
if($conn->query($sql) === TRUE){
        echo "Deleted person";
    }

$conn->close();
?>