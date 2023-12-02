<div class="innertabs">

<?php if(!empty($rooms)){ $i=1;foreach ($rooms as $key => $room) { ?>
<?php 
  $NightlyRent =  $this->Hotel_Model->getPeriods($room->room_id)->result();
  //echo '<pre>';print_r($periods);exit;
    foreach ($NightlyRent as $key => $value) {
        $temp_date = date('Y-m-d', strtotime('-1 day', strtotime($value->to)));

        $temp_date1 = date('Y-m-d', strtotime('+1 day', strtotime($value->from)));
        $temp_date2 = date('Y-m-d', strtotime('-1 day', strtotime($value->to)));

        $nightly_values[$value->from . ',' . $value->to] = $value->per_adult.'_'.$value->id;
        $nightly_values_temp1[] = $temp_date1 . ',' . $temp_date2;
        $nightly_values_temp[] = $value->from . ',' . $value->to;
    }

    foreach ($nightly_values_temp1 as $key => $value) {
        $explode = explode(',', $value);
        $hotel_night_wise_temp[] = $this->Hotel_Model->get_day_wise_chunks($explode[0], $explode[1]);
    }
    foreach ($hotel_night_wise_temp as $key => $value) {
        foreach ($value as $skey => $svalue) {
            $hotel_night_wise_temp_1[] = $svalue;
        }
    }
    
    $hotel_night_wise_s = $hotel_night_wise;

    $hotel_week_wise_temp = $hotel_night_wise;

    foreach ($NightlyRent as $key => $value) {
        $start_date[] = strtotime($value->from);
        $end_date[] = strtotime($value->to);
        $temp_start_date[] = $value->from;
        $temp_end_date[] = $value->to;
    }
    for ($i = 0; $i < count($temp_start_date); $i++) {
        $temp_night_chunks[] = $this->Hotel_Model->get_day_wise_chunks($temp_start_date[$i], $temp_end_date[$i]);
    }
    foreach ($temp_night_chunks as $key => $value) {
        foreach ($value as $skey => $svalue) {
            $temp_chunks[] = $svalue;
        }
    }

    foreach ($temp_chunks as $key => $value) {
        if (in_array($value, $hotel_night_wise_s)) {
            if (($key = array_search($value, $hotel_night_wise_s)) !== false) {
                unset($hotel_night_wise_s[$key]);
            }
        }
    }
    $min_start_date = date('Y-m-d', min($start_date));
    $min_end_date = date('Y-m-d', min($end_date));

    $rent_sub_total = array();
    if (in_array($checkin, $hotel_night_wise)) {
        $key = array_search($checkin, $hotel_night_wise, false);
        unset($hotel_night_wise[$key]);
    }
    foreach ($nightly_values as $key => $value) {
        $explode_cin_cout_dates = explode(',', $key);
        foreach ($hotel_night_wise as $skey => $svalue) {
            if (((strtotime($explode_cin_cout_dates[0]) <= strtotime($svalue)) && (strtotime($explode_cin_cout_dates[1]) >= strtotime($svalue)))) {
                list($amount, $price_id) = explode('_', $value);
                $scount = $this->Hotel_Model->getSpecificPeriods($room->room_id, $svalue)->num_rows();
                if($scount > 0){
                    $NightlySpecificRent =  $this->Hotel_Model->getSpecificPeriods($room->room_id, $svalue)->result();
                    foreach ($NightlySpecificRent as $key => $Rent) {
                        $sacount = $this->Hotel_Model->get_sepecific_adult_wise_price($Rent->id, $adult)->num_rows();
                        if($sacount == 1){
                            $s_price_adt = $this->Hotel_Model->get_sepecific_adult_wise_price($Rent->id, $adult)->row();
                            $s_sub_total[] = $s_price_adt->price;
                        }else{
                            $s_sub_total[] = $Rent->per_adult*$adult;
                        }
                    }
                    $rent_sub_total[] = max($s_sub_total);
                }else{
                    $count = $this->Hotel_Model->get_adult_wise_price($price_id, $adult)->num_rows();
                    if($count == 1){
                        $price_adt = $this->Hotel_Model->get_adult_wise_price($price_id, $adult)->row();
                        $rent_sub_total[] = $price_adt->price;
                    }else{
                        $rent_sub_total[] = $amount*$adult;
                    }
                }
            }
            //$total = array_sum($rent_sub_total);
            //echo '<pre>';print($total);exit;

        }
    }
    // echo '<pre>';print_r($hotel_night_wise);
    // echo '<pre>';print_r($rent_sub_total);exit;
    $total = array_sum($rent_sub_total);
    //echo '<pre>';print($total);exit;
    $aMarkup = $this->account_model->get_markup('HOTEL CRS'); //get markup
    $aMarkup = $aMarkup['markup'];
    $MyMarkup = $this->account_model->get_my_markup(); //get agent markup
    $myMarkup = $MyMarkup['markup'];
    $total = $this->account_model->PercentageToAmount($total,$aMarkup);
    $MyMarkup = $this->account_model->PercentageAmount($total,$myMarkup);
    $total = $this->account_model->PercentageToAmount($total,$myMarkup);
    //echo '<pre>';print_r($rent_sub_total);exit;
    if($total > 0){
        $data['room_id'] = $room_id = $room->room_id;
        $data['room_name'] = $room_name = $room->room_name;
        $data['hotelid'] = $hotelid;
        $data['adult'] = $adult; 
        $data['roomcount'] = $roomcount; 
        $data['checkin'] = $checkin;
        $data['checkout'] = $checkout;
        $data['city_code'] = $city_code;
        $images = $this->Hotel_Model->getCRSImages($hotelid)->result();
        $hotel_data = $this->Hotel_Model->getCRSHotelbyid($hotelid)->row();
        $data['hotel_name'] = $hotel_data->hotel_name;
        $data['desc'] = $hotel_data->descrip;
        $data['MyMarkup'] = $MyMarkup;
        $data['Total'] =  $total;
        $data['CancelPolicy'] = $room->cancel_policy;
        $data['CancelDeadline'] = $room->cancel_policy_nights;
        $data['CancelCommision'] = $room->cancel_policy_percent;
       $temp_id =  $this->Hotel_Model->insert_temp_result_crs($data, $room_id, $hotelid, $city_code);
?>
       <form id="bookNow<?php echo $temp_id; ?>" name="bookNow<?php echo $temp_id; ?>" action="<?php echo WEB_URL;?>/hotel/book_it">
            <input type="hidden" name="temp_id" value="<?php echo $temp_id;?>">
            <input type="hidden" name="type" value="<?php echo base64_encode(base64_encode('CRS')); ?>">
            <input type="hidden" name="imageurl"  value="<?php echo WEB_URL.'/admin/upload_files/room_image/'.$room->room_image ?>">
             
                            <div class="htlrumrow">
                            	<div class="hotelistrowhtl">
                                    <div class="col-md-4 nopad xcel cartimageclo">
                                        <div class="imagehotel" id="imagehotels<?php echo $i; ?>">
                                            <div class="imagehotels">
                                                <img class="tocartclone" id="HH<?php echo $i;?>"  src="<?php echo WEB_URL.'/admin/upload_files/room_image/'.$room->room_image ?>" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 padall10 xcel">
                                        <div class="hotelhed"><?php echo $room->room_name ?></div>
                                        <!--<span class="singleadrs">One Queen Bed </span>-->
                                     
                                        <div class="mensionspl">
                                        	<?php echo $room->room_desc ?>
                                           <!-- <span class="menlbl">sdsa</span>-->
                                        </div>
                                       
                                        <div class="clear"></div>
                                       
                                        <button type="button" class="morerum" data-toggle="collapse" data-target="#rumaldets<?php echo $i; ?>">
                                        <div class="refundpol">
                                        	<span class="icon icon-check"></span>Additional details / Room Rate Rules
                                        </div>
                                        </button>
                                        <div class="clear"></div>
                                       
                                    </div>
                                    <div class="col-md-2 nopad xcel bordrit">
                                        <div class="pricesec">
                                            <span class="pricehotel">
											<?php echo $this->display_icon;?> <?php echo $this->account_model->currency_convertor($total);?>
											</span>
                                            <span class="smalper">Total</span>
                                       <input type="submit" class="booknowhtl add-to-cart HotelbookNow" id="book-it<?php echo $i; ?>" value="Book Now"  data-attr="H<?php echo $i; ?>"  data-tempid="<?php echo $temp_id;?>" name="submit"/>
                                       
                                     
                                      
                                        </div>
                                    </div>
                                </div>  
                                <div class="allromdesc collapse" id="rumaldets<?php echo $i; ?>" style="margin-left:12px;">
                                    <div class="hotelhed">RoomRate Description</div>
                                    <!--<span class="singleadrs">One Queen Bed </span>-->
                                    <div class="mensionspl">
                                        <strong>Description :</strong>
                                        <span class="menlbl"><?php echo $room->room_desc; ?></span>
                                    </div>

                                    <div class="clear"></div>
                                    <div class="clear"></div>
                                    <div class="hotelhed">Hotel Rules</div>
                                    <div class="mensionspl">
                                        <strong>Cancel Policy :</strong>
                                        <span class="menlbl"><?php echo $room->cancel_policy; ?></span>
                                    </div>
                                    <div class="mensionspl">
                                        <strong>Cancel Before Nights :</strong>
                                        <span class="menlbl"><?php echo $room->cancel_policy_nights; ?></span>
                                    </div>
                                    <div class="mensionspl">
                                        <strong>Cancellation Amount :</strong>
                                        <span class="menlbl"><?php echo $room->cancel_policy_percent; ?> %</span>
                                    </div>
                                    <div class="clear"></div> 
                                </div>
                            </div>
       </form>
<?php $i++; }}}?>
</div>
                            