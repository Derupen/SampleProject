<?php
	//****************************************
	//edit here
	$senderName = 'WEB';
	$senderEmail = 'site@example.com';
	$targetEmail = 'admin@example.com';
	$messageSubject = 'Message from web-site';
	$redirectToReferer = true;
	$redirectURL = 'thankyou.html';
	//****************************************

	// mail content
	$ufname = $_POST['ufname'];
	$ulname = $_POST['ulname'];
	$ucompany = $_POST['ucompany'];
	$umail = $_POST['umail'];
	$umessage = $_POST['umessage'];

	// prepare message text
	$messageText =	'First Name: '.$ufname."\n".
					'Last Name: '.$ulname."\n".
					'Company: '.$ucompany."\n".
					'Email: '.$umail."\n".
					'Message: '.$umessage."\n";

	// send email
	$senderName = "=?UTF-8?B?" . base64_encode($senderName) . "?=";
	$messageSubject = "=?UTF-8?B?" . base64_encode($messageSubject) . "?=";
	$messageHeaders = "From: " . $senderName . " <" . $senderEmail . ">\r\n"
				. "MIME-Version: 1.0" . "\r\n"
				. "Content-type: text/plain; charset=UTF-8" . "\r\n";

	if (preg_match('/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/',$targetEmail,$matches))
	mail($targetEmail, $messageSubject, $messageText, $messageHeaders);

	// redirect
	if($redirectToReferer) {
		header("Location: ".@$_SERVER['HTTP_REFERER'].'#sent');
	} else {
		header("Location: ".$redirectURL);
	}
?>