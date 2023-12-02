  <?php  $this->load->view('header'); ?>
   <style>
            .btn-group-select-num>.btn.active,
            .btn-group-select-num>.btn.active:hover {
                border-color: 0px!important;
                -webkit-box-shadow: none;
                box-shadow: none;
                color: #fff;
            }
            .panel-default > .panel-heading + .panel-collapse .panel-body{    border-top-color: #ffffff;}

            #VehicleType p{
                font-size: 12px;
            }
        </style>
            <!-- main start -->
            <div class="container ht_cont_padd">
                <div class="col-md-12 pad_0">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom:2px;">
                        <div class="panel panel-default bor_none box_sho">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style=" background-color: #f5f5f5;border: 1px solid #e6e6e6;">
                                        <span id="hotels_count"><img src="<?php echo base_url(); ?>assets/img/directions-sign.png" style="width: 2%;margin-right: 13px;"><?php echo $searchData['org_city']; ?> -->  <?php echo $searchData['dest_city']; ?> <?php echo ($searchData['trip_type']!=1)?"(Round Trip)":"(One-way)";?> </span> <span class="sight_modify" style=";padding-right: 13px;">Modify Search</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="border: 1px solid #f5f5f5;">
                                <div class="panel-body" style="border: 1px solid #dedede;">
                                  <form name="hotel_frm" id="hotel_frm" action="<?php echo site_url(); ?>/car/search" method="GET">
                                    <div class="col-md-3 pad_left0">
                                      
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Pick Up: </label>
                                                <input type="text" id="hotel_origin" name="hotel_origin" class="form-control" value="<?php echo $searchData['org_city']; ?>" placeholder="Current Search: ">
                                            </div>
                                        
                                    </div>

                                    <div class="col-md-3 pad_left0">
                                      

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Drop Off: </label>
                                                <input type="text" id="hotel_dest" name="hotel_dest" class="form-control" value="<?php echo $searchData['dest_city']; ?>" placeholder="Current Search: ">
                                            </div>
                                        
                                    </div>

                                    <div class="col-md-2 pad_left0">
                                        <div class="form-group form-group-lg form-group-icon-left form-group-filled"><i class="fa fa-calendar input-icon input-icon-highlight" style="padding-left:0px;margin-top: -4px;"></i>
                                            <label>Pick Up Date</label>
                                            <input class="form-control" id="car_start" value="<?php echo $searchData['cin']; ?>" name="car_start" type="text" style="height:34px;">
                                        </div>
                                    </div>

                                      <div class="col-md-3 col-sm-6 resp_3">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-clock-o input-icon input-icon-highlight"></i>
                                                                        <label>Pick Up Time</label>
                                                                        <input name="car_start_time" id="car_start_time" class="time-pick form-control" value="12:00 AM" type="text" />
                                                                    </div>
                                                                </div>

                                    <div class="col-md-2 pad_left0 trip_type">
                                        <div class="form-group form-group-lg form-group-icon-left form-group-filled"><i class="fa fa-calendar input-icon input-icon-highlight" style="padding-left:0px;margin-top: -4px;"></i>
                                            <label>Drop Off Date</label>
                                            <input class="form-control" value="<?php echo $searchData['cout']; ?>" id="car_end" name="car_end" type="text" style="height:34px;">
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 resp_3 ">
                                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-clock-o input-icon input-icon-highlight"></i>
                                                                        <label>Drop off Time</label>
                                                                        <input name="car_end_time" id="car_end_time" class="time-pick form-control" value="12:00 AM" type="text" />
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                <div class="col-md-3 col-sm-6 resp_3">
                                      
                                          <label for="onway_trip">  <input type="radio" value="1" id="onway_trip" name="trip_type">  One-way only</label>
                                                                </div>
                                                                 <div class="col-md-3 col-sm-6 resp_3">
                                      
                                          <label for="return_trip"> <input checked="" type="radio" value="2" id="return_trip" name="trip_type">  Round trip</label>
                                                                </div>
                                                                </div>

                                    <div class="col-md-3 pad_0">
                                       
                                        <div class=" col-md-4 col-sm-12 pad_left0">
                                         
                                                <div class="form-group fon_12">
                                                    <label for="exampleInputEmail1">Adults</label>
                                                    <select class="form-control" name="adult">
