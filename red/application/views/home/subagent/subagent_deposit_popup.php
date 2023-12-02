
    <form name="sub_dep_frm" method="POST" action="<?php echo site_url(); ?>/agent/add_sub_agent_deposit/<?php echo $subAgentId; ?>">
        <p style="margin-left: 57px;margin-bottom: 15px;">Add Deposit for this sub-agent</p>

        <div class="form-group">
            <label>Your Account Balance</label>
            <input type="text" class="form-control" id="agent_bal" name="agent_balance" value="<?php echo $agentDepBal; ?>" style="height: 34px;width:68%" readonly="readonly">
            <div id="forgot_email_id_error" style="margin-top: 4px;font-size: 12px;color: red;margin-left: 5px;display:none;"></div>
        </div>
        <div class="form-group">
            <label>Deposit Amount</label>
            <input type="text" class="form-control" id="sub_agent_dep_amt" name="deposit_amount" value="" style="height: 34px;width:68%" onkeypress="return restrictCharacters(this, event, digitsOnly);" required>
            <div id="sub_agent_bal_error" style="margin-top: 4px;font-size: 12px;color: red;margin-left: 5px;display:none;"></div>
        </div>
        <input type="hidden" name="sub_id" value="<?php echo $subAgentId; ?>">
        <input type="hidden" name="uid" value="<?php echo $agentId; ?>">
        <div class="form-group" style="float: left;margin: 0 0 11px 117px;">
            <input type="submit" id="sub_agent_deposit_submit" tabindex="11" class="btn btn-primary pull-right" onclick="return addSubAgentDeposit();" style="color:#ffffff;" value="Add Deposit" title="Add Deposit.">
        </div>
    </form>
            