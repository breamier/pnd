<?php
include 'dbConnect.php';

$id = $_GET['id'];

$sql_assocID = "SELECT AssocIntID FROM individual_associnterest WHERE IndividualID = $id";
$result = $conn->query($sql_assocID);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $assocID = $row['AssocIntID'];
        $sql_interest_assoc = "DELETE FROM interest_associnterest WHERE AssocIntID = $assocID";
        if($conn->query($sql_interest_assoc) === TRUE){
                echo "Deleted 1";
            }

        $sql_ind_assoc= "DELETE FROM individual_associnterest WHERE AssocIntID = $assocID";
        if($conn->query($sql_ind_assoc) === TRUE){
                echo "Deleted 2";
            }

        $sql_assoc_int = "DELETE FROM associnterest WHERE AssocIntID = $assocID";
        if($conn->query($sql_assoc_int) === TRUE){
                echo "Deleted 3";
            }
    }
}

$sql_connID = "SELECT ConnectionID FROM establishes WHERE IndividualID = $id";
$result1 = $conn->query($sql_connID);

if($result1->num_rows > 0){
    while($row1 = $result1->fetch_assoc()){
        $connID = $row1['ConnectionID'];
        $sql_part_of = "DELETE FROM partof WHERE ConnectionID = $connID";
        if($conn->query($sql_part_of) === TRUE){
                echo "Deleted 4";
            }

        $sql_establishes = "DELETE FROM establishes WHERE ConnectionID = $connID";
        if($conn->query($sql_establishes) === TRUE){
                echo "Deleted 5";
            }

        $sql_connection = "DELETE FROM connection WHERE ConnectionID = $connID";
        if($conn->query($sql_connection) === TRUE){
                echo "Deleted 6";
            }
    }
}

$sql = "DELETE FROM individual_contactinfo WHERE IndividualID = $id";
if($conn->query($sql) === TRUE){
        echo "Deleted 7";
    }

$sql = "DELETE FROM contactinformation WHERE IndividualID = $id";
if($conn->query($sql) === TRUE){
        echo "Deleted 8";
    }

$sql = "DELETE FROM individual WHERE IndividualID = $id";
if($conn->query($sql) === TRUE){
        echo "Deleted person";
    }

$conn->close();
?>