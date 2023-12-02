<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Redtag Travels</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" bgcolor="#dcdbdb" style="background-color:#fff;"><br>
    <br>
    <table width="600" border="0" cellspacing="0" cellpadding="0" style='border:1px solid #dcdbdb;'>
     <!-- <tr>
        <td align="left" valign="top" style="padding:5px;"><img src="images/company-logo.png" width="100" height="67" style="display:block;"></td>
      </tr> -->
      <tr>
        <td align="left" valign="top">
            <img src="<?php echo base_url() ?>assets/images/logo.png" width="100" height="100" style="display:block;">
        </td>
      </tr>
      <?php 
        if($mail_type == 'agent'){
      ?>
      <tr>
        <td align="center" valign="top" bgcolor="#dcdbdb" style="background-color:#dcdbdb; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="50%" align="left" valign="top" style="color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:11px;">Hello, <?php echo $agent_name; ?></td>
            <td align="right" valign="top" style="color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:11px;"><?php echo date('Y-m-d'); ?></td>
          </tr>
        </table></td>
      </tr>
        <tr>
            <td align="center" valign="top" bgcolor="#ffffff" style="background-color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:12px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom:10px;">
                    <tr>
                        <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#525252;">
                            <div style="font-size:22px;">New Deposit Request - Redtag Travels Agent Portal</div>
                            <div style="font-size:18px; color:#006d00;">
                                <p>This mail is to confirm you that your deposit request has been successfully done. It will be activated after review by administration with in 24hrs. The same will be reflected in your Deposit section.</p>
                                <p>Below are the brief details of deposit request made by you.</p>
                                <p>Agent Name : <?php echo $agent_name; ?></p>
                                <p>Company Name : <?php echo $agent_name; ?></p>
                                <p>Account Id : <?php echo $userNo; ?></p>
                                <p>Deposit Type : <?php echo $deposit_type; ?></p>
                                <p>Deposit Amount : <?php echo $deposit_amount; ?></p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
      <?php 
        } else {
      ?>
      <tr>
        <td align="center" valign="top" bgcolor="#006c00" style="background-color:#a2b417; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="50%" align="left" valign="top" style="color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:11px;">Hello, <?php echo "Admin"; ?></td>
            <td align="right" valign="top" style="color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:11px;"><?php echo date('Y-m-d'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
            <td align="center" valign="top" bgcolor="#ffffff" style="background-color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:12px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom:10px;">
                    <tr>
                        <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#525252;">
                            <div style="font-size:22px;">New Deposit Request Notification - Agent Portal</div>
                            <div style="font-size:18px; color:#006d00;">
                                <p>A new deposit request has been done by agent.</p>
                                <p>Below are the brief details of deposit request made by you.</p>
                                <p>Agent Name : <?php echo $agent_name; ?></p>
                                <p>Company Name : <?php echo $agent_name; ?></p>
                                <p>Account Id : <?php echo $userNo; ?></p>
                                <p>Deposit Type : <?php echo $deposit_type; ?></p>
                                <p>Deposit Amount : <?php echo $deposit_amount; ?></p>
                                
                                <p>Login to admin portal and review the same and activate or deactivate the request.</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
      <?php 
        }
      ?>
      <tr>
        <td align="left" valign="top" bgcolor="#dcdbdb" style="background-color:#dcdbdb;"><table width="100%" border="0" cellspacing="0" cellpadding="15">
          <tr>
            <td align="left" valign="top" style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px;">CORPORATE OFFICE:<br>
              Lorem ipsum dolor sit amet, cons  <br>
ectetueradipiscing elit, sed diam nonu my nibh , <br>
euis motincidunt ut laoreetd,<br> Manila, Phillipines 
             </td>
          </tr>
        </table></td>
      </tr>
  </table>
    <br>
    <br></td>
  </tr>
</table>
</body>
</html>
