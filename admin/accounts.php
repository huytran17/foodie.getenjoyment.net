<?php
	require_once('core/init.php');
	if ($user) {
		$action = empty($_POST['action']) ? '' : trim(addslashes(htmlspecialchars($_POST['action'])));
		if ($action) {
			if ($action == 'add_acc') {
				$nameAddAcc = trim(addslashes(htmlspecialchars($_POST['nameAddAcc'])));
				$dNameAddAcc = trim(addslashes(htmlspecialchars($_POST['dNameAddAcc'])));
				$passAddAcc = trim(addslashes(htmlspecialchars($_POST['passAddAcc'])));
				$rePassAddAcc = trim(addslashes(htmlspecialchars($_POST['rePassAddAcc'])));

				if (empty($nameAddAcc) || empty($dNameAddAcc) || empty($passAddAcc) || empty($rePassAddAcc)) {
					echo '*Vui lòng điền các thông tin bắt buộc';
				}
				elseif ($db->db_num_rows("SELECT id_ad FROM fd_admin WHERE username_ad = '$nameAddAcc'")) {
					echo '*Tên đăng nhập đã tồn tại';
				}
				elseif ($db->db_num_rows("SELECT id_ad FROM fd_admin WHERE displayname_ad = '$dNameAddAcc'")) {
					echo '*Tên hiển thị đã tồn tại';
				}
				elseif ($passAddAcc != $rePassAddAcc) {
					echo '*Mật khẩu nhập lại không khớp';
				}
				else {
					$slug_acc = $slug->to_slug($nameAddAcc);
					$passAddAcc = md5($passAddAcc);
					$sql_add_acc = "INSERT INTO fd_admin VALUES(
						'',
						'$nameAddAcc',
						'$dNameAddAcc',
						'$passAddAcc',
						'$slug_acc',
						'',
						'',
						'',
						2,
						1,
						''
					)";
					$db->db_exe_query($sql_add_acc);
					new Redirect($_DOMAIN .'accounts');
				}
			}
			elseif ($action == 'upgrade_acc_list') {
				foreach ($_POST['id_acc'] as $key => $id_acc) {
					$sql_check_id_acc_exist = $db->db_create_query('select', 'id_ad', 'fd_admin', array('id_ad'=>$id_acc));
					if ($db->db_num_rows($sql_check_id_acc_exist)) {
						//
						$sql_get_pos = "SELECT vitri_ad FROM fd_admin WHERE id_ad='$id_acc'";
						if ($db->db_num_rows($sql_get_pos)) {
							$pos = intval($db->db_fetch_assoc($sql_get_pos, 1)['vitri_ad']);
							if ($pos > 1) {
								--$pos;
								$sql_upgrade_list_acc = "UPDATE fd_admin SET vitri_ad='$pos' WHERE id_ad = '$id_acc'";
								$db->db_exe_query($sql_upgrade_list_acc);
							}
						}
					}
				}
			}
			elseif ($action == 'downgrade_acc_list') {
				foreach ($_POST['id_acc'] as $key => $id_acc) {
					$sql_check_id_acc_exist = $db->db_create_query('select', 'id_ad', 'fd_admin', array('id_ad'=>$id_acc));
					if ($db->db_num_rows($sql_check_id_acc_exist)) {
						$sql_get_pos = "SELECT vitri_ad FROM fd_admin WHERE id_ad='$id_acc'";
						if ($db->db_num_rows($sql_get_pos)) {
							$pos = intval($db->db_fetch_assoc($sql_get_pos, 1)['vitri_ad']);
							if ($pos < 3) {
								++$pos;
								$sql_upgrade_list_acc = "UPDATE fd_admin SET vitri_ad='$pos' WHERE id_ad = '$id_acc'";
								$db->db_exe_query($sql_upgrade_list_acc);
							}
						}
					}
				}
			}
			elseif ($action == 'lock_acc_list') {
				foreach ($_POST['id_acc'] as $key => $id_acc) {
					$sql_check_id_acc_exist = $db->db_create_query('select', 'id_ad', 'fd_admin', array('id_ad'=>$id_acc));
					if ($db->db_num_rows($sql_check_id_acc_exist)) {
						$sql_lock_acc_list = "UPDATE fd_admin SET trangthai_ad = '0' WHERE id_ad = '$id_acc'";
						$db->db_exe_query($sql_lock_acc_list);
					}
				}
			}
			elseif ($action == 'unlock_acc_list') {
				foreach ($_POST['id_acc'] as $key => $id_acc) {
					$sql_check_id_acc_exist = $db->db_create_query('select', 'id_ad', 'fd_admin', array('id_ad'=>$id_acc));
					if ($db->db_num_rows($sql_check_id_acc_exist)) {
						$sql_unlock_acc_list = "UPDATE fd_admin SET trangthai_ad = '1' WHERE id_ad = '$id_acc'";
						$db->db_exe_query($sql_unlock_acc_list);
					}
				}
			}
			elseif ($action == 'del_acc_list') {
				foreach ($_POST['id_acc'] as $key => $id_acc) {
					$sql_check_id_acc_exist = $db->db_create_query('select', 'id_ad', 'fd_admin', array('id_ad'=>$id_acc));
					if ($db->db_num_rows($sql_check_id_acc_exist)) {
						$sql_del_acc_list = "DELETE FROM fd_admin WHERE id_ad = '$id_acc'";
						$db->db_exe_query($sql_del_acc_list);
					}
				}
			}
			elseif ($action == 'upgrade_an_acc') {
				$id_acc = empty($_POST['id_acc']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_acc'])));
				if ($id_acc) {
					$sql_get_pos = "SELECT vitri_ad FROM fd_admin WHERE id_ad='$id_acc'";
					if ($db->db_num_rows($sql_get_pos)) {
						$pos = intval($db->db_fetch_assoc($sql_get_pos, 1)['vitri_ad']);
						if ($pos > 1) {
							--$pos;
							$sql_upgrade_an_acc = "UPDATE fd_admin SET vitri_ad='$pos' WHERE id_ad = '$id_acc'";
							$db->db_exe_query($sql_upgrade_an_acc);
						}
					}
				}
			}
			elseif ($action == 'downgrade_an_acc') {
				$id_acc = empty($_POST['id_acc']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_acc'])));
				if ($id_acc) {
					$sql_get_pos = "SELECT vitri_ad FROM fd_admin WHERE id_ad='$id_acc'";
					if ($db->db_num_rows($sql_get_pos)) {
						$pos = intval($db->db_fetch_assoc($sql_get_pos, 1)['vitri_ad']);
						if ($pos < 3) {
							++$pos;
							$sql_downgrade_an_acc = "UPDATE fd_admin SET vitri_ad='$pos' WHERE id_ad = '$id_acc'";
							$db->db_exe_query($sql_downgrade_an_acc);
							echo $sql_downgrade_an_acc;
						}
					}
				}
			}
			elseif ($action == 'lock_an_acc') {
				$id_acc = empty($_POST['id_acc']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_acc'])));
				if ($id_acc) {
					$sql_lock_an_acc = "UPDATE fd_admin SET trangthai_ad='0' WHERE id_ad = '$id_acc'";
					$db->db_exe_query($sql_lock_an_acc);
				}
			}
			elseif ($action == 'unlock_an_acc') {
				$id_acc = empty($_POST['id_acc']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_acc'])));
				if ($id_acc) {
					$sql_unlock_an_acc = "UPDATE fd_admin SET trangthai_ad='1' WHERE id_ad = '$id_acc'";
					$db->db_exe_query($sql_unlock_an_acc);
				}
			}
			elseif ($action == 'del_an_acc') {
				$id_acc = empty($_POST['id_acc']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_acc'])));
				if ($id_acc) {
					$sql_del_an_acc = "DELETE FROM fd_admin WHERE id_ad = '$id_acc'";
					$db->db_exe_query($sql_del_an_acc);
				}
			}
			else echo '*Không tìm thấy tác vụ';
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>