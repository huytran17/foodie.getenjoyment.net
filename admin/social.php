<?php
	require_once('core/init.php');
	if ($user) {
		$ac = empty($_POST['action']) ? '' : trim(addslashes(htmlspecialchars($_POST['action'])));
		if ($ac) {
			if ($ac == 'add_sm') {
				$titleAddSm = empty($_POST['titleAddSm']) ? '' : trim(addslashes(htmlspecialchars($_POST['titleAddSm'])));
				$linkAddSm = empty($_POST['linkAddSm']) ? '' : trim(addslashes(htmlspecialchars($_POST['linkAddSm'])));
				$iconAddSm = empty($_POST['iconAddSm']) ? '' : trim(addslashes(htmlspecialchars($_POST['iconAddSm'])));
				if (empty($titleAddSm)) {
					echo '*Vui lòng điền các thông tin bắt buộc';
				}
				else {
					$sql_add_sm = "INSERT INTO fd_socialmedia VALUES(
						'',
						'$titleAddSm',
						'$linkAddSm',
						'$iconAddSm'
					)";
					$db->db_exe_query($sql_add_sm);
					new Redirect($_DOMAIN .'social');
				}
			}
			elseif ($ac == 'edit_sm') {
				$titleEditSm = empty($_POST['titleEditSm']) ? '' : trim(addslashes(htmlspecialchars($_POST['titleEditSm'])));
				$linkEditSm = empty($_POST['linkEditSm']) ? '' : trim(addslashes(htmlspecialchars($_POST['linkEditSm'])));
				$iconEditSm = empty($_POST['iconEditSm']) ? '' : trim(addslashes(htmlspecialchars($_POST['iconEditSm'])));
				$id = empty($_POST['id']) ? '' : trim(addslashes(htmlspecialchars($_POST['id'])));
				if (empty($titleEditSm)) {
					echo '*Vui lòng điền các thông tin bắt buộc';
				}
				else {
					$sql_update_sm = "UPDATE fd_socialmedia SET 
						tieude_sm = '$titleEditSm',
						link_sm = '$linkEditSm',
						icon_sm = '$iconEditSm'
						WHERE id_sm = '$id'
					";
					$db->db_exe_query($sql_update_sm);
					echo '<script>window.location.reload();</script>';
				}
			}
			elseif ($ac == 'del_sm') {
				$id = empty($_POST['id_sm']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_sm'])));
				$sql_del_sm = "DELETE FROM fd_socialmedia WHERE id_sm='$id'";
				$db->db_exe_query($sql_del_sm);
			}
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>