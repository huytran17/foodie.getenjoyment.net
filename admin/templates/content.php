<?php
	$tab = empty($_GET['tab']) ? '' : trim(addslashes(htmlspecialchars($_GET['tab'])));
	if ($tab) {
		if ($tab == 'dashboard') {
			require_once('dashboard.php');
		}
		elseif ($tab == 'profile') {
			require_once('profiles.php');
		}
		elseif ($tab == 'species') {
			require_once('speciess.php');
		}
		elseif ($tab == 'accounts') {
			require_once('accountss.php');
		}
		elseif ($tab == 'customers') {
			require_once('customerss.php');
		}
		elseif ($tab == 'settings') {
			require_once('settingss.php');
		}
		elseif ($tab == 'foods') {
			require_once('foodss.php');
		}
		elseif ($tab == 'orders') {
			require_once('orderss.php');
		}
		elseif ($tab == 'slider') {
			require_once('sliders.php');
		}
		elseif ($tab == 'site') {
			require_once('siteinfos.php');
		}
		elseif ($tab == 'social') {
			require_once('socials.php');
		}
	}
?>