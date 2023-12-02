<?php $this->load->view('common/header');?>

<div class="full onlycontent marintopcntpage">
<div class="container martopbtm">


<div class="seconfirm">
	<button type="button" class="veryfybtn" data-toggle="collapse" data-target="#collapse2step">
		2-Step Verification <span class="collapsearrow"></span>
	</button>
						
    <div id="collapse2step" class="collapse in">
        <div class="colsppad">
        	<div class="col-md-6">
            	<div class="colcentrtbl">
                <div class="ajaxtime"></div>
                	<div class="stndrdimg">
                    	<img src="<?php echo ASSETS;?>images/phonevery.png" alt="" />
                    </div>
                    <h4 class="wichvery">Phone Verification</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor aliquam felis, sit amet tempus nibh ullamcorper nec.</p>
                    <div class="clickblebtn ssactive btnvery2"></div>
                </div>
            </div>
            <div class="col-md-6">
            	<div class="colcentrtbl">
                <div class="ajaxtime"></div>
                	<div class="stndrdimg">
                    	<img src="<?php echo ASSETS;?>images/eml.png" alt="" />
                    </div>
                    <h4 class="wichvery">Email Verification</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor aliquam felis, sit amet tempus nibh ullamcorper nec.</p>
                    <div class="clickblebtn btnvery2"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="seconfirm">
	<button type="button" class="veryfybtn" data-toggle="collapse" data-target="#collapseqstion">
		Security Question and Answers <span class="collapsearrow"></span>
	</button>
						
    <div id="collapseqstion" class="collapse in">
        <div class="colsppad">
        	<div class="col-md-12">
            	<div class="colcentrtbl">
                <div class="ajaxtime"></div>
                	<div class="stndrdimg">
                    	<img src="<?php echo ASSETS;?>images/cnfirmsec.png" alt="" />
                    </div>
                    <h4 class="wichvery">Security questions and answers</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor aliquam felis, sit amet tempus nibh ullamcorper nec.</p>
                    <div class="clickblebtn ssactive btnveryqstn"></div>
                </div>
            </div>
            
        </div>
    </div>
</div>





</div>
</div>


<div class="clearfix"></div>

<?php $this->load->view('common/footer');?>

<script type="text/javascript">
	$(document).ready(function(){
		$('.btnvery2').click(function(){
				if($(this).hasClass('ssactive'))
				{
					return;
				}
				$('.btnvery2').removeClass('ssactive');
				$(this).siblings('.ajaxtime').fadeIn(200,function(){
					setTimeout(function(){
						
						$('.ajaxtime').fadeOut(200);
						
					},2000);
					
				});
				$(this).addClass('ssactive');
				

		});
		
		$('.btnveryqstn').click(function(){
				$(this).siblings('.ajaxtime').fadeIn(200,function(){
					setTimeout(function(){
						
						$('.ajaxtime').fadeOut(200);
						
					},2000);
					
				});
				$(this).toggleClass('ssactive');
		});
		
	});
</script>

</body>
</html>