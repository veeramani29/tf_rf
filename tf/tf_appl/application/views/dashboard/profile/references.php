<div class="tab-pane  <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "references") {echo "active";} ?>" id="reference"> 
<ul class="nav reviewtab">
  <li class="reviwli active" id="reqRef"> <a href="#refr" data-toggle="tab">Request References</a> </li>
  <li class="reviwli" id="refAbtYouTab"> <a href="#refabu" data-toggle="tab">References about You<?php if($PendingCount > 0){?>(<?php echo $PendingCount;?>)<?php }?></a> </li>
  <li class="reviwli" id="refByYouTab"> <a href="#refbyu" data-toggle="tab">References By You</a> </li>
</ul>
<div class="tab-content5">
   <div class="tab-pane active" id="refr">
   		<div class="witnote">
        	<span class="reptpara">
            	<strong>InnoGlobe is built on trust and reputation.</strong> You can request references from your personal network, and the references will appear publicly on your InnoGlobe profile to help other members get to know you. You should only request references from people who know you well. 
            </span>
        </div>
        
        <div class="withedrow">
          	<span class="size16 padtabne ">Email your friends</span>
            <div class="rowit">
            <div class="lodref"></div>
              <div class="col-md-6 nopad">
                    <p class="normalpara">
                    Friends you email can sign up on InnoGlobe to write you a personal reference. You can review new references and either accept or ignore them before they are displayed on your public profile.
                    </p>
                </div>
                <div class="col-md-6 nopad">
                    <div class="formfil">
                        <textarea class="filformtextarea" id="referenceEmails" placeholder="Enter email addresses...seperated by comma(,)"></textarea>
                        <input class="filbtn" type="button" id="sendReference" value="Send Request Emails" />
                       <!--  <input class="filbtn" type="submit" value="Import Your Contacts" /> -->
                    </div>
                </div>
            </div>
          </div>
           <br />
   </div>
   
   
   <div class="tab-pane" id="refabu">
   	<div class="withedrow">
         	<span class="size16 padtabne ">Pending Approval</span>
            
            <div class="rowit">
            <p class="normalpara">
                    When you accept a reference it will appear on your public profile. If you ignore a reference it will not appear in your profile, and the other person will not be notified. 
                    </p>
                    <div class="clear"></div>
                    <?php // print_r($referencesAboutYouPending); ?>
              <?php if(!empty($referencesAboutYouPending)){ ?>
              <ul id="refAbtYouPendingContainer">
              <?php foreach($referencesAboutYouPending as $reference){ if($reference->a_status == '0'){ ?>
              <li style="overflow: hidden">
              <div class="col-md-2 nopad">
                  
                  <a class="userimgnm" href="<?php echo WEB_URL;?>/users/show/<?php echo $reference->user_id;?>">
                   
<?php  
if(isset($reference->profile_photo)) {
  $pp = $reference->profile_photo;
} else if(isset($reference->agent_logo)) {
  $pp = $reference->agent_logo;
} else {
  $pp = ASSETS.'images/user-avatar.jpg';
}

?>

                    <div class="twouserimg"><img src="<?php echo $pp; ?>" alt="" title="<?php echo $reference->firstname;?>"/></div>
                    <span class="twousrname"><?php echo $reference->firstname;?></span>
                  </a>
              </div>
                <div class="col-md-10 nopad">
                    <div class="inercoment">
                    <div class="colrcnt">
                      <div class="tipfacen"></div>
                      <?php echo $reference->msg;?>
                      <div class="clear"></div>
                      <a href="<?php echo WEB_URL;?>/references/index/<?php echo $reference->reference_id;?>/-1" class="filbtn bigpad">Ignore</a>
                      <a href="<?php echo WEB_URL;?>/references/index/<?php echo $reference->reference_id;?>/1" class="filbtn bigpad">Accept</a>
                    </div>
                    </div>
                </div>
              </li>
              <?php }} ?>
              </ul>
              <div class="holderRefAbtYouPending"></div>
              <?php }else{?>
              <span class="lishade">No pending references.</span>
              <?php }?>
            </div>
          </div>
          <br />
          <div class="withedrow">
         	<span class="size16 padtabne ">Past References Written About You</span>
            
            <div class="rowit">
            
             <div class="clear"></div>
        <?php if(!empty($referencesAboutYou)){ ?>
        <ul id="refAbtYouPastContainer">
        <?php foreach($referencesAboutYou as $reference){ ?>
          <li>
           <div class="col-md-2 nopad">
                <a class="userimgnm" href="<?php echo WEB_URL;?>/users/show/<?php echo $reference->user_id;?>">

<?php  
if(isset($reference->profile_photo)) {
  $pp_1 = $reference->profile_photo;
} else if(isset($reference->agent_logo)) {
  $pp_1 = $reference->agent_logo;
} else {
  $pp_1 = ASSETS.'images/user-avatar.jpg';
}

?>

                  <div class="twouserimg"><img src="<?php echo $pp_1;?>" alt="" title="<?php echo $reference->firstname;?>"/></div>
                  <span class="twousrname"><?php echo $reference->firstname;?></span>
                </a>
            </div>
            <div class="col-md-10 nopad margin-bottom-10">
                <div class="inercoment">
                <div class="colrcnt">
                  <div class="tipfacen"></div>
                  <div class="clear"></div>
                  <?php echo $reference->msg;?>
                </div>
                </div>
            </div>
             <div class="clear"></div>
          </li>
          <?php } ?>
        </ul>
        <div class="holderRefAbtYouPast"></div>
          <?php }else{?>
            <span class="lishade">No one has written you a reference yet. <a>Learn how to get References.</a> </span>
             <div class="clear"></div>
          <?php }?>
                
            </div>
          </div>
   </div>
   <div class="tab-pane" id="refbyu">
   	<div class="withedrow">
     	<span class="size16 padtabne ">Reference Requests </span>
        
        <div class="rowit">
          <span class="reptpara">
          	Write references only for people you know well enough to recommend to the InnoGlobe Community. If you ignore a request the other person will not be notified.
          </span>

          <span class="lishade">No reference requests.</span>
           <div class="clear"></div>
        </div>
    </div>
    <div class="withedrow">
      <span class="size16 padtabne">Past References You've Written</span>
        <div class="rowit">
          <ul id="refByYouContainer">
          <?php if(!empty($referencesByYou)){ foreach($referencesByYou as $reference){?>
          <li>
           <div class="col-md-2 nopad">
                <a class="userimgnm" href="<?php echo WEB_URL;?>/users/show/<?php echo $reference->user_id;?>">
                  
<?php  
if(isset($reference->profile_photo)) {
  $pp_2 = $reference->profile_photo;
} else if(isset($reference->agent_logo)) {
  $pp_2 = $reference->agent_logo;
} else {
  $pp_2 = ASSETS.'images/user-avatar.jpg';
}

?>                  

                  <div class="twouserimg"><img src="<?php echo $pp_2 ?>" alt="" title="<?php echo $reference->firstname;?>"/></div>
                  <span class="twousrname"><?php echo ($reference->b2c_firstname != "") ? $reference->b2c_firstname : $reference->b2b_firstname ;?></span>
                </a>
            </div>
            <div class="col-md-10 nopad margin-bottom-10">
                <div class="inercoment">
                <div class="colrcnt">
                  <div class="tipfacen"></div>
                   <?php echo $reference->b2c_firstname; ?>
                  <p>Reference for <a class="editproos" href="<?php echo WEB_URL;?>/users/show/<?php echo ($reference->user_type != "") ? $reference->user_type : 2;?>/<?php echo ($reference->user_id != "") ? $reference->user_id : $reference->agent_id;?>"><?php echo ($reference->b2c_firstname != "") ? $reference->b2c_firstname : $reference->b2b_firstname ;?></a></p>
                  <div class="clear"></div>
                  <?php echo $reference->msg;?>
                </div>
                </div>
            </div>
             <div class="clear"></div>
            </li>
         <?php }}else{?>
            <span class="lishade">No references written by you.</span>
             <div class="clear"></div>
          <?php }?>
        </div>
        <div class="holdereRefByYou"></div>
        </ul>
        
    </div>
   </div>
