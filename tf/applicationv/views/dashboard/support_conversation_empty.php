<?php $this->load->view('common/header'); ?>

<div class="full marintopcnt onlycontent">
    <div class="container fordetailpage">
        <div class="container paymentpage">
        	
            
            <div class="col-md-3">
        <ul class="sideul">
            <li class="sidepro active"><a href="#mangelisting" data-toggle="tab" id="inbox">Inbox</a></li>
            <li class="sidepro"><a href="#ureservations" data-toggle="tab" id="sent">Sent Tickets</a></li>
            <li class="sidepro"><a href="#resrvationreq" data-toggle="tab" id="closed">Closed Tickets</a></li>
            <li class="sidepro"><a class="adnewtikt" href="#addticket" data-toggle="tab"><i class="icon-ticket"></i>Add New Tickets</a></li>
        </ul>
    </div>

    <div class="col-md-9">
        <div class="tab-content5">
            <br>
            <div class="tab-pane active" id="mangelisting">
                <span class="size16 padtabnenopad bold">
                		<span class="tickthed">Inbox</span>
                    	<input type="text"  class="searchtickt" placeholder="Search..." />
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
			<li>
                       <div class="fulrowtikt searchSupport" >
                       	   <div class="showOrHide" data-ticket="<?php echo $support_pending[$i]->support_ticket_id; ?>" data-time="<?php echo date('M j,Y',strtotime($support_pending[$i]->created_time)); ?>" data-subject="<?php echo substr($support_pending[$i]->subject,0,100); ?>" data-reply="<?php echo $support_pending[$i]->last_updated_by; ?>"> 
			   <div class="topsectickt">
                            	<span class="ticktid">Ticket ID: <strong><?php echo $support_pending[$i]->support_ticket_id; ?></strong></span>
                                <span class="tiktdate"><?php echo date('M j,Y',strtotime($support_pending[$i]->created_time)); ?></span>
                            </div>
                            <div class="tiktcntnt">
                            	<div class="col-md-8">
                                	<div class="ticktername"><?php echo $user_details->email; ?></div>
                                    
                                	<div class="likrtickt">
                                    	<div class="collabl">Subject</div>
                                        <div class="coltcnt"><?php echo substr($support_pending[$i]->subject,0,100); ?></div>
                                    </div>
                                    
                                    <div class="likrtickt">
                                    	<div class="collabl">Replied By</div>
                                        <div class="coltcnt"><?php echo $support_pending[$i]->last_updated_by; ?></div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                	<div class="ticketactn">
                                    	<a class="viewtickt viewTicket" id="<?php echo $support_pending[$i]->id; ?>" href="#viewticketss<?php echo $support_pending[$i]->id; ?>" data-toggle="tab">View Ticket</a>
                                        <a class="closetickt" href="<?php echo base_url(); ?>dashboard/close_ticket/<?php echo $support_pending[$i]->support_ticket_id; ?>">Close Ticket</a>
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
			<li>
			<div class="fulrowtikt">
				<div class="tiktcntnt">
                            		<div class="col-md-8">No messages in inbox</div>
				</div>
			</div>
			</li>
			<?php } ?>
			</ul>
			<div class="holder"></div>
                    </div>
                </div>
            </div> 
            <div class="tab-pane" id="ureservations">
                <span class="size16 padtabnenopad bold">
                	<span class="tickthed">Sent Tickets</span>
                    	<input type="text" class="searchtickt" placeholder="Search..." />
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
			<li>
                       <div class="fulrowtikt searchSupport" >
                       	    <div class="showOrHide" data-ticket="<?php echo $support_sent[$i]->support_ticket_id; ?>" data-time="<?php echo date('M j,Y',strtotime($support_sent[$i]->created_time)); ?>" data-subject="<?php echo substr($support_sent[$i]->subject,0,100); ?>" data-reply="<?php echo $support_sent[$i]->last_updated_by; ?>"> 
			   <div class="topsectickt">
                            	<span class="ticktid">Ticket ID: <strong><?php echo $support_sent[$i]->support_ticket_id; ?></strong></span>
                                <span class="tiktdate"><?php echo date('M j,Y',strtotime($support_sent[$i]->created_time)); ?></span>
                            </div>
                            <div class="tiktcntnt">
                            	<div class="col-md-8">
                                	<div class="ticktername"><?php echo $user_details->email; ?></div>
                                    
                                	<div class="likrtickt">
                                    	<div class="collabl">Subject</div>
                                        <div class="coltcnt"><?php echo substr($support_sent[$i]->subject,0,100); ?></div>
                                    </div>
                                    
                                    <div class="likrtickt">
                                    	<div class="collabl">Replied By</div>
                                        <div class="coltcnt"><?php echo $support_sent[$i]->last_updated_by; ?></div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                	<div class="ticketactn">
                                    	<a class="viewtickt viewTicket" id="<?php echo $support_sent[$i]->id; ?>" href="#viewticketss<?php echo $support_sent[$i]->id; ?>" data-toggle="tab">View Ticket</a>
                                        <a class="closetickt"  href="<?php echo base_url(); ?>dashboard/close_ticket/<?php echo $support_sent[$i]->support_ticket_id; ?>">Close Ticket</a>
                                    </div>
                                </div>
                            </div>
			</div>
                       </div>
			</li>
			<?php }}  else{?>
			<li>
			<div class="fulrowtikt">
				<div class="tiktcntnt">
                            		<div class="col-md-8">No Sent tickets found</div>
				</div>
			</div>
			</li>
			<?php } ?>
			</ul>
			<div class="holder"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="resrvationreq">
                <span class="size16 padtabnenopad bold">
                	<span class="tickthed">Clossed Tickets</span>
                    <input type="text" class="searchtickt" placeholder="Search..." />
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
			<li>
                       <div class="fulrowtikt searchSupport">
                       	 <div class="showOrHide"  data-ticket="<?php echo $support_close[$i]->support_ticket_id; ?>" data-time="<?php echo date('M j,Y',strtotime($support_close[$i]->created_time)); ?>" data-subject="<?php echo substr($support_close[$i]->subject,0,100); ?>" data-reply="<?php echo $support_close[$i]->last_updated_by; ?>">
			    <div class="topsectickt">
                            	<span class="ticktid">Ticket ID: <strong><?php echo $support_close[$i]->support_ticket_id; ?></strong></span>
                                <span class="tiktdate"><?php echo date('M j,Y',strtotime($support_close[$i]->created_time)); ?></span>
                            </div>
                            <div class="tiktcntnt">
                            	<div class="col-md-8">
                                	<div class="ticktername"><?php echo $user_details->email; ?></div>
                                    
                                	<div class="likrtickt">
                                    	<div class="collabl">Subject</div>
                                        <div class="coltcnt"><?php echo substr($support_close[$i]->subject,0,100); ?></div>
                                    </div>
                                    
                                    <div class="likrtickt">
                                    	<div class="collabl">Replied By</div>
                                        <div class="coltcnt"><?php echo $support_close[$i]->last_updated_by; ?></div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                	<div class="ticketactn">
                                        <a class="closetickt" href="<?php echo base_url(); ?>dashboard/delete_ticket/<?php echo $support_close[$i]->support_ticket_id; ?>">Delete Ticket</a>
                                    </div>
                                </div>
                            </div>
			  </div>
                       </div>
			</li>
			<?php }} else{?>
			<li>
			<div class="fulrowtikt">
				<div class="tiktcntnt">
                            		<div class="col-md-8">No closed tickets found</div>
				</div>
			</div>
			</li>
			<?php } ?>
                      </ul>
			<div class="holder"></div>
                    </div>
                </div>
            </div> 
			
            
            <div class="tab-pane" id="addticket">
                <span class="size16 padtabnenopad bold">
                	<span class="tickthed">Add Tickets</span>
                </span>
                <div class="withedrow">
                    <div class="rowit chngecolr">
                      <div class="addtiktble">
                     <form action="<?php echo base_url(); ?>dashboard/add_new_ticket" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>   
			<input type="hidden" value="<?php echo base_url(); ?>dashboard" id="thisController">                      
                        <div class="likrticktsec">
                            <div class="cobldo">Subject</div>
                            <div class="coltcnt">
                            	<select class="payinselect mySelectBoxClassfortab hasCustomSelect" name="subject" required>
				<?php for($i=0;$i<count($support_ticket_subject);$i++){	?>
				  	<option value="<?php echo $support_ticket_subject[$i]->support_ticket_subject_value; ?>"><?php echo $support_ticket_subject[$i]->support_ticket_subject_value; ?></option>
				<?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="likrticktsec">
                            <div class="cobldo">Attachment</div>
                            <div class="coltcnt">
                            	<input type="file" name="file_name" class="payinput"> 
                            </div>
                        </div>
                        
                        <div class="likrticktsec">
                            <div class="cobldo">Message</div>
                            <div class="coltcnt">
                            	<textarea class="tikttext" name="message" required></textarea>
                            </div>
                        </div>
                        
                        <div class="likrticktsec">
                        	<div class="cobldo">&nbsp;</div>
                            <div class="coltcnt">
                        	<input type="submit" class="adddtickt" value="Add Ticket">
                            </div>
                        </div>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="tab-pane showTickets">
                <span class="size16 padtabnenopad bold">
                	<span class="tickthed">View Tickets</span>
                </span>
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
        	tickets("inboxTickets");
		$(document).on("click","#sent",function(){
			$("div.holder").remove();
			$("#sentTickets").after("<div class='holder'></div>");
			sentTickets();
		});
		$(document).on("click","#closed",function(){
			$("div.holder").remove();
			$("#closedTickets").after("<div class='holder'></div>");
			tickets("closedTickets");
		});
		$(document).on("click","#inbox",function(){
			$("div.holder").remove();
			$("#inboxTickets").after("<div class='holder'></div>");
			tickets("inboxTickets");
		});
		
	});


function tickets(id) {
    $("div.holder").proPages({
        containerID: id,
        perPage: 1,
        keyBrowse: true,
        scrollBrowse: false,
     	animation: "flipInX",
        callback: function (pages,
        items) {
                $("#legend1").html("Page " + pages.current + " of " + pages.count);
                $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
            }
        });
}
function sentTickets() {
    $("div.holder").proPages({
        containerID: "sentTickets",
        perPage: 2,
        keyBrowse: true,
        scrollBrowse: false,
     	animation: "flipInX",
        callback: function (pages,
        items) {
                $("#legend1").html("Page " + pages.current + " of " + pages.count);
                $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
            }
        });
}
/*
function closedTickets() {
    $("div.holder").proPages({
        containerID: "sentTickets",
        perPage: 1,
        keyBrowse: true,
        scrollBrowse: false,
     	animation: "flipInX",
        callback: function (pages,
        items) {
                $("#legend1").html("Page " + pages.current + " of " + pages.count);
                $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
            }
        });
}*/
</script>
