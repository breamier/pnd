<?php
include 'dbConnect.php';

$id = $_GET['id'];

$sql = "DELETE FROM contactinformation WHERE AffiliationID = $id";
if($conn->query($sql) === TRUE){
    echo "Deleted contact";
}

$sql = "DELETE FROM affiliation_contactinfo WHERE AffiliationID = $id";
if($conn->query($sql) === TRUE){
    echo "Deleted contact_aff";
}

$sql = "DELETE FROM partod WHERE AffiliationID = $id";
if($conn->query($sql) === TRUE){
    echo "Deleted partof";
}

$sql = "DELETE FROM affiliation WHERE AffiliationID = $id";
if($conn->query($sql) === TRUE){
    echo "Deleted Affiliation";
}

$conn->close();
?>