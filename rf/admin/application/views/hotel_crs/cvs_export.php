 <?php error_reporting(0);?>
<HTML>
<HEAD>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <SCRIPT language="javascript">
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
</SCRIPT>
</HEAD>
<BODY>

 <form method="post" action="<?php echo base_url(); ?>hotelcrs/verifyVisitors">
 
 
<table border="1">
<tr>
    <th><input type="checkbox" id="selectall"/></th>
    <th>Cell phone</th>
    <th>Rating</th>
</tr>

<?php foreach($res as  $result) { ?>
<tr>
    <td align="center"><input type="checkbox" class="case" name="cid[]" value="<?php echo $result->user_id;?>"/></td>
    <td><?php echo $result->email;?></td>  <td><?php echo $result->firstname;?> </td> <td><?php echo $result->lastname;?> </td>
    <td>2/5</td>
</tr>

<?php 

 
?>

<?php } ?>
 
 
</table>
 
 
<input type="submit" name="submit" value="Sub"> 
 </form>
 
 
</BODY>
</HTML>
 
 