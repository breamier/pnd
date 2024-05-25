function add_field(){
    var div = document.createElement('div');
    var html=`<label for="infoType">Contact: </label>\
                <select class="expand" name="infoType[]">\
                    <option value="" disabled="">--Select Type--</option>\
                    <option value="phoneNum">Phone Number</option>\
                    <option value="email">Email</option>\
                    <option value="facebook">Facebook</option>\
                    <option value="instagram">Instagram</option>\
                    <option value="linkedIn">Linked In</option>\
                    <option value="website">Website</option>\
                    <option value="others">Others</option>\
                </select>\
                <input type="text" id="infoDesc" name="infoDesc[]">\
                <button onclick="remove_field(this)">Remove</button>`;
    div.innerHTML = html;
    document.getElementById('contactInfo').appendChild(div);
}

function remove_field(element) {
    element.parentNode.remove();
}

function add_affContactField(){
    var div = document.createElement('div');
    var html=`<label for="infoType">Contact: </label>\
                <select class="expand" name="infoType[]">\
                    <option value="" disabled="">--Select Type--</option>\
                    <option value="phoneNum">Phone Number</option>\
                    <option value="email">Email</option>\
                    <option value="facebook">Facebook</option>\
                    <option value="instagram">Instagram</option>\
                    <option value="linkedIn">Linked In</option>\
                    <option value="website">Website</option>\
                    <option value="others">Others</option>\
                </select>\
                <input type="text" id="infoDesc" name="infoDesc[]">\
                <button onclick="remove_field(this)">Remove</button>`;
    div.innerHTML = html;
    document.getElementById('affContactInfo').appendChild(div);
}


