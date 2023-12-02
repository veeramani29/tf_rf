<div class="tab-pane <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "reviews") {echo "active";} ?>" id="reviews"> 
<ul class="nav reviewtab">
  <li class="reviwli active" id="revAbtYouTab"> 
    <a href="#rau" data-toggle="tab">
      Reviews About You <?php echo ($reviewsAboutYouPendingCount > 0) ? '('.$reviewsAboutYouPendingCount.')' : ''; ?>
    </a> 
  </li>
  <li class="reviwli" id="revAbtPropTab"> 
    <a href="#abu" data-toggle="tab">
      Reviews About Your Property <?php echo ($reviewsAboutPropPendingCount > 0) ? '('.$reviewsAboutPropPendingCount.')' : ''; ?>
    </a> 
  </li>
</ul>
<div class="tab-content5">
   <div class="tab-pane active" id="rau">
   		<span class="size16 padtabne bold">Pending Approvals</span>
        <div class="withedrow">
            <div class="rowit">
              <p class="normalpara">When you accept a review it will appear on your public profile. If you ignore a review it will not appear in your profile. </p>
              <div class="clear"></div>
              <ul id="pendingApproval" class="list clearfix">
              <?php if(!empty($reviewsAboutYouPending)) { ?>
                <?php foreach($reviewsAboutYouPending as $key) { ?>
                  <li style="overflow: hidden">
                    <div class="col-md-2 nopad">

<?php  
if(isset($key->profile_photo)) {
  $pp = $key->profile_photo;
} else if(isset($key->agent_logo)) {
  $pp = $key->agent_logo;
} else {
  $pp = ASSETS.'images/user-avatar.jpg';
}
?>
                      <a class="userimgnm" href="<?php echo WEB_URL.'/users/show/'.$key->user_id; ?>">
                      <div class="twouserimg"><img src="<?php echo $pp; ?>" alt="" title=""/></div>
                        <span class="twousrname"><?php echo $key->firstname ?></span>
                      </a>
                    </div>
                    <div class="col-md-10 nopad">
                      <div class="inercoment">
                        <div class="colrcnt">
                          <div class="tipface">&#9666;</div>
                          <?php echo $key->review_comments; ?>
                          <div class="clear"></div>
                          <?php  

                          if(isset($key->reviews_host_data_id) && !empty($key->reviews_host_data_id)) {
                            $updateStatusUrl = WEB_URL.'/reviews/reviewAboutYouHostStatus/'.$key->reviews_host_data_id;
                          } else if(isset($key->reviews_guest_data_id) && !empty($key->reviews_guest_data_id)) {
                            $updateStatusUrl = WEB_URL.'/reviews/reviewAboutYouGuestStatus/'.$key->reviews_guest_data_id;
                          }
                          
                          ?>

                          <a href="<?php echo $updateStatusUrl.'/-1'; ?>" class="filbtn bigpad">Ignore</a>
                          <a href="<?php echo $updateStatusUrl.'/1'; ?>" class="filbtn bigpad">Accept</a>
                        </div>
                      </div>
                    </div>
                  </li>
                <?php } ?>
                </ul>
                <div class="holderPendingApproval"></div>
              <?php } else { ?>
              
              
                <span class="lishade">No pending reviews.</span>
              <?php } ?>
            </div>
        </div>
      <span class="size16 padtabne bold">Past reviews about you</span>
         <div class="withedrow">
            <div class="rowit">
              <ul id="rvwContainer" class="list clearfix">
                <?php if(!empty($reviewsAboutYouAccepted)) { ?>
                <?php foreach($reviewsAboutYouAccepted as $key) { ?>
                <li>
                  <div class="col-md-2 nopad">
                      <a class="userimgnm" href="">

<?php  
if(isset($key->profile_photo)) {
  $pp_1 = $key->profile_photo;
} else if(isset($key->agent_logo)) {
  $pp_1 = $key->agent_logo;
} else {
  $pp_1 = ASSETS.'images/user-avatar.jpg';
}
?>

                        <div class="twouserimg"><img src="<?php echo $pp_1; ?>" alt="" title=""/></div>
                        <span class="twousrname"><?php echo $key->firstname; ?></span>
                      </a>
                  </div>
                  <div class="col-md-10 nopad margin-bottom-10">
                      <div class="inercoment">
                      <div class="colrcnt">
                        <div class="tipface">&#9666;</div>
                        <div class="clear"></div>
                        <?php echo $key->review_comments; ?>
                      </div>
                      </div>
                  </div>
                   <div class="clear"></div>
                </li>
                <?php } ?>
              <?php } else { ?>
                <span class="lishade">No reviews yet.</span>
              <?php } ?>
              </ul>
              <div class="holdereRvw"></div>
            </div>
          </div>
  
   </div>


