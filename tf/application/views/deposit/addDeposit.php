<?php $this->load->view('common/header');?>

<div id="fuornotfour" class="full marintopcnt contentvcr">
    <div class="container">
        <div class="container offset-0">
            <div class="padding20"> 
                <span class="dark padtabne size18">Add New Deposit</span>            	
            

            <div class="box-content rowit">
                <form id="addDepositForm" class="form form-horizontal validate-form" style="margin-bottom: 0;" action="<?php echo WEB_URL.'/account/saveDeposit'; ?>" method="post" enctype="multipart/form-data" > 
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="amount">Amount Deposited</label>
                        <div class="col-sm-4 controls">
                            <input class="form-control" data-rule-number="true" data-rule-required="true" id="amount" name="amount" placeholder="Amount" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="amount">Deposited Date</label>
                        <div class="datepicker-input input-group col-sm-4">
                            <input id="datepicker" class="datepicker-input form-control" data-format="MM/DD/YYYY" placeholder="MM/DD/YYYY" name="deposited_date" type="text" required>
                            <span class="input-group-addon">
                                <span data-date-icon="icon-calendar" data-time-icon="icon-time" class="icon-calendar"></span>
                            </span>
                         </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="validation_remarks">Remarks</label>
                        <div class="col-sm-4 controls">
                            <textarea class="form-control" data-rule-required="true" id="validation_remarks" placeholder="Remarks" name="remarks" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="form-actions" style="margin-bottom:0">
                        <div class="row">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">
                                    <i class="icon-plus"></i>
                                    Add Amount
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
			</div>
        </div>
    </div>
</div>

<?php $this->load->view('common/footer');?>
<script type="text/javascript">
/*	$(document).ready(function(){
		var windowht = $(window).height();
		$('#fuornotfour').css({'min-height':windowht})
	});*/
</script>