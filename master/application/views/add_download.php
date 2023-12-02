<!--leftmenu-->
<?php $this->load->view('leftmenu');?>
<!--leftmenu-->
<?php

        

                    if($this->router->fetch_method()=='edit') { 
                         $product_id=$edit_products['product_id'];
                        $download_title=$edit_products['download_title'];
                        $download_name=$edit_products['download_name'];
                      $latest_release=$edit_products['latest_release'];
                       $downloadable=$edit_products['downloadable'];
                       
                    }else{
                          $product_id=set_value('product_id');
                          $download_title=set_value('download_title');
                          $download_name=set_value('download_name');
                          $latest_release=$this->input->post('latest_release');
                           $downloadable=$this->input->post('downloadable');
                          
                      
                        
                    }
                   ?>


<section class="col-sm-10 col-xs-12">
      <div class="clearfix">
       <?php  echo validation_errors('<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');  ?>
            
            <?php echo ($error_msg!='')?'<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$error_msg.'</p></div>':''; ?>
<?php echo ($success_msg!='')?'<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$success_msg.'</p></div>':''; ?>

          <?php $attributes = array('class' => 'stdform stdform2', 'id' => 'add_product','novalidate' => 'novalidate','method' => 'post');

echo form_open('', $attributes); ?>

        <div class="clearfix subTitleForHead">
          <h2 class="pull-left"><?php echo ucfirst($this->router->fetch_method());?> Download</h2>
          <div class="col-sm-2 pad-null pull-right">
           <?php
$product_options = array();

$product_options =$products_all;
$product_options[''] ='Select';
  $other_attr = 'id="product_id" class="form-control" required="required"';
echo form_dropdown('product_id', $product_options, $product_id,$other_attr);
?>

           
          </div>
        </div>
        <div class="clearfix">
          <div class="discount downloadEdit clearfix">
            <div class="col-sm-4 form-group">
              <label for="">Version Name</label>
             <?php   
$download_title_data = array(
'name'        => 'download_title',
'id'          => 'download_title',
'value'       => $download_title,
'class'   => 'form-control',
'required'        => 'required'

);

echo form_input($download_title_data);?>
            </div>
            <div class="col-sm-4 form-group">
              <label for="" class="ml15">File Names (Download files)</label>
              <span>
                <i class="fa fa-windows"></i> 
                <?php   
$download_name_data = array(
'name'        => 'download_name',
'id'          => 'download_name',
'value'       => $download_name,
'class'   => 'form-control',
'required'        => 'required'

);

echo form_input($download_name_data);
?>
              </span>
            </div>
            <div class="col-sm-2 form-group text-center">
              <label for="">Latest Release ?</label>
              <input type="checkbox" name="latest_release" value="Yes" <?php echo ($latest_release=='Yes')?'checked':'';?>>
            </div>

             <div class="col-sm-2 form-group text-center">
              <label for="">is Downloadable ?</label>
              <input type="checkbox" name="downloadable"  value="Yes" <?php echo ($downloadable=='Yes')?'checked':'';?> >
            </div>


            <div class="clearfix text-center col-xs-12">
             <?php
                  $but_data = array(
                  'class' => 'btn btn-primary',
                  'type' => 'submit',
                  'content' => 'Save'
                  );

                  echo form_button($but_data);
                    ?>
            <a  href="<?php echo base_url('downloads');?>"  class="btn btn-default"  />Cancel</a>
            </div>
          </div>
        </div>
        </form>
      </div>
    </section>
      </section>

    

