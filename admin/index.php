<?php
	require_once('core/init.php');
	require_once('includes/header.php');

	if ($user) {
		define('INSITE', true);
		require_once('templates/menu.php');
		require_once('templates/content.php');
	}
	else require_once('templates/signin.php');

	require_once('includes/footer.php');
?>