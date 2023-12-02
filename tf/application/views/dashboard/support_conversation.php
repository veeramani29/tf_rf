<?php $this->load->view('common/header'); ?>

<div class="full marintopcnt onlycontent">
    <div class="container fordetailpage">
        <div class="container paymentpage">
            
            
            <div class="col-md-3">
        <ul class="sideul">
            <li class="sidepro active"><a href="#mangelisting" data-toggle="tab" id="inbox"><?=lang('Inbox');?></a></li>
            <li class="sidepro"><a href="#ureservations" data-toggle="tab" id="sent"><?=lang('Sent Tickets');?></a></li>
            <li class="sidepro"><a href="#resrvationreq" data-toggle="tab" id="closed"><?=lang('Closed Tickets');?></a></li>
            <li class="sidepro"><a class="adnewtikt" href="#addticket" data-toggle="tab"><i class="icon-ticket"></i><?=lang('Add New Tickets');?></a></li>
        </ul>
    </div>

    <div class="col-md-9">
        <div class="tab-content5">
            <br>
            <div class="tab-pane active" id="mangelisting">
                 <div id="inbticktLdr" class="lodrefrentrev imgLoader" style="display: none;">
                    <div class="centerload1"></div>
                </div>
                <span class="size16 padtabnenopad bold">
                        <span class="tickthed"><?=lang('Inbox');?></span>
                        <input type="text" id="inboxsearchTickets" class="searchtickt" placeholder="<?=lang('SC_Search');?>" />
                </span>
                <div class="withedrow">
                    <div class="rowit chngecolr">
            <ul id="inboxTickets">
            <?php 
            if($support_pending!=''){
            for($i=0;$i<count($support_pending);$i++)
            {
            $user_details = $this->Support_Model->get_user_details($support_pending[$i]->user_type,$support_pending[$i]->user_id);
            $user_type = $this->Support_Model->get_usertype_details($support_pending[$i]->user_type);
            $domain = $this->Support_Model->get_domain_details($support_pending[$i]->domain);
            ?>
            <li class="searchCount inbx" id="totalLI<?php echo $support_pending[$i]->support_ticket_id; ?>">
                       <div class="fulrowtikt searchSupport" >
                           <div class="showOrHide" data-ticket="<?php echo $support_pending[$i]->support_ticket_id; ?>" data-time="<?php echo date('M j,Y',strtotime($support_pending[$i]->created_time)); ?>" data-subject="<?php echo substr($support_pending[$i]->subject,0,100); ?>" data-reply="<?php echo $support_pending[$i]->last_updated_by; ?>"> 
               <div class="topsectickt">
                                <span class="ticktid"><?=lang('Ticket ID');?> : <?php echo $support_pending[$i]->support_ticket_id; ?> 
                                <?php
								if($support_pending[$i]->file_path!='')
								{
									?>
                                <i class="icon-paper-clip"></i>
                                <?php
								}
								?></span>
                                <span class="tiktdate"><?php echo date('M j,Y',strtotime($support_pending[$i]->created_time)); ?></span>
                            </div>
                            <div class="tiktcntnt">
                                <div class="col-md-8">
                                    <div class="ticktername"><?php echo $user_details->email; ?></div>
                                    
                                    <div class="likrtickt">
                                        <div class="collabl"><?=lang('Subject');?></div>
                                        <div class="coltcnt"><?php echo substr($support_pending[$i]->subject,0,100); ?></div>
                                    </div>
                                    
                                    <div class="likrtickt">
                                        <div class="collabl"><?=lang('Replied By');?></div>
                                        <div class="coltcnt"><?php echo $support_pending[$i]->last_updated_by; ?></div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="ticketactn">
                                        <a class="viewtickt viewTicket" id="<?php echo $support_pending[$i]->id; ?>" href="#viewticketss<?php echo $support_pending[$i]->id; ?>" data-toggle="tab"><?=lang('View Ticket');?></a>
                                        <a class="closetickt" href="javascript:void(0)" ticketid="<?php echo $support_pending[$i]->support_ticket_id; ?>" tickettype="inboxTickets"><?=lang('Close Ticket');?></a>
                                    </div>
                                </div>
                            </div>
               </div>
                       </div>
            </li>
            <?php
              }
            }
             else{?>
            <li class="searchCount">
            <div class="fulrowtikt">
                <div class="tiktcntnt">
                    <div class="col-md-8">
                        <div class="srywrap">
                            <span class="sorrydiv">
                                <img src="<?php echo base_url(); ?>assets/images/sorry.png" alt="">
                            </span>
                            <b><?=lang('Nothing here');?></b>
                        </div>
                    </div>
                </div>
            </div>
            </li>
            <?php } ?>
            </ul>
            <div class="holdere"></div>
                    </div>
                </div>
            </div> 
            <div class="tab-pane" id="ureservations">
                 <div id="sentticktLdr" class="lodrefrentrev imgLoader" style="display: none;">
                    <div class="centerload1"></div>
                </div>
                <span class="size16 padtabnenopad bold">
                    <span class="tickthed"><?=lang('Sent Tickets');?></span>
                        <input type="text" id="sentsearchTickets" class="searchtickt" placeholder="<?=lang('SC_Search');?>" />
                </span>
                <div class="withedrow">
                    <div class="rowit chngecolr">
            <ul id="sentTickets">
            <?php 
              if($support_sent!=''){
            for($i=0;$i<count($support_sent);$i++){
                $user_details = $this->Support_Model->get_user_details($support_sent[$i]->user_type,$support_sent[$i]->user_id);
                $user_type = $this->Support_Model->get_usertype_details($support_sent[$i]->user_type);
                $domain = $this->Support_Model->get_domain_details($support_sent[$i]->domain);
                ?>
            <li class="searchCount sents" id="totalLI<?php echo $support_sent[$i]->support_ticket_id; ?>">
                       <div class="fulrowtikt searchSupport" >
                            <div class="showOrHide" data-ticket="<?php echo $support_sent[$i]->support_ticket_id; ?>" data-time="<?php echo date('M j,Y',strtotime($support_sent[$i]->created_time)); ?>" data-subject="<?php echo substr($support_sent[$i]->subject,0,100); ?>" data-reply="<?php echo $support_sent[$i]->last_updated_by; ?>"> 
               <div class="topsectickt">
                                <span class="ticktid"><?=lang('Ticket ID');?> : <?php echo $support_sent[$i]->support_ticket_id; ?> 
                                <?php
								if($support_sent[$i]->file_path!='')
								{
									?>
                                <i class="icon-paper-clip"></i>
                                <?php
								}
								?></span>
                                <span class="tiktdate"><?php echo date('M j,Y',strtotime($support_sent[$i]->created_time)); ?></span>
                            </div>
                            <div class="tiktcntnt">
                                <div class="col-md-8">
                                    <div class="ticktername"><?php echo $user_details->email; ?></div>
                                    
                                    <div class="likrtickt">
                                        <div class="collabl"><?=lang('Subject');?></div>
                                        <div class="coltcnt"><?php echo substr($support_sent[$i]->subject,0,100); ?></div>
                                    </div>
                                    
                                    <div class="likrtickt">
                                        <div class="collabl"><?=lang('Replied By');?></div>
                                        <div class="coltcnt"><?php echo $support_sent[$i]->last_updated_by; ?></div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="ticketactn">
                                        <a class="viewtickt viewTicket" id="<?php echo $support_sent[$i]->id; ?>" href="#viewticketss<?php echo $support_sent[$i]->id; ?>" data-toggle="tab"><?=lang('View Ticket');?></a>
                                        <a class="closetickt"  id="closeticket<?php echo $support_sent[$i]->support_ticket_id; ?>" href="javascript:void(0)" ticketid="<?php echo $support_sent[$i]->support_ticket_id; ?>" tickettype="sentTickets"><?=lang('Close Ticket');?></a>
                                    </div> 
                                </div>
                            </div>
            </div>
                       </div>
            </li>
            <?php }}  else{?>
            <li class="searchCount">
            <div class="fulrowtikt">
                <div class="tiktcntnt">
                    <div class="col-md-8">
                        <div class="srywrap">
                            <span class="sorrydiv">
                                <img src="<?php echo base_url(); ?>assets/images/sorry.png" alt="">
                            </span>
                            <b><?=lang('Nothing here');?></b>
                        </div>
                    </div>
                </div>
            </div>
            </li>
            <?php } ?>
            </ul>
            <div class="holdere"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="resrvationreq">
                <div id="clsticktLdr" class="lodrefrentrev imgLoader" style="display: none;">
                    <div class="centerload1"></div>
                </div>
                <span class="size16 padtabnenopad bold">
                    <span class="tickthed"><?=lang('Closed Tickets');?></span>
                    <input type="text" id="closedsearchTickets" class="searchtickt" placeholder="<?=lang('SC_Search');?>" />
                </span>
                <div class="withedrow">
                    <div class="rowit chngecolr">
            <ul id="closedTickets">
            <?php if($support_close!=''){
            for($i=0;$i<count($support_close);$i++)
            {
                $user_details = $this->Support_Model->get_user_details($support_close[$i]->user_type,$support_close[$i]->user_id);
                $user_type = $this->Support_Model->get_usertype_details($support_close[$i]->user_type);
                $domain = $this->Support_Model->get_domain_details($support_close[$i]->domain);
                ?>
            <li class="searchCount closet" id="totalLI<?php echo $support_close[$i]->support_ticket_id; ?>">
                       <div class="fulrowtikt searchSupport">
                         <div class="showOrHide"  data-ticket="<?php echo $support_close[$i]->support_ticket_id; ?>" data-time="<?php echo date('M j,Y',strtotime($support_close[$i]->created_time)); ?>" data-subject="<?php echo substr($support_close[$i]->subject,0,100); ?>" data-reply="<?php echo $support_close[$i]->last_updated_by; ?>">
                <div class="topsectickt">
                                 <span class="ticktid"><?=lang('Ticket ID');?> : <?php echo $support_close[$i]->support_ticket_id; ?> 
                                <?php
								if($support_close[$i]->file_path!='')
								{
									?>
                                <i class="icon-paper-clip"></i>
                                <?php
								}
								?></span>
                                <span class="tiktdate"><?php echo date('M j,Y',strtotime($support_close[$i]->created_time)); ?></span>
                            </div>
                            <div class="tiktcntnt">
                                <div class="col-md-8">
                                    <div class="ticktername"><?php echo $user_details->email; ?></div>
                                    
                                    <div class="likrtickt">
                                        <div class="collabl"><?=lang('Subject');?></div>
                                        <div class="coltcnt"><?php echo substr($support_close[$i]->subject,0,100); ?></div>
                                    </div>
                                    
                                    <div class="likrtickt">
                                        <div class="collabl"><?=lang('Replied By');?></div>
                                        <div class="coltcnt"><?php echo $support_close[$i]->last_updated_by; ?></div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="ticketactn">
                                        <a class="viewtickt viewTicket" id="<?php echo $support_close[$i]->id; ?>" href="#viewticketss<?php echo $support_close[$i]->id; ?>" data-toggle="tab"><?=lang('View Ticket');?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                       </div>
            </li>
            <?php }} else{?>
            <li class="searchCount">
            <div class="fulrowtikt">
                <div class="tiktcntnt">
                    <div class="col-md-8">
                        <div class="srywrap">
                            <span class="sorrydiv">
                                <img src="<?php echo base_url(); ?>assets/images/sorry.png" alt="">
                            </span>
                            <b><?=lang('Nothing here');?></b>
                        </div>
                    </div>
                </div>
            </div>
            </li>
            <?php } ?>
                      </ul>
            <div class="holdere"></div>
                    </div>
                </div>
            </div> 
            
            
            <div class="tab-pane" id="addticket">
                <div id="addticktLdr" class="lodrefrentrev imgLoader" style="display: none;">
                    <div class="centerload1"></div>
                </div>
                <span class="size16 padtabnenopad bold">
                    <span class="tickthed"><?=lang('Add Tickets');?></span>
                </span>
                <div class="withedrow">
                    <div class="rowit chngecolr">
                      <div class="addtiktble">
                     <form action="<?php echo base_url(); ?>dashboard/add_new_ticket" method="post"  enctype="multipart/form-data" class='validate form-horizontal' id="addNewTicket123">   
                        <input type="hidden" value="<?php echo base_url(); ?>dashboard" id="thisController">                      
                        <div class="likrticktsec">
                            <div class="cobldo"><?=lang('Add Tickets');?></div>
                            <div class="coltcnt">
                                <select class="payinselect mySelectBoxClassfortab hasCustomSelect" name="subject" required>
                                    <?php for($i=0;$i<count($support_ticket_subject);$i++){ ?>
                                        <option value="<?php echo $support_ticket_subject[$i]->support_ticket_subject_value; ?>"><?php echo $support_ticket_subject[$i]->support_ticket_subject_value; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="likrticktsec">
                            <div class="cobldo"><?=lang('Attachment');?></div>
                            <div class="coltcnt">

                                <input type="file" name="file_name" class="payinput" id="attach_file"> 
                            </div>
                        </div>
                        
                        <div class="likrticktsec">
                            <div class="cobldo"><?=lang('Message');?></div>
                            <div class="coltcnt">
                                <textarea class="tikttext" name="message" id="message" required></textarea>
                            </div>
                        </div>
                        
                        <div class="likrticktsec">
                            <div class="cobldo">&nbsp;</div>
                            <div class="coltcnt">
                            <input type="submit" class="adddtickt" value="<?=lang('Add Ticket');?>">
                            </div>
                        </div>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="tab-pane showTickets">

                <span class="size16 padtabnenopad bold">
                    <span class="tickthed"><?=lang('View Tickets');?></span>
                </span>
                 <div id="viewticktLdr" class="lodrefrentrev imgLoader" style="display: none;">
                            <div class="centerload1"></div>
                </div>
                <div class="withedrow">
                    <div class="rowit chngecolr">
                      <div class="addtiktble" id="viewTickets">
                       
                        
                        
                      </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>
    </div>
            
            
        </div>
    </div>
</div>   

<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
    $(document).ready(function () {

        var nothinghr='<li class="searchCount extra" style="display: list-item; opacity: 1;"><div class="fulrowtikt"><div class="tiktcntnt"><div class="col-md-8"><div class="srywrap"><span class="sorrydiv"><img src="http://192.168.0.43/ticketfinder/assets/images/sorry.png" alt=""></span><b>Nothing here</b></div></div></div></div></li';

            tickets("inboxTickets","2");
        $(document).on("click","#sent",function(){
            /*$("#sentticktLdr").show();
             setTimeout(function() { $("#sentticktLdr").hide() }, 3000);*/
            $('#sentTickets').children().removeClass("jp-hidden");
            $('#sentTickets').children().addClass("flipInX");
           
            if($('ul#sentTickets li.sents').length==0){
            $('ul#sentTickets').html(nothinghr);
            }else{
            $('ul li.extra').remove();
            }
            tickets("sentTickets","2");
        });
        $(document).on("click","#closed",function(){
             /*$("#clsticktLdr").show();
             setTimeout(function() { $("#clsticktLdr").hide() }, 3000);*/
            $('#closedTickets').children().removeClass("jp-hidden");
            $('#closedTickets').children().addClass("flipInX");
            if($('ul#closedTickets li.closet').length==0){
            $('ul#closedTickets').html(nothinghr);
            }else{
            $('ul li.extra').remove();
            }
            tickets("closedTickets","2");
        });
        $(document).on("click","#inbox",function(){
             /*$("#inbticktLdr").show();
             setTimeout(function() { $("#inbticktLdr").hide() }, 3000);*/
            $('#inboxTickets').children().removeClass("jp-hidden");
            $('#inboxTickets').children().addClass("flipInX");
 			if($('ul#inboxTickets li.inbx').length==0){
            	$('ul#inboxTickets').html(nothinghr);
            }else{
            	$('ul li.extra').remove();
            }

            tickets("inboxTickets","2");
        });
        
        $(document).on("click",".closetickt",function(){
            var ticketid = $(this).attr('ticketid');
            var tickettype = $(this).attr('tickettype');

            if(ticketid){
            $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>dashboard/close_ticket/"+ticketid,
                    data: '',
                    dataType: "json",
                    beforeSend: function(){
                    	$("#clsticktLdr").show();
                    },
                    success: function(data){
                        if(data.status==1)
                        {
                    		$("#clsticktLdr").hide();
                            $("#closeticket"+ticketid).remove();
                            $("#totalLI"+ticketid).clone().appendTo("#closedTickets");
                            $("#totalLI"+ticketid).remove();
                            $( "#closed" ).trigger( "click" );
                            //tickets(tickettype,"2");
                        }
                    }
                });
                return false;
            }else{
                return false;
            }
        });
        
        
    });


function tickets(id,count) {
  if(count>2){
  	count = Math.ceil(parseInt(count)/5);
  }else{
	count = 5;
  }
    $("div.holdere").proPages({
        containerID: id,
        perPage: count,
        keyBrowse: true,
        scrollBrowse: false,
        callback: function (pages,
        items) {
                $("#legend1").html("Page " + pages.current + " of " + pages.count);
                $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
            }
        });
}

function createPagination() {}
function createListingPagination() {}
function createReservationHistoryPagination() {}
function BookingPagination() {}
function createRvwPagination() {}
function createRefByYouPagination() {}

</script>