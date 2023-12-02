<!--leftmenu-->
<?php $this->load->view('common/leftmenu');?>
<!--leftmenu-->
        
  <?php if(isset($success_msg) && $success_msg!=null){ ?>
              <div class="alert alert-danger text-center hide">
                        <a class="close"></a>
                        <p> <?php echo $success_msg; ?></p>
                    </div>
                    <?php } ?>
<div class="alert alert-success text-center hide"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  
                        <p id="alertMsg"></p>
                    </div>

         <div id="page_content">
        <div id="page_content_inner">

            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-2-10">
                            <label for="product_search_name">Page Title</label>
                            <input type="text" class="md-input" id="product_search_name">
                        </div>
                        <div class="uk-width-medium-2-10">
                            <label for="product_search_price">Expected Url</label>
                            <input type="text" class="md-input" id="product_search_price">
                        </div>
                        <div class="uk-width-medium-3-10">
                            <div class="uk-margin-small-top">
                                <select id="product_search_status" data-md-selectize multiple data-md-selectize-bottom>
                                    <option value="">Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-10">
                            <div class="uk-margin-top uk-text-nowrap">
                                <input type="checkbox" name="product_search_active" id="product_search_active" data-md-icheck/>
                                <label for="product_search_active" class="inline-label">Active</label>
                            </div>
                        </div>
                        <div class="uk-width-medium-2-10 uk-text-center">
                            <a href="#" class="md-btn md-btn-primary uk-margin-small-top">Filter</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md-card">
                <div class="md-card-content">
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                         <form method="post" id="form_submit" name="form_submit"> 
                 <input type="hidden" id="hdnMethod" name="hdnMethod">
                            <div class="uk-overflow-container">
                                <table class="uk-table">
                                    <thead>
                                        <tr>
                                         <th>
                                <div class="uk-margin-top uk-text-nowrap">
                                <input type="checkbox" name="product_search_active" id="product_search_active" data-md-icheck/>

                                </div>
                                         </th>
                                            <th>S.No</th>
                                            <th>Page Title</th>
                                            <th>Expected Url</th>
                                            <th>User Name</th>
                                            <th>Status</th>
                                            <th>Add Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php if($all_pages['num_rows']>0){ $s=0; for ($i=0; $i <$all_pages['num_rows'] ; $i++) {  ?> 
                                        <tr>
                                         <td>
                                         <div class="uk-margin-top uk-text-nowrap">
                                <input type="checkbox" name="Checkall[]"  value="<?php echo $all_pages['results'][$i]['id'];?>" data-md-icheck/>

                                </div>

                           
                         
                          </td>
                                         <td><?php echo ($s+1);?></td>
                                            
                                             <td><?php echo ($all_pages['results'][$i]['page_title']!=null)?$all_pages['results'][$i]['page_title']:'N/A';?></td>
                                              <td><?php echo ($all_pages['results'][$i]['expect_url']!=null)?$all_pages['results'][$i]['expect_url']:'N/A';?></td>
                                               <td><?php echo ($all_pages['results'][$i]['user_id']!=null)?$all_pages['results'][$i]['user_id']:'N/A';?></td>
                                                <td class="uk-text-nowrap"><span class="uk-badge <?php echo ($all_pages['results'][$i]['status']=='Active')?'uk-badge-success':'uk-badge-danger';?>"><?php echo ($all_pages['results'][$i]['status']!=null)?$all_pages['results'][$i]['status']:'N/A';?></span></td>

                          <td><?php echo date('d M Y',strtotime($all_pages['results'][$i]['add_date']));?></td> 
                                           
                                         
                                            <td class="uk-text-nowrap">
                                              <a href="<?php echo base_url('pages/edit/'.$all_pages['results'][$i]['id']);?>"><i class="md-icon material-icons"></i></a>
                                                <a href="<?php echo base_url('pages/view/'.$all_pages['results'][$i]['id']);?>"><i class="material-icons md-24">&#xE8F4;</i></a>
                                              
                                               <!-- <a href="#"><i class="material-icons md-24">&#xE872;</i></a> -->
                                            </td>
                                        </tr>
                                        <?php $s++; } } ?>
                                    </tbody>
                                </table>
                            </div>
                            </form>
                            <!-- <ul class="uk-pagination uk-margin-medium-top uk-margin-medium-bottom">
                                <li class="uk-disabled"><span><i class="uk-icon-angle-double-left"></i></span></li>
                                <li class="uk-active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><span>&hellip;</span></li>
                                <li><a href="#">20</a></li>
                                <li><a href="#"><i class="uk-icon-angle-double-right"></i></a></li>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

      <div class="md-fab-wrapper">
    <a class="md-fab md-fab-accent" href="<?php echo base_url('pages/add/');?>" >
        <i class="material-icons"></i>
    </a>
