<?php
	$slug_si = empty($_GET['slug_if']) ? '' : trim(addslashes(htmlspecialchars($_GET['slug_if'])));
	if ($slug_si) {
		$sql_check_slug = "SELECT id_si, tieude_si, noidung_si, url_thumb_si FROM fd_siteinfo WHERE slug_info_si='$slug_si'";
		if ($db->num_rows($sql_check_slug)) {
			$data_si = $db->fetch_assoc($sql_check_slug, 1);
			echo '<div class="cont info-si">
						<div class="tit-si text-center">
							<h2>'.$data_si['tieude_si'].'</h2>
						</div>
						<div class="thumb-si">
							<img class="img-si" src="'.$_DOMAIN. $data_si['url_thumb_si'].'" alt="'.$data_si['tieude_si'].'">
						</div>
						<div class="body-si">
							'.html_entity_decode($data_si['noidung_si']).'
						</div>
				</div>
			';
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>