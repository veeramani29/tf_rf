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
<h3>API Management</h3>
<!--<ul class='nav nav-tabs'>							
<a href="<?php echo site_url(); ?>/b2b/create_agent" ><button class="btn btn-primary">Create New Agent</button>
</a>							
         
         
</ul>-->
<ul class="nav  nav-pills">
<li>
<a class="tip btn btn-mini" href="<?php echo site_url(); ?>/api/create_album" data-original-title="Add New api">
<button type="button" class="btn btn-primary">Add API</button>                     
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
<th>service_type</th>
<th>api_name</th>
<th>client_id</th>
<th>username</th> 
<th>password</th>
<th>order_no</th> 
<th>Status</th>                       
<th>Actions</th>
</tr>
</thead>


<tbody>
<?php if (!empty($api)) { 
$i = 1;
?>

<?php foreach($api as $lb) { 

?>
<tr>
<td><?php echo $i++; ?></td>
<td class="center">
<?php 
if($lb->service_type == 1)
{
echo 'Hotel'; 
}
else if($lb->service_type == 2)
{
echo 'Flight';
}
else
echo 'Car';
?>
</td>


<td class="center">
<?php echo $lb->api_name; ?>
</td>
<td class="center"><?php echo $lb->client_id; ?></td>
<td class="center">
<?php echo $lb->username; ?>
</td>
<td class="center"><?php echo $lb->password; ?></td>
<td class="center"><?php echo $lb->order_no; ?></td>

<td class="center">
<?php if($lb->status == 0) { ?>
<span class="label">Inactive</span>
<?php } else {?>
<span class="label label-success">Active</span>
<?php } ?>
</td>

<td class="center">
   <a class="btn btn-info" href="<?php echo site_url(); ?>/api/edit_album/<?php echo $lb->api_id; ?>" title="Edit" data-rel="tooltip">
        <i class="icon-edit icon-white"></i> 
    </a>
    <a class="btn btn-danger" href="<?php echo site_url(); ?>/api/delete_album/<?php echo $lb->api_id ; ?>" title="Delete / Block" data-rel="tooltip" onClick="return confirm('Do you Want to delete this link!')">
        <i class="icon-trash icon-white"></i> 
    </a>
    
    <a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Active" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="1" data-api-id="<?php echo $lb->api_id;?>" data-api-name="<?php echo $lb->api_name;?>">

<i class="icon-ok"></i>			                                          
</a>

<a class="btn btn-small manageAPIStatus" href="javascript:void(0);" title="Inactive" data-rel="tooltip" data-base-url="<?php echo site_url();?>/" data-value="0" data-api-id="<?php echo $lb->api_id;?>" data-api-name="<?php echo $lb->api_name;?>">

<i class="icon icon-color icon-remove"></i>			                                          
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
