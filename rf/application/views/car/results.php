<?php $this->load->view('common/header');
//print_r($req);die;
?>
<div class="full moditop">
  <div class="container fordetailpage">
    <div class="container mt15 offset-0">
      <div class="col-lg-12  myadvance">
        <div class="col-lg-5 nopad">
          <div class="tablpik">
            <div class="pik">Pick up</div>
            <div class="deplablpik">
              <strong><?php echo $this->flight_model->get_airport_cityname($req->pickup);?> (<?php echo $req->pickup;?>) </strong><?php echo date('d<\s\up>S</\s\up> M Y H:i',strtotime($req->depart_date." ".$req->depart_time));?>
            </div>
          </div>
        </div>
        <div class="col-lg-5 nopad">
          <div class="tablpik">
            <div class="pik">Drop off</div>
            <div class="deplablpik">
              <strong><?php echo $this->flight_model->get_airport_cityname($req->dropoff);?> (<?php echo $req->dropoff;?>) </strong><?php echo date('d<\s\up>S</\s\up> M Y H:i',strtotime($req->return_date." ".$req->return_time));?>
            </div>
          </div>
        </div>
        <div class="htlmod collapse" id="modhtl">
          <div class="htlmodin widthmn">
            <div class="col-md-12 nopad">
              <div class="smalsent">Modify your search</div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="full flitgray">
  <div class="container fordetailpage">
    <div class="container mt15 offset-0">           
      <!-- FILTERS -->
      <div class="col-md-3 filters nopad">
        <!-- Car groups -->
        <div class="rowfilter">					
          <button type="button" class="filtedhed" data-toggle="collapse" data-target="#cargroup">
            <span class="hedfiltr">Car groups</span>
            <span class="filterdoen"></span>
          </button>
          <div id="cargroup" class="collapse merange">
            <div class="infiltrbox">
              <ul class="paddivs" id="GroupFilter">
              </ul>
            </div>
          </div>                   
        </div>
        <!-- Car groups End -->
        <!-- Equipment -->
        <div class="rowfilter">					
          <button type="button" class="filtedhed" data-toggle="collapse" data-target="#equipment">
            <span class="hedfiltr">Equipment</span>
            <span class="filterdoen"></span>
          </button>
          <div id="equipment" class="collapse merange">
            <div class="infiltrbox">
              <ul class="paddivs" id="EquipmentFilter">
              </ul>
            </div>
          </div>                   
        </div>
        <!-- Equipment End -->	
        <!-- Car rental agent  -->
        <div class="rowfilter">					
          <button type="button" class="filtedhed" data-toggle="collapse" data-target="#vendor">
            <span class="hedfiltr">Car rental agent</span>
            <span class="filterdoen"></span>
          </button>
          <div id="vendor" class="collapse merange">
            <div class="infiltrbox">
              <ul class="paddivs" id="VendorFilter">
              </ul>
            </div>
          </div>                   
        </div>
        <!-- Car rental agent End -->	
      </div>
      <!-- END OF FILTERS -->
      <!-- LIST CONTENT-->
      <div class="rightcontent col-md-9 padlisting">
        <div class="itemscontainer">
          <div class="col-lg-12 nopad">
            <ul class="sortul">
              <li class="sorthd">Sort by</li>
              <li class="upndwn"><a class="ascending" id="SortbyVendor">Vendor Name</a></li>
              <li class="upndwn"><a class="ascending" id="SortbyVehicle">Car Type</a></li>
              <li class="upndwn active"><a class="ascending" id="SortbyPrice">Car Price</a></li>
            </ul>
          </div>
          <div class="clearfix"></div>
          <!-- FLIGHT TICKET-->
          <!-- Normal trip-->
          <div id="cars" class="cars">
            <ul class="cardis cars">
              <?php  $data['cars'] = $cars;
              $this->load->view('car/ajax_results', $data); ?>
            </ul>
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
<div id="cardets" class="popuofixissue"> <span class="buttonclose pop-close"><span>X</span></span>
  <div class="listingpopup">
    <div class="lodrefrentrev imgLoader">
      <div class="centerload"></div>
    </div>
    <div class="popuphed"> <span class="popbighed">Vehicle Detail</span> </div>
    <div class="popconyent overvis vehicledetail"></div>
  </div>
</div>
<script type="text/javascript">
$('#SortbyVendor').on('click', function () {
  $(this).toggleClass("ascending descending");

  $("ul.sortul li").each(function (){
    $(this).removeClass('active');
  });
  $(this).parent().addClass('active');
  var type = $(this).attr('class');
  SortbyVendor(type);
});
$('#SortbyPrice').on('click', function () {
  $(this).toggleClass("ascending descending");

  $("ul.sortul li").each(function (){
    $(this).removeClass('active');
  });
  $(this).parent().addClass('active');
  var type = $(this).attr('class');
  SortbyPrice(type);
});
$('#SortbyVehicle').on('click', function () {
  $(this).toggleClass("ascending descending");
  $("ul.sortul li").each(function (){
    $(this).removeClass('active');    
  });
  $(this).parent().addClass('active');
  var type = $(this).attr('class');
  SortbyVehicle(type);
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
function SortbyVendor(type){
  if (type == 'ascending') {
    $('ul.cars li').map(function () {
      return {val: $(this).data('vendor').replace(/,/g, ''), el: this};
    }).sort(aasc).map(function () {
      return this.el;
    }).appendTo('ul.cars');
  }else{
    $('ul.cars li').map(function () {
      return {val: $(this).data('vendor').replace(/,/g, ''), el: this};
    }).sort(adesc).map(function () {
      return this.el;
    }).appendTo('ul.cars');
  }
}
function SortbyVehicle(type){
  if (type == 'ascending') {
    $('ul.cars li').map(function () {
      return {val: $(this).data('vehicleclass').replace(/,/g, ''), el: this};
    }).sort(aasc).map(function () {
      return this.el;
    }).appendTo('ul.cars');
  }else{
    $('ul.cars li').map(function () {
      return {val: $(this).data('vehicleclass').replace(/,/g, ''), el: this};
    }).sort(adesc).map(function () {
      return this.el;
    }).appendTo('ul.cars');
  }
}
function aasc(a, b){
  return (a.val > b.val) ? 1 : 0;
}
function adesc(a, b){
  return (a.val < b.val) ? 1 : 0;
}
function descending(a, b) {
  return b.val - a.val;
}
function ascending(a, b) {
  return a.val - b.val;
}	
$(document).ready(function() {
  $(document).on("click", ".onreqst", function (e) {
    var attr = $(this).data('attr');
    console.log(attr);
    $('#cardets').provabPopup({
      modalClose: true, 
      zIndex: 10000005,
    });
    $.ajax({
      type:'GET', 
      url: '<?php echo WEB_URL;?>/car/GetDetails',
      data: $("#"+attr).serialize(),
      dataType: "json",
      beforeSend: function(XMLHttpRequest){
        $('#cardets .imgLoader').fadeIn();
      }, 
      success: function(response) {
        if(response.status == 1){
          $('div.vehicledetail').html(response.detail);
        }
        $('#cardets .imgLoader').fadeOut();
      }
    });
  });
});
</script>
<?php $this->load->view('common/footer');?>
</body>
</html>