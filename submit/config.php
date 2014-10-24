<?php
	
	
	if($_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'localhost'){
		define('DATABASE_SERVER','localhost');
		define('DATABASE_USER','root');
		define('DATABASE_PASSWORD','');
		define('DATABASE_NAME','mastercard');
		define('CONNECTION_STRING', 'mysql:host=localhost;dbname=mastercard');
		
		define("BASE_URL", "http://127.0.0.1/gsp/submit");
	}else{
		define('DATABASE_SERVER','equityinsurance.db.9126389.hostedresource.com');
		define('DATABASE_USER','equityinsurance');
		define('DATABASE_PASSWORD','DI9C4Ge7c3@');
		define('DATABASE_NAME','equityinsurance');
		define('CONNECTION_STRING', 'mysql:host=equityinsurance.db.9126389.hostedresource.com;dbname=equityinsurance');
		define("BASE_URL", "http://squadlab.com/equity/mastercard");
	}
	
	if($_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'localhost'){
		define('EMAIL_SERVER','smtp.gmail.com');
		define('EMAIL_SERVER_PORT','465');
		define('SMTP_USER_ACCOUNT','equitycustomsearch@gmail.com');
		define('SMTP_USER_PASSWORD','DI9C4Ge7c3@');
		define('EMAIL_SEND_DEBUG_MODE','0');
		define('SMTP_AUTH', true);
		
		define('EMAIL_FROM_ADDRESS', 'John.Nguru@scangroup.biz');
		define('EMAIL_FROM_NAME', 'Equity Bank');
		define('EMAIL_REPLY_TO_ADDRESS', 'John.Nguru@scangroup.biz');
		define('EMAIL_REPLY_TO_NAME', 'Equity Bank');
		define('EMAIL_SUBJECT', 'Equity Lead Form Feedback');
		define('EMAIL_ALTERNATE_BODY_MESSAGE', 'If you are aunable to see this email, contact the administrator.');
	}else{
		define('EMAIL_SERVER','localhost');
		define('EMAIL_SERVER_PORT','587');
		define('SMTP_USER_ACCOUNT','');
		define('SMTP_USER_PASSWORD','');
		define('EMAIL_SEND_DEBUG_MODE','0');
		define('SMTP_AUTH', false);
		
		define('EMAIL_FROM_ADDRESS', 'mcommerce@equitybank.co.ke');
		define('EMAIL_FROM_NAME', 'Equity Bank');
		define('EMAIL_REPLY_TO_ADDRESS', 'mcommerce@equitybank.co.ke');
		define('EMAIL_REPLY_TO_NAME', 'Equity Bank');
		define('EMAIL_SUBJECT', 'Equity Lead Form Feedback');
		define('EMAIL_ALTERNATE_BODY_MESSAGE', 'If you are aunable to see this email, contact the administrator.');
	}