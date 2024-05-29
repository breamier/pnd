<!DOCTYPE html>
<?php include 'components/compHead.php'; ?>
<html>
    <body>
        <?php include 'components/compNav.php';?>   
        <section class="section search">
        <form name="searchBar" method="post" action="<?php $_SERVER['PHP_SELF']?>">
            <input type="text" size="30" id="searchBox" name="search">
            <input type="submit" value="Search" name='button'>
            <select name="queryType" id="queryType">
                <option value="Individual">Contact</option>
                <option value="Affiliation">Affiliation</option>
                <option value="Interest">Interest</option>
            </select>
            <div id="searchResults" class="searchResults"></div>
        </form>
        </section>
        <div id="searchCards" class="searchCards">
        <?php
             include 'dbConnect.php';
            $req = '';
            if(isset($_REQUEST['button'])){  $req = $_REQUEST['button'];}

            switch($req){
                case 'Search':
                    $name = $_POST['search'];
                    $table = $_POST['queryType']; 
                    $attrib = "";
                    $id = "";
                    $link = "";
                        switch($table){
                            case 'Individual':
                                $attrib = 'FName';
                                $id = "IndividualID";
                                $link = 'profileIndividual.php';
                                break;
                            case 'Interest':
                                $attrib = 'Name';
                                $id = 'InterestID';
                                $link = 'profileInterest.php';
                                break;
                            case 'Affiliation':
                                $attrib = 'Name';
                                $id = 'AffiliationID';
                                $link = '$profileAffiliation.php';
                                break;
                            
                    
                        }
                    
                    
                    
                $query = "SELECT * FROM $table WHERE $attrib LIKE '%$name%' LIMIT 5 "; 
                // $sql = "SELECT * FROM Individual WHERE FName LIKE '%$name%'";
                $result = $conn->query($query);

                while($row = $result->fetch_assoc()){                
                    // echo    "<div class='result'>".
                    //         "<a href='profileIndividual.php?id=".$row[$id]."><p>".$row[$attrib]." ".$contact["LName"]."</p></a>".
                    //         "<br></div>";
                    echo    "<div class='result'>".
                            "<a href='".$link."?id=".$row[$id]."'>".
                            "<p>".$row[$attrib]." ";
                    if($table == 'Individual'){
                        echo $row["LName"];
                    }
                    echo "</p></a></div>";

                }
                break;

            }


        ?>
        </div>
    </body>
</html>

