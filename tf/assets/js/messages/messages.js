/*
*
*Vikas Arora
*
*/
$(document).ready(function() {

$(document).on('click', '.star', function() {

	var msgId = $(this).data('msg_id');
	var thisItem = $(this);
	
	$.ajax({
		url: WEB_URL+'/messages/strStar',
		data: {'msgId': msgId},
		method: 'POST',
		dataType: 'JSON',
		success: function(r) {
			if(r['status'] == 1) {
				thisItem.children('.iconstar').toggleClass('starun');
			} 
		}
	})

});

$(document).on('click', '.arch', function() {
	var msgId = $(this).data('msg_id');
	var thisItem = $(this);
	$.ajax({
		url: WEB_URL+'/messages/strArchive',
		data: {'msgId' : msgId},
		method: 'POST',
		dataType: 'json',
		success: function(r) {
			if(r['status'] == 1) {
				thisItem.children('.icon-archive').toggleClass('archiveun');
			}
		}
	})
})

$('.msgListType').on('change', function() {
	
	var selected_val = $(this).val();
	if(!selected_val) {
		return false;
	}

	switch(selected_val) {
		case "1": 
			filterMsg(1); //Inbox
			break;

		case "2":
			filterMsg(2); //all message
			break;

		case "3": 
			filterMsg(3);  //starred
			break;

		case "4":
			filterMsg(4); //unread
			break;

		case "5": 
			filterMsg(5);  //archived
			break;
		default:
			filterMsg(1); //Inbox as default...
			break;
	}
});

$("#sendMsg").validate({
	submitHandler: function() { 
		
		var action = $("#sendMsg").attr('action');
		var img = $('.usr_img').attr('src');
		$.ajax({
			type: "POST",
			url: action,
			data: $("#sendMsg").serialize(),
			dataType: "json",
			success: function(r){
				if(r.status == 1) {
					$('.msgTxt').val("");
					$('.msgTxt').removeAttr('disabled');
					var getConv = createMsgSlab(r.msg, img);
					$('#convCntnt').prepend(getConv);
					$('#convCntnt .chatrow:eq(0)').slideDown();
				}
			}
		});
		return false; 
	}
});

$('#cntctHst').validate({
	submitHandler: function() {
		var action = $("#cntctHst").attr('action');
		var textAreaCntnt = $('#cntctHstMsg').val();
		if(textAreaCntnt) {
			var p = textAreaCntnt.trim();
			var rp = p.replace(/[^\w\s ]/gi, '');
			var rsp = rp.replace(/ +/g, "");
			var gtpMtch = rsp.match(/[0-9]{4}/g);
			
			var e = p;
			var fe = e.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
			var exKeyWrd = ['gmail', 'yahoo', 'hotmail', 'outlook', 'at the rate'];
			var cs = chkKeyWrd(e, exKeyWrd);
			if(fe || gtpMtch || cs) {
				alert("It looks like you have entered a phone number or email Id. You cannot share contact details until the booking is confirmed by the host");
				return false;
			}
		} 
		
		$.ajax({
			type: "POST",
			url: action,
			data: $("#cntctHst").serialize(),
			dataType: "json",
			success: function(r){
				$('#contact_to_pop_up').provabPopup().close();
				$('#msgSntPopUp').provabPopup({
							modalClose: true, 
							zIndex: 10000005
				});
			}
		});
		return false;
	}
})

});

function createMsgSlab(msg, img) {
	var createMsgSlab = '<div class="chatrow" style="display: none;">'+
                			'<div class="chaterimage">'+
                    			'<img src="'+img+'" alt="" />'+
                			'</div>'+
                			'<div class="chaterdetail">'+
                    			'<div class="chatip"></div>'+
                        			'<div class="insidechat">'+
                	        			'<div class="chatername">'+senderName+'</div>'+
                   			    		'<div class="chattime"><span class="icon icon-clock"></span>'+serverTime+'</div>'+
                                		'<div class="chatermsg">'+
                                    		msg+
                                		'</div>'+
                            	'</div>'+
                        	'</div>'+
                		'</div><div class="clear"></div>';
    return createMsgSlab;
}


