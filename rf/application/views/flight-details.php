<?php
$this->load->view('common/header.php');
$language = $this->session->userdata('language');
if($language){
 $this->lang->load('Home_Page_HM', $language);
}else{
 $this->lang->load('Home_Page_HM', 'english');
}
?>
<div class="container container_flightdetails">
  <div class="row">
    <div class="col-md-12">
      <div class="fullwidthbg_image">
        <img src="<?php echo ASSETS;?>images/FLIGHTS_BG_RF.svg" class="fd_bgimage">          
        <div class="fd_content color_white">
          <div class="col-sm-12 nopadd">
            <ul class="nav nav-tabs fd_tabtitle" role="tablist">
              <li role="presentation"><a href="#tarifs" aria-controls="home" role="tab" data-toggle="tab">Tarifs</a></li>
              <li role="presentation"><a href="#information" aria-controls="profile" role="tab" data-toggle="tab">Your Information</a></li>
              <li role="presentation" class="active"><a href="#overview" aria-controls="messages" role="tab" data-toggle="tab">Overview & Pay</a></li>
              <li role="presentation"><a href="#confirmation" aria-controls="settings" role="tab" data-toggle="tab">Confirmation</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content fd_tabcontent">
              <div role="tabpanel" class="tab-pane" id="tarifs">...</div>
              <div role="tabpanel" class="tab-pane" id="information">
                <div class="col-xs-12">
                  <div class="spacer30"></div>
                  <h5>Traveller 1: Adult</h5>
                </div>
                <form class="form-inline flightdetails_form">
                  <div class="col-sm-2">
                    <label>Title *</label>
                    <select class="form-control full_width input_caretdown">                
                      <option>Enter Title</option>
                      <option>Title 1</option>
                      <option>Title 3</option>
                      <option>Title 4</option>
                      <option>Title 5</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="exampleInputName2">First name (as in passport) *</label><br>
                    <input type="text" class="form-control full_width" id="exampleInputName2" placeholder="Enter first name">
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="exampleInputName2">Last name *</label><br>
                    <input type="text" class="form-control full_width" id="exampleInputName2" placeholder="Enter last name">
                  </div>
                  <div class="col-sm-4">
                    <label for="exampleInputName2">Date of birth *</label>
                    <ul class="list-inline fd_dateob mar0">
                      <li class="date">
                        <select class="form-control input_caretdown">
                          <option>Date</option>
                          <option>01</option>
                          <option>02</option>
                          <option>11</option>
                          <option>31</option>
                        </select>
                      </li>
                      <li class="month">
                        <select class="form-control input_caretdown">                
                          <option>Select Month</option>
                          <option>January</option>
                          <option>February</option>
                          <option>March</option>
                          <option>April</option>
                        </select>
                      </li>
                      <li class="year">
                        <select class="form-control input_caretdown">                
                          <option>Year</option>
                          <option>1990</option>
                          <option>1991</option>
                          <option>1992</option>
                          <option>1993</option>
                        </select>
                      </li>
                    </ul>
                  </div>
                  <div class="col-xs-12 fd_moreoption">
                    <button class="btn btn_transparent" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-plus fa-stack-1x"></i>
                      </span>
                      <span class="btn_text">More Travellers</span>
                    </button>
                    <div class="collapse" id="collapseExample">
                      <div class="well well_transparent">
                        <div class="form-group col-xs-3 sm3paddr0 padd_l">
                          <select class="form-control full_width input_caretdown sm2marb0">                
                            <option>Direct flight</option>
                            <option>Premium E</option>
                            <option>Business</option>
                            <option>Premium B</option>
                          </select>
                        </div>
                        <div class="form-group col-xs-2 sm3paddr0 padd_l">
                          <select class="form-control full_width input_caretdown">                
                            <option>Duration</option>
                            <option>Premium E</option>
                            <option>Business</option>
                            <option>Premium B</option>
                          </select>
                        </div>
                        <div class="form-group col-xs-2 padd_l sm2paddr0">
                          <select class="form-control full_width input_caretdown">                
                            <option>Price</option>
                            <option>Premium E</option>
                            <option>Business</option>
                            <option>Premium B</option>
                          </select>
                        </div>
                        <div class="form-group col-xs-2 sm3paddr0 padd_l">
                          <select class="form-control full_width input_caretdown">                
                            <option>Airline</option>
                            <option>Premium E</option>
                            <option>Business</option>
                            <option>Premium B</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 nopadd">
                    <div class="col-sm-3">
                      <label>Contact details *</label>
                      <select class="form-control full_width input_caretdown">                
                        <option>Enter booker</option>
                        <option>booker 1</option>
                        <option>booker 3</option>
                        <option>booker 4</option>
                        <option>booker 5</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group col-sm-2">
                    <label for="exampleInputName2">Street *</label><br>
                    <input type="text" class="form-control full_width" id="exampleInputName2" placeholder="Enter first name">
                  </div>
                  <div class="col-sm-4">
                    <ul class="list-inline">
                      <li class="form-group nopadd col-sm-6">
                        <label for="exampleInputName2">Houseenr *</label><br>
                        <input type="password" class="form-control full_width" id="exampleInputName2" placeholder="Houseenr">
                      </li>
                      <li class="form-group nopadd col-sm-6">
                        <label for="exampleInputName2">Zipcode *</label><br>
                        <input type="password" class="form-control full_width" id="exampleInputName2" placeholder="Zipcode">
                      </li>
                    </ul>
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="exampleInputName2">City *</label><br>
                    <input type="text" class="form-control full_width" id="exampleInputName2" placeholder="Enter City">
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="exampleInputName2">Country *</label><br>
                    <input type="text" class="form-control full_width" id="exampleInputName2" placeholder="Enter Country">
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="exampleInputName2">Email Address *</label><br>
                    <input type="text" class="form-control full_width" id="exampleInputName2" placeholder="Enter e-mail address">
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="exampleInputName2">Repeat Email *</label><br>
                    <input type="text" class="form-control full_width" id="exampleInputName2" placeholder="Enter e-mail address">
                  </div>
                  <div class="form-group col-sm-4">
                    <label>Phone Number *</label>
                    <ul class="list-inline">
                      <li class="col-sm-4">
                        <select class="form-control full_width input_caretdown">                
                          <option>NL +31</option>
                          <option>NL +32</option>
                          <option>NL +34</option>
                          <option>NL +34</option>
                          <option>NL +35</option>
                        </select>
                      </li>
                      <li class="col-sm-8">
                        <input type="text" class="form-control full_width" id="exampleInputName2" placeholder="Enter Phone Number">
                      </li>
                    </ul>
                  </div>
                  <div class="form-group col-sm-2 padd_l">
                    <label for="exampleInputName2">Company Name *</label><br>
                    <input type="text" class="form-control full_width" id="exampleInputName2" placeholder="Enter Company Name">
                  </div>

                  <div class="col-xs-12">
                    <div class="fd_registerspacer"></div>
                  </div>
                  <div class="col-xs-4">
                    <p>Already registered? Please <a href="#">login</a></p>
                    <label>
                      <input type="checkbox" checked="checked"> Create an account
                    </label>
                    <input type="password" class="form-control full_width" id="exampleInputName2" placeholder="Enter password">
                  </div>
                  <div class="col-xs-4 pull-right">
                    <ul class="normal-list fd_buttons text-right">
                      <li><button type="button" class="btn btn-secondry btn_inputs">Back</button></li>
                      <li><button type="button" class="btn btn-primary btn_inputs">Next Step</button></li>
                    </ul>
                  </div>
                </form>
              </div>
              <div role="tabpanel" class="tab-pane active" id="overview">
                <div class="col-sm-12">
                  <div class="spacer30"></div>
                  <ul class="list-inline overview_pay">
                    <li class="col-sm-12">
                      <p>Price list</p>
                    </li>
                    <li class="col-sm-3">
                      <p>1 ticket(s), adult(s)<br/>Filing fees</p>
                    </li>
                    <li class="col-sm-3">
                      <p>Price<br/>€ 300,-</p>
                    </li>
                    <li class="col-sm-3">
                      <p>Taxes & surcharges</p>
                      <p>€ 0.79</p>
                    </li>
                    <li class="col-sm-3">
                      <p>Subtotal</p>
                      <p>€ 379,-<br/>€ 27,-</p>
                    </li>
                    <li class="total full_width">
                      <div class="col-sm-6">
                        <h5>Total</h5>
                      </div>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-3">
                        <h5>€ 406.79</h5>
                      </div>
                    </li>
                    <li class="col-sm-12">
                      <p>Check your details</p>
                    </li>
                    <li class="col-sm-12">
                      <p><b>Amsterdam</b>, Schiphol Airport (AMS), Netherlands - <b>Abu Dhabi</b>, Abu Dhabi Airport (AUH), United Arab Emirates</p>
                    </li>
                    <li class="col-sm-3">
                      <p>
                        Friday 20th of march 2015<br/>
                        Departure<br/>
                        7:50AM
                      </p>
                    </li>
                    <li class="col-sm-3">
                      <p>
                        Single flight<br/>
                        Arrival<br/>
                        14:30PM
                      </p>
                    </li>
                    <li class="col-sm-3">
                      <p>
                        EY 7307<br/>
                        Journey time<br/>
                        6u 40m
                      </p>
                    </li>
                    <li class="borb1 full_width"></li>
                    <li class="col-sm-12">
                      <p>Traveler details</p>
                    </li>
                    <li class="col-sm-3">
                      <p>Male</p>
                    </li>
                    <li class="col-sm-3">
                      <p>Stan de Natris</p>
                    </li>
                    <li class="col-sm-3">
                      <p>09/01/1965</p>
                    </li>
                    <li class="col-sm-3">
                      <p>luggage: 0</p>
                    </li>
                    <li class="borb1 full_width"></li>
                    <li class="col-sm-12">
                      <p>Contact details</p>
                    </li>
                    <li class="col-sm-3">
                      <p>
                        Male<br/>
                        Spijkerlaan 110
                      </p>
                    </li>
                    <li class="col-sm-3">
                      <p>
                        Stan de Natris<br/>
                        6812 GD
                      </p>
                    </li>
                    <li class="col-sm-3">
                      <p>
                        09/01/1965<br/>
                        Netherlands
                      </p>
                    </li>
                    <li class="col-sm-3">
                      <p>
                        stan01@hotmail.com<br/>
                        0031652679100
                      </p>
                    </li>
                    <li class="borb1 full_width"></li>
                    <li class="col-sm-12">
                      <p>Insurance</p>
                    </li>
                    <li class="col-sm-12">
                      <p>Please specify which insurance you want to add to your booking</p>
                    </li>
                    <li class="full_width">
                      <ul class="list-inline ov_radio">
                        <li>
                          <div class="checkbox">
                            <label>
                              Yes<br/><input type="checkbox">
                            </label>
                          </div>
                        </li>
                        <li>
                          <div class="checkbox">
                            <label>
                              No<br/><input type="checkbox" checked>
                            </label>
                          </div>
                        </li>
                        <li>
                          <p>Cancellation insurance <i class="fa fa-question-circle"></i></p>
                        </li>
                      </ul>
                    </li>
                    <li class="borb1 full_width"></li>
                    <li class="col-sm-12 ov_checkbox">
                      <div class="col-sm-9">
                        <p>Payment method</p>
                        <div class="col-sm-4 nopadd">
                          <div class="radio-inline ">
                            <input type="radio" name="trip_type" id="radio1" class="triprad iradio_flat-blue" value="IDEAl"  checked/>        
                            <label for="radio1">
                              <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-1x circle"></i>
                                <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                              </span>
                              IDEAl
                            </label>
                          </div>
                          <div class="radio-inline ">
                            <input type="radio" name="trip_type" id="radio2" class="triprad iradio_flat-blue" value="Bancontact"  />        
                            <label for="radio2">
                              <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-1x circle"></i>
                                <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                              </span>
                              Bancontact / Mister Cash
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="radio-inline ">
                            <input type="radio" name="trip_type" id="radio3" class="triprad iradio_flat-blue" value="oneway"  />        
                            <label for="radio3">
                              <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-1x circle"></i>
                                <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                              </span>
                              Visa Credit
                            </label>
                          </div>
                          <div class="radio-inline ">
                            <input type="radio" name="trip_type" id="radio4" class="triprad iradio_flat-blue" value="oneway"  />        
                            <label for="radio4">
                              <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-1x circle"></i>
                                <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                              </span>
                              Mastercard Credit
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="radio-inline">
                            <input type="radio" name="trip_type" id="radio5" class="triprad iradio_flat-blue" value="oneway"  />        
                            <label for="radio5">
                              <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-1x circle"></i>
                                <i class="fa fa-circle fa-stack-1x circle-yellow"></i>
                              </span>
                              American Express
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-12 nopadd">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value="" checked>
                              I agree to the Terms and Conditions and I have completed my data correctly
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <ul class="normal-list fd_buttons text-right">
                          <li class="spacer30"></li>
                          <li><button type="button" class="btn btn-secondry btn_inputs">Back</button></li>
                          <li><button type="button" class="btn btn-primary btn_inputs">Next Step</button></li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="confirmation">...</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<ul class="normal-list socialicons_stickey">
  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
  <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
  <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
</ul>

<?$this->load->view('common/footer.php');?>