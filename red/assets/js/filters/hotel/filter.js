function setPriceSlider()
{
    var setPriceMin=parseFloat($("#setMinPrice").val());
    var setPriceMax=parseFloat($("#setMaxPrice").val());
    var currency=$("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function callPriceSlider(setPriceMin,setPriceMax,currency)
{	
    $selector=$( "#priceSlider" );
    $output=$( "#priceSliderOutput");
    $minPrice=$("#minPrice");
    $maxPrice=$("#maxPrice");
    $selector.slider
    ({
        range: true,
        min: setPriceMin,
        max: setPriceMax,
        values: [setPriceMin, setPriceMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+20>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output.html("<span style='color:red'>"+currency+' '+ ui.values[ 0 ] + "</span> to <span style='color:red'>"+currency+' '+ui.values[ 1 ] +"</span>");
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    
    $output.html("<span style='color:red'>"+currency+' '+$selector.slider( "values", 0 ) + "</span> To <span style='color:red'>"+currency+' '+ $selector.slider( "values",1) +"</span>");
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}


function priceSorting()
{
    $(".ui-slider").bind( "slidestop", function() 
    {
        filter();
    });
}

function filter()
{ 	
    //alert('hello');
    $minPr=parseFloat($("#minPrice").val());
    $maxPr=parseFloat($("#maxPrice").val());   
    
    $stars=new Array;
    $location=new Array;
    //$amenity=new Array;
    $type=new Array;
    
    $(".star:checked").each(function()
    {
        $starNum=parseFloat($(this).val());
        $stars.push($starNum); 
    });  
    
    $(".location_filter:checked").each(function()
    {
        $locationNum=$(this).val();
        $location.push($locationNum); 
    });
    
//    $(".amenity_filter:checked").each(function()
//    {
//        $amenityNum=$(this).val();
//        $amenity.push($amenityNum); 
//    });
	
    $(".type_filter:checked").each(function()
    {
        $typeNum=$(this).val();
        $type.push($typeNum); 
    });

  
    hotelCount = 0;
    $(".HotelInfoBox").each(function()
    {		
        $datastar=parseFloat($(this).attr("data-star"));
        $datalocation=$(this).attr("data-location");
	//$dataamenity=$(this).attr("data-facility"); 
        $datatype=$(this).attr("data-type");
        $dataprice=parseFloat($(this).attr("data-price"));
       
        var starShow=$.inArray($datastar, $stars)>=0?true:false;
        var locationShow=$.inArray($datalocation, $location)>=0?true:false;
        var typeShow=$.inArray($datatype, $type)>=0?true:false;
        
//        $amenityarray = $dataamenity.split(';');
//        $amenityShow = false;
//        for(var i=0; i<($amenity.length); i++)
//        {
//            if($.inArray($amenityarray[i], $amenity)>=0) 
//            {
//                $amenityShow = true;
//            }
//        }
        
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && starShow && locationShow && typeShow)
        {
            hotelCount++;
            $(this).parents(".searchhotel_box").show();
        }
        else
        {
            $(this).parents(".searchhotel_box").hide();
        }
    });  
    
    $("#count_progress").text(hotelCount);	
}
