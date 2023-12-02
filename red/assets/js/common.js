$('#flFrom').autocomplete({
    source: function (request, response) {
        $.ajax({
            url: Site_Url+'/home/flight_autofill',
            dataType: "json",
            data: {
                name_startsWith: request.term,
                type: 'country'
            },
            success: function (data) {
                response($.map(data, function (item) {
                    return {
                        label: item,
                        value: item
                    }
                }));
            }
        });
    },
    select: function (event , ui){
        var to = $('#flTo').val();
        var from = ui.item.label;
        if(from != '' && to != ''){
            var frmSplit = from.split(',');
            var fromCountry = frmSplit[1];
            fromCountry = fromCountry.trim();
            var toSplit = to.split(',');
            var toCountry = toSplit[1];
            toCountry = toCountry.trim();
            if(fromCountry == 'Philippines' && toCountry == 'Philippines'){
                $('#sr_ctzn_div').show();
            } else {
                $('#sr_ctzn_div').hide();
            }
        } else {
            var frmSplit = from.split(',');
            var fromCountry = frmSplit[1];
            fromCountry = fromCountry.trim();
            if(fromCountry == 'Philippines'){
                $('#sr_ctzn_div').show();
            } else {
                $('#sr_ctzn_div').hide();
            }
        }
        
        $('#flTo').focus();
    },
    autoFocus: true,
    minLength: 3
});

$('#flTo').autocomplete({
    source: function (request, response) {
        $.ajax({
            url: Site_Url+'/home/flight_autofill',
            dataType: "json",
            data: {
                name_startsWith: request.term,
                type: 'country'
            },
            success: function (data) {
                response($.map(data, function (item) {
                    return {
                        label: item,
                        value: item
                    }
                }));   }
        });
    },
    select: function (event , ui){
        var to = ui.item.label;
        var from = $('#flFrom').val();
        if(from != '' && to != ''){
            var frmSplit = from.split(',');
            var fromCountry = frmSplit[1];
            fromCountry = fromCountry.trim();
            var toSplit = to.split(',');
            var toCountry = toSplit[1];
            toCountry = toCountry.trim();
            if(fromCountry == 'Philippines' && toCountry == 'Philippines'){
                $('#sr_ctzn_div').show();
            } else {
                $('#sr_ctzn_div').hide();
            }
        } else {
            var toSplit = to.split(',');
            var toCountry = toSplit[1];
            toCountry = toCountry.trim();
            if(toCountry == 'Philippines'){
                $('#sr_ctzn_div').show();
            } else {
                $('#sr_ctzn_div').hide();
            }
        }
        $('#flSd').focus();
    },
    autoFocus: true,
    minLength: 3
});

$('#pref_air').autocomplete({
    source: function (request, response) {
        $.ajax({
            url: Site_Url+'/home/getPreferredAirline',
            dataType: "json",
            data: {
                name_startsWith: request.term,
                type: 'country'
            },
            success: function (data) {
                response($.map(data, function (item) {
                    return {
                        label: item,
                        value: item
                    }
                }));   }
        });
    },
    autoFocus: true,
    minLength: 3
});

$('#act_city').autocomplete({
    source: function (request, response) {
        $.ajax({
            url: Site_Url+'/home/activity_autofill',
            dataType: "json",
            data: {
                name_startsWith: request.term,
                type: 'country'
            },
            success: function (data) {
                response($.map(data, function (item) {
                    return {
                        label: item,
                        value: item
                    }
                }));   
            }
        });
    },
    autoFocus: true,
    minLength: 3
});

$('#hotel_dest').autocomplete({
    source: function (request, response) {
        $.ajax({
            url: Site_Url + '/home/hotel_autofill',
            dataType: "json",
            data: {
                name_startsWith: request.term,
                type: 'country'
            },
            success: function (data) {
                response($.map(data, function (item) {
                    return {
                        label: item,
                        value: item
                    }
                }));
            }
        });
    },

    autoFocus: true,
    minLength: 0
});

function checkPaxCount(){
    $('#error_message').hide();
    var adult = $('#s1').val();
    var child = $('#s2').val();
    var infant = $('#s3').val();
    adult = parseFloat(adult);
    child = parseFloat(child);
    infant = parseFloat(infant);
    var msg = '';
    var count = adult+child+infant;
    if(count > 9){
        msg = '<strong>Alert!</strong> The total number of passenger allowed is 9. If you want to book more than 9 passengers then contact us at support@asfartravels.com';
    }
    else if(infant > adult){
        msg = '<strong>Alert!</strong> Infant passenger count can not be greater than adult count';
    } else { 
        msg ='';
    }
    
    if(msg != ''){
        $('#show_message').html(msg);
        $('#error_message').show();
    }
} 

function chkValidateOneWay(){
   
    var from = $('#onewayFrom').val();
    var to = $('#onewayTo').val();
    var sd = $('#hdateF').val();
    var adult = $('#s1').val();
    var child = $('#s2').val();
    var infant = $('#s3').val();
    var travel_class = $('#classType2').val();
    var flag = true;
    
    if(from === '' || from === 'undefined'){
        flag = false;
        $('#show_message').append('Select leaving from location from the auto suggetions.<br />');
        
    }
    if(to === '' || to === 'undefined'){
        flag = false;
        $('#show_message').append('Select going to location from the auto suggetions.<br />');
    }
    if(sd === '' || sd === 'undefined'){
        flag = false;
        $('#show_message').append('Select journey dates.<br />');
    }
    if(from !== ''){
        if(from.indexOf('$') > -1 || from.indexOf('%') > -1 || from.indexOf('&') > -1)
        {
            flag = false;
            $('#show_message').append('Select leaving from location from the auto suggetions.<br />');
        }
        if(!(from.indexOf(',') > -1)){
            flag = false;
            $('#show_message').append('Select leaving from location from the auto suggetions.<br />');
        }
    }
    if(to !== ''){
        if(to.indexOf('$') > -1 || to.indexOf('%') > -1 || to.indexOf('&') > -1)
        {
            flag = false;
            $('#show_message').append('Select going to location from the auto suggetions.<br />');
        }
        if(!(to.indexOf(',') > -1)){
            flag = false;
            $('#show_message').append('Select going to location from the auto suggetions.<br />');
            
        }
    }
    if(from !== '' && to !== '' && from === to){
        flag = false;
        $('#show_message').html('From and To location should be different.');
    }

    if(flag === true){
        $('#flight_form').submit();
    } else {
        $('#error_message').show();
        setTimeout(function() { $("#error_message").hide(); }, 10000);
        return false;
    }
}

function chkValidateHotel(){
    var dest = $('#hotel_dest').val();
    var sd = $('#hotel_sd').val();
    var ed = $('#hotel_ed').val();
    var flag = true;
    if(dest === '' || dest === 'undefined'){
        flag = false;
        $('#show_message').append('Select your destination, where you want to go.<br />');
    }
    if(sd === '' || sd === 'undefined'){
        flag = false;
        $('#show_message').append('Select your check in date.<br />');
    }
    if(ed === '' || ed === 'undefined'){
        flag = false;
        $('#show_message').append('Select your check out date.<br />');
    }
    if(dest !== ''){
        if(dest.indexOf('$') > -1 || dest.indexOf('%') > -1 || dest.indexOf('&') > -1)
        {
            flag = false;
            $('#show_message').append('Select correct destination from the suggestions given.<br />');
        }
        if(!(dest.indexOf(',') > -1)){
            flag = false;
            $('#show_message').append('Select correct destination from the suggestions given.<br />');
        }
    }
    if(sd !== '' && ed !== '' && sd === ed){
        flag = false;
        $('#show_message').html('Check in and check out dates should be different.');
    }
    
    if(flag === true){
        $('#hotel_frm').submit();
    } else {
        $('#error_message').show();
        setTimeout(function() { $("#error_message").hide(); }, 10000);
        return false;
    }
    
}

