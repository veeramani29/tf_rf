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
                            <div style="font-size:22px;">New Sub Agent added confirmation - Redtag Travels</div>
                            <div style="font-size:18px; color:#006d00;">
                                <p>The new sub agent is successfully added and is active now. Add deposit balance to his account. So that sub agent can book tickets.</p>
                                <p>Below are the brief details of sub agent added by you.</p>
                                <p>Sub Agent Name : <?php echo $sub_agent_name; ?></p>
                                <p>Company Name : <?php echo $sub_agent_company_name; ?></p>
                                <p>Account Id : <?php echo $user_no; ?></p>
                                <p>Email Id : <?php echo $sub_email_id; ?></p>
                                <p>Contact No. : <?php echo $sub_agent_phone_code.'-'.$sub_agent_phone_no; ?></p>
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
            <td width="50%" align="left" valign="top" style="color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:11px;">Hello, <?php echo $sub_agent_name; ?></td>
            <td align="right" valign="top" style="color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:11px;"><?php echo date('Y-m-d'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
            <td align="center" valign="top" bgcolor="#ffffff" style="background-color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:12px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom:10px;">
                    <tr>
                        <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#525252;">
                            <div style="font-size:22px;">Welcome to Redtag Travels - Agent Portal</div>
                            <div style="font-size:18px; color:#006d00;">
                                <p>Your account has been created by Redtag Travels agent - <?php echo $company_name; ?>.</p>
                                <p>Below is your account details and login information. You can login and change your password from my profile section for security reasons.</p>
                                <br />
                                <p><b>Profile Information</b></p>
                                <p>Agent Name : <?php echo $sub_agent_name; ?></p>
                                <p>Company Name : <?php echo $sub_agent_company_name; ?></p>
                                <p>Account Id : <?php echo $user_no; ?></p>
                                <p>Contact No. : <?php echo $sub_agent_phone_code.'-'.$sub_agent_phone_no; ?></p>
                                <br />
                                <p><b>Login Information</b></p>
                                <p>Email Id : <?php echo $sub_email_id; ?></p>
                                <p>Password : <?php echo $sub_pass; ?></p>
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
