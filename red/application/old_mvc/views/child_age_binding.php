<?php
for ($j = 0; $j < $child_count; $j++) 
{
?>
<div class="col-md-1" style="padding-left:0px;">
    <div class="form-group">
        <label>Age</label> 
        <select class="form-control" name="child_age[<?php echo $room_id; ?>][]" style="padding:0px;">
            <option value="1" selected="selected">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="1">4</option>
            <option value="2">5</option>
            <option value="3">6</option>
            <option value="1">7</option>
            <option value="2">8</option>
            <option value="3">9</option>
            <option value="3">10</option>
        </select>
    </div>
</div>
<?php  
}
?>
