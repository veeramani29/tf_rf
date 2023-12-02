/*This file deals with the wishlist management*/

$(document).ready(function(){
	
	$("#owl-demouserwish").owlCarousel({
	    items : 1,
	    lazyLoad : true,
	    pagination : true,
	    navigation : true
	 });
        
	$("#saveWishNode").on('click', function() {
		var nodename = $("#wishNodeName").val();
		var wishprivacy = $("#wishPrivacy").val();

		if(nodename) {
		  _nodename = nodename.trim();
		} else {
		  return false;
		}


		$.ajax({
			url: WEB_URL+"/wishlist/addWishlistNode",
			method: "POST",
			data: {"node_name":_nodename, "privacy": wishprivacy},
			dataType: "json",
			success: function(r) {
				if(r.status == 1) {
				  addNewWishNode();
				}
			}
		});
	});

	$(document).on('click', '.editWishlist', function() { 
	    var wishlistName = $(this).data('wishlistname');
	    var privacyBit = $(this).data('privacy');
	    wishlistid = $(this).data('wishlistid');

	    $('#editWishNodeName').val(wishlistName);

	    if(privacyBit == 0) {
	    	$('#editWishPrivacy').val('0');
	    } else {
	    	$('#editWishPrivacy').val('1');
	    }
	    $('#editwishlist').popup("show");
	 });

	$('#saveEditWishNode').on('click', function() { 
	    var editWishNodeName = $('#editWishNodeName').val();
	    var editWishPrivacy = $('#editWishPrivacy').val();

	    $.ajax({
			url: WEB_URL+"/wishlist/saveEditedWishlist",
			data: {'wishlistName': editWishNodeName, 'wishlistPrivacy': editWishPrivacy, 'wishlistid': wishlistid },
			method: "POST",
			dataType: "json",
			success: function(r) {
				if(r.status == 1) {
				  addNewWishNode(1);
				}
			}
	    });
	});

$('#addWishDetail').on('click', function(e) {
	$('#add_wish_popup').show();
	e.preventDefault(); 
	var title = $(this).data('title');
	var img = $(this).data('image');
	prop_id = $(this).data('id');
	prop_title = title;
	selected_wish = $(this);

	$('.wish_pop_img').attr('src', img);
	$('.wish_pop_label').text(title);
	
	$.ajax({

		url: WEB_URL+"/wishlist/userAccessCheck",
		dataType: "json",
		success: function(r) {
			if(r.status == 1) {
				$('#add_wish_popup').provabPopup({
					modalClose: true, 
					zIndex: 10000005
				});
			} else {
				$('#fadeandscale').popup("show");
			}
		},
		error: function(r) {
			$('#fadeandscale').popup("show");
		}
	})
})

$('#addWishListDetail').on('click', function() {
	if(prop_title && prop_id) {
		var propertyId = prop_id;
		var propertyTitle = prop_title.trim();
		var wishlist_type = $('.wishlist_type').val();
		var wish_note = $('.wish_note').val();

		$.ajax({
			url: WEB_URL+"/wishlist/addWish",
			data: {'product_id':propertyId, 'product_name':propertyTitle, 'wishlist_type_id': wishlist_type, 'add_note': wish_note},
			method: "POST",
			dataType: "json",
			success: function(r) {
				if(r.status == 1) {
					selected_wish.html("Added to wishlist");
					
					var bckgrnd = "url('"+ASSETS+"/images/btn-hrt.png') #fff no-repeat 20px 0";
					
					selected_wish.css('background', bckgrnd);
					$('#add_wish_popup').provabPopup().close();
				}
			}
		});
	}
})
//url('../images/btn-plus.png') #fff no-repeat 20px 0
//url('../images/btn-hrt.png') #fff no-repeat 20px 0) !important 
addNodeSrc = "";
if(addNodeSrc) {

	if(addNodeSrc == 1) {
		$('#adwishlist').popup('show');
	}
}

$(document).on('click', '.deleteWishlist', function(e) {
	e.preventDefault();
	var thisElement = $(this);
	var wishlistId = $(this).data('wishlistid');
	if(wishlistId) {
		$.ajax({
			url: WEB_URL+"/wishlist/deleteWishlist",
			data: {"wishlistId":wishlistId},
			dataType: "json",
			method: "POST",
			success: function(r) {
				if(r.status == 1) {
					thisElement.closest('.listwish').fadeOut();
				}
			}
		})
	}
})


});

