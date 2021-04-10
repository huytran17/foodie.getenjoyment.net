<?php
	if ($user) {
		//phân trang
			$current_page = empty($_GET['page']) ? '' : trim(addslashes(htmlspecialchars($_GET['page'])));
			//reset page
			if (empty($current_page)) {
				$current_page = 1;
			}
			$limit = 10;
			$start = ($current_page - 1) * $limit;
		echo
	            '<div class="container content" id="table_order">
	            <h4 class="text-success font-weight-bold">Đơn hàng</h4>
	                <a href="' . $_DOMAIN . 'orders" class="btn btn-light">
	                    <span class="fa fa-repeat"></span> Reload
	                </a> 
	                <button class="btn btn-info" id="proc_list_order">
	                    <span class="fa fa-spinner"></span> Đang xử lí
	                </button> 
	                <button class="btn btn-success" id="apply_list_order">
	                    <span class="fa fa-check"></span> Xác nhận giao
	                </button> 
	                <select id="or_filter">
						<option value="1">Mới nhất</option>
						<option value="2">Đang xử lí</option>
						<option value="3">Đã giao</option>
	                </select>
	            ';
	    
	    $sql_get_all_limit_order = $db->db_create_query('select', '*', 'fd_donhang', array(), 'LIMIT '.$start.', '.$limit.'');
	    $sql_get_all_order = $db->db_create_query('select', 'id_dh', 'fd_donhang');
	    if ($db->db_num_rows($sql_get_all_limit_order)) {
	    	echo
                '
                    <div class="table-responsive" id="list_order" style="overflow:auto;">
                        <table class="table table-striped list" style="min-width:930px;">
                        	<thead>
	                            <tr>
	                                <td><input type="checkbox"></td>
	                                <td><strong>Mã số</strong></td>
	                                <td><strong>Khách hàng</strong></td>
	                                <td><strong>Sản phẩm</strong></td>
	                                <td><strong>Địa chỉ nhận</strong></td>
	                                <td><strong>Số điện thoại</strong></td>
	                                <td><strong>Ngày đặt</strong></td>
	                                <td><strong>Ngày nhận dự kiến</strong></td>
	                                <td><strong>Số lượng</strong></td>
	                                <td><strong>Thành tiền</strong></td>
	                                <td><strong>Trạng thái</strong></td>
	                                <td><strong>Tools</strong></td>
	                            </tr>
                            </thead>
                            <tbody>
                ';
            foreach ($db->db_fetch_assoc($sql_get_all_limit_order, 0) as $key => $data_order) {
            	if ($data_order['trangthai_dh'] == 1) {
            		$stt_dh = '<span class="badge badge-primary">Đã tiếp nhận</span>';
            	}
            	elseif ($data_order['trangthai_dh'] == 2) {
            		$stt_dh = '<span class="badge badge-info">Đang xử lí</span>';
            	}
            	elseif ($data_order['trangthai_dh'] == 3) {
            		$stt_dh = '<span class="badge badge-success">Đã giao</span>';
            	}
            	else {
            		$stt_dh = '<span class="badge badge-warning">Không rõ</span>';
            	}
            	$sql_get_cus = $db->db_create_query('select', 'username_kh', 'fd_khachhang', array('id_kh'=>$data_order['id_kh']));
            	$sql_get_sp = $db->db_create_query('select', 'ten_sp', 'fd_sanpham', array('id_sp'=>$data_order['id_sp']));
            	$name_cus = '';
            	$name_sp = '';
            	if ($db->db_num_rows($sql_get_cus)) {
            		$name_cus = $db->db_fetch_assoc($sql_get_cus, 1)['username_kh'];
            	}
            	if ($db->db_num_rows($sql_get_sp)) {
            		$name_sp = $db->db_fetch_assoc($sql_get_sp, 1)['ten_sp'];
            	}
         
            	echo '
						<tr>
							<td><input type="checkbox" name="id_order[]" value="'.$data_order['id_dh'].'"></td>
							<td>'.$data_order['id_dh'].'</td>
							<td>'.$name_cus.'</td>
							<td>'.$name_sp.'</td>
							<td>'.$data_order['dcnh_dh'].'</td>
							<td>'.$data_order['sdtnh_dh'].'</td>
							<td>'.$data_order['ngaydat_dh'].'</td>
							<td>'.$data_order['ngaynhan_dh'].'</td>
							<td>'.$data_order['soluong_dh'].'</td>
							<td>'.number_format($data_order['thanhtien_dh'], 0, '', ',').'</td>
							<td>'.$stt_dh.'</td>
							<td>
									<button type="button" class="btn btn-info btn-sm proc-order" di="'.$data_order['id_dh'].'"><span class="fa fa-spinner"></span></button>
									<button type="button" class="btn btn-success btn-sm apply-order" di="'.$data_order['id_dh'].'"><span class="fa fa-check"></span></button>
								</td>
						</tr>
	            	';
            }
            echo '</tbody></table></div>';
            //nút
	        $config = array(
	          	'current_page' => $current_page,
	          	'total_record' => $db->db_num_rows($sql_get_all_order),
	           	'limit' => $limit,
	           	'link_first' => $_DOMAIN .'orders',
	          	'link_full' => $_DOMAIN .'orders&page={page}',
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