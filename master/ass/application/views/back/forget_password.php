<div>
    <?php
		echo form_open(base_url() . 'index.php/'.$control.'/login/forget/', array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'forget'
		));
	?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                	<?php echo translate('your_email_address');?>
                    	</label>
                <div class="col-sm-6">
                    <input type="email" name="email" id="demo-hor-1" class="form-control required" placeholder="<?php echo translate('your_email_address');?>" >
                </div>
            </div>
        </div>
	</form>
</div>

<script>
	$(document).ready(function() {
		$("form").submit(function(e){
			return false;
		});
	});
</script>