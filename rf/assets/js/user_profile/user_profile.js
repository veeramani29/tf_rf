/*This file maps all functions of user show page.Vikas Arora*/

$(document).ready(function(){

$("#owl-demouser").owlCarousel({
    items : 1,
    lazyLoad : true,
    pagination : true,
    navigation : true
});

$('#rvuAbtu').on('click', function(e) {
	e.preventDefault();
	$('.rvuAbtu_loader').fadeIn();
	var that = $(this);
	var lf = that.data('abtu_lf'); //limit from
	var tr = that.data('abtu_tr'); //limit to
	var ppu = that.data('ppu');  //public profile user id
	var ppt = that.data('ppt');  //public profile user type

	if(lf > 0 && !isNaN(lf) && tr > 0 && !isNaN(tr)) {
		$.ajax({
			url: WEB_URL+'/users/loadAboutUserReviews',
			method: "POST",
			data: {'ppu':ppu, 'ppt':ppt, 'tr': tr, 'lf': lf},
			dataType: 'json',
			success: function(r) {
				var setOffset = lf+tr;  //sets db offset
				that.data('abtu_lf', setOffset);
				var totalResponseCount = r.length;
				if(totalResponseCount <= 0) {
					$('#rvuAbtu').hide(); 
					$('.norvwmsg').fadeIn();
					$('.rvuAbtu_loader').fadeOut();
					return false;
				}

				for(var k in r) {
					var appendData = 	'<div class="col-md-12 nopad reviewAbtYouClass marbtm20flot">'+
			                                '<a href="'+WEB_URL+'/users/show/'+r[k]['user_id']+'">'+
			                                    '<div class="col-md-3">'+
			                                        '<div class="reviwuser"><img src="'+r[k]['profile_photo']+'" alt="" /></div>'+
			                                       ' <div class="revusrname">'+r[k]['firstname']+'</div>'+
			                                    '</div>'+
			                                '</a>'+
			                                '<div class="col-md-9">'+
			                                    '<div class="reviewpara">'+
			                                        '<span class="reviewparalines">'+r[k]['review_comments']+'</span>'+
			                                        '<div class="revdate">'+getFormatedDate(r[k]['posted_time'])+'</div>'+
			                                    '</div>'+
			                                '</div>'+
			                            '</div>';
					$('#rvuAbtU_container').append(appendData);
					$('.rvuAbtu_loader').fadeOut();
				}
				var countSlab = $('#rvuAbtU_container').children().length;
				if(countSlab > 3) {   //countSlab must be equal to total results that has to be fetched from db.
					$('#hideRvu').remove();
					$('#rvuAbtu').after('<a class="rlodmr" id="hideRvu" href="#">  Hide reviews<span class="caretdowntop"></span></a>');
				}
			}
		})
	} else {
		return false;
	}
});

    
$(document).on('click', '#hideRvu', function(e) {
	e.preventDefault();
	$('.reviewAbtYouClass').hide();
	$('.norvwmsg').hide();

	$('#rvuAbtu').data('abtu_lf', 3);
	$('#rvuAbtu').data('abtu_tr', 3);
	$(this).remove();
	$('#rvuAbtu').show(); 

});


$('#rvuAbtProp').on('click', function(e) {
	e.preventDefault();
	$('.rvuAbtProp_loader').fadeIn();
	var that = $(this);
	var lf = that.data('abtprop_lf'); //limit from
	var tr = that.data('abtprop_tr'); //limit to
	var ppu = that.data('ppu');

	if(lf > 0 && !isNaN(lf) && tr > 0 && !isNaN(tr)) {
		$.ajax({
			url: WEB_URL+'/users/loadAboutUserPropertyReviews',
			method: "POST",
			data: {'ppu':ppu, 'tr': tr, 'lf': lf},
			dataType: 'json',
			success: function(r) {
				var setOffset = lf+tr;  //sets db offset
				that.data('abtprop_lf', setOffset);
				var totalResponseCount = r.length;
				if(totalResponseCount <= 0) {
					$('#rvuAbtProp').hide(); 
					$('.norvwpropmsg').fadeIn();
					$('.rvuAbtProp_loader').fadeOut();
					return false;
				}

				for(var k in r) {
					var appendData = 	'<div class="col-md-12 nopad reviewAbtPropClass marbtm20flot">'+
			                                '<a href="'+WEB_URL+'/users/show/'+r[k]['user_id']+'">'+
			                                    '<div class="col-md-3">'+
			                                        '<div class="reviwuser"><img src="'+r[k]['profile_photo']+'" alt="" /></div>'+
			                                       ' <div class="revusrname">'+r[k]['firstname']+'</div>'+
			                                    '</div>'+
			                                '</a>'+
			                                '<div class="col-md-9">'+
			                                    '<div class="reviewpara">'+
			                                        '<span class="reviewparalines">'+r[k]['review_comments']+'</span>'+
			                                        '<div class="revdate">'+getFormatedDate(r[k]['posted_time'])+'</div>'+
			                                    '</div>'+
			                                '</div>'+
			                            '</div>';
					$('#rvuAbtProp_container').append(appendData);
					$('.rvuAbtProp_loader').fadeOut();
				}
				var countSlab = $('#rvuAbtProp_container').children().length;
				if(countSlab > 3) {   //countSlab must be equal to total results that has to be fetched from db.
					$('#hideRvuProp').remove();
					$('#rvuAbtProp').after('<a id="hideRvuProp" class="rlodmr" href="#">  Hide reviews<span class="caretdowntop"></span></a>');
				}
			}
		})
	} else {
		return false;
	}
});

$(document).on('click', '#hideRvuProp', function(e) {
	e.preventDefault();
	$('.reviewAbtPropClass').hide();
	$('.norvwpropmsg').hide();

	$('#rvuAbtProp').data('abtprop_lf', 3);
	$('#rvuAbtProp').data('abtprop_tr', 3);
	$(this).remove();
	$('#rvuAbtProp').show(); 
});


$('#rfrnce').on('click', function(e) {
	e.preventDefault();
	$('.rfrnce_loader').fadeIn();
	var that = $(this);
	var lf = that.data('abtref_lf'); //limit from
	var tr = that.data('abtref_tr'); //limit to
	var ppu = that.data('ppu');

	if(lf > 0 && !isNaN(lf) && tr > 0 && !isNaN(tr)) {
		$.ajax({
			url: WEB_URL+'/users/loadReferences',
			method: "POST",
			data: {'ppu':ppu, 'tr': tr, 'lf': lf},
			dataType: 'json',
			success: function(r) {
				console.log(r);
				var setOffset = lf+tr;  //sets db offset
				that.data('abtref_lf', setOffset);
				var totalResponseCount = r.length;
				if(totalResponseCount <= 0) {
					$('#rfrnce').hide(); 
					$('.norefmsg').fadeIn();
					$('.rfrnce_loader').fadeOut();
					return false;
				}

				for(var k in r) {
					var appendData = 	'<div class="col-md-12 nopad referenceClass marbtm20flot">'+
			                                '<a href="'+WEB_URL+'/users/show/'+r[k]['user_id']+'">'+
			                                    '<div class="col-md-3">'+
			                                        '<div class="reviwuser"><img src="'+r[k]['profile_photo']+'" alt="" /></div>'+
			                                       ' <div class="revusrname">'+r[k]['firstname']+'</div>'+
			                                    '</div>'+
			                                '</a>'+
			                                '<div class="col-md-9">'+
			                                    '<div class="reviewpara">'+
			                                        '<span class="reviewparalines">'+r[k]['msg']+'</span>'+
			                                        '<div class="revdate">'+getFormatedDate(r[k]['timestamp'])+'</div>'+
			                                    '</div>'+
			                                '</div>'+
			                            '</div>';
					$('#referenceContainer').append(appendData);
					$('.rfrnce_loader').fadeOut();
				}
				var countSlab = $('#referenceContainer').children().length;
				if(countSlab > 3) {   //countSlab must be equal to total results that has to be fetched from db.
					$('#hideRef').remove();
					$('#rfrnce').after('<a id="hideRef" class="rlodmr" href="#">  Hide reviews<span class="caretdowntop"></span></a>');
				}
			}
		})
	} else {
		return false;
	}
});

    
$(document).on('click', '#hideRef', function(e) {
	e.preventDefault();
	$('.referenceClass').hide();
	$('.norefmsg').hide();

	$('#rfrnce').data('abtref_lf', 3);
	$('#rfrnce').data('abtref_tr', 3);
	$(this).remove();
	$('#rfrnce').show(); 

});

});


/*Create the correct timestamp.*/

function getFormatedDate(dateTime) {
	d = dateTime;
	d = d.replace(/-/g, '/');
	var dateTime = new Date(d);
	
	var fetchDate = dateTime.getDate();
	
	var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec" ];
	var fetchMonth = monthNames[dateTime.getMonth()];
	var fetchYear = dateTime.getFullYear();

	
	var fullDate = fetchMonth+' '+fetchDate+', '+fetchYear;

	if(fullDate) {
		return fullDate;	
	} else {
		return msgRecTime;
	}	
}