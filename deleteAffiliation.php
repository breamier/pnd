<?php
include 'dbConnect.php';

$id = $_GET['id'];
$sql = "SELECT Name FROM Affiliation WHERE AffiliationID=$id";
$name = ($conn->query($sql)->fetch_assoc())['Name'];


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
$message = "Affiliation $name deleted";
header("Location: search.php?id=$message");
?>