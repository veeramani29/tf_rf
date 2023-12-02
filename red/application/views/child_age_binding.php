<?php
for ($j = 0; $j < $child_count; $j++) {
    ?>
    <div class="wh33percent">
    	<div class="wh90percent textleft right">
		<span class="opensans size13">Age</span>
		<select class="form-control mySelectBoxClass" name="child_age[<?php echo $room_id; ?>][]">
			<option value="1" selected="selected">1</option>
	                <option value="2">2</option>
	                <option value="3">3</option>
	                <option value="4">4</option>
	                <option value="5">5</option>
	                <option value="6">6</option>
	                <option value="7">7</option>
	                <option value="8">8</option>
	                <option value="9">9</option>
	                <option value="10">10</option>
		</select>
	</div>
    </div>
    <?php
}
?>
