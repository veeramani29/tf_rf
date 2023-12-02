<!--leftmenu-->
<?php $this->load->view('leftmenu');?>
<!--leftmenu-->

<section class="col-sm-10 col-xs-12">

      <div class="clearfix text-center">
      <form method="post" id="form_submit" name="form_submit"> 
                 <input type="hidden" id="hdnMethod" name="hdnMethod">


        <div class="clearfix subTitleForHead">
          <h2 class="pull-left">Discount Coupons</h2>


          <!-- <div class="col-sm-2 pad-null pull-right">
            <select name="" id="" class="form-control">
              <option value="">Yugamiru</option>
              <option value="">Yugamiru Pro</option>
            </select>
          </div> -->
        </div>

        <div class="clearfix">
<?php if($success_msg!=null){ ?>
<div class="alert alert-success text-center"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p> <?php echo $success_msg; ?></p>
</div>
<?php } ?>

<div class="alert alert-success text-center hide"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p id="alertMsg"></p>
</div>
</div>

        <div class="clearfix">
           <?php if($all_discounts['num_rows']>0){ $s=0; for ($i=0; $i <$all_discounts['num_rows'] ; $i++) {  ?> 
          <div class="discount">
            <table class="table table-condensed stdtable">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Product</th>
                   <th>Subscription</th>
                  <th>Discounts</th>
                   <th>Add Date</th>
                  <th>Valid Till</th>
                  <th>Status</th>
                   <th>Action</th>
                 <!--  <th><button class="btn btn-primary btn-xs">Edit</button></th> -->
                </tr>
              </thead>
              <tbody>
               <tr>
                         <!--  <td>
                            <input type="checkbox" name="Checkall[]" value="<?php echo $all_discounts['results'][$i]['discount_code_id'];?>"  />
                          
                          </td>
                          <td><?php echo ($s+1);?></td> -->
                            <td><?php echo ($all_discounts['results'][$i]['discount_code']!=null)?$all_discounts['results'][$i]['discount_code']:'N/A';?></td>

                            <td><?php echo $this->Subscriptions_Model->get_product_name($all_discounts['results'][$i]['product_id']);?></td>
                               <td><?php echo $this->Subscriptions_Model->get_subscriptions_durtion($this->Subscriptions_Model->subscriptions_durtion($all_discounts['results'][$i]['subscription_id']));?></td>
            

                           
                            <td> <?php $type=(($all_discounts['results'][$i]['discount_type']=='1')?'%':(($all_discounts['results'][$i]['currency']==1)?CURR_D:CURR_J)); 
                            echo ($all_discounts['results'][$i]['discount']!=null)?$all_discounts['results'][$i]['discount']." ".$type:'N/A';?></td>
                            <td><?php echo date('d M Y',strtotime($all_discounts['results'][$i]['added_on']));?></td> 
                            
                            <td><?php echo date('d M Y',strtotime($all_discounts['results'][$i]['end_date']));?></td> 
                            <td>
                              <?php if($all_discounts['results'][$i]['discount_status']=='Active'){ ?>
                              <a title="Active" href="<?php echo base_url('discount/inactive')."/".$all_discounts['results'][$i]['discount_code_id'];?>" class='label label-success'><?php echo $all_discounts['results'][$i]['discount_status'];?></a>
                              <?php }else{ ?>
                              <a title="Inactive" href="<?php echo base_url('discount/active')."/".$all_discounts['results'][$i]['discount_code_id'];?>" class='label label-danger'><?php echo $all_discounts['results'][$i]['discount_status'];?></a>
                              <?php } ?>
                           
                              </td>
                             <td>

                             
                     
                            <!--  <a title="Edit" href="<?php echo base_url('discount/edit')."/".$all_discounts['results'][$i]['discount_code_id'];?>" class="edit">Edit</a> -->
                             &nbsp; <a title="Send" class="btn btn-primary btn-xs" href="<?php echo base_url('discount/send')."/".$all_discounts['results'][$i]['discount_code_id'];?>" >Send</a>
                             <!--  &nbsp; <a title="Delete" href="<?php echo base_url('discount/delete')."/".$all_discounts['results'][$i]['discount_code_id'];?>" class="admin_delete">Delete</a> -->
                            

                             </td> 
                        </tr>
              </tbody>
            </table>
          </div>
            <?php $s++; } } ?>
         
        </div>

        <div class="clearfix text-center form-group">
              <a href="<?php echo base_url('discount/add');?>" class="btn btn-info">Add Discount</a>
            </div>

           </form>
      </div>

    </section>
            </section>
        
   
                        
               
                 
                
             
              
                

            
                
<!-- <li><button type="button" onclick="location.href='<?php echo base_url('discount/add');?>'" title="Add Discount" class="stdbtn btn_blue">Add Discount</button></li>
<li><button type="button" title="Active" class="stdbtn btn_lime changebuttons">Active</button></li>
<li><button type="button" title="Inactive" class="stdbtn btn_red changebuttons">Inactive</button></li> -->
                
             
      
    

