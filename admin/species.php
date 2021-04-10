<?php
	require_once('core/init.php');
	if ($user) {
		if (isset($_FILES['inpAddThumbCate'])) {
			$dir = '../upload/species/';
			$name_img = $_FILES['inpAddThumbCate']['name'];
			$source_img = $_FILES['inpAddThumbCate']['tmp_name'];

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
			$id_cate = empty($_POST['hiddenID']) ? '' : trim(addslashes(htmlspecialchars($_POST['hiddenID'])));
			if ($id_cate) {
				$sql_update_thumb_chl = "UPDATE fd_chungloai SET
					url_thumb_chl = '$url_img'
					WHERE id_chl = '$id_cate'				
				";
				$db->db_exe_query($sql_update_thumb_chl);
			}
			new Redirect($_DOMAIN . 'species');
			//echo '<script>window.location.reload();</script>';
		}
		elseif (isset($_POST['action'])) {
			$action = trim(addslashes(htmlspecialchars($_POST['action'])));
			if ($action == 'add_cate') {
				$nameAddCate = trim(addslashes(htmlspecialchars($_POST['nameAddCate'])));
				$slug_add_cate = $slug->to_slug($nameAddCate);
				if (empty($nameAddCate)) {
					echo '*Vui lòng điền đầy đủ thông tin';
				}
				elseif ($db->db_num_rows("SELECT id_chl FROM fd_chungloai WHERE ten_chl='$nameAddCate' OR slug_chl='$slug_add_cate'")) {
					echo '*Mục này đã tồn tại, vui lòng chọn tên khác';
				}
				else {
					$sql_add_cate = "INSERT INTO fd_chungloai VALUES (
						'',
						'$nameAddCate',
						'$slug_add_cate',
						'',
						1,
						''
					)";
					$db->db_exe_query($sql_add_cate);
					new Redirect($_DOMAIN . 'species');
				}
			}
			elseif ($action == 'edit_cate') {
				$id_spec = trim(addslashes(htmlspecialchars($_POST['id_spec'])));
				$nameEditCate = trim(addslashes(htmlspecialchars($_POST['nameEditCate'])));
				$ed_descrEditCate = trim(addslashes(htmlspecialchars($_POST['ed_descrEditCate'])));
				$sttEdit = trim(addslashes(htmlspecialchars($_POST['sttEdit'])));

				if (empty($nameEditCate)) {
					echo '*Vui lòng điền đầy đủ thông tin';
				}
				else {
					$slug_edit_cate = $slug->to_slug($nameEditCate);
					$sql_edit_cate = "UPDATE fd_chungloai SET
						ten_chl = '$nameEditCate',
						slug_chl = '$slug_edit_cate',
						mota_chl = '$ed_descrEditCate',
						trangthai_chl = '$sttEdit'
						WHERE id_chl = '$id_spec'
					";
					$db->db_exe_query($sql_edit_cate);
				}
			}
			elseif ($action == 'del_spec_list') {
				foreach ($_POST['id_spec'] as $key => $id_chl) {
					$sql_check_id_cate_exist = $db->db_create_query('select', 'id_chl', 'fd_chungloai', array('id_chl'=>$id_chl));
					if ($db->db_num_rows($sql_check_id_cate_exist)) {
						$sql_del_cate = "DELETE FROM fd_chungloai WHERE id_chl = '$id_chl'";
						$db->db_exe_query($sql_del_cate);
					}
				}
			}
			elseif ($action == 'del_a_spec') {
				$id_chl = empty($_POST['id_spec']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_spec'])));
				if ($id_chl) {
					$sql_del_a_spec = "DELETE FROM fd_chungloai WHERE id_chl = '$id_chl'";
					$db->db_exe_query($sql_del_a_spec);
				}
			}
			else echo '*Không tìm thấy tác vụ';
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>