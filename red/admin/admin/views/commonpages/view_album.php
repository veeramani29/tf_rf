<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>:: Endeavor - Admin Panel ::</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">

<link rel="stylesheet" href="<?= base_url();?>public/lightbox/dist/css/lightbox.css">

</head>
<body>
<?php $this->load->view('header'); ?>

<div class="breadcrumbs">
<div class="container-fluid">
<ul class="bread pull-left">
<li>
<a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
</li>
<li>
<a href="<?php echo site_url(); ?>/home">
Dashboard
</a>
</li>
</ul>
</div>
</div>


<div class="main">
<?php echo $this->load->view('leftpanel'); ?>
<div class="container-fluid">
<div class="content">
<?php echo $this->load->view('topmenu'); ?>

<div class="row-fluid">
<div class="span12">
<div class="box">
<div class="box-head tabs">
<h3>Common Pages Management</h3>
<!--<ul class='nav nav-tabs'>							
<a href="<?php echo site_url(); ?>/b2b/create_agent" ><button class="btn btn-primary">Create New Agent</button>
</a>							
         
         
</ul>-->
<ul class="nav  nav-pills">
<li>
<a class="tip btn btn-mini" href="<?php echo site_url(); ?>/commonpages/create_album" data-original-title="Add New commonpages">
<button type="button" class="btn btn-primary">Add Common Pages</button>                     
</a>
</li>



</ul>							
</div>
<div class="box-content box-nomargin">
<div class="tab-content">
<div class="tab-pane active" id="user-list">
<table class='table table-striped dataTable table-bordered'>


<thead>
<tr>
<th>SI.No</th> 
<th>Title</th>
<th>Image</th>                        
<th>Actions</th>
</tr>
</thead>


<tbody>
<?php if (!empty($commonpages)) { 
$i = 1;
?>

<?php foreach($commonpages as $lb) { 

?>
<tr>
<td><?php echo $i++; ?></td>
<td class="center"><?php echo $lb->title;?></td>
<td class="center">
<a class="example-image-link" href="<?= base_url();?>/upload/commonpages/<?php echo $lb->cover_pic;?>" data-lightbox="example-set" >
<img src="<?= base_url();?>/upload/commonpages/<?php echo $lb->cover_pic; ?>" height="50px" width="50px"  />
</a>
</td>

<td class="center">
   <a class="btn btn-info" href="<?php echo site_url(); ?>/commonpages/edit_album/<?php echo $lb->id; ?>" title="Edit" data-rel="tooltip">
        <i class="icon-edit icon-white"></i> 
    </a>
    <a class="btn btn-danger" href="<?php echo site_url(); ?>/commonpages/delete_album/<?php echo $lb->id; ?>" title="Delete / Block" data-rel="tooltip" onClick="return confirm('Do you Want to delete this link!')">
        <i class="icon-trash icon-white"></i> 
    </a>
</td>
</tr>
<?php } ?>
<?php } else { ?>
<div class="alert alert-error">
<button class="close" data-dismiss="alert" type="button">×</button>
<strong>Error!</strong>
No Data Found. Please try after some time...
</div>
<?php } ?>
</tbody>
</table>
</div>

<div class="tab-pane" id="active-users">

</div>
</div>
</div>
</div>
</div>
</div>
</div>	
</div>
</div>	
<script src="<?php echo base_url(); ?>public/lightbox/dist/js/lightbox-plus-jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/js/less.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>
<!-- My Custom JS-->
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>
</body>
</html>