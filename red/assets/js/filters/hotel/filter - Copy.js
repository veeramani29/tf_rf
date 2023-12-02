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
//    $location=new Array;
//   // $location1=new Array;
//    $mealplan=new Array;
//    $amenity=new Array;
    
    $(".star:checked").each(function()
    {
        $starNum=parseFloat($(this).val());
        $stars.push($starNum); 
    });  
    
//    $(".location_name:checked").each(function()
//    {
//        $locationNum=$(this).val();
//        $location.push($locationNum); 
//    });
    
//    $(".location_name1:checked").each(function()
//    {
//        $locationNum1=$(this).val();
//        $location1.push($locationNum1); 
//    });
	
//    $(".mealplan_filter:checked").each(function()
//    {
//        $mealplan_filter=$(this).val();
//        $mealplan.push($mealplan_filter); 
//    });
//    
//    $(".amenity_nm:checked").each(function()
//    {
//        $amenityNum=$(this).val();
//        $amenity.push($amenityNum); 
//    });
    
    
  
    hotelCount = 0;
    $(".HotelInfoBox").each(function()
    {		
        $datastar=parseFloat($(this).attr("data-star"));
        //$datalocation=$(this).attr("data-location");
	//$datalocation1=$(this).attr("data-location1"); 
        //$datamealplan=$(this).attr("data-mealplan");
        $dataprice=parseFloat($(this).attr("data-price"));
        //$datafac = $(this).attr("data-amenity");
       
        var starShow=$.inArray($datastar, $stars)>=0?true:false;
        //var locationShow=$.inArray($datalocation, $location)>=0?true:false;
        //var locationShow1=$.inArray($datalocation1, $location1)>=0?true:false;
        //var mealshow=$.inArray($datamealplan, $mealplan)>=0?true:false;
        
//        $facarray = $datafac.split('<br>');
//        $facShow = false;
//        for(var i=0; i<($amenity.length); i++)
//        {
//            if($.inArray($facarray[i], $amenity)>=0) 
//            {
//                $facShow = true;
//            }
//        }
        
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && starShow )
        {
            hotelCount++;
            $(this).parents(".searchhotel_box").show();
        }
        else
        {
            $(this).parents(".searchhotel_box").hide();
        }
    });  
    
    $("#hotel_count").text(hotelCount+' Hotels Found');	
}

//function filter_matrix_class(str)
//{
//    
//    $stararray=new Array;
//    $stararray=str.split(',');
//    
//    hotelCount = 0;
//    $(".HotelInfoBox").each(function()
//    {	
//        $datafac = $(this).attr("data-star");
//        //alert($datafac);
//        $facShow = false;
//        
//        document.getElementById("0").checked = false;
//        document.getElementById("1").checked = false;
//        document.getElementById("2").checked = false;
//        document.getElementById("3").checked = false;
//        document.getElementById("4").checked = false;
//        document.getElementById("5").checked = false;
//        
////        document.getElementById("ofive").checked = false;
////        document.getElementById("tfive").checked = false;
////        document.getElementById("ttfive").checked = false;
////        document.getElementById("ffive").checked = false;
//        for(var i=0; i<($stararray.length); i++)
//        {
//            if($stararray[i]==0)
//                document.getElementById("0").checked = true;
//            if($stararray[i]==1)
//                document.getElementById("1").checked = true;
////            if($stararray[i]==1.5)
////                document.getElementById("ofive").checked = true;
//            if($stararray[i]==2)
//                document.getElementById("2").checked = true;
////            if($stararray[i]==2.5)
////                document.getElementById("tfive").checked = true;
//            if($stararray[i]==3)
//                document.getElementById("3").checked = true;
////            if($stararray[i]==3.5)
////                document.getElementById("ttfive").checked = true;
//            if($stararray[i]==4)
//                document.getElementById("4").checked = true;
//            if($stararray[i]==4.5)
////                document.getElementById("ffive").checked = true;
//            if($stararray[i]==5)
//                document.getElementById("5").checked = true;
//            
//            if($datafac==$stararray[i])
//            {
//                $facShow = true;
//            }
//        }
//        
//        if($facShow)
//        {
//            hotelCount++;
//            $(this).parents(".searchhotel_box").show();
//        }
//        else
//        {
//            $(this).parents(".searchhotel_box").hide();
//        }
//    });  
//    
//    $("#hotelCount").text(hotelCount);	
//}

function matrix_filter_name(name)
{
        var count = 0;
        $(".HotelInfoBox").each(function()
        {           
            $datafac = $(this).attr("data-hotel-name");
            //alert(name +'<<<<>>>>'+ $datafac);
            if (name!=$datafac) 
            { 
                 $(this).parents(".searchhotel_box").hide();         
            } 
            else 
            {
		count++;
                $(this).parents(".searchhotel_box").show();
               
            }
            
        });
$("#hotel_count").text(count+' Hotels Found');	
}