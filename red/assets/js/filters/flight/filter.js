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
    $minPr=parseFloat($("#minPrice").val());
    $maxPr=parseFloat($("#maxPrice").val());   
    
    
    $stops = new Array;
    $airlines = new Array;
    
    $(".stop_filter:checked").each(function()
    {
        $stopsNum=parseFloat($(this).val());
        $stops.push($stopsNum); 
    });  
    
    $(".air_filter:checked").each(function()
    {
        $airlineNum=$(this).val();
        $airlines.push($airlineNum); 
    });
    
   

  
    flightCount = 0;
    $(".FlightInfoBox").each(function()
    {
        $datastops=parseFloat($(this).attr("data-stops"));
	$dataairline=$(this).attr("data-airlines");
        $dataprice=parseFloat($(this).attr("data-price"));
       
        
        var stopsShow=$.inArray($datastops, $stops)>=0?true:false;
        var airlineShow=$.inArray($dataairline, $airlines)>=0?true:false;
        
        
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && stopsShow && airlineShow)
        {
            flightCount++;
            $(this).parents(".searchflight_box").show();
        }
        else
        {
            $(this).parents(".searchflight_box").hide();
        }
    });  
    
    $("#count_progress").html(flightCount);	
}