<option value="1" <?php echo ($searchData['adult']==1)?'selected':'';?>>1</option>
<option value="2" <?php echo ($searchData['adult']==2)?'selected':'';?>>2</option>
<option value="3" <?php echo ($searchData['adult']==3)?'selected':'';?>>3</option>
<option value="4" <?php echo ($searchData['adult']==4)?'selected':'';?>>4</option>
                                                    </select>
                                                </div>
                                           
                                        </div>
                                        <div class=" col-md-4 col-sm-12 pad_left0">
                                          
                                                <div class="form-group fon_12">
                                                    <label for="exampleInputEmail1">Child</label>
                                                    <select onchange="activity_show_child_age_info(this.value, '0','activity')" class="form-control" name="child">
    <option value="0" <?php echo ($searchData['child']==0)?'selected':'';?>>0</option>
<option value="1" <?php echo ($searchData['child']==1)?'selected':'';?>>1</option>
<option value="2" <?php echo ($searchData['child']==2)?'selected':'';?>>2</option>
<option value="3" <?php echo ($searchData['child']==3)?'selected':'';?>>3</option>
<option value="4" <?php echo ($searchData['child']==4)?'selected':'';?>>4</option>
                                                    </select>
                                                </div>
                                           
                                        </div>

                                        
                                         <div class=" col-md-12 col-sm-12 pad_left0" id="activity_child_ages"> 
 
