<?php
	require_once('classes/Captcha.php');
	header("Content-Type: image/*");
	$capt = new Captcha();
	$capt->showCaptcha();
?>