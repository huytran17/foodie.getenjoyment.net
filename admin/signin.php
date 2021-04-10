<?php
	header('Content-Type: application/j-son; charset=UTF-8');
	require_once('core/init.php');

	$username = empty($_POST['username']) ? '' : trim(addslashes(htmlspecialchars($_POST['username'])));
	$password = empty($_POST['password']) ? '' : trim(addslashes(htmlspecialchars($_POST['password'])));
	$errors = array();

	if (!$username) {
		$errors['username'] = '*Bắt buộc';
	}
	if (!$password) {
		$errors['password'] = '*Bắt buộc';
	}
	if (empty($errors)) {
		$sql_check_username_exist = $db->db_create_query('select', 'username_ad, password_ad, trangthai_ad', 'fd_admin', array('username_ad'=>$username));
		if ($db->db_num_rows($sql_check_username_exist)) {
			$result = $db->db_fetch_assoc($sql_check_username_exist, 1);
			if ($result['password_ad'] == $password) {
				if ($result['trangthai_ad'] == 1) {
					$errors['other'] = '<script>window.location.href="'.$_DOMAIN.'"</script>';
					$sess->sess_save('user', $username);
				}
				else $errors['other'] = '*Tài khoản đã bị khóa';
			}
			else $errors['password'] = '*Sai mật khẩu';
		}
		else $errors['username'] = '*Sai tên đăng nhập';
	}
	echo json_encode($errors, JSON_UNESCAPED_UNICODE);
?>