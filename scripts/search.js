function fill(value){
    $('#searchBox').val(value);
    $('#searchResults').hide();
}

$(document).ready(function(){
    $("#searchBox").keyup(function(){

        var toSearch = $('#searchBox').val();
        var fromTable = $('#queryType').val();
        if (toSearch=="") {
            $('#searchResults').html("");
        } else {
            $.ajax({
                type: "POST", 
                url:"getSearchResults.php", 
                data: {
                    search: toSearch,
                    table: fromTable
                },
                success: function(html){
                    console.log("test 5");
                    $('#searchResults').html(html).show();
                }
            });
        }
    });
});