function sortHotels($order,$sortBy,curSel)
{
    var hotels = $('.resultHotels .searchhotel_box').get();
    hotels.sort(function(a,b)
    {
		if($sortBy=="data-hotel-name")
		{
			//============= To Check Non Numerical VAlues=====================
			var keyA = $(a).find('.HotelInfoBox').attr($sortBy);
			var keyB = $(b).find('.HotelInfoBox').attr($sortBy);
		}
		else if($sortBy=="data-review" || $sortBy=="data-star")
		{
			//============= To Check Numerical VAlues=========================
			var keyA = parseFloat($(a).find('.HotelInfoBox').attr($sortBy));
			var keyB = parseFloat($(b).find('.HotelInfoBox').attr($sortBy));
		}
                else
                {
                     //============= To Check Numerical VAlues=========================
			var keyA = parseInt($(a).find('.HotelInfoBox').attr($sortBy));
			var keyB = parseInt($(b).find('.HotelInfoBox').attr($sortBy));  
                }
		if($order=="asc")
		{
			if (keyA < keyB) return -1;
			if (keyA > keyB) return 1;
		}
		else
		{
			if (keyA > keyB) return -1;
			if (keyA < keyB) return 1;
		}
		return 0;
    });
                
                
    var container = $('.resultHotels');
    $.each(hotels, function(i, ul)
    {
		container.append(ul);
		
    });
    
    if($order=="asc")
		curSel.attr("data-order",'desc');                    
    else
		curSel.attr("data-order",'asc');
	
}

