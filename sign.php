<?php
	require_once('core/init.php');
	header('Content-Type: text/html');
	
	$usern = empty($_POST['u']) ? '' : GP($_POST['u']);;
	$pass = empty($_POST['p']) ? '' : GP($_POST['p']);;
	$ac = empty($_POST['act']) ? '' : GP($_POST['act']);
	if ($ac == 'in') {
		if (!isset($usern) || !isset($pass)) {
			echo '*Vui lòng điền đầy đủ thông tin';
		}
		else {
			$sql_check_user = "SELECT username_kh, password_kh FROM fd_khachhang WHERE username_kh='$usern' AND trangthai_kh=1";
			if ($db->num_rows($sql_check_user)) {
				$data_acc = $db->fetch_assoc($sql_check_user, 1);
				if ($data_acc['password_kh'] == $pass) {
					$session->set('kh', $usern);
					echo '<script>window.location.href="'.$_DOMAIN.'"</script>';
				}
				else echo '*Mật khẩu không đúng';
			}
			else echo '*Tên đăng nhập không đúng';
		}
	}
	elseif ($ac == 'up') {
		$repass = empty($_POST['rp']) ? '' : GP($_POST['rp']);
		$avt = empty($_POST['avt']) ? '' : GP($_POST['avt']);
		$email = empty($_POST['m']) ? '' : GP($_POST['m']);
		$sql_check_mail = "SELECT id_kh FROM fd_khachhang WHERE email_kh='$email'";

		if (!isset($usern) || !isset($pass) || !isset($repass)) {
			echo '*Vui lòng điền đầy đủ thông tin';
		}
		elseif (strlen($usern) < 6) {
			echo '*Tên đăng nhập phải chứa ít nhất 6 kí tự';
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo '*Định dạng email không hợp lệ';
		}
		elseif ($db->num_rows($sql_check_mail)) {
			echo '*E-mail này đã được sử dụng';
		}
		elseif (strlen($pass) < 8) {
			echo "*Mật khẩu phải chứa ít nhất 8 kí tự";
		}
		elseif (strcmp($pass, $repass) != 0) {
			echo '*Mật khẩu nhập lại không khớp';
		}
		else {
			$sql_check_user = "SELECT id_kh FROM fd_khachhang WHERE username_kh='$usern'";
			if (!$db->num_rows($sql_check_user)) {
					//avt
					$avt = str_replace('data:image/png;base64', '', $avt);
					$avt = str_replace(' ', '+', $avt);
					$avtData = base64_decode($avt);
					$charName = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			    	$randName = substr(str_shuffle($charName), 0, 15);
			    	$dir = 'upload/cus/';
			    	$day = substr($current_date, 8, 2);
		        	$month = substr($current_date, 5, 2);
		        	$year = substr($current_date, 0, 4);
		        	if (!is_dir($dir .$year)) {
		        		mkdir($dir .$year);
		        	}
		        	if (!is_dir($dir .$year .'/' .$month)) {
		        		mkdir($dir .$year .'/' .$month);
		        	}
		        	if (!is_dir($dir .$year .'/' .$month .'/' .$day)) {
		        		mkdir($dir .$year .'/' .$month .'/' .$day .'/');
		        	}
				    $filePath = $dir .$year .'/' .$month .'/' .$day .'/' .$randName .'.png';
				    file_put_contents($filePath, $avtData);

				    $slug_user = $slug->to_slug($usern);
					$sql_add_acc = "INSERT INTO fd_khachhang VALUES(
						'',
						'$usern',
						'',
						'$pass',
						'$slug_user',
						'',
						'',
						'$email',
						'$current_date',
						2,
						0,
						'',
						'',
						'$filePath'
					)";
					//gửi email xác nhận
					$chars_set = 'abcdefghijklmnopqrstuvwxyzABDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
					$v_code = substr(str_shuffle($chars_set), 0, 35);

					$title = "Foodie - Xác nhận địa chỉ e-mail của bạn";
					$content = 'Xin chào '.$usern.', bạn vui lòng nhấn vào liên kết <a href="'.$_DOMAIN.'verify='.$v_code.'">này</a> để kích hoạt tài khoản trên hệ thống của chúng tôi.';
					$nameTo = $usern;
					$mailTo = $email;

					$mail = sendMail($title, $content, $nameTo, $mailTo);
					if ($mail == 1) {
						$session->set('vcode', $v_code);
						$session->set('nsu', $usern);
						$db->query($sql_add_acc);
						new Redirect($_DOMAIN .'verify=1');
					}
					else echo '*Đã xảy ra lỗi, bạn vui lòng thử lại sau';
			}
			else echo '*Tên đăng nhập đã tồn tại';
		}
		echo '<script>$("#formSignUp .signUpBtn").removeAttr("disabled");$("#formSignUp .spinner-grow").addClass("d-none");</script>';
	}
	else new Redirect($_DOMAIN);
?>