<!-- Reviews about your property -->


   <div class="tab-pane revwAbtProp" id="abu">
          <span class="size16 padtabne bold">Pending Approvals</span>
        <div class="withedrow">
            <div class="rowit">
              <p class="normalpara">When you accept a review it will appear on your public profile. If you ignore a review it will not appear in your profile. </p>
              <div class="clear"></div>
              
              <?php if(!empty($reviewsAboutPropPending)) { ?>
              <ul id="rvwAbtPropPendingContainer">
                <?php foreach($reviewsAboutPropPending as $key) { ?>
                  <?php  
                    $strToTime_val = strtotime($key->posted_time);
                    $postDate = date("M d, Y", $strToTime_val);
                  ?>
                  <li>
                  <div class="hpadding20">              
                      <div class="col-md-4 offset-0 center">
                        <div class="padding20">
                          <div class="">
                            <div class="circlewrap">

<?php  
if(isset($key->profile_photo)) {
  $pp_2 = $key->profile_photo;
} else if(isset($key->agent_logo)) {
  $pp_2 = $key->agent_logo;
} else {
  $pp_2 = ASSETS.'images/user-avatar.jpg';
}
?>

                              <img src="<?php echo $pp_2;?>" class="circleimg" alt=""/>
                              <!-- <span>4.5</span> -->
                            </div>
                            <span class="dark">by <?php echo $key->firstname; ?></span><br/>
                            from <?php echo $key->address ?><br/>
                            <?php if($key->recommended == 1) { ?>
                              <img src="<?php echo ASSETS;?>images/check.png" alt=""/><br/>
                              <span class="green">Recommended<br/>for Everyone</span>
                            <?php } ?>
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-md-8 offset-0">
                        <div class="padding20">
                          <span class="opensans size16 dark"><?php echo $key->review_title; ?></span><br/>
                          <span class="opensans size13 lgrey">Posted <?php echo $postDate; ?> </span><br/>
                          <p> <?php echo $key->review_comment; ?> </p> 
                          <ul class="circle-listnew">
                            <li><a title="Cleanliness" class="scircle left"><?php echo $key->cleanliness; ?></a></li>
                            <li><a title="Communication" class="scircle left"><?php echo $key->communication; ?></a></li>
                            <li><a title="Check In" class="scircle left"><?php echo $key->checkin; ?></a></li>
                            <li><a title="Location" class="scircle left"><?php echo $key->localtion; ?></a></li>
                            <li><a title="Details Accuracy" class="scircle left"><?php echo $key->accuracy; ?></a></li>
                            <li><a title="Value for Price" class="scircle left"><?php echo $key->costvalue; ?></a></li>
                          </ul>
                        </div>
                      </div>
                      <a href="<?php echo WEB_URL.'/reviews/reviewAboutPropStatus/'.$key->reviews_user_data_id.'/-1'; ?>" class="filbtn bigpad">Ignore</a>
                    <a href="<?php echo WEB_URL.'/reviews/reviewAboutPropStatus/'.$key->reviews_user_data_id.'/1'; ?>" class="filbtn bigpad">Accept</a>
                      <div class="line2"></div>
                    <div class="clearfix"></div>
                  </div>  
                  <div class="clear"></div>
                  </li>
                <?php } ?>
                </ul>
                <div class="holdereRevAbtPropPending"></div>
              <?php } else { ?>
                <span class="lishade">No pending reviews.</span>
              <?php } ?>
            </div>
        </div>
      <span class="size16 padtabne bold">Past reviews about your property</span>
         <div class="withedrow">
            <div class="rowit">
               
                <?php if(!empty($reviewsAboutPropAccepted)) { ?>
                <ul id="rvwAbtPropContainer">
                <?php foreach($reviewsAboutPropAccepted as $key) { ?>
                <?php  
                $strToTime_val = strtotime($key->posted_time);
                $postDate = date("M d, Y", $strToTime_val);
                ?>
                <li>
                  <div class="hpadding20 nopad">              
                      <div class="col-md-4  center">
                        <div class="padding20">
                          <div class="colorsix">
                            <div class="circlewraprev">

<?php  
if(isset($key->profile_photo)) {
  $pp_3 = $key->profile_photo;
} else if(isset($key->agent_logo)) {
  $pp_3 = $key->agent_logo;
} else {
  $pp_3 = ASSETS.'images/user-avatar.jpg';
}
?>
                              <img src="<?php echo $pp_3;?>" class="" alt=""/>
                              <!-- <span>4.5</span> -->
                            </div>
                            <span class="dark">by <?php echo $key->firstname; ?></span><br/>
                            from <?php echo $key->address ?><br/>
                            <?php if($key->recommended == 1) { ?>
                              <img src="<?php echo ASSETS;?>images/check.png" alt=""/>&nbsp;&nbsp;
                              <span class="red">Recommended<br/>for Everyone</span>
                            <?php }  ?>
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-md-8 offset-0">
                        <div class="padding20">
                          <span class="opensans size16 dark"><?php echo $key->review_title; ?></span><br/>
                          <span class="opensans size13 lgrey">Posted <?php echo $postDate; ?> </span><br/>
                          <p> <?php echo $key->review_comment; ?> </p> 
                          <ul class="circle-listnew">
                            <li><a title="Cleanliness" class="scircle left"><?php echo $key->cleanliness; ?></a></li>
                            <li><a title="Communication" class="scircle left"><?php echo $key->communication; ?></a></li>
                            <li><a title="Check In" class="scircle left"><?php echo $key->checkin; ?></a></li>
                            <li><a title="Location" class="scircle left"><?php echo $key->localtion; ?></a></li>
                            <li><a title="Details Accuracy" class="scircle left"><?php echo $key->accuracy; ?></a></li>
                            <li><a title="Value for Price" class="scircle left"><?php echo $key->costvalue; ?></a></li>
                          </ul>
                        </div>
                      </div>
                      
                    <div class="clearfix"></div>
                  </div>  
                   <div class="clear"></div>
                </li>
                <?php } ?>
                </ul>
                <div class="holderRvwAbtProp"></div>
                <div class="line2"></div>
              <?php } else { ?>
                <div class="minedesply">
                    No reviews yet.                        
                </div>
              <?php } ?>
            </div>
          </div>
   </div>
