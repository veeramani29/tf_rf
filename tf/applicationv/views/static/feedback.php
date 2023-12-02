<?php $this->load->view('common/header');?>


<div class="full witeback">
	<div class="container">
        <div class="container offset-0 padonlytop">
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
               <div class="col-md-6 nopad fullaru">
               	  
                    <div class="styconctxno">
               			<h3 class="levacmntfst">Got a Problem?</h3>
                        
                        <div class="reptcontctxc">
                        	<div class="sticoncv icon icon-question"></div>
                        	<div class="styfull">
                            	<p class="simplconxl">
                                	For buying assistance or any other order related query, kindly get in touch with our support team. 
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    
               </div>
               
               
               <div class="col-md-6 nopad fullaru">
               		
                    <div class="styconctys padred">
               		<h3 class="levacmnt">Tell us what you think.</h3>
                    
                    <div class="lovpara">Love us / have suggestions / ideas / feature requests? Tell us how we can improve our website.</div>
               		
                <form action="<?php echo WEB_URL; ?>/home/feed_back" name="feedback" method="post" id="feedback">
                    <div class="reptcontct">
                    	<div class="col-md-6">
                            <div class="selectedwrap">
                            <input type="text"  placeholder="Your Name" class="flitinput" name="name" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="selectedwrap">
                            <input type="email" placeholder="Your Email Address" class="flitinput" name="email" required />
                            </div>
                        </div>
                    </div>
                    
                    <div class="reptcontct">
                    	<div class="col-md-12">
                        
                            <div class="posrel myselect myselectcv">
                                <select class="mySelectBoxClass clasfeed"  name="type" required>
                                    <option value="">Select Category</option>
                                    <option value="Improve this page">Improve this page</option>
                                    <option value="Suggest new features/Ideas">Suggest new features/Ideas</option>
                                </select>
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
                            <div class="relativefmsubvb">
                                <input type="submit" class="indxsrch shadows" value="Send" />
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




<?php $this->load->view('common/footer');?>

</body>
</html>
