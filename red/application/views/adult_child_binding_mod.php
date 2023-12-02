<?php for ($i = 0; $i < $room_count; $i++) { ?>
    <div class="col-md-12" style="padding: 4px;border: 1px solid #f5f5f5;margin-bottom: 10px;">
        <p style="text-align:center;">Room<?php echo ($i+1); ?></p>
        <div class="col-md-6" style="padding-left:0px;" >
            <div class="form-group">
                <label>Adults</label>
                <select class="form-control" name="adult[]">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
        </div>
        <div class="col-md-6" style="padding-left:0px;" >
            <div class="form-group">
                <label>Child</label>
                <select class="form-control" name="child[]" onChange="show_child_age_info_mod(this.value, <?php echo $i; ?>)"  required>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>
        <div id="child_age<?php echo $i; ?>">

        </div> 
    </div>
<?php } ?>



