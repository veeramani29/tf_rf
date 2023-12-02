function setPriceSlider()
{
    var setPriceMin=parseFloat($("#setMinPrice").val());
    var setPriceMax=parseFloat($("#setMaxPrice").val());
    var currency=$("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function setPriceSlider_round(){
    var setPriceMinR=parseFloat($("#RsetMinPrice").val());
    var setPriceMaxR=parseFloat($("#RsetMaxPrice").val());
    var currencyR=$("#RsetCurrency").val();
    callPriceSliderR(setPriceMinR,setPriceMaxR,currencyR);
    priceSortingR();
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

function callPriceSliderR(setPriceMinR,setPriceMaxR,currencyR)
{
    $selector1=$( "#RpriceSlider" );
    $output1=$( "#RpriceSliderOutput");
    $minPrice1=$("#RminPrice");
    $maxPrice1=$("#RmaxPrice");
    $selector1.slider
    ({
        range: true,
        min: setPriceMinR,
        max: setPriceMaxR,
        values: [setPriceMinR, setPriceMaxR],
        slide: function(event, ui)
        {
            if(ui.values[0]+20>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output1.html("<span style='color:red'>"+currencyR+' '+ ui.values[ 0 ] + "</span> to <span style='color:red'>"+currencyR+' '+ui.values[ 1 ] +"</span>");
                $minPrice1.val(ui.values[0]);
                $maxPrice1.val(ui.values[1]);                
            }
        }
    });
    
    $output1.html("<span style='color:red'>"+currencyR+' '+$selector1.slider( "values", 0 ) + "</span> To <span style='color:red'>"+currencyR+' '+ $selector1.slider( "values",1) +"</span>");
    $minPrice1.val($selector1.slider( "values",0));
    $maxPrice1.val($selector1.slider( "values",1));
}

function priceSorting()
{
    $(".ui-slider").bind( "slidestop", function() 
    {
        filter();
    });
}

function priceSortingR(){
    $(".ui-slider").bind( "slidestop", function() 
    {
        filter_round();
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
        //alert($dataprice+'--'+$datapriceR+'---'+stopsShow+'----'+stopsShowR+'---'+airlineShow+'---'+airlineShowR);
        
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
    
}


function filter_round()
{
    $minPrR=parseFloat($("#RminPrice").val());
    $maxPrR=parseFloat($("#RmaxPrice").val());
    
    $stopsR = new Array;
    $airlinesR = new Array;
    
    $(".Rair_filter:checked").each(function()
    {
        $airlineNumR=$(this).val();
        $airlinesR.push($airlineNumR); 
    });
    
    $(".Rstop_filter:checked").each(function()
    {
        $stopsNumR=parseFloat($(this).val());
        $stopsR.push($stopsNumR); 
    });

  
    flightCount = 0;
    $(".RFlightInfoBox").each(function()
    {
        $datastopsR = parseFloat($(this).attr("data-Rstops"));
	$dataairlineR = $(this).attr("data-Rairlines");
        $datapriceR = parseFloat($(this).attr("data-Rprice"));
        
        var stopsShowR = $.inArray($datastopsR, $stopsR)>=0?true:false;
        var airlineShowR = $.inArray($dataairlineR, $airlinesR)>=0?true:false;
        
        
        if(($datapriceR<=$maxPrR && $datapriceR>=$minPrR) && stopsShowR && airlineShowR)
        {
            flightCount++;
            $(this).parents(".Rsearchflight_box").show();
        }
        else
        {
            $(this).parents(".Rsearchflight_box").hide();
        }
    });
}
