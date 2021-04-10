<?php
	$slug_cate = empty($_GET['slug_cate']) ? '' : trim(addslashes(htmlspecialchars($_GET['slug_cate'])));

	$current_page = empty($_GET['page']) ? '' : trim(addslashes(htmlspecialchars($_GET['page'])));
	//reset page
	if (empty($current_page)) {
		$current_page = 1;
	}
	$limit = 6;
	$start = ($current_page - 1) * $limit;

	$sql_get_spec = "SELECT id_chl, ten_chl, mota_chl, slug_chl FROM fd_chungloai WHERE slug_chl='$slug_cate' AND trangthai_chl=1";
	if ($db->num_rows($sql_get_spec)) {
		$data_spec = $db->fetch_assoc($sql_get_spec, 1);
		echo '<article class="cont species">';
		echo '
		 	<div class="spec-tit text-center">
					<h1 class="text-warning">'.$data_spec['ten_chl'].'</h1>
					<p>'.html_entity_decode($data_spec['mota_chl']).'</p>
			</div>
		';
		$sql_get_all_sp = "SELECT id_sp FROM fd_sanpham WHERE id_chl='$data_spec[id_chl]' AND trangthai_sp=1";
		$sql_get_limit_sp = "SELECT id_sp, ten_sp, slug_sp, url_thumb_sp FROM fd_sanpham WHERE id_chl='$data_spec[id_chl]' AND trangthai_sp=1 LIMIT $start, $limit";
		if ($db->num_rows($sql_get_limit_sp)) {
			echo '<div class="sp-list w-100 row card-columns p-0 m-0">';
			foreach ($db->fetch_assoc($sql_get_limit_sp, 0) as $key => $data_sp) {
				echo '<div class="card col-12 col-md-4 px-2 py-0">
							<div class="card-img">
								<a href="'.$_DOMAIN .$data_sp['slug_sp'] .'-'. $data_sp['id_sp'].'.html"><img class="card-img-top" src="'.$_DOMAIN .$data_sp['url_thumb_sp'].'" alt="'.$data_sp['ten_sp'].'" width="178" height="178"></a>
							</div>
							<div class="card-body">
								<a href="'.$_DOMAIN .$data_sp['slug_sp'] .'-'. $data_sp['id_sp'].'.html" class="card-title" style="overflow: hidden; text-overflow: ellipsis; max-height: 80px; line-height: 25px; -webkit-line-clamp: 3; display: -webkit-box; -webkit-box-orient: vertical; color: black;">'.$data_sp['ten_sp'].'</a>
							</div>
					</div>
				';
			}
			echo '</div>';
			//nut
			$config = array(
				'current_page' => $current_page,
			    'total_record' => $db->num_rows($sql_get_all_sp),
			    'limit' => $limit,
			    'link_first' => $_DOMAIN .'species/'.$data_spec['slug_chl'].'&page=1',
			    'link_full' => $_DOMAIN .'species/'.$data_spec['slug_chl'].'&page={page}',
		        'range' => 10
			);
			$paging = new Pagination();
		    $paging->init($config);
			echo $paging->html();
		}
		echo '</article>';
	}
	else new Redirect($_DOMAIN);
?>