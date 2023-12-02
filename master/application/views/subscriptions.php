

      <!--leftmenu-->
      <?php $this->load->view('leftmenu'); ?>
   <!--leftmenu-->

  <section class="col-sm-10 col-xs-12">
      <div class="clearfix">
        <div class="clearfix subTitleForHead">
          <h2 class="pull-left">Manage Subscriptions  <?php echo $product_title;?></h2>

          <div class="col-sm-2 pad-null pull-right">
          <label>Product</label>
           <form  id="change_form"  method="post" >
                        <input type="hidden" name="<?php  echo $this->security->get_csrf_token_name();?>" value="<?php  echo $this->security->get_csrf_hash();?>">


                        <?php
                                   $product_options = array();
                                   
                                   $product_options =$products_all;
                                    $product_options[''] ='All';
                                  
                                  $other_attr = 'id="product_id" class="form-control" required="required"';
                                  echo form_dropdown('product_id', $product_options, $product_id,$other_attr);
                                  ?>


</form>

           
          </div>
        </div>
        <div class="alert alert-success text-center hide"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p id="alertMsg"></p>
</div>
<div class="alert alert-danger text-center hide"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p id="errorMsg"></p>
</div>
        <div class="clearfix">
          <div class="addDetails adminList subscribe">
            <table class="table table-condensed blogtable">
              <thead>
                <tr>
                <th>S.No</th>
                <th>Product</th>
                <th>Subscriptions</th>
                <th>Discount</th>
                <th>Amount (<?php echo CURR_D;?>)</th>
                <th>Amount (<?php echo CURR_J;?>)</th>
                <th>Add date</th>
                <th>Action</th>

                </tr>
              </thead>
              <tbody>

              <?php if($all_subscriptions['num_rows']>0){ $s=0; for ($i=0; $i <$all_subscriptions['num_rows'] ; $i++) {  ?> 
        <tr>
         <!--    <td class="aligncenter"><input type="checkbox" name="" /></td> -->
              <td><?php echo ($s+1);?></td>
            <td >

 
           
       
            <?php echo $this->Subscriptions_Model->get_product_name($all_subscriptions['results'][$i]['product_id']);?>

            </td>
            <td ><?php echo $this->Subscriptions_Model->get_subscriptions_durtion($all_subscriptions['results'][$i]['subscription_duration']);?></td>
            <td ><?php echo ($all_subscriptions['results'][$i]['subscription_discount']!=null)?$all_subscriptions['results'][$i]['subscription_discount']." %":'N/A';?></td>
            <td><?php $type=($all_subscriptions['results'][$i]['currency']=='1')?CURR_D:CURR_J;  echo ($all_subscriptions['results'][$i]['subscription_cost']!=null)?$all_subscriptions['results'][$i]['subscription_cost']:'N/A';?></td>
            <td><?php $type=($all_subscriptions['results'][$i]['currency']=='1')?CURR_D:CURR_J;  echo ($all_subscriptions['results'][$i]['subscription_cost_yen']!=null)?$all_subscriptions['results'][$i]['subscription_cost_yen']:'N/A';?></td>
             <td ><?php echo date('d M Y',strtotime($all_subscriptions['results'][$i]['added_on']));?></td>
            <td class="actions aligncenter">
            <a title="Edit" href="javascript:;"  class="btn btn-primary btn-xs quickview_edit">Edit</a> 
<a title="Save" id="<?php echo $all_subscriptions['results'][$i]['subscription_id'];?>" href="<?php echo base_url('subscriptions/edit')."/".$all_subscriptions['results'][$i]['subscription_id'];?>" style="display: none;" class="btn btn-success btn-xs Save">Save</a> 
              <!--   <a title="Edit" href="<?php echo base_url('ajax/subscription_edit/')."/".$all_subscriptions['results'][$i]['subscription_id'];?>"  class="quickview">Edit</a>  -->
                <?php if($all_subscriptions['results'][$i]['subscription_status']=='Active'){ ?>
 <a title="Active" msgtitle="Subscriptions" href="<?php echo base_url('subscriptions/inactive/')."/".$all_subscriptions['results'][$i]['subscription_id'];?>" class="label label-success"><?php echo $all_subscriptions['results'][$i]['subscription_status'];?></a>

                <?php }else{ ?>
 <a title="Inactive" msgtitle="Subscriptions" href="<?php echo base_url('subscriptions/active/')."/".$all_subscriptions['results'][$i]['subscription_id'];?>" class="label label-danger"><?php echo $all_subscriptions['results'][$i]['subscription_status'];?></a>

                  <?php } ?>

<a title="Cancel" style="display: none;"  class="Cancel">Cancel</a> 
               
                <!-- <a title="Delete" msgtitle="Subscriptions" href="<?php echo base_url('subscriptions/delete/')."/".$all_subscriptions['results'][$i]['subscription_id'];?>" class="btn btn-primary btn-xs delete">Delete</a> -->
            </td>
        </tr>
         <?php $s++; } } else { ?> 
<tr>
          
            <td colspan="7" class="text-danger text-center">
               Subscriptions is not found
            </td>
        </tr>
          <?php } ?>
