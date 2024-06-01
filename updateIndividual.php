<!DOCTYPE html>
<?php
include 'dbConnect.php';
    $id = $_REQUEST["id"];
    $sql  = "SELECT * FROM Individual WHERE IndividualID = '$id'";
    $result = $conn->query($sql)->fetch_assoc();
    $year = $result['Year'];
    $month = $result['Month'];
    $day = $result['Day'];
    $gender = $result['Gender'];

    $date = strftime("%F", strtotime($year."-".$month."-".$day));
    $g1 = $gender == 'male' ? 'checked' : '';
    $g2 = $gender == 'female' ? 'checked' : '';
    $g3 = $gender == 'pnts' ? 'checked' : '';
    $g4 = $gender == 'others' ? 'checked' : '';
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

    list($year, $month, $day) = explode('-', $birthdate);
    $sql = "UPDATE Individual
            SET Fname='$fname', Lname='$lname', Month = '$month', Day = '$day', Year = '$year', Gender='$gender'
            WHERE IndividualID = '$id'";
    $conn->query($sql);

    // retrieves contact id
    $idv_id = $id;
    $sql = "DELETE FROM individual_contactinfo WHERE IndividualID = $id";
    $conn->query($sql);
    $sql = "DELETE FROM contactinformation WHERE IndividualID = $id";
    $conn->query($sql);
    for($i = 0 ; $i < count($infoTypes); $i++){
        $sql_contactInfo = "INSERT INTO `contactinformation`(`Type`, `Description`, `IndividualID`, `AffiliationID`)
            VALUES ('$infoTypes[$i]', '$infoDescs[$i]', '$idv_id', NULL)";

        $conn->query($sql_contactInfo);

        $sql_idvContact = "INSERT INTO `individual_contactinfo`(`IndividualID`, `Type`, `Description`)
            VALUES ('$idv_id', '$infoTypes[$i]', '$infoDescs[$i]')";

        $conn->query($sql_idvContact);
    }

    echo 'Contact Updated Successfully';

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
            <input class="expand" type="date" name="birthdate" value="<?php echo $date?>"><br>

            <label for="gender">Gender:</label><br>
            <input type="radio" name="gender" value="male" <?php echo $g1?>>Male<br>
            <input type="radio" name="gender" value="female" <?php echo $g2?>>Female<br>
            <input type="radio" name="gender" value="pnts" <?php echo $g3?>>Prefer Not to Say<br>
            <input type="radio" name="gender" value="others" <?php echo $g4?>>Others<br>

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
            </div>

            <label for="affiliation">Affiliations:</label>
            <div id="affiliationChoices">
                <a onclick="add_roleField()"><img src="images/add.png" class="add"></a>
                <?php
                    $sql_idv_aff = "SELECT a.AffiliationID, a.Name, c.Role FROM affiliation as a NATURAL JOIN partof as p NATURAL JOIN connection as c NATURAL JOIN establishes as e WHERE IndividualID = '$id'";
                    $affiliation = $conn->query($sql_idv_aff);

                    $sql = "SELECT AffiliationID, Name FROM affiliation";
                    $result = $conn->query($sql);
                            
                    $affOptions = array();
                                
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $affOptions[$row['AffiliationID']] = $row['Name'];
                        }
                    }

                    if($affiliation-> num_rows > 0){
                        while($aff_row = $affiliation->fetch_assoc()){
                            $idv_aff_id = $aff_row['AffiliationID'];
                            $idv_aff_role = $aff_row['Role'];
                            echo '<div>';
                            echo '<select class="expand" name="affiliation[]">
                                <option value="" disabled="">--Select Type--</option>';
                            foreach ($affOptions as $aff_id => $aff_name) {
                                if($idv_aff_id == $aff_id){
                                    echo "<option value='$aff_id' selected>$aff_name</option>";
                                } else {
                                    echo "<option value='$aff_id'>$aff_name</option>";
                                }
                            }
                            echo '</select>
                                    <input type="text" id="role" name="role[]" placeholder="Role" value="'.$idv_aff_role.'">
                                    <button onclick="remove_field(this)" class="remove">Remove</button></div>';
                        }
                    }
                ?>
            </div>

            <label for="interest">Interests:</label>
            <div id="interestChoices">
                <a onclick="add_interest()"><img src="images/add.png" class="add"></a>
                <?php
                    $sql_interest = "SELECT i.InterestID, i.Name FROM interest AS i NATURAL JOIN interest_associnterest as iai NATURAL JOIN individual_associnterest AS ia WHERE IndividualID = '$id'";
                    $interest = $conn->query($sql_interest);

                    $query = "SELECT InterestID, Name FROM interest";
                    $result1 = $conn->query($query);

                    $interestOptions = array();

                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            $interestOptions[$row1['InterestID']] = $row1['Name'];
                        }
                    }
                    
                    if($interest-> num_rows > 0){
                        while($int_row = $interest->fetch_assoc()){
                            $interest_id = $int_row['InterestID'];
                            $interest_name = $int_row['Name'];
                            echo '<div>';
                            echo '<select class="expand" name="interest[]">';
                            echo '<option value="" disabled="">--Select Interests--</option>';
                            foreach ($interestOptions as $int_id => $int_name) {
                                if($int_id == $interest_id){
                                    echo "<option value='$int_id' selected>$int_name</option>";
                                } else {
                                    echo "<option value='$int_id'>$int_name</option>";
                                }
                                
                            }
                            echo '</select>';
                            echo '<button onclick="remove_field(this)" class="remove">Remove</button>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
            <input type="submit" value="Update" name="Update">
        </form>
    </body>

    <script>
            var affOptions = <?php echo json_encode($affOptions); ?>;
            var interestOptions = <?php echo json_encode($interestOptions); ?>;
    </script>
</html>

