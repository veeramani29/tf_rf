
            <li class="searchCount sent" id="totalLI<?php echo $support_sent->support_ticket_id; ?>">
                       <div class="fulrowtikt searchSupport" >
                            <div class="showOrHide" data-ticket="<?php echo $support_sent->support_ticket_id; ?>" data-time="<?php echo date('M j,Y',strtotime($support_sent->created_time)); ?>" data-subject="<?php echo substr($support_sent->subject,0,100); ?>" data-reply="<?php echo $support_sent->last_updated_by; ?>"> 
               <div class="topsectickt">
                                <span class="ticktid">Ticket ID : <?php echo $support_sent->support_ticket_id; ?> 
                                <?php
                                if($support_sent->file_path!='')
                                {
                                    ?>
                                <i class="icon-paper-clip"></i>
                                <?php
                                }
                                ?></span>
                                <span class="tiktdate"><?php echo date('M j,Y',strtotime($support_sent->created_time)); ?></span>
                            </div>
                            <div class="tiktcntnt">
                                <div class="col-md-8">
                                    <div class="ticktername"><?php echo $user_details->email; ?></div>
                                    
                                    <div class="likrtickt">
                                        <div class="collabl">Subject</div>
                                        <div class="coltcnt"><?php echo substr($support_sent->subject,0,100); ?></div>
                                    </div>
                                    
                                    <div class="likrtickt">
                                        <div class="collabl">Replied By</div>
                                        <div class="coltcnt"><?php echo $support_sent->last_updated_by; ?></div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="ticketactn">
                                        <a class="viewtickt viewTicket" id="<?php echo $support_sent->id; ?>" href="#viewticketss<?php echo $support_sent->id; ?>" data-toggle="tab"><?php echo lang_line('View_Ticket');?></a>
                                        <a class="closetickt"  id="closeticket<?php echo $support_sent->support_ticket_id; ?>" href="javascript:void(0)" ticketid="<?php echo $support_sent->support_ticket_id; ?>" tickettype="sentTickets"><?php echo lang_line('Close_Ticket');?></a>
                                    </div> 
                                </div>
                            </div>
            </div>
                       </div>
            </li>