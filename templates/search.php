<div class="cont search-page">
	<h5>Kết quả tìm kiếm</h5>
	<div class="search card-columns">
		<?php
			$keyw = empty($_GET['search']) ? '' : trim(addslashes(htmlspecialchars($_GET['search'])));
			if ($keyw) {
				$current_page = empty($_GET['page']) ? '' : trim(addslashes(htmlspecialchars($_GET['page'])));
				//reset page
				if (empty($current_page)) {
					$current_page = 1;
				}
				$limit = 9;
				$start = ($current_page - 1) * $limit;
				//
				$sql_get_search_sp = "SELECT id_sp FROM fd_sanpham WHERE ten_sp LIKE '%$keyw%' OR tukhoa_sp LIKE '%$keyw%' AND trangthai_sp=1";
				$sql_get_limit_sp = "SELECT id_sp, ten_sp, mota_sp, slug_sp, url_thumb_sp, ghichu_sp FROM fd_sanpham WHERE (ten_sp LIKE '%$keyw%' OR tukhoa_sp LIKE '%$keyw%') AND trangthai_sp=1 LIMIT $start, $limit";
				if ($db->num_rows($sql_get_limit_sp)) {
					foreach ($db->fetch_assoc($sql_get_limit_sp, 0) as $key => $data_sp) {
							echo '<div class="card" style="border: none;">
									<div class="card-img h-100">
										<img class="card-img-top" src="'.$_DOMAIN .$data_sp['url_thumb_sp'].'" alt="'.$data_sp['ten_sp'].'">
									</div>
									<div class="card-body">
										<h4 class="card-title name-sp text-warning">'.$data_sp['ten_sp'].'</h4>
										<p class="card-text" style="overflow: hidden; text-overflow: ellipsis; max-height: 80px; line-height: 25px; -webkit-line-clamp: 3; display: -webkit-box; -webkit-box-orient: vertical;">'.$data_sp['mota_sp'].'</p>
									</div>
									<div class="card-footer">
										<a class="btn btn-warning text-dark" href="'.$_DOMAIN .$data_sp['slug_sp'].'-'.$data_sp['id_sp'].'.html">Chi tiết</a>
										
									</div>
							</div>';
						}
				}
				else {
					echo '</div><div class="cont bas-empty text-center">
								<p class="fa fa-search"></p>
								<p>Không có kết quả nào</p>
					</div>';
				}
				//nút
		        $config = array(
		          	'current_page' => $current_page,
		          	'total_record' => $db->num_rows($sql_get_search_sp),
		           	'limit' => $limit,
		           	'link_first' => $_DOMAIN .'search/key='.$keyw.'&page=1',
		          	'link_full' => $_DOMAIN .'search/key='.$keyw.'&page={page}',
	            	'range' => 10
	            );
	            $paging = new Pagination();
	            $paging->init($config);
			}
		?>
	</div>
	<?php
			echo '<div class="pag row w-100 m-0 p-0">';
	            echo $paging->html();
	            echo '</div>';
		?>
</div>