<?php
	session_start();
	require "config.php";
	require "application/ORM.class.php";
	require "application/Validation.class.php";
	require "phpmailer/class.phpmailer.php";
	
	$task = isset($_REQUEST['task']) ? $_REQUEST['task'] : "";
	
	switch($task){

        case"sendEmail":
            sendEDM();
        break;
    
	}
	
	function sendEDM(){
		ORM::configure(array(
			'connection_string' => CONNECTION_STRING,
			'username' => DATABASE_USER,
			'password' => DATABASE_PASSWORD,
			'logging' => true
		));
		
		$name = isset($_REQUEST['fname']) ? $_REQUEST['fname'] : "";
		$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : "";
		$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
		$location = isset($_REQUEST['location']) ? $_REQUEST['location'] : "";
		
		$errors = array();
		
		$validation = new Validation();
		
		$_SESSION['location'] = $location; 	
		$_SESSION['email'] = $email;
		$_SESSION['phone'] = $phone;
		$_SESSION['fname'] = $name;  
		if($validation->validate_all($location)){
						//echo 'All is fyn';
		}else{
			$errors[] = 'Please enter a valid Location';
		}
		if($validation->validate_email($email)){
					
		}else{
			 $errors[] = 'Please enter a valid Email';	
		}
		if($validation->validate_phone($phone)){
				
			}else{
					$errors[] = 'Please enter a valid Phone';
			}
		if($validation->validate_all($name)){
			
		}else{
				$errors[] = 'Please enter a valid name';
		}
		
		if(count($errors) > 0){
			$_SESSION['errors'] = $errors;
			
			header('location:'.BASE_URL.'/index.php');	
		}else{
			
			define('EMAIL_FROM_ADDRESS_INNER', $email);
			define('EMAIL_FROM_NAME_INNER', $name);
			define('EMAIL_REPLY_TO_ADDRESS_INNER', $email);
			define('EMAIL_REPLY_TO_NAME_INNER', $name);
			
			$htmllink = 'edm/index.html';
			$message = file_get_contents($htmllink);
			$message = str_replace("{name}", $name, $message);
			$message = str_replace("{email}", $email, $message);
			$message = str_replace("{phone}", $phone, $message);
			$message = str_replace("{location}", $location, $message);
			
			
			$message = str_replace(chr(194),"", $message);
			
			if(sendEmail(EMAIL_FROM_ADDRESS, EMAIL_FROM_NAME, $message)){

				//save to db after sending email
				//1. fields to be inserted
				$enquiry = array('name'=>$name,'email'=>$email,
									'phone'=>$phone,'location'=>$location);
				//2. set on class to save
				ORM::for_table('mastercard')->create($enquiry)->save();
	
	
					header('location:'.BASE_URL.'/thankyou.php');
					
				}else{
					
					$errors[] = 'Failed to send email';
					$_SESSION['errors'] = $errors;
			
					header('location:'.BASE_URL.'/index.php');	
				}
			
			}
		
		
	}


function sendEmail($sendToAddress, $sendToName, $message){
		try{
			echo $smtp_account = SMTP_USER_ACCOUNT;
			$mailSender = new PHPMailer();
			
			if(!empty($smtp_account)){
				$mailSender->IsSMTP();
				$mailSender->Host = EMAIL_SERVER;
				$mailSender->SMTPAuth = SMTP_AUTH;
				$mailSender->SMTPSecure = "ssl";
				$mailSender->SMTPDebug = 2;
				$mailSender->Port = EMAIL_SERVER_PORT;
				$mailSender->IsHTML(true);
				$mailSender->Username = SMTP_USER_ACCOUNT;
				$mailSender->Password = SMTP_USER_PASSWORD;
				//$mailSender->setFrom(SMTP_USER_ACCOUNT, SMTP_USER_ACCOUNT);
				$mailSender->SetFrom(EMAIL_FROM_ADDRESS_INNER, EMAIL_FROM_NAME_INNER);
				$mailSender->AddReplyTo(defined('EMAIL_REPLY_TO_ADDRESS_INNER') ? EMAIL_REPLY_TO_ADDRESS_INNER : "", defined('EMAIL_REPLY_TO_NAME_INNER') ? EMAIL_REPLY_TO_NAME_INNER : "");
				$mailSender->Subject = defined('EMAIL_SUBJECT') ? EMAIL_SUBJECT : 'Be part of the Equity Mastercard Members';
				$mailSender->AltBody = EMAIL_ALTERNATE_BODY_MESSAGE;
				$mailSender->MsgHTML($message);
				$mailSender->AddAddress($sendToAddress, $sendToName);
				//$mailSender->AddAddress(EMAIL_FROM_ADDRESS_INNER, EMAIL_FROM_NAME_INNER);
			}else{
				$mailSender->Host = EMAIL_SERVER;
				$mailSender->SMTPDebug = 0;
				$mailSender->Port = 25;
				$mailSender->IsHTML(true);
				$mailSender->SetFrom(EMAIL_FROM_ADDRESS_INNER, EMAIL_FROM_NAME_INNER);
				$mailSender->AddReplyTo(defined('EMAIL_REPLY_TO_ADDRESS_INNER') ? EMAIL_REPLY_TO_ADDRESS_INNER : "", defined('EMAIL_REPLY_TO_NAME_INNER') ? EMAIL_REPLY_TO_NAME_INNER : "");
				$mailSender->Subject = defined('EMAIL_SUBJECT') ? EMAIL_SUBJECT : 'Be part of the Equity Mastercard Members';
				$mailSender->AltBody = EMAIL_ALTERNATE_BODY_MESSAGE;
				$mailSender->MsgHTML($message);
				$mailSender->AddAddress($sendToAddress, $sendToName);
			}
			
			if(!$mailSender->Send()){
				return false;
			} else {
				return true;
			}
		}catch (Exception $ex){
			return false;
		}
	}
   
?>