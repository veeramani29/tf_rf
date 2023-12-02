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
    
    $deptime=new Array;
    $operator=new Array;
    $type=new Array;
    
    $(".operator_filter:checked").each(function()
    {
        $operatorNum=$(this).val();
        $operator.push($operatorNum); 
    });  
    
    $(".type_filter:checked").each(function()
    {
        $typeNum=$(this).val();
        $type.push($typeNum); 
    });
    
   

  
    busCount = 0;
    $(".BusInfoBox").each(function()
    {
        $datatype=$(this).attr("data-bustype");
	$dataoperator=$(this).attr("data-operater");
        $dataprice=parseFloat($(this).attr("data-price"));
       
        
        var operatorShow=$.inArray($dataoperator, $operator)>=0?true:false;
        var typeShow=$.inArray($datatype, $type)>=0?true:false;
        
        
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && operatorShow && typeShow)
        {
            busCount++;
            $(this).parents(".searchbus_box").show();
        }
        else
        {
            $(this).parents(".searchbus_box").hide();
        }
    });  
    
    $("#count_progress").text(busCount);	
}
