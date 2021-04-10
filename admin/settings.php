<?php
	require_once('core/init.php');
	if ($user) {
		$ac = empty($_POST['action']) ? '' : trim(addslashes(htmlspecialchars($_POST['action'])));
		if ($ac) {
			if ($ac == 'edit_stt') {
				$stt_site = trim(addslashes(htmlspecialchars($_POST['stt_site'])));
				$sql_up_stt_site = "UPDATE fd_website SET trangthai_ws = '$stt_site'";
				$db->db_exe_query($sql_up_stt_site);
				echo '<script>window.location.reload();</script>';
			}
			elseif ($ac == 'edit_info') {
				$title_site = empty($_POST['title_site']) ? '' : trim(addslashes(htmlspecialchars($_POST['title_site'])));
				$descr_site = empty($_POST['descr_site']) ? '' : trim(addslashes(htmlspecialchars($_POST['descr_site'])));
				$keywords_site = empty($_POST['keywords_site']) ? '' : trim(addslashes(htmlspecialchars($_POST['keywords_site'])));
				if (empty($title_site) || empty($descr_site)) {
					echo '*Vui lòng điền các thông tin bắt buộc';
				}
				else {
					$sql_up_info_site = "UPDATE fd_website SET
						tieude_ws = '$title_site',
						mota_ws = '$descr_site',
						keyword_ws = '$keywords_site'
					";
					$db->db_exe_query($sql_up_info_site);
					echo '<script>window.location.reload();</script>';
				}
			}
			else new Redirect($_DOMAIN);
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>