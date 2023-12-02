


      <!--leftmenu-->
      <?php $this->load->view('leftmenu'); ?>
   <!--leftmenu-->

<section class="col-sm-10 col-xs-12">
      <div class="clearfix">
        <div class="clearfix subTitleForHead">
          <h2 class="pull-left">Manage Downloads - <?php echo $product_title;?> </h2>
          <div class="col-sm-2 pad-null pull-right">
          <label>Product</label>
            <form  id="change_form"  method="post" >
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
        <div class="clearfix">

<?php  echo validation_errors('<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');  ?>
<?php echo ($error_msg!='')?'<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$error_msg.'</p></div>':''; ?>
<?php echo ($success_msg!='')?'<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>><p>'.$success_msg.'</p></div>':''; ?>

<div class="alert alert-success text-center hide"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p id="alertMsg"></p>
</div>
<div class="alert alert-danger text-center hide"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<p id="errorMsg"></p>
</div>

         

        <div class="clearfix">
          <?php if($all_Downloads['num_rows']>0){ $s=0; for ($i=0; $i <$all_Downloads['num_rows'] ; $i++) {  ?> 
          <div class="discount download">
            <table class="table table-condensed blogtable">
              <tbody>
              
        <tr>
          <!--   <td class="aligncenter"><input type="checkbox" name="" /></td> 
              <td><?php echo ($s+1);?></td>-->
            <td><?php echo $this->Subscriptions_Model->get_product_name($all_Downloads['results'][$i]['product_id']);?></td>
            <td><?php echo ($all_Downloads['results'][$i]['download_title']!=null)?$all_Downloads['results'][$i]['download_title']:'N/A';?></td>
            <td><i class="fa fa-windows"></i> <?php echo ($all_Downloads['results'][$i]['download_name']!=null)?$all_Downloads['results'][$i]['download_name']:'N/A';?> </td>
            <td>Latest release ? <br> <b><?php echo ($all_Downloads['results'][$i]['latest_release']!=null)?$all_Downloads['results'][$i]['latest_release']:'N/A';?></b></td>
            <td>Downloadable ? <br>  <b><?php echo ($all_Downloads['results'][$i]['downloadable']!=null)?$all_Downloads['results'][$i]['downloadable']:'N/A';?></b></td>
            <td><?php echo date('d M Y',strtotime($all_Downloads['results'][$i]['added_on']));?></td>
            <td class="actions aligncenter">
                <!--<a title="Edit" href="<?php echo base_url('ajax/download_edit/')."/".$all_Downloads['results'][$i]['download_id'];?>" class="quickview">Edit</a> 
                 <a title="Delete" msgtitle="Downloads" href="<?php echo base_url('downloads/delete/')."/".$all_Downloads['results'][$i]['download_id'];?>" class="delete">Delete</a> -->
                 <a title="Edit" href="javascript:;"  class="btn btn-primary btn-xs quickview_edit">Edit</a> 
                 <a title="Save" id="<?php echo $all_Downloads['results'][$i]['download_id'];?>" href="<?php echo base_url('downloads/edit')."/".$all_Downloads['results'][$i]['download_id'];?>" style="display: none;" class="btn btn-success btn-xs Save">Save</a>
                  
             <?php if($all_Downloads['results'][$i]['download_status']=='Active'){ ?>
                              <a title="Active" href="<?php echo base_url('downloads/inactive')."/".$all_Downloads['results'][$i]['download_id'];?>" class='label label-success'><?php echo $all_Downloads['results'][$i]['download_status'];?></a>
                              <?php }else{ ?>
                              <a title="Inactive" href="<?php echo base_url('downloads/active')."/".$all_Downloads['results'][$i]['download_id'];?>" class='label label-danger'><?php echo $all_Downloads['results'][$i]['download_status'];?></a>
                              <?php } ?>

            </td>
               </tr>
            <!-- <tr class="hide">
            <td colspan="7"> <div class="discount downloadEdit clearfix">
            <div class="col-sm-2 form-group">
              <label for="">Product</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-sm-2 form-group">
              <label for="">Title</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-sm-4 form-group">
              <label for="" class="ml15">File Names (Download files)</label>
              <span>
                <i class="fa fa-windows"></i> <input type="text" class="form-control">
              </span>
            </div>
            <div class="col-sm-2 form-group text-center">
              <label for="">Latest Release ?</label>
              <input type="radio">
            </div>
             <div class="col-sm-2 form-group text-center">
              <label for="">Downloadable  ?</label>
              <input type="radio">
            </div>
            <div class="clearfix text-center col-xs-12">
              <button class="btn btn-primary">Save</button>
            </div>
          </div></td>
        </tr> -->
          </tbody>
            </table>
          </div>
         <?php $s++; } } else { ?> 

           <div class="discount download">
            <table class="table table-condensed">
            <h3  class="text-danger text-center"> Downloads is not found </h3>
          
       </div>
          <?php } ?>
            
           <div class="clearfix form-group text-center">
            <a href="<?php echo base_url('downloads/add');?>" class="btn btn-info">Add new download</a>
          </div>
          
        </div>
      </div>
    </div>
    </section>