function addNewWishNode(edit_request) {
	edit_request = (typeof edit_request === "undefined") ? 0 : edit_request;

	$('#wishlistCreateLoader').popup("show");
	$("#wishlistContainer").empty();
	$.ajax({
		url: WEB_URL+"/wishlist/getWishlist",
		dataType: "json",
		success: function(r) {
			console.log(r);
		  	$('.wishlistCounter').text(r['wishlist_count']);

		  	for(var key in r['wishlist_data']) {
		    	var listing_count = (r['wishlist_data'][key]['counter'] === "undefined" || r['wishlist_data'][key]['counter'] === null ) ? 0 : r['wishlist_data'][key]['counter'] ;
		    
		    	if(r['wishlist_data'][key]['privacy'] === "0") {
		      		var privacy_lock = '<span class="icon icon-lock"></span>';
		    	} else {
		      	var privacy_lock = '';  
		    	}

		    	if(r['wishlist_data'][key]['user_delete_access'] == "0") {
		    		var usrAcc = 	'<a style="color: #fff;"'+
			                          	'data-wishlistid = "'+r['wishlist_data'][key]['wishlist_type_id']+'"'+
			                          	'data-wishlistName="'+r['wishlist_data'][key]['wishlist_type_name']+'"'+
			                          	'data-privacy="'+r['wishlist_data'][key]['privacy']+'"'+
			                          	'class="editWishlist" href="#" >Edit'+
			                     	'</a>'+
			                        '<a style="color: #fff; padding-left: 20px"'+
			                        	'data-wishlistid = "'+r['wishlist_data'][key]['wishlist_type_id']+'"'+
			                          	'class="deleteWishlist" href="#" >Delete'+
			                         '</a>';
		    	} else {
		    		usrAcc = '';
		    	}

		    	if(r['wishlist_data'][key]['PHOTO_CONTENT'] != "") {
		    		var img = '<img style="height: 100%" src="'+r['wishlist_data'][key]['PHOTO_CONTENT']+'">';
		    	} else {
		    		var img = '';
		    	}

			    var wishlist_markup = '<div class="col-md-4 listwish">' +
			                          '<div class="listwishin">' +
			                          '<div class="fadelst"></div>'+
			                          '<div class="absimagesentback">'+
			                          img+
			                          '</div>'+
			                          '<div class="relanothr">'+
			                          privacy_lock +
			                          '<span class="wishname">'+r['wishlist_data'][key]['wishlist_type_name']+'</span>'+
			                          '<a class="howlistg" href="'+WEB_URL+'/wishlist/openWishlist/'+r['wishlist_data'][key]['wishlist_type_id']+' " >'+listing_count+' Listing</a>'+
			                          '<div style="margin-top: 20px; text-align: center">'+usrAcc+
			                          '</div>'+
			                          '</div>'+
			                          '</div>'+
			                          '</div>';
			    $("#wishlistContainer").append(wishlist_markup);
		  	}
		  	$('#adwishlist').popup('hide');
		  	$("#wishlistCreateLoader").popup("hide");

		  	$('.msg').show();
		  	if(edit_request === 1) {
		    	$('#editwishlist').popup('hide');
		    	$('.msg').text("Wishlist edited successfully");  
		  	} else {
		    	$('.msg').text("Wishlist created successfully");  
		  	}
		  
		  	setTimeout(function() {
		    	$('.msg').hide();
		  	}, 4000);
		}
	});
}

function openAddNodeBX(addNodeSrc) {
	$('#adwishlist').popup('show');
}