</div>
</div>

<script>
  function createRefByYouPagination() { 
    $("div.holdereRefByYou").proPages({
        containerID: "refByYouContainer",
        perPage: 3,
        keyBrowse: true,
        scrollBrowse: false,
        // animation: "flipInX",
        callback: function (pages, items) {
                if(items.count > 1) {
                  $("#legend1").html("Page " + pages.current + " of " + pages.count);
                  $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                } else {
                  $("div.holdereRefByYou").html('');
                }
            }
        });
  }
  function createRefAbtYouPagination() { 
    $("div.holdereRefByYou").proPages({
        containerID: "refByYouContainer",
        perPage: 3,
        keyBrowse: true,
        scrollBrowse: false,
        // animation: "flipInX",
        callback: function (pages, items) {
                if(items.count > 1) {
                  $("#legend1").html("Page " + pages.current + " of " + pages.count);
                  $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                } else {
                  $("div.holdereRefByYou").html('');
                }
            }
        });
  }

  function createRefAbtYouPendingPagination() {
    $("div.holderRefAbtYouPending").proPages({
        containerID: "refAbtYouPendingContainer",
        perPage: 3,
        keyBrowse: true,
        scrollBrowse: false,
        // animation: "flipInX",
        callback: function (pages, items) {
                if(items.count > 1) {
                  $("#legend1").html("Page " + pages.current + " of " + pages.count);
                  $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                } else {
                  $("div.holderRefAbtYouPending").html('');
                }
            }
        });
  }

  function createRefAbtYouPastPagination() {
    $("div.holderRefAbtYouPast").proPages({
        containerID: "refAbtYouPastContainer",
        perPage: 3,
        keyBrowse: true,
        scrollBrowse: false,
        // animation: "flipInX",
        callback: function (pages, items) {
                if(items.count > 1) {
                  $("#legend1").html("Page " + pages.current + " of " + pages.count);
                  $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                } else {
                  $("div.holderRefAbtYouPast").html('');
                }
            }
        });
  }

$(document).ready(function() {

  $('#refAbtYouTab').on('click', function() {
      $('#refabu').show();
      $('#refbyu, #refr').hide();

      createRefAbtYouPastPagination();
      createRefAbtYouPendingPagination();
      createRefByYouPagination();  
  });


  $('#refByYouTab').on('click', function() {
      $('#refbyu').show();
      $('#refabu, #refr').hide();
      createRefByYouPagination();  
  });
  


  $('#reqRef').on('click', function() {
      $('#refabu, #refbyu').hide();
      $('#refr').show();
  });
})
</script>