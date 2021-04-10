<div class="mx-auto slider mb-5 p-0" id="sld">
	<div class="w-100 h-100">
		<div class="carousel slide mx-auto" data-ride="carousel" id="homeSlider">
			<ol class="carousel-indicators">
		      <?php
		      	$sql_count_slider = "SELECT id_slider FROM fd_slider";
		      	$count_slider = $db->num_rows($sql_count_slider);
		      	for ($i = 0; $i < $count_slider; $i++) { 
		      		if ($i == 0) {
		      			echo '<li data-target="#homeSlider" data-slide-to="0" class="active"></li>';
		      		}
		      		else {
		      			echo '<li data-target="#homeSlider" data-slide-to="'.$i.'"></li>';
		      		}
		      	}
		      ?>
		   </ol>
			<ul class="carousel-inner m-0 p-0">
				<?php
					$sql_get_slider = "SELECT * FROM fd_slider";
					if ($db->num_rows($sql_get_slider)) {
						foreach ($db->fetch_assoc($sql_get_slider, 0) as $key => $data_slider) {
							$sql_get_slug_sp = "SELECT slug_sp FROM fd_sanpham WHERE id_sp = '$data_slider[id_sp]'";
							$slug_sp = $db->fetch_assoc($sql_get_slug_sp, 1)['slug_sp'];
							if ($key == 0) {
								echo '
								<li class="carousel-item active m-0 p-0">
									<img class="m-0 p-0" src="'.$_DOMAIN .$data_slider['url_thumb_slider'].'" alt="'.$data_slider['title_sp'].'">
									 <div class="carousel-caption m-0 p-0">
									      <div class="card m-0 p-0">
										      	<div class="card-header">
													<h4 class="card-title m-0 p-0">'.$data_slider['title_sp'].'</h4>
										      	</div>
										      	<div class="card-body">
										      		<p class="card-text" style="overflow: hidden; text-overflow: ellipsis; max-height: 140px; line-height: 25px; -webkit-line-clamp: 5; display: -webkit-box; -webkit-box-orient: vertical;">'.$data_slider['mota_slider'].'</p>
										      	</div>
												<div class="card-footer">
													<a href="'.$_DOMAIN .$slug_sp. '-' .$data_slider['id_sp'].'.html" class="btn btn-warning card-link">Chi tiết</a>
										      </div>
									      </div>  
								   </div>
								</li>
								
								';
							}
							else {
								echo '
								<li class="carousel-item m-0 p-0">
									<img class="m-0 p-0" src="'.$_DOMAIN .$data_slider['url_thumb_slider'].'" alt="'.$data_slider['title_sp'].'">
									 <div class="carousel-caption m-0 p-0">
									      <div class="card m-0 p-0">
										      	<div class="card-header">
													<h4 class="card-title m-0 p-0">'.$data_slider['title_sp'].'</h4>
										      	</div>
										      	<div class="card-body">
										      		<p class="card-text" style="overflow: hidden; text-overflow: ellipsis; max-height: 120px; line-height: 25px; -webkit-line-clamp: 5; display: -webkit-box; -webkit-box-orient: vertical;">'.$data_slider['mota_slider'].'</p>
										      	</div>
												<div class="card-footer">
													<a href="'.$_DOMAIN .$slug_sp. '-' .$data_slider['id_sp'].'.html" class="btn btn-warning card-link">Chi tiết</a>
										      </div>
									      </div>  
								   </div>
								</li>
								
								';
							}
						}
					}
				?>
			</ul>
		</div>
	</div>
</div>
<div class="cont newest">
	<!--<div class="news-tit">
		<h3 class="text-warning">Nổi bật</h3>
	</div>-->
	<div class="hightlight p-0 m-0 card-columns">
		<?php
			$sql_get_all_record = "SELECT id_sp FROM fd_sanpham";
			if ($db->num_rows($sql_get_all_record)) {
				$all_record = $db->num_rows($sql_get_all_record);
				if ($all_record >= 7) {
					$min = $all_record - 7;
					$max = 6;
					$sql_get_rec = "SELECT id_sp, ten_sp, mota_sp, slug_sp, url_thumb_sp, ghichu_sp FROM fd_sanpham WHERE trangthai_sp=1 LIMIT $min, $max";
					if ($db->num_rows($sql_get_rec)) {
						foreach ($db->fetch_assoc($sql_get_rec, 0) as $key => $data_rec) {
							echo '<div class="card" style="border: none;">
									<div class="card-img h-100">
										<img class="card-img-top" src="'.$_DOMAIN .$data_rec['url_thumb_sp'].'" alt="'.$data_rec['ten_sp'].'">
									</div>
									<div class="card-body">
										<h4 class="card-title name-sp text-warning">'.$data_rec['ten_sp'].'</h4>
										<p class="card-text" style="overflow: hidden; text-overflow: ellipsis; max-height: 80px; line-height: 25px; -webkit-line-clamp: 3; display: -webkit-box; -webkit-box-orient: vertical;">'.$data_rec['mota_sp'].'</p>
									</div>
									<div class="card-body">
										<a class="btn btn-warning text-dark" href="'.$_DOMAIN .$data_rec['slug_sp'].'-'.$data_rec['id_sp'].'.html">Chi tiết</a>
										
									</div>
							</div>';
						}
						
					}
				}
				else {
					$sql_get_rec = "SELECT id_sp, ten_sp, mota_sp, slug_sp, url_thumb_sp, ghichu_sp FROM fd_sanpham WHERE trangthai_sp=1";
					if ($db->num_rows($sql_get_rec)) {
						foreach ($db->fetch_assoc($sql_get_rec, 0) as $key => $data_rec) {
							echo '<div class="card" style="border: none;">
									<div class="card-img h-100">
										<img class="card-img-top" src="'.$_DOMAIN .$data_rec['url_thumb_sp'].'" alt="'.$data_rec['ten_sp'].'">
									</div>
									<div class="card-body">
										<h4 class="card-title name-sp text-warning">'.$data_rec['ten_sp'].'</h4>
										<p class="card-text" style="overflow: hidden; text-overflow: ellipsis; max-height: 80px; line-height: 25px; -webkit-line-clamp: 3; display: -webkit-box; -webkit-box-orient: vertical;">'.$data_rec['mota_sp'].'</p>
									</div>
									<div class="card-body">
										<a class="btn btn-warning text-dark" href="'.$_DOMAIN .$data_rec['slug_sp'].'-'.$data_rec['id_sp'].'.html">Chi tiết</a>
										
									</div>
							</div>';
						}
						
					}
				}
			}
		?>
	</div>
</div>