<script type="text/javascript">
  jQuery(document).ready(function(){




///// DELETE SELECTED ROW IN A TABLE /////
  jQuery('.changebuttons').click(function(){
             // get target id of table                  
    var sel = false;                        //initialize to false as no selected row
    var method=jQuery(this).attr('title');
    var ch = jQuery('#dyntable2').find('tbody input[type=checkbox]');   //get each checkbox in a table
    
    //check if there is/are selected row in table
     
     if(jQuery('#dyntable2').find('tbody input[name="Checkall[]"]').is(':checked')){
      jConfirm('Are you sure you want to '+method+' this ?', ''+method+' Discount', function(r) {
    
       if(r){
        jQuery('#hdnMethod').val(method);
        jQuery('#form_submit').submit();
   
    }else{
        sel = true;   
    }
     });
       return false;
  }
    if(!sel) jAlert('No data selected', 'Alert Dialog');  //alert to no data selected
  });





///// DELETE SELECTED ROW IN A TABLE /////
  jQuery('.deletebuttons').click(function(){
             // get target id of table                  
    var sel = false;                        //initialize to false as no selected row
    var ch = jQuery('#dyntable2').find('tbody input[type=checkbox]');   //get each checkbox in a table
    
    //check if there is/are selected row in table
     
     if(jQuery('#dyntable2').find('tbody input[name="Checkall[]"]').is(':checked')){
      jConfirm('Are you sure you want to delete this ?', 'Delete Discounts', function(r) {
    
       if(r){
    ch.each(function(){
      if(jQuery(this).is(':checked')) {
        var eachval=jQuery(this).val();
        sel = true;                       //set to true if there is/are selected row

        jQuery(this).parents('tr').fadeOut(function(){
      jQuery.ajax({
            type: 'POST',
            url: WEB_URL+"discount/delete/"+eachval,
            async: true,
            dataType: 'json',
           // data: data,
            success: function() {
          jQuery(this).remove();
            }
          });
                      //remove row when animation is finished
        });
      }
    });
    jQuery('#alertMsg').parent('div').show();
    jQuery('#alertMsg').html('Selected items are deleted');
    }else{
        sel = true;   
    }
     });
       return false;
  }
    if(!sel) jAlert('No data selected', 'Alert Dialog');             //alert to no data selected
  });


  ///// DELETE INDIVIDUAL ROW IN A TABLE /////
  jQuery('.stdtable td').on('click',"a.admin_delete",function(){
 
     var Delurl=jQuery(this).attr("href");
     var curTr=jQuery(this).parents("tr");

  jConfirm('Are you sure you want to delete this ?', 'Delete Discount', function(r) {
if(r) curTr.fadeOut(function(){ 

      jQuery.ajax({
            type: 'POST',
            url: Delurl,
            async: true,
            dataType: 'json',
           // data: data,
            success: function() {
          jQuery(this).remove();
            }
          });
        


      jQuery('#alertMsg').parent('div').show();
    jQuery('#alertMsg').html('Selected items are deleted');
    });
       });

    
    return false;
  });









 jQuery('.stdtable td').on('click',"a.label-success",function(){
   
  var currel=jQuery(this);
     var inactiveurl=jQuery(this).attr("href");
 var curTr=jQuery(this).parents("tr");

 
 if(confirm('Are you sure want to inactive this?')){
  curTr.fadeIn(function(){ 

      jQuery.ajax({
            type: 'POST',
            url: inactiveurl,
            //async: true,
            //dataType: 'json',
           // data: data,
            success: function() {
             
              currel.removeClass('label-success');
             currel.addClass('label-danger');
              currel.text('Inactive');
      var newurl=inactiveurl.replace("inactive", "active");
    
      currel.attr('href',newurl);
            }
          });
        
  $('#alertMsg').parent('div').removeClass('hide');
jQuery('#alertMsg').parent('div').show();
    jQuery('#alertMsg').html('Selected items are activated');
       });
      
  
    
    return false;
  }
 });
 jQuery('.stdtable td').on('click',"a.label-danger",function(){

  var currel=jQuery(this);
     var activeurl=jQuery(this).attr("href");
      var curTr=jQuery(this).parents("tr");
    
       
        if(confirm('Are you sure want to active this?')){
curTr.fadeIn(function(){ 
      jQuery.ajax({
            type: 'POST',
            url: activeurl,
            //async: true,
            //dataType: 'json',
           // data: data,
            success: function() {
             
              currel.removeClass('label-danger');
             currel.addClass('label-success');
              currel.text('Active');
      var newurl=activeurl.replace("active", "inactive");
     
      currel.attr('href',newurl);
            }
          });
        $('#alertMsg').parent('div').removeClass('hide');
      jQuery('#alertMsg').parent('div').show();
    jQuery('#alertMsg').html('Selected items are inactivated');
        
 });
}


    
    return false;
  });

   })
</script>