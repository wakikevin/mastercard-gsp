<?php
error_reporting(E_ALL);
session_start();
//print_r($_SESSION);
//echo sess; 
$name = isset($_SESSION['fname']) ? $_SESSION['fname'] :'';
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] :'';
$email = isset($_SESSION['email']) ? $_SESSION['email'] :'';
$location = isset($_SESSION['location']) ? $_SESSION['location'] :'';
//$action = isset($_SESSION['name']) ? $_SESSION['name'] :'';
if(count($_SESSION) > 0){
	$action = 'ajax.php';
}else{
	$action ='ajax.php';	
}
$errorP = '';
if(!empty($_SESSION['errors']) && count($_SESSION['errors']) > 0){
	foreach($_SESSION['errors'] as $error){
		$errorP .= '<p style="border: 1px solid rgb(255, 0, 0); padding: 5px; border-radius: 5px; font-size: 13px;">'.$error.'</p>';
		}
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Get yourself Equity AutoBranch
MasterCard today</title>
</head>

<body>

<div style="margin:0;padding:0;font-family:Myriad Pro,&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:14px;color:#4f4c4c;background:#cccccc">
<form id="gsp_form" name="gsp_form" action="<?php echo $action; ?>" method="post">
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" style="background:#ffffff">
	  <tr>
	    <td align="left" valign="top" style="margin:0; padding:0; font-family:Myriad Pro, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px; display:block; color:#4c4c4c;"><a href="http://ke.equitybankgroup.com/" style="border:none; outline:none;"><img src="images/equity-logo.png" width="73" height="38" alt="Equity Bank" style="margin:10px 20px 0;"></a></td>
	    <td align="right" valign="top"><img src="images/mastercard-logo.png" width="73" height="51" alt="Mastercard" style="margin:10px 20px 0;"></td>
  </tr>
	  <tr>
	    <td colspan="2" align="left" valign="top">
   	    <img src="images/main.jpg" alt="Get yourself an Equity AutoBranch
MasterCard today" width="650" height="207" vspace="0" align="top" style="border:none; display:block; margin:0;"></td>
  </tr>
	  <tr>
	    <td colspan="2" align="left" valign="top">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="54%"  align="left" valign="top" style="padding:20px;">
                	<p style="margin:0 0 10px; padding:0; font-family:Myriad Pro, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px; ">The Equity Autobranch MasterCard with PayPass is a faster, convenient more secure way to shop and access your account at home and abroad.</p>
                    <h4 style="font-size: 18px; color:#fd9c32;  padding:0; font-family:Myriad Pro, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-weight: normal; margin: 15px 0;">
                    	Get your card instantly at your Equity Bank branch  today.
                    </h4>
                </td>
                <td width="46%"  align="left" valign="top" style="background:#f1f1f1; padding:30px;">
                		<?php echo $errorP; ?>
                    	<input type="text" placeholder="Name" name="fname" style="border:none; padding:12px 5%; width:90%; font-size:16px; margin-bottom:25px; font-family:Myriad Pro, 'Helvetica Neue', Helvetica, Arial, sans-serif;" autofocus required value="<?php echo $name; ?>"/>
                        <input type="tel" placeholder="Phone Number" name="phone" style="border:none; padding:12px 5%; width:90%; font-family:Myriad Pro, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px; margin-bottom:25px;" value="<?php echo $phone; ?>" required>
                        <input type="email" placeholder="Email" name="email" style="border:none; padding:12px 5%; width:90%; font-family:Myriad Pro, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px; margin-bottom:25px;" value="<?php echo $email; ?>" required>
                        <input type="text" placeholder="Location" name="location" style="border:none; padding:12px 5%; width:90%; font-family:Myriad Pro, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:16px; margin-bottom:25px;" value="<?php echo $location; ?>" required>
                        <input name="task" type="hidden" value="sendEmail" />
                    	<input name="submitgsp" type="submit" value="SUBMIT " style="background:#fd972c; border:none;font-family:Myriad Pro, 'Helvetica Neue', Helvetica, Arial, sans-serif; padding:10px 20px; font-weight:bold; font-family:Myriad Pro, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:18px; color:#ffffff; cursor:pointer;">
                   
                </td>
              </tr>
            </table>
        </td>
  </tr>
 
</table>
</form>
</div>
</body>
</html>
