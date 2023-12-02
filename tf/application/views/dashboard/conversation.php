<?php $this->load->view('common/header');?>
	<div class="clear"></div>
<div class="full brdcrump marintopcnt">
    <div class="container">
        <ul class="nav profile-tabs">
            <li class="brdli <?php if (empty($page_type)) {
    echo "active";
} ?>"> <a href="#dashbord" data-toggle="tab">Dashboard</a> </li>
            <li class="brdli <?php if (!empty($page_type) && $page_type == "inbox") {
    echo "active";
} ?>"> <a href="#inbox" data-toggle="tab">Inbox</a> </li>
            <li class="brdli <?php if (!empty($page_type) && $page_type == "listing") {
    echo "active";
} ?>"> <a href="#yourlisting" data-toggle="tab">Your Listing</a> </li>
            <li class="brdli <?php if (!empty($page_type) && $page_type == "trips") {
    echo "active";
} ?>"> <a href="#yourtrips" data-toggle="tab">Your Trips</a> </li>
            <li class="brdli <?php if (!empty($page_type) && $page_type == "profile") {
    echo "active";
} ?>"> <a href="#profile" data-toggle="tab">Your profile</a> </li>
            <li class="brdli <?php if (!empty($page_type) && $page_type == "bookings") {
    echo "active";
} ?>"> <a href="#bookings" data-toggle="tab" onclick="mySelectUpdate()"> Bookings</a> </li>
            <li class="brdli <?php if (!empty($page_type) && $page_type == "wishlist") {
    echo "active";
} ?>"> <a href="#wishlist" data-toggle="tab" onclick="mySelectUpdate()">Wishlist</a> </li>
            <li class="brdli <?php if (!empty($page_type) && $page_type == "settings") {
                echo "active";
            } ?>"> <a href="#settings" data-toggle="tab" onclick="mySelectUpdate()">Settings</a> </li>
            <?php /*?><li class="brdli <?php if (!empty($page_type) && $page_type == "password") {
                echo "active";
            } ?>"> <a href="#chg_password" data-toggle="tab" onclick="mySelectUpdate()">Change password</a> </li><?php */?>
            <li class="brdli <?php if (!empty($page_type) && $page_type == "newsletter") {
                echo "active";
            } ?>"> <a href="#newsletter" data-toggle="tab" onclick="mySelectUpdate()"> Newsletters </a> </li>
        </ul>
    </div>
</div>
<div class="clear"></div>
<?php $this->load->view('common/footer');?>