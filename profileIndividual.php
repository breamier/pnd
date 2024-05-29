<!DOCTYPE html>
<?php
include 'dbConnect.php';
    $id = $_REQUEST["id"];
    $indivSQL = "SELECT * FROM Individual WHERE IndividualID = '$id'";
    $affilID = "SELECT AffiliationID FROM Partof WHERE ConnectionID IN (SELECT ConnectionID FROM Establishes WHERE IndividualID = '$id')";
    $affilSQL = "SELECT * FROM Affiliation WHERE AffiliationID IN ($affilID)";
    $interestID = "SELECT InterestID FROM Individual_AssocInterest WHERE AssocIntID IN (SELECT ConnectionID FROM Establishes WHERE IndividualID = '$id')";
    $interestSQL = "SELECT * FROM Interest WHERE InterestID IN ($interestID)";
    $dataRow = $conn->query($indivSQL)->fetch_assoc();
    $affil = $conn->query($affilSQL);
    $interest = $conn->query($interestSQL);
?>
<html>
<?php include 'components/compHead.php'; ?>
    <body>
        <section class="section">
            <div class="heading">
                <h1 class="title"><?php echo $dataRow['FName']." ".$dataRow['LName']?></h1>
                <h2 class="subtitle"></h2>
            </div>
            <div class = "body">
                <p>Fullname</p>
                <p>Birthday</p>
                <p>Age</p>
                <p>Gender</p>
            </div>
        </section>
        <section class="section">
            <div class="heading">
                <h1>Affiliations</h1>
            </div>
            <div class="body"  id="affilDisplay">
                <?php
                    while($row=$affil->fetch_assoc()){
                        echo    "<a><div>".
                                "<p>".$row['Name']."</p>".
                                "<p>".$row['Type']." | ".$row['City'].", ".$row['Country']."</p>".
                                "</a></div>";
                    }
                ?>
            </div>
        </section>
        <section class="section">
            <div class="heading">
                <h1>Interests</h1>
            </div>
            <div class="body"  id="interestDisplay">
                <?php
                    while($row=$interest->fetch_assoc()){
                        echo    "<a><div>".
                                "<p>".$row['Name']."</p>".
                                "</a></div>";
                    }
                ?>
            </div>
        </section>
    </body>
</html>