<table class="table hotelmodal_hroomtable">
  <thead>
    <tr>
      <th class="hmhr_roomtype"><?php echo lang_line('ROOM_TYPE');?></th>
      <th class="hmhr_price"><?php echo lang_line('PRICE');?></th>
      <th class="hmhr_condition"><?php echo lang_line('CONDITIONS');?></th>
      <th class="hmhr_apartments"><?php echo lang_line('BOOK');?></th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(!empty($Hotel_room_info)) { for($k=0;$k<count($Hotel_room_info);$k++) { ?>
    <tr>
      <td>
        <?php  
        $details='';
        $roomtypes=explode(".", $Hotel_room_info[$k]->room_name);
        if(count($roomtypes)>0){
         $details.="<h4 class='hdm_title'>".((isset($roomtypes[1])?$roomtypes[1]:''))."</h4> ";
       }
       echo $details;
       ?>
       <?php echo $Hotel_room_info[$k]->roomdescription; ?>
     </td>
     <td>
      <span class="pricehotel">
        <?php echo $this->display_icon;?> <?php echo $this->account_model->currency_convertor($Hotel_room_info[$k]->total_cost);?>
      </span>
      <span class="smalper"><?php echo lang_line('TOTAL');?></span>
    </td>
    <td>
     <button class="btn btn_transparent cacellation" data-sid="<?php echo $Hotel_room_info[$k]->chain_code; ?>" data-hotelid="<?php echo $Hotel_room_info[$k]->hotel_code; ?>" data-rate="<?php echo $Hotel_room_info[$k]->org_amount; ?>" data-rateplan="<?php echo $Hotel_room_info[$k]->room_code; ?>" data-checkin="<?php echo $Hotel_room_info[$k]->checkin; ?>" data-checkout="<?php echo $Hotel_room_info[$k]->checkout; ?>" type="button" >
      <?php echo lang_line('Additional_details');?>
    </button>
  </td>
  <td>
    <form target="_blank" class="" action="<?php echo WEB_URL;?>/hotel/AddToCart" method='post'>
      <input type="hidden" name="temp_id" value="<?php echo $Hotel_room_info[$k]->api_hotel_detail_temp_id; ?>">
      <input type="hidden" name="type" value="<?php echo base64_encode(base64_encode('API')); ?>">
      <input type="hidden" name="search_request" value="<?php echo $Hotel_room_info[$k]->search_request; ?>">
      <input type="hidden" name="imageurl" id="imageurl" value="https://d2whcypojkzby.cloudfront.net/imageRepo/4/0/56/90/641/Standard_Room_E.jpg">
      <input type="submit" class="btn btnxs-primary" value="Book Now" name="submit"/> 
    </form>
  </td>
</tr>
<?php
}
}
?>
</tbody>
</table>