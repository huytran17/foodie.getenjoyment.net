<?php
	$slug_post = empty($_GET['slug_post']) ? '' : trim(addslashes(htmlspecialchars($_GET['slug_post'])));
	$id_post = empty($_GET['id']) ? '' : trim(addslashes(htmlspecialchars($_GET['id'])));

	$sql_get_post = "SELECT id_sp, id_chl, ten_sp, mota_sp, chitiet_sp, slug_sp, url_thumb_sp, ghichu_sp, nutri_sp, url_avt_sp FROM fd_sanpham WHERE id_sp='$id_post' AND slug_sp='$slug_post' AND trangthai_sp=1";
	if ($db->num_rows($sql_get_post)) {
		$data_post = $db->fetch_assoc($sql_get_post, 1);
		$nutri_sp = json_decode($data_post['nutri_sp'], 1);
		$sql_get_chl = "SELECT id_chl, ten_chl, slug_chl FROM fd_chungloai WHERE id_chl='$data_post[id_chl]' AND trangthai_chl=1";
		if ($db->num_rows($sql_get_chl)) {
			$data_chl = $db->fetch_assoc($sql_get_chl, 1);
		}
		else $data_chl = array('id_chl'=>'', 'ten_chl'=>'', 'slug_chl'=>'');

		echo '<div class="cont post">';
		echo '<div class="info row w-100 m-0">
				<div class="post-thumb col-12 col-md-7">
					<img src="'.$_DOMAIN .$data_post['url_avt_sp'].'" alt="'.$data_post['ten_sp'].'">
				</div>
				<div class="descr-post col-12 col-md-5">
					<h1 class="text-center text-md-left name-sp text-warning">'.$data_post['ten_sp'].'</h1>
					<p class="des">'.$data_post['mota_sp'].'</p>
					<small class="note">'.html_entity_decode($data_post['ghichu_sp']).'</small>
					<a href="'.$_DOMAIN.'order/'.$data_post['slug_sp'].'-'.$data_post['id_sp'].'" class="btn btn-warning order-link">Đặt hàng</a>
				</div>
			</div>
			<div class="detail-product">
				<h3>Chi tiết sản phẩm <span class="fa fa-angle-down"></span></h3>
				<div class="detail">
					<ul class="row detail-pr w-100 p-0 m-0">
						<li class="piece">
							<p class="info"><span>'.html_entity_decode($data_post['chitiet_sp']).'</span></p>
						</li>
						<li class="piece">
							<p class="info"><strong>Xem thêm:</strong> <a href="'.$_DOMAIN .'species/' .$data_chl['slug_chl'].'&page=1">'.$data_chl['ten_chl'].'</a></p>
						</li>
					</ul>
				</div>
			</div>
			<hr class="w-75 mx-auto">
			<div class="nutri-summary">
				<h3>Thông tin dinh dưỡng <span class="fa fa-angle-down"></span></h3>
				<div class="nutri-detail">
					<ul class="row common-nt w-100">
						<li class="item col-6 col-sm-4">
							<p class="value"><span>'.$nutri_sp['calo'].'Cal.</span></p>
							<span class="metric">Ca-lo</span>
						</li>
						<li class="item col-6 col-sm-4">
							<p class="value"><span>'.$nutri_sp['fat'].'g</span></p>
							<span class="metric">Chất béo</span>
						</li>
						<li class="item col-6 col-sm-4">
							<p class="value"><span>'.$nutri_sp['protein'].'g</span></p>
							<span class="metric">Chất đạm</span>
						</li>
					</ul>
					<ul class="row detail-nt w-100 m-0">
						<li class="label">
							<span class="metric">Chất béo bão hòa:</span>
							<span class="value">'.$nutri_sp['satfat'].'g</span>
						</li>
						<li class="label">
							<span class="metric">Chất xơ:</span>
							<span class="value">'.$nutri_sp['diefib'].'g</span>
						</li>
						<li class="label">
							<span class="metric">Canxi:</span>
							<span class="value">'.$nutri_sp['canxi'].'g</span>
						</li>
						<li class="label">
							<span class="metric">Đường:</span>
							<span class="value">'.$nutri_sp['sugar'].'g</span>
						</li>
						<li class="label">
							<span class="metric">Sắt:</span>
							<span class="value">'.$nutri_sp['iron'].'g</span>
						</li>
						<li class="label">
							<span class="metric">Cholesterol:</span>
							<span class="value">'.$nutri_sp['chles'].'g</span>
						</li>
						<li class="label">
							<span class="metric">Vitamin D:</span>
							<span class="value">'.$nutri_sp['vitD'].'g</span>
						</li>
					</ul>
				</div>
			</div>
		';
		echo '</div>';
		$sql_get_related = "SELECT id_sp, ten_sp, slug_sp, url_thumb_sp FROM fd_sanpham WHERE id_chl='$data_post[id_chl]' AND id_sp !='$data_post[id_sp]' AND trangthai_sp=1 LIMIT 8";
		if ($db->num_rows($sql_get_related)) {
			echo '
							<div class="cont related">
								<div class="row m-0 p-0 related-inner">
			';
			foreach ($db->fetch_assoc($sql_get_related, 0) as $key => $data_related) {
					echo '<div class="card col-12 col-md-4 col-lg-3" style="border: none;">
									<div class="card-img">
										<a href="'.$_DOMAIN .$data_related['slug_sp'].'-'.$data_related['id_sp'].'.html"><img src="'.$_DOMAIN .$data_related['url_thumb_sp'].'" alt="'.$data_related['ten_sp'].'" width="180" height="180"></a>
									</div>
									<div class="card-body">
										<a href="'.$_DOMAIN .$data_related['slug_sp'].'-'.$data_related['id_sp'].'.html"><h4 class="card-title name-sp text-warning">'.$data_related['ten_sp'].'</h4></a>
									</div>
							</div>';
			}
			echo '</div></div>';
		}
	}
	else new Redirect($_DOMAIN);
?>