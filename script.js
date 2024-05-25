function add_field(){
    var div = document.createElement('div');
    var html=`<select class="expand" name="infoType[]">\
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
    var html=`<select class="expand" name="infoType[]">\
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

function add_roleField(){
    var div = document.createElement('div');
    var html = `<select class="expand" name="affiliation[]">
                        <option value="" disabled="">--Select Type--</option>`;
                        for (var aff_id in affOptions) {
                            html += `<option value="${aff_id}">${affOptions[aff_id]}</option>`;
                        }
                        
                        html += `</select>
                    <input type="text" id="role" name="role[]" placeholder="Role">
                    <button onclick="remove_field(this)">Remove</button>`;
    div.innerHTML = html;
    document.getElementById('affiliationChoices').appendChild(div);
}


