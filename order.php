<?php
	require_once('core/init.php');
	header("Content-Type: text/html");
	if ($user) {
		$ac = empty($_POST['act']) ? '' : GP($_POST['act']);
		if ($ac) {
			if ($ac == 'ord') {
				$idkh = $data_member['id_kh'];
				$idsp = empty($_POST['idsp']) ? '' : GP($_POST['idsp']);
				$add = empty($_POST['add']) ? '' : GP($_POST['add']);
				$sdt = empty($_POST['sdt']) ? '' : GP($_POST['sdt']);
				$amount = empty($_POST['amount']) ? '' : GP($_POST['amount']);
				$price = empty($_POST['price']) ? '' : str_replace(',', '', GP($_POST['price']));
				$capt_code = empty($_POST['capt_code']) ? '' : GP($_POST['capt_code']);

				$recieve_date = new DateTime("now");
				$recieve_date->add(DateInterval::createFromDateString("2 hours"));
				$recieve_date = $recieve_date->format("Y-m-d H:i:sa");
				
				if (!isset($idkh) || !isset($idsp) || !isset($price)) {
					echo '*Đã xảy ra lỗi, vui lòng thử lại sau';
				}
				elseif (!isset($add) || !isset($sdt)) {
					echo '*Vui lòng điền đầy đủ thông tin';
				}
				elseif (!isset($amount)) {
					echo '*Vui lòng nhập số lượng';
				}
				elseif (isset($capt_code) && strcmp($capt_code, $session->get('capt_code')) != 0) {
					echo '*Mã xác nhận không hợp lệ';
				}
				else {
					$sql_add_dh = "INSERT INTO fd_donhang VALUES(
						'',
						'$idkh',
						'$idsp',
						'$add',
						'$current_date',
						'$recieve_date',
						'$amount',
						'$price',
						1,
						'$sdt'
					)";
					$db->query($sql_add_dh);
					new Redirect($_DOMAIN .'mybasket/' .md5($idkh));
				}
			}
			elseif ($ac == 'getinfsp') {
				$idsp = empty($_POST['idsp']) ? '' : GP($_POST['idsp']);
				$sql_get_sp = "SELECT giamoi_sp FROM fd_sanpham WHERE id_sp='$idsp' AND trangthai_sp=1";
				if ($db->num_rows($sql_get_sp)) {
					$data_sp = $db->fetch_assoc($sql_get_sp, 1);
					header('Content-Type: application/json');
					echo json_encode($data_sp, JSON_UNESCAPED_UNICODE);
				}
			}
			else new Redirect($_DOMAIN);
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>