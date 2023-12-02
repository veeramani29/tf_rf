<?php $this->load->view('common/header');?>
<div class="container container_center">
	<div class="col-sm-8 column_center">
		<div class="full onlycontent marintopcntpage">
		<div class="centerfix">
			<div class="popuperror" style="display:none;">
			</div>
			<div  class="pophed">
				<?php echo lang_line('AL_EmailAuth'); ?>
			</div>
			<div class="signdiv">
				<form id="twitterToken" name="twitterToken" method="post">
					<div class="ritpul">
						<div class="rowput col-sm-5">
							<input type="hidden" name="email">
							<input class="form-control logpadding" type="email" name="email" placeholder="<?php echo lang_line('EMAIL_ADD'); ?>" required/>
						</div>
						<div class="clear"></div>
						<button class="submitlogin"><?php echo lang_line('Save_Con'); ?></button>
						<div class="clear"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<div class="clearfix"></div>
<?php $this->load->view('common/footer');?>