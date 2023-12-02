<?php for ($j = 0; $j < $child_count; $j++){ ?>
<div class="col-md-4" style="padding-left:0px">
    <div class="form-group">
        <label>Age<?php echo ($j+1); ?></label>
        <select class="form-control" name="child_age[<?php echo $room_id; ?>][]">
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
<?php } ?>
