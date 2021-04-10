<?php
	if ($user ) {
		$idkh = $data_member['id_kh'];
		$sql_get_order = "SELECT * FROM fd_donhang WHERE id_kh='$idkh' ORDER BY id_dh DESC";

		$sql_get_kh = "SELECT id_kh, username_kh, password_kh, slug_kh, ngaythamgia_kh, xeploai_kh, url_thumb_kh FROM fd_khachhang WHERE id_kh='$idkh' AND trangthai_kh=1";
		if ($db->num_rows($sql_get_kh)) {
			$data_kh = $db->fetch_assoc($sql_get_kh, 1);
			echo '<div class="cont set-kh mt-3">
					<div class="kh">
						<figure class="avt-kh p-0 m-0 clearfix">
								<a class="p-0" href="'.$_DOMAIN .'profile/'.$data_kh['slug_kh'].'&ci='.$idkh.'"><img class="avt-thumb rounded-circle float-left d-block" src="'.$_DOMAIN. $data_kh['url_thumb_kh'].'" alt="'.$data_kh['username_kh'].'" width="50" height="50"></a>
						</figure>
				</div></div>';
		}

		echo '<div class="cont basket">';

		if ($db->num_rows($sql_get_order)) {
			foreach ($db->fetch_assoc($sql_get_order, 0) as $key => $data_ord) {
				$flag = true;
				$sql_get_sp = "SELECT id_sp, ten_sp, giamoi_sp, url_thumb_sp, trangthai_sp FROM fd_sanpham WHERE id_sp='$data_ord[id_sp]' AND trangthai_sp=1";
				if ($db->num_rows($sql_get_sp)) {
					$data_sp = $db->fetch_assoc($sql_get_sp, 1);
					$stt_dh = $data_ord['trangthai_dh'];
					
					if ($stt_dh) {
						if ($stt_dh == 1) {
							$stt_dh = '<div class="progress-bar bg-primary" role="progressbar" arial-valuenow="0" arial-valuemin="0" arial-valuemax="100" style="width:30%;">
												Đã tiếp nhận
											</div>
											';
						}
						elseif ($stt_dh == 2) {
							$stt_dh = '
								<div class="progress-bar bg-primary" role="progressbar" arial-valuenow="0" arial-valuemin="0" arial-valuemax="100" style="width:30%;">
												Đã tiếp nhận
											</div>
								<div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" arial-valuenow="0" arial-valuemin="0" arial-valuemax="100" style="width:30%;">
												Đang xử lí
											</div>
											';
						}
						elseif ($stt_dh == 3) {
							$flag = false;
							$stt_dh = '
								<div class="progress-bar bg-primary" role="progressbar" arial-valuenow="0" arial-valuemin="0" arial-valuemax="100" style="width:30%;">
												Đã tiếp nhận
											</div>
								<div class="progress-bar bg-info" role="progressbar" arial-valuenow="0" arial-valuemin="0" arial-valuemax="100" style="width:30%;">
												Hoàn tất
											</div>
								<div class="progress-bar bg-success" role="progressbar" arial-valuenow="0" arial-valuemin="0" arial-valuemax="100" style="width:30%;">
												Đã giao
											</div>
											';
						}
					}
					else $stt_dh = '<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" arial-valuenow="0" arial-valuemin="0" arial-valuemax="100" style="width:30%;">
												Không xác định
											</div>';
					echo '<figure class="basket-item">
								<div class="intro clearfix">
									<div class="avt float-left">
										<img src="'.$_DOMAIN. $data_sp['url_thumb_sp'].'" alt="'.$data_sp['ten_sp'].'">
									</div>
									<div class="info">
										<h5 class="tit">'.$data_sp['ten_sp'].'</h5>
										<p class="pr">Giá bán:&nbsp;<span class="text-danger">'.number_format($data_sp['giamoi_sp'], 0,'','.').'&nbsp;&#x20AB;</span></p>
										<p class="am">Số lượng:&nbsp;<span class="text-danger">'.$data_ord['soluong_dh'].'</span></p>
										<p class="ck">Thanh toán:&nbsp;<span class="text-danger">'.number_format($data_ord['thanhtien_dh'], 0, '', '.').'&nbsp;&#x20AB;</span></p>
										<p class="or">Ngày đặt:&nbsp;<span class="text-danger">'.$data_ord['ngaydat_dh'].'</span></p>
										<p class="rc">Nhận hàng dự kiến:&nbsp;<span class="text-danger">'.$data_ord['ngaynhan_dh'].'</span></p>
									</div>
								</div>	
								<div class="prog">
										<div class="progress">
											'.$stt_dh.'
										</div>
								</div>
					';
					if ($flag) {
						echo '<div class="opt">
									<button class="btn btn-danger btn-discard" val="'.$data_ord['id_dh'].'" data-toggle="modal" data-target="#mo_conf">Hủy</button>
								</div>';
					}
					echo '</figure>';
				}
				else echo '<h5 class="text-danger">Lỗi</h5>';
			}
			echo '<div class="modal fade" id="mo_conf" data-backdrop="static" data-keyboard="true" tabindex="-1" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
										<p class="text-center">Bạn có chắc chắn muốn hủy đơn hàng này không?</p>
										<p class="err m-0 d-none"><small class="text-danger"></small></p>
									</div>
									<div class="modal-footer">
										<button class="btn btn-warning" type="button">Đồng ý</button>
										<button class="btn btn-info" type="button" data-dismiss="modal">Giữ lại</button>
									</div>
								</div>
							</div>
						</div>';
			echo '</div>';
		}
		else {
			echo '</div><div class="cont bas-empty text-center">
						<p class="fa fa-shopping-cart"></p>
						<p>Không có đơn hàng nào</p>
			</div>';
		}
	}
	else new Redirect($_DOMAIN);
?>