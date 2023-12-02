<?php $this->load->view('common/header'); ?>

<div class="full marintopcnt onlycontent">
    <div class="container fordetailpage">
        <div class="container paymentpage">
            
            
            <div class="col-md-12">
        <div class="padding20"> 
    
    
    <span class="dark padtabne size18">Booking Management </span>
    
    
        <div class='box-content box-no-padding rowit'>
        	<div class="col-md-12 nopad">
        
            
            </div>
            
           

            <div class="clear"></div>

        	<br />
        
            <div class='responsive-table'>
                <div class='scrollable-area'>
                    <table id="depostDatatable" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                        <thead>
                            <tr class="sortablehed">
                                <th>No</th>
                                
                                <th>PNR No</th>
                                 <th>Date</th>
                                <th>Api Status</th>
                                <th>Booking Status</th>
                                <th>Actual Price</th>
                                <th>Selling Price</th>
                                <th>Profit</th>
                                 <th>Action</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            <?php $count = 1; ?>
                            <?php if(!empty($Bookings)): ?>
                            <?php foreach($Bookings as $k): ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $k->pnr_no; ?></td>
                                <td><?php echo date("d-m-Y H:s", strtotime($k->voucher_date)); ?></td>
                                
                                <td><?php echo $k->api_status; ?></td>
                                <td><?php echo $k->booking_status; ?></td>
                                <?php
								  if($k->module == 'APARTMENT'){
						$booking = $this->booking_model->getBookingbyPnr($k->pnr_no,$k->module)->row();  
						?>
                         		<td><?php echo $booking->total; ?></td>
                                
                                <td><?php echo $booking->total; ?></td>
                                <td><?php echo '0.00'; ?></td>
                                <td><a href="<?php echo WEB_URL.'/apartment/voucher/'.base64_encode(base64_encode($k->pnr_no));?>" target="_blank" title="View voucher" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="View Voucher"><i class="icon-ticket"></i> Voucher</a></td>
                                <?php
								  }
								?>
                                 <?php
								  if($k->module == 'FLIGHT'){
					  $booking = $this->booking_model->getBookingbyPnr($k->pnr_no,$k->module)->row();
					
						?>
                        <td><?php echo $booking->TotalPrice; ?></td>
                         		<td><?php echo $booking->TotalPrice-$booking->MyMarkup; ?></td>
                                <td><?php echo $booking->MyMarkup; ?></td>
                                
                                <td> <?php if($booking->booking_status == 'CONFIRMED'){?>
                                <a title="Cancel Booking" onclick="flight_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-danger btn-xs has-tooltip" data-original-title="Cancel Booking">
                                  <i class="icon-off"></i> Cancel <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                              <?php }?>
                               
                                
                                <a href="<?php echo WEB_URL.'/flight/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View voucher" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i> Voucher
                                </a>
                                
                                   <a href="<?php echo WEB_URL.'/flight/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                    <i class="icon-ticket"></i> Invoice
                                </a>
                                </td>
                                <?php
								  }
								?>
                                 <?php
								  if($k->module == 'HOTEL'){
						$booking = $this->booking_model->getBookingbyPnr($k->pnr_no,$k->module)->row();  
						?>
                        <td><?php echo $booking->total_cost; ?></td>
                         		<td><?php echo $booking->total_cost-$booking->MyMarkup; ?></td>
                                <td><?php echo $booking->MyMarkup; ?></td>
                                
                                <td><?php if($booking->booking_status == 'CONFIRMED'){?>
                                <a title="Cancel Booking" onclick="hotel_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-danger btn-xs has-tooltip" data-original-title="Cancel Booking">
                                  <i class="icon-off"></i> Cancel <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                              <?php }?>
                              
                                
                                <a href="<?php echo WEB_URL.'/hotel/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View voucher" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="View Voucher">
                                
                                    <i class="icon-ticket"></i> Voucher
                                </a>
                                
                                   <a href="<?php echo WEB_URL.'/hotel/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                    <i class="icon-ticket"></i> Invoice
                                </a>
                                </td>
                                <?php
								  }
								?>
                                 <?php
								  if($k->module == 'CAR'){
						$booking = $this->booking_model->getBookingbyPnr($k->pnr_no,$k->module)->row();  
						?>
                        <td><?php echo $booking->TotalPrice; ?></td>
                         		<td><?php echo $booking->TotalPrice-$booking->MyMarkup; ?></td>
                                <td><?php echo $booking->MyMarkup; ?></td>
                                
                                <td>  <?php if($booking->booking_status == 'CONFIRMED'){?>
                                <a title="Cancel Booking" onclick="car_cancel_booking(this)" data-pnr="<?php echo base64_encode(base64_encode($booking->pnr_no));?>" data-placement="top" class="btn btn-danger btn-xs has-tooltip" data-original-title="Cancel Booking">
                                  <i class="icon-off"></i> Cancel <span class="loadr"><img src="<?php echo ASSETS;?>images/loader.gif"/></span>
                                </a>
                              <?php }?>
                            
                                
                                <a href="<?php echo WEB_URL.'/car/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View voucher" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i> Voucher
                                </a>
                                  
                                      <a href="<?php echo WEB_URL.'/car/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Invoice">
                                    <i class="icon-ticket"></i> Invoice
                                </a>
                               </td>
                                <?php
								  }
								?>
                                 <?php
								  if($k->module == 'VACATION'){
						$booking = $this->booking_model->getBookingbyPnr($k->pnr_no,$k->module)->row();  
						?>
                        <td><?php echo $booking->TotalPrice; ?></td>
                         		<td><?php echo $booking->TotalPrice-$booking->MyMarkup; ?></td>
                                <td><?php echo $booking->MyMarkup; ?></td>
                                
                                <td> 
                                
                                <a href="<?php echo WEB_URL.'/vacation/voucher/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View voucher" data-placement="top" class="btn btn-success btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i> Voucher
                                </a>
                                   
                                   <a href="<?php echo WEB_URL.'/vacation/invoice/'.base64_encode(base64_encode($booking->pnr_no));?>" target="_blank" title="View Invoice" data-placement="top" class="btn btn-primary btn-xs has-tooltip" data-original-title="View Voucher">
                                    <i class="icon-ticket"></i> Invoice
                                </a>
                              </td>
                                <?php
								  }
								?>
                               
                            </tr>
                            <?php $count++; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    

            
            
        </div>
    </div>
</div>   

		
	
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
$(document).ready(function() {
	
	//$('#example').DataTable();
	$('#depostDatatable').DataTable( {
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "<?php echo ASSETS;?>swf/copy_csv_xls_pdf.swf"
        }
    } );
	
  //BookingPagination();
});
</script>	