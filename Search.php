<!DOCTYPE html>
<head>
    <title>PND</title>
</head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script>
function fill(value){
    $('#searchBox').val(value);
    $('#searchResults').hide();
}
$(document).ready(function(){
    $("#searchBox").keyup(function(){

        var name = $('#searchBox').val();
        if (name=="") {
            $('#searchResults').html("");
        } else {
            $.ajax({
                type: "POST", 
                url:"getSearchResults.php", 
                data: {
                    search: name
                },
                success: function(html){
                    console.log("test 5");
                    $('#searchResults').html(html).show();
                }
            });
        }
    });
});


</script>

<html>
    <body>
        <form name="searchBar" method="post" action="Search.php">
            <input type="text" size="30" id="searchBox" name="search">
            <input type="submit" value="Search" name='button'>
            <div id="searchResults">Hello</div>
        </form>
        <div id="searchCards">
        </div>
    </body>
</html>

<?php
    include 'Connect.php';
    $req = $_REQUEST['button'];

    switch($req){
        case 'Search':
            $name = $_POST['search'];
            $sql = "SELECT * FROM Individual WHERE FName LIKE '%$name%'";
            $result = $conn->query($sql);

            while($contact = $result->fetch_assoc()){
                
                echo    "<div>".
                        "<a href='Individual.php?id=".$contact["IndividualID"]."'><p>".$contact["FName"]." ".$contact["LName"]."</p></a>".
                        "<br></div>";

            }

    }


?>