</div>

                                        
                                      
                                       
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-lg" type="submit" style="margin-top: 20px;">Search</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 pad_0 lef_sty">
                    
                    <div class="col-md-12">
                        <p style=" margin-bottom:0px;" class="ht_fot18_1" ><b>Narrow By</b></p>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                  <!--  <div class="col-md-12">
                    <div data-role="main" class="ui-content">
                      
                         <div data-role="rangeslider">
                           <label for="price-min" class="ht_fot18_1">Fare Range</label>
                           <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
                          </div>
                      
                    </div>


                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div> -->
                    <div class="col-md-12">
                        <form class="fon_12">
                            <div class="form-group">
                                <p for="exampleInputEmail1" class="ht_fot18_1">Place Name</p>
                                <input type="email" class="form-control" id="placeName" name="place_name" placeholder="Place Name">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                   
                    <div class="col-md-12">
                        
                        
                        

                        <!-- <div class="col-md-12 pad_0">
                            <form class="fon_12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1 ht_fot18_1">Brand</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Any Brand">
                                </div>
                            </form>
                            <hr>
                        </div> -->
                        
                        <div class="col-md-12 pad_0 " id="VehicleType">
                            <p class="ht_fot18_1">VehicleType</p>
                           
                        </div>
                        
                        <!-- <div class="col-md-12 pad_0">
                            <form class="fon_12">
                                <div class="form-group">
                                    <p for="exampleInputEmail1 ht_fot18_1" class="ht_fot18_1">Distance</p>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Any Miles">
                                </div>
                            </form>
                            <hr>
                        </div>
                        <div class="col-md-12 pad_0">
                            <form class="fon_12">
                                <div class="form-group">
                                    <p for="exampleInputEmail1 ht_fot18_1" class="ht_fot18_1">Street Name</p>
                                    <input type="text" name="hotelAddress" class="form-control" id="hotelAddress" placeholder="Any Street">
                                </div>
                            </form>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg" type="submit" style="margin:auto;">Search</button>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-9 pad_right0">
                    <div class="col-md-12 pad_left0 rig_top">
                        <img class="time_im" src="<?php echo base_url(); ?>assets/img/hotel_inner/time.png"><span class="time_tex1">Spring offer: Use Code SPL10 to Save up to $10 </span>
                        <span class="time_tex">Spring offer: Use Code SPL10 to Save up to $10 </span>
                    </div>
                    
                    <!--#################################################################-->
                    <div id="search_result"></div>
                    <div id="show_progress" style="float:left;width: 533px;margin-bottom: 82px;margin-left: 10%;">
                        <div style="text-align:center;background-color:#ffffff;padding-top: 30px;padding-bottom: 15px;">
                            <div><img src="<?php echo base_url(); ?>assets/img/loader.gif" style="width:85px;"></div>
                            <div style="font-weight: bold;font-size: 24px;">Searching for best fare cars</div>
                            <div style="font-weight: bold;font-size: 20px;padding-top: 10px;padding-bottom: 10px;"><?php echo $searchData['org_city']; ?> --> <?php echo $searchData['dest_city']; ?>
                                <?php echo ($searchData['trip_type']!=1)?"(Round Trip)":"(One-way)";?>
                            </div>
                            <div style="font-weight: bold;font-size: 17px;padding-bottom: 20px;"><?php echo date('l, M dS, Y',strtotime($searchData['cin'])); ?> 

                                 <?php if($searchData['trip_type']!=1){ echo "-".date('l, M dS, Y',strtotime($searchData['cout']));} ?></div>
                        </div>
                    </div>
                    <!--#################################################################-->
                </div>
                <div class="col-md-2 pad_0">
                    <img src="<?php echo base_url(); ?>assets/img/hotel_inner/160X600.jpg" style="width:100%; padding-top:2px;">
                </div>  
            </div>
              <?php $this->load->view('footer'); ?>
            <script>
           <?php //print_r($searchData['child_age']);
            if($searchData['child']>0){ ?>
 activity_show_child_age_info(<?php echo $searchData['child'];?>, '0','activity');
$(window).load(function() {
    <?php if($searchData['child']>0){ foreach ($searchData['child_age'][0] as $key => $value) {  ?>
 $("select[name='child_age[0][]']:eq(<?php echo $key;?>) option[value='<?php echo $value;?>']").attr("selected","selected");
  $("select[name='child_age[0][]']:eq(<?php echo $key;?>) option[value='<?php echo $value;?>']").attr("selected",true);
    <?php } } ?> 
/*$("select[name='child_age[0][]'] option").each(function(){
    alert($(this).text())
  if ($(this).text() == "1")
    $(this).attr("selected","selected");
});*/
});
                <?php }?>
           
            var siteUrl = '<?php echo site_url(); ?>';
            $(document).ready(function () {
                
             
            var successHandler = function (data) {
                    $('#show_progress').hide();
                    $('#small_progress').hide();
                    $('#search_result').html(data.car_search_result);
                    $('#count_div').html(data.hotel_count);
                    $('#count_div').show();
                    

            }

            // these will basically all execute at the same time:
           
                $.ajax({
                        url: siteUrl+'/car/getSearchData',
                        dataType: 'json',				
                        type: 'post',
                        beforeSend: function()
                        {
                                $('#show_progress').show();
                                //$('#small_progress').show();
                        },
                        success: successHandler

                });
            
                
               

            });


             $(document).ready(function (){

            $("#placeName").keyup(function (){

                var filter = $(this).val(), count = 0;

                var regex = new RegExp(filter, "i");

                $(".HotelInfoBox").each(function (){

                    if ($(this).attr('data-place-name').search(regex) < 0){

                        $(this).parents(".searchhotel_box").hide();

                    } else {

                        count++;

                        $(this).parents(".searchhotel_box").show();

                    }

                });

                // Update the count

               // $("#hotel_count").text(count + ' Hotels Found');

            });


            $("#hotelAddress").keyup(function (){

                var filter = $(this).val(), count = 0;

                var regex = new RegExp(filter, "i");

                $(".HotelInfoBox").each(function (){

                    if ($(this).attr('data-hotel-name').search(regex) < 0){

                        $(this).parents(".searchhotel_box").hide();

                    } else {

                        count++;

                        $(this).parents(".searchhotel_box").show();

                    }

                });

                // Update the count

               // $("#hotel_count").text(count + ' Hotels Found');

            });

        });



              $(document).on('click',".cat-checkboxes",function(){
        all_unchecked = true;  
        $(".cat-checkboxes").each(function(){
           var star= $(this).attr('cat-id');

            if($(this).find('input').is(':checked'))
            {

            $('div.HotelInfoBox[data-star="'+ star +'"]').parents(".searchhotel_box").show();
              
                all_unchecked = false;
            }
            else
            {
                 $('div.HotelInfoBox[data-star="'+ star +'"]').parents(".searchhotel_box").hide();
               
            }
        });

        if(all_unchecked == true)
        {
            $(".searchhotel_box").show();
        }
     });




   $('input[name="trip_type"]:radio').change(function () {
               // var selectedVal = $("#trip_type input:radio:checked").val();
               if($(this).val()==1){
                $('div.trip_type').hide();
               }else{
                 $('div.trip_type').show();
               }
                
                  
            });

        </script>
       
