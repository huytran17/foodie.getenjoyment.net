<?php
	require_once('core/init.php');
	
	if ($user) {
		$ac = empty($_POST['act']) ? '' : GP($_POST['act']);
		if ($ac) {
			if ($ac == 'discard') {
				$iddh = empty($_POST['iddh']) ? '' : GP($_POST['iddh']);
				$sql_check_dh = "SELECT id_dh, id_kh FROM fd_donhang WHERE id_dh='$iddh'";
				if ($db->num_rows($sql_check_dh)) {
					$data_dh = $db->fetch_assoc($sql_check_dh, 1);
					if ($data_dh['id_kh'] == $data_member['id_kh']) {
						$sql_del_dh = "DELETE FROM fd_donhang WHERE id_dh='$iddh' AND id_kh='$data_member[id_kh]'";
						$db->query($sql_del_dh);
						echo '<script>window.location.reload();</script>';
					}
					else echo '*Đã xảy ra lỗi, bạn vui lòng thử lại sau.';
				}
				else echo '*Đã xảy ra lỗi, bạn vui lòng thử lại sau.';
			}
			else new Redirect($_DOMAIN);
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>