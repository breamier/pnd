<!DOCTYPE html>
<?php
include 'dbConnect.php';
    $id = $_REQUEST["id"];
    $sql  = "SELECT * FROM Affiliation WHERE AffiliationID = '$id'";
    $result = $conn->query($sql)->fetch_assoc();
?>
<?php
if(isset($_POST['Update'])){
    $aff_id = $id;
    $affName = $_POST["affName"];
    $affType = $_POST["affType"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $country = $_POST["country"];
    $infoTypes = $_POST["infoType"]; 
    $infoDescs = $_POST["infoDesc"];


    $updateAff = "  UPDATE affiliation
                    SET Name='$affName', Type='$affType', City='$city', Province='$province',Country='$country'
                    WHERE AffiliationID =  $aff_id";

    $conn->query($updateAff);
    $sql = "DELETE FROM affiliation_contactinfo WHERE AffiliationID = $id";
    $conn->query($sql);
    $sql = "DELETE FROM contactinformation WHERE AffiliationID = $id";
    $conn->query($sql);

    for($i = 0; $i < count($infoTypes); $i++){
        $sql_contactInfo = "INSERT INTO `contactinformation`(`Type`, `Description`, `IndividualID`, `AffiliationID`)
            VALUES ('$infoTypes[$i]', '$infoDescs[$i]', NULL, '$aff_id')";

        if($conn->query($sql_contactInfo) === TRUE){

        }

        $sql_affContact = "INSERT INTO `affiliation_contactinfo`(`AffiliationID`, `Type`, `Description`)
            VALUES ('$aff_id', '$infoTypes[$i]', '$infoDescs[$i]')";

        if($conn->query($sql_affContact) === TRUE){
 
        }
    }
    header("Location: profileAffiliation.php?id=$aff_id");
    }
    
?>
<html>
<?php include 'components/compHead.php'; ?>
    <body>
    <?php include 'components/compNav.php'?>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" autocomplete="off" class="add">
            <h2 class="form-label">Add Affiliation</h2>
            <label for="affName">Name of Affiliation:</label><br>
            <input type="text" id="affName" name="affName" value='<?php echo $result['Name']?>'><br>

            <label for="affType">Type of Affiliation:</label><br>
            <select class="expand" name="affType">
                <option value="" disabled="">--Select Type of Affiliation--</option>
                <option value="company" <?php if($result['Type']=='company'){echo 'selected';}?>>Company</option>
                <option value="organization" <?php if($result['Type']=='organization'){echo 'selected';}?>>Organization</option>
                <option value="school" <?php if($result['Type']=='school'){echo 'selected';}?>>School</option>
            </select><br>

            <label>Location:</label><br>
            <input type="text" id="city" name="city" placeholder="City" value='<?php echo $result['City'] ?>'>
            <input type="text" id="province" name="province" placeholder="Province" value='<?php echo $result['Province'] ?>'>
            <input type="text" id="country" name="country" placeholder="Country" value='<?php echo $result['Country'] ?>'><br>

            <label for="contact">Contact Information:</label>
            <div id="affContactInfo">
                <a onclick="add_affContactField()"><img src="images/add.png" class="add"></a>
                <div>
                    <?php 
                $sql = "SELECT * FROM contactinformation NATURAL JOIN affiliation_contactinfo WHERE AffiliationID = '$id'";
                $contact = $conn->query($sql);

                while($row=$contact->fetch_assoc()){
                    $info = $row['Description'];
                    $type = $row['Type'];
                    echo '<div><select class="expand" name="infoType[]">
                    <option value="" disabled="">--Select Type--</option>
                    <option value="phoneNum" ';if($type=="phoneNum"){echo "selected";}
                    echo '>Phone Number</option>
                    <option value="email" ';if($type=="email"){echo "selected";}
                    echo ' >Email</option>
                    <option value="facebook" ';if($type=="facebook"){echo "selected";}
                    echo ' >Facebook</option>
                    <option value="instagram" ';if($type=="instagram"){echo "selected";}
                    echo' >Instagram</option>
                    <option value="linkedIn" ';if($type=="linkedIn"){echo "selected";}
                    echo '>Linked In</option>
                    <option value="website"';if($type=="website"){echo "selected";}
                    echo '>Website</option>
                    <option value="others" ';if($type=="facebook"){echo "selected";}
                    echo '>Others</option>
                    </select>
                    <input type="text" id="infoDesc" name="infoDesc[]" value="'.$info.'">
                    <button onclick="remove_field(this)" class="remove">Remove</button></div>';

                }
            
            
            ?>
                </div>
            </div>
            <input type="Submit" value="Update" name="Update">
        </form>
    </body>
</html>

