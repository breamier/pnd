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
    console.log("test 1");
    $("#searchBox").keyup(function(){
        console.log("test 2");
        var name = $('#searchBox').val();
        if (name=="") {
            console.log("test 3");
            $('#searchResults').html("");
        } else {
            console.log("test 4");
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
        <form name="searchBar">
            <input type="text" size="30" id="searchBox">
            <div id="searchResults">Hello</div>
        </form>
    </body>
</html>