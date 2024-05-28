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