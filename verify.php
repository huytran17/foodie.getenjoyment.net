<?php
	require_once('core/init.php');
	$vcode = empty($_GET['vcode']) ? '' : GP($_GET['vcode']);
	$usern = empty($session->get('nsu')) ? '' : GP($session->get('nsu'));
	$vs_code = empty($session->get('vcode')) ? '' : GP($session->get('vcode'));
	if ($vcode && $usern) {
		if (strcmp($vcode, $vs_code) == 0) {
			$sql_unlock_kh = "UPDATE fd_khachhang SET trangthai_kh=1 WHERE username_kh='$usern'";
			$db->query($sql_unlock_kh);
			new Redirect($_DOMAIN .'sign-in');
		}
		else {
			echo '<div class="cont vrf-notice text-center mt-4 border border-warning py-3 px-1">
						<p class="my-auto">Chúng tôi đã gửi một e-mail xác thực tài khoản đến địa chỉ e-mail mà bạn cung cấp, bạn vui lòng xác thực để tiếp tục.</p>
			</div>';
		}
	}
	else new Redirect($_DOMAIN);
?>