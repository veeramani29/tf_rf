<div id="content">
<?php

echo $links;
//PRINT TABLE
echo '<pre>';print_r($apartments);
?>
</div>
<script type="text/javascript" src="<?php echo ASSETS;?>js/prototype.js"></script>
<script type="text/javascript">
//new Ajax.Updater("content","http://localhost/InnoGlobe/apartment/index/",{method: "post", parameters:{"page":"3"}, evalScripts:true});return false;
</script>
