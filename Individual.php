<!DOCTYPE html>
<?php
include 'Connect.php';
$id = $_GET["id"];
$indivSQL = "SELECT * FROM Individual WHERE IndividualID = '$id'";
// $affilID = "SELECT * FROM Partof WHERE ConnnectionID = (SELECT ConnectionID FROM Establishes WHERE IndividualID = '$id')";
// $affilSQL = "SELECT * FROM Affiliation WHERE ConnectionID = '$affilID'";

$iRow = $conn->query($indivSQL)->fetch_assoc();
// $aRow = $conn->query($affilSQL)->fetch_assoc();
?>
<html>
    <head>  
        <link rel="stylesheet" type="text/css" href="styles.css"/>
    </head>
    <body>
        <div class="flexC">
            <div class="header">
                <h1 class="title"><?php echo $iRow['FName']." ".$iRow['LName']?></h1>
                <h2 class="subtitle"></h2>
            </div>
            <div class = "info">
                <p>Fullname</p>
                <p>Birthday</p>
                <p>Age</p>
                <p>Gender</p>
            </div>
            <div class = "affiliations info">
                <div class = "item affilation">
                    <p>ROLE</p>
                    <a><p>Affiliation Name</p></a>
                </div>
            </div>
        </div>
    </body>
</html>