<?php
	if ($user) {
		$sql_get_all_cus = $db->db_create_query('select', 'id_kh, username_kh, diachi_kh, sdt_kh, email_kh, ngaythamgia_kh, xeploai_kh, trangthai_kh', 'fd_khachhang');
		$current_page = empty($_GET['page']) ? '' : trim(addslashes(htmlspecialchars($_GET['page'])));
		//reset page
		if (empty($current_page)) {
			$current_page = 1;
		}
		$limit = 10;
		$start = ($current_page - 1) * $limit;
		
		$sql_get_all_limit_cus = $db->db_create_query('select', 'id_kh, username_kh, diachi_kh, sdt_kh, email_kh, ngaythamgia_kh, trangthai_kh', 'fd_khachhang', array(), 'ORDER BY id_kh DESC LIMIT '.$start.', '.$limit.'');

		if ($db->db_num_rows($sql_get_all_limit_cus)) {
			echo '
				<div class="container content">
					<h4 class="text-success font-weight-bold">Khách hàng</h4>
					<a href="'.$_DOMAIN.'customers" class="btn btn-light">
						<span class="fa fa-repeat mr-1"></span> Tải lại
					</a>
					<button id="lock_cus_list" class="btn btn-warning">
						<span class="fa fa-lock mr-1"></span> Khóa
					</button>
					<button id="unlock_cus_list" class="btn btn-info">
						<span class="fa fa-unlock mr-1"></span> Mở khóa
					</button>
					<div class="table-responsive" id="list_cus" style="overflow:auto;">
                        <table class="table table-striped list" style="min-width:930px;">
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><strong>Tên đăng nhập</strong></td>
                                <td><strong>Địa chỉ</strong></td>
                                <td><strong>Phone</strong></td>
                                <td><strong>E-mail</strong></td>
                                <td><strong>Ngày tham gia</strong></td>
                                <td><strong>Trạng thái</strong></td>
                                <td><strong>Tools</strong></td>
                            </tr>
			';
			foreach ($db->db_fetch_assoc($sql_get_all_limit_cus, 0) as $key => $data_cus) {
				$stt_cus = $data_cus['trangthai_kh']==0 ? '<span class="badge badge-danger">Locked</span>' : '<span class="badge badge-info">Activated</span>';
				echo '
					<tr>
						<td><input type="checkbox" name="id_cate[]" value="'.$data_cus['id_kh'].'"></td>
						<td>'.$data_cus['username_kh'].'</td>
						<td>'.$data_cus['diachi_kh'].'</td>
						<td>'.$data_cus['sdt_kh'].'</td>
						<td>'.$data_cus['email_kh'].'</td>
						<td>'.$data_cus['ngaythamgia_kh'].'</td>
						<td>'.$stt_cus.'</td>
						<td>
							<button type="button" class="btn btn-warning btn-sm lock-cus" data-id="'.$data_cus['id_kh'].'"><span class="fa fa-lock"></span></button>
							<button type="button" class="btn btn-info btn-sm unlock-cus" data-id="'.$data_cus['id_kh'].'"><span class="fa fa-unlock"></span></button>
						</td>
					</tr>
				';
			}
			echo '</table></div>';
			//nút
			$config = array(
				'current_page' => $current_page,
				'total_record' => $db->db_num_rows($sql_get_all_cus),
				'limit' => $limit,
				'link_first' => $_DOMAIN .'customers',
				'link_full' => $_DOMAIN .'customers&page={page}',
				'range' => 10
			);
			$paging = new Pagination();
			$paging->init($config);
			echo $paging->html();
			echo '</div>';
		}
		else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Danh sách trống</h4></div>';
	}
	else new Redirect($_DOMAIN);
?>