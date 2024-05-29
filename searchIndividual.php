<!DOCTYPE html>
<?php include 'components/compHead.php'; ?>
<html>
    <body>
        <section class="section search">
        <form name="searchBar" method="post" action="<?php $_SERVER['PHP_SELF']?>">
            <input type="text" size="30" id="searchBox" name="search">
            <input type="submit" value="Search" name='button'>
            <div id="searchResults" class="searchResults"></div>
        </form>
        </section>
        <div id="searchCards" class="searchCards">
        </div>
    </body>
</html>

<?php
    include 'dbConnect.php';
    $req = '';
    if(isset($_REQUEST['button'])){   $req = $_REQUEST['button'];}

    switch($req){
        case 'Search':
            $name = $_POST['search'];
            $sql = "SELECT * FROM Individual WHERE FName LIKE '%$name%'";
            $result = $conn->query($sql);

            while($contact = $result->fetch_assoc()){
                
                echo    "<div class='result'>".
                        "<a href='profileIndividual.php?id=".$contact["IndividualID"]."'><p>".$contact["FName"]." ".$contact["LName"]."</p></a>".
                        "<br></div>";

            }

    }


?>