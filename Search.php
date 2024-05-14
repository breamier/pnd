<!DOCTYPE html>
<head>
    <title>PND</title>
</head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script>
function fill(value){
    $('#search').val(value);
    $('#display').hide();
}
$(document).ready(function(){
    $("#searchBox").keyup(function(){
        var name = $("#search").val();
        if (name=="") {
            $("#searchResults").html("");
        } else {
            $.ajax({
                type: "POST", url:"getSearchResults.php", 
                data: {
                    search:name
                },
                success: function(html){
                    $("#display").html(html).show();
                }
            });
        }
    });
});
</script>








<html>
    <body>
        <form name="searchBar">
            <input type="text" size="30" onkeyup="" id="searchBox">
            <div id="searchResults"></div>
        </form>
    </body>
</html>