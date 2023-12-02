<?php $this->load->view('common/header'); ?>
<style type="text/css">
    .bokbtnwrap, #cntctHst{ display: none; }
</style>
<div class="full moditop flitgray">
    <div class="container fordetailpage">
        <div class="container">
            <?php 
            $rooms = json_decode(base64_decode($rooms),true);            
            if($makebook_result['Status']['Accomplished'] == 'false'){ 
                echo $makebook_result['Status']['ErrorMessage'];
             }
             else
            { ?>
            <div class="full"> 
                <div class="contentpad">
                    <div class="col-md-5 desklarge">
                        <div class="insidemaindets" >
                            <div id="hotel_details">
                                <?php
                                    echo $hotel_info;
                                 ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 nopad">
                        <div class="sliderhtldet">
                            <div id="hotel_image">
                                <?php echo $hotel_images; ?>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="col-md-12" style="background:#fff;">
                        <div class="col-md-6">
                            <h3>Confirm Booking</h3>
                            <h4>Booking Final Price : &euro; <?php echo number_format($makebook_result['FinalPrice'] ,2,'.',''); ?> </h4>
                            <h4>Checkin : <?php echo $makebook_result['CheckIn']; ?> </h4>
                            <h4>Checkout :<?php echo $makebook_result['CheckOut']; ?> </h4>
                            <p>
                                <b>Info:</b><br/>
                                <ul>
                                <?php 
                                   foreach($makebook_result['ImportantInformations']['ImportantInformation'] as $info)
                                   {
                                    ?>
                                    <li><?php echo $info; ?></li>    
                                <?php    
                                   } 
                                ?>
                                </ul>
                            </p>
                            <form method="post" action="<?php echo WEB_URL;?>/hotel/confirmbooking">
                                <input type="hidden" name="confirm_token" value="<?php echo $makebook_result['ConfirmToken']; ?>" />
                                <input type="hidden" name="rooms" value="<?php echo $rooms; ?>" />
                                <input type="hidden" name="room_ids" value="<?php echo $room_ids; ?>" />
                                <h4>Please enter Room Occupants Details Below</h4>
                                <?php 
                                    
                                    print_r($rooms);
                                    for($r=1;$r<=count($rooms);$r++)
                                    {
                                    ?>
                                        <b>Room <?php echo $r?></b><br/>
                                        <?php
                                        for($a=1;$a<=$rooms[$r]['adult'];$a++)
                                        { 
                                        ?>
                                            <label>Adult <?php echo $a ?></label><br/>
                                            <label>gender</label> &nbsp;
                                            <select name='<?php echo "gender-room".$r."adult".$a; ?>'>
                                                <option value="1">Mr</option>
                                                <option value="2">Mrs</option>
                                                <option value="3">Miss</option>
                                            </select><br/>
                                            <label>Name</label>&nbsp
                                            <input type="text" name="<?php echo "name-room".$r."adult".$a;?>"><br/>
                                            <label>Surname</label>&nbsp
                                            <input type="text" name="<?php echo "surname-room".$r."adult".$a;?>"><br/>
                                            <label>Age</label>&nbsp
                                            <input type="text" name="<?php echo "age-room".$r."adult".$a;?>"><br/>
                                        <?php
                                        }

                                        for($c=1;$c<=$rooms[$r]['children'];$c++)
                                        { 
                                        ?>
                                            <label>Children <?php echo $c; ?></label><br/>                                     
                                            <input type="hidden" name='<?php echo "gender-room".$r."child".$c; ?>' value="4" />
                                            <label>Name</label>&nbsp
                                            <input type="text" name="<?php echo "name-room".$r."child".$c;?>"><br/>
                                            <label>Surname</label>&nbsp
                                            <input type="text" name="<?php echo "surname-room".$r."child".$c;?>"><br/>
                                            <label>Age</label>&nbsp
                                            <input type="text" name="<?php echo "age-room".$r."child".$c;?>" value=" <?php echo $rooms[$r]['childrenage'.$c]?>" readonly><br/>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                ?>
                                <input type="submit" value="Confirm Booking" />
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h3>
                                Cancelation Policy
                            </h3>
                            <p>
                               Cancelation is available from <?php echo $makebook_result['Cancellation']['Policy']['Start']; ?> to <?php echo $makebook_result['Cancellation']['Policy']['End']; ?><br/>
                               Cancelation Price is : &euro; <?php echo $makebook_result['Cancellation']['Policy']['Price'];  ?> <br/>
                               Cancelation Type is : <?php echo $makebook_result['Cancellation']['Policy']['Type'];  ?> <br/>
                            </p>
                        </div>
                        <?php
                            //print_r($makebook_result);
                            echo"<br/><br/>";

                         ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
       </div>
    </div>                         
</body>
</html>
