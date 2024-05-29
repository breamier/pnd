<?php
include 'dbConnect.php';

$interest = ucfirst(strtolower($_POST['interest']));

// Check if the interest already exists
$sql_check = "SELECT COUNT(*) AS count FROM interest WHERE Name = '$interest'";
$result_check = $conn->query($sql_check);
$row_check = $result_check->fetch_assoc();

// If interest doesn't exist, insert it
if ($row_check['count'] == 0) {
    $sql_insert = "INSERT INTO interest (InterestID, Name) VALUES ('', '$interest')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Successfully Added";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
} else {
    echo "Interest already exists";
}

$conn->close();
?>
