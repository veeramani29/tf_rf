<?php $this->load->view('common/header');?>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS?>css/cs-select.css" />
<!-- CONTENT -->
<div class="full witeback">
	<div class="container">
    	<h3 class="bighed">List Your Space</h3>
        <p class="mediumpara">InnoGlobe lets you make money renting out your place.</p>
    </div>
<div class="full backspace">
  <div class="container">
    <div class="full marpad">
    <div class="selrows">
    	<div class="col-md-3">
    		<label class="select-labelme">Property Name</label>
        </div>
        <div class="col-md-9">
        	<input type="text" class="biginput" />
        </div>
    </div>
    
    <div class="selrows">
            <div class="col-md-3">
            	<label class="select-labelme">Property Type</label>
            </div>
            <div class="col-md-9">
            <select class="cs-select cs-skin-underline">
					<option value="" disabled selected>Choose a Property Type</option>
					<option value="1">Apartment</option>
					<option value="2">House</option>
					<option value="3">Bed & Breakfast</option>
					<option value="4">Loft</option>
					<option value="5">Cabin</option>
			</select>
            </div>
    </div>
    
    <div class="selrows">
            <div class="col-md-3">
            	<label class="select-labelme">Occupancy</label>
            </div>
            <div class="col-md-9">
            <select class="cs-select normalsel">
					<option value="" disabled selected>Choose a Number</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5+</option>
			</select>
            </div>
    </div>
    
    <div class="selrows">
    	<div class="col-md-3">
    		<label class="select-labelme">City</label>
        </div>
        <div class="col-md-9">
        	<input type="text" class="biginput withico" placeholder="Bangalore, Karnataka, India..." />
        </div>
    </div>
    
    <div class="selrows">
    	<div class="col-md-3">&nbsp;</div>
        <div class="col-md-9">
        <button type="submit" class="continue"><strong>Continue</strong><span></span></button>
        </div>
    </div>
    
    
    
    </div>
    
  </div>
</div>
</div>
<?php $this->load->view('common/footer');?>

<script>
	$(document).ready(function(){
		$('.continue').click(function(){
			$(this).children('span').stop(true,true).animate({'width':100+'%'},1500);
		});
	});
</script>
<script src="<?php echo ASSETS;?>js/classie.js"></script>
<script src="<?php echo ASSETS;?>js/selectFx.js"></script>
<script>
			(function() {
				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx(el);
				} );
			})();



		</script>

</body>
</html>