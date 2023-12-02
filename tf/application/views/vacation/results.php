<?php $this->load->view('common/header');?>



<div class="full flitgray moditop">
    <div class="container fordetailpage">
        <div class="container mt15 offset-0">           
            <!-- FILTERS -->
			<div class="col-md-3 filters nopad">
           
                <!-- Car groups -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#starrting">
                      <span class="hedfiltr">Star Rating</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="starrting" class="collapse merange">
                        <div class="infiltrbox">
                            <ul class="paddivs" id="RatingFilter">
                            	
                                
                            </ul>
                        </div>
                    </div>                   
                </div>
                <!-- Car groups End -->
                

                <!-- Equipment -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#equipment">
                      <span class="hedfiltr">Duration</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="duration" class="collapse merange">
                        <div class="infiltrbox">
                            <ul class="paddivs" id="DurationFilter">
                            	
                            </ul>
                        </div>
                    </div>                   
                </div>
                <!-- Equipment End -->	
                
                
                
                
            </div>
			<!-- END OF FILTERS -->
			
			<!-- LIST CONTENT-->
			<div class="rightcontent col-md-9 padlisting">

				<div class="lodrefrentrev imgLoader">
                      <div class="centerload"></div>
                </div>
				<div class="itemscontainer">
                
                
                <div class="col-md-6 nopad">
                	<ul class="sortul">
                    	<li class="sorthd">Sort by</li>
                        <li class="upndwn"><a class="ascending" id="SortbyType">Type</a></li>
                        <li class="upndwn"><a class="ascending" id="SortbyDuration">Duration</a></li>
                        <li class="upndwn active"><a class="ascending" id="SortbyPrice">Price</a></li>  
                    </ul>
                </div>
                
                <!-- <div class="col-md-6 nopad">
                <div class="right">
                    <div class="pkgserch posrel myselect">
                        <select class="mySelectBoxClass flyinput text-right">
                            <option>Bengaluru</option>
                            <option>Goa</option>
                        </select>
                    </div>
                    <button class="pkgsbmit"></button>
				</div>
				</div> -->
<script type="text/javascript">
$('#SortbyType').on('click', function () {
  $(this).toggleClass("ascending descending");
   
  $("ul.sortul li").each(function (){
    $(this).removeClass('active');
    
  });
  //$(this).parent().addClass(cls);

  $(this).parent().addClass('active');
    var type = $(this).attr('class');
  //alert(type);
    SortbyType(type);
    //tooltip();
});
$('#SortbyPrice').on('click', function () {
  $(this).toggleClass("ascending descending");
   
  $("ul.sortul li").each(function (){
    $(this).removeClass('active');
    
  });
  //$(this).parent().addClass(cls);

  $(this).parent().addClass('active');
    var type = $(this).attr('class');
  //alert(type);
    SortbyPrice(type);
    //tooltip();
});
$('#SortbyDuration').on('click', function () {
  $(this).toggleClass("ascending descending");
   
  $("ul.sortul li").each(function (){
    $(this).removeClass('active');
    
  });
  //$(this).parent().addClass(cls);

  $(this).parent().addClass('active');
    var type = $(this).attr('class');
  //alert(type);
    SortbyDuration(type);
    //tooltip();
});
function SortbyPrice(type){
  if (type == 'ascending') {
      $('ul.cars li').map(function () {
      return {val: parseFloat($(this).data('price')), el: this};
      }).sort(ascending).map(function () {
      return this.el;
      }).appendTo('ul.cars');
  }else{
    $('ul.cars li').map(function () {
      return {val: parseFloat($(this).data('price')), el: this};
      }).sort(descending).map(function () {
      return this.el;
      }).appendTo('ul.cars');
  }
}
function SortbyType(type){
  if (type == 'ascending') {
      $('ul.cars li').map(function () {
      return {val: $(this).data('type').replace(/,/g, ''), el: this};
      }).sort(aasc).map(function () {
      return this.el;
      }).appendTo('ul.vacations');
  }else{
    $('ul.cars li').map(function () {
      return {val: $(this).data('type').replace(/,/g, ''), el: this};
      }).sort(adesc).map(function () {
      return this.el;
      }).appendTo('ul.vacations');
  }
}
function SortbyDuration(type){
  if (type == 'ascending') {
      $('ul.cars li').map(function () {
      return {val: $(this).data('duration').replace(/,/g, ''), el: this};
      }).sort(aasc).map(function () {
      return this.el;
      }).appendTo('ul.vacations');
  }else{
    $('ul.cars li').map(function () {
      return {val: $(this).data('duration').replace(/,/g, ''), el: this};
      }).sort(adesc).map(function () {
      return this.el;
      }).appendTo('ul.vacations');
  }
}

