<?php
	require_once('core/init.php');
	if ($user) {
		if (isset($_FILES['inpUpAvt'])) {
			$dir = 'upload/profile/';
			$name_img = stripslashes($_FILES['inpUpAvt']['name']);
			$source_img = $_FILES['inpUpAvt']['tmp_name'];

			$day = substr($current_date, 8, 2);
			$month = substr($current_date, 5, 2);
			$year = substr($current_date, 0, 4);

			if (!is_dir($dir . $year)) {
				mkdir($dir . $year .'/');
			}
			if (!is_dir($dir . $year. '/' . $month)) {
				mkdir($dir . $year . '/' . $month .'/');
			}
			if (!is_dir($dir . $year .'/'. $month .'/'. $day)) {
				mkdir($dir . $year . '/' . $month . '/' .$day. '/');
			}

			$url_img = $dir .$year .'/' .$month .'/' .$day .'/' .$name_img;
			move_uploaded_file($source_img, $url_img);
			$sql_update_url_avt = "UPDATE fd_admin SET url_avt_ad = '$url_img' WHERE id_ad = '$data_user[id_ad]'";
			$db->db_exe_query($sql_update_url_avt);
			new Redirect($_DOMAIN . 'profile');			
		}
		elseif (isset($_POST['action'])) {
			$action = trim(addslashes(htmlspecialchars($_POST['action'])));
			if ($action == 'update_info') {
				$upDname = trim(addslashes(htmlspecialchars($_POST['upDname'])));
				$upAddr = trim(addslashes(htmlspecialchars($_POST['upAddr'])));
				$upSdt = trim(addslashes(htmlspecialchars($_POST['upSdt'])));
				$upEmail = trim(addslashes(htmlspecialchars($_POST['upEmail'])));
				if (empty($upDname)) {
					echo '*Vui lòng điền đầy đủ thông tin';
				}
                else if (strlen($upDname) < 3 || strlen($upDname) > 50) {
                    echo '*Tên hiển thị phải nằm trong khoảng từ 3-50 ký tự.';
                } 
                elseif ($upDname != $data_user['displayname_ad']) {
                	if ($db->db_num_rows("SELECT id_ad FROM fd_admin WHERE displayname_ad='$upDname'")) {
                		echo '*Tên hiển thị đã tồn tại';
                	}
				}
                else if ($upSdt && (strlen($upSdt) < 10 || strlen($upSdt) > 11 || preg_match('/^[0-9]+$/', $upSdt) == false)) {
                    echo '*Số điện thoại không hợp lệ.';
                }
                else if ($upEmail && filter_var($upEmail, FILTER_VALIDATE_EMAIL) === FALSE) {
                    echo '*Email không hợp lệ.';
                } 
				else {
					$slugdname_ad = $slug->to_slug($upDname);
					$sql_update_prf_info = "UPDATE fd_admin SET
						displayname_ad = '$upDname',
						diachi_ad = '$upAddr',
						sdt_ad = '$upSdt',
						email_ad = '$upEmail',
						slugdname_ad = '$slugdname_ad'
						WHERE id_ad = '$data_user[id_ad]'
					";
					$db->db_exe_query($sql_update_prf_info);
					new Redirect($_DOMAIN . 'profile');
				}
			}
			elseif ($action == 'update_secure') {
				$oldPass = trim(addslashes(htmlspecialchars($_POST['oldPass'])));
				$newPass = trim(addslashes(htmlspecialchars($_POST['newPass'])));
				$renewPass = trim(addslashes(htmlspecialchars($_POST['renewPass'])));
				if (empty($oldPass) || empty($newPass) || empty($renewPass)) {
					echo '*Vui lòng điền đầy đủ thông tin';
				}
				else {
					if (md5($oldPass) != $data_user['password_ad']) {
						echo '*Mật khẩu cũ không chính xác';
					}
					elseif (strlen($newPass) < 8) {
						echo '*Mật khẩu chứa ít nhất 8 kí tự';
					}
					elseif ($newPass != $renewPass) {
						echo '*Mật khẩu nhập lại không khớp';
					}
					else {
						$newPass = md5($newPass);
						$sql_update_prf_secure = "UPDATE fd_admin SET
							password_ad = '$newPass'
							WHERE id_ad = '$data_user[id_ad]'
						";
						$db->db_exe_query($sql_update_prf_secure);
						new Redirect($_DOMAIN . 'profile');
					}
				}
			}
			elseif ($action == 'delete_avt') {
				if (file_exists($data_user['url_avt_ad'])) {
					unlink($data_user['url_avt_ad']);
					$sql_delete_avt = "UPDATE fd_admin SET url_avt_ad = '' WHERE id_ad = '$data_user[id_ad]'";
					$db->db_exe_query($sql_delete_avt);
				}
			}
			else echo '*Không tìm thấy tác vụ';
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>