<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" href="<?php echo ASSETS;?>css/uploadfile.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo ASSETS;?>css/bootstrap-multiselect.css" type="text/css"/>
<!-- <link href="<?php echo ASSETS;?>/css/custom.css" rel="stylesheet" media="screen"> -->
<link href="<?php echo ASSETS;?>/css/dashboard-style.css" rel="stylesheet" media="screen">

<style type="text/css">.pac-container:after{content: initial !important;}</style>
<script>
$(document).ready(function() {
        //initialize();
        $('.addPhonePopup').click(function() {
            $(this).fadeOut();
            $('.sendVerification').fadeIn(500);
        });
    });
</script>
<?php
function welcome() {
    if (date("H") < 12) {
        return lang_line("GD_MOR");
    } elseif (date("H") > 11 && date("H") < 18) {
        return lang_line('GD_AFT');
    } elseif (date("H") > 17) {
        return lang_line('GD_EVE');
    }
}
?>
<div class="clear"></div>
<div class="full brdcrump marintopcnt dashnav_container">
    <div class="container">
        <ul class="nav nav-pills">
            <li class="<?php if (empty($page_type)) {echo "active"; } ?>"> 
                <a href="#dashbord" data-toggle="tab" data-link="<?php echo base_url().'dashboard' ?>" class="dshbrdLnk"><?php echo lang_line('DASHBOARD');?></a> 
            </li>
            <li class="<?php if (!empty($page_type) && $page_type == "profile") {echo "active";} ?>"> 
                <a href="#profile" data-toggle="tab" data-link="<?php echo base_url().'dashboard/profile' ?>" class="dshbrdLnk"><?php echo lang_line('UR_PRFL');?></a> 
            </li>
            <li class="<?php if (!empty($page_type) && $page_type == "bookings") {echo "active";} ?>"> 
                <a href="#bookings" data-toggle="tab" onclick="mySelectUpdate()" data-link="<?php echo base_url().'dashboard/bookings'; ?>" class="dshbrdLnk"> <?php echo lang_line('BOOKINGS');?> </a> 
            </li>
            <li class="<?php if (!empty($page_type) && $page_type == "settings") {echo "active";} ?>"> 
                <a href="#settings" data-toggle="tab" onclick="mySelectUpdate()" data-link="<?php echo base_url().'dashboard/settings'; ?>" class="dshbrdLnk"><?php echo lang_line('SETTINGS');?> </a> 
            </li>
          
            <!-- <li class="<?php if (!empty($page_type) && $page_type == "newsletter") {echo "active";} ?>"> 
                <a href="#newsletter" data-toggle="tab" onclick="mySelectUpdate()" data-link="<?php echo base_url().'dashboard/newsletter'; ?>" class="dshbrdLnk"> <?php echo lang_line('NEWS_LTR');?> </a> 
            </li> -->
        </ul>
    </div>
</div>
<div class="clear"></div>

<!-- CONTENT -->
<div class="dash_container">
    <div class="container martopbtm">
        <div class="tab-content5">
            <?php if (isset($email_v)) { ?>
            <div class="msg" style="display: block;"><?php echo $email_v; ?></div>
            <?php } ?>
            <?php if (isset($err_v)) { ?>
            <div class="msg" style="display: block;"><?php echo $err_v; ?></div>
            <?php } ?>
            <?php if (isset($d_msg)) { ?>
            <div class="msg" style="display: block;"><?php echo $d_msg; ?></div>  
            <?php } ?>

            <div class="msg" style="display: none;"></div>
            <div class="errstatus" style="display: none;"></div>

            <?php $this->load->view('dashboard/dashboard'); ?>
            <?php $this->load->view('dashboard/inbox'); ?>
            <?php $this->load->view('dashboard/yourlisting'); ?>
            <?php $this->load->view('dashboard/your_listing_v'); ?>
             
            <?php $this->load->view('dashboard/profile'); ?>      
            <?php $this->load->view('dashboard/bookings'); ?>     
           
            <?php $this->load->view('dashboard/settings'); ?>     
               
            <?php $this->load->view('dashboard/newsletter'); ?>     


        </div>
        
    </div>