</div>


</div>

<script type="text/javascript">
$(document).ready(function() {
    $(".scircle").tooltip();
});
</script>

<script>
function createRvwPagination() {
    $("div.holdereRvw").proPages({
        containerID: "rvwContainer",
        perPage: 3,
        keyBrowse: true,
        scrollBrowse: false,
        // animation: "flipInX",
        callback: function (pages, items) {
                if(items.count > 3) {
                  $("#legend1").html("Page " + pages.current + " of " + pages.count);
                  $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                } else {
                  $("div.holdereRvw").html('');
                }
            }
        });
}
function createPendingApprovalPagination() { 
  $("div.holderPendingApproval").proPages({
      containerID: "pendingApproval",
      perPage: 3,
      keyBrowse: true,
      scrollBrowse: false,
      // animation: "flipInX",
      callback: function (pages, items) {
              if(items.count > 1) {
                $("#legend1").html("Page " + pages.current + " of " + pages.count);
                $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
              } else {
                $("div.holderPendingApproval").html('');
              }
          }
      });
}

function createRevAbtPropPendingPagination() { 
  $("div.holdereRevAbtPropPending").proPages({
      containerID: "rvwAbtPropPendingContainer",
      perPage: 3,
      keyBrowse: true,
      scrollBrowse: false,
      // animation: "flipInX",
      callback: function (pages, items) {
              if(items.count > 1) {
                $("#legend1").html("Page " + pages.current + " of " + pages.count);
                $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
              } else {
                $("div.holdereRevAbtPropPending").html('');
              }
          }
  });
}

function createRevAbtPropPagination() { 
  $("div.holderRvwAbtProp").proPages({
      containerID: "rvwAbtPropContainer",
      perPage: 3,
      keyBrowse: true,
      scrollBrowse: false,
      // animation: "flipInX",
      callback: function (pages, items) {
              if(items.count > 1) {
                $("#legend1").html("Page " + pages.current + " of " + pages.count);
                $("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
              } else {
                $("div.holderRvwAbtProp").html('');
              }
          }
  });
}

$(document).ready(function() {
  createRvwPagination();
  createPendingApprovalPagination();

  $('#revAbtPropTab').on('click', function() {
    $('.revwAbtProp').show();
    createRevAbtPropPendingPagination();
    createRevAbtPropPagination();
  })

  $('#revAbtYouTab').on('click', function() {
    $('.revwAbtProp').hide();
  })

})

  
</script>