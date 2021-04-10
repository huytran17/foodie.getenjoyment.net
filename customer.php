<?php
	require_once('core/init.php');
	header("Content-Type: text/html");
	if ($user) {
		$ac = empty($_POST['act']) ? '' : GP($_POST['act']);
		if ($ac) {
			if ($ac == 'chw') {
				$oldpass = empty($_POST['oldPass']) ? '' : GP($_POST['oldPass']);
				$newpass = empty($_POST['newPass']) ? '' : GP($_POST['newPass']);
				$renewpass = empty($_POST['renewPass']) ? '' : GP($_POST['renewPass']);

				$sql_check_pass = "SELECT id_kh FROM fd_khachhang WHERE id_kh='$data_member[id_kh]' AND password_kh='$oldpass'";

				if (!isset($oldpass) || !isset($newpass)) {
					echo '*Vui lòng nhập đầy đủ thông tin';
				}
				elseif (!$db->num_rows($sql_check_pass)) {
					echo '*Mật khẩu cũ không đúng';
				}
				elseif (strlen($newpass) < 8) {
					echo "*Mật khẩu phải chứa ít nhất 8 kí tự";
				}
				elseif (strcmp($newpass, $renewpass) != 0) {
					echo '*Mật khẩu nhập lại không khớp';
				}
				else {
					$newpass = md5($newpass);
					$sql_update_pass = "UPDATE fd_khachhang SET 
						password_kh = '$newpass'
						WHERE id_kh='$data_member[id_kh]'
					";
					$db->query($sql_update_pass);
					echo '<script>window.location.href="'.$_DOMAIN.'sign-in"</script>';
				}
			}
			elseif ($ac == 'chm') {
				$mail = empty($_POST['mail']) ? '' : GP($_POST['mail']);
				if (!isset($mail)) {
					echo '*Vui lòng nhập đầy đủ thông tin';
				}
				elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
					echo '*Định dạng email không hợp lệ';
				}
				else {
					$sql_upd_mail = "UPDATE fd_khachhang SET 
							email_kh = '$mail'
							WHERE id_kh = '$data_member[id_kh]'
					";
					$db->query($sql_upd_mail);
					echo '<script>window.location.reload();</script>';
				}
			}
			else new Redirect($_DOMAIN);
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>