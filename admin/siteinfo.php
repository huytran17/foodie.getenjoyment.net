<?php
	require_once('core/init.php');
	if ($user) {
		if (isset($_FILES['inpEditInfoThumb'])) {
			$dir = '../upload/infoth/';
			$name_img = $_FILES['inpEditInfoThumb']['name'];
			$source_img = $_FILES['inpEditInfoThumb']['tmp_name'];

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
			$id_si = empty($_POST['hiddenID']) ? '' : trim(addslashes(htmlspecialchars($_POST['hiddenID'])));
			if ($id_si) {
				$sql_update_thumb_si = "UPDATE fd_siteinfo SET
					url_thumb_si = '$url_img'
					WHERE id_si = '$id_si'				
				";
				$db->db_exe_query($sql_update_thumb_si);
			}
			echo '<script>window.location.reload();</script>';

		}
		elseif ($_POST['action']) {
			$ac = trim(addslashes(htmlspecialchars($_POST['action'])));
			if ($ac == 'add_si') {
				$titleAddSi = empty($_POST['titleAddSi']) ? '' : trim(addslashes(htmlspecialchars($_POST['titleAddSi'])));
				$selAddPar = empty($_POST['selAddPar']) ? '' : trim(addslashes(htmlspecialchars($_POST['selAddPar'])));
				$ed_addNdSi = empty($_POST['ed_addNdSi']) ? '' : trim(addslashes(htmlspecialchars($_POST['ed_addNdSi'])));
				if (empty($titleAddSi)) {
					echo '*Vui lòng điền các thông tin bắt buộc';
				}
				else {
					$slug_info = $slug->to_slug($titleAddSi);
					$sql_add_si = "INSERT INTO fd_siteinfo VALUES(
						'',
						'$titleAddSi',
						'$ed_addNdSi',
						'$selAddPar',
						'$slug_info',
						''
					)";
					$db->db_exe_query($sql_add_si);
					new Redirect($_DOMAIN .'site');
				}
			}
			elseif ($ac == 'edit_si') {
				$titleEditSi = empty($_POST['titleEditSi']) ? '' : trim(addslashes(htmlspecialchars($_POST['titleEditSi'])));
				$selEditPar = empty($_POST['selEditPar']) ? '' : trim(addslashes(htmlspecialchars($_POST['selEditPar'])));
				$ed_editSi = empty($_POST['ed_editSi']) ? '' : trim(addslashes(htmlspecialchars($_POST['ed_editSi'])));
				if (empty($titleEditSi)) {
					echo '*Vui lòng điền các thông tin bắt buộc';
				}
				else {
					$slug_info = $slug->to_slug($titleEditSi);
					$id = empty($_POST['id_si']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_si'])));
					$sql_update_si = "UPDATE fd_siteinfo SET 
						tieude_si = '$titleEditSi',
						noidung_si = '$ed_editSi',
						idcha_si = '$selEditPar',
						slug_info_si = '$slug_info'
						WHERE id_si = '$id'
					";
					$db->db_exe_query($sql_update_si);
					echo '<script>window.location.reload();</script>';
				}
			}
			elseif ($ac == 'del_si') {
				$id = empty($_POST['id_si']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_si'])));
				$sql_del_si = "DELETE FROM fd_siteinfo WHERE id_si='$id'";
				$db->db_exe_query($sql_del_si);
			}
			else  new Redirect($_DOMAIN);
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>