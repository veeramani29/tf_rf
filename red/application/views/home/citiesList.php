<option value="">Select a City</option>
<?php 
if($city_list != ''){
foreach($city_list as $list){ ?>
<option  value="<?php echo $list->id; ?>"  <?php echo($city_id != '' && $city_id == $list->id?'selected="selected"':''); ?>><?php echo $list->name; ?></option>
<?php } } ?>