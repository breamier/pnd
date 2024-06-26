<!DOCTYPE html>
<?php
include 'dbConnect.php';
    $id = $_REQUEST["id"];
    $affilSQL = "SELECT * FROM Affiliation WHERE AffiliationID = '$id'";
    $indivSQL = "SELECT * FROM (Individual NATURAL JOIN Establishes NATURAL JOIN Connection NATURAL JOIN PartOf) WHERE AffiliationID = '$id'";
    $dataRow = $conn->query($affilSQL)->fetch_assoc();
    $indiv = $conn->query($indivSQL);

    ?>
<html>
<?php include 'components/compHead.php'; ?>
    <body>
        <?php include 'components/compNav.php'?>
        <div class="flex">
        <section class="section">
            <div class="heading main">
                <h1 class="title"><?php echo $dataRow['Name']?></h1>
                <h2 class="subtitle"><?php echo $dataRow['Type']?></h2>
            </div>
            <div class = "body">
                <?php echo $dataRow['City'].", ".$dataRow['Province'].", ".$dataRow['Country']?>
            </div>
            <div class = "contactinfo">
                <?php 
                    $types = array("phoneNum"=>"Phone Number","email"=>"Email","facebook"=>"Facebook","instagram"=>"Instagram","linkedIn"=>"LinkedIn","website"=>"Website","others"=>"Others");

                    $sql = "SELECT * FROM contactinformation NATURAL JOIN affiliation_contactinfo WHERE AffiliationID = '$id'";
                    $contact = $conn->query($sql);
                    
                    while($row=$contact->fetch_assoc()){
                       
                        $type = $row['Type'];
                        echo $types[$type].": ".$row['Description']."<br>";
                    }
                
                ?>
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
                        $roleSql = "SELECT Role FROM (PartOf NATURAL JOIN Connection NATURAL JOIN Establishes) WHERE IndividualID = $indivID";
                        $role = $conn->query($roleSql)->fetch_assoc();

                        echo    "<a href='profileIndividual.php?id=".$indivID."'><div class='result profile'>".
                                "<p>".$row['FName']." ".$row['LName']." - ".$role['Role']."</p>".
                                "</a></div>";
                    }
                ?>
            </div>
            <section class='actions'>
            <form action='deleteAffiliation.php' method='GET'>
                <input type="submit" name="delete" value="Delete">
                <input type='hidden' value='<?php echo $id?>' name='id'>
            </form>
            <form action='updateAffiliation.php' method='GET'>
                <input type="submit" name="update" value="Update">
                <input type='hidden' value='<?php echo $id?>' name='id'>
            </form>
        </section>
        </section>

        </div>
    </body>
</html>