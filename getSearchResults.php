<?php
include "dbConnect.php";

if (isset($_POST['search'])){
    $name = $_POST['search'];
    $table = $_POST['table']; 

    $attrib = "";

    switch($table){
        case 'Individual':
            $attrib = 'FName';
            break;
        case 'Interest':
        case 'Affiliation':
            $attrib = 'Name';
            break;
        

    }



    $query = "SELECT $attrib FROM $table WHERE $attrib LIKE '%$name%' LIMIT 5 ";
    $queryResults = mysqli_query($conn,$query);
    
    echo '
    <ul>
    ';

    while($result = mysqli_fetch_array($queryResults)){
        ?>
        <li onclick='fill("<?php echo $result["$attrib"]; ?>")'>
        <a>
            <?php echo $result["$attrib"];?>

            
        </li></a>
    <?php
    }

}
?>

</ul>