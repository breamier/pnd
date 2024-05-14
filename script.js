var counter = 1;

function add_field(){
    counter+=1;
    var div = document.createElement('div');
    var html='<label for="infoType">Contact: </label>\
                <select class="expand" name="infoType'+counter+'">\
                    <option value="" disabled="">--Select Type--</option>\
                    <option value="phoneNum">Phone Number</option>\
                    <option value="email">Email</option>\
                    <option value="facebook">Facebook</option>\
                    <option value="instagram">Instagram</option>\
                    <option value="linkedIn">Linked In</option>\
                    <option value="website">Website</option>\
                    <option value="others">Others</option>\
                </select>\
                <input type="text" id="infoDesc" name="infoDesc'+counter+'"><br>'
    div.innerHTML = html;
    document.getElementById('contactInfo').appendChild(div);
}


