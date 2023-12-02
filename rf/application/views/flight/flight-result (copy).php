<?php
$this->load->view('common/header.php');
$language = $this->session->userdata('language');
  if($language){
   $this->lang->load('Home_Page_HM', $language);
    }else{
   $this->lang->load('Home_Page_HM', 'english');
    }
?>

  <div class="container container_flightsearch">
    <div class="row">
      <div class="col-md-12">
        <div class="fullwidthbg_image">
          <img src="<?php echo ASSETS;?>images/FLIGHTS_SEARCH.svg" class="fs_bgimage">          
          <div class="fs_content color_white">
            <div class="col-sm-12">
              <h5 class="fs_title">Filter your result by</h5>
            </div>
            <div class="col-xs-12">
              <form class="form-inline flight_form">
                <ul class="list-inline fs_filterform">
                  <li>
                    <select class="form-control full_width input_caretdown">                
                      <option>Stop 1</option>
                      <option>Stop 2</option>
                      <option>Stop 3</option>
                      <option>Stop 4</option>
                      <option>Stop 5</option>
                    </select>
                  </li>
                  <li>
                    <select class="form-control full_width input_caretdown">                
                      <option>Times</option>
                      <option>Times 1</option>
                      <option>Times 3</option>
                      <option>Times 4</option>
                      <option>Times 5</option>
                    </select>
                  </li>
                  <li>
                    <select class="form-control full_width input_caretdown">                
                      <option>Duration</option>
                      <option>Duration 1</option>
                      <option>Duration 2</option>
                      <option>Duration 3</option>
                      <option>Duration 4</option>
                    </select>
                  </li>
                  <li>
                    <select class="form-control full_width input_caretdown">                
                      <option>Price</option>
                      <option>Price 1</option>
                      <option>Price 2</option>
                      <option>Price 3</option>
                      <option>Price 4</option>
                    </select>
                  </li>
                  <li>
                    <select class="form-control full_width input_caretdown">                
                      <option>Airline</option>
                      <option>Airline 1</option>
                      <option>Airline 2</option>
                      <option>Airline 3</option>
                      <option>Airline 4</option>
                    </select>
                  </li>
                  <li class="sort-on">
                    <div class="form-group">
                      <label>Sort on</label>
                      <select class="form-control mar0 input_caretdown">                
                        <option>Price</option>
                        <option>Price 1</option>
                        <option>Price 2</option>
                        <option>Price 3</option>
                        <option>Price 4</option>
                      </select>
                    </div>
                  </li>
                  <li class="fs-button">
                    <button type="button" class="btn btn-secondry btn_inputs">Change Search</button>
                  </li>
                </ul>
              </form>
              <ul class="fs_flightlist">
                <li class="col-sm-12 fs_singleflight">
                  <ul class="list-inline">
                    <li>
                      <img src="<?php echo ASSETS;?>images/etihad_airways.png" class="fs_fname">
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Departure 7:50AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Departure 7:50PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_inout">
                      <div class="fs-outbond">
                        <span class="fso_outbond">Outbound</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                      <div class="spacer"></div>
                      <div class="fs-outbond">
                        <span class="fso_outbond">Return</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fsa_departure">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Arrival 9:20AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Arrival 10:45PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">1 H, 30 M</span><br />
                          <span class="fsa_departure">NONSTOP</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">3 H, 30 M</span><br />
                          <span class="fsa_departure">1 STOP</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fs_book">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">€375,-</span><br />
                          <span class="fsa_departure">p.p.retour</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <button type="button" class="btn btn-primary btn_inputs">Book Now</button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="col-sm-12 fs_singleflight">
                  <ul class="list-inline">
                    <li>
                      <img src="<?php echo ASSETS;?>images/etihad_airways.png" class="fs_fname">
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Departure 7:50AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Departure 7:50PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_inout">
                      <div class="fs-outbond">
                        <span class="fso_outbond">Outbound</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                      <div class="spacer"></div>
                      <div class="fs-outbond">
                        <span class="fso_outbond">Return</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fsa_departure">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Arrival 9:20AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Arrival 10:45PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">1 H, 30 M</span><br />
                          <span class="fsa_departure">NONSTOP</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">3 H, 30 M</span><br />
                          <span class="fsa_departure">1 STOP</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fs_book">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">€375,-</span><br />
                          <span class="fsa_departure">p.p.retour</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <button type="button" class="btn btn-primary btn_inputs">Book Now</button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="col-sm-12 fs_singleflight">
                  <ul class="list-inline">
                    <li>
                      <img src="<?php echo ASSETS;?>images/etihad_airways.png" class="fs_fname">
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Departure 7:50AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Departure 7:50PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_inout">
                      <div class="fs-outbond">
                        <span class="fso_outbond">Outbound</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                      <div class="spacer"></div>
                      <div class="fs-outbond">
                        <span class="fso_outbond">Return</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fsa_departure">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Arrival 9:20AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Arrival 10:45PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">1 H, 30 M</span><br />
                          <span class="fsa_departure">NONSTOP</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">3 H, 30 M</span><br />
                          <span class="fsa_departure">1 STOP</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fs_book">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">€375,-</span><br />
                          <span class="fsa_departure">p.p.retour</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <button type="button" class="btn btn-primary btn_inputs">Book Now</button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="col-sm-12 fs_singleflight">
                  <ul class="list-inline">
                    <li>
                      <img src="<?php echo ASSETS;?>images/etihad_airways.png" class="fs_fname">
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Departure 7:50AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Departure 7:50PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_inout">
                      <div class="fs-outbond">
                        <span class="fso_outbond">Outbound</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                      <div class="spacer"></div>
                      <div class="fs-outbond">
                        <span class="fso_outbond">Return</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fsa_departure">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Arrival 9:20AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Arrival 10:45PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">1 H, 30 M</span><br />
                          <span class="fsa_departure">NONSTOP</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">3 H, 30 M</span><br />
                          <span class="fsa_departure">1 STOP</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fs_book">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">€375,-</span><br />
                          <span class="fsa_departure">p.p.retour</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <button type="button" class="btn btn-primary btn_inputs">Book Now</button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="col-sm-12 fs_singleflight">
                  <ul class="list-inline">
                    <li>
                      <img src="<?php echo ASSETS;?>images/etihad_airways.png" class="fs_fname">
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Departure 7:50AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Departure 7:50PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_inout">
                      <div class="fs-outbond">
                        <span class="fso_outbond">Outbound</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                      <div class="spacer"></div>
                      <div class="fs-outbond">
                        <span class="fso_outbond">Return</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fsa_departure">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Arrival 9:20AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Arrival 10:45PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">1 H, 30 M</span><br />
                          <span class="fsa_departure">NONSTOP</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">3 H, 30 M</span><br />
                          <span class="fsa_departure">1 STOP</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fs_book">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">€375,-</span><br />
                          <span class="fsa_departure">p.p.retour</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <button type="button" class="btn btn-primary btn_inputs">Book Now</button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="col-sm-12 fs_singleflight">
                  <ul class="list-inline">
                    <li>
                      <img src="<?php echo ASSETS;?>images/etihad_airways.png" class="fs_fname">
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Departure 7:50AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_image">
                          <img src="<?php echo ASSETS;?>images/DEPARTURE_RF.svg" class="fs_dep">
                        </div>
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Departure 7:50PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_inout">
                      <div class="fs-outbond">
                        <span class="fso_outbond">Outbound</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                      <div class="spacer"></div>
                      <div class="fs-outbond">
                        <span class="fso_outbond">Return</span><br>
                        <img src="<?php echo ASSETS;?>images/ARROW_RF.svg" class="fs_io">
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fsa_departure">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Dubai International DBX</span><br />
                          <span class="fsa_departure">Arrival 9:20AM</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">Amsterdam Ams</span><br />
                          <span class="fsa_departure">Arrival 10:45PM</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">1 H, 30 M</span><br />
                          <span class="fsa_departure">NONSTOP</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">3 H, 30 M</span><br />
                          <span class="fsa_departure">1 STOP</span>
                        </div>
                      </div>
                    </li>
                    <li class="fs_airlinecontainer fs_book">
                      <div class="fs_airline">
                        <div class="fs_values">
                          <span class="fsa_airlinename">€375,-</span><br />
                          <span class="fsa_departure">p.p.retour</span>
                        </div>
                      </div>
                      <div class="spacer"></div>
                      <div class="fs_airline">
                        <div class="fs_values">
                          <button type="button" class="btn btn-primary btn_inputs">Book Now</button>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 <?$this->load->view('common/footer.php');?>