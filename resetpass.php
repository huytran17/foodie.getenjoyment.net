<?php
	require_once('core/init.php');
	header("Content-Type: text/html");
	$ac = empty($_POST['act']) ? '' : GP($_POST['act']);
	if ($ac) {
		if ($ac == 'rspw') {
			$mail = empty($_POST['mail']) ? '' : GP($_POST['mail']);
			if (!isset($mail)) {
				echo '*Vui lòng điền đầy đủ thông tin';
			}
			elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				echo '*Định dạng email không hợp lệ';
			}
			else {
				$sql_check_mail = "SELECT id_kh, username_kh FROM fd_khachhang WHERE email_kh='$mail'";
				if ($db->num_rows($sql_check_mail)) {
					$data_kh = $db->fetch_assoc($sql_check_mail, 1);
					$usern = $data_kh['username_kh'];
					//gửi email xác nhận
					$chars_set = 'abcdefghijklmnopqrstuvwxyzABDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
					$v_code = substr(str_shuffle($chars_set), 0, 35);

					$title = "Foodie - Reset Password";
					$content = 'Xin chào <strong>'.$usern.'</strong>, bạn đã gửi một yêu cầu thay đổi mật khẩu cho tài khoản của mình. Nhấn vào liên kết <a href="'.$_DOMAIN.'reset/verifycode&step='.$v_code.'">này</a> để đặt lại mật khẩu.';					
					$nameTo = $usern;
					$mailTo = $mail;
					$mail = sendMail($title, $content, $nameTo, $mailTo);
					if ($mail == 1) {
						$session->set('vcode', $v_code);
						$session->set('nsu', $usern);
						new Redirect($_DOMAIN .'verify=1');
					}
					else echo '*Đã xảy ra lỗi, bạn vui lòng thử lại sau';
				}
				else echo '*Email này không tồn tại';
			}
			echo '<script>$("#formRsPw .btnRsPw").removeAttr("disabled");$("#formRsPw .spinner-grow").addClass("d-none");</script>';
		}
		elseif ($ac == 'rerspw') {
			$rsnewpw = empty($_POST['rsnewpw']) ? '' : GP($_POST['rsnewpw']);
			$rersnewpw = empty($_POST['rersnewpw']) ? '' : GP($_POST['rersnewpw']);
			$usern = $session->get('nsu');
			if (!isset($rsnewpw) || !isset($rersnewpw)) {
				echo '*Vui lòng điền đầy đủ thông tin';
			}
			elseif (strlen($rsnewpw) < 8) {
				echo "*Mật khẩu phải chứa ít nhất 8 kí tự";
			}
			elseif (strcmp($rsnewpw, $rersnewpw) != 0) {
				echo '*Mật khẩu nhập lại không khớp';
			}
			else {
				$rersnewpw = md5($rersnewpw);
				$sql_update_pass = "UPDATE fd_khachhang SET 
					password_kh = '$rersnewpw'
					WHERE username_kh='$usern'
				";
				$db->query($sql_update_pass);
				echo '<script>window.location.href="'.$_DOMAIN.'sign-in"</script>';
			}
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>