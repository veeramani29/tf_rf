 <?php if ($searchData['child'] > 0){ ?>
<?php for ($i = 0; $i < $searchData['child']; $i++) { ?>
   <br>
                    <div class="fdash"></div>
                    <br>

                          <div class="row">
                          <div class="col-md-2">
                            <div class="col-md-12 fli_pad0">
                            <p class="fli_det_name" style="font-size:13px;">Child <?php echo ($i+1); ?> (2-12yrs)</p>
                            </div>
                        </div>
                          </div>
                    <!-- ROW -->
                    <div class="row">
                        <div class="col-md-4">
                        <span class="size13 dark">Title*</span>

                          <select name="childtitle[]" required class="form-control mySelectBoxClass hasCustomSelect" style="-webkit-appearance: menulist-button; width: 213px; position: absolute; opacity: 0; height: 34px; font-size: 14px;">
                            <option value="1">Mr</option>
                                    <option value="2">Mrs</option>
                            </select><span class="customSelect form-control mySelectBoxClass" style="display: inline-block;"></span>

               
                               </div>   
                        <div class="col-md-4">
                            <span class="size13 dark">First Name *</span>
                           <!-- <input type="text" class="form-control" name="childFname[]" placeholder="First Name*"   pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvalid="this.setCustomValidity('Enter correct format first name')" required> -->

                                     <input type="text" class="form-control" name="childFname[]" placeholder="First Name*"  required>
                        </div>
                        <div class="col-md-4">
                            <span class="size13 dark">Last Name *</span>
                             <!--    <input type="text" class="form-control" name="childLname[]" placeholder="Last Name*" pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvalid="this.setCustomValidity('Enter correct format last name')"  required> -->

                                    <input type="text" class="form-control" name="childLname[]" placeholder="Last Name*"  required>
                        </div>
                        
                        
                        <div class="clearfix"></div><br>
                        

                             <div class="col-md-4">
                         
                                <span class="size13 dark">Date of birth*</span>
                                 <input type="text" class="form-control child_book_date mySelectCalendar " name="child_dob[]" placeholder="Date Of Birth*" oninvalid="this.setCustomValidity('Select your date of birth')" readonly required>
                             </div>
                         <?php if (isset($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) > 0) { ?>
                            <div class="col-md-4">
                            <span class="size13 dark">Additional Baggage</span>
                                <select class="form-control fli_padleft0 fli_padright0" name="childBaggageOnward[]" >
                                    <option value="">Additional Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['desc'] . ' - &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                        <?php if (isset($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']) > 0) { ?>
                            <div class="col-md-4">
                            <span class="size13 dark">Additional Return Baggage</span>
                                <select class="form-control fli_padleft0 fli_padright0" name="childBaggageReturn[]" >
                                  <option value="">Additional Return Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['baggage'][1]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['desc'] . ' - &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['baggage'][1]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                           <?php if (isset($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) > 0) { ?>
                            <div class="col-md-4">
                                <span class="size13 dark">Meal</span>
                                <select class="form-control fli_padleft0 fli_padright0" name="childMealsOnward[]" >
                                    <option value="">Meal</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['desc'] . '- &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>


                         <?php if (isset($flightDetails['ssr']['ssrHeap']['meal'][1]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][1]['data']) > 0) { ?>
                            <div class="col-md-4">
                                <span class="size13 dark">Return Meal</span>
                                <select class="form-control fli_padleft0 fli_padright0" name="childMealsReturn[]" >
                                    <option value="">Return Meal</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['meal'][1]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$d]['desc'] . '- &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['meal'][1]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                         <?php if (trim($searchData['fromCountry']) != trim($searchData['toCountry'])){ ?>
                        <div class="col-md-4">
                            <span class="size13 dark">Document series and number*</span>
                             <input type="text" class="form-control  " name="child_passport_no[]" placeholder="Passport Number*"  pattern="^[0-9 A-Za-z]{5,50}$" oninvalid="this.setCustomValidity('Enter correct format passport no')" required>

                     
                        </div>

                        <div class="col-md-4">
                            <span class="size13 dark">Expiry date (if specified)*</span>
                            
                            <input type="text" class="form-control mySelectCalendar docexp" placeholder="dd-mm-yyyy">
                        </div>
                        
                      <?php } ?>
                        
                       
                       
                       
                        <div class="clearfix"></div>

                    </div>
                    <!-- END OF ROW -->
                    <?php } ?>
                      <?php } ?>