<?php
	if ($user) {
		//admin
		echo '<div class="container content mb-5">
				<h2 class="mb-4">Quản trị viên</h2>
				<div class="row board_admin w-100 m-0">';
		//
		$sql_get_all_ad = $db->db_create_query('select', 'id_ad', 'fd_admin');
		$sql_get_all_s_ad = $db->db_create_query('select', 'id_ad', 'fd_admin', array('vitri_ad'=>1));
		$sql_get_all_locked_ad = $db->db_create_query('select', 'id_ad', 'fd_admin', array('trangthai_ad'=>0));
		
		$count_all_ad = $db->db_num_rows($sql_get_all_ad);
		$count_all_s_ad = $db->db_num_rows($sql_get_all_s_ad);
		$count_all_locked_ad = $db->db_num_rows($sql_get_all_locked_ad);

		echo '<div class="col-md-4">
					<div class="alert alert-info">
						<h1>'.$count_all_ad.'</h1>
						<p><strong>admin</strong></p>
					</div>
				</div>
			<div class="col-md-4">
				<div class="alert alert-success">
					<h1>'.$count_all_s_ad.'</h1>
					<p><strong>super admin</strong></p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="alert alert-danger">
					<h1>'.$count_all_locked_ad.'</h1>
					<p><strong>đã khóa</strong></p>
				</div>
			</div>
		';
		//don hang
		echo '
		<hr class="w-100">
			<h2 class="mb-4">Đơn hàng</h2>
			<div class="row board_order w-100 m-0">';
		//
		$sql_get_all_order = $db->db_create_query('select', 'id_dh', 'fd_donhang');
		$sql_get_all_order_1 = $db->db_create_query('select', 'id_dh', 'fd_donhang', array('trangthai_dh'=>1));
		$sql_get_all_order_2 = $db->db_create_query('select', 'id_dh', 'fd_donhang', array('trangthai_dh'=>2));
		$sql_get_all_order_3 = $db->db_create_query('select', 'id_dh', 'fd_donhang', array('trangthai_dh'=>3));

		$count_all_order = $db->db_num_rows($sql_get_all_order);
		$count_all_order_1 = $db->db_num_rows($sql_get_all_order_1);
		$count_all_order_2 = $db->db_num_rows($sql_get_all_order_2);
		$count_all_order_3 = $db->db_num_rows($sql_get_all_order_3);

		echo '<div class="col-md-4">
					<div class="alert alert-primary">
						<h1>'.$count_all_order.'</h1>
						<p><strong>đơn hàng</strong></p>
					</div>
				</div>
			<div class="col-md-4">
				<div class="alert alert-success">
					<h1>'.$count_all_order_1.'</h1>
					<p><strong>đã tiếp nhận</strong></p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="alert alert-info">
					<h1>'.$count_all_order_2.'</h1>
					<p><strong>đang xử lí</strong></p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="alert alert-success">
					<h1>'.$count_all_order_3.'</h1>
					<p><strong>đã giao</strong></p>
				</div>
			</div>
			
		';
		//khach hang
		echo '
		<hr class="w-100">
			<h2 class="mb-4">Khách hàng</h2>
			<div class="row board_cus w-100 m-0">';

		$sql_get_all_cus = $db->db_create_query('select', 'id_kh', 'fd_khachhang');
		$sql_get_all_cus_nor = $db->db_create_query('select', 'id_kh', 'fd_khachhang', array('xeploai_kh'=>2));
		$sql_get_all_cus_locked = $db->db_create_query('select', 'id_kh', 'fd_khachhang', array('trangthai_kh'=>0));

		$count_all_cus = $db->db_num_rows($sql_get_all_cus);
		$count_all_cus_nor = $db->db_num_rows($sql_get_all_cus_nor);
		$count_all_cus_locked = $db->db_num_rows($sql_get_all_cus_locked);

		echo '<div class="col-md-4">
					<div class="alert alert-info">
						<h1>'.$count_all_cus.'</h1>
						<p><strong>khách hàng</strong></p>
					</div>
				</div>
			
			<div class="col-md-4">
				<div class="alert alert-secondary">
					<h1>'.$count_all_cus_locked.'</h1>
					<p><strong>bị khóa</strong></p>
				</div>
			</div>
		';
		
		//sản phẩm
		echo '<hr class="w-100">
				<h2 class="mb-4">Sản phẩm</h2>
				<div class="row board_sp w-100 m-0">';

		$sql_get_all_sp = $db->db_create_query('select', 'id_sp', 'fd_sanpham');
		$sql_get_all_sp_bought = $db->db_create_query('select', 'SUM(solanmua_sp) AS "bought"', 'fd_sanpham');
		$sql_get_all_sp_locked = $db->db_create_query('select', 'id_sp', 'fd_sanpham', array('trangthai_sp'=>0));

		$count_all_sp = $db->db_num_rows($sql_get_all_sp);
		$count_all_sp_bought = $db->db_fetch_assoc($sql_get_all_sp_bought, 1);
		$count_all_sp_locked = $db->db_num_rows($sql_get_all_sp_locked);
		
		echo '<div class="col-md-4">
					<div class="alert alert-info">
						<h1>'.$count_all_sp.'</h1>
						<p><strong>sản phẩm</strong></p>
					</div>
				</div>
			
			
			<div class="col-md-4">
				<div class="alert alert-primary">
					<h1>'.$count_all_sp_bought['bought'].'</h1>
					<p><strong>đã bán</strong></p>
				</div>
			</div>
			<div class="col-md-4">
					<div class="alert alert-info">
						<h1>'.($count_all_sp - $count_all_sp_locked).'</h1>
						<p><strong>đang kinh doanh</strong></p>
					</div>
				</div>
			<div class="col-md-4">
				<div class="alert alert-warning">
					<h1>'.$count_all_sp_locked.'</h1>
					<p><strong>ngừng bán</strong></p>
				</div>
			</div>
		';

		echo '</div></div>';
	}
	else new Redirect($_DOMAIN);
?>