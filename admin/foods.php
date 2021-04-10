<?php
	require_once('core/init.php');
	if ($user) {
		if (isset($_FILES['inpEditThumbFood'])) {
			$dir = '../upload/foods/';
			$name_img = $_FILES['inpEditThumbFood']['name'];
			$source_img = $_FILES['inpEditThumbFood']['tmp_name'];

			$day = substr($current_date, 8, 2);
			$month = substr($current_date, 5, 2);
			$year = substr($current_date, 0, 4);

			if (!is_dir($dir .$year)) {
				mkdir($dir .$year .'/');
			}
			if (!is_dir($dir .$year .'/'. $month)) {
				mkdir($dir .$year .'/'. $month .'/');
			}
			if (!is_dir($dir .$year .'/' .$month .'/' .$day)) {
				mkdir($dir .$year .'/' .$month .'/' .$day .'/');
			}

			$url_img = $dir .$year .'/' .$month .'/' .$day .'/' .$name_img;
			move_uploaded_file($source_img, $url_img);
			$url_img = substr($url_img, 3);
			$id_food = empty($_POST['hiddenID']) ? '' : trim(addslashes(htmlspecialchars($_POST['hiddenID'])));
			if ($id_food) {
				$sql_update_thumb_nsx = "UPDATE fd_sanpham SET
					url_thumb_sp = '$url_img'
					WHERE id_sp = '$id_food'				
				";
				$db->db_exe_query($sql_update_thumb_nsx);
			}
			//new Redirect($_DOMAIN . 'producers');
			echo '<script>window.location.reload();</script>';
		}
		elseif (isset($_FILES['inpEditFoodAvt'])) {
			$dir = '../upload/foods/';
			$name_img = $_FILES['inpEditFoodAvt']['name'];
			$source_img = $_FILES['inpEditFoodAvt']['tmp_name'];

			$day = substr($current_date, 8, 2);
			$month = substr($current_date, 5, 2);
			$year = substr($current_date, 0, 4);

			if (!is_dir($dir .$year)) {
				mkdir($dir .$year .'/');
			}
			if (!is_dir($dir .$year .'/'. $month)) {
				mkdir($dir .$year .'/'. $month .'/');
			}
			if (!is_dir($dir .$year .'/' .$month .'/' .$day)) {
				mkdir($dir .$year .'/' .$month .'/' .$day .'/');
			}

			$url_img = $dir .$year .'/' .$month .'/' .$day .'/' .$name_img;
			move_uploaded_file($source_img, $url_img);
			$url_img = substr($url_img, 3);
			$id_food = empty($_POST['hiddenID']) ? '' : trim(addslashes(htmlspecialchars($_POST['hiddenID'])));
			if ($id_food) {
				$sql_update_thumb_nsx = "UPDATE fd_sanpham SET
					url_avt_sp = '$url_img'
					WHERE id_sp = '$id_food'				
				";
				$db->db_exe_query($sql_update_thumb_nsx);
			}
			//new Redirect($_DOMAIN . 'producers');
			echo '<script>window.location.reload();</script>';
		}
		elseif (isset($_POST['action'])) {
			$action = trim(addslashes(htmlspecialchars($_POST['action'])));
			if ($action == 'add_food') {
				$nameAddFood = trim(addslashes(htmlspecialchars($_POST['nameAddFood'])));
				$chlFood = trim(addslashes(htmlspecialchars($_POST['chlFood'])));

				if (empty($nameAddFood)) {
					echo '*Vui lòng điền các thông tin bắt buộc';
				}
				else {
					$slug_food = $slug->to_slug($nameAddFood);
					$sql_add_food = "INSERT INTO fd_sanpham VALUES(
						'',
						'',
						'$chlFood',
						'$nameAddFood',
						'',
						'',
						'$slug_food',
						'',
						'',
						'',
						'',
						'$current_date',
						'',
						'',
						'',
						'',
						'',
						'',
						1, 
						'',
						'',
						''
					)";
					$db->db_exe_query($sql_add_food);
					new Redirect($_DOMAIN .'foods');
				}
			}
			elseif ($action == 'edit_food') {
				$nameEditFood = trim(addslashes(htmlspecialchars($_POST['nameEditFood'])));
				$editChl = trim(addslashes(htmlspecialchars($_POST['editChl'])));
				$descrEditFood = trim(addslashes(htmlspecialchars($_POST['descrEditFood'])));
				$ed_detailEditFood = trim(addslashes(htmlspecialchars($_POST['ed_detailEditFood'])));
				$priceEditFood = trim(addslashes(htmlspecialchars($_POST['priceEditFood'])));
				$saleEditFood = trim(addslashes(htmlspecialchars($_POST['saleEditFood'])));
				$newPriceEditFood = trim(addslashes(htmlspecialchars($_POST['newPriceEditFood'])));
				$ed_noteEditFood = trim(addslashes(htmlspecialchars($_POST['ed_noteEditFood'])));
				$stt_food = trim(addslashes(htmlspecialchars($_POST['stt_food'])));
				$id_food = trim(addslashes(htmlspecialchars($_POST['id_food'])));
				$calEditFood = trim(addslashes(htmlspecialchars($_POST['calEditFood'])));
				$fatEditFood = trim(addslashes(htmlspecialchars($_POST['fatEditFood'])));
				$proteinEditFood = trim(addslashes(htmlspecialchars($_POST['proteinEditFood'])));
				$satFatEditFood = trim(addslashes(htmlspecialchars($_POST['satFatEditFood'])));
				$dieFibEditFood = trim(addslashes(htmlspecialchars($_POST['dieFibEditFood'])));
				$canxiEditFood = trim(addslashes(htmlspecialchars($_POST['canxiEditFood'])));
				$sugarEditFood = trim(addslashes(htmlspecialchars($_POST['sugarEditFood'])));
				$ironEditFood = trim(addslashes(htmlspecialchars($_POST['ironEditFood'])));
				$chlesEditFood = trim(addslashes(htmlspecialchars($_POST['chlesEditFood'])));
				$vitDEditFood = trim(addslashes(htmlspecialchars($_POST['vitDEditFood'])));
				$keyEditFood = trim(addslashes(htmlspecialchars($_POST['keyEditFood'])));

				if (empty($nameEditFood) || empty($priceEditFood)) {
					echo '*Vui lòng điền các thông tin bắt buộc';
				}
				else {
					$slug_food = $slug->to_slug($nameEditFood);
					$nutri_info = array(
						'calo'=>$calEditFood,
						'fat'=>$fatEditFood,
						'protein'=>$proteinEditFood,
						'satfat'=>$satFatEditFood,
						'diefib'=>$dieFibEditFood,
						'canxi'=>$canxiEditFood,
						'sugar'=>$sugarEditFood,
						'iron'=>$ironEditFood,
						'chles'=>$chlesEditFood,
						'vitD'=>$vitDEditFood
					);
					$nutri_info = json_encode($nutri_info, JSON_UNESCAPED_UNICODE);
					$sql_edit_food = "UPDATE fd_sanpham SET
						id_chl = '$editChl',
						ten_sp = '$nameEditFood',
						mota_sp = '$descrEditFood',
						chitiet_sp = '$ed_detailEditFood',
						slug_sp = '$slug_food',
						giagoc_sp = '$priceEditFood',
						giamgia_sp = '$saleEditFood',
						giamoi_sp = '$newPriceEditFood',
						ghichu_sp = '$ed_noteEditFood',
						trangthai_sp = '$stt_food',
						nutri_sp = '$nutri_info',
						tukhoa_sp = '$keyEditFood'
						WHERE id_sp = '$id_food'
					";
					$db->db_exe_query($sql_edit_food);
					echo '<script>window.location.reload();</script>';
					/*echo '<pre>';
					print_r($nutri_info);
					echo '</pre>';*/
				}
			}
			elseif ($action == 'del_food_list') {
				foreach ($_POST['id_food'] as $key => $id_food) {
					$sql_check_id_food_exist = $db->db_create_query('select', 'id_sp', 'fd_sanpham', array('id_sp'=>$id_food));
					if ($db->db_num_rows($sql_check_id_food_exist)) {
						$sql_del_food = "DELETE FROM fd_sanpham WHERE id_sp = '$id_food'";
						$db->db_exe_query($sql_del_food);
					}
				}
			}
			elseif ($action == 'del_a_food') {
				$id_food = empty($_POST['id_food']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_food'])));
				if ($id_food) {
					$sql_del_a_food = "DELETE FROM fd_sanpham WHERE id_sp = '$id_food'";
					$db->db_exe_query($sql_del_a_food);
				}
			}
			elseif ($action == 'filter') {
				$type = !isset($_POST['type']) ? '' : intval(trim(addslashes(htmlspecialchars($_POST['type']))));
				$sql_get_all_f = "SELECT id_sp, id_chl, ten_sp, giamoi_sp, ngaydang_sp, solanmua_sp, trangthai_sp FROM fd_sanpham";
				$dnone = '';
				if ($type === 0) {
					if ($db->db_num_rows($sql_get_all_f)) {
						$data = $db->db_fetch_assoc($sql_get_all_f, 0);
					}
				}
				elseif ($type === 1) {
					if ($db->db_num_rows($sql_get_all_f)) {
						$data = $db->db_fetch_assoc($sql_get_all_f, 0);
						function cmp1($a, $b) {
							if (strcmp($a['ten_sp'], $b['ten_sp']) >= 0) {
								return 1;
							}
							else return 0;
						}
						usort($data, "cmp1");
						$dnone = 'dnone';
					}
				}
				elseif ($type === 2) {
					if ($db->db_num_rows($sql_get_all_f)) {
						$data = $db->db_fetch_assoc($sql_get_all_f, 0);
						function cmp2($a, $b) {
							if (intval($a['solanmua_sp']) <= intval($b['solanmua_sp'])) {
								return 1;
							}
							else return 0;
						}
						usort($data, "cmp2");
						$dnone = 'dnone';
					}
				}
				elseif ($type === 3) {
					if ($db->db_num_rows($sql_get_all_f)) {
						$data = $db->db_fetch_assoc($sql_get_all_f, 0);
						function cmp3($a, $b) {
							if (intval(strtr($a['giamoi_sp'], ',', '')) <= intval(strtr($b['giamoi_sp'], ',', ''))) {
								return 1;
							}
							else return 0;
						}
						usort($data, "cmp3");
						$dnone = 'dnone';
					}
				}
				else $data = '';
				//
				if (!empty($data)) {
					$f_arr = array();
					foreach ($data as $key => $data_f) {
						$sql_get_chl_name = "SELECT ten_chl FROM fd_chungloai WHERE id_chl='$data_f[id_chl]'";
						$name_chl = '';
						$stt_chl = '';
						if ($db->db_num_rows($sql_get_chl_name)) {
							$name_chl = $db->db_fetch_assoc($sql_get_chl_name, 1)['ten_chl'];
						}
						$stt_food = $data_f['trangthai_sp']==0 ? '<span class="badge badge-danger">Ẩn</span>' : '<span class="badge badge-info">Hiện</span>';
						$info = array(
							'idsp' => $data_f['id_sp'],
							'tensp' => $data_f['ten_sp'],
							'tenchl' => $name_chl,
							'stt' => $stt_food,
							'sold' => $data_f['solanmua_sp'],
							'date' => $data_f['ngaydang_sp'],
							'gia' => $data_f['giamoi_sp'],
							'dnone' => $dnone
						);
						array_push($f_arr, $info);
					}
					echo json_encode($f_arr, JSON_UNESCAPED_UNICODE);
				}
			}
			else new Redirect($_DOMAIN);
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>