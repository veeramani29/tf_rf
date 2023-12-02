( function( window ) {

'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( classie );
} else {
  // browser global
  window.classie = classie;
}

})( window );















(function() {
	
	function scrollY() {
		return window.pageYOffset || docElem.scrollTop;
	}

	// from http://stackoverflow.com/a/11381730/989439
	function mobilecheck() {
		var check = false;
		(function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
		return check;
	}

	var docElem = window.document.documentElement,
		// support transitions
		support = Modernizr.csstransitions,
		// transition end event name
		transEndEventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
		},
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		docscroll = 0,
		// click event (if mobile use touchstart)
		clickevent = mobilecheck() ? 'touchstart' : 'click';

	function init() {
		var showMenu = document.getElementById( 'showMenu' ),
			perspectivewrapper_cart = document.getElementById( 'perspective' ),
			perspectivewrapper_cartbox = document.getElementById( 'cartbox' ),
			container_cart = perspectivewrapper_cart.querySelector( '.container_cart' ),
			contentwrapper_cart = container_cart.querySelector( '.wrapper_cart' );

		showMenu.addEventListener( clickevent, function( ev ) {
			ev.stopPropagation();
			ev.preventDefault();
			docscroll = scrollY();
			// change top of contentwrapper_cart
			//contentwrapper_cart.style.top = docscroll * -1 + 'px';
			contentwrapper_cart.style.top =0;
			// mac chrome issue:
			document.body.scrollTop = document.documentElement.scrollTop = 0;
			
			
			// add modalview class
			classie.add( perspectivewrapper_cart, 'modalview' );
			$('.ritcart').addClass('showcart' );
			
			
			
			


			// animate..
			setTimeout( function() { classie.add( perspectivewrapper_cart, 'animate' ); }, 25 );

			var action = WEB_URL+'/cart/getCartData';
			$.ajax({
				type: "GET",
				url: action,
				dataType: "json",
				beforeSend: function(){
					$('.crtempty').fadeOut();
			        $('.cartloading').fadeIn();
			    },
				success: function(data){
					if(data.isCart == false){
						$('.cartloading').fadeOut();
						$('.crtempty').fadeIn();
					}
					if(data.status == 1){
						console.log('ajaxsuccess');
						$('.cartcnt').html(data.count);
						loadCart(data);
						$('.cartloading').fadeOut();
						
						var hetofcart = $('.outer-nav.vertical').height() + 200+'px';
						$('.perspective').css({'height':hetofcart});
						$('.perspective').css({'min-height':$(window).height()});
						var cartlodht = $(window).height() - $('.carthed').outerHeight();
						$('.fixht').css({'height':cartlodht});
						
					}
					
				}
			});
		});

		container_cart.addEventListener( clickevent, function( ev ) {
			if( classie.has( perspectivewrapper_cart, 'animate') ) {
				var onEndTransFn = function( ev ) {
					if( support && ( ev.target.className !== 'container_cart' || ev.propertyName.indexOf( 'transform' ) == -1 ) ) return;
					this.removeEventListener( transEndEventName, onEndTransFn );
					classie.remove( perspectivewrapper_cart, 'modalview' );
					$('.ritcart').removeClass('showcart' );
					$('.perspective').css({'height':'auto'});
					// mac chrome issue:
					document.body.scrollTop = document.documentElement.scrollTop = docscroll;
					// change top of contentwrapper_cart
					contentwrapper_cart.style.top = '0px';
				};
				if( support ) {
					perspectivewrapper_cart.addEventListener( transEndEventName, onEndTransFn );
				}
				else {
					onEndTransFn.call();
				}
				classie.remove( perspectivewrapper_cart, 'animate' );
			}
		});
		
		
		$('.cartclose').click(function(){
			
			if( classie.has( perspectivewrapper_cart, 'animate') ) {
				var onEndTransFn = function( ev ) {
					if( support && ( ev.target.className !== 'container_cart' || ev.propertyName.indexOf( 'transform' ) == -1 ) ) return;
					this.removeEventListener( transEndEventName, onEndTransFn );
					classie.remove( perspectivewrapper_cart, 'modalview' );
					$('.ritcart').removeClass('showcart' );
					$('.perspective').css({'height':'auto'});
					// mac chrome issue:
					document.body.scrollTop = document.documentElement.scrollTop = docscroll;
					// change top of contentwrapper_cart
					contentwrapper_cart.style.top = '0px';
				};
				if( support ) {
					perspectivewrapper_cart.addEventListener( transEndEventName, onEndTransFn );
				}
				else {
					onEndTransFn.call();
				}
				classie.remove( perspectivewrapper_cart, 'animate' );
			}
		
		});
		
		
		//Cart flying effect
		
		$('.add-to-cart').on('click', function () {
        var cart = $('.shopingcart');
        var imgtodrag = $(this).parent().parent().parent('.hotelistrowhtl').find(".tocartclone").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '10000000'
            })  
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 15,
                    'left': cart.offset().left + 15,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo'); 
			
            
            setTimeout(function (ev) {

			contentwrapper_cart.style.top =0;
			// mac chrome issue:
			document.body.scrollTop = document.documentElement.scrollTop = 0;
			
			
			// add modalview class
			classie.add( perspectivewrapper_cart, 'modalview' );
			$('.ritcart').addClass('showcart' );
			
			var hetofcart = $('.outer-nav.vertical').height() + 200+'px';
			$('.perspective').css({'height':hetofcart});

			// animate..
			setTimeout( function() { classie.add( perspectivewrapper_cart, 'animate' ); }, 25 );
			
		
			}, 1500);

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        }
    });
	
	$(document).ready(function () {
	    $(document).on("click", ".removecart", function (e) {
	        e.preventDefault();
	        console.log('enteerd');
	        var rid = $(this).attr('data-rid');
	        var cid = $(this).attr('data-cid');
	        var refid = $(this).attr('data-refid');
			$('.'+rid).remove();
			var action = WEB_URL+'/cart/removeCart';
			$.ajax({
				type: "GET",
				url: action,
				data:{'refid':refid, 'cid':cid},
				dataType: "json",
				beforeSend: function(){
					$('.crtempty').fadeOut();
			        $('.cartloading').fadeIn();
					
			    },
				success: function(data){
					if(data.isCart == false){
						$('.cartloading').fadeOut();
						$('.crtempty').fadeIn();
					}
					if(data.status == 1){
						console.log('ajaxsuccess');
						$('.cartcnt').html(data.count);
						loadCart(data);
						 $('.cartloading').fadeOut();
					}
				}
			});
	    });
	});
	
	
	function callApartmentCart(){
		console.log('Open!!!');	
        var cart = $('.shopingcart');
        var imgtodrag = $(".tabbimg img").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '400px',
                    'width': '400px',
                    'z-index': '10000000'
            })  
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 15,
                    'left': cart.offset().left + 15,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo'); 
			
            
            setTimeout(function (ev) {

				contentwrapper_cart.style.top =0;
				// mac chrome issue:
				document.body.scrollTop = document.documentElement.scrollTop = 0;
				// add modalview class
				classie.add( perspectivewrapper_cart, 'modalview' );
				$('.ritcart').addClass('showcart' );
				
				var hetofcart = $('.outer-nav.vertical').height() + 200+'px';
				$('.perspective').css({'height':hetofcart});
				$('.perspective').css({'min-height':$(window).height()});

				// animate..
				setTimeout( function() { classie.add( perspectivewrapper_cart, 'animate' ); }, 25 );
			}, 1500);
			console.log('YUP!!');

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        }
	}
	
	//Cart flying effect for apartment
	$("#bookNow").validate({
		submitHandler: function() {
			var apcartp = $("#apcartp").val();
			if(apcartp !=0){
				var action = $("#bookNow").attr('action');
				$.ajax({
					type: "GET",
					url: action,
					data: $("#bookNow").serialize(),
					dataType: "json",
					beforeSend: function(){
						$('.crtempty').fadeOut();
				        $('.cartloading').fadeIn();
				    },
					success: function(data){
						if(data.isCart == false){
							$('.crtempty').fadeIn();
						}
						if(data.status == 1){
							console.log('ajaxsuccess');
							$('.cartcnt').html(data.count);
							loadCart(data);
							$('.cartloading').fadeOut();
						}
						
					}
				});
				callApartmentCart();
			}
			return false; 
		}
	});

	function callFlightCart(att){
		console.log('Open!!!');	
        var cart = $('.shopingcart');
        var imgtodrag = $("#F"+att).eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '30px',
                    'width': '70px',
                    'z-index': '10000000'
            })  
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 15,
                    'left': cart.offset().left + 15,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo'); 
			
            
            setTimeout(function (ev) {

				contentwrapper_cart.style.top =0;
				// mac chrome issue:
				document.body.scrollTop = document.documentElement.scrollTop = 0;
				// add modalview class
				classie.add( perspectivewrapper_cart, 'modalview' );
				$('.ritcart').addClass('showcart' );
				
				var hetofcart = $('.outer-nav.vertical').height() + 200+'px';
				$('.perspective').css({'height':hetofcart});
				$('.perspective').css({'min-height':$(window).height()});

				// animate..
				setTimeout( function() { classie.add( perspectivewrapper_cart, 'animate' ); }, 25 );
			}, 1500);
			console.log('YUP!!');

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        }
	}
	
	function callHotelCart(att){
		console.log('Open!!!');	
        var cart = $('.shopingcart');
        var imgtodrag = $("#H"+att).eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '200px',
                    'width': '219px',
                    'z-index': '10000000'
            })  
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 15,
                    'left': cart.offset().left + 15,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo'); 
			
            
            setTimeout(function (ev) {

				contentwrapper_cart.style.top =0;
				// mac chrome issue:
				document.body.scrollTop = document.documentElement.scrollTop = 0;
				// add modalview class
				classie.add( perspectivewrapper_cart, 'modalview' );
				$('.ritcart').addClass('showcart' );
				
				var hetofcart = $('.outer-nav.vertical').height() + 200+'px';
				$('.perspective').css({'height':hetofcart});
				$('.perspective').css({'min-height':$(window).height()});

				// animate..
				setTimeout( function() { classie.add( perspectivewrapper_cart, 'animate' ); }, 25 );
			}, 1500);
			console.log('YUP!!');

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        }
	}


	function callCarCart(att){
		console.log('Open!!!');	
        var cart = $('.shopingcart');
        var imgtodrag = $("#C"+att).eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '30px',
                    'width': '70px',
                    'z-index': '10000000'
            })  
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 15,
                    'left': cart.offset().left + 15,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo'); 
			
            
            setTimeout(function (ev) {

				contentwrapper_cart.style.top =0;
				// mac chrome issue:
				document.body.scrollTop = document.documentElement.scrollTop = 0;
				// add modalview class
				classie.add( perspectivewrapper_cart, 'modalview' );
				$('.ritcart').addClass('showcart' );
				
				var hetofcart = $('.outer-nav.vertical').height() + 200+'px';
				$('.perspective').css({'height':hetofcart});
				$('.perspective').css({'min-height':$(window).height()});

				// animate..
				setTimeout( function() { classie.add( perspectivewrapper_cart, 'animate' ); }, 25 );
			}, 1500);
			console.log('YUP!!');

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        }
	}

	function callVacationCart(){
		console.log('Open!!!');	
        var cart = $('.shopingcart');
        var imgtodrag = $("#vac_img").eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                top: imgtodrag.offset().top,
                left: imgtodrag.offset().left
            })
                .css({
                'opacity': '0.5',
                    'position': 'absolute',
                    'height': '30px',
                    'width': '70px',
                    'z-index': '10000000'
            })  
                .appendTo($('body'))
                .animate({
                'top': cart.offset().top + 15,
                    'left': cart.offset().left + 15,
                    'width': 75,
                    'height': 75
            }, 1000, 'easeInOutExpo'); 
			
            
            setTimeout(function (ev) {

				contentwrapper_cart.style.top =0;
				// mac chrome issue:
				document.body.scrollTop = document.documentElement.scrollTop = 0;
				// add modalview class
				classie.add( perspectivewrapper_cart, 'modalview' );
				$('.ritcart').addClass('showcart' );
				
				var hetofcart = $('.outer-nav.vertical').height() + 200+'px';
				$('.perspective').css({'height':hetofcart});
				$('.perspective').css({'min-height':$(window).height()});

				// animate..
				setTimeout( function() { classie.add( perspectivewrapper_cart, 'animate' ); }, 25 );
			}, 1500);
			console.log('YUP!!');

            imgclone.animate({
                'width': 0,
                    'height': 0
            }, function () {
                $(this).detach()
            });
        }
	}

	//Cart flying effect for flight
	$(document).ready(function () {
	    $(document).on("click", ".FlightbookNow", function (e) {
	        e.preventDefault();
	        var att = $(this).attr('data-attr');
	        var action = WEB_URL+'/flight/AddToCart';
			$.ajax({
				type: "POST",
				url: action,
				data: $("#"+att).serialize(),
				dataType: "json",
				beforeSend: function(){
					$('.crtempty').fadeOut();
			        $('.cartloading').fadeIn();
			    },
				success: function(data){
					
			
					if(data.is_xml_msg!=''){
					Errortext=data.is_xml_msg.replace(/(<([^>]+)>)/ig,"");
						alert(Errortext+"(Please Try Again Or Select Other).");
						$('.cartcnt').html(data.count);
						loadCart(data);
						$('.cartloading').fadeOut();
						}
					if(data.isCart == false){
						$('.crtempty').fadeIn();
						
					}

					if(data.status == 1){
						console.log('ajaxsuccess');
						$('.cartcnt').html(data.count);
						loadCart(data);
						$('.cartloading').fadeOut();
					}
					
				}
			});
			callFlightCart(att);
	    });
		
		//Cart flying effect for hotel
		$(document).on("click", ".HotelbookNow", function (e) {
	        e.preventDefault();
	        var att = $(this).attr('data-attr');
			var att_tempid = $(this).attr('data-tempid');
	        var action = WEB_URL+'/hotel/AddToCart';
			$.ajax({
				type: "GET",
				url: action,
				data: $("#bookNow"+att_tempid).serialize(),
				dataType: "json",
				beforeSend: function(){
					$('.crtempty').fadeOut();
			        $('.cartloading').fadeIn();
			    },
				success: function(data){
					if(data.isCart == false){
						$('.crtempty').fadeIn();
					}
					if(data.status == 1){
						console.log('ajaxsuccess');
						$('.cartcnt').html(data.count);
						loadCart(data);
						$('.cartloading').fadeOut();
					}
					
				}
			});
			callHotelCart(att);
	    });
		//Cart flying effect for car
	    $(document).on("click", ".CarbookNow", function (e) {
	        e.preventDefault();
	        var att = $(this).attr('data-attr');
	        var action = WEB_URL+'/car/AddToCart';
			$.ajax({
				type: "GET",
				url: action,
				data: $("#"+att).serialize(),
				dataType: "json",
				beforeSend: function(){
					$('.crtempty').fadeOut();
			        $('.cartloading').fadeIn();
			    },
				success: function(data){
					if(data.isCart == false){
						$('.crtempty').fadeIn();
					}
					if(data.status == 1){
						console.log('ajaxsuccess');
						$('.cartcnt').html(data.count);
						loadCart(data);
						$('.cartloading').fadeOut();
					}
					
				}
			});
			callCarCart(att);
	    });
	    //Cart flying effect for vacation
	    $(document).on("click", ".VacbookNow", function (e) {
	        e.preventDefault();
	        var id = $(this).attr('data-attr');
	        var req = $('.vac_req').val();
	        var image = $('.vac_img').val();
	        var action = WEB_URL+'/vacation/AddToCart';
			$.ajax({
				type: "GET",
				url: action,
				data: {id: id, image: image, request: req},
				dataType: "json",
				beforeSend: function(){
					$('.crtempty').fadeOut();
			        $('.cartloading').fadeIn();
			    },
				success: function(data){
					if(data.isCart == false){
						$('.crtempty').fadeIn();
					}
					if(data.status == 1){
						console.log('ajaxsuccess');
						$('.cartcnt').html(data.count);
						loadCart(data);
						$('.cartloading').fadeOut();
					}
					
				}
			});
			callVacationCart();
	    });
		
		
	});
	
	
		
		

		perspectivewrapper_cart.addEventListener( clickevent, function( ev ) { return false; } );
	}

	init();

})();

function loadCart(data){
	console.log('Cart Loading...');
	var template = $('#CartTpl').html();
    var output = Mustache.render(template, data);
  	$('.loadcart').html(output);
  	console.log('Cartcoming');
}