</tbody>
            </table>
          </div>  
          <div class="text-center form-group">
            <a href="<?php echo base_url('subscriptions/add');?>" class="btn btn-info">Add new Subscription</a>
          </div>
        </div>
      </div>
    </section>
 </section>


    
<script type="text/javascript">



 $(".blogtable").on("click", "tbody td a.Save", function (e) {

            e.preventDefault();

   var $each_item = $(this).closest("tr");
      if($each_item.find('#product_id').val()==''){
            $('#errorMsg').parent('div').removeClass('hide');
            $('#errorMsg').parent('div').show();
            $('#errorMsg').html('Please select product');
       $each_item.find('#product_id').focus();
      return false;
      }

      if($each_item.find('#subscription_duration').val()==''){
        $('#errorMsg').parent('div').removeClass('hide');
        $('#errorMsg').parent('div').show();
            $('#errorMsg').html('Please select subscription');
       $each_item.find('#subscription_duration').focus();
      return false;
      }

      if($each_item.find('#subscription_discount').val()==''){
        $('#errorMsg').parent('div').removeClass('hide');
        $('#errorMsg').parent('div').show();
            $('#errorMsg').html('Please enter subscription discount');
       $each_item.find('#subscription_discount').focus();
      return false;
      }

      if($each_item.find('#subscription_cost').val()==''){
        $('#errorMsg').parent('div').removeClass('hide');
        $('#errorMsg').parent('div').show();
            $('#errorMsg').html('Please enter subscription amount in $');
      $each_item.find('#subscription_cost').focus();
      return false;
      }

       if($each_item.find('#subscription_cost_yen').val()==''){
        $('#errorMsg').parent('div').removeClass('hide');
        $('#errorMsg').parent('div').show();
            $('#errorMsg').html('Please enter subscription amount in ¥');
      $each_item.find('#subscription_cost_yen').focus();
      return false;
      }

      

     /* if($each_item.find('#currency').val()==''){
        $('#errorMsg').parent('div').removeClass('hide');
        $('#errorMsg').parent('div').show();
            $('#errorMsg').html('Please select currency');
      $each_item.find('#currency').focus();
      return false;
      }*/
        var product_id=$each_item.find('#product_id').val();
        var subscription_duration=$each_item.find('#subscription_duration').val();
        var subscription_discount=$each_item.find('#subscription_discount').val();
        var subscription_cost=$each_item.find('#subscription_cost').val();
        var subscription_cost_yen=$each_item.find('#subscription_cost_yen').val();
         var currency=$each_item.find('#currency').val();
             $(this).hide();
   $each_item.find('a.quickview_edit').show();
   
  var action = $(this).attr('href');
  if(product_id!=null){
 $.ajax({
        type: "POST",
        url: action,
        data: { product_id: product_id, subscription_duration: subscription_duration,subscription_discount:subscription_discount,subscription_cost:subscription_cost,subscription_cost_yen:subscription_cost_yen,currency:currency },
        dataType: "json",
        beforeSend: function(XMLHttpRequest){
        $(this).closest("td").text('Please wait');
        
          },
        success: function(response){
          if(response==100){
            $('#errorMsg').parent('div').removeClass('hide');
            $('#errorMsg').parent('div').show();
            $('#errorMsg').html('This subscriptions already added this product.');
            $('a.Save').show();
           $('a.quickview_edit').hide();
          }else if(response!=''){
           var $item1 = $each_item.find('td:eq(1)').html(response.product);
           var $item2 = $each_item.find('td:eq(2)').html(response.subscription_duration);
           var $item3 = $each_item.find('td:eq(3)').html(response.subscription_discount+' %');
           var $item4 = $each_item.find('td:eq(4)').html(response.subscription_cost);
          var $item5 = $each_item.find('td:eq(5)').html(response.subscription_cost_yen);
            $('#errorMsg').parent('div').hide();
            $('#alertMsg').parent('div').removeClass('hide');
           $('#alertMsg').parent('div').show();
            $('#alertMsg').html('Successfully edited selected subscription');
            
          }
           
        }
      });
}
     

  });
