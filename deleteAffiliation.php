<?php
include 'dbConnect.php';

$id = $_GET['id'];



$sql = "DELETE FROM affiliation_contactinfo WHERE AffiliationID = $id";
if($conn->query($sql) === TRUE){

}

$sql = "DELETE FROM contactinformation WHERE AffiliationID = $id";
if($conn->query($sql) === TRUE){

}

$sql = "DELETE FROM partof WHERE AffiliationID = $id";
if($conn->query($sql) === TRUE){
   
}





$sql = "DELETE FROM affiliation WHERE AffiliationID = $id";
if($conn->query($sql) === TRUE){

}

$conn->close();
header("Location: index.php");
?>