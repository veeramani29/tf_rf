<table class="table hotelmodal_hroomtable">
  <thead>
    <tr>
      <th class="hmhr_roomtype" style="width:20%;">Room Type</th>
      <th class="hmhr_max" style="width:40%;">Room Description / Details</th>
      <th class="hmhr_price" style="width:10%;">Price</th>
      <th class="hmhr_condition" style="width:20%;">Conditions</th>
      <th class="hmhr_apartments" style="width:10%;">Book</th>
    </tr>
  </thead>
  <tbody>

    <?php
    //print_r($Hotel_room_info);die;
    if(!empty($Hotel_room_info))
    {
      for($k=0;$k<count($Hotel_room_info);$k++)
      {
        ?>
          
            <tr>
                <td><?php echo $Hotel_room_info[$k]->room_name ?></td>
                <td><?php echo $Hotel_room_info[$k]->roomdescription ?></td>
                <td>
                  <span class="pricehotel">
                    <?php echo $this->display_icon;?> <?php echo $this->account_model->currency_convertor($Hotel_room_info[$k]->total_cost);?>
                  </span>
                  <span class="smalper">Total</span>
                </td>
                <td>
            <button type="button" class="btn  btn-success btn-xs morerum" data-toggle="collapse" data-target="#rumaldets<?php echo $k; ?>" aria-expanded="false" aria-controls="collapseExample" onClick="javascript:get_cancellation_policy('<?php echo $k; ?>','<?php echo $Hotel_room_info[$k]->chain_code; ?>','<?php echo $Hotel_room_info[$k]->hotel_code; ?>','<?php echo $Hotel_room_info[$k]->org_amount; ?>','<?php echo $Hotel_room_info[$k]->room_code; ?>','<?php echo $Hotel_room_info[$k]->checkin; ?>','<?php echo $Hotel_room_info[$k]->checkout; ?>')" >
                      Additional details / Room Rate Rules
                  </button>
                  <div class="allromdesc collapse" id="rumaldets<?php echo $k; ?>" style="margin-left:12px;">
                    
                  </div>
                </td>
                <td>
                <form target="_blank" action="<?php echo WEB_URL;?>/hotel/AddToCart" method='post'>
                <input type="hidden" name="temp_id" value="<?php echo $Hotel_room_info[$k]->api_hotel_detail_temp_id; ?>">
                <input type="hidden" name="type" value="<?php echo base64_encode(base64_encode('API')); ?>">
                <input type="hidden" name="search_request" value="<?php echo $Hotel_room_info[$k]->search_request; ?>">
                <input type="hidden" name="imageurl" id="imageurl" value="https://d2whcypojkzby.cloudfront.net/imageRepo/4/0/56/90/641/Standard_Room_E.jpg">
                  <input type="submit" class="btn btn-info btn-xs" value="Book Now" name="submit"/> 
                   </form>
                   
               </td>
            
          
           </tr>
       
       <?php
     }
   }
   ?>
  </tbody>
</table>
<script>
 function get_cancellation_policy(id,sid,hotelid,rate,rateplan,checkin,checkout)
 {

  $.ajax({
    type: 'POST',
    url: WEB_URL+'/hotel/get_cancel_policy/'+sid+'/'+hotelid+'/'+rate+'/'+rateplan+'/'+checkin+'/'+checkout,
    data: '',
    async: true,
    dataType: 'json',
    beforeSend:function(){
      $("#rumaldets"+id).html('<img src="'+ASSETS+'/images/hotel_img_loading.gif">');
     
    },
    success: function(data){

      $("#rumaldets"+id).html(data.hotel_rules_val1);
     
    },


    error:function(request, status, error){


    }

  });

}

</script>