function show_room_info(room_count)
{
    if (room_count == '')
    {
        room_count = 0;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("room_info").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", Site_Url + "/home/adult_child_binding/" + room_count, true);
    xmlhttp.send();
}

function show_room_info_mod(room_count)
{
    if (room_count == '')
    {
        room_count = 0;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("room_info").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", Site_Url + "/home/adult_child_binding_mod/" + room_count, true);
    xmlhttp.send();
}

function show_child_age_info(child_count,room_id)
{
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var child_age_val = "child_age" + room_id
            document.getElementById(child_age_val).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", Site_Url + "/home/child_age_binding/" + child_count + "/" + room_id, true);
    xmlhttp.send();
}

function show_child_age_info_mod(child_count,room_id)
{
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var child_age_val = "child_age" + room_id
            document.getElementById(child_age_val).innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", Site_Url + "/home/child_age_binding_mod/" + child_count + "/" + room_id, true);
    xmlhttp.send();
}

function validateAgentReg(){
        var name = $('#agent_name').val();
        var email = $('#agent_email').val();
        var phCode = $('#phone_code').val();
        var phNo = $('#phone_no').val();
        $("#agent_name_error").hide();
        $("#agent_email_error").hide();
        $("#agent_code_error").hide();
        $("#agent_phone_error").hide();
        var flag = true;
        if(name == '' || name == 'undefined'){
            $("#agent_name_error").show();
            $("#agent_name_error").html("Please enter your name.");
            flag = false;
        }
        if(email == '' || email == 'undefined'){
            $("#agent_email_error").show();
            $("#agent_email_error").html("Please enter your email.");
            flag = false;
        }
        if(phCode == '' || phCode == 'undefined'){
            $("#agent_code_error").show();
            $("#agent_code_error").html("Invalid Code");
            flag = false;
        }
        if(phNo == '' || phNo == 'undefined'){
            $("#agent_phone_error").show();
            $("#agent_phone_error").html("Please enter phone no.");
            flag = false;
        }
        if (email != 'undefined' && email != ''){
            check = validateEmail(email);
            if (!check){
                $("#agent_email_error").show();
                $("#agent_email_error").html("Please enter valid email.");
                flag = false;
            }
        }
        
        return flag;
}

function validateAgentLogin(){
    var email = $('#agent_login_email').val();
    var pass = $('#agent_login_pass').val();
    $("#agent_login_email_error").hide();
    $("#agent_login_pass_error").hide();
   
    var flag = true;
    if(email == '' || email == 'undefined'){
        $("#agent_login_email_error").show();
        $("#agent_login_email_error").html("Please enter your email.");
        flag = false;
    }
    if(pass == '' || pass == 'undefined'){
        $("#agent_login_pass_error").show();
        $("#agent_login_pass_error").html("Please enter your password.");
        flag = false;
    }
    if (email != 'undefined' && email != ''){
        check = validateEmail(email);
        if (!check){
            $("#agent_login_email_error").show();
            $("#agent_login_email_error").html("Please enter valid email.");
            flag = false;
        }
    }
    
    return flag;
}

function validateEmail(sEmail)
{
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    } else {
        return false;
    }
}

var digitsOnly = /[1234567890]/g;
var decimalOnly = /[1234567890.]/g;
var integerOnly = /[0-9\.]/g;
var alphaOnly = /[A-Za-z]/g;
function restrictCharacters(myfield, e, restrictionType) {

	if (!e) var e = window.event
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);

	// if they pressed esc... remove focus from field...
	if (code==27) { this.blur(); return false; }
	
	// ignore if they are press other keys
	// strange because code: 39 is the down key AND ' key...
	// and DEL also equals .
	if (!e.ctrlKey && code!=9 && code!=8 && code!==36 && code!==37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
		if (character.match(restrictionType)) {
			return true;
		} else {
			return false;
		}
		
	}
}

function showDepositType(val)
{
    if(val == 'Cash')
    {
        $('#cash_div_block1').show();
        $('#cash_div_block2').show();
        $('#cheque_div_block1').hide();
        $('#cheque_div_block2').hide();
        $('#bank_transfer_div_block1').hide();
        $('#bank_transfer_div_block2').hide();
    }
    if(val == 'Cheque')
    {
        $('#cash_div_block1').hide();
        $('#cash_div_block2').hide();
        $('#cheque_div_block1').show();
        $('#cheque_div_block2').show();
        $('#bank_transfer_div_block1').hide();
        $('#bank_transfer_div_block2').hide();
    }
    if(val == 'Bank Transfer')
    {
        $('#cash_div_block1').hide();
        $('#cash_div_block2').hide();
        $('#cheque_div_block1').hide();
        $('#cheque_div_block2').hide();
        $('#bank_transfer_div_block1').show();
        $('#bank_transfer_div_block2').show();
    }
}

function addDepositCheckSubmit(){
    var flag = true;
    $('#success_div').hide();
    $('#error_div').hide();
    var deposit_type = $('#deposit_type').val();
    var mobile_number = $('#mobile_number').val();
    var deposit_amount = $('#deposit_amount').val();
    if(deposit_type === 'Cash'){
        var cash_deposit_bank = $('#cash_deposit_bank').val();
        var cash_scan_copy = $('#cash_scan_copy').val();
        var cash_transection_id = $('#cash_transection_id').val();
        var cash_bank_branch = $('#cash_bank_branch').val();
        
        if(deposit_amount == '' || deposit_amount == 'undefined'){
            $("#deposit_amount_error").show();
            $("#deposit_amount_error").html("Please enter the deposit amount.");
            flag = false;
        }
        if(cash_deposit_bank == '' || cash_deposit_bank == 'undefined'){
            $("#cash_deposit_bank_error").show();
            $("#cash_deposit_bank_error").html("Please select deposit bank.");
            flag = false;
        }
        if(cash_transection_id == '' || cash_transection_id == 'undefined'){
            $("#cash_transection_id_error").show();
            $("#cash_transection_id_error").html("Please enter transection id given by bank.");
            flag = false;
        }
        if(cash_bank_branch == '' || cash_bank_branch == 'undefined'){
            $("#cash_bank_branch_error").show();
            $("#cash_bank_branch_error").html("Please enter the deposit branch name.");
            flag = false;
        }
    } else if(deposit_type === 'Cheque'){
        var cheque_drawn_bank = $('#cheque_drawn_bank').val();
        var cheque_no = $('#cheque_no').val();
        var cheque_bank_branch = $('#cheque_bank_branch').val();
        var cheque_transection_id = $('#cheque_transection_id').val();
        var cheque_issue_date = $('#cheque_issue_date').val();
        var cheque_deposit_bank = $('#cheque_deposit_bank').val();
        var cheque_scan_copy = $('#cheque_scan_copy').val();
        if(deposit_amount == '' || deposit_amount == 'undefined'){
            $("#deposit_amount_error").show();
            $("#deposit_amount_error").html("Please enter the deposit amount.");
            flag = false;
        }
        if(cheque_drawn_bank == '' || cheque_drawn_bank == 'undefined'){
            $("#cheque_drawn_bank_error").show();
            $("#cheque_drawn_bank_error").html("Please select drawn bank.");
            flag = false;
        }
        if(cheque_no == '' || cheque_no == 'undefined'){
            $("#cheque_no_error").show();
            $("#cheque_no_error").html("Please enter cheque or DD no.");
            flag = false;
        }
        if(cheque_bank_branch == '' || cheque_bank_branch == 'undefined'){
            $("#cheque_bank_branch_error").show();
            $("#cheque_bank_branch_error").html("Please select bank branch");
            flag = false;
        }
        if(cheque_transection_id == '' || cheque_transection_id == 'undefined'){
            $("#cheque_transection_id_error").show();
            $("#cheque_transection_id_error").html("Please enter transection id given by bank.");
            flag = false;
        }
        if(cheque_issue_date == '' || cheque_issue_date == 'undefined'){
            $("#cheque_issue_date_error").show();
            $("#cheque_issue_date_error").html("Please enter cheque issue date.");
            flag = false;
        }
        if(cheque_deposit_bank == '' || cheque_deposit_bank == 'undefined'){
            $("#cheque_deposit_bank_error").show();
            $("#cheque_deposit_bank_error").html("Please select cheque deposit bank.");
            flag = false;
        }
        if(cheque_scan_copy == '' || cheque_scan_copy == 'undefined'){
            $("#cheque_scan_copy_error").show();
            $("#cheque_scan_copy_error").html("Please upload receipt scan copy.");
            flag = false;
        }
    } else if(deposit_type === 'Bank Transfer'){
        var bank_transfer_deposit_bank = $('#bank_transfer_deposit_bank').val();
        var bank_transfer_scan_copy = $('#bank_transfer_scan_copy').val();
        var bank_transfer_transection_id = $('#bank_transfer_transection_id').val();
        var bank_transfer_bank_branch = $('#bank_transfer_bank_branch').val();
        if(deposit_amount == '' || deposit_amount == 'undefined'){
            $("#deposit_amount_error").show();
            $("#deposit_amount_error").html("Please enter the deposit amount.");
            flag = false;
        }
        if(bank_transfer_deposit_bank == '' || bank_transfer_deposit_bank == 'undefined'){
            $("#bank_transfer_deposit_bank_error").show();
            $("#bank_transfer_deposit_bank_error").html("Please select deposit bank.");
            flag = false;
        }
        if(bank_transfer_scan_copy == '' || bank_transfer_scan_copy == 'undefined'){
            $("#bank_transfer_scan_copy_error").show();
            $("#bank_transfer_scan_copy_error").html("Please upload receipt scan copy.");
            flag = false;
        }
        if(bank_transfer_transection_id == '' || bank_transfer_transection_id == 'undefined'){
            $("#bank_transfer_transection_id_error").show();
            $("#bank_transfer_transection_id_error").html("Please enter transection id given by bank.");
            flag = false;
        }
        if(bank_transfer_bank_branch == '' || bank_transfer_bank_branch == 'undefined'){
            $("#bank_transfer_bank_branch_error").show();
            $("#bank_transfer_bank_branch_error").html("Please enter branch deposited in.");
            flag = false;
        }
    }
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#deposit_add')[0]);
        $.ajax({
            xhr: function () {  
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/home/add_deposit_data',
            beforeSend: function ()
            {
                $('#submit_add_deposit').attr('disabled', true);
                $('#loding_deposit_submit').show();
            },
            success: function (data) {
                if(data.result == '1'){
                    $('#error_div').show();
                }
                if(data.result == '0'){
                    $('#success_div').show();
                }
                $('#loding_deposit_submit').hide();
                $('#submit_add_deposit').attr('disabled', false);
            },
            error: function () {
                $('#error_div').show();
                $('#loding_deposit_submit').hide();
                $('#submit_add_deposit').attr('disabled', false);
            },
        });
    } else {
        return false;
    }
}

