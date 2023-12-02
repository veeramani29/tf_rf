<!--leftmenu-->
 <?php $this->load->view('leftmenu');?>
 <!--leftmenu-->
        










        <section class="col-sm-10 col-xs-12">
      <div class="clearfix">
        <h2>Manage Mail Template</h2>
        <div class="clearfix">

         <?php if($success_msg!=null){ ?>
              <div class="alert alert-danger text-center hide">
                        <a class="close"></a>
                        <p> <?php echo $success_msg; ?></p>
                    </div>
                    <?php } ?>
<div class="alert alert-success text-center hide"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  
                        <p id="alertMsg"></p>
                    </div>

        <form method="post" id="form_submit" name="form_submit"> 
                 <input type="hidden" id="hdnMethod" name="hdnMethod">
          <div class="addDetails adminList">
            <table class="table table-condensed">
              <thead>
                <tr>
                          
                           <th>S.No</th>
                            <th>Mail Title</th>
                            <th>Mail Subject</th>
                            <th>Modified On</th>
                            <th>Status</th>
                          <th>Action</th>
                            
                        </tr>
              </thead>
              <tbody>
            <?php if($all_mails['num_rows']>0){ $s=0; for ($i=0; $i <$all_mails['num_rows'] ; $i++) {  ?> 
                        <tr>
                          
                          <td><?php echo ($s+1);?></td>
                            <td><?php echo ($all_mails['results'][$i]['mail_title']!=null)?$all_mails['results'][$i]['mail_title']:'N/A';?></td>
                            <td><?php echo ($all_mails['results'][$i]['mail_subject']!=null)?$all_mails['results'][$i]['mail_subject']:'N/A';?></td>
                           
                          <td ><?php echo date('d M Y',strtotime($all_mails['results'][$i]['modified_on']));?></td> 
                            <td>
                              <?php if($all_mails['results'][$i]['mail_status']=='Active'){ ?>
                              <a title="Active" href="javascript:;" class='label label-success'><?php echo $all_mails['results'][$i]['mail_status'];?></a>
                              <?php }else{ ?>
                              <a title="Inactive" href="javascript:;" class='label label-danger'><?php echo $all_mails['results'][$i]['mail_status'];?></a>
                              <?php } ?>
                           
                              </td>
          
                            
                             <td>

                             
                             
                             <a title="Edit" href="<?php echo base_url('mail_template/edit')."/".$all_mails['results'][$i]['mail_id'];?>" class="btn btn-primary btn-xs edit">Edit</a>
                          

                             </td> 
                           
                        </tr>
                     
                       <?php $s++; } } ?>
              </tbody>
            </table>
            
          </div>  
          </form>
        </div>
      </div>
    </section>
     </section>
  
        
  
                        
               
                
          
               

              
             
    
