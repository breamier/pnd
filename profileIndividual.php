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
    <?php include 'components/compNav.php'?>
        <div class="flex">
        <section class="section left">
            <div class="heading">
                <h1 class="title"><?php echo $dataRow['FName']." ".$dataRow['LName']?></h1>
                <h2 class="subtitle"></h2>
            </div>
            <div class = "body">
                <p>Fullname: <?php echo $dataRow['FName']." ".$dataRow['LName'];?></p>
                <p>Birthday: <?php
                                $date =$dataRow['Year']."-".$dataRow['Month']."-".$dataRow['Day'];
                                echo date('F d', strtotime($date))?>
                </p>
                <p>Age: <?php echo date('Y',time()-strtotime($date))-1970;?></p>
                <p>Gender: <?php echo $dataRow['Gender'];?></p>
            </div>
        </section>
        <section class="section center">
            <div class="heading">
                <h1>Affiliations</h1>
            </div>
            <div class="body"  id="affilDisplay">
                <?php
                    while($row=$affil->fetch_assoc()){
                        echo    "<a href=profileAffiliation.php?id=".$row['AffiliationID']."><div>".
                                "<p>".$row['Name']."</p>".
                                "<p>".$row['Type']." | ".$row['City'].", ".$row['Country']."</p>".
                                "</a></div>";
                    }
                ?>
            </div>
        </section>
        <section class="section right">
            <div class="heading">
                <h1>Interests</h1>
            </div>
            <div class="body"  id="interestDisplay">
                <?php
                    while($row=$interest->fetch_assoc()){
                        echo    "<a href=profileInterest.php?id=".$row['InterestID'].">".
                                "<span class='tag'>".$row['Name']."</span>".
                                "</a></div>";
                    }
                ?>
            </div>
        </section>
        </div>
    </body>
</html>