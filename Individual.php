<?php echo $_GET["id"];
include 'Connect.php';
$id = $_GET["id"];
$indivSQL = "SELECT * FROM Individual WHERE IndividualID = '$id'";
// $affilID = "SELECT * FROM Partof WHERE ConnnectionID = (SELECT ConnectionID FROM Establishes WHERE IndividualID = '$id')";
// $affilSQL = "SELECT * FROM Affiliation WHERE ConnectionID = '$affilID'";

$iRow = $conn->query($indivSQL)->fetch_assoc();
// $aRow = $conn->query($affilSQL)->fetch_assoc();

echo $iRow['FName'], $iRow['LName'];


?>