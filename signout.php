<?php
	require_once('core/init.php');
	if ($user) {
			$session->destroy();
			new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>