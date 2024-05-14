<?php
include "Connect.php";

if (isset($_POST['search'])){
    $name = $_POST['search'];
    $query = "SELECT Name FROM Individual WHERE Name LIKE '%$name' LIMIT 5 ";
    $queryResults = mysqli_query($conn,$query);
    
    echo '
    <ul>
    ';

    while($result = mysqli_fetch_array($queryResults)){
        ?>
        <li onclick='fill("<?php echo $result['name']; ?>")'>
        <a>
            <?php echo $result['name'];?>

        
        </li></a>
        <?php
    }

}
?>

</ul>