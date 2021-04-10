<?php
	if (!$user) {
		new Redirect($_DOMAIN .'sign-in');
	}
	else {
		$slug_sp = empty($_GET['slug_sp']) ? '' : trim(addslashes(htmlspecialchars($_GET['slug_sp'])));
		$id_sp = empty($_GET['id']) ? '' : trim(addslashes(htmlspecialchars($_GET['id'])));
		if ($slug_sp && $id_sp) {
			$sql_get_sp = "SELECT id_sp, id_chl, ten_sp, mota_sp, slug_sp, giagoc_sp, giamgia_sp, giamoi_sp, ghichu_sp, url_avt_sp FROM fd_sanpham WHERE id_sp='$id_sp' AND slug_sp='$slug_sp' AND trangthai_sp=1";
			if ($db->num_rows($sql_get_sp)) {
				$data_sp = $db->fetch_assoc($sql_get_sp, 1);

				$sql_get_chl = "SELECT id_chl, ten_chl, slug_chl FROM fd_chungloai WHERE id_chl='$data_sp[id_chl]' AND trangthai_chl=1";
				if ($db->num_rows($sql_get_chl)) {
					$slug_chl = $db->fetch_assoc($sql_get_chl, 1)['slug_chl'];
					$ten_chl = $db->fetch_assoc($sql_get_chl, 1)['ten_chl'];
					$id_chl = $db->fetch_assoc($sql_get_chl, 1)['id_chl'];
				}
				else {
					$ten_chl = 'Không xác định';
					$slug_chl = '';
					$id_chl = '';
				}

				echo '<div class="cont order-sp">
							<div class="thumb-sp">
								<img src="'.$_DOMAIN .$data_sp['url_avt_sp'].'" alt="'.$data_sp['ten_sp'].'">
							</div>
							<div class="info-sp">
								<h3 class="text-warning">'.$data_sp['ten_sp'].'</h3>
								<p><strong>Loại:</strong>&nbsp;<a style="text-decoration: none;" href="'.$_DOMAIN .'species/' .$slug_chl.'">'.$ten_chl.'</a></p>
								<p>'.html_entity_decode($data_sp['mota_sp']).'</p>
								<p><small>'.html_entity_decode($data_sp['ghichu_sp']).'</small></p>
								<p><strong>Giá hiện tại:</strong>&nbsp; <span class="text-danger">'.number_format(intval($data_sp['giagoc_sp']), 0, '', '.').' &#x20AB;</span></p>
								<p><strong>Giảm giá:</strong>&nbsp; <span class="text-danger">'.$data_sp['giamgia_sp'].'</span>% (<span class="text-danger">-'.number_format(intval($data_sp['giagoc_sp']) - intval($data_sp['giamoi_sp']), 0, '', '.').'&nbsp;&#x20AB;</span>)</p>
								<p><strong>Cần thanh toán:</strong>&nbsp; <span class="text-danger">'.number_format(intval($data_sp['giamoi_sp']), 0, '', '.').' &#x20AB;</span></p>
							</div>
							<div class="form-order">
								<form method="POST" id="formOrder" onsubmit="return false">
									<div class="form-group">
										<strong>Số lượng: </strong>
										<div class="selector">
											<span class="fa fa-minus"></span>
											<input type="number" class="form-control" min=1 value="1">
											<span class="fa fa-plus"></span>
										</div>
									</div>
									<div class="form-group">
										<input type="text" class="form-control add" name="add" placeholder="Địa chỉ...">
									</div>
									<div class="form-group">
										<input type="tel" class="form-control tel p-0" name="tel" placeholder="Số điện thoại...">
									</div>
									<div class="total">
										<label class="m-0">Tổng:&nbsp;<span>'.number_format($data_sp['giamoi_sp'], 0, '', ',').'</span> &#x20AB;</label>
									</div>
									<div class="form-group my-4">
										<img src="../capt.php" id="img_capt">
										<input type="text" id="capt_code" required="required">
										<input type="button" value="&#8635;" id="capt_reload">
									</div>
									<div class="form-group">
										<p class="err m-0 d-none"><small class="text-danger"></small></p>
									</div>
									<div class="form-group">
										<button class="btn btn-warning btnOrder m-0" s="'.$data_sp['id_sp'].'">Xác nhận</button>
									</div>
								</form>
							</div>
					</div>
				';
			}
		}
		else {
			new Redirect($_DOMAIN);
		}
	}
?>