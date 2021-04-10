<?php
	require_once('core/init.php');
	if ($user) {
		$ac = empty($_POST['action']) ? '' : trim(addslashes(htmlspecialchars($_POST['action'])));
		if ($ac) {
			if ($ac == 'proc_order_list') {
				foreach ($_POST['id_or'] as $key => $id_or) {
					$sql_check_id_or_exist = $db->db_create_query('select', 'id_dh', 'fd_donhang', array('id_dh'=>$id_or));
					if ($db->db_num_rows($sql_check_id_or_exist)) {
						$sql_proc_or = "UPDATE fd_donhang SET trangthai_dh=2 WHERE id_dh = '$id_or'";
						$db->db_exe_query($sql_proc_or);
					}
				}
			}
			elseif ($ac == 'apply_order_list') {
				foreach ($_POST['id_or'] as $key => $id_or) {
					$sql_check_id_or_exist = $db->db_create_query('select', 'id_dh, id_sp', 'fd_donhang', array('id_dh'=>$id_or));
					if ($db->db_num_rows($sql_check_id_or_exist)) {
						$sql_apply_or = "UPDATE fd_donhang SET trangthai_dh=3 WHERE id_dh = '$id_or'";
						$db->db_exe_query($sql_apply_or);
						//
						$id_sp = $db->db_fetch_assoc($sql_check_id_or_exist, 1)['id_sp'];
						$sql_get_sold_sp = "SELECT solanmua_sp FROM fd_sanpham WHERE id_sp='$id_sp'";
						$sold = intval($db->db_fetch_assoc($sql_get_sold_sp, 1)['solanmua_sp']) + 1;
						$sql_up_sold = "UPDATE fd_sanpham SET solanmua_sp='$sold' WHERE id_sp='$id_sp'";
						$db->db_exe_query($sql_up_sold);
						//
					}
				}
			}
			elseif ($ac == 'proc_a_or') {
				$id_or = empty($_POST['id_or']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_or'])));
				if ($id_or) {
					$sql_proc_an_or = "UPDATE fd_donhang SET trangthai_dh=2 WHERE id_dh = '$id_or'";
					$db->db_exe_query($sql_proc_an_or);
				}
			}
			elseif ($ac == 'apply_a_or') {
				$id_or = empty($_POST['id_or']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_or'])));
				if ($id_or) {
					$sql_apply_an_or = "UPDATE fd_donhang SET trangthai_dh=3 WHERE id_dh = '$id_or'";
					$db->db_exe_query($sql_apply_an_or);
					//
					$sql_get_or = $db->db_create_query('select', 'id_sp', 'fd_donhang', array('id_dh'=>$id_or));
					$id_sp = $db->db_fetch_assoc($sql_get_or, 1)['id_sp'];
					$sql_get_sold_sp = "SELECT solanmua_sp FROM fd_sanpham WHERE id_sp='$id_sp'";
					$sold = intval($db->db_fetch_assoc($sql_get_sold_sp, 1)['solanmua_sp']) + 1;
					$sql_up_sold = "UPDATE fd_sanpham SET solanmua_sp='$sold' WHERE id_sp='$id_sp'";
					$db->db_exe_query($sql_up_sold);
				}
			}
			elseif ($ac == 'filter') {
				$type = empty($_POST['type']) ? '' : intval(trim(addslashes(htmlspecialchars($_POST['type']))));
				$dnone = '';
				if ($type === 1) {
					$sql_get_all_or = "SELECT * FROM fd_donhang";
					if ($db->db_num_rows($sql_get_all_or)) {
						$data = $db->db_fetch_assoc($sql_get_all_or, 0);
					}
				}
				elseif ($type === 2) {
					$sql_get_or_proc = "SELECT * FROM fd_donhang WHERE trangthai_dh=2";
					if ($db->db_num_rows($sql_get_or_proc)) {
						$data = $db->db_fetch_assoc($sql_get_or_proc, 0);
					}
					$dnone = 'd-none';
				}
				elseif ($type === 3) {
					$sql_get_or_app = "SELECT * FROM fd_donhang WHERE trangthai_dh=3";
					if ($db->db_num_rows($sql_get_or_app)) {
						$data = $db->db_fetch_assoc($sql_get_or_app, 0);
					}
					$dnone = 'd-none';
				}
				else $data = '';
				//
				if (!empty($data)) {
					$or_arr = array();
					foreach ($data as $key => $data_or) {
						$sql_get_cus_name = "SELECT username_kh FROM fd_khachhang WHERE id_kh='$data_or[id_kh]'";
						$sql_get_sp_name = "SELECT ten_sp FROM fd_sanpham WHERE id_sp='$data_or[id_sp]'";
						$name_cus = '';
		            	$name_sp = '';
		            	if ($db->db_num_rows($sql_get_cus_name)) {
		            		$name_cus = $db->db_fetch_assoc($sql_get_cus_name, 1)['username_kh'];
		            	}
		            	if ($db->db_num_rows($sql_get_sp_name)) {
		            		$name_sp = $db->db_fetch_assoc($sql_get_sp_name, 1)['ten_sp'];
		            	}
						if ($data_or['trangthai_dh'] == 1) {
		            		$stt_dh = '<span class="badge badge-primary">Đã tiếp nhận</span>';
		            	}
		            	elseif ($data_or['trangthai_dh'] == 2) {
		            		$stt_dh = '<span class="badge badge-info">Đang xử lí</span>';
		            	}
		            	elseif ($data_or['trangthai_dh'] == 3) {
		            		$stt_dh = '<span class="badge badge-success">Đã giao</span>';
		            	}
		            	else {
		            		$stt_dh = '<span class="badge badge-warning">Không rõ</span>';
		            	}
		            	$info = array(
		            		'tenkh' => $name_cus, 
		            		'iddh' => $data_or['id_dh'],
		            		'tensp' => $name_sp, 
		            		'dcnh' => $data_or['dcnh_dh'], 
		            		'ngdh' => $data_or['ngaydat_dh'], 
		            		'ngnhh' => $data_or['ngaynhan_dh'],
		            		'slg' => $data_or['soluong_dh'],
		            		'thtien' => $data_or['thanhtien_dh'],
		            		'trth' => $stt_dh,
		            		'sdt' => $data_or['sdtnh_dh'],
		            		'dnone' => $dnone
		            	);
						array_push($or_arr, $info);
					}
					echo json_encode($or_arr, JSON_UNESCAPED_UNICODE);
				}
			}
			else new Redirect($_DOMAIN);
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>