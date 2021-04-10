<?php
	if ($user) {
		if (!empty($data_user['url_avt_ad'])) {
			$url_avt_ad = $data_user['url_avt_ad'];
		}
		else $url_avt_ad = $_DOMAIN .'public/default_avt/avt.jpg';
		//avt
		echo '
			<div class="container content">
				<h4 class="text-success font-weight-bold">Thông tin cá nhân</h4>
				<div class="card mb-5 card-avt-prf">
					<div class="card-header font-weight-bold text-center">Ảnh đại diện</div>
					<img src="'.$url_avt_ad.'" alt="img" width="200px" height="200px" class="mx-auto mt-4">
					<div class="card-body text-center">
						<h4 class="card-title">Cập nhật ảnh đại diện</h4>
						<form method="POST" action="'.$_DOMAIN.'profile.php" enctype="multipart/form-data" id="formUpAvt" onsubmit="return false" class="formUpAvt">
							<div class="form-group box-pre-img d-none">
											<p><strong>Ảnh xem trước</strong></p>
										</div>
							<div class="form-group">
								<div class="custom-file w-25">
									<input type="file" class="custom-file-input inp_up_avt" id="inpUpAvt" name="inpUpAvt" onchange="preViewAvt()">
									<lable class="custom-file-label text-left" for="inpUpAvt" style="overflow: hidden;">Choose an image</label>
								</div>
							</div>
							<div class="box-progress form-group d-none">
								<div class="progress">
									<div class="progress-bar" role="progressbar"></div>
								</div>
							</div>
							<div class="form-group">
								<p id="errUpAvt" class="text-danger d-none errf"><small><i></i></small></p>
							</div>
							<div class="form-group mx-auto d-sm-flex justify-content-sm-between">
								<button type="submit" class="btn btn-info btn-upAvt" id="btnUpAvt">Đồng ý</button>
								<button type="button" class="btn btn-danger" id="btnDelAvt">Xóa</button>
							</div>
						</form>
					</div>
				</div>
				<hr class="w-50">
			
		';
		//info
		echo '
			<div class="card mb-5 card-info-prf">
				<div class="card-header font-weight-bold text-center">Thông tin cá nhân</div>
				<div class="card-body">
					<h4 class="card-title text-center">Cập nhật thông tin cá nhân</h4>
					<form method="POST" id="formUpInfo" onsubmit="return false">
						<div class="form-group">
							<label for="inpUpDname">Tên hiển thị <span class="text-danger">*</span></label>
							<input type="text" class="form-control" id="inpUpDname" value="'.$data_user['displayname_ad'].'" required="required">
						</div>
						<div class="form-group">
							<label for="inpUpAdd">Địa chỉ</label>
							<input type="address" class="form-control" id="inpUpAdd" value="'.$data_user['diachi_ad'].'">
						</div>
						<div class="form-group">
							<label for="inpUpSdt">Số điện thoại</label>
							<input type="tel" class="form-control" id="inpUpSdt" value="'.$data_user['sdt_ad'].'">
						</div>
						<div class="form-group">
							<label for="inpUpEmail">E-mail</label>
							<input type="text" class="form-control" id="inpUpEmail" value="'.$data_user['email_ad'].'">
						</div>
						<div class="form-group">
							<p id="errUpInfo" class="text-danger d-none"><small><i></i></small></p>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-info btn-upInfo" id="btnUpInfo">Cập nhật</button> 
						</div>
					</form>
				</div>
			</div>
			<hr class="w-50">
		';
		//secure
		echo '
			<div class="card card-secure-prf">
				<div class="card-header font-weight-bold text-center">Bảo mật</div>
				<div class="card-body">
					<h4 class="card-title text-center">Cập nhật bảo mật</h4>
					<form method="POST" id="formUpSecure" onsubmit="return false">
						<div class="form-group">
							<label for="oldPass">Mật khẩu cũ <span class="text-danger">*</span></label>
							<input type="text" id="oldPass" class="form-control" required="required">
						</div>
						<div class="form-group">
							<label for="newPass">Mật khẩu mới <span class="text-danger">*</span></label>
							<input type="text" id="newPass" class="form-control" required="required">
						</div>
						<div class="form-group">
							<label for="renewPass">Nhập lại mật khẩu mới <span class="text-danger">*</span></label>
							<input type="text" id="renewPass" class="form-control" required="required">
						</div>
						<div class="form-group">
							<p id="errUpSecure" class="text-danger d-none"><small><i></i></small></p>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-info btn-upSecure" id="btnUpSecure">Đồng ý</button> 
						</div>
					</form>
				</div>
			</div>
		';
		echo '</div>';
	}
	else new Redirect($_DOMAIN);
?>