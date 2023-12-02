
 <!--leftmenu-->
      <?php $this->load->view('leftmenu');?>
   <!--leftmenu-->
   
    <style type="text/css">
 @media print
   {
      .bodywrapper {visibility: hidden;}
      .iconmenu {visibility: hidden;}

      .centercontent {
    margin-left: 0px;
    position: relative;
}
p.stdformbutton{
  visibility: hidden;
}

div.last p{
    visibility: hidden;
}
   }

   .amountdue {
    text-align: right;
    margin-top: 40px;
}


    </style>



    <section class="col-sm-10">
      <div class="clearfix">
        <div class="clearfix subTitleForHead">
          <h2 class="pull-left">Invoice (Client View)</h2>
          
        </div>
        <div class="clearfix">
          <div class="upgrade adminList subscribe">
            <div    id="contentwrapper" class="infoSect clearfix contentwrapper invoicewrapper">
              <h4 class="title">Invoice</h4>
             
             <div class="col-sm-6">
            
              <div class="invoice_logo"><img src="<?php echo LOGO;?>" alt="" /></div>
              
              <table cellpadding="0" cellspacing="0" class="table invoicefor">
                  <tr>
                      <td width="30%">Invoice For:</td>
                      <td width="70%"><strong><?php echo $invoice_details['user_name'];?></strong></td>
                  </tr>
                  <tr>
                    <td>Subscribed  ID:</td>
                    <td><?php echo $invoice_details['subscription_ref_id'];?></td>
                </tr>
                  <tr>
                    <td>Product Name:</td>
                    <td><?php echo $this->Subscriptions_Model->get_product_name($invoice_details['product_id']);?></td>
                  </tr>
              </table>
            </div><!--one_half-->



            <div class="col-sm-6">
      
       <p class="pull-right">Print <span onclick="javascript:window.print()" style="margin: 0px 40px -6px 0px;" class="fa fa-print"></span></p>
            <table cellpadding="0" cellspacing="0" class="table">
            
                  <tr>
                      <td width="30%">From:</td>
                      <td width="70%">
                        <!-- <strong>ThemePixels, Inc.</strong> <br /> -->
                       <?php echo $invoice_details['user_name'];?><br />
                        <?php echo $invoice_details['user_email'];?> <br />
                       
                      </td>
                  </tr>
              </table>
           
              <table cellpadding="0" cellspacing="0" class="table invoiceinfo">
              <tr>
                    <td>Subscribed Date:</td>
                    <td><strong> <?php echo date('d M Y',strtotime($invoice_details['subscription_on']));?></strong></td>
                </tr>
                  <tr>
                      <td width="30%">Start Date:</td>
                      <td width="70%"><strong><?php echo ($invoice_details['start_on']!=null)?date('d M Y',strtotime($invoice_details['start_on'])):'N/A';?></strong></td>
                  </tr>
                  
                  <tr>
                    <td>End Date:</td>
                    <td><strong><?php echo ($invoice_details['end_on']!=null)?date('d M Y',strtotime($invoice_details['end_on'])):'N/A';?></strong></td>
                  </tr>

                  <tr>
                    <td>Licence Type:</td>
                    <td>

                    <strong><?php echo ($invoice_details['licence_type']!=null)?$invoice_details['licence_type']:'N/A';?></strong>

                    <?php echo ($invoice_details['licence_type']=='Multiple')?'('.$invoice_details['number_of_licence'].')':'';?>

                    </td>
                  </tr>
              </table>



            </div><!--one_half-->
<div class="col-sm-12">

            <table cellpadding="0" cellspacing="0" border="0" class="table">
                   
                    <thead>
                        <tr>
                            <th class="">Product</th>
                            <th class="">Subscription</th>
                            <th class="text-right">Payment Ref.No</th>
                            <th class="text-right">Payment Status</th>
                            <th class="text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $this->Subscriptions_Model->get_product_name($invoice_details['product_id']);?></td>
                            <td><?php echo $this->Subscriptions_Model->get_subscriptions_durtion($this->Subscriptions_Model->subscriptions_durtion($invoice_details['subscription_id']));?></td>
                            <td class="text-right"><?php echo ($invoice_details['payment_ref_id']!=null)?$invoice_details['payment_ref_id']:'N/A';?></td>
                            <td class="text-right"><?php echo $invoice_details['payment_status'];?></td>
                            <td class="text-right"><strong><?php echo ($invoice_details['status']!=null)?$invoice_details['status']:'N/A';?></strong></td>
                        </tr>
                        <tr>
                       
                    </tbody>
                </table>
                                
                <table cellpadding="0" cellspacing="0" border="0" class="table">
                   
                  <?php
$subscription_prices=$this->Subscriptions_Model->get_edit_subscriptions($invoice_details['subscription_id']);
                  ?>
                    <tbody>
                        <tr>
                            <td class="text-right" style="border-right: 1px solid #ddd; padding-right: 10px; ">
                              Subtotal <br />
                              
                                Discount (%)
                            </td>
                            <?php
                           $number_of_licence=($invoice_details['licence_type']=='Multiple')?$invoice_details['number_of_licence']:1;
                           $tatal_cost=$subscription_prices['subscription_cost']*$number_of_licence;

                            $total_calculation=($subscription_prices['subscription_cost']/100);
                            $total_calculation=$total_calculation*($subscription_prices['subscription_discount']*$number_of_licence);

                            ?>
                            <td class="text-left"><strong><?php echo ($invoice_details['licence_type']=='Multiple')?$invoice_details['number_of_licence'].' X':'';?> <?php echo $subscription_prices['subscription_cost'];?><br /> <?php echo ($invoice_details['licence_type']=='Multiple')?$invoice_details['number_of_licence'].' X':'';?> <?php echo $subscription_prices['subscription_discount'];?></strong></td>
                        </tr>
                    </tbody>
          </table>
      
          <div class="amountdue">
            <h1><span> Total Amount:</span> <?php echo ($tatal_cost-$total_calculation);?></h1>
            <!-- <a href="">Pay Invoice</a> -->
          </div>
          
          
           <div class="contenttitle2">
            <h3>Cancellation / Disapprove Message</h3>
          </div>
          
          <div><?php echo $invoice_details['cancellation_reason'];?>
          <br>
          <?php echo $invoice_details['disapprove_reason'];?></div> 

</div>

            </div>
            
          </div>  
        <div class="text-center form-group">
          <a  href="<?php echo base_url('user_subscriptions');?>"  class="btn btn-primary"  />Cancel</a>
           
          </div> 
        </div>
      </div>
    </section>
        </section>
        
   
          
            
			
            
        
            
        
                        
                        
                                                
    
    
    

