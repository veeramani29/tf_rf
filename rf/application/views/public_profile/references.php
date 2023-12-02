
       <div class="col-md-12 martopbtm30">
       <div class="withedrow fulbord">
            <span class="size16 padtabne ">Write your reference about <?php echo $referecetoData->firstname;?></span>
            
            <div class="rowit">
                <div class="col-md-5 nopad">
                    <div class="normalparasecnd">
                        InnoGlobe is built on trust and reputation. By writing this reference, you are recommending Nag to other members of the InnoGlobe community 
                        <strong>You should only provide references for people who know you well </strong><a href="#">Learn more about References on InnoGlobe.</a>
                    </div>
                    <div class="clear"></div>
                    <h4 class="pershed">Tips for a helpful reference:</h4>
                    <ul>
                        <li class="tipli">How do you know each other</li>
                        <li class="tipli">What style of traveler or InnoGlobe host is this person?</li>
                        <li class="tipli">Tell a story about an experience you've had together.</li>
                        <li class="tipli">Why do you recommend this person to other InnoGlobe members?</li>
                    </ul>
                </div>
                <div class="col-md-7 nopad">
                    <div class="col-md-2 nopad">
                        <a class="userimgnm">
                            <?php  
                            if(isset($referecebyData->profile_photo) && $referecebyData->profile_photo != "") {
                                $profile_photo = $referecebyData->profile_photo;
                            } else if(isset($referecebyData->agent_logo) && $referecebyData->agent_logo != "") {
                                $profile_photo = $referecebyData->agent_logo;
                            } else {
                                $profile_photo = ASSETS.'/images/user-avatar.jpg';
                            }
                            ?>
                            <div class="twouserimg"><img src="<?php echo $profile_photo; ?>" alt="" /></div>
                            <span class="twousrname"><?php echo $referecebyData->firstname;?></span>
                        </a>
                    </div>
                    <div class="col-md-10 nopad">    
                        <div class="inercoment">
                            <div class="colrcnt">
                                <div class="tipface">&#9666;</div>
                                <div class="col-md-12 nopad">
                                    <div class="col-md-6">
                                        <div class="persnsent">Your relationship to this person</div>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="personsel" name="relationship_type" id="relationship_type">
                                            <option value="1">Friend</option>
                                            <option value="2">Travel Buddy</option>
                                            <option value="3">Colleague</option>
                                            <option value="4">Family Member</option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="refid" value="<?php echo $rdata->reference_id;?>"/>
                                    <?php //stores the firstname of the person whose reference is to be given. ?>
                                    <input type="hidden" id="refid_firstname" value="<?php echo $referecetoData->firstname;?>"/>
                                    <div class="clear"></div>
                                    <textarea class="fulpers" placeholder="Write your reference..." id="recommendation" name="recommendation"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="rowit topbord">
                <a class="creteref" id="writeref">Create Reference</a>
                <a class="cancelref">Cancel</a>
            </div>
        </div>
    </div>