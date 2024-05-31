<!DOCTYPE html>
<?php
include 'dbConnect.php';
    $id = $_REQUEST["id"];
    $sql  = "SELECT * FROM Individual WHERE IndividualID = '$id'";
    $result = $conn->query($sql)->fetch_assoc();
?>
<?php
if(isset($_POST['Update'])){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $infoTypes = $_POST["infoType"]; 
    $infoDescs = $_POST["infoDesc"];

    list($year, $month, $day) = explode('-', $birthdate);
    $sql = "UPDATE Individual
            SET Fname='$fname', Lname='$LName', Month = '$month', Day = '$day', Year = '$year', Gender='$gender'
            WHERE IndividualID = '$id'";
    if($conn->query($sql) === TRUE){
        echo "Added Individual Info";
    } else {
        echo "Error";
    }

    // retrieves last inserted contact id
    $idv_id = $id;
    $sql = "DELETE FROM individual_contactinfo WHERE IndividualID = $id";
    $conn->query($sql);
    $sql = "DELETE FROM contactinformation WHERE IndividualID = $id";
    $conn->query($sql);
    for($i = 0 ; $i < count($infoTypes); $i++){
        $sql_contactInfo = "INSERT INTO `contactinformation`(`Type`, `Description`, `IndividualID`, `AffiliationID`)
            VALUES ('$infoTypes[$i]', '$infoDescs[$i]', '$idv_id', NULL)";

        if($conn->query($sql_contactInfo) === TRUE){
            echo "Added to Contact Info Table Successfully";
        }

        $sql_idvContact = "INSERT INTO `individual_contactinfo`(`IndividualID`, `Type`, `Description`)
            VALUES ('$idv_id', '$infoTypes[$i]', '$infoDescs[$i]')";

        if($conn->query($sql_idvContact) === TRUE){
            echo "Added to Individual Contact Table Successfully";
        }
    }   

}
    
?>
<html>
<?php include 'components/compHead.php'; ?>
    <body>
    <?php include 'components/compNav.php'?>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" autocomplete="off" class="add">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <h2 class="form-label">Update Contact</h2>
            <label for="name">Name:</label><br>
            <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo $result['FName']?>">
            <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo $result['LName']?>"><br>

            <label for="birthdate">Birthdate:</label><br>
            <input class="expand" type="date" name="birthdate" ><br>

            <label for="gender">Gender:</label><br>
            <input type="radio" name="gender" value="male" <?php if($result['Gender']=='male'){echo 'selected';}?>>Male<br>
            <input type="radio" name="gender" value="female" <?php if($result['Gender']=='female'){echo 'selected';}?>>Female<br>
            <input type="radio" name="gender" value="pnts" <?php if($result['Gender']=='pnts'){echo 'selected';}?>>Prefer Not to Say<br>
            <input type="radio" name="gender" value="others" <?php if($result['Gender']=='others'){echo 'selected';}?>>Others<br>

            <label for="contact">Contact Information:</label>
            <div id="contactInfo">
                <a onclick="add_field()"><img src="images/add.png" class="add"></a>
                <?php 
                $sql = "SELECT * FROM contactinformation NATURAL JOIN individual_contactinfo WHERE IndividualID = '$id'";
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

            <input type="submit" value="Update" name="Update">
        </form>
    </body>
</html>