</div>

<div class="clearfix"></div>
<?php $this->load->view('common/footer'); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script src="<?php echo ASSETS;?>js/jquery.uploadfile.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/bootstrap-multiselect.js"></script>
<script type="text/javascript">


$("#my_profile_photo").uploadFile({
    url: WEB_URL+"/dashboard/update_user_profile_image",
    fileName: "myfile",
    allowedTypes: "png,gif,jpg,jpeg",
    returnType: "json",
    onSuccess: function(files, data, xhr) {
        $(".profile_photo").attr("src", data.img);
    },
});

</script>


<script src="<?php echo ASSETS; ?>js/jquery.ajaxform.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
    $('#profilePhoto').on('change', function() {
        $('.imgLoader').fadeIn();
        $("#myForm").ajaxForm({
            dataType: 'json',
            success: function(r) {
                    //$('.fstusrp').html('<img src="'+r.img+'">');
                    //$('.profileusrs').html('<img src="'+r.img+'">');
                    $('.profile_photo').attr("src", r.img);
                    $('.imgLoader').fadeOut();
                }
            }).submit();
    })
}); 
</script>


<script type="text/javascript">
setTimeout(function() {
    $('.msg').hide();
}, 6000);
//Language multiselect
$(document).ready(function() {
    $(".tooltip-a").tooltip();

    var orderCount = 0;
    $('#example38').multiselect({
        buttonClass: 'btn btn-link',
        buttonText: function(options) {
            if (options.length == 0) {
                return 'None selected ';
            }
            else if (options.length > 3) {
                return options.length + ' selected  ';
            }
            else {
                var selected = [];
                options.each(function() {
                    selected.push([$(this).text(), $(this).data('order')]);
                });

                selected.sort(function(a, b) {
                    return a[1] - b[1];
                });

                var text = '';
                for (var i = 0; i < selected.length; i++) {
                    text += selected[i][0] + ', ';
                }

                return text.substr(0, text.length - 2) + ' ';
            }
        },
        onChange: function(option, checked) {
            if (checked) {
                orderCount++;
                $(option).data('order', orderCount);
            }
            else {
                $(option).data('order', '');
            }
                //callselct();
            }
        });

$('#example38-order').on('click', function() {
    var selected = [];
    $('#example38 option:selected').each(function() {
        selected.push([$(this).val(), $(this).data('order')]);
    });

    selected.sort(function(a, b) {
        return a[1] - b[1];
    });

    var text = '';
    for (var i = 0; i < selected.length; i++) {
        text += selected[i][0] + ',';
    }
    text = text.substring(0, text.length - 1);

    $('#languages').val(text);
});

function callselct() {
    var selected = [];
    $('#example38 option:selected').each(function() {
        selected.push([$(this).val(), $(this).data('order')]);
    });

    selected.sort(function(a, b) {
        return a[1] - b[1];
    });

    var text = '';
    for (var i = 0; i < selected.length; i++) {
        text += selected[i][0] + ',';
    }
    text = text.substring(0, text.length - 2);

    $('#languages').val(text);
}
});

function msgHide() {
    setTimeout(function() {
        $('.msg').hide();
    }, 6000);
}

$('.resend_v').click(function() {
    $.ajax({
        url: '<?php echo WEB_URL; ?>/account/sendEmailVerification',
        dataType: 'json',
        beforeSend: function(){
            $('.loadr').toggle();
        },
        success: function(data) {
            $('.loadr, .loadr-tick').toggle();
        }
    });
});
</script>

<script type="text/javascript">
$(function() {

	$('#depostDatatable').DataTable( {

        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "<?php echo ASSETS;?>swf/copy_csv_xls_pdf.swf"
        }
    } );
})
</script>


<script>
$('.dshbrdLnk').on('click', function() {
 /*   var u = $(this).data('link');
 history.pushState(null, 'title', u); */
})

</script>