function aasc(a, b){
  //alert(a.val);
  return (a.val > b.val) ? 1 : 0;
}

function adesc(a, b){
  return (a.val < b.val) ? 1 : 0;
}

function descending(a, b) {
  //alert('descending');
    return b.val - a.val;
}

function ascending(a, b) {
  //alert('ascending');
    return a.val - b.val;
}   
        </script>	
				<div class="clearfix"></div>
					<!-- FLIGHT TICKET-->
                    
                    <!-- Normal trip-->
                   <div id="vacations" class="vacations">
                   	<ul class="cardis vacations"></ul>
                   </div>
                    <!-- Normal trip End-->
                    
             
                    <div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
					

				</div>	
				<!-- End of offset1-->		

				

			</div>
			<!-- END OF LIST CONTENT-->
            
            
            

            
            
            
            
        </div>
    </div>
</div>








<div id="cardets" style="width: 50%"> <span class="buttonclose pop-close"><span>X</span></span>
  <div class="listingpopup">
    <div class="popuphed"> <span class="popbighed">Vehicle Detail</span> </div>
    <div class="popconyent overvis">
    
      <div class="col-md-6 nopad">
      	<div class="wrappopimg">
            <div class="popcarhed">Tata Indica or similar</div>
            <div class="popcarimg"><img src="<?php echo ASSETS;?>images/car1.jpeg" alt="" /></div>
            <div class="popcarprice">$ 3070.54 <strong>for 1 days</strong></div>
        </div>
      </div>
      
      <div class="col-md-6 nopad">
      	<div class="icononlycar">
            <a class="iconwithdes tooltipp" title="Passenger">
                <span class="aicon psnger"></span>
                <strong>4</strong>
            </a>
            <a class="iconwithdes tooltipp" title="Baggage">
                <span class="aicon baggage"></span>
                <strong>3</strong>
            </a>
            <a class="iconwithdes tooltipp" title="Doors">
                <span class="aicon doors"></span>
                <strong>3</strong>
            </a>
            <a class="iconwithdes tooltipp" title="Air conditioned">
                <span class="aicon aircond"></span>
            </a>
            <a class="iconwithdes tooltipp" title="Manual Transmision">
                <span class="aicon manualtrans"></span>
            </a>
            <a class="iconwithdes tooltipp" title="Fuel">
                <span class="aicon fuel"></span>
            </a>
        </div>
        
        
        <div class="clear"></div>
        
        <div class="detailspsn">
        	5 Passenger, 3 Baggage, 3 Doors, Air Conditioning, Manual Transmission 
        </div>
         
      </div>
      <div class="clear"></div>
        <div class="linebrkpop"></div>
      <div class="clear"></div>
      
      <div class="parapop">
      	<h4 class="smlpopl">Car Description</h4>
        <p>
        	With room for 5 passengers and 3 pieces of luggage, this air-conditioned model is perfect for couples, families or small groups.
        </p>
      </div>
      <div class="parapop">
      	<h4 class="smlpopl">Fuel consumption</h4>
        <p>
        	50.0 m/g 
        </p>
      </div>
      <div class="parapop">
      	<h4 class="smlpopl">CO2 emission</h4>
        <p>
        	118.0 g/km 
        </p>
      </div>
      
      <div class="clear"></div>
      
      <div class="popupnotes">
      	The car displayed and models listed are the most common car used by our car rental partners. We cannot guarantee the make or model of the rental car. The purpose of the image and list is to provide a sample only. Please note the luggage capacity varies from make and model and may be reduced once the vehicle is at its full seating capacity. 
      </div>
      
      
    </div>
    <div class="popfooter">
      <button id="addWishList" class="popbutton blubutton">Book Now</button>
    </div>
  </div>
</div>


<script type="text/javascript">	
$(document).ready(function() {
	$('#dynamix').click(function(){
	$('#cardets').provabPopup({
		modalClose: true, 
		zIndex: 100005
	});
	});
});
</script>

<?php $this->load->view('common/footer');?>
<script type="text/javascript">
//Before the AJAX function runs
var start = new Date().getTime(),
    difference;
$(function() {
    //var request = <?php echo $request;?>;
    $.ajax({
      type:'GET', 
      url: '<?php echo WEB_URL;?>/vacation/GetResults/<?php echo $request;?>',
      beforeSend: function(XMLHttpRequest){
        $('.imgLoader').fadeIn();
      }, 
      success: function(response) {
        var endTime = new Date().getTime();
        console.log(difference = new Date().getTime() - start);
        console.log(endTime);
        $('ul.vacations').html(response);
        $('.imgLoader').fadeOut();
      }
    });
});
</script>
</body>
</html>