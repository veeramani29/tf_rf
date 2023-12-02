<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS ?>css/cs-select.css" />
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

<!-- CONTENT -->
<div class="full witeback">
    <div class="container">
        <h3 class="bighed">List Your Space</h3>
        <p class="mediumpara">InnoGlobe lets you make money renting out your place.</p>
    </div>
    <div class="full backspace">
        <div class="container">
			<form name="listings" id="listings" action="<?php echo WEB_URL; ?>/listings/insert_new_listings" method="post">
            <div class="full marpad">
                <div class="selrows">
                    <div class="col-md-3">
                        <label class="select-labelme">Property Name</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="biginput" placeholder="Property Name" name="property_name" required="required"/>
                    </div>
                </div>

                <div class="selrows">
                    <div class="col-md-3">
                        <label class="select-labelme">Property Type</label>
                    </div>
                    <div class="col-md-9">
                        <select class="cs-select cs-skin-underline" name="property_type" required>
                            <option value="" disabled selected>Choose a Property Type</option>
                            <?php
                            if (!empty($property_types)) {
                                foreach ($property_types as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value->PROP_TYPE_ID; ?>"><?php echo $value->PROP_TYPE_LABEL; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="selrows">
                    <div class="col-md-3">
                        <label class="select-labelme">Occupancy</label>
                    </div>
                    <div class="col-md-9">
                        <select class="cs-select normalsel" name="occupancy" required>
                            <option value="">Choose a Number</option>
                            <?php for ($i = 1; $i <= 30; $i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="selrows">
                    <div class="col-md-3">
                        <label class="select-labelme">City</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" name="listings_city" required="required" id="autocomplete" class="biginput withico" placeholder="Eg : Dubai, United Arab Emirates" onkeypress="return dontSubmit(event);" />
                        <input type="hidden" id="street_number" name="street_number"></input>
						<input type="hidden" id="route" name="route"></input>
						<input type="hidden" id="locality" name="city"></input>
						<input type="hidden" id="administrative_area_level_1" name="state"></input>
						<input type="hidden" id="postal_code" name="zip"></input>
						<input type="hidden" id="country" name="country"></input>
						<input type="hidden" id="latitude" name="latitude"></input>
						<input type="hidden" id="longitude" name="longitude"></input>
                    </div>
                </div>

                <div class="selrows">
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-9">
                        <button type="submit" class="continue"><strong>Continue</strong><span></span></button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('common/footer'); ?>

<script>
    $(document).ready(function() {
        $('.continue').click(function() {
            $(this).children('span').stop(true, true).animate({'width': 100 + '%'}, 1500);
        });
        
        initialize();
    });
</script>
<script src="<?php echo ASSETS; ?>js/classie.js"></script>
<script src="<?php echo ASSETS; ?>js/selectFx.js"></script>
<script>
    (function() {
        [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function(el) {
            new SelectFx(el);
        });
    })();
</script>

</body>
</html>
