<?php
$this->load->view('common/header');
//print_r($this->session->userdata);die;
$all_airlines = $this->Help_Model->get_airline_list();
?>
<div id="SearchCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" role="listbox">
    <!-- Search result Start -->
    <div class="container nopadd container_flightsearch item">

    </div>
    <!-- Search result End -->
    <!-- Search Engine Start -->
    <div class="container nopadd container_indexpage item active">
      <div class="col-md-9">
        <div class="fullwidthbg_image">
          <img src="<?=ASSETS?>images/FACTORY_RF-02.png" class="factory_imageindexpng visible-md visible-lg">
          <img src="<?=ASSETS?>images/FACTORY_RF-02.svg" class="factory_imageindex2 visible-md visible-lg">
          <img src="<?=ASSETS?>images/FACTORY_MD.svg" class="factory_imageindex2 visible-sm">
          <img src="<?=ASSETS?>images/FACTORY_SM.svg" class="factory_imageindex2 visible-xs invisible_md">
          <div class="tab_contents color_white">
            <div class="col-sm-2">
              <h2 class="tc_title"><?php echo lang_line('FLIGHT');?></h2>
            </div>
            <div class="col-xs-12">
              <form class="form-inline flight_form" name="flight" method="post" id="flight" action="<?php echo WEB_URL;?>/flight/search_flight" autocomplete="off">
                <div class="ff_radio">
                  <div class="radio-inline col-sm-2 padd_l">
                    <input type="radio" name="trip_type" id="radio1" class="triprad iradio_flat-blue" value="oneway"  />        
                    <label for="radio1">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      <?php echo lang_line('ONE_WAY');?>
                    </label>
                  </div>
                  <div class="radio-inline  col-sm-2 padd_l">
                    <input type="radio" name="trip_type" id="radio2" class="triprad iradio_flat-blue" checked value="circle"/>     
                    <label for="radio2">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      <?php echo lang_line('ROUND_TRIP');?>
                    </label>
                  </div>
                  <div class="radio-inline  col-sm-2 padd_l">
                    <input type="radio" name="trip_type" class="triprad iradio_flat-blue" id="radio3" value="multicity"/>        
                    <label for="radio3">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-1x circle"></i>
                        <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                      </span>
                      <?php echo lang_line('MULTI_CITY');?>
                    </label>
                  </div>
                </div>
                <div class="normal">
                  <div class="form-group col-xs-6 padd_l sm4paddr0">
                    <label> <?php echo lang_line('FLY_FROM');?></label><br>
                    <input type="text" class="form-control fromflight full_width input_marker" name='from' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" value="" required>
                  </div>
                  <div class="form-group col-xs-6 padd_l smpaddr0">
                    <label> <?php echo lang_line('FLY_TO');?></label><br>
                    <input type="text" class="form-control departflight full_width input_marker" name='to' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" value="" required>
                  </div>
                  <div class="form-group col-xs-3 padd_l">
                    <label> <?php echo lang_line('DEPARTING');?></label><br>
                    <input type="text" class="form-control full_width input_calender first" name='depature' id="depature" placeholder="dd/mm/yy" value="" required>
                  </div>
                  <div class="form-group col-xs-3 sm2paddl0 sm3paddr0">
                    <label> <?php echo lang_line('RETURNING');?></label><br>
                    <input type="text" class="form-control full_width input_calender second" id="return" name='return' placeholder="dd/mm/yy" value="" required>
                  </div>
                  <div class="form-group col-xs-3 col-sm-2 padd_l">
                    <label class="invisible">&nbsp;</label><br>
                    <div class="input-wrapper drop-eft">
                      <input id="property" class="form-control input_caretdown" type="text" placeholder="1" name="person_select" readonly autocomplete="off">
                      <ul class="drop-spot">
                        <!-- <li><span class="arrow-icon"></span></li> -->
                        <li>
                          <ul>
                            <li>
                              <span> <?php echo lang_line('ADULTS');?></span>
                              <select name="adult" id="adult" class="input_caretdown">
                                <?php for ($i=1; $i <10 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                              </select>
                            </li>
                            <li class="divider1"></li>

                            <li><span> <?php echo lang_line('CHILD_DET');?>   </span>
                              <select name="child" id="child" class="input_caretdown">
                                <?php for ($i=0; $i <9 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                              </select>
                            </li>
                            <li class="divider1"></li>
                            <li><span> <?php echo lang_line('INF_DET');?></span>
                              <select name="infant" id="infant" class="input_caretdown">
                                <?php for ($i=0; $i <2; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                              </select>
                            </li>
                            <!-- <li class="divider1"></li>
                            <li style="color: green;"> <?php echo lang_line('CHILD_AGE_MSG');?></li> -->
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="form-group col-xs-3 col-sm-2 padd_l smpaddr0">
                    <label class="invisible">&nbsp;</label><br>
                    <select name='class' class="form-control full_width input_caretdown">                
                      <option value="Economy"> <?php echo lang_line('CLASS_ECO');?></option>
                      <option value="PremiumEconomy"> <?php echo lang_line('CLASS_PREM');?></option>
                      <option value="Business"> <?php echo lang_line('CLASS_BUS');?></option>
                      <option value="First"> <?php echo lang_line('CLASS_FIRST');?></option>
                      <option value="PremiumFirst"> <?php echo lang_line('CLASS_PREM_FIRST');?></option>
                    </select>
                  </div>
                  <div class="checkbox col-xs-12 padd_l">
                    <label>
                      <input type="checkbox" value="1" id="days" name="days" >  <?php echo lang_line('FLEXIBLE');?>
                    </label>
                  </div>
                </div>
                <div class="multicity" style="display:none;">
                  <div class="form-group col-xs-6 padd_l sm4paddr0">
                    <label><?php echo lang_line('FLY_FROM');?></label><br>
                    <input type="text" class="form-control fromflight full_width input_marker" name='mfrom[0]' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" required>
                  </div>
                  <div class="form-group col-xs-6 padd_l smpaddr0">
                    <label><?php echo lang_line('FLY_TO');?></label><br>
                    <input type="text" class="form-control departflight full_width input_marker" name='mto[0]' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" required>
                  </div>
                  <div class="form-group col-xs-3 padd_l">
                    <label><?php echo lang_line('DEPARTING');?></label><br>
                    <input type="text" class="form-control full_width input_calender" name='mdepature[0]' id="multi-departure" placeholder="dd/mm/yy" required>
                  </div>
                  <div class="form-group col-xs-3 padd_l multicity_flexible">
                    <div class="checkbox">
                      <label class="invisible">&nbsp;</label><br>
                      <div class="spacer10"></div>
                      <label>
                        <input type="checkbox" checked> Flexible
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-xs-3 col-sm-2 padd_l">
                    <label class="invisible">&nbsp;</label><br>
                    <div class="input-wrapper drop-eft">
                      <input id="property1" class="form-control input_caretdown" type="text" placeholder="1" name="person_select" readonly autocomplete="off">
                      <ul class="drop-spot">
                        <li>
                          <ul>
                            <li><span> <?php echo lang_line('ADULTS');?></span>
                              <select name="adult" id="adult1" class="input_caretdown">
                                <?php for ($i=1; $i <10 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                              </select>
                            </li>
                            <li class="divider1"></li>

                            <li><span> <?php echo lang_line('CHILD_DET');?>  </span>
                              <select name="child" id="child1" class="input_caretdown">
                                <?php for ($i=0; $i <9 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                              </select>
                            </li>
                            <li class="divider1"></li>

                            <li><span> <?php echo lang_line('INF_DET');?></span>
                              <select name="infant" id="infant1" class="input_caretdown">
                                <?php for ($i=0; $i <2 ; $i++) { ?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?> 
                              </select>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="form-group col-xs-3 col-sm-2 padd_l smpaddr0">
                    <label class="invisible">&nbsp;</label><br>
                    <select name='class' class="form-control full_width input_caretdown">
                      <option value="Economy"> <?php echo lang_line('CLASS_ECO');?></option>
                      <option value="PremiumEconomy"> <?php echo lang_line('CLASS_PREM');?></option>
                      <option value="Business"> <?php echo lang_line('CLASS_BUS');?></option>
                      <option value="First"> <?php echo lang_line('CLASS_FIRST');?></option>
                      <option value="PremiumFirst"> <?php echo lang_line('CLASS_PREM_FIRST');?></option>
                    </select>
                  </div>
                  <div class="form-group col-xs-6 col-sm-6 padd_l miltif_listcon smpaddr0 hidden" id='multiflight2'>
                    <ul class="list-inline miltiflight_list">
                      <li class="col-xs-5">
                        <label> <?php echo lang_line('FLYING');?>2:  <?php echo lang_line('FLY_FROM');?></label>
                      </li>
                      <li class="col-xs-5">
                        <label> <?php echo lang_line('FLY_TO');?></label>
                      </li>
                      <li class="col-xs-2">
                        <label>&nbsp;</label>
                      </li>
                      <li class="col-xs-4">
                        <label> <?php echo lang_line('FLYING');?>2:  <?php echo lang_line('FLY_FROM');?></label>
                        <input type="text" class="form-control fromflight full_width input_marker" name='mfrom[1]' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" required>
                      </li>
                      <li class="col-xs-4">
                        <label> <?php echo lang_line('FLY_TO');?></label>
                        <input type="text" class="form-control departflight full_width input_marker" name='mto[1]' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" required>
                      </li>
                      <li class="col-xs-4">
                        <label>Date</label>
                        <input class="form-control input_calender full_width" id="multi-flight2" required name="mdepature[1]" placeholder="dd/mm/yy" type="text" />
                      </li>
                    </ul>
                  </div>
                  
                  <div class="form-group col-xs-6 col-sm-6 padd_l miltif_listcon smpaddr0 hidden" id='multiflight3'>
                    <ul class="list-inline miltiflight_list">
                      <li class="col-xs-5">
                        <label> <?php echo lang_line('FLYING');?>3:  <?php echo lang_line('FLY_FROM');?></label>
                      </li>
                      <li class="col-xs-5">
                        <label> <?php echo lang_line('FLY_TO');?></label>
                      </li>
                      <li class="col-xs-2">
                        <label>&nbsp;</label>
                      </li>
                      <li class="col-xs-4">
                        <label> <?php echo lang_line('FLYING');?>3:  <?php echo lang_line('FLY_FROM');?></label>
                        <input type="text" class="form-control fromflight full_width input_marker" name='mfrom[2]' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" required>
                      </li>
                      <li class="col-xs-4">
                        <label> <?php echo lang_line('FLY_TO');?></label>
                        <input type="text" class="form-control departflight full_width input_marker" name='mto[2]' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" required>
                      </li>
                      <li class="col-xs-4">
                        <label>Date</label>
                        <input class="form-control input_calender full_width" id="multi-flight3" name="mdepature[2]" placeholder="dd/mm/yy" type="text" required />
                      </li>
                    </ul>
                  </div>
                  <div class="form-group col-xs-6 col-sm-6 padd_l miltif_listcon smpaddr0 hidden" id='multiflight4'>
                    <ul class="list-inline miltiflight_list">
                      <li class="col-xs-5">
                        <label> <?php echo lang_line('FLYING');?>4:  <?php echo lang_line('FLY_FROM');?></label>
                      </li>
                      <li class="col-xs-5">
                        <label> <?php echo lang_line('FLY_TO');?></label>
                      </li>
                      <li class="col-xs-2">
                        <label>&nbsp;</label>
                      </li>
                      <li class="col-xs-4">
                        <label> <?php echo lang_line('FLYING');?>4:  <?php echo lang_line('FLY_FROM');?></label>
                        <input type="text" class="form-control fromflight full_width input_marker" name='mfrom[3]' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" required>
                      </li>
                      <li class="col-xs-4">
                        <label> <?php echo lang_line('FLY_TO');?></label>
                        <input type="text" class="form-control departflight full_width input_marker" name='mto[3]' placeholder="<?php echo lang_line('CITY_OR_AIRPORT');?>" required>
                      </li>
                      <li class="col-xs-4">
                        <label>Date</label>
                        <input class="form-control input_calender full_width" id="multi-flight4" name="mdepature[3]" placeholder="dd/mm/yy" type="text" required />
                      </li>
                    </ul>
                  </div>
                  <div class="col-xs-12 addflight_button">
                    <div class="btn btn_transparent" id='add-multiflight'>
                      <i class="fa fa-plus"></i>Add Flight
                    </div>
                    <div class="btn btn_transparent hidden" id='remove-multiflight'>
                      <i class="fa fa-minus"></i>Remove Flight
                    </div>
                    <span class='hidden' id='mlti-flight-count'>1</span>
                  </div>
                </div>
                <div class="col-xs-12 padd_l smpaddr0 ff_dropdown">
                  <button class="btn btn-primary ffd_caret" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <span class="caret"></span> <span class="btn_text"> <?php echo lang_line('ADVANCED_OPT');?></span>
                  </button>
                  <div class="collapse" id="collapseExample">
                    <div class="well">
                      <div class="form-group col-xs-2 padd_l">
                        <select name="Stop" class="form-control full_width input_caretdown">
                          <option value=""> <?php echo lang_line('ANY_STOP');?></option>
                          <option value="0"> <?php echo lang_line('NON_STOP');?></option>
                          <option value="1"> <?php echo lang_line('ONE_STOP');?></option>
                          <option value="2"> <?php echo lang_line('TWO_STOP');?></option>
                          <option value="3"> <?php echo lang_line('THREE_STOP');?></option>
                        </select>
                      </div>
                      <div class="form-group col-xs-2 padd_l">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?php echo lang_line('TIMES');?>
                        </button>
                        <ul class="dropdown-menu well_bgwhite" id="time">
                          <div class="well">
                            <div class="departure_time">
                              <p> <?php echo lang_line('DEP_TIME');?></p>
                              <div id="departure-range" class="float_lwidth"></div>
                              <input type="hidden" name="depMinTime" id="depMinTime" value="0" />
                              <input type="hidden" name="depMaxTime" id="depMaxTime" value="1440" />
                              <span class="time_left" id="left_label"></span>
                              <span class="time_right" id="right_label"></span>
                            </div>
                            <div class="arival_time">
                              <p> <?php echo lang_line('ARR_TIME');?></p>
                              <div id="arrival-range" class="float_lwidth"></div>
                              <input type="hidden" name="arrMinTime" id="arrMinTime" value="0" />
                              <input type="hidden" name="arrMaxTime" id="arrMaxTime" value="1440" />
                              <span class="time_left" id="left_label2"></span>
                              <span class="time_right" id="right_label2"></span>
                            </div>
                          </div>
                        </ul>
                      </div>
                      <div class="form-group ffd_duration col-xs-2 padd_l">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?php echo lang_line('DURATION');?>
                        </button>
                        <ul class="dropdown-menu well_bgwhite" id="duration">
                          <div class="well">
                            <div class="departure_time">
                              <p> <?php echo lang_line('DURATION');?></p>
                              <div id="duration-range" class="float_lwidth"></div>
                              <input type="hidden" name="MinDuration" id="MinDuration"/>
                              <input type="hidden" name="MaxDuration" id="MaxDuration" />    
                              <span class="time_left" id="left_duration"></span>
                              <span class="time_right" id="right_duration"></span>
                            </div>                             
                          </div>
                        </ul>
                      </div>
                      <div class="form-group col-xs-3 col-sm-2 padd_l">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?php echo lang_line('PRICE');?>
                        </button>
                        <ul class="dropdown-menu well_bgwhite" id="price">
                          <div class="well">
                            <div class="departure_time">
                              <p> <?php echo lang_line('PRICE');?></p>
                              <div id="price-range" class="float_lwidth"></div>
                              <input type="hidden" name="MinPrice" id="MinPrice"/>
                              <input type="hidden" name="MaxPrice" id="MaxPrice" />    
                              <span class="time_left" id="left_price"></span>
                              <span class="time_right" id="right_price"></span>
                            </div>                             
                          </div>
                        </ul>
                      </div>
                      <div class="button-group col-xs-2 smpaddr0 padd_l ff_facilitydp">
                        <button type="button" class="btn dropdown-toggle btn-inbox" data-toggle="dropdown"><?php echo lang_line('ANY_AIRLINE');?></button>
                        <ul class="dropdown-menu ffdp_dp">
                          <?php foreach ($all_airlines as $airlines) { ?>
                          <li class="col-xs-6 nopadd">
                            <label for="<?php echo stripslashes($airlines->airline_code);?>">
                              <input name="Airline[]" id="<?php echo $airlines->airline_code;?>" type="checkbox" value="<?php echo stripslashes($airlines->airline_code);?>"/><?php echo $airlines->airline_name;?>
                            </label>
                          </li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="button_search">
                  <button id='' name='flight_submit' type="submit" class="btn btn-primary"> <?php echo lang_line('SEARCH');?></button>                    
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('offer');?>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Flight-Details" tabindex="-1" role="dialog" aria-labelledby="FlightDetailsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="rf_modaltitle"><?php echo lang_line('FLIGHT_DET');?></div>
      </div>
      <div class="modal-body">
        asd
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="flightFareModal" tabindex="-1" role="dialog" aria-labelledby="flightFareModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="flightFareModalLabel"><?php echo lang_line('DETAIL_INFO');?></h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<style type="text/css">
#DealsModal .modal-content{height: auto;}
</style>

<?$this->load->view('common/footer.php');?>
<script type="text/javascript">

    //FARE RULE DIAPLAY CODE BY VEERA
    function show_fare_popup(id,el,elm){

      $(el).append('<img class="loading" src="<?php echo ASSETS;?>images/ajax_loader1.gif" style="height:20px;"></img>');
      $("#flightFareModal .modal-body").html('<img class="loading" src="<?php echo ASSETS;?>images/ajax_loader1.gif" style="height:30px;"></img>');

      var formData = { fare_key: id,elm:elm };
      $.post('flight/fareRule', formData, function (data){
        if(data){
          var div1 = '<div>';
          for(var i=0;i<data.split("|@@|")[1];i++){
            sum = i+1;
            div1 += '<button class="btn btn-primary" id="'+data.split("|@@|")[2]+'" onclick="show_fare_popup(this.id,this,'+sum+');"><?php echo lang_line('FLIGHT');?>'+sum+'</button>  ';
          }
          div1 += '</div>';
          var div2 = '<div>'+data.split("|@@|")[0]+'</div>';

          $("#flightFareModal .modal-body").html('');
          $("#flightFareModal .modal-body").append(div1);
          $("#flightFareModal .modal-body").append(div2);
          $('#flightFareModal').modal('show');
          $(el).find('img').empty();
          $(el).find('img').remove();

        }else{
          $("#flightFareModal .modal-body").html('');
          $("#flightFareModal .modal-body").append('<div align="center"><?php echo lang_line('NO_RESULT');?></div>');

        }
      });
    }
//FARE RULE DIAPLAY CODE BY VEERA
// to add the background image for the second selected date
$('#multi-departure').click(function(){
  $("#ui-datepicker-div").removeClass('returnDate_ui');
});

</script>