function filterMsg(i) {
	$.ajax({
		url: WEB_URL+'/messages/filter_msg/'+i,
		dataType: "json",
		success: function(r) {
			var msgArray = r.getFilteredMsg;
			$('#msgContainer').empty();

			if(!msgArray || msgArray.length == 0) {
				var appendEmptyDiv = '<li class="mesginbox">'+
										'<div class="col-md-12" style="margin: 0 auto; text-align: center;">'+
											'<div class="srywrap"><span class="sorrydiv"><img src="'+WEB_URL+'/assets/images/sorry.png" alt="" /></span><b>Nothing here</b></div>'+
										'</div>'+
									  '</li>';
				$('#msgContainer').append(appendEmptyDiv);
				createPagination();
				return false;					
			}
			
			for(var key in msgArray) {
				
				if(msgArray[key]['profile_photo']) {
					var profileImage = msgArray[key]['profile_photo'];
				} else if(msgArray[key]['agent_logo']) {
					var profileImage = msgArray[key]['agent_logo'];
				} else {
					var profileImage = WEB_URL+'/assets/images/user-avatar.jpg';
				}

				var msgRecTime = msgArray[key]['msg_date_time'];
				var msgDateTime = getFormatedDate(msgRecTime);

				var starVal = msgArray[key]['starred'];
				if(starVal == 0) {
					starClass = 'starun';
				} else {
					starClass = '';
				}

				archVal = msgArray[key]['archive'];
				if(archVal == 0) {
					archClass = '';
				} else {
					archClass = 'archiveun';
				}

				if(msgArray[key]['msg_type'] == '2') {
					r = 'Booking Request';

				} else {
					r = 'Inquiry';
				}

				if(msgArray[key]['msg_type'] == '2' && msgArray[key]['msg_type']=='PENDING') {
					t = '<a class="optioninboxstr inqbk" data-booking-status="1" data-booking-id="'+msgArray[key]['booking_id']+'">Confirm</a>'+
                        '<a class="optioninboxstr inqbk" data-booking-status="0" data-booking-id="'+msgArray[key]['booking_id']+'">Cancel</a>';
				} else {
					t = msgArray[key]['booking_status'];
				}
				if(!t) {
					t = "";
				}

				if(!msgArray[key]['PROP_RATE_NIGHTLY_FROM']) {
					msgArray[key]['PROP_RATE_NIGHTLY_FROM'] = "";
				}


				var convUrl = WEB_URL+'/messages/conversation/'+msgArray[key]['sender_id']+'/'+msgArray[key]['receiver_id']+'/'+msgArray[key]['message_id'];
				
				if(msgArray[key]['firstname']) {
					var f_name = msgArray[key]['firstname'];
				} else if(msgArray[key]['b2b_name']) {
					var f_name = msgArray[key]['b2b_name'];
				} else {
					var f_name = "-";
				}

				var appendData = '<li class="mesginbox">'+
                    				'<div class="col-md-2">'+
                        				'<div class="wishimg">'+
                            				'<img src=" '+profileImage+' ">'+
                        				'</div>'+
                    				'</div>'+
                    				'<div class="col-md-2">'+
                        				'<div class="inboxlabl">'+
                            				'<strong>'+f_name+'</strong>'+
				                            '<strong>'+msgDateTime+'</strong>'+
                        				'</div>'+
                    				'</div>'+
                    				'<div class="col-md-4">'+
                        				'<div class="inboxlabl">'+
                            				'<a href="'+convUrl+'"><b>'+msgArray[key]['message']+'</b></a>'+
                        				'</div>'+
                    				'</div>'+
                    				'<div class="col-md-2">'+
                        				'<div class="inboxlabl">'+
                            				'<strong>'+r+'</strong>'+
                            				'<strong>'+msgArray[key]['PROP_RATE_NIGHTLY_FROM']+'</strong>'+
                        				'</div>'+
                        				t+
                    				'</div>'+
                    				'<div class="col-md-2">'+
                        				'<a class="optioninbox star" data-msg_id="'+msgArray[key]['message_id']+'">'+
                            				'<span class="iconstar '+starClass+' ">Starred</span>'+
                        				'</a>'+

                        				'<a class="optioninbox arch" data-msg_id = "'+msgArray[key]['message_id']+'" >'+
                            				'<span class="icon icon-archive '+archClass+' "></span>Archive'+
                        				'</a>'+
                    				'</div>'+
                				'</li>';
				 $('#msgContainer').append(appendData);
				 
			}
			createPagination();
		}
	})
}

function getFormatedDate(msgRecTime) {
	d = msgRecTime;
	d = d.replace(/-/g, '/');
	var dateTime = new Date(d);
	
	var fetchDate = dateTime.getDate();
	
	var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec" ];
	var fetchMonth = monthNames[dateTime.getMonth()];

	var fetchHours = dateTime.getHours();
	var fetchMin = dateTime.getMinutes();

	var fullDate = fetchDate+' '+fetchMonth+', '+fetchHours+':'+fetchMin;
	if(fullDate) {
		return fullDate;	
	} else {
		return msgRecTime;
	}	
}

function createPagination() {
    $("div.holdereInbox").proPages({
        containerID: "msgContainer",
        perPage: 3,
        keyBrowse: true,
        scrollBrowse: false,
       	// animation: "flipInX",
        callback: function (pages, items) {
                if(items.count > 3) {
	                $("#legend1").html("Page " + pages.current + " of " + pages.count);
	                $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                } else {
                	$("div.holdereInbox").html('');
                }
            }
        });
}

function chkKeyWrd(str, exKeyWrd){
 	for(var k in exKeyWrd) {
 		var re = new RegExp(exKeyWrd[k], "g");
 		var res = str.match(re);
 		if(res) {
 			return true;
 			break;
 		}
 	}
}

$(document).on('click', '.inqbk', function() {
	var booking_id = $(this).data('booking-id');
	var booking_status = $(this).data('booking-status');
	var thisItem = $(this);
	$.ajax({
		url: WEB_URL+'/apartment/ChangeBookingStatus',
		data: {'booking_id' : booking_id, 'booking_status' : booking_status},
		method: 'POST',
		dataType: 'json',
		beforeSend: function(){
	        thisItem.closest('li').addClass('wantldr');
	    },
		success: function(r) {
			thisItem.closest('li').removeClass('wantldr');
		}
	})
})