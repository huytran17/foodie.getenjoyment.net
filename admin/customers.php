<?php
	require_once('core/init.php');
	if ($user) {
		$action = empty($_POST['action']) ? '' : trim(addslashes(htmlspecialchars($_POST['action'])));
		if ($action) {
			if ($action == 'lock_cus_list') {
				foreach ($_POST['id_cus'] as $key => $id_cus) {
					$sql_check_id_cus_exist = $db->db_create_query('select', 'id_kh', 'fd_khachhang', array('id_kh'=>$id_cus));
					if ($db->db_num_rows($sql_check_id_cus_exist)) {
						$sql_lock_cus_list = "UPDATE fd_khachhang SET trangthai_kh='0' WHERE id_kh = '$id_cus'";
						$db->db_exe_query($sql_lock_cus_list);
					}
				}
			}
			elseif ($action == 'unlock_cus_list') {
				foreach ($_POST['id_cus'] as $key => $id_cus) {
					$sql_check_id_cus_exist = $db->db_create_query('select', 'id_kh', 'fd_khachhang', array('id_kh'=>$id_cus));
					if ($db->db_num_rows($sql_check_id_cus_exist)) {
						$sql_unlock_cus_list = "UPDATE fd_khachhang SET trangthai_kh='1' WHERE id_kh = '$id_cus'";
						$db->db_exe_query($sql_unlock_cus_list);
					}
				}
			}
			elseif ($action == 'del_cus_list') {
				foreach ($_POST['id_cus'] as $key => $id_cus) {
					$sql_check_id_cus_exist = $db->db_create_query('select', 'id_kh', 'fd_khachhang', array('id_kh'=>$id_cus));
					if ($db->db_num_rows($sql_check_id_cus_exist)) {
						$sql_del_cus_list = "DELETE FROM fd_khachhang WHERE id_kh = '$id_cus'";
						$db->db_exe_query($sql_del_cus_list);
					}
				}
			}
			elseif ($action == 'del_a_cus') {
				$id_cus = empty($_POST['id_cus']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_cus'])));
				if ($id_cus) {
					$sql_del_a_cus = "DELETE FROM fd_khachhang WHERE id_kh = '$id_cus'";
					$db->db_exe_query($sql_del_a_cus);
				}
			}
			elseif ($action == 'lock_a_cus') {
				$id_cus = empty($_POST['id_cus']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_cus'])));
				if ($id_cus) {
					$sql_lock_a_cus = "UPDATE fd_khachhang SET trangthai_kh='0' WHERE id_kh = '$id_cus'";
					$db->db_exe_query($sql_lock_a_cus);
				}
			}
			elseif ($action == 'unlock_a_cus') {
				$id_cus = empty($_POST['id_cus']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_cus'])));
				if ($id_cus) {
					$sql_unlock_a_cus = "UPDATE fd_khachhang SET trangthai_kh='1' WHERE id_kh = '$id_cus'";
					$db->db_exe_query($sql_unlock_a_cus);
				}
			}
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>