<?php 
  foreach($vacations as $vacation){
  $rating[] = $vacation->package_rating;
  $duration[] = $vacation->duration;
  $aMarkup = $this->account_model->get_markup('VACATION'); //get markup
  $aMarkup = $aMarkup['markup'];

  $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
  $myMarkup = $MyMarkup['markup'];

  $package_price = $this->account_model->PercentageToAmount($vacation->package_price,$aMarkup);
  $package_price = $this->account_model->PercentageToAmount($package_price,$myMarkup);
?>
<li class="cardisli" data-type="<?php echo $vacation->package_type;?>" data-price="<?php echo $vacation->package_price;?>" data-duration="<?php echo $vacation->duration;?>" data-starrting="<?php echo $vacation->package_rating;?>">
	<div class="pakgefulname">
    	<div class="col-md-8 nopad">
        	<div class="pkgnameleft"><?php echo $vacation->package_name;?>, <?php echo $this->flight_model->get_airport_cityname($vacation->package_cityid);?></div>
        </div>
        <div class="col-md-4 nopad">
        	<div class="pakgnamerit"><?php echo $vacation->duration;?> Days/<?php echo $vacation->duration-1;?> Nights</div>
        </div>
    </div>
    <div class="clear"></div>
    
   <div class="col-md-3 nopad">
   	<div class="pakgimage">
    	<img src="<?php echo $vacation->image;?>" alt="" style="height: 103px;width: 180px;"/>
    </div>
   </div>
   
   <div class="col-md-7 splpadpkg">
   		<span class="inpkgname"><?php echo $this->flight_model->get_airport_cityname($vacation->package_cityid);?>(<?php echo $vacation->duration-1;?> Nights)</span>
        <span class="staringpkg"><img src="<?php echo ASSETS;?>images/filter-rating-<?php echo $vacation->package_rating;?>.png" alt="" /></span>
        <span class="pkgdesc"><?php echo substr($vacation->package_description, 0, 220).'...'; ?></span>
   </div>
   <div class="col-md-2 nopad">
   	<span class="pkgprice"><span class="curr_icon"><?php echo $this->display_icon;?></span><span data-usd="<?php echo $package_price;?>" class="amount"><?php echo $this->account_model->currency_convertor($package_price);?></span></span>
    <span class="detailpkg">
    	<a href="<?php echo WEB_URL;?>/vacation/detail/<?php echo $vacation->package_id;?>/<?php echo $req;?>" class="carbook">View Detail</a>
    </span>
   </div>
</li>
<?php }?>
<?php 
    echo '<div id="errorMessage" style="text-align:center;display:none;" class="no_available">
    <h1>There are no vacations available. </h1>
    <br><br>
    <div class="no_available_text">Sorry, we have no prices for vacations in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br></div>
    </div>'; // Error Message
?>
<?php $rating = array_unique($rating); //Creating Unique Rating?>
<?php $duration = array_unique($duration); //Creating Unique Duration?>
<script>
$('#starrting').addClass('in');
$('#RatingFilter').html('<?php $i=1;foreach($rating as $starrting){?><li class="cheklist"><label for="class<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue starrting" name="starrting" type="checkbox" id="starrting<?php echo $i;?>" value="<?php echo $starrting;?>" checked/></div><span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-<?php echo $starrting;?>.png" alt="" /></span><label></li><?php $i++; }?>');       
var $filters = $("input:checkbox[name='starrting']"); // start all checked
var $categoryContent = $('ul.vacations li'); // Path for cars
var $errorMessage = $('#errorMessage'); //Error Message
//$filters.click(function() {
$filters.on('ifChanged', function(event){
  $categoryContent.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters = $filters.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters.length > 0) {
    $errorMessage.hide();
    $selectedFilters.each(function (i, el) {
      $('ul.vacations li[data-starrting="'+ el.value +'"]').show();
    });
  } else {
      $errorMessage.show();
  }
});

$('#duration').addClass('in');
$('#DurationFilter').html('<?php $i=1;foreach($duration as $dur){?><li class="cheklist"><label for="duration<?php echo $i;?>"><div class="left"><input class="filtchk serch-blue starrting" name="duration" type="checkbox" id="duration<?php echo $i;?>" value="<?php echo $dur;?>" checked/></div><span class="cheklabl"><?php echo $dur;?> - days</span><label></li><?php $i++; }?>');       
var $filters1 = $("input:checkbox[name='duration']"); // start all checked
var $categoryContent1 = $('ul.vacations li'); // Path for cars
var $errorMessage = $('#errorMessage'); //Error Message
//$filters.click(function() {
$filters1.on('ifChanged', function(event){
  $categoryContent1.hide(); // if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters1 = $filters1.filter(':checked');
  //console.log($selectedFilters);
  if ($selectedFilters1.length > 0) {
    $errorMessage.hide();
    $selectedFilters1.each(function (i, el) {
      $('ul.vacations li[data-duration="'+ el.value +'"]').show();
    });
  } else {
      $errorMessage.show();
  }
});
$('input.serch-blue').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat'
});
</script>