<?php
$product_options1 = array();
$product_options1 =$products_all;
 $product_options1[''] ='Select';
$other_attr1 = 'id="product_id" class="form-control" required="required"';
  $Subscription_options =unserialize(SUB_DURATION);
$other_attr = 'id="subscription_duration" class="form-control" required="required"';
                                
                                ?>

        var sbs_dropdown='<?php echo preg_replace( "/\r|\n/", "", trim(form_dropdown('subscription_duration', $Subscription_options, '',$other_attr)));?>';
        var pro_dropdown='<?php echo preg_replace( "/\r|\n/", "", trim(form_dropdown('product_id', $product_options1, '',$other_attr1)));?>';
       


  $(".blogtable").on("click", "tbody td a.quickview_edit", function (e) {

    var $each_item = $(this).closest("tr");
        $(this).hide();
       $each_item.find('a.Save').show();
      // $each_item.find('a.Cancel').show();
       
    var $pro_text = $.trim($each_item.find('td:eq(1)').text());
    var $subs_text = $.trim($each_item.find('td:eq(2)').text());



    var $item1 = $each_item.find('td:eq(1)').html(pro_dropdown);
    var $item2 = $each_item.find('td:eq(2)').html(sbs_dropdown);
    var $item3 = $each_item.find('td:eq(3)').html('<input type="text" class="form-control" name="subscription_discount" value="'+parseInt($each_item.find('td:eq(3)').text())+'" id="subscription_discount" required="required" >');


    if ($each_item.find('td:eq(4)').text().toLowerCase().indexOf("¥") >= 0)
    {
    $selected='selected';
    $selected1='';
    }else{
    $selected1='selected';
    $selected='';
    }

var amountinput='<input type="text" class="form-control" name="subscription_cost" value="'+parseInt($each_item.find('td:eq(4)').text())+'" id="subscription_cost" required="required" >';
var amountinput_yen='<input type="text" class="form-control" name="subscription_cost_yen" value="'+parseInt($each_item.find('td:eq(5)').text())+'" id="subscription_cost_yen" required="required" >';
  var currency='<select name="currency" id="currency" class="form-control" required="required"><option value="">Select</option><option value="1" '+$selected1+' >$</option><option '+$selected+' value="2">¥</option></select>';


    var $item4 = $each_item.find('td:eq(4)').html(amountinput);
 var $item5 = $each_item.find('td:eq(5)').html(amountinput_yen);


 $('#subscription_duration option').each(function () {

 var pattern = new RegExp("^"+$subs_text.substring(0,3)+"");
var each_text=$.trim($(this).text());

        if (each_text.match(pattern)) {
           
           $(this).attr('selected', 'selected')
        };
    });

 $('#product_id option').each(function () {

 var pattern = new RegExp("^"+$pro_text+"");
var each_text=$.trim($(this).text());

        if (each_text.match(pattern)) {
           
           $(this).attr('selected', 'selected')
        };
    });
 $subs_text='';
  $pro_text='';
    } );
  

$('#product_id').change(function(){
     $('#change_form').submit();

});

     $('.blogtable td').on('click',"a.label-success",function(){
   
  var currel=$(this);
     var inactiveurl=$(this).attr("href");
 var curTr=$(this).parents("tr");
  if(confirm('Are you sure want to inactive this?')) {
 


      $.ajax({
            type: 'POST',
            url: inactiveurl,
            //async: true,
           // dataType: 'json',
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
$('#alertMsg').parent('div').show();
    $('#alertMsg').html('Selected items are activated');
      
        };
  
    
    return false;
  });

 $('.blogtable td').on('click',"a.label-danger",function(){

  var currel=$(this);
     var activeurl=$(this).attr("href");
      var curTr=$(this).parents("tr");
      if(confirm('Are you sure you want to active this?')) {
       
       
 
      $.ajax({
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
      $('#alertMsg').parent('div').show();
    $('#alertMsg').html('Selected items are inactivated');
        


       }
    
    return false;
  });

   
    


  
</script>




