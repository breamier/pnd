<?php
include 'dbConnect.php';

$id = $_GET['id'];

$sql = "SELECT AssocIntID FROM individual_associnterest WHERE IndividualID = $id";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $assocID = $row['AssocIntID'];
        $sql = "DELETE FROM interest_associnterest WHERE AssocIntID = $assocID";
        if($conn->query($sql) === TRUE){
            }

        $sql = "DELETE FROM individual_associnterest WHERE AssocIntID = $assocID";
        if($conn->query($sql) === TRUE){
            }

        $sql = "DELETE FROM associnterest WHERE AssocIntID = $assocID";
        if($conn->query($sql) === TRUE){
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

            }

        $sql = "DELETE FROM establishes WHERE IndividualID = $id";
        if($conn->query($sql) === TRUE){

            }

        $sql = "DELETE FROM connection WHERE ConnectionID = $connID";
        if($conn->query($sql) === TRUE){

            }
    }
}

$sql = "DELETE FROM individual_contactinfo WHERE IndividualID = $id";
if($conn->query($sql) === TRUE){
    }

$sql = "DELETE FROM contactinformation WHERE IndividualID = $id";
if($conn->query($sql) === TRUE){

    }

$sql = "DELETE FROM individual WHERE IndividualID = $id";
if($conn->query($sql) === TRUE){

    }

$conn->close();
header("Location: index.php");
?>