<?php $this->load->view('common/header'); ?>
<style>
.margbotm15{
margin-bottom:15px;
}
</style>

<!-- CONTENT -->
<div class="dash_container">
    <div class="container martopbtm">
        <div class="tab-content5">
           
           
           
           <div class="tab-pane rfboxed-background " id="">
           
  <div class="col-md-12">
  <?php if(isset($suc_msg) && $suc_msg!=null){ ?>
<h6 style="color:green;" class="text-center"><?php echo $suc_msg;?> </h6>
<?php } ?>
   <h4 class="text-center"><?php echo lang_line('MORE_THAN_PERSON_REQ');?> </h4>
 <br>
   
    <form id="more_persons" name="more_persons" method="post">
     <h4><?php echo lang_line('contact_detais');?></h4>
      <div class="col-md-12">
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('lead_contact');?> * :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input minlength="4" type="text" class="form-control" name="lead_cont_name" id="lead_cont_name" required/>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('company_name');?> :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control" name="company_name" id="company_name"  />
          
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('gender');?> * :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <select class="form-control" name="gender" id="gender" required>
            <option value="Male" ><?php echo lang_line('MALE');?></option>
            <option value="Female" ><?php echo lang_line('FEMALE');?></option>
          </select>
          
        </div>
        
        <div class="col-md-6">
        
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('address');?>* :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control" name="address" id="address"  required/>
          </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('zip_code');?> * :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control" name="zip_code" id="zip_code"  required/>
         </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('tele_phone');?> * :</div>
        </div>
        
            <div class="col-lg-9 padding-left-null">
              <input maxlength="100" type="text"  name="phone"  required="required" class="form-control" id="phone" />
            </div>
        
        </div>
        
         <div class="col-md-6">
         <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('NR');?> * :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control" name="nr" id="nr"  required/>
          </div>
          
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('place');?> * :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control" name="place" id="place"  required/>
          </div>
        
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('mobile_num');?> :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control" name="mobile" id="mobile"  required/>
          </div>
        
         </div>
         
         <div class="col-md-12">
         <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('More_Eail');?> * :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="email" class="form-control" name="email"   required/>
          </div>
          
          <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('More_Confo_Eail');?> * :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="email" class="form-control" name="email"   required/>
          </div>
        </div>
     
        
         <div class="col-md-6">
<h4><?php echo lang_line('Your_trip');?></h4>
         <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('flying_from');?>:</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <input type="text" class="form-control fromflight " name="from"  id="from"  />
          </div>
          
          <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('flying_from_date');?> :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control " name="departure_date" id="m_departure" placeholder="MM/DD/YYYY"  />
          </div>                                             
<div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"> <?php echo lang_line('flying_from_time');?> :</div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 margbotm15">
         <select name="depature_time" class="form-control full_width input_caretdown"> 
                        <?php  for($i = 0; $i <= 24; $i++){?>
                        <option <?php echo (date("H")==$i)?"selected":'';?> value="<?php echo ($i<10)?"0".$i:$i; ?>"><?php echo ($i<10)?"0".$i:$i; ?></option>
                        <?php }?>
                      </select>
          </div>
<div class="col-lg-4 col-md-4 col-sm-12 margbotm15">
 <select name="depature_min" class="form-control full_width input_caretdown">
                        <option value="00"> 00</option>                         
                        <option value="15"> 15</option>
                        <option value="30"> 30</option>
                        <option value="45"> 45</option>
                      </select>
</div>
</div>   

  <div class="col-md-6">

   <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('flying_to');?> :</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <input type="text" class="form-control departflight " name="to"  id="to"  />
          </div>
   <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('flying_to_date');?> :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control" name="return_date" id="m_return" placeholder="MM/DD/YYYY"  />
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('flying_to_time');?> :</div>
        </div>
          <div class="col-lg-4 col-md-4 col-sm-12 margbotm15">
         <select name="return_time" class="form-control full_width input_caretdown"> 
                        <?php  for($i = 0; $i <= 24; $i++){?>
                        <option <?php echo (date("H")==$i)?"selected":'';?> value="<?php echo ($i<10)?"0".$i:$i; ?>"><?php echo ($i<10)?"0".$i:$i; ?></option>
                        <?php }?>
                      </select>
          </div>
<div class="col-lg-4 col-md-4 col-sm-12 margbotm15">
 <select name="return_min" class="form-control full_width input_caretdown">
                        <option value="00"> 00</option>                         
                        <option value="15"> 15</option>
                        <option value="30"> 30</option>
                        <option value="45"> 45</option>
                      </select>
</div>
</div>   
 <div class="col-md-12">
 <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('flexible');?> :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="checkbox"  name="flexible" id="flexible" value="Yes"  />
          </div>
</div> 


      <div class="col-md-12">
<h4><?php echo lang_line('More_Passangers');?></h4>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('adult_info');?> * :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
           <select class="form-control" name="total_adult" id="total_adult" required>
            <?php for ($i=1; $i <15 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                              </select>
          
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('child_info');?>:</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <select class="form-control" name="total_child" id="total_child" >
            <?php for ($i=1; $i <10 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                              </select>
          
         </div>
       
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('infant_info');?>:</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
         <select class="form-control" name="total_infant" id="total_infant" >
            <?php for ($i=1; $i <10 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
             </select>
          
          
        </div>
        </div>
       
      <div class="col-md-12">
        <h4><?php echo lang_line('More_Extra');?></h4>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('Booking_reason');?> *:</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
         <select class="form-control" name="booking_reason" id="booking_reason" required>
           <option value="" >Select</option>
            <option value="<?php echo lang_line('PRIVATE');?>" ><?php echo lang_line('PRIVATE');?></option>
            <option value="<?php echo lang_line('BUSINESS');?>" ><?php echo lang_line('BUSINESS');?></option>
          </select>
         
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('Other_Request');?></div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <textarea  class="form-control" name="other_request"  ></textarea>
         </div>
       
       
            <div class="col-lg-12 col-md-12 col-sm-12 text-center margbotm15">
          <button type="submit" class="right btn btns-primary margtop20"><?php echo lang_line('SUBMIT');?></button>
         </div>
          
      
         
         
         
         
        </div>
       
      </form>
     
   
    
    <div class="clear"></div>
  </div>
</div>


           
        </div>
      </div>
</div>

<div class="clearfix"></div>
<?php $this->load->view('common/footer'); ?>
<script>
$('#more_persons').validate({ 

	    rules: {
	        'from[]': {
	            required: true
	        }
	    }
});
$("#m_departure,#m_return").datepicker({
    minDate: +1,
    dateFormat: 'dd/mm/yy',
    maxDate: "+1y"    
  });  
</script>