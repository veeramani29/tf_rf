function sortHotels($order,$sortBy,curSel)
{
    
    var hotels = $('.resultBus .searchbus_box').get();
    hotels.sort(function(a,b)
    {
        
		if($sortBy=="data-operater")
		{
			//============= To Check Non Numerical VAlues=====================
			var keyA = $(a).find('.BusInfoBox').attr($sortBy);
			var keyB = $(b).find('.BusInfoBox').attr($sortBy);
		}
                else
                {
                    //alert('asdasda');
                     //============= To Check Numerical VAlues=========================
			var keyA = parseInt($(a).find('.BusInfoBox').attr($sortBy));
			var keyB = parseInt($(b).find('.BusInfoBox').attr($sortBy));  
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
                
                
    var container = $('.resultBus');
    $.each(hotels, function(i, ul)
    {
		container.append(ul);
		
    });
    
    if($order=="asc")
		curSel.attr("data-order",'desc');                    
    else
		curSel.attr("data-order",'asc');
	
}

