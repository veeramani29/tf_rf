<!--leftmenu-->
<?php $this->load->view('leftmenu');?>
<!--leftmenu-->





    <section class="col-sm-10">
     <form method="post" id="form_submit" name="form_submit"> 
                 <input type="hidden" id="hdnMethod" name="hdnMethod">

                 <?php if($success_msg!=null){ ?>
             <div class="alert alert-success text-center"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p> <?php echo $success_msg; ?></p>
                    </div>
                    <?php } ?>

                   <div class="alert alert-success text-center hide"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       <p id="alertMsg"></p>
                    </div>

      <div class="clearfix">
        <div class="clearfix subTitleForHead">
          <h2 class="pull-left">Manage User Subscriptions</h2>
          <!-- <div class="col-sm-2 pad-null pull-right">
            <select name="" id="" class="form-control">
              <option value="">Yugamiru</option>
              <option value="">Yugamiru Pro</option>
            </select>
          </div> -->
        </div>
        <div class="clearfix">
          <div class="upgrade adminList subscribe">
            <div class="infoSect clearfix">
              <h4 class="title">Quick Search</h4>
             
                <div class="clearfix">
                 <div class="form-group">
                  <label for="">User Name</label>
                  <input type="text" id="user_name" name="user_name" class="form-control">
                 </div>
                 <div class="form-group">
                  <label for="">Subscription Id</label>
                  <input type="text" name="subscription_ref_id" id="subscription_ref_id" class="form-control">
                 </div>
                 <div class="form-group">
                  <label for="">Payment Ref.No</label>
                  <input type="text" id="payment_ref_id" name="payment_ref_id" class="form-control">
                 </div>
                </div>
                <div class="clearfix">
                  <div class="form-group col-sm-5">
                    <label for="">Valid From</label>
                    <input type="text" id="start_on" name="start_on" class="form-control">
                    <i class="fa fa-calendar fa-2x"></i>
                   </div>
                    <div class="form-group col-sm-5">
                    <label for="">Valid To</label>
                    <input type="text" name="end_on" value="" id="end_on" class="form-control" >    
                    <i class="fa fa-calendar fa-2x"></i>
                    </div>
                    
                    
                   </div>

               
     
        
 

                   <div class="form-group">
                    <button title="Search" type="submit" class="btn btn-primary">Search</button>
                   </div>
                </div>
          
            </div>
            <div class="infoSect clearfix">
              <h4 class="title">Quick Search - Result</h4>
              <table id="dyntable2" class="table table-condensed stdtable">
              <thead>
               <tr>
                          <th ><input type="checkbox" class="checkall" /></th>
                           <th>S.No</th>
                             <th>User Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Subscription</th>
                            <th>Product</th>
                            <th> Payment Ref.No</th>
                           <th>Payment Status</th>
                            <th>Approve / Cancel</th>
                             <th>Action</th>
                        </tr>
              </thead>
              <tbody>
               <?php if($all_subscriptions['num_rows']>0){ $s=0; for ($i=0; $i <$all_subscriptions['num_rows'] ; $i++) {  ?> 
                        <tr >
                          <td align="text-center"><span class="center">
                            <input type="checkbox" name="Checkall[]" value="<?php echo $all_subscriptions['results'][$i]['id'];?>"  />
                          </span>
                          </td>
                          <td><?php echo ($s+1);?></td>
                            <td><?php echo ($all_subscriptions['results'][$i]['user_name']!=null)?$all_subscriptions['results'][$i]['user_name']:'N/A';?></td>
                           
                            <td ><?php echo ($all_subscriptions['results'][$i]['start_on']!=null)?date('d M Y',strtotime($all_subscriptions['results'][$i]['start_on'])):'N/A';?></td> 
                            <td ><?php echo ($all_subscriptions['results'][$i]['end_on']!=null)?date('d M Y',strtotime($all_subscriptions['results'][$i]['end_on'])):'N/A';?></td> 
                            <td class="center"><?php echo $this->Subscriptions_Model->get_subscriptions_durtion($this->Subscriptions_Model->subscriptions_durtion($all_subscriptions['results'][$i]['subscription_id']));?></td>
                            <td ><?php echo $this->Subscriptions_Model->get_product_name($all_subscriptions['results'][$i]['product_id']);?></td>
                          
                           
                            <td class="center"><?php echo ($all_subscriptions['results'][$i]['payment_ref_id']!=null)?$all_subscriptions['results'][$i]['payment_ref_id']:'N/A';?></td>
                           
                            <td class="center">
                             
                              <a title="<?php echo $all_subscriptions['results'][$i]['payment_status'];?>" class="label label-primary" href="javascript:;" ><?php echo $all_subscriptions['results'][$i]['payment_status'];?></a>
                          <!--     &nbsp;<a title="Edit" href="<?php echo base_url('user_subscriptions/edit')."/".$all_subscriptions['results'][$i]['id'];?>" >Edit</a> -->
                           
                              </td>
                             <td class="center">

                              <?php if($all_subscriptions['results'][$i]['status']=='Approved'){ ?>
                              <a title="Active" href="<?php echo base_url('user_subscriptions/active')."/".$all_subscriptions['results'][$i]['id'];?>" class='label label-success'><?php echo $all_subscriptions['results'][$i]['status'];?></a>
                               <a title="Disapprove" href="<?php echo base_url('user_subscriptions/revoke')."/".$all_subscriptions['results'][$i]['id'];?>" class='label label-warning'>Disapprove</a>
                              <?php }elseif($all_subscriptions['results'][$i]['status']=='Cancelled'){ ?>
                              <a title="Cancel" href="<?php echo base_url('user_subscriptions/inactive')."/".$all_subscriptions['results'][$i]['id'];?>" class='label label-danger'><?php echo $all_subscriptions['results'][$i]['status'];?></a>
                             
                              <?php }elseif($all_subscriptions['results'][$i]['status']=='' || $all_subscriptions['results'][$i]['status']=='Disapproved'){  ?>
                                <a title="Approve"  href="<?php echo base_url('user_subscriptions/active')."/".$all_subscriptions['results'][$i]['id'];?>" class='label label-success'>Approve</a>
                                <a title="Cancel"  href="<?php echo base_url('user_subscriptions/inactive')."/".$all_subscriptions['results'][$i]['id'];?>" class='label label-danger'>Cancel</a>
                               <?php } ?>
                     
                           
                            

                             </td> 

                              <td class="center">
                             
                            
                          <a title="Edit" class="btn btn-primary btn-xs" href="<?php echo base_url('user_subscriptions/edit')."/".$all_subscriptions['results'][$i]['id'];?>" >Edit</a> 
                          | <a title="Invoice" class="btn btn-primary btn-xs" href="<?php echo base_url('user_subscriptions/invoice')."/".$all_subscriptions['results'][$i]['id'];?>" >Invoice</a> 
                           
                              </td>
                        </tr>
                     
                       <?php $s++; } } ?>
               
              </tbody>
            </table>
            </div>
          </div>  
          <div class="text-center form-group">
       <button type="button" onclick="location.href='<?php echo base_url('user_subscriptions/add');?>'" title="Add User Subscriptions" class="btn btn-info">Add User Subscriptions</button>
                       <!--  <li><button type="button" title="Delete" class="stdbtn btn_black deletebuttons">Delete</button></li> -->
                       <button type="button" title="Approve" class="btn btn-success changebuttons">Approve</button>
                       <button type="button" title="Cancel"  class="btn btn-danger changebuttons">Cancel</button>

           
          </div>
        </div>
      </div>
         </form>  
    </section> 

       </section>      
    
   
               
                
                
               
          
       <!-- Modal -->
