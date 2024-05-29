<?php
include "Connect.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Personal Networking Database</title>
        <link rel="icon" type="image/x-icon" href="">
        <link rel="stylesheet" type="text/css" href="css/styles.css"/>
        <script src="script.js"></script>
    </head>
    <body>
        <?php include 'components/compNav.php';?>
        <?php
        $sql = "SELECT AffiliationID, Name FROM affiliation";
        $result = $conn->query($sql);
                
        $affOptions = array();
                    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $affOptions[$row['AffiliationID']] = $row['Name'];
            }
        }

        $query = "SELECT InterestID, Name FROM interest";
        $result1 = $conn->query($query);

        $interestOptions = array();

        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $interestOptions[$row1['InterestID']] = $row1['Name'];
            }
        }
        ?>

        <script>
            var affOptions = <?php echo json_encode($affOptions); ?>;
            var interestOptions = <?php echo json_encode($interestOptions); ?>;
        </script>
        <header>
            <a class="logo" href="#"><img src="images/logo.png" class="logoimg"><span>Personal Networking Database</span></a>
            <a href="#">Affiliations</a>
            <a href="#">Contacts</a>
            <a href="#" class="active">Home</a>
        </header>

        <form action="addContact.php" method="post" autocomplete="off">
            <h2 class="form-label">Add a Contact</h2>
            <label for="name">Name:</label><br>
            <input type="text" id="fname" name="fname" placeholder="First Name">
            <input type="text" id="lname" name="lname" placeholder="Last Name"><br>

            <label for="birthdate">Birthdate:</label><br>
            <input class="expand" type="date" name="birthdate"><br>

            <label for="gender">Gender:</label><br>
            <input type="radio" name="gender" value="male">Male<br>
            <input type="radio" name="gender" value="female">Female<br>
            <input type="radio" name="gender" value="pnts">Prefer Not to Say<br>
            <input type="radio" name="gender" value="others">Others<br>

            <label for="contact">Contact Information:</label>
            <div id="contactInfo">
                <a onclick="add_field()"><img src="images/add.png" class="add"></a>
                <div>
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
                </div>
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
        
        <form action="addAffiliation.php" method="post" autocomplete="off">
            <h2 class="form-label">Add Affiliation</h2>
            <label for="affName">Name of Affiliation:</label><br>
            <input type="text" id="affName" name="affName"><br>

            <label for="affType">Type of Affiliation:</label><br>
            <select class="expand" name="affType">
                <option value="" disabled="">--Select Type of Affiliation--</option>
                <option value="company">Company</option>
                <option value="organization">Organization</option>
                <option value="school">School</option>
            </select><br>

            <label>Location:</label><br>
            <input type="text" id="city" name="city" placeholder="City">
            <input type="text" id="province" name="province" placeholder="Province">
            <input type="text" id="country" name="country" placeholder="Country"><br>

            <label for="contact">Contact Information:</label>
            <div id="affContactInfo">
                <a onclick="add_affContactField()"><img src="images/add.png" class="add"></a>
                <div>
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
                    <input type="text" id="infoDesc" name="infoDesc[]">
                </div>
            </div>
            <input type="submit">
        </form>
        
        <div class="interest-form">
            <form action="addInterest.php" method="post">
                <h2 class="form-label" autocomplete="off">Add A Category for Interests</h2>
                <input type="text" placeholder="e.g. Swimming, Arts" name="interest">
                <input type="submit">
            </form>
        </div>
    </body>
</html>