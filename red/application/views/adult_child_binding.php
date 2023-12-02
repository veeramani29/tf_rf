<?php 
for($i=0;$i<$room_count;$i++)
{
    /*if($i>0)
    {
        echo '<div class="col-sms-6 col-sm-6 col-md-3">&nbsp;</div>';
    }*/
?>
    <div class="col-sms-6 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Adult</label> 
                <select class="form-control" name="adult[]">
                    <option value="1" selected="selected">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
        </div>
        <div class="col-sms-6 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Child</label>
                <select class="form-control" name="child[]" onChange="show_child_age_info(this.value, <?php echo $i; ?>)"  required>
                    <option value="0" selected="selected">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>
        <div id="child_age<?php echo $i; ?>">
            
        </div> 
        <div style="clear:both;"></div>
<?php
    }

?>