</div>
       

       
          
          
               
               
               
                  
                         
                         
                           
                         <!--    <td>
                              <?php if($all_pages['results'][$i]['payment_status']=='Approved'){ ?>
                      <a title="Approved" href="javascript:;" class='label label-success'><?php echo $all_pages['results'][$i]['payment_status'];?></a>
                              <?php } elseif($all_pages['results'][$i]['payment_status']=='Rejected'){ ?>
                      <a title="Rejected" href="javascript:;" class='label label-danger'><?php echo $all_pages['results'][$i]['payment_status'];?></a>
                             
                                                    <?php } else{ ?> 
 <a title="Approve" href="<?php echo base_url('bank_transefers/active')."/".$all_pages['results'][$i]['transfer_id'];?>" class='label label-success'>Approve</a>
  &nbsp;<a title="Reject" href="<?php echo base_url('bank_transefers/inactive')."/".$all_pages['results'][$i]['transfer_id'];?>" class='label label-danger'>Reject</a>
   <?php } ?>
                              </td> -->
                            
                      
                        <a href="<?php echo base_url('bank_transefers/add');?>" class="btn btn-info">Add Bank Transfers</a>
             
  
                        
             
               
          
             
              

               
               
       
    

<script type="text/javascript">
  jQuery(document).ready(function(){




 jQuery('.table td').on('click',"a.label-success",function(){
   
  var currel=jQuery(this);
     var inactiveurl=jQuery(this).attr("href");
 var curTr=jQuery(this).parents("tr");

 
 if(confirm('Are you sure want to approve this?')) {
  curTr.fadeIn(function(){ 

      jQuery.ajax({
            type: 'POST',
            url: inactiveurl,
           // async: true,
            //dataType: 'json',
           // data: data,
            success: function() {
             
             currel.siblings('a').remove();
              currel.text('Approved');
      //var newurl=inactiveurl.replace("inactive", "active");
    
      //currel.attr('href',newurl);
            }
          });
        
  $('#alertMsg').parent('div').removeClass('hide');
jQuery('#alertMsg').parent('div').show();
    jQuery('#alertMsg').html('Selected items are Approved');
       });
        }
  
    
    return false;
  });

 jQuery('.table td').on('click',"a.label-danger",function(){

  var currel=jQuery(this);
     var activeurl=jQuery(this).attr("href");
      var curTr=jQuery(this).parents("tr");
      
       
       
  if(confirm('Are you sure you want to reject this?')) {
    curTr.fadeIn(function(){ 
      jQuery.ajax({
            type: 'POST',
            url: activeurl,
            //async: true,
            //dataType: 'json',
           // data: data,
            success: function() {
             currel.siblings('a').remove();
           
              currel.text('Rejected');
     // var newurl=activeurl.replace("active", "inactive");
     
      //currel.attr('href',newurl);
            }
          });
        $('#alertMsg').parent('div').removeClass('hide');
      jQuery('#alertMsg').parent('div').show();
    jQuery('#alertMsg').html('Selected items are Rejected');
        
 });

       }
    
    return false;
  });

   })
</script>