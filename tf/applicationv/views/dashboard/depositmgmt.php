<!-- TAB 6 { -->

<div class="tab-pane <?php if(!empty($page_type) && $page_type == "deposit") {echo "active";} ?>" id="chg_password">
    <div class="padding20"> 
    
    
    <span class="dark padtabne size18">Deposit Management </span>
    
    
        <div class='box-content box-no-padding rowit'>
        	<div class="col-md-6 nopad">
            <span class="amnbalbl">Balance Amount</span>
            <span class="balncamnt"> <?php  echo (isset($depost_table_data['deposit_amount']->balance_credit) && $depost_table_data['deposit_amount']->balance_credit != "" ) ? $depost_table_data['deposit_amount']->balance_credit : "0.00" ; ?> $</span>
            </div>
            
            <div class="col-md-6 nopad">
            	<!--<a class="right" href="<?php echo WEB_URL.'/account/addDeposit' ?>"><button class="btn btn-primary" style="float: right;">Add New Deposit</button></a>-->
                <a class="right" id="addeposit"><button class="btn btn-primary" style="float: right;">Add New Deposit</button></a>
            </div>

            <div class="clear"></div>

        	<br />
        
            <div class='responsive-table'>
                <div class='scrollable-area'>
                    <table id="depostDatatable" class='data-table-column-filter table table-bordered table-striped' cellspacing="0" width="100%">
                        <thead>
                            <tr class="sortablehed">
                                <th>S.No</th>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Remarks</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            <?php $count = 1; ?>
                            <?php if(!empty($depost_table_data['deposit'])): ?>
                            <?php foreach($depost_table_data['deposit'] as $k): ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $k->transaction_id; ?></td>
                                <td><?php echo $k->deposited_date; ?></td>
                                <td><?php echo $k->amount_credit; ?></td>
                                <td><?php echo $k->remarks; ?></td>
                                <td><?php echo $k->status; ?></td>
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

<!-- END OF TAB 6 } --> 

<div id="adddeposit" class="popuofixissue"> <span class="buttonclose pop-close"><span>X</span></span>
  <div class="listingpopup addepost">
  <div class="lodrefrentrev imgLoader">
    <div class="centerload"></div>
</div>
    <div class="popuphed"> <span class="popbighed">Add New Deposit</span> </div>
    <form id="addDepositForm" class="form form-horizontal validate-form" style="margin-bottom: 0;" action="<?php echo WEB_URL.'/account/saveDeposit'; ?>" method="post" enctype="multipart/form-data" > 
    <div class="popconyent overvis vehicledetail">
    	
                    <div class="form-group">
                        <label class="control-label col-sm-5" for="amount">Amount Deposited</label>
                        <div class="col-sm-7 controls">
                            <input class="form-control" data-rule-number="true" data-rule-required="true" id="amount" name="amount" placeholder="Amount" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5" for="amount">Deposited Date</label>
                        <div class="datepicker-input input-group col-sm-7">
                            <span class="input-group-addon">
                                <span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span>
                            </span>
                            <input id="datepicker" class="datepicker-input form-control" data-format="MM/DD/YYYY" placeholder="MM/DD/YYYY" name="deposited_date" type="text" required>
                            
                         </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-5" for="validation_remarks">Remarks</label>
                        <div class="col-sm-7 controls">
                            <textarea class="form-control" data-rule-required="true" id="validation_remarks" placeholder="Remarks" name="remarks" rows="3" required></textarea>
                        </div>
                    </div>

                    
               
    </div>
    
    <div class="popfooter">
      <div class="form-actions" style="margin-bottom:0">
            <div class="row">
            	<label class="control-label col-sm-5" for="validation_remarks">&nbsp;</label>
                <div class="col-sm-7">
                    <button class="btn btn-primary" type="submit">
                        <i class="icon-plus"></i>
                        Add Amount
                    </button>
                </div>
            </div>
        </div>
    </div>
     </form>
    
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('#addeposit').click(function(){
		$('#adddeposit').provabPopup({
			modalClose: true, 
			zIndex: 10000005,
		});
	});
});
</script>