<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
		       
// Language Name :  farsi 
// Language Title :   Account_Login_AL
$ci =& get_instance();
$ci->load->model('Language_Model');
$languages = $ci->Language_Model->getlangdata('farsi','Account_Login_AL');
foreach($languages as $lng){
	$lang[$lng->label]=$lng->farsi;
}

/*$lang['AL_Reset'] = "Reset Your Password";
$lang['AL_NewPass'] = "New Password";
$lang['AL_CPass'] = "Confirm Password";
$lang['AL_SC'] = "Save & Continue";
$lang['AL_Suddenly'] = "Suddenly remeber password?";
$lang['AL_SignIn'] = "SignIn";
$lang['AL_SignUp'] = "SignUp";
$lang['AL_FName'] = "First name";
$lang['AL_LName'] = "Last name";
$lang['AL_CName'] = "Company Name";
$lang['AL_EEmail'] = "Email Address";
$lang['AL_EPass'] = "Password";
$lang['AL_SelectCountry'] = "Select Country Code";
$lang['AL_Modile'] = "Mobile";
$lang['AL_Agree'] = "By signing up, I agree to InnoGlobe";
$lang['AL_Terms'] = "Terms of Service";
$lang['AL_Privacy'] = "Privacy Policy";
$lang['AL_Refund'] = "Guest Refund Policy";
$lang['AL_Host'] = "Host Guarantee Terms";
$lang['AL_And'] = "and";
$lang['AL_Already'] = "Already an InnoGlobe member?";
$lang['AL_Remember'] = "Remember me";
$lang['AL_Forget'] = "Forgot password?";
$lang['AL_Login'] = "Login";
$lang['AL_Dont'] = "Don't have an account? ";
$lang['AL_Verify'] = "Verify Contact Details";
$lang['AL_Verify_send'] = "Enter the verification codes sent to your email and mobile numbers";
$lang['AL_Email_Verify'] = "Enter email verification code";
$lang['AL_Mobile_Verify'] = "Enter mobile verification code";
$lang['AL_Submit'] = "Submit details";
$lang['AL_Problem'] = "Problem receiving verification code?";
$lang['AL_Thanku'] = "Thank you,";
$lang['AL_Shortly'] = "We'll shortly contact you.";
$lang['AL_Contact'] = "Contact Admin";
$lang['AL_EMessage'] = "Enter your message:";
$lang['AL_SMessage'] = "Send Message";
$lang['AL_Problem_Verify'] = "Enter the problem faced while receiving the verification code...";
$lang['AL_EmailAuth'] = "Email Authentication";
$lang['AL_Congrat'] = "Congratulations";
$lang['AL_Success'] = "Your Agent account has been created successfully";
$lang['AL_ACC_Verify'] = "Your account will now be verified by the InnoGlobe admin.";
$lang['AL_Soon'] = "We will be back to you soon...";
$lang['AL_Home'] = "Home";
$lang['AL_Help'] = "Help";*/
