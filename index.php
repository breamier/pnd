<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Personal Networking Database</title>
        <link rel="icon" type="image/x-icon" href="">
        <script src="script.js"></script>
    </head>
    <body>

        <h2>Add Contact Information</h2>
        <form action="addContact.php" method="post">
            <label for="fname">First Name:</label><br>
            <input type="text" id="fname" name="fname"><br>

            <label for="lname">Last Name:</label><br>
            <input type="text" id="lname" name="lname"><br>

            <label for="birthdate">Birthdate:</label><br>
            <input class="expand" type="date" name="birthdate"><br>

            <label for="gender">Gender:</label><br>
            <input type="radio" name="gender" value="male">Male<br>
            <input type="radio" name="gender" value="female">Female<br>
            <input type="radio" name="gender" value="pnts">Prefer Not to Say<br>
            <input type="radio" name="gender" value="others">Others<br>

            <label for="contact">Contact Information:</label><br>
            <div id="contactInfo">
                <div>
                    <label for="infoType">Contact: </label>
                    <select class="expand" name="infoType1">
                        <option value="" disabled="">--Select Type--</option>
                        <option value="phoneNum">Phone Number</option>
                        <option value="email">Email</option>
                        <option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
                        <option value="linkedIn">Linked In</option>
                        <option value="website">Website</option>
                        <option value="others">Others</option>
                    </select>
                    <input type="text" id="infoDesc1" name="infoDesc"><br>
                </div>
            </div>        
            <input type="submit">

            <button onclick="add_field()">Add</button>
        </form>
        

        <h2>Add Affiliation</h2>
        <form action="addAffiliation.php" method="get">
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
            <label for="city">City:</label><br>
            <input type="text" id="city" name="city"><br>

            <label for="province">Province:</label><br>
            <input type="text" id="province" name="province"><br>

            <label for="country">Country:</label><br>
            <input type="text" id="country" name="country"><br>

            <input type="submit">
        </form>
    </body>
</html>