<div id="cancel_details" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reason for Cancellation</h4>
      </div>
      <div class="modal-body">


 <form id="cancellation_sub"   method="POST" novalidate="novalidate" enctype="multipart/form-data" role="form">
                  <div class="form-group">
                    <label for="cancellation_reason">Comments</label>
                      <textarea   class="form-control" name="cancellation_reason" class="form-control"   id="cancellation_reason" required ></textarea>
                  </div>
                 
                    <button  class="submit btn btn-default">Submit</button>
                      <span class="loading hide"><img src="<?php echo IMAGES;?>loaders/loader3.gif" alt="" />Uploading...</span>
                </form>


     

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>       
 <!-- Modal -->
                   
               

           <!-- Modal -->
<div id="disapprove_details" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reason for Disapprove</h4>
      </div>
      <div class="modal-body">
       <form id="disapprove_sub"   method="POST" novalidate="novalidate" enctype="multipart/form-data">
      
              <div class="form-group">
              <label for="disapprove_reason">Comments</label>
              <textarea  class="form-control" name="disapprove_reason"  id="disapprove_reason" required ></textarea>
              </div>
        

       
        <button  class="btn btn-default">Submit</button>
        
        <span class="loading hide"><img src="<?php echo IMAGES;?>loaders/loader3.gif" alt="" />Uploading...</span>
    
     

      
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>       
 <!-- Modal -->       
          
  
    






