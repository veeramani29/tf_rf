<?php $this->load->view('common/header'); ?>

<div class="full marintopcnt onlycontent">
    <div class="container fordetailpage">
        <div class="container paymentpage">
            
            
            <div class="col-md-12">
        <div class="padding20"> 
    
    
    <span class="dark padtabne size18">Account Management </span>
    
    
        <div class='box-content box-no-padding rowit'>
        	<div class="col-md-6 nopad">
            <span class="amnbalbl">Balance Amount</span>
            <span class="balncamnt"> <?php  echo (isset($depost_table_data['deposit_amount']->balance_credit) && $depost_table_data['deposit_amount']->balance_credit != "" ) ? $depost_table_data['deposit_amount']->balance_credit : "0.00" ; ?> $</span>
            
            
            </div>
            
            <div class="col-md-6 nopad">
            	<!--<a class="right" href="<?php echo WEB_URL.'/account/addDeposit' ?>"><button class="btn btn-primary" style="float: right;">Add New Deposit</button></a>
                <a class="right" id="addeposit"><button class="btn btn-primary" style="float: right;">Add New Deposit</button></a>-->
            </div>

            <div class="clear"></div>
				
                <table id="depostDatatable" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                        <thead>
                            <tr class="sortablehed">
                                <th>Stat.No</th>
                                <th>Date</th>
                                <th>Statment</th>
                                <th>Deposit</th>
                                <th>Withdraw</th>
                                <th>Balance Amount</th>
                                
                            </tr>
                        </thead>
                    
                        <tbody>
                            <?php $count = 1; ?>
                            <?php if(!empty($account_statment_data)): ?>
                            <?php foreach($account_statment_data as $k): ?>
                            <tr>
                                
                                <td><?php echo $k->statment_number; ?></td>
                                 <td><?php echo date("d-m-Y H:i", strtotime($k->statdate)); ?></td>
                                <td><?php echo $k->description; ?></td>
                                <td><?php 
								if($k->statment_type=='DEPOSIT')
								{
									echo $k->amount; 
								}
								else
								{
									echo '-';
								}
								?></td>
                                <td><?php if($k->statment_type=='WITHDRAW')
								{
									echo $k->amount; 
								}
								else
								{
									echo '-';
								} ?></td>
                                <td><?php echo $k->balance_amount; ?></td>
                            </tr>
                            <?php $count++; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                       
                    </table>
                
        	<br />
        
            <div class='responsive-table'>
                <div class='scrollable-area'>
                    
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
		"order": [[ 1, "desc" ]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "<?php echo ASSETS;?>swf/copy_csv_xls_pdf.swf"
        }
    } );
	
  //BookingPagination();
});
</script>
