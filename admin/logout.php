<?php
		require_once('core/init.php');
		$sess->sess_destroy();
		new Redirect($_DOMAIN);
?>