function checkUpdateUserData(){
    var flag = true;
    $('#user_success').hide();
    $('#user_error').hide();
    var agent_name = $('#agent_name').val();
    var address = $('#address').val();
    var city = $('#city').val();
    var phone_code = $('#phone_code').val();
    var phone_no = $('#phone_no').val();
    var company_name = $('#company_name').val();
    var zip_code = $('#zip_code').val();
    var country = $('#country').val();
    
    if(agent_name == '' || agent_name == 'undefined'){
        $("#agent_name_error").show();
        $("#agent_name_error").html("Please select agent name.");
        flag = false;
    }
    if(phone_code == '' || phone_code == 'undefined'){
        $("#phone_no_error").show();
        $("#phone_no_error").html("Please enter agent contact number.");
        flag = false;
    }
    if(phone_no == '' || phone_no == 'undefined'){
        $("#phone_no_error").show();
        $("#phone_no_error").html("Please enter agent contact number.");
        flag = false;
    }
    if(company_name == '' || company_name == 'undefined'){
        $("#company_name_error").show();
        $("#company_name_error").html("Please enter company name.");
        flag = false;
    }
    if(country == '' || country == 'undefined'){
        $("#country_error").show();
        $("#country_error").html("Please select your country.");
        flag = false;
    }
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#user_profile')[0]);
        $.ajax({
            xhr: function () {  
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/home/update_user_profile',
            beforeSend: function ()
            {
                $('#submit_user_profile').attr('disabled', true);
                $('#loding_user_submit').show();
            },
            success: function (data) {
                if(data.result == '1'){
                    $('#user_error').show();
                }
                if(data.result == '0'){
                    $('#user_success').show();
                }
                $('#loding_user_submit').hide();
                $('#submit_user_profile').attr('disabled', false);
            },
            error: function () {
                $('#user_error').show();
                $('#loding_user_submit').hide();
                $('#submit_user_profile').attr('disabled', false);
            },
        });
    } else {
        return false;
    }
    
}

function checkUpdateUserPass(){
    var flag = true;
    $('#pass_success').hide();
    $('#pass_error').hide();
    var old_pass = $('#old_pass').val();
    var new_pass = $('#new_pass').val();
    var conf_pass = $('#conf_pass').val();
    if(old_pass == '' || old_pass == 'undefined'){
        $("#old_pass_error").show();
        $("#old_pass_error").html("Please enter old password.");
        flag = false;
    }
    if(new_pass == '' || new_pass == 'undefined'){
        $("#new_pass_error").show();
        $("#new_pass_error").html("Please enter new password.");
        flag = false;
    }
    if(conf_pass == '' || conf_pass == 'undefined'){
        $("#conf_pass_error").show();
        $("#conf_pass_error").html("Please confirm your password.");
        flag = false;
    }
    if(new_pass !== conf_pass){
        $("#conf_pass_error").show();
        $("#conf_pass_error").html("New and confirm password does not match.");
        flag = false;
    }
    if(old_pass === new_pass){
        $("#new_pass_error").show();
        $("#new_pass_error").html("New password is same as existing password.");
        flag = false;
    }
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#change_pass')[0]);
        $.ajax({
            xhr: function () {  
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/home/update_user_password',
            beforeSend: function ()
            {
                $('#update_pass').attr('disabled', true);
                $('#loding_update_pass_submit').show();
            },
            success: function (data) {
                if(data.result == '1'){
                    $('#pass_error').show();
                }
                if(data.result == '0'){
                    $('#pass_success').show();
                }
                $('#loding_update_pass_submit').hide();
                $('#update_pass').attr('disabled', false);
            },
            error: function () {
                $('#pass_error').show();
                $('#loding_update_pass_submit').hide();
                $('#update_pass').attr('disabled', false);
            },
        });
    } else {
        return false;
    }
    
}

function addNewSubAgentData(){
    var flag = true;
    $('#subagent_success').hide();
    $('#subagent_error').hide();
    var agent_name = $('#sub_agent_name').val();
    var address = $('#sub_agent_address').val();
    var city = $('#sub_agent_city').val();
    var phone_code = $('#sub_agent_phone_code').val();
    var phone_no = $('#sub_agent_phone_no').val();
    var company_name = $('#sub_agent_company_name').val();
    var zip_code = $('#sub_agent_zip_code').val();
    var country = $('#sub_agent_country').val();
    var email = $('#sub_email_id').val();
    var pass = $('#sub_pass').val();
    var conf_pass = $('#sub_conf_pass').val();
    
    if(agent_name == '' || agent_name == 'undefined'){
        $("#sub_agent_name_error").show();
        $("#sub_agent_name_error").html("Please select sub agent name.");
        flag = false;
    }
    if(phone_code == '' || phone_code == 'undefined'){
        $("#sub_agent_phone_no_error").show();
        $("#sub_agent_phone_no_error").html("Please enter agent contact number.");
        flag = false;
    }
    if(phone_no == '' || phone_no == 'undefined'){
        $("#sub_agent_phone_no_error").show();
        $("#sub_agent_phone_no_error").html("Please enter agent contact number.");
        flag = false;
    }
    if(company_name == '' || company_name == 'undefined'){
        $("#sub_agent_company_name_error").show();
        $("#sub_agent_company_name_error").html("Please enter company name.");
        flag = false;
    }
    if(country == '' || country == 'undefined'){
        $("#sub_agent_country_error").show();
        $("#sub_agent_country_error").html("Please select sub agent country.");
        flag = false;
    }
    if(email == '' || email == 'undefined'){
        $("#sub_email_id_error").show();
        $("#sub_email_id_error").html("Please enter agent email id.");
        flag = false;
    }
    if(pass == '' || pass == 'undefined'){
        $("#sub_pass_error").show();
        $("#sub_pass_error").html("Please enter login password.");
        flag = false;
    }
    if(conf_pass == '' || conf_pass == 'undefined'){
        $("#sub_conf_error").show();
        $("#sub_conf_error").html("Please enter confirm password.");
        flag = false;
    }
    if(pass !== conf_pass){
        $("#sub_conf_error").show();
        $("#sub_conf_error").html("Password and confirm password not match.");
        flag = false;
    }
    if (email != 'undefined' && email != ''){
        check = validateEmail(email);
        if (!check){
            $("#sub_email_id_error").show();
            $("#sub_email_id_error").html("Please enter valid email.");
            flag = false;
        }
    }
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#subagent_add')[0]);
        $.ajax({
            xhr: function () {  
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/home/add_subagent_data',
            beforeSend: function ()
            {
                $('#submit_subagent_profile').attr('disabled', true);
                $('#loding_subagent_submit').show();
            },
            success: function (data) {
                if(data.err == '1'){
                    $('#subagent_error_text').html(data.result);
                    $('#subagent_error').show();
                }
                if(data.err == '0'){
                    $('#subagent_success_text').html(data.result);
                    $('#subagent_success').show();
                    $('#subagent_add')[0].reset();
                    $(window).scrollTop(0);
                }
                $('#loding_subagent_submit').hide();
                $('#submit_subagent_profile').attr('disabled', false);
            },
            error: function () {
                $('#subagent_error_text').html('Sub Agent could not be added. Please try again in some time.');
                $('#loding_subagent_submit').hide();
                $('#submit_subagent_profile').attr('disabled', false);
            },
        });
    } else {
        return false;
    }
}

function updateAgentFlMarkupDetails(){
    var flag = true;
    $('#flMarkup_success').hide();
    $('#flMarkup_error').hide();
    var markup_type = $('#flight_markup_type').val();
    var AirPhilExpress = $('#AirPhilExpress').val();
    var SeaAir = $('#SeaAir').val();
    var CebuPacific = $('#CebuPacific').val();
    var ZestAir = $('#ZestAir').val();
    var PhilpinesAirline = $('#PhilpinesAirline').val();
    var intel_flight_amount = $('#intel_flight_amount').val();
    if(markup_type == '' || markup_type == 'undefined'){
        $('#flMarkup_error_text').html('Please select markup type for the flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(AirPhilExpress == '' || AirPhilExpress == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(SeaAir == '' || SeaAir == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(CebuPacific == '' || CebuPacific == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(ZestAir == '' || ZestAir == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(PhilpinesAirline == '' || PhilpinesAirline == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(intel_flight_amount == '' || intel_flight_amount == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else {
        flag = true;
    }
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#fl_markup_add')[0]);
        $.ajax({
            xhr: function () {
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/home/update_flight_markup',
            beforeSend: function ()
            {
                $('#update_fl_markup_submit').attr('disabled', true);
                $('#loding_flMarkup_submit').show();
            },
            success: function (data) {
                if(data.result == '1'){
                    $('#flMarkup_error_text').html('Please add markup to any of the domestic or international flight.');
                    $('#flMarkup_error').show();
                }
                if(data.result == '0'){
                    $('#flMarkup_success_text').html('The flight markup details successfully updated.');
                    $('#flMarkup_success').show();
                }
                $('#loding_flMarkup_submit').hide();
                $('#update_fl_markup_submit').attr('disabled', false);
                $(window).scrollTop(0);
            },
            error: function () {
                $('#flMarkup_error_text').html('The markup could not be updated. Kindly try again.');
                $('#flMarkup_error').show();
                $('#loding_flMarkup_submit').hide();
                $('#update_fl_markup_submit').attr('disabled', false);
                $(window).scrollTop(0);
            },
        });
    } else {
        return false;
    }
    
}

function updateAgentHoMarkupDetails(){
    var flag = true;
    $('#hoMarkup_success').hide();
    $('#hoMarkup_error').hide();
    $('#domhoMarkup_error').hide();
    $('#intlhoMarkup_error').hide();
    var markup_type = $('#hotel_markup_type').val();
    var intl_markup = $('#intlHo_markup_amount').val();
    var dom_markup = $('#domHo_markup_amount').val();
    if(dom_markup == '' || dom_markup == 'undefined'){
        $('#domhoMarkup_error_text').html('Please add domestic markup amount.');
        $('#domhoMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } 
    if(intl_markup == '' || intl_markup == 'undefined'){
        $('#intlhoMarkup_error_text').html('Please add international markup amount.');
        $('#intlhoMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    }
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#ho_markup_add')[0]);
        $.ajax({
            xhr: function () {
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/home/update_hotel_markup',
            beforeSend: function ()
            {
                $('#update_ho_markup_submit').attr('disabled', true);
                $('#loding_hoMarkup_submit').show();
            },
            success: function (data) {
                if(data.result == '1'){
                    $('#hoMarkup_error_text').html('Please add markup for hotel.');
                    $('#hoMarkup_error').show();
                }
                if(data.result == '0'){
                    $('#hoMarkup_success_text').html('The hotel markup details successfully updated.');
                    $('#hoMarkup_success').show();
                }
                $('#loding_hoMarkup_submit').hide();
                $('#update_ho_markup_submit').attr('disabled', false);
            },
            error: function () {
                $('#hoMarkup_error_text').html('The markup could not be updated. Kindly try again.');
                $('#hoMarkup_error').show();
                $('#loding_hoMarkup_submit').hide();
                $('#update_ho_markup_submit').attr('disabled', false);
            },
        });
    } else {
        return false;
    }
}

function updateSubAgentHoMarkupDetails(){
    var flag = true;
    $('#hoMarkup_success').hide();
    $('#hoMarkup_error').hide();
    $('#domhoMarkup_error').hide();
    $('#intlhoMarkup_error').hide();
    var markup_type = $('#hotel_markup_type').val();
    var intl_markup = $('#intlHo_markup_amount').val();
    var dom_markup = $('#domHo_markup_amount').val();
    if(dom_markup == '' || dom_markup == 'undefined'){
        $('#domhoMarkup_error_text').html('Please add domestic markup amount.');
        $('#domhoMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } 
    if(intl_markup == '' || intl_markup == 'undefined'){
        $('#intlhoMarkup_error_text').html('Please add international markup amount.');
        $('#intlhoMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    }
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#ho_markup_add')[0]);
        $.ajax({
            xhr: function () {
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/home/updateSubAgentHoMarkupDetails',
            beforeSend: function ()
            {
                $('#update_ho_markup_submit').attr('disabled', true);
                $('#loding_hoMarkup_submit').show();
            },
            success: function (data) {
                if(data.result == '1'){
                    $('#hoMarkup_error_text').html('Please add markup for hotel.');
                    $('#hoMarkup_error').show();
                }
                if(data.result == '0'){
                    $('#hoMarkup_success_text').html('The hotel markup details successfully updated.');
                    $('#hoMarkup_success').show();
                }
                $('#loding_hoMarkup_submit').hide();
                $('#update_ho_markup_submit').attr('disabled', false);
            },
            error: function () {
                $('#hoMarkup_error_text').html('The markup could not be updated. Kindly try again.');
                $('#hoMarkup_error').show();
                $('#loding_hoMarkup_submit').hide();
                $('#update_ho_markup_submit').attr('disabled', false);
            },
        });
    } else {
        return false;
    }
}

function updateSubAgentFlMarkupDetails(subAgentId){
    var flag = true;
    $('#flMarkup_success').hide();
    $('#flMarkup_error').hide();
    var markup_type = $('#flight_markup_type').val();
    var AirPhilExpress = $('#AirPhilExpress').val();
    var SeaAir = $('#SeaAir').val();
    var CebuPacific = $('#CebuPacific').val();
    var ZestAir = $('#ZestAir').val();
    var PhilpinesAirline = $('#PhilpinesAirline').val();
    var intel_flight_amount = $('#intel_flight_amount').val();
    if(markup_type == '' || markup_type == 'undefined'){
        $('#flMarkup_error_text').html('Please select markup type for the flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(AirPhilExpress == '' || AirPhilExpress == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(SeaAir == '' || SeaAir == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(CebuPacific == '' || CebuPacific == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(ZestAir == '' || ZestAir == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(PhilpinesAirline == '' || PhilpinesAirline == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else if(intel_flight_amount == '' || intel_flight_amount == 'undefined'){
        $('#flMarkup_error_text').html('Markup amount can not be blank for flights.');
        $('#flMarkup_error').show();
        $(window).scrollTop(0);
        flag = false;
    } else {
        flag = true;
    }
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#fl_submarkup_add')[0]);
        //data.append('subagent_id',subAgentId);
        $.ajax({
            xhr: function () {
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/home/update_subagent_flight_markup',
            beforeSend: function ()
            {
                $('#update_fl_markup_submit').attr('disabled', true);
                $('#loding_flMarkup_submit').show();
            },
            success: function (data) {
                if(data.result == '1'){
                    $('#flMarkup_error_text').html('Please add markup to any of the domestic or international flight.');
                    $('#flMarkup_error').show();
                }
                if(data.result == '0'){
                    $('#flMarkup_success_text').html('The flight markup details successfully updated.');
                    $('#flMarkup_success').show();
                }
                $('#loding_flMarkup_submit').hide();
                $('#update_fl_markup_submit').attr('disabled', false);
                $(window).scrollTop(0);
            },
            error: function () {
                $('#flMarkup_error_text').html('The markup could not be updated. Kindly try again.');
                $('#flMarkup_error').show();
                $('#loding_flMarkup_submit').hide();
                $('#update_fl_markup_submit').attr('disabled', false);
                $(window).scrollTop(0);
            },
        });
    } else {
        return false;
    }
    
}

function showSubAgentDepositPopup(agentId,subAgentId){
    $("#show_subagent_deposit_window .modal .modal-body").html("Content loading please wait...");
    jQuery('#show_subagent_deposit_window').modal('show', {backdrop: 'static'});
    jQuery.ajax({
        dataType: 'json',
        url: Site_Url+"/home/showSubagentDepositWindow/"+agentId+'/'+subAgentId,
        success: function(data)
        {
            jQuery('#show_subagent_deposit_window .modal-body').html(data.view);
        }
    });
}

function addSubAgentDeposit(){
    var flag = true;
    var deposit_amount = $('#sub_agent_dep_amt').val();
    var agent_bal = $('#agent_bal').val();
    
    if(deposit_amount != '' || deposit_amount != 'undefined'){
        deposit_amount = parseFloat(deposit_amount);
        agent_bal = parseFloat(agent_bal);
        if(deposit_amount < agent_bal){
            flag = true;
        } else {
            $('#sub_agent_bal_error').html('Sub agent deposit amount should be less then your balance.');
            $('#sub_agent_bal_error').show();
            flag = false;
        }
    } else {
        $('#sub_agent_bal_error').html('Please enter the deposit amount.');
        $('#sub_agent_bal_error').show();
        flag = false;
    }
    
    if(flag == true){
        document.sub_dep_frm.submit();
    } else { return false; }
}


function openSubagentMarkupWindow(id){
    window.location.href = Site_Url + '/home/subagent_markup_list/'+id;
}

function changeSubagentStatusActive(id,row,status){
    var check = '';
    if(id != ''){
        if(status == '0'){ check = 'Deactivate' }
        if(status == '1'){ check = 'Activate' }
        if(status == '2'){ check = 'Block' }
        if(confirm('Are you sure to '+ check + ' this sub agent.')){
            $.ajax({
                xhr: function () {
                    return $.ajaxSettings.xhr();
                },
                dataType: 'json',
                url: Site_Url + '/home/changeSubAgentStatus/'+id+'/'+status,
                beforeSend: function ()
                {

                },
                success: function (data) {
                    if(data.result == 0){
                        if(status == '0'){
                            $('#subAgentListDataActive #subAgentRowActive'+row+' .subAgentChangeStatusActive').html('Inactive');
                            $('#subAgentListDataActive #subAgentRowActive'+row+' .subAgentChangeStatusActive').css('color','red');
                        } else if(status == '1'){
                            $('#subAgentListDataActive #subAgentRowActive'+row+' .subAgentChangeStatusActive').html('Active');
                            $('#subAgentListDataActive #subAgentRowActive'+row+' .subAgentChangeStatusActive').css('color','green');
                        } else {
                            $('#subAgentListDataActive #subAgentRowActive'+row+' .subAgentChangeStatusActive').html('Blocked');
                            $('#subAgentListDataActive #subAgentRowActive'+row+' .subAgentChangeStatusActive').css('color','red');
                        }
                    } else {
                        alert('Sorry could not update the status of sub agent. Please try again.')
                    }
                },
                error: function () {

                },
            });
        }
    }
}

function changeSubagentStatusInactive(id,row,status){
    var check = '';
    if(id != ''){
        if(status == '0'){ check = 'Deactivate' }
        if(status == '1'){ check = 'Activate' }
        if(status == '2'){ check = 'Block' }
        if(confirm('Are you sure to '+ check + ' this sub agent.')){
            $.ajax({
                xhr: function () {
                    return $.ajaxSettings.xhr();
                },
                dataType: 'json',
                url: Site_Url + '/home/changeSubAgentStatus/'+id+'/'+status,
                beforeSend: function ()
                {

                },
                success: function (data) {
                    if(data.result == 0){
                        if(status == '0'){
                            $('#subAgentListDataInactive #subAgentRowInactive'+row+' .subAgentChangeStatusInactive').html('Inactive');
                            $('#subAgentListDataInactive #subAgentRowInactive'+row+' .subAgentChangeStatusInactive').css('color','red');
                        } else if(status == '1'){
                            $('#subAgentListDataInactive #subAgentRowInactive'+row+' .subAgentChangeStatusInactive').html('Active');
                            $('#subAgentListDataInactive #subAgentRowInactive'+row+' .subAgentChangeStatusInactive').css('color','green');
                        } else {
                            $('#subAgentListDataInactive #subAgentRowInactive'+row+' .subAgentChangeStatusInactive').html('Blocked');
                            $('#subAgentListDataInactive #subAgentRowInactive'+row+' .subAgentChangeStatusInactive').css('color','red');
                        }
                    } else {
                        alert('Sorry could not update the status of sub agent. Please try again.')
                    }
                },
                error: function () {

                },
            });
        }
    }
}

function changeSubagentStatusBlocked(id,row,status){
    var check = '';
    if(id != ''){
        if(status == '0'){ check = 'Deactivate' }
        if(status == '1'){ check = 'Activate' }
        if(status == '2'){ check = 'Block' }
        if(confirm('Are you sure to '+ check + ' this sub agent.')){
            $.ajax({
                xhr: function () {
                    return $.ajaxSettings.xhr();
                },
                dataType: 'json',
                url: Site_Url + '/home/changeSubAgentStatus/'+id+'/'+status,
                beforeSend: function ()
                {

                },
                success: function (data) {
                    if(data.result == 0){
                        if(status == '0'){
                            $('#subAgentListDataBlocked #subAgentRowBlocked'+row+' .subAgentChangeStatusBlocked').html('Inactive');
                            $('#subAgentListDataBlocked #subAgentRowBlocked'+row+' .subAgentChangeStatusBlocked').css('color','red');
                        } else if(status == '1'){
                            $('#subAgentListDataBlocked #subAgentRowBlocked'+row+' .subAgentChangeStatusBlocked').html('Active');
                            $('#subAgentListDataBlocked #subAgentRowBlocked'+row+' .subAgentChangeStatusBlocked').css('color','green');
                        } else {
                            $('#subAgentListDataBlocked #subAgentRowBlocked'+row+' .subAgentChangeStatusBlocked').html('Blocked');
                            $('#subAgentListDataBlocked #subAgentRowBlocked'+row+' .subAgentChangeStatusBlocked').css('color','red');
                        }
                    } else {
                        alert('Sorry could not update the status of sub agent. Please try again.')
                    }
                },
                error: function () {

                },
            });
        }
    }
}

function showSubAgentEditPopup(agentId,subAgentId){
    $("#show_subagent_edit_window .modal .modal-body").html("Content loading please wait...");
    jQuery('#show_subagent_edit_window').modal('show', {backdrop: 'static'});
    jQuery.ajax({
        dataType: 'json',
        url: Site_Url+"/home/showSubagentEditWindow/"+agentId+'/'+subAgentId,
        success: function(data)
        {
            jQuery('#show_subagent_edit_window .modal-body').html(data.view);
        }
    });
}

function editNewSubAgentData(){
    var flag = true;
    $('#subagentedit_success').hide();
    $('#subagentedit_error').hide();
    var agent_name = $('#sub_agentedit_name').val();
    var address = $('#sub_agentedit_address').val();
    var city = $('#sub_agentedit_city').val();
    var phone_code = $('#sub_agentedit_phone_code').val();
    var phone_no = $('#sub_agentedit_phone_no').val();
    var company_name = $('#sub_agentedit_company_name').val();
    var zip_code = $('#sub_agentedit_zip_code').val();
    var country = $('#sub_agentedit_country').val();
    
    
    if(agent_name == '' || agent_name == 'undefined'){
        $("#sub_agentedit_name_error").show();
        $("#sub_agentedit_name_error").html("Please select sub agent name.");
        flag = false;
    }
    if(phone_code == '' || phone_code == 'undefined'){
        $("#sub_agentedit_phone_no_error").show();
        $("#sub_agentedit_phone_no_error").html("Please enter agent contact number.");
        flag = false;
    }
    if(phone_no == '' || phone_no == 'undefined'){
        $("#sub_agentedit_phone_no_error").show();
        $("#sub_agentedit_phone_no_error").html("Please enter agent contact number.");
        flag = false;
    }
    if(company_name == '' || company_name == 'undefined'){
        $("#sub_agentedit_company_name_error").show();
        $("#sub_agentedit_company_name_error").html("Please enter company name.");
        flag = false;
    }
    if(country == '' || country == 'undefined'){
        $("#sub_agentedit_country_error").show();
        $("#sub_agentedit_country_error").html("Please select sub agent country.");
        flag = false;
    }
    
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#subagent_edit')[0]);
        $.ajax({
            xhr: function () {  
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/home/edit_subagent_data',
            beforeSend: function ()
            {
                $('#submit_subagentedit_profile').attr('disabled', true);
                $('#loding_subagentedit_submit').show();
            },
            success: function (data) {
                if(data.err == '1'){
                    $('#subagentedit_error_text').html(data.result);
                    $('#subagentedit_error').show();
                }
                if(data.err == '0'){
                    $('#subagentedit_success_text').html(data.result);
                    $('#subagentedit_success').show();
                }
                $('#loding_subagentedit_submit').hide();
                $('#submit_subagentedit_profile').attr('disabled', false);
            },
            error: function () {
                $('#subagentedit_error_text').html('Sub Agent could not be updated. Please try again in some time.');
                $('#loding_subagentedit_submit').hide();
                $('#submit_subagentedit_profile').attr('disabled', false);
            },
        });
    } else {
        return false;
    }
}

$(document).ready(function() {
    $("#hotel_sd").datepicker({
        numberOfMonths: 2,
        dateFormat: 'yy-mm-dd',
        minDate: 1,
        firstDay: 1,
        inline: true

    });
    
    $("#hotel_ed").datepicker({
        numberOfMonths: 2,
        dateFormat: 'yy-mm-dd',
        minDate: 3,
        firstDay: 1,
        inline: true

    });
    
    $("#act_date").datepicker({
        numberOfMonths: 2,
        dateFormat: 'yy-mm-dd',
        minDate: 3,
        firstDay: 1,
        inline: true

    });
    
    $("#flSd").datepicker({
        numberOfMonths: 2,
        dateFormat: 'yy-mm-dd',
        minDate: 1,
        firstDay: 1,
        inline: true

    });

    $("#flEd").datepicker({
        numberOfMonths: 2,
        dateFormat: 'yy-mm-dd',
        minDate: 3,
        firstDay: 1,
        inline: true

    });
    
    $("#datepickerModFlOw").datepicker({
        numberOfMonths: 1,
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        firstDay: 1,
        inline: true

    });
    
    $("#datepickerModFlRt").datepicker({
        numberOfMonths: 1,
        dateFormat: 'yy-mm-dd',
        minDate: 3,
        firstDay: 1,
        inline: true

    });
    
    
    
    $('#dipositListData').DataTable({
        responsive: true,
        order: [],
        "bSort" : false
    });
    $('#rejectDipositListData').DataTable({
        responsive: true,
        order: [],
        "bSort" : false
    });
    $('#pendingDipositListData').DataTable({
        responsive: true,
        order: [],
        "bSort" : false
    });
    $('#subAgentListDataActive').DataTable({
        responsive: true,
        order: [],
        "bSort" : false
    });
    $('#subAgentListDataInactive').DataTable({
        responsive: true,
        order: [],
        "bSort" : false
    });
    $('#subAgentListDataBlocked').DataTable({
        responsive: true,
        order: [],
        "bSort" : false
    });
    $('#FlightBookingData').DataTable({
        responsive: true,
        order: [],
        "bSort" : false
    });
    $('#HotelBookingData').DataTable({
        responsive: true,
        order: [],
        "bSort" : false
    });
    
});

function zeroPad(num, count)
{
    var numZeropad = num + '';
    while (numZeropad.length < count) {
        numZeropad = "0" + numZeropad;
    }
    return numZeropad;
}

function dateADD(currentDate)
{
    var valueofcurrentDate = currentDate.valueOf() + (24 * 60 * 60 * 1000);
    var newDate = new Date(valueofcurrentDate);
    return newDate;
}


$('#hotel_sd').change(function () {
    //$t=$(this).val();
    var selectedDate = $(this).datepicker('getDate');
    var str1 = $("#hotel_ed").val();
    var predayDate = dateADD(selectedDate);
    var str2 = (predayDate.getFullYear()) + "-" + zeroPad((predayDate.getMonth() + 1), 2) + "-" + zeroPad(predayDate.getDate(), 2);
    var dt1 = parseInt(str1.substring(0, 2), 10);
    var mon1 = parseInt(str1.substring(3, 5), 10);
    var yr1 = parseInt(str1.substring(6, 10), 10);
    var dt2 = parseInt(str2.substring(0, 2), 10);
    var mon2 = parseInt(str2.substring(3, 5), 10);
    var yr2 = parseInt(str2.substring(6, 10), 10);
    var date1 = new Date(yr1, mon1, dt1);
    var date2 = new Date(yr2, mon2, dt2);
    if (date2 < date1)
    {

    } else {
        var nextdayDate = dateADD(selectedDate);
        var nextDateStr = (nextdayDate.getFullYear()) + "-" + zeroPad((nextdayDate.getMonth() + 1), 2) + "-" + zeroPad(nextdayDate.getDate(), 2);

        $t = nextDateStr;
        $("#hotel_ed").datepicker({
            numberOfMonths: 2,
            dateFormat: 'yy-mm-dd',
            minDate: 1
        });
        $("#hotel_ed").val($t);
    }

});

$('#flSd').change(function () {
    //$t=$(this).val();
    var selectedDate = $(this).datepicker('getDate');
    var str1 = $("#flEd").val();
    var predayDate = dateADD(selectedDate);
    var str2 = (predayDate.getFullYear()) + "-" + zeroPad((predayDate.getMonth() + 1), 2) + "-" + zeroPad(predayDate.getDate(), 2);
    var dt1 = parseInt(str1.substring(0, 2), 10);
    var mon1 = parseInt(str1.substring(3, 5), 10);
    var yr1 = parseInt(str1.substring(6, 10), 10);
    var dt2 = parseInt(str2.substring(0, 2), 10);
    var mon2 = parseInt(str2.substring(3, 5), 10);
    var yr2 = parseInt(str2.substring(6, 10), 10);
    var date1 = new Date(yr1, mon1, dt1);
    var date2 = new Date(yr2, mon2, dt2);
    if (date2 < date1)
    {

    } else {
        var nextdayDate = dateADD(selectedDate);
        var nextDateStr = (nextdayDate.getFullYear()) + "-" + zeroPad((nextdayDate.getMonth() + 1), 2) + "-" + zeroPad(nextdayDate.getDate(), 2);

        $t = nextDateStr;
        $("#flEd").datepicker({
            numberOfMonths: 2,
            dateFormat: 'yy-mm-dd',
            minDate: 1
        });
        $("#flEd").val($t);
    }

});

$('#hotel_sd,#hotel_ed').on('change',function(){
    if($('#hotel_sd').val()!="" && $('#hotel_ed').val()!=""){
        var dateFirst = $('#hotel_sd').val().split('-');
        var dateSecond = $('#hotel_ed').val().split('-');
        var month1 = dateFirst[1]-1;
        var month2 = dateSecond[1]-1;
        var firstDate = new Date(dateFirst[0], month1, dateFirst[2]);
        var secondDate = new Date(dateSecond[0], month2, dateSecond[2]);
        var timeDiff = Math.abs(secondDate.getTime() - firstDate.getTime());
        var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
        $('.nights-count').val(daysDiff);
    }
});

function chkValidateFlight(){
    var type = $('input[name=journey_type]:checked').val();
    $('#show_message').html('');
    $('#error_message').hide();
    var from = $('#flFrom').val();
    var to = $('#flTo').val();
    var sd = $('#flSd').val();
    if(type == 'round_trip'){
        var ed = $('#flEd').val();
    }
    var adult = $('#s1').val();
    var child = $('#s2').val();
    var infant = $('#s3').val();
    //var travel_class = $('#class_rt').val();
    var flag = true;
    
    if(from === '' || from === 'undefined'){
        flag = false;
        $('#show_message').append('Please enter Leaving From location.<br />');
        
    }
    if(to === '' || to === 'undefined'){
        flag = false;
        $('#show_message').append('Please enter Going To Location.<br />');
    }
    if(sd === '' || sd === 'undefined'){
        flag = false;
        $('#show_message').append('Select Departing date.<br />');
    }
    
    if(type == 'round_trip'){
        if(ed === '' || ed === 'undefined'){
            flag = false;
            $('#show_message').append('Select Returning date.<br />');
        }
    }
    if(from !== ''){
        if(from.indexOf('$') > -1 || from.indexOf('%') > -1 || from.indexOf('&') > -1)
        {
            flag = false;
            $('#show_message').append('Select leaving from location from the auto suggetions.<br />');
        }
        if(!(from.indexOf(',') > -1)){
            flag = false;
            $('#show_message').append('Select leaving from location from the auto suggetions.<br />');
        }
    }
    if(to !== ''){
        if(to.indexOf('$') > -1 || to.indexOf('%') > -1 || to.indexOf('&') > -1)
        {
            flag = false;
            $('#show_message').append('Select going to location from the auto suggetions.<br />');
        }
        if(!(to.indexOf(',') > -1)){
            flag = false;
            $('#show_message').append('Select going to location from the auto suggetions.<br />');
            
        }
    }
    if(from !== '' && to !== '' && from === to){
        flag = false;
        $('#show_message').html('From and To Locations should be different.');
    }

    if(flag === true){
        $('#flight_frm').submit();
    } else {
        $('#error_message').show();
        setTimeout(function() { $("#error_message").hide(); }, 3000);
        return false;
    }
}

function chkValidateModifyFlight(){
    var type = $('input[name=journey_type]:checked').val();
    $('#show_message').html('');
    $('#error_message').hide();
    var from = $('#flFrom').val();
    var to = $('#flTo').val();
    var sd = $('#datepickerModFlOw').val();
    if(type == 'round_trip'){
        var ed = $('#datepickerModFlRt').val();
    }
    var adult = $('#s1').val();
    var child = $('#s2').val();
    var infant = $('#s3').val();
    //var travel_class = $('#class_rt').val();
    var flag = true;
    
    if(from === '' || from === 'undefined'){
        flag = false;
        $('#show_message').append('Enter Departure location.<br />');
        
    }
    if(to === '' || to === 'undefined'){
        flag = false;
        $('#show_message').append('Enter Arrival Location.<br />');
    }
    if(sd === '' || sd === 'undefined'){
        flag = false;
        $('#show_message').append('Select Departing date.<br />');
    }
    if(type == 'round_trip'){
        if(ed === '' || ed === 'undefined'){
            flag = false;
            $('#show_message').append('Select Returning date.<br />');
        }
    }
    if(from !== ''){
        if(from.indexOf('$') > -1 || from.indexOf('%') > -1 || from.indexOf('&') > -1)
        {
            flag = false;
            $('#show_message').append('Select leaving from location from the auto suggetions.<br />');
        }
        if(!(from.indexOf(',') > -1)){
            flag = false;
            $('#show_message').append('Select leaving from location from the auto suggetions.<br />');
        }
    }
    if(to !== ''){
        if(to.indexOf('$') > -1 || to.indexOf('%') > -1 || to.indexOf('&') > -1)
        {
            flag = false;
            $('#show_message').append('Select going to location from the auto suggetions.<br />');
        }
        if(!(to.indexOf(',') > -1)){
            flag = false;
            $('#show_message').append('Select going to location from the auto suggetions.<br />');
            
        }
    }
    if(from !== '' && to !== '' && from === to){
        flag = false;
        $('#show_message').html('From and To Locations should be different.');
    }

    if(flag === true){
        $('#flight_frm').submit();
    } else {
        $('#error_message').show();
        setTimeout(function() { $("#error_message").hide(); }, 3000);
        return false;
    }
}

function hideShowRoundTrip(){
    if($('#round_trip').is(':checked')){
        $('#ReturnDateContainer').show();
    } else {
        $('#ReturnDateContainer').hide();
    }
}

function checkReturnModifyFlight(){
    if($('#round_trip').is(':checked')){
        $('#ReturnDateContainer').show();
    } else {
        $('#ReturnDateContainer').hide();
    }
}

// ################ Login, Registration, Forget Pass Starts ##############################
$(function() {
    $("#login_submit").on("click", function(event)  {
        $("#password_error").html("");
        $("#email_id_error").html("");
        flag = true;
        email = $('#email_id').val();
        if (email != 'undefined' && email != '')
        {
            check = validateEmail(email);
            if (check)
            {
                pass = $('#password').val();
                if (pass == 'undefined' || pass == '')
                {
                    flag = false;
                    $("#password_error").show();
                    $("#password_error").html("Please enter your password.");
                } else
                {
                    flag = true;
                    $.ajax({
                        url: Site_Url + '/home/checkUserLoginData',
                        data: 'email=' + email + '&pass=' + pass,
                        dataType: 'json',
                        type: 'POST',
                        beforeSend: function ()
                        {
                            $('#login_progress').show();
                        },
                        success: function (data)
                        {
                            if (data.logged_in == 1)
                            {
                                window.location.href = Site_Url + '/home';
                            } else
                            {
                                $('#login_error').show();
                                $('#login_progress').hide();
                            }
                        }

                    });
                }
            } else
            {
                flag = false;
                $("#email_id_error").show();
                $("#email_id_error").html("Please enter correct email id.");
            }
        } else
        {
            flag = false;
            $("#email_id_error").show();
            $("#email_id_error").html("Please enter your email id.");
        }
    });


    $("#register_submit").on("click", function(event)  {
        $("#new_password_error").html("");
        $("#conf_password_error").html("");
        $("#new_email_id_error").html("");
        flag = true;
        email = $('#new_email_id').val();
        if (email != 'undefined' && email != '')
        {
            check = validateEmail(email);
            if (check)
            {
                pass = $('#new_password').val();
                conf_pass = $('#conf_password').val();
                if (pass == 'undefined' || pass == '')
                {
                    flag = false;
                    $("#new_password_error").show();
                    $("#new_password_error").html("Please enter your password.");
                } else if (conf_pass == 'undefined' || conf_pass == '')
                {
                    flag = false;
                    $("#conf_password_error").show();
                    $("#conf_password_error").html("Please confirm your password.");
                } else if (pass != conf_pass)
                {
                    flag = false;
                    $("#conf_password_error").show();
                    $("#conf_password_error").html("confirm password does not match password.");
                } else
                {
                    flag = true;
                    $.ajax({
                        url: Site_Url + '/home/registerUserData',
                        data: 'email=' + email + '&pass=' + pass,
                        dataType: 'json',
                        type: 'POST',
                        beforeSend: function ()
                        {
                            $('#register_progress').show();
                        },
                        success: function (data)
                        {
                            if (data.logged_in == 1)
                            {
                                window.location.href = Site_Url + '/home';
                            }
                            else if(data.logged_in== 2)
                            {
                                $('#register_exist_error').show();
                                $('#register_progress').hide();
                            }
                            else
                            {
                                $('#register_error').show();
                                $('#register_progress').hide();
                            }
                        }

                    });
                }
            } else
            {
                flag = false;
                $("#new_email_id_error").show();
                $("#new_email_id_error").html("Please enter correct email id.");
            }
        } else
        {
            flag = false;
            $("#new_email_id_error").show();
            $("#new_email_id_error").html("Please enter your email id.");
        }
    });

    $("#forgot_pass_submit").on("click", function(event)  {
        $("#forgot_email_id_error").html("");
        $('#forgot_success').hide();
        $('#forgot_error').hide();
        flag = true;
        email = $('#forgot_email_id').val();
        if (email != 'undefined' && email != '')
        {
            check = validateEmail(email);
            if (check)
            {
                flag = true;
                $.ajax({
                    url: Site_Url + '/home/forgot_password',
                    data: 'email=' + email,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function ()
                    {
                        $('#forgot_pass_progress').show();
                    },
                    success: function (data)
                    {
                        if (data.logged_in == 1)
                        {

                            $('#forgot_success').show();
                            $('#forgot_pass_progress').hide();
                        } else
                        {
                            $('#forgot_error').show();
                            $('#forgot_pass_progress').hide();
                        }
                    }

                });
            } else
            {
                flag = false;
                $("#forgot_email_id_error").show();
                $("#forgot_email_id_error").html("Email entered is not associated with any account.");
            }
        } else
        {
            flag = false;
            $("#forgot_email_id_error").show();
            $("#forgot_email_id_error").html("Please enter your email id.");
        }
    });
    
    $("#agent_forgot_pass_submit").on("click", function(event)  {
        $("#agent_forgot_email_id_error").html("");
        $('#agent_forgot_success').hide();
        $('#agent_forgot_error').hide();
        flag = true;
        email = $('#agent_forgot_email_id').val();
        if (email != 'undefined' && email != '')
        {
            check = validateEmail(email);
            if (check)
            {
                flag = true;
                $.ajax({
                    url: Site_Url + '/home/forgot_password',
                    data: 'email=' + email,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function ()
                    {
                        $('#agent_forgot_pass_progress').show();
                    },
                    success: function (data)
                    {
                        if (data.logged_in == 1)
                        {

                            $('#agent_forgot_success').show();
                            $('#agent_forgot_pass_progress').hide();
                        } else
                        {
                            $('#agent_forgot_error').show();
                            $('#agent_forgot_pass_progress').hide();
                        }
                    }

                });
            } else
            {
                flag = false;
                $("#agent_forgot_email_id_error").show();
                $("#agent_forgot_email_id_error").html("Email entered is not associated with any account.");
            }
        } else
        {
            flag = false;
            $("#agent_forgot_email_id_error").show();
            $("#agent_forgot_email_id_error").html("Please enter your email id.");
        }
    });
    
    $("#contact_submit").on("click", function(event)  {
        event.preventDefault();
        $("#contact_success").hide("");
        $('#contact_error').hide();
        $('#contact_name_error').hide();
        $('#contact_email_error').hide();
        $('#contact_phone_error').hide();
        $('#contact_subject_error').hide();
        $('#contact_msg_error').hide();
        
        flag = true;
        name = $('#usr_name').val();
        email = $('#usr_email').val();
        phone = $('#usr_phone').val();
        subject = $('#usr_subject').val();
        msg = $('#usr_msg').val();
        
        if(name === '' || name === 'undefined'){
            flag = false;
            $('#contact_name_error').html('Please enter Your full name.');
            $('#contact_name_error').show();
        }
        if(email === '' || email === 'undefined'){
            flag = false;
            $('#contact_email_error').html('Please enter your email id');
            $('#contact_email_error').show();
        }
        if(phone === '' || phone === 'undefined'){
            flag = false;
            $('#contact_phone_error').html('Please enter your phone no.');
            $('#contact_phone_error').show();
        }
        if(subject === '' || subject === 'undefined'){
            flag = false;
            $('#contact_subject_error').html('Please enter your query subject line.');
            $('#contact_subject_error').show();
        }
        if(msg === '' || msg === 'undefined'){
            flag = false;
            $('#contact_msg_error').html('Please enter your query.');
            $('#contact_msg_error').show();
        }
        if (email != 'undefined' && email != ''){
            check = validateEmail(email);
            if (!check){
                flag = false;
                $('#contact_email_error').html('Please enter correct email id');
                $('#contact_email_error').show();
            }
        }
        
        if(flag === true){
            $.ajax({
                url: Site_Url + '/home/send_contact',
                data: 'email='+email+'&name='+name+'&phone='+phone+'&subject='+subject+'&msg='+msg,
                dataType: 'json',
                type: 'POST',
                beforeSend: function ()
                {
                    $('#contact_progress').show();
                },
                success: function (data)
                {
                    if (data.logged_in == 1)
                    {

                        $('#contact_success').show();
                        $('#contact_progress').hide();
                    } else
                    {
                        $('#contact_error').show();
                        $('#contact_progress').hide();
                    }
                }

            });
        }
    });
    
    
    
      
});



// ################ Login, Registration, Forget Pass Ends ##############################
// ################ FLIGHT SECTION #####################################################
function showTfFlightDetailsOw(flightId){
    $("#show_flight_details_window .modal-body").html("Content loading please wait...");
    jQuery('#show_flight_details_window').modal('show', {backdrop: 'static'});
    jQuery.ajax({
        dataType: 'json',
        url: Site_Url + "/flight/showTfFlightDetailsOw/"+flightId,
        success: function(data)
        {
            jQuery('#show_flight_details_window .modal-body').html(data.view);
        }
    });
}

function showTfFlightDetailsRtDom(flightId,type){
    $("#show_flight_details_window .modal-body").html("<span style='margin-left: 338px;font-weight: bold;'>Content loading please wait...</span>");
    jQuery('#show_flight_details_window').modal('show', {backdrop: 'static'});
    jQuery.ajax({
        dataType: 'json',
        url: Site_Url + "/flight/showTfFlightDetailsRtDom/"+flightId+"/"+type,
        success: function(data){
            jQuery('#show_flight_details_window .modal-body').html(data.view);
        }
    });
}

function showTfFlightDetailsRtIntl(flightId){
    $("#show_flight_details_window .modal-body").html("<span style='margin-left: 338px;font-weight: bold;'>Content loading please wait...</span>");
    jQuery('#show_flight_details_window').modal('show', {backdrop: 'static'});
    jQuery.ajax({
        dataType: 'json',
        url: Site_Url + "/flight/showTfFlightDetailsRtIntl/"+flightId,
        success: function(data){
            jQuery('#show_flight_details_window .modal-body').html(data.view);
        }
    });
}

function showActivityInclusionCancel(id){
    $("#show_activity_window .modal-body").html("<span style='margin-left: 338px;font-weight: bold;'>Content loading please wait...</span>");
    jQuery('#show_activity_window').modal('show', {backdrop: 'static'});
    jQuery.ajax({
        dataType: 'json',
        url: Site_Url + "/activity/showInclusionAndCancelation/"+id,
        success: function(data){
            jQuery('#show_activity_window .modal-body').html(data.view);
        }
    });
}

function updateBaggageCharges(bag_cost){
    var totalFare = $('#fl_tot').val();
    var values = $("input[name='adultBaggageOnward[]']")
              .map(function(){return $(this).val();}).get();
      alert(values);
}

$('#af_reg_submit').on('click',function(){
    var flag = true;
    $('#success_div').hide();
    $('#error_div').hide();
    $("#comp_name_error").hide();
    $("#fname_error").hide();
    $("#lname_error").hide();
    $("#email_id_error").hide();
    $("#conf_email_error").hide();
    $("#country_error").hide();
    $("#site_url_error").hide();
    $("#promo_code_error").hide();
    $("#captcha_error").hide();
    $("#af_terms_error").hide();
    
    
    var comp_name = $('#comp_name').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var email_id = $('#email_id').val();
    var conf_email = $('#conf_email').val();
    var country = $('#country').val();
    var site_url = $('#site_url').val();
    var promo_code = $('#promo_code').val();
        
    if(comp_name == '' || comp_name == 'undefined'){
        $("#comp_name_error").show();
        $("#comp_name_error").html("Please enter the company name.");
        flag = false;
    }
    if(fname == '' || fname == 'undefined'){
        $("#fname_error").show();
        $("#fname_error").html("Please enter your first name.");
        flag = false;
    }
    if(lname == '' || lname == 'undefined'){
        $("#lname_error").show();
        $("#lname_error").html("Please enter your last name.");
        flag = false;
    }
    if(email_id == '' || email_id == 'undefined'){
        $("#email_id_error").show();
        $("#email_id_error").html("Please enter your email id.");
        flag = false;
    }
    if(conf_email == '' || conf_email == 'undefined'){
        $("#conf_email_error").show();
        $("#conf_email_error").html("Please confirm your email id.");
        flag = false;
    }
    if(country == '' || country == 'undefined'){
        $("#country_error").show();
        $("#country_error").html("Please select your country.");
        flag = false;
    }
    if(site_url == '' || site_url == 'undefined'){
        $("#site_url_error").show();
        $("#site_url_error").html("Please enter your website domain name.");
        flag = false;
    }
    if(promo_code == '' || promo_code == 'undefined'){
        $("#promo_code_error").show();
        $("#promo_code_error").html("Please enter your contact number.");
        flag = false;
    }
    if(!$("#captcha").is(':checked')){
        $("#captcha_error").show();
        $("#captcha_error").html("Please check the captcha.");
        flag = false;
    }
    if(!$("#af_terms").is(':checked')){
        $("#af_terms_error").show();
        $("#af_terms_error").html("Please check the Terms and Conditions.");
        flag = false;
    }
    if(email_id != ''){
        var check = validateEmail(email_id);
        if(!check){
            $("#email_id_error").show();
            $("#email_id_error").html("Please enter valid email id.");
            flag = false;
        }
    }
    if(conf_email != ''){
        var check = validateEmail(conf_email);
        if(!check){
            $("#conf_email_error").show();
            $("#conf_email_error").html("Please enter valid email id.");
            flag = false;
        }
    }
    if(email_id != conf_email){
        $("#conf_email_error").show();
        $("#conf_email_error").html("Email and confirm email does not match.");
        flag = false;
    }
    
    if(flag === true){
        event.preventDefault();
        var data = new window.FormData($('#af_frm')[0]);
        $.ajax({
            xhr: function () {  
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            url: Site_Url + '/affiliate/register_affiliate',
            beforeSend: function ()
            {
                $('#af_reg_submit').addClass('prog_meter');
                $('#af_reg_submit').attr('disabled', true);
            },
            success: function (data) {
                if(data.status == '1'){
                    $('#error_div').show();
                }
                if(data.status == '0'){
                    $('#success_div').show();
                }
                
                $('#af_reg_submit').removeClass('prog_meter');
                $('#af_reg_submit').attr('disabled', false);
                $(window).scrollTop(0);
            },
            error: function () {
                $('#error_div').show();
                $('#af_reg_submit').removeClass('prog_meter');
                $('#af_reg_submit').attr('disabled', false);
                $(window).scrollTop(0);
            },
        });
    } else {
        return false;
    }
});

$('#fl_more_opt').click(function(){
    if($('#fl_more_options').css('display') == 'none'){
        $('#fl_more_options').show();
    } else {
        $('#fl_more_options').hide();
    }
});

$('#senior_ctzn').change(function() {
    if($('#senior_ctzn').is(":checked")){
        $("#s2").val(0).change();
        $("s3").val(0).change();
        $('#s2').attr('disabled', 'disabled');
        $('#s3').attr('disabled', 'disabled');
        jQuery('#srCitizen').modal('show', {backdrop: 'static'});
    } else {
        $('#s2').removeAttr('disabled');
        $('#s3').removeAttr('disabled');
    }
});

function showActChildAge(){
    var child = $('#act_child').val();
    var html = '';
    for(var i = 0; i < child; i++){
        html += '<div class="col-md-6" style="padding-right: 0px;">';
        html += '<label>Age</label>';
        html += '<select name="act_child_age[]" class="form-control" required>';
        html += '<option value="1">1</option>';
        html += '<option value="2">2</option>';
        html += '<option value="3">3</option>';
        html += '<option value="4">4</option>';
        html += '<option value="5">5</option>';
        html += '<option value="6">6</option>';
        html += '<option value="7">7</option>';
        html += '<option value="8">8</option>';
        html += '<option value="9">9</option>';
        html += '<option value="10">10</option>';
        html += '</select>';
        html += '</div>';
    }
    
    $('#act_child_age').html(html);
}

function checkPriceOfActivity(id){
    $('#act_error').hide();
    event.preventDefault();
    var data = new window.FormData($('#act_chk_price')[0]);
    $.ajax({
            xhr: function () {  
                return $.ajaxSettings.xhr();
            },
            type: "POST",
            data: data,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            url: Site_Url + '/activity/getPriceOfActivity',
            beforeSend: function ()
            {
                $('#act_loader').show();
                $('#sub_act_price').addClass('prog_meter');
                $('#sub_act_price').attr('disabled', true);
            },
            success: function (data) {
                //alert(data.error);
                if(data.error != ''){
                    $('#act_error').html(data.error);
                    $('#act_error').show();
                } else {
                    $('#act_curr').html(data.currency);
                    $('#gross_amount').html(data.price);
                }
                
                $('#sub_act_price').removeClass('prog_meter');
                $('#sub_act_price').attr('disabled', false);
                $('#act_continue').attr('disabled', false);
                $('#act_loader').hide();
            },
            error: function () {
                $('#act_error').html('Could not update price. Please try again.');
                $('#act_error').show();
                $('#sub_act_price').removeClass('prog_meter');
                $('#sub_act_price').attr('disabled', false);
            },
        });
    
}


function proccedToBookActivity(){
    $('#act_chk_price').submit();
}
