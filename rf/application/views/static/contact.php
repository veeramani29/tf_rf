<?php $this->load->view('common/header');?>


<div class="full witeback">
	<div class="container">
        <div class="rfboxed-background">
             
               <div class="col-md-4 nopad ritpu fullaru">
                	<div class="styconct">
               			<h3 class="levacmnt">Stay connected with us</h3>
                        
                        <div class="reptcontctxc">
                        	<div class="sticon icon icon-map-marker"></div>
                        	<div class="styfull">
                            	<p class="simplcon">
                                	<?php echo $contact->address;?>
                                </p>
                            </div>
                        </div>
                        
                        <div class="reptcontctxc">
                        	<div class="sticon icon icon-phone"></div>
                        	<div class="styfull">
                            	<p class="simplcon">
                                	<?php echo $contact->contact;?>
                                </p>
                            </div>
                        </div>
                        
                        <div class="reptcontctxc">
                        	<div class="sticon icon icon-envelope"></div>
                        	<div class="styfull">
                            	<a class="simplcon"> <?php echo $contact->email;?></a>
                            </div>
                        </div>
                        
                        <div class="reptcontctxc">
                        	<div class="sticon icon icon-globe"></div>
                        	<div class="styfull">
                            	<a class="simplcon">
                                	<?php echo $contact->website;?>
                                </a>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                </div>
             
               <div class="col-md-8 nopad fullaru">
               	<div class="styconctx">
               		<h3 class="levacmnt">Leave a comment</h3>
               		<div class="reptcontct">
                    <?php if(isset($success)){ ?>
                        <div class="col-md-12">
                        <span class="success" style="color:green;"><?php echo $success;?></span>
                    </div>
                    <?php } if(isset($error)){ ?>
                        <div class="col-md-12">
                        <span class="error" style="color:red;"><?php echo $error;?></span>
                    </div>
                    <?php } ?>
                   </div>
                <form action="<?php echo WEB_URL; ?>/home/contact_us" name="contact" method="post" id="contactus">
                    <div class="reptcontct">
                    	<div class="col-md-6">
                            <div class="selectedwrap">
                            <input type="text"  placeholder="Your Name" class="flitinput" name="name" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="selectedwrap">
                            <input type="text" placeholder="Your Email Address" class="flitinput" name="email" required/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="reptcontct">
                    	<div class="col-md-12">
                            <div class="selectedwrap">
                            <input type="text" placeholder="Subject" class="flitinput" name="subject" required/>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="reptcontct">
                    	<div class="col-md-12">
                            <div class="selectedwrap">
                            <textarea class="mesageconet" placeholder="Message" name="message" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="reptcontct">
                        <div class="col-md-12">
                            <div class="col-xs-6 nopad">
                            	<div class="selectedwrap">
                                	<input id="captcha" placeholder="Captcha" name="captcha" type="text" class="flitinput" value="" required/>
                            	</div>
                            </div>
                            <div class="col-xs-6">
                            	<div class="selectedwrapcapt">
                                <input type="hidden" name="captchaimage" value="<?php echo $captcha['time']; ?>.jpg">
                                <?php echo $captcha['image']; ?>
                            	</div>
                            </div>
                            
                             
                             
                        </div>
                    </div>
                    <div class="reptcontct">
                    	<div class="col-md-12">
                            <div class="relativefmsubvb">
                                <input type="submit" class="indxsrch shadows" value="Submit" />
                            </div>
                        </div>
                    </div>
                </form>
                  </div>  
                    
                    
               </div> 
                
                

        </div>
    </div>
</div>

<div class="clear"></div>

<div class="fixcon"><div id="map-can" class="contactmap"></div></div>


<?php $this->load->view('common/footer');?>
<script src="<?php echo ASSETS;?>js/initialize-google-map-contact.js"></script>
</body>
</html>
