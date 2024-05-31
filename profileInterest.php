<!DOCTYPE html>
<?php
include 'dbConnect.php';
    $id = $_REQUEST["id"];
    $interestSQL = "SELECT * FROM Interest WHERE InterestID = '$id'";
    $indivSQL = "SELECT * FROM Individual WHERE IndividualID IN (SELECT IndividualID FROM (Individual  NATURAL JOIN AssocInterest NATURAL JOIN Interest_AssocInterest))";
    $dataRow = $conn->query($interestSQL)->fetch_assoc();
    $indiv = $conn->query($indivSQL);
?>
<html>
<?php include 'components/compHead.php'; ?>
    <body>
    <?php include 'components/compNav.php'?>
        <div class="flex">
        <section class="section left">
            <div class="heading">
                <h1 class="title"><?php echo $dataRow['Name']?></h1>
            </div>
        </section>
        <section class="section">
            <div class="heading">
                <h1>Contacts</h1>
            </div>
            <div class="body"  id="contactDisplay">
                <?php
                    while($row=$indiv->fetch_assoc()){
                        $indivID = $row['IndividualID'];

                        echo    "<a href='profileIndividual.php?id=".$indivID."'><div class='result profile'>".
                                "<p>".$row['FName']." ".$row['LName']."</p>".
                                "</a></div>";
                    }
                ?>
            </div>
        </section>
        <section class='actions'>
            <form action='deleteContact.php' method='GET'>
                <input type="submit" name="delete" value="Delete">
                <input type='hidden' value='<?php echo $id?>' name='id'>
            </form>
        </section>
        </div>
    </body>
</html>