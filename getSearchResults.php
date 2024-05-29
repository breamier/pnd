<?php
include "dbConnect.php";

if (isset($_POST['search'])){
    $name = $_POST['search'];
    $query = "SELECT FName FROM Individual WHERE FName LIKE '%$name%' LIMIT 5 ";
    $queryResults = mysqli_query($conn,$query);
    
    echo '
    <ul>
    ';

    while($result = mysqli_fetch_array($queryResults)){
        ?>
        <li onclick='fill("<?php echo $result['FName']; ?>")'>
        <a>
            <?php echo $result['FName'];?>

            
        </li></a>
        <?php
    }

}
?>

</ul>