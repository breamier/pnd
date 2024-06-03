<!DOCTYPE html>
<?php
include 'dbConnect.php';
    $id = $_REQUEST["id"];
    $indivSQL = "SELECT * FROM Individual WHERE IndividualID = '$id'";
    $affilID = "SELECT AffiliationID FROM Partof WHERE ConnectionID IN (SELECT ConnectionID FROM Establishes WHERE IndividualID = '$id')";
    $affilSQL = "SELECT * FROM Affiliation WHERE AffiliationID IN ($affilID)";
    $interestID = "SELECT InterestID FROM Interest_AssocInterest WHERE AssocIntID IN (SELECT AssocIntID FROM individual_associnterest WHERE IndividualID = '$id')";
    $interestSQL = "SELECT * FROM Interest WHERE InterestID IN ($interestID)";
    $dataRow = $conn->query($indivSQL)->fetch_assoc();
    $affil = $conn->query($affilSQL);
    $interest = $conn->query($interestSQL);

    switch($dataRow['Gender']){
        case 'male':
            $gender = 'Male';
            break;
        case 'female':
            $gender = 'Female';
            break;
        case 'pnts':
            $gender = 'Prefer Not to Say';
            break;
        case 'others':
            $gender = 'Others';
            break;
        default:
            $gender = 'Others';
            break;
    }
?>
<html>
<?php include 'components/compHead.php'; ?>
    <body>
    <?php include 'components/compNav.php'?>
        <div class="flex">
        <section class="section">
            <div class="heading">
                <h1 class="title"><?php echo $dataRow['FName']." ".$dataRow['LName']?></h1>
                <h2 class="subtitle"></h2>
            </div>
            <div class = "body">
                <p>Fullname: <?php echo $dataRow['FName']." ".$dataRow['LName'];?></p>
                <p>Birthday: <?php
                                $date =$dataRow['Year']."-".$dataRow['Month']."-".$dataRow['Day'];
                                echo date('F d Y', strtotime($date))?>
                </p>
                <p>Age: <?php echo date('Y',time()-strtotime($date))-1970;?></p>
                <p>Gender: <?php echo $gender;?></p>
            </div>
            <div class = "contactinfo">
                <h1>Contact Information</h1>
                <?php 
                    $types = array("phoneNum"=>"Phone Number","email"=>"Email","facebook"=>"Facebook","instagram"=>"Instagram","linkedIn"=>"LinkedIn","website"=>"Website","others"=>"Others");

                    $sql = "SELECT * FROM contactinformation NATURAL JOIN individual_contactinfo WHERE IndividualID = '$id'";
                    $contact = $conn->query($sql);
                    
                    while($row=$contact->fetch_assoc()){
                       
                        $type = $row['Type'];
                        echo $types[$type].": ".$row['Description']."<br>";
                    }
                
                ?>
            </div>
        </section>
        <section class="section heading">
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
        <section class="section">
            <div class="heading">
                <h1>Interests</h1>
            </div>
            <div class="body" id="contactDisplay">
                <?php
                    while($row=$interest->fetch_assoc()){
                        echo    "<a href=profileInterest.php?id=".$row['InterestID'].">".
                                "<p class='tag'>".$row['Name']."</p>".
                                "</a>";
                    }
                ?>
            </div>
            <section class='actions'>
            <form action='deleteContact.php' method='GET'>
                <input type="submit" name="delete" value="Delete">
                <input type='hidden' value='<?php echo $id?>' name='id'>
            </form>
            <form action='updateIndividual.php' method='GET'>
                <input type="submit" name="update" value="Update">
                <input type='hidden' value='<?php echo $id?>' name='id'>
            </form>
        </section>
        </section>


        </div>
    </body>
</html>