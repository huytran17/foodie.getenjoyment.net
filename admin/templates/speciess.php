<?php
	if ($user) {
		$act = empty($_GET['ac']) ? '' : trim(addslashes(htmlspecialchars($_GET['ac'])));

		if ($act) {
			if ($act == 'add') {
				echo '
					<div class="container content">
						<h4 class="text-success font-weight-bold">Thêm chủng loại</h4>
						<a href="' . $_DOMAIN . 'species" class="btn btn-light">
			                        <span class="fa fa-arrow-left"></span> Trở về
			                    </a> 

						<div class="form-add-cate">
							<form method="POST" id="formAddCate" onsubmit="return false">
								<div class="form-group">
									<label for="nameAddCate">Tên gọi <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="nameAddCate" id="nameAddCate" required="required">
								</div>
								<div class="form-group">
									<p id="errAddCate" class="text-danger d-none"><small><i></i></small></p>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-info btn-addCate" id="btnAddCate">Thêm</button> 
								</div>
							</form>
						</div>
					</div>
				';
			}
			elseif ($act == 'edit') {
				$id = empty($_GET['id']) ? '' : trim(addslashes(htmlspecialchars($_GET['id'])));
				$sql_get_current_cate = $db->db_create_query('select', '*', 'fd_chungloai', array('id_chl'=>$id));
				$data_cate = $db->db_fetch_assoc($sql_get_current_cate, 1);
				$check0 = $data_cate['trangthai_chl']==0 ? 'selected=selected' : '';
				$check1 = $data_cate['trangthai_chl']==1 ? 'selected=selected' : '';
				if ($id) {
					echo '
						<div class="container content">
							<h4 class="text-success font-weight-bold">Chỉnh sửa chủng loại</h4>
							<a href="' . $_DOMAIN . 'species" class="btn btn-light">
				                        <span class="fa fa-arrow-left"></span> Trở về
				                    </a> 
				            <div class="currentThumbCate text-center">
								<p><strong>Thumbnail hiện tại</strong></p>
					            <img src="'.strstr($_DOMAIN, 'admin', TRUE) .$data_cate['url_thumb_chl'].'" alt="img" width="200px" height="200px">
					            </div>
							<div class="form-add-cate-thumb text-center">
									<form id="formAddCateThumb" action="'.$_DOMAIN.'species.php" method="POST" enctype="multipart/form-data" onsubmit="return false" class="formUpAvt">
					            		<h6 class="mt-4">Chọn ảnh thumbnail</h6>
					            		<div class="form-group box-pre-img d-none">
											<p><strong>Ảnh xem trước</strong></p>
										</div>
										<div class="form-group">
											<div class="custom-file w-25">
											    <input type="file" class="custom-file-input inp_up_avt" id="inpAddThumbCate" name="inpAddThumbCate" onchange="preViewAvt()">
											    <label class="custom-file-label text-left" for="inpAddThumbCate" style="overflow:hidden;">Choose an image</label>
											</div>
										</div>
										<div class="form-group">
											<p id="errAddThumbCate" class="text-danger d-none errf"><small><i></i></small></p>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-info mt-3 btnAddThumbCate" id="btnAddThumbCate">Đồng ý</button>
										</div>
										<input type="text" value="'.$data_cate['id_chl'].'" class="d-none hidden-id" name="hiddenID">
										<div class="form-group box-progress-bar d-none">
											<div class="progress">
												<div class="progress-bar" role="progressbar"></div>
											</div>
										</div>
					            	</form>
								</div>
		                    <div class="form-edit-cate">
								<form method="POST" id="formEditCate" onsubmit="return false">
									<div class="form-group">
										<label for="nameEditCate">Tên gọi <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="nameEditCate" id="nameEditCate" value="'.$data_cate['ten_chl'].'" required="required">
									</div>
									<div class="form-group">
										<label for="">Mô tả</label>
										<textarea type="text" class="form-control" name="descrEditCate" id="ed_descrEditCate">'.$data_cate['mota_chl'].'</textarea>
									</div>
									<div class="form-group">
										<label>Trạng thái</label>
										<select name="editStt" class="custom-select" id="editSttCate">
										    <option value="0" '.$check0.'>Ẩn</option>
										    <option value="1" '.$check1.'>Hiện</option>
										</select>
									</div>
									<div class="form-group">
										<p id="errEditCate" class="text-danger d-none"><small><i></i></small></p>
									</div>
									<span data-id="'.$data_cate['id_chl'].'" class="d-none hidden-id"></span>
									<div class="form-group">
										<button type="button" class="btn btn-info btn-editCate" id="btnEditCate">Cập nhật</button> 
									</div>
								</form>
		                    </div>
						</div>
					';
				}
				else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Không có mục nào được chọn</h4></div>';
			}
			else new Redirect($_DOMAIN);
		}
		//không có act
		else {
	        $sql_get_all_cate = $db->db_create_query('select', '*', 'fd_chungloai');

	        $current_page = empty($_GET['page']) ? '' : trim(addslashes(htmlspecialchars($_GET['page'])));
			//reset page
			if ($current_page == '') {
				$current_page = 1;
			}
			$limit = 10;
			$start = ($current_page - 1) * $limit;

			$sql_get_all_limit_cate = $db->db_create_query('select', '*', 'fd_chungloai', array(), 'ORDER BY id_chl DESC LIMIT '.$start.', '.$limit.'');

	        if ($db->db_num_rows($sql_get_all_limit_cate)) {
	        	echo '<div class="container content">
	        			<h4 class="text-success font-weight-bold">Chủng loại món ăn</h4>
						<a href="'.$_DOMAIN.'species/add" class="btn btn-light">
								<span class="fa fa-plus"></span> Thêm
							</a>
							<a href="'.$_DOMAIN.'species" class="btn btn-light">
								<span class="fa fa-repeat"></span> Tải lại
							</a>
							<button class="btn btn-danger" id="del_cate_list">
			                    <span class="fa fa-trash"></span> Xoá
			                </button> ';
	        	echo '
					<div class="table-responsive list-cate" style="overflow:auto;">
						<table class="table table-striped text-center list" id="list_cate" style="min-width:930px;">
									<thead>
										<td><input type="checkbox"</td>
										<td><strong>Tên gọi</strong></td>
										<td><strong>Mô tả</strong></th>
										<td><strong>Trạng thái</strong></td>
										<td><strong>Tools</strong></td>
									</thead>
									<tbody>
		        ';	
		        foreach ($db->db_fetch_assoc($sql_get_all_limit_cate, 0) as $key => $data_cate) {
		        	$label_stt = $data_cate['trangthai_chl']==0 ? '<span class="badge badge-danger">Ẩn</span>' : '<span class="badge badge-info">Hiện</span>';
		        	echo '
						<tr>
							<td><input type="checkbox" name="id_cate[]" value="'.$data_cate['id_chl'].'"></td>
							<td><a href="'.$_DOMAIN.'species/edit/'.$data_cate['id_chl'].'">'.$data_cate['ten_chl'].'</a></td>
							<td>'.html_entity_decode($data_cate['mota_chl']).'</td>
							<td>'.$label_stt.'</td>
							<td>
								<a href="'.$_DOMAIN.'species/edit/'.$data_cate['id_chl'].'" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
								<button type="button" class="btn btn-danger btn-sm del-cate" data-id="'.$data_cate['id_chl'].'"><span class="fa fa-trash"></span></button>
							</td>

						</tr>
		        	';
		        }
		        echo '</tbody></table></div>';
		        $config = array(
		        	'current_page' => $current_page,
		        	'total_record' => $db->db_num_rows($sql_get_all_cate),
		        	'limit' => $limit,
		        	'link_first' => $_DOMAIN .'species',
		        	'link_full' => $_DOMAIN .'species&page={page}',
		        	'range' => 10
		        );
		        $paging = new Pagination();
		        $paging->init($config);
		        echo $paging->html();
		        echo '</div>';
	        }
	        else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Danh sách trống</h4></div>';
		}
	}
	else new Redirect($_DOMAIN);
?>