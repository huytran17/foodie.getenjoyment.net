<?php
	if ($user) {
		$ac = empty($_GET['ac']) ? '' : trim(addslashes(htmlspecialchars($_GET['ac'])));

		if ($ac) {
			if ($ac == 'add') {
				
				$select_chl = '<label for="addChlFood">Chủng loại</label><select class="custom-select" name="addChlFood" id="addChlFood" required="required">';

				$sql_get_all_chl = $db->db_create_query('select', 'id_chl, ten_chl', 'fd_chungloai');

				
				if ($db->db_num_rows($sql_get_all_chl)) {
					foreach ($db->db_fetch_assoc($sql_get_all_chl, 0) as $key => $data_chl) {
						$select_chl .= '<option value="'.$data_chl['id_chl'].'">'.$data_chl['ten_chl'].'';
					}
				}
				$select_chl .= '</select>';
				echo '
					<div class="container content">
						<h4 class="text-success font-weight-bold">Thêm vào thực đơn</h4>
						<a href="' . $_DOMAIN . 'foods" class="btn btn-light">
			                        <span class="fa fa-arrow-left"></span> Trở về
			                    </a> 
			            <div class="form-add-food">
			       
							<form id="formAddFood" onsubmit="return false">
								<div class="form-group">
									<label for="nameAddFood">Tên món <span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="nameAddFood" id="nameAddFood" required="required">
								</div>
								
								
								<div class="form-group">
									<label for="amountAddFood">Số lượng cung cấp</label>
									<input type="number" min=0 class="form-control" name="amountAddFood" id="amountAddFood">
								</div>
								
								<div class="form-group">
									'.$select_chl.'
								</div>
								
								<div class="form-group">
									<p id="errAddFood" class="text-danger d-none"><small><i></i></small></p>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-info btn-addFood" id="btnAddFood">Thêm</button>
								</div>
							</form>
			            </div>
					</div>
				';
			}
			elseif ($ac == 'edit') {
				$id = empty($_GET['id']) ? '' : trim(addslashes(htmlspecialchars($_GET['id'])));
				if ($id) {
					echo '
						<div class="container content">
							<h4 class="text-success font-weight-bold">Chỉnh sửa thông tin món ăn</h4>
							<a href="' . $_DOMAIN . 'foods" class="btn btn-light">
				                        <span class="fa fa-arrow-left"></span> Trở về
				                    </a> 
				             
					';
					$sql_get_food = $db->db_create_query('select', 'id_sp, id_chl, ten_sp, mota_sp, chitiet_sp, giagoc_sp, giamgia_sp, giamoi_sp, url_thumb_sp, tonkho_sp, ghichu_sp, trangthai_sp, nutri_sp, url_avt_sp, tukhoa_sp', 'fd_sanpham', array('id_sp'=>$id));
					if ($db->db_num_rows($sql_get_food)) {
						$data_food = $db->db_fetch_assoc($sql_get_food, 1);
						$data_nutri = json_decode($data_food['nutri_sp'], 1);
						echo '
						<div class="row img-food">
								<img src="'.strstr($_DOMAIN, 'admin', 1) . $data_food['url_thumb_sp'].'" alt="'.$data_food['ten_sp'].'" width="200px" height="200px" class="mx-auto mt-5">
                        </div>
						<div class="form-edit-food-thumb text-center">
							<form id="formEditFoodThumb" action="'.$_DOMAIN.'foods.php" method="POST" enctype="multipart/form-data" onsubmit="return false" class="formUpAvt">
			            		<h6 class="mt-4">Chọn ảnh thumbnail</h6>
			            		<div class="form-group box-pre-img d-none">
									<p><strong>Ảnh xem trước</strong></p>
								</div>
								<div class="form-group">
									<div class="custom-file w-25">
									    <input type="file" class="custom-file-input inp_up_avt" id="inpEditThumbFood" name="inpEditThumbFood" onchange="preViewAvt()">
									    <label class="custom-file-label text-left" for="inpEditThumbFood" style="overflow:hidden;">Choose an image</label>
									</div>
								</div>
								<div class="form-group">
									<p id="errEditThumbFood" class="text-danger d-none errf"><small><i></i></small></p>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info mt-3 btnAddThumbFood" id="btnAddThumbFood">Đồng ý</button>
								</div>
								<input type="text" value="'.$data_food['id_sp'].'" class="d-none hidden-id" name="hiddenID">
								<div class="form-group box-progress-bar d-none">
									<div class="progress">
										<div class="progress-bar" role="progressbar"></div>
									</div>
								</div>
			            	</form>
						</div>
						<div class="row avt-food">
								<img src="'.strstr($_DOMAIN, 'admin', 1) . $data_food['url_avt_sp'].'" alt="'.$data_food['ten_sp'].'" width="400px" height="200px" class="mx-auto mt-5">
                        </div>
						<div class="form-edit-food-avt text-center">
							<form id="formEditFoodAvt" action="'.$_DOMAIN.'foods.php" method="POST" enctype="multipart/form-data" onsubmit="return false">
			            		<h6 class="mt-4">Chọn ảnh đại diện</h6>
			            		<div class="form-group box-pre-img d-none">
									<p><strong>Ảnh xem trước</strong></p>
								</div>
								<div class="form-group">
									<div class="custom-file w-25">
									    <input type="file" class="custom-file-input inp_up_avt" id="inpEditFoodAvt" name="inpEditFoodAvt" onchange="preViewAvtS()">
									    <label class="custom-file-label text-left" for="inpEditFoodAvt" style="overflow:hidden;">Choose an image</label>
									</div>
								</div>
								<div class="form-group">
									<p id="errEditFoodAvt" class="text-danger d-none errf"><small><i></i></small></p>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info mt-3 btnEditFoodAvt" id="btnEditFoodAvt">Đồng ý</button>
								</div>
								<input type="text" value="'.$data_food['id_sp'].'" class="d-none hidden-id" name="hiddenID">
								<div class="form-group box-progress-bar d-none">
									<div class="progress">
										<div class="progress-bar" role="progressbar"></div>
									</div>
								</div>
			            	</form>
						</div>
			            	<hr class="w-50">
                            <form id="formEditFood" onsubmit="return false">
                            	<div class="form-group">
									<label for="nameEditFood">Tên món ăn <span class="text-danger">*</span></label>
									<input type="text" name="nameEditFood" class="form-control" id="nameEditFood" value="'.$data_food['ten_sp'].'" required="required">
								</div>';

						
						//select chl
						$sql_get_all_chl = $db->db_create_query('select', 'id_chl, ten_chl', 'fd_chungloai');
						echo '<div class="form-group">
							<label for="boxChl">Chủng loại</label>
								<select class="custom-select" id="boxChl">
						';
						foreach ($db->db_fetch_assoc($sql_get_all_chl, 0) as $key => $data_chl) {
							if ($data_chl['id_chl'] == $data_food['id_chl']) {
								echo '<option value="'.$data_chl['id_chl'].'" selected="selected">'.$data_chl['ten_chl'].'</option>';
							}
							else echo '<option value="'.$data_chl['id_chl'].'">'.$data_chl['ten_chl'].'</option>';
						}
						echo '</select></div>';

						echo '
							<div class="form-group">
								<label for="keyEditFood">Từ khóa</label>
								<input type="text" name="keyEditFood" class="form-control" id="keyEditFood" value="'.$data_food['tukhoa_sp'].'">
							</div>
							<div class="form-group">
								<label for="descrEditFood">Mô tả ngắn</label>
								<input type="text" name="descrEditFood" class="form-control" id="descrEditFood" value="'.$data_food['mota_sp'].'">
							</div>
							<div class="form-group">
								<label for="">Mô tả chi tiết</label>
								<textarea name="detailEditFood" class="form-control" id="ed_detailEditFood">'.$data_food['chitiet_sp'].'</textarea>
							</div>
							<div class="form-group">
								<label for="priceEditFood">Giá gốc <span class="text-danger">*</span></label>
								<input type="number" min=0 name="priceEditFood" class="form-control" id="priceEditFood" value="'.$data_food['giagoc_sp'].'" required="required">
								<p id="errPriceEditFood" class="text-danger d-none"><small><i></i></small></p>
							</div>
							<div class="form-group">
								<label for="saleEditFood">Giảm giá (%)</label>
								<input type="number" min=0 max=100 name="saleEditFood" class="form-control" id="saleEditFood" value="'.$data_food['giamgia_sp'].'">
								<p id="errSaleEditFood" class="text-danger d-none"><small><i></i></small></p>
							</div>
							<div class="form-group">
								<label for="newPriceEditFood">Giá mới</label>
								<input type="number" min=0 name="newPriceEditFood" class="form-control" id="newPriceEditFood" value="'.$data_food['giamoi_sp'].'" disabled="disabled">
							</div>
							
							<div class="form-group">
								<label for="calEditFood">Hàm lượng calo (g)</label>
								<input type="number" min=0 name="calEditFood" class="form-control" id="calEditFood" value="'.$data_nutri['calo'].'">
							</div>
							<div class="form-group">
								<label for="fatEditFood">Hàm lượng chất béo (g)</label>
								<input type="number" min=0 name="fatEditFood" class="form-control" id="fatEditFood" value="'.$data_nutri['fat'].'">
							</div>
							<div class="form-group">
								<label for="proteinEditFood">Hàm lượng chất đạm (g)</label>
								<input type="number" min=0 name="proteinEditFood" class="form-control" id="proteinEditFood" value="'.$data_nutri['protein'].'">
							</div>
							<div class="form-group">
								<label for="satFatEditFood">Chất béo bão hòa (g)</label>
								<input type="number" min=0 name="satFatEditFood" class="form-control" id="satFatEditFood" value="'.$data_nutri['satfat'].'">
							</div>
							<div class="form-group">
								<label for="dieFibEditFood">Chất xơ (g)</label>
								<input type="number" min=0 name="dieFibEditFood" class="form-control" id="dieFibEditFood" value="'.$data_nutri['diefib'].'">
							</div>
							<div class="form-group">
								<label for="canxiEditFood">Canxi (g)</label>
								<input type="number" min=0 name="canxiEditFood" class="form-control" id="canxiEditFood" value="'.$data_nutri['canxi'].'">
							</div>
							<div class="form-group">
								<label for="sugarEditFood">Đường (g)</label>
								<input type="number" min=0 name="sugarEditFood" class="form-control" id="sugarEditFood" value="'.$data_nutri['sugar'].'">
							</div>
							<div class="form-group">
								<label for="ironEditFood">Sắt (g)</label>
								<input type="number" min=0 name="ironEditFood" class="form-control" id="ironEditFood" value="'.$data_nutri['iron'].'">
							</div>
							<div class="form-group">
								<label for="chlesEditFood">Cholesteron (g)</label>
								<input type="number" min=0 name="chlesEditFood" class="form-control" id="chlesEditFood" value="'.$data_nutri['chles'].'">
							</div>
							<div class="form-group">
								<label for="vitDEditFood">Vitamin D (g)</label>
								<input type="number" min=0 name="vitDEditFood" class="form-control" id="vitDEditFood" value="'.$data_nutri['vitD'].'">
							</div>
							<div class="form-group">
								<label for="">Ghi chú</label>
								<textarea name="noteEditFood" class="form-control" id="ed_noteEditFood">'.$data_food['ghichu_sp'].'</textarea>
							</div>
						';
						echo '<div class="form-group"><label>Trạng thái</label>';
						//nếu đang xuất bản
						if ($data_food['trangthai_sp'] == 1) {
                            echo '
                                <div class="radio">
                                        <input type="radio" name="stt_edit_food" value="1" checked> Xuất bản
                                </div>
                                <div class="radio">
                                        <input type="radio" name="stt_edit_food" value="0"> Ẩn
                                </div>
                            ';
                        echo '</div>';
                        // Nếu đang ẩn
                        } else if ($data_food['trangthai_sp'] == 0) {
                            echo '
                                <div class="radio form-group">
                                    <label>
                                        <input type="radio" name="stt_edit_food" value="1"> Xuất bản
                                    </label>
                                </div>
                                <div class="radio form-group">
                                    <label>
                                        <input type="radio" name="stt_edit_food" value="0" checked> Ẩn
                                    </label>
                                </div>
                            ';
                        }
                    echo '
                    	<div class="form-group">
									<p id="errEditFood" class="text-danger d-none"><small><i></i></small></p>
								</div>
						<span data-id="'.$data_food['id_sp'].'" class="d-none hidden-id"></span>
                    	<div class="form-group">
								<button type="button" class="btn btn-info btn-editFood" id="btnEditFood">Đồng ý</button> 
							</div>
						</form></div>
                    ';
					}
					else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Món ăn không tồn tại</h4></div>';
				}
				else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Không tìm thấy tác vụ</h4></div>';
			}
			else new Redirect($_DOMAIN);
		}
		//không có ac
		else {
			$sql_get_all_food = $db->db_create_query('select', 'id_sp', 'fd_sanpham');
			//phân trang
			$current_page = empty($_GET['page']) ? '' : trim(addslashes(htmlspecialchars($_GET['page'])));
			//reset page
			if (empty($current_page)) {
				$current_page = 1;
			}
			$limit = 10;
			$start = ($current_page - 1) * $limit;
			
	   		$sql_get_all_limit_food = $db->db_create_query('select', 'id_sp, id_chl, ten_sp, giamoi_sp, ngaydang_sp, solanmua_sp, trangthai_sp', 'fd_sanpham', array(), 'LIMIT '.$start.', '.$limit.' ');

            if ($db->db_num_rows($sql_get_all_limit_food)) {
            	echo
	            '<div class="container content">
	            <h4 class="text-success font-weight-bold">Thực đơn</h4>
	                <a href="' . $_DOMAIN . 'foods/add" class="btn btn-light">
	                    <span class="fa fa-plus"></span> Thêm
	                </a> 
	                <a href="' . $_DOMAIN . 'foods" class="btn btn-light">
	                    <span class="fa fa-repeat"></span> Reload
	                </a> 
	                <button class="btn btn-danger" id="del_food_list">
	                    <span class="fa fa-trash"></span> Xoá
	                </button> 
	                <select id="sp_filter">
						<option value="0" selected="selected">None</option>
						<option value="1">A-Z</option>
						<option value="2">Đã bán</option>
						<option value="3">Giá bán</option>
	                </select>
	            ';
            	echo
                '
                    <div class="table-responsive" id="list_food" style="overflow:auto;">
                        <table class="table table-striped list" style="min-width:930px;">
                        	<thead>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><strong>Tên món</strong></td>
                                <td><strong>Chủng loại</strong></td>
                                <td><strong>Giá hiện tại</strong></td>
                                <td><strong>Ngày đăng</strong></td>
                                <td><strong>Đã bán</strong></td>
                                <td><strong>Trạng thái</strong></td>
                                <td><strong>Tools</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                ';
            	foreach ($db->db_fetch_assoc($sql_get_all_limit_food, 0) as $key => $data_food) {
	            	
	            	$sql_get_ten_chl = $db->db_create_query('select', 'ten_chl', 'fd_chungloai', array('id_chl'=>$data_food['id_chl']));
	            	$stt_food = $data_food['trangthai_sp']==0 ? '<span class="badge badge-danger">Ẩn</span>' : '<span class="badge badge-info">Hiện</span>';
	            	echo '
						<tr>
							<td><input type="checkbox" name="id_cate[]" value="'.$data_food['id_sp'].'"></td>
							<td><a href="'.$_DOMAIN.'foods/edit/'.$data_food['id_sp'].'">'.$data_food['ten_sp'].'</a></td>
							<td>'.$db->db_fetch_assoc($sql_get_ten_chl, 1)['ten_chl'].'</td>
							<td>'.number_format($data_food['giamoi_sp'], 0, '', ',').'</td>
							<td>'.$data_food['ngaydang_sp'].'</td>
							<td>'.$data_food['solanmua_sp'].'</td>
							<td>'.$stt_food.'</td>
							<td>
									<a href="'.$_DOMAIN.'foods/edit/'.$data_food['id_sp'].'" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
									<button type="button" class="btn btn-danger btn-sm del-food" data-id="'.$data_food['id_sp'].'"><span class="fa fa-trash"></span></button>
								</td>
						</tr>
	            	';
	            }
	            echo '</tbody></table></div>';
	            //nút
	            $config = array(
	            	'current_page' => $current_page,
	            	'total_record' => $db->db_num_rows($sql_get_all_food),
	            	'limit' => $limit,
	            	'link_first' => $_DOMAIN .'foods',
	            	'link_full' => $_DOMAIN .'foods&page={page}',
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