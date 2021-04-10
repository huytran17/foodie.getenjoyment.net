<?php
	if ($user) {
		$sql_get_all_sp = "SELECT id_sp, ten_sp FROM fd_sanpham";
		if ($db->db_num_rows($sql_get_all_sp)) {
			$select = '<div class="form-group">
							<lable>Chọn sản phẩm</label>
							<select class="custom-select" name="selectSp" id="selectSp">
					';
			foreach ($db->db_fetch_assoc($sql_get_all_sp, 0) as $key => $data_sp) {
				$select .= '<option value="'.$data_sp['id_sp'].'">'.$data_sp['ten_sp'].'</option>';
			}
			$select .= '</select></div>';
		}
		echo '
			<div class="container content">
				<h4 class="text-success font-weight-bold">Slider</h4>
				<div class="form-add-slider">
					<form method="POST" action="'.$_DOMAIN.'slider.php" enctype="multipart/form-data" id="formAddSlide" onsubmit="return false" class="formUpAvt">
							<div class="form-group box-pre-img d-none">
											<p><strong>Ảnh xem trước</strong></p>
										</div>
							<div class="form-group">
								<div class="custom-file w-25">
									<input type="file" class="custom-file-input inp_up_avt" id="inpAddSlide" name="inpAddSlide" onchange="preViewAvt()">
									<lable class="custom-file-label text-left" for="inpAddSlide" style="overflow: hidden;">Add new image</label>
								</div>
							</div>
							<div class="form-group">
									<lable for="titleSlide">Nhập tiêu đề</label>
									<input type="text" class="form-control" id="titleSlide" name="titleSlide">
								</div>
							<div class="form-group">
									<lable for="descrSlide">Nhập mô tả</label>
									<input type="text" class="form-control" id="descrSlide" name="descrSlide">
								</div>
							'.$select.'
							<div class="box-progress form-group d-none">
								<div class="progress">
									<div class="progress-bar" role="progressbar"></div>
								</div>
							</div>
							<div class="form-group">
								<p id="errUpSlide" class="text-danger d-none errf"><small><i></i></small></p>
							</div>
							<div class="form-group mx-auto d-sm-flex justify-content-sm-between">
								<button type="submit" class="btn btn-info btn-upSlide" id="btnUpSlide">Đồng ý</button>
							</div>
						</form>
				</div>
				<div class="list_slide w-100">
		';
		echo '</div></div>';
		echo '<div class="container content">';
		$sql_get_all_slide = $db->db_create_query('select', 'id_slider, url_thumb_slider', 'fd_slider');
		if ($db->db_num_rows($sql_get_all_slide)) {
			foreach ($db->db_fetch_assoc($sql_get_all_slide, 0) as $key => $data_slide) {
				echo '<div class="col-12 col-sm-4 col-md-3 d-inline-block p-2 position-relative slide-img">
						<img alt="slide" src="'.strstr($_DOMAIN, 'admin', 1) .$data_slide['url_thumb_slider'].'" di="'.$data_slide['id_slider'].'" style="width:100%; height:100%;">
						<span class="fa fa-times-circle span" style="font-size: 25px !important;"></span>
					</div>';
			}
		}
		else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Chưa có ảnh nào</h4></div>';
		echo '</div>';
	}
	else new Redirect($_DOMAIN);
?>