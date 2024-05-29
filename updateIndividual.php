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
    $affiliations = $_POST["affiliation"];
    $roles = $_POST["role"];
    $interests = $_POST['interest'];

    list($year, $month, $day) = explode('-', $birthdate);

    $sql = "INSERT INTO `Individual`(`Fname`, `LName`, `Month`, `Day`, `Year`, `IndividualID`, `Gender`)
            VALUES ('$fname', '$lname', '$month', '$day', '$year', '', '$gender')";

    if($conn->query($sql) === TRUE){
        echo "Added Individual Info";
    } else {
        echo "Error";
    }

    // retrieves last inserted contact id
    $idv_id = $conn->insert_id;
    
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

    for($j = 0; $j < count($affiliations); $j++){
        $sql_connection = "INSERT INTO `connection` (`ConnectionID`, `Role`)
            VALUES ('', '$roles[$j]')";

        if($conn->query($sql_connection) === TRUE){
            echo 'Added Connection and Role';
        }

        $conn_id = $conn->insert_id;

        $sql_establishes = "INSERT INTO `establishes`(`IndividualID`, `ConnectionID`)
            VALUES ('$idv_id', '$conn_id')";
        if($conn->query($sql_establishes) === TRUE){
            echo 'Added to Establishes';
        }
        $sql_partof = "INSERT INTO `partof`(`AffiliationID`, `ConnectionID`)
            VALUES ('$affiliations[$j]', '$conn_id')";
        if($conn->query($sql_partof) === TRUE){
            echo 'Added to partof relation';
        }
    }

    for($z = 0; $z < count($interests); $z++){
        $sql_assoc_id = "INSERT INTO `associnterest`(`AssocIntID`) VALUES('')";
        if($conn->query($sql_assoc_id)){
            echo "Inserted assoc_id";
        }

        $assoc_id = $conn->insert_id;

        $sql_idv_assoc = "INSERT INTO `individual_associnterest`(`AssocIntID`, `IndividualID`)
            VALUES('$assoc_id', '$idv_id')";

        if($conn->query($sql_idv_assoc) === TRUE){
            echo "Linked Indiv to Assoc";
        }
        $sql_assoc_int = "INSERT INTO `interest_associnterest`(`InterestID`, `AssocIntID`)
            VALUES ('".$interests[$z]."', '$assoc_id')";
        if($conn->query($sql_assoc_int) === TRUE){
            echo "Added Interest and AssocID";
        }   
    }

}
    
?>
<html>
<?php include 'components/compHead.php'; ?>
    <body>
    <?php include 'components/compNav.php'?>
    <form action="addContact.php" method="post" autocomplete="off" class="add">
            <h2 class="form-label">Add a Contact</h2>
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
                <!-- <div>
                    <select class="expand" name="infoType[]">
                        <option value="" disabled="">--Select Type--</option>
                        <option value="phoneNum">Phone Number</option>
                        <option value="email">Email</option>
                        <option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
                        <option value="linkedIn">Linked In</option>
                        <option value="website">Website</option>
                        <option value="others">Others</option>
                    </select>
                    <input type="text" id="infoDesc" name="infoDesc[]" placeholder="Description">                    
                </div> -->
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
            <label for="affiliation">Affiliations:</label>
            <div id="affiliationChoices">
                <a onclick="add_roleField()"><img src="images/add.png" class="add"></a>
                <div>
                    <select class="expand" name="affiliation[]">
                        <option value="" disabled="">--Select Type--</option>
                        <!--Retrieve Affiliations-->
                        <?php
                            foreach ($affOptions as $aff_id => $aff_name) {
                                echo "<option value='$aff_id'>$aff_name</option>";
                            }
                        ?>
                    </select>
                    <input type="text" id="role" name="role[]" placeholder="Role">
                </div>
            </div>
            <label for="interest">Interests:</label>
            <div id="interestChoices">
                <a onclick="add_interest()"><img src="images/add.png" class="add"></a>
                <div>
                    <select class="expand" name="interest[]">
                        <option value="" disabled="">--Select Interests--</option>
                        <!--Retrieve Interests-->
                        <?php
                            foreach ($interestOptions as $int_id => $int_name) {
                                echo "<option value='$int_id'>$int_name</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <input type="submit">
        </form>
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
                        <!-- <select class="expand" name="infoType[]">
                            <option value="" disabled="">--Select Type--</option>
                            <option value="phoneNum">Phone Number</option>
                            <option value="email">Email</option>
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="linkedIn">Linked In</option>
                            <option value="website">Website</option>
                            <option value="others">Others</option>
                        </select>
                        <input type="text" id="infoDesc" name="infoDesc[]"> -->

                </div>
            </div>
            <input type="Submit" value="Update" name="Update">
        </form>
    </body>
</html>