<script type="text/javascript">
  $(document).ready(function(){



        


 $( "#start_on" ).datepicker({
   autoclose: true,
      format: 'yyyy-mm-dd',
      minDate: 0
    });

$( "#end_on" ).datepicker({
   autoclose: true,
      format: 'yyyy-mm-dd',
      minDate: 0
    });





///// DELETE SELECTED ROW IN A TABLE /////
  $('.changebuttons').click(function(){
             // get target id of table                  
    var sel = false;                        //initialize to false as no selected row
    var method=$(this).attr('title');
    var ch = $('#dyntable2').find('tbody input[type=checkbox]');   //get each checkbox in a table
    
    //check if there is/are selected row in table
     
     if($('#dyntable2').find('tbody input[name="Checkall[]"]').is(':checked')){
      jConfirm('Are you sure you want to '+method+' this ?', ''+method+' Subscriptions', function(r) {
    
       if(r){
        $('#hdnMethod').val(method);
        $('#form_submit').submit();
   
    }else{
        sel = true;   
    }
     });
       return false;
  }
    if(!sel) alert('No data selected', 'Alert Dialog');  //alert to no data selected
  });





///// DELETE SELECTED ROW IN A TABLE /////
  $('.deletebuttons').click(function(){
             // get target id of table                  
    var sel = false;                        //initialize to false as no selected row
    var ch = $('#dyntable2').find('tbody input[type=checkbox]');   //get each checkbox in a table
    
    //check if there is/are selected row in table
     
     if($('#dyntable2').find('tbody input[name="Checkall[]"]').is(':checked')){
     
    
       if(confirm('Are you sure you want to delete this ?')){
    ch.each(function(){
      if($(this).is(':checked')) {
        var eachval=$(this).val();
        sel = true;                       //set to true if there is/are selected row

        $(this).parents('tr').fadeOut(function(){
      $.ajax({
            type: 'POST',
            url: WEB_URL+"user_subscriptions/delete/"+eachval,
            async: true,
            dataType: 'json',
           // data: data,
            success: function() {
          $(this).remove();
            }
          });
                      //remove row when animation is finished
        });
      }
    });
    $('#alertMsg').parent('div').show();
    $('#alertMsg').html('Selected items are deleted');
    }else{
        sel = true;   
    }
     
       return false;
  }
    if(!sel) alert('No data selected');             //alert to no data selected
  });


  









 $('.stdtable td').on('click',"a.label-success",function(){
   
  var currel=$(this);
     var inactiveurl=$(this).attr("href");
 var curTr=$(this).parents("tr");

 
 if(confirm('Are you sure want to approve this?'))    {

  curTr.fadeIn(function(){ 

      $.ajax({
            type: 'POST',
            url: inactiveurl,
            async: true,
            dataType: 'json',
           // data: data,
            success: function() {
             
             currel.siblings('a').remove();
              currel.text('Approved');
              var newurl=inactiveurl.replace("inactive", "revoke");
              var newelm='&nbsp;<a title="Disapprove" href="'+newurl+'" class="label-warning">Disapprove</a>';
              currel.after(newelm);
            }
          });
        
  $('#alertMsg').parent('div').removeClass('hide');
$('#alertMsg').parent('div').show();
    $('#alertMsg').html('Selected items are approved');
       });
        }
  
    
    return false;
  });


 $('.stdtable td').on('click',"a.label-warning",function(){
   
  var currel=$(this);
     var revokeurl=$(this).attr("href");
 var curTr=$(this).parents("tr");
 var curTd=$(this).parents("td");
 
 
 if(confirm('Are you sure want to Disapprove this?')) { 
  curTr.fadeIn(function(){ 
//$.colorbox({href:"#disapprove_details",inline:true, open:true,width:"25%"});
$('#disapprove_details').modal('show');
 


$("#disapprove_sub").validate({
   submitHandler: function() { 

     $.ajax({
            type: 'POST',
            url: revokeurl,
            async: true,
            dataType: 'json',
            data: $("#disapprove_sub").serialize(),
              beforeSend: function() {
                $("#disapprove_sub .loding").show();
              },
            success: function() {
             $("#disapprove_sub .loding").hide();
            
               $('#disapprove_details').modal('hide');
            currel.parent('td').empty();
              
              var newurl=revokeurl.replace("revoke", "active");
               var new_url=revokeurl.replace("revoke", "inactive");
  
     var newelm='<a title="Approve" href="'+newurl+'" class="label-success">Approve</a>';
      var new_elm='&nbsp;<a title="Cancel" href="'+new_url+'" class="label-danger">Cancel</a>';
    curTd.html(newelm+new_elm);
       $('#alertMsg').parent('div').removeClass('hide');
     $('#alertMsg').parent('div').show();
    $('#alertMsg').html('Selected items are Disapproved');

            }
          });
     return false;   
   }
});


        

       });
        };
  
    
    return false;
  });

 $('.stdtable td').on('click',"a.label-danger",function(){

  var currel=$(this);
     var activeurl=$(this).attr("href");
      var curTr=$(this).parents("tr");
     
       
       
  if(confirm('Are you sure you want to cancel this?')) { 
    curTr.fadeIn(function(){ 
$('#cancel_details').modal('show');
   // $.colorbox({href:"#cancel_details",inline:true, open:true,width:"25%"});


$("#cancellation_sub").validate({
   submitHandler: function() { 

     $.ajax({
            type: 'POST',
            url: activeurl,
            async: true,
            dataType: 'json',
            data: $("#cancellation_sub").serialize(),
              beforeSend: function() {
                $("#cancellation_sub .loding").show();
              },
            success: function() {
             $("#cancellation_sub .loding").hide();
             $('#cancel_details').modal('hide');
             currel.siblings('a').remove();
              currel.text('Cancelled');
       $('#alertMsg').parent('div').removeClass('hide');
     $('#alertMsg').parent('div').show();
    $('#alertMsg').html('Selected items are Cancelled');

            }
          });
     return false;   
   }
});


     
      
        
 });

       };
    
    return false;
  });

   })
</script>