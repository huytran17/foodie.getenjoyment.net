<?php
	if ($user) {
		if ($data_user['vitri_ad'] == 1) {
			$sql_get_data_site = $db->db_create_query('select', '*', 'fd_website');
			if ($db->db_num_rows($sql_get_data_site)) {
				echo '<div class="container content">
							<h4 class="text-success font-weight-bold">Cài đặt trang web</h4>
							<div class="card stt-site">
								<div class="card-header text-info font-weight-bold">Trạng thái</div>
								<div class="card-body">
									<form method="POST" id="formEditStatusSite" onsubmit="return false">
					';
				$data_site = $db->db_fetch_assoc($sql_get_data_site, 1);
				$stt_site_open = '';
				$stt_site_close = '';
				if ($data_site['trangthai_ws'] == 0) {  //đang đóng
					$stt_site_close = 'checked="checked"';
				}
				elseif ($data_site['trangthai_ws'] == 1) { //đang mở
					$stt_site_open = 'checked="checked"';
				}
				echo '
					<div class="radio form-group">
						<input type="radio" name="stt_site" value="1" '.$stt_site_open.'> Hoạt động
					</div>
					<div class="radio form-group">
						<input type="radio" name="stt_site" value="0" '.$stt_site_close.'> Bảo trì
					</div>
					<div class="form-group">
									<p id="errEditSttSite" class="text-danger d-none"><small><i></i></small></p>
								</div>
					<div class="form-group">
						<button type="button" class="btn btn-info" id="btnEditStatusSite">Lưu</button>
					</div>
					</form>
					</div>
					</div>
				';	
				echo '
					<div class="card info-site">
						<div class="card-header text-info font-weight-bold">Thông tin</div>
						<div class="card-body">
							<form method="POST" id="formEditInfoSite">
								<div class="form-group">
									<label for="title_site">Tiêu đề trang web <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="title_site" value="'.$data_site['tieude_ws'].'" required="required">
								</div>
								<div class="form-group">
									<label for="descr_site">Mô tả trang web <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="descr_site" value="'.$data_site['mota_ws'].'" required="required">
								</div>
								<div class="form-group">
									<label for="kw_site">Từ khóa trang web</label>
									<input type="text" class="form-control" id="keywords_site" value="'.$data_site['keyword_ws'].'">
								</div>
								<div class="form-group">
									<p id="errEditInfoSite" class="text-danger d-none"><small><i></i></small></p>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-info mt-2" id="btnEditInfoSite">Lưu</button>
								</div>
							</form>
						</div>
					</div>
				';		
			}
			else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Không có dữ liệu</h4></div>';
		}
		else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Không đủ thẩm quyền</h4></div>';
	}
	else new Redirect($_DOMAIN);
?>