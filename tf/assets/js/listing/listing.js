$(document).ready(function() {
	$('#mngList').on('change', function() {
		$('#LstngLdr').show();
		var showListing = $(this).val();

		//$('#lstContainer').load(WEB_URL+'/dashboard/ajax_getListing/', )

		$.ajax({
			url: WEB_URL+'/dashboard/ajax_getListing/',
			method: "POST",
			data: {'list_type': showListing},
			dataType: 'json',
			success: function(r) {
				$('#lstContainer').empty();
				$('#lstContainer').html(r);
				createListingPagination();
				$('#LstngLdr').hide();
			}
		})
	})

	$(document).on('click', '.transAccept', function(e) {
		e.stopImmediatePropagation();
		accept_type = $(this).data('accept');
		pnr = $(this).data('pnr');

        $.ajax({
            url: WEB_URL+'/account/transactionStatusChange',
            method: "POST",
            data: {"accept_pnr": pnr, "accept_bit": accept_type},
            dataType: "JSON",

            success: function(r) {
                $(".transactionRecievedBx").remove();
                if(accept_type == 1) {
                	$('.rcievdPay').addClass('completed');
                }
            }
        }) 

	})





})