</section>
  

  
    
    
<script type="text/javascript">



 jQuery(".blogtable").on("click", "tbody td a.Save", function (e) {

            e.preventDefault();

        var $each_item = jQuery(this).closest("tr");
      if($each_item.find('#product_id').val()==''){
          $('#errorMsg').parent('div').removeClass('hide');
        jQuery('#errorMsg').parent('div').show();
            jQuery('#errorMsg').html('Please select product');
        $each_item.find('#product_id').focus();
      return false;
      }

      if($each_item.find('#download_title').val()==''){
          $('#errorMsg').parent('div').removeClass('hide');
        jQuery('#errorMsg').parent('div').show();
            jQuery('#errorMsg').html('Please enter version name');
      $each_item.find('#download_title').focus();
      return false;
      }

      if($each_item.find('#download_name').val()==''){
          $('#errorMsg').parent('div').removeClass('hide');
        jQuery('#errorMsg').parent('div').show();
            jQuery('#errorMsg').html('Please enter file name');
      $each_item.find('#download_name').focus();
      return false;
      }

     
        var product_id=$each_item.find('#product_id').val();
        var download_title=$each_item.find('#download_title').val();
        var download_name=$each_item.find('#download_name').val();
        var latest_release=($each_item.find('#latest_release').is(':checked'))?$each_item.find('#latest_release').val():'';
         var downloadable=($each_item.find('#downloadable').is(':checked'))?$each_item.find('#downloadable').val():'';
  jQuery(this).hide();
   $each_item.find('a.quickview_edit').show();
   
  var action = jQuery(this).attr('href');
  if(product_id!=null){
 jQuery.ajax({
        type: "POST",
        url: action,
        data: { product_id: product_id, download_title: download_title,download_name:download_name,latest_release:latest_release,downloadable:downloadable },
        dataType: "json",
        beforeSend: function(XMLHttpRequest){
        jQuery(this).closest("td").text('Please wait');
        
          },
        success: function(response){
          if(response==2){
        jQuery('#errorMsg').parent('div').show();
            jQuery('#errorMsg').html('This Version Name already exist');
            jQuery('a.Save').show();
           jQuery('a.quickview_edit').hide();
          }else if(response!=''){
           var $item1 = $each_item.find('td:eq(0)').html(response.product);
           var $item2 = $each_item.find('td:eq(1)').html(response.download_title);
           var $item3 = $each_item.find('td:eq(2)').html('<i class="fa fa-windows"></i> '+response.download_name);
           var $item4 = $each_item.find('td:eq(3)').html('Latest release ?<br> <b>'+response.latest_release+'</b>');
            var $item5 = $each_item.find('td:eq(4)').html('Downloadable ?<br> <b>'+response.downloadable+'</b>');
          
            jQuery('#errorMsg').parent('div').hide();
             $('#alertMsg').parent('div').removeClass('hide');
           jQuery('#alertMsg').parent('div').show();
            jQuery('#alertMsg').html('Successfully edited selected downloads');
            
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

                                ?>

        var pro_dropdown='<?php echo preg_replace( "/\r|\n/", "", trim(form_dropdown('product_id', $product_options1, '',$other_attr1)));?>';
       


  jQuery(".blogtable").on("click", "tbody td a.quickview_edit", function (e) {

    var $each_item = jQuery(this).closest("tr");
        jQuery(this).hide();
       $each_item.find('a.Save').show();
      // $each_item.find('a.Cancel').show();
       
    var $pro_text = jQuery.trim($each_item.find('td:eq(0)').text());
    var $version_text = jQuery.trim($each_item.find('td:eq(1)').text());
     var $download_name = jQuery.trim($each_item.find('td:eq(2)').text());
    
    var $item1 = $each_item.find('td:eq(0)').html(pro_dropdown);
    var $item2 = $each_item.find('td:eq(1)').html('<input type="text" class="form-control" name="download_title" value="'+$version_text+'" id="download_title" required="required" >');
    var $item3 = $each_item.find('td:eq(2)').html('<input type="text" class="form-control" name="download_name" value="'+$download_name+'" id="download_name" required="required" >');

    $selected1=''; $selected='';

    if ($each_item.find('td:eq(3) b').text()=='Yes')
    {

    $selected='checked';
   }
    if($each_item.find('td:eq(4) b').text()=='Yes'){
    $selected1='checked';
   
    }
      var $item4 = $each_item.find('td:eq(3)').html('<label>Latest release ?</label> <br><input type="checkbox" name="latest_release" value="Yes" '+$selected+' id="latest_release"  >');
      var $item5 = $each_item.find('td:eq(4)').html('<label>Downloadable ?</label> <br><input type="checkbox" name="downloadable" value="Yes" '+$selected1+' id="downloadable"  >');

 jQuery('#product_id option').each(function () {
var pattern = new RegExp("^"+$pro_text+"");
var each_text=jQuery.trim(jQuery(this).text());
if (each_text.match(pattern)) {
  jQuery(this).attr('selected', 'selected')
        };
    });

  $pro_text='';
    } );


/*jQuery('.add_subs').click(function(){
     jQuery('#add_subs').show();
     jQuery("#add_subscription_duration").spinner({});
    
});*/
jQuery('#product_id').change(function(){
     jQuery('#change_form').submit();
    
});

 /*  jQuery('.quickformbutton .cancel_subs').live('click', function(){
       jQuery('#add_subs').hide();
        return false;
    });*/

    jQuery('.blogtable td').on('click',"a.label-success",function(){
   
  var currel=jQuery(this);
     var inactiveurl=jQuery(this).attr("href");
 var curTr=jQuery(this).parents("tr");

 
 if(confirm('Are you sure want to inactive this?')){ 

      jQuery.ajax({
            type: 'POST',
            url: inactiveurl,
           // async: true,
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
        

jQuery('#alertMsg').parent('div').show();
    jQuery('#alertMsg').html('Selected items are activated');
      
        };
  
    
    return false;
  });

 jQuery('.blogtable td').on('click',"a.label-danger",function(){

  var currel=jQuery(this);
     var activeurl=jQuery(this).attr("href");
      var curTr=jQuery(this).parents("tr");
       if(confirm('Are you sure want to active this?')){ 
    
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
      jQuery('#alertMsg').parent('div').show();
    jQuery('#alertMsg').html('Selected items are inactivated');
        


       };
    
    return false;
  });
</script>
