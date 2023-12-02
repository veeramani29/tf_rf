<div class="col-md-9 minht offset-0 grybackgr">
        
        <div class="editbleside">
            <div class="sidehed">Photos</div>
            
            <div class="siderowwrap">
                <div class="siderow">
                
                <form id="myForm" action="<?php echo WEB_URL.'/listings/upload_property_photo'; ?>" method="POST" enctype="multipart/form-data">
                    <div class="col-md-4">
                        <div class="photolist">
                        	<div class="uplodproto"  id="siderowfs">
                            	<img src="<?php echo ASSETS; ?>images/nomg.jpg" />
                            </div>
                            <div class="photoallcnt">
                            	<div class="uplodphto">
                                	<span class="uplodbtn btn-search5">Upload Picture</span>
                                </div>
                            </div>
                            
                            <input type="file" name="profilePhoto" id="profilePhoto" value="upload photo" class="hideuploadphotoin" />
                            
                         </div>
                    </div>
                </form>
                
                <?php if(!empty($property_photos)) { foreach($property_photos as $key => $value) { $uniqid = uniqid(); if(!empty($value->PHOTO_CONTENT)){ ?>
                <div class="col-md-4 property_photos_search" id="<?php echo $uniqid; ?>">
                	<div class="photolist">
                    	<div class="uplodproto">
                        	<img src="data:image/png;base64,<?php echo $value->PHOTO_CONTENT; ?>" />
                            <input type="hidden" value="<?php echo $value->PHOTO_CONTENT; ?>" name="image[<?php echo $uniqid; ?>][]" id="image_<?php echo $uniqid; ?>">
                        </div>
                        <div class="photoallcnt">
                        <div class="tichek">
                        	<label class="pikphotoli">
                            	<div class="left">
                            	<input type="checkbox" class="icheckbox_flat-blue" <?php if($value->PHOTO_PANORAMIC == 1) {echo "checked=checked";} ?> name="panaromic_view[<?php echo $uniqid; ?>][]" id="panaromic_<?php echo $uniqid; ?>">
                                </div>
                                <span class="chkboxphoto">Panoramic view</span>
                            </label>
                        </div>
                        
                        <div class="rowuplist">
                        	<label class="pikphotoli">Name</label>
                            <input type="text" value="<?php echo $value->PHOTO_NAME; ?>" id="image_name_<?php echo $uniqid; ?>" class="form-control inputphoto" placeholder="Name" name="name[<?php echo $uniqid; ?>][]">
                        </div>
                        
                        <div class="rowuplist">
                        	<label class="pikphotoli">Comment</label>
                            <textarea  class="form-control txtaraphoto" placeholder="Comment" name="comment[<?php echo $uniqid; ?>][]" id="image_comment_<?php echo $uniqid; ?>"><?php echo $value->PHOTO_COMMENTS; ?></textarea>
                        </div>
                        </div>
                     <a href="javascript:void(0)" onclick="delete_photo('<?php echo $uniqid; ?>')" title="Delete Photo" data-placement="top" class="removephoto">
                     <i class="icon-remove"></i>
                     </a>   
                    </div>
                </div>
				
					
					<?php } } } ?>

                    <input type="hidden" name="edit_listings_photos" id="edit_listings_photos" value="<?php echo $listings->PROPERTY_ID; ?>" />
                    
                    
					<div class="p_photo"></div>			
					<!-- <a id="property_photo"><img src="<?php echo WEB_URL; ?>/assets/images/upload.jpg" style="padding-top: 26px;"/></a>		 -->
					
					<!--<form id="myForm" action="<?php echo WEB_URL.'/listings/upload_property_photo'; ?>" method="POST" enctype="multipart/form-data" style="clear: both;float: right;font-size: 15px;padding-top: 10px;">
					<div style="position: relative; width: 100px; overflow: hidden; height: 20px;clear: both;">
						<input style="cursor: pointer; position: absolute; z-index: 9999; opacity: 0" type="file" name="profilePhoto" id="profilePhoto" value="upload photo">
						<p class="lblue" style="" >Upload Picture</p>
					</div>  
					</form>	-->							
					

                    <div class="clear"></div>
                    
                    <div class="siderow  margtop10">
                        <div class="col-md-12">
                            <button type="submit" class="carbook" id="property_photo_submit">Submit</button>
                        </div>
                    </div>
                    
                    
				
					<a data-original-title="Test Email" href="#" data-testemail="14" class="new_tooltips marginR10 photos_loading_saving_open" data-popup-ordinal="0" style="display:none;"></a>
					
					<div class="savingpopup">
                        <div class="backfaded"></div>
                        <div class="alertpopup">
                           <img src="<?php echo ASSETS; ?>images/Preloader.gif" class="test_email_loader">
                           <h3 style="text-align:center;">Saving</h3>
                        </div>
                    </div>
					
				</div>
			</div> 
		  </div> 
	</div>	  
    <div class="col-md-3 minht witebackgrnd">
        <div class="padhelp">
            <div class="helpico icon icon-lightbulb"></div>
            <div class="helppara">
                <h4 class="helphed">Photos</h4>
                <p>
					Upload Apartment Photos
                </p>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    $('#photos_loading_saving').popup();
});    
</script>

<script src="<?php echo ASSETS; ?>js/jquery.uploadfile.min.js"></script>
<script type="text/javascript">
/*$("#property_photo").uploadFile({
	url: WEB_URL+"/listings/upload_property_photo",
	fileName: "myfile",
	allowedTypes: "png,gif,jpg,jpeg",
	onSuccess: function(files, data, xhr) 	{
			$(data).insertAfter(".p_photo");
	},
});*/
</script>

<script type="text/javascript">
    /*$(document).ready(function() { 
        $('#profilePhoto').on('change', function() {
            $('.imgLoader').fadeIn();
            $("#myForm").ajaxForm({
                dataType: 'json',
                success: function(r) {
                    $('.fstusrp').html('<img src="'+r.img+'">');
                    $('.profileusrs').html('<img src="'+r.img+'">');
                    $('.imgLoader').fadeOut();

                }
            }).submit();
        })
    });*/ 
</script>

<style>
.ajax-upload-dragdrop{
	width:100% !important;
}
.ajax-file-upload{
	float:right;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {	 
        $('#profilePhoto').on('change', function() {
            $('.imgLoader').fadeIn();
            $("#myForm").ajaxForm({
                dataType: 'json',
                beforeSend: function() {
                   $("#siderowfs").html('<div class="lodrefrentrev" style="display: block;"><div class="centerload" style="top:25% !important;"></div></div>');
                },
                success: function(r) {                    
                    $(r.result).insertAfter(".p_photo");
					 $("#siderowfs").html('<img src="<?php echo ASSETS; ?>images/nomg.jpg">');
                }
            }).submit();
        })
    }); 
</script>
