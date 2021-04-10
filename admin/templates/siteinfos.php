<?php
	if ($user) {
		$ac = empty($_GET['ac']) ? '' : trim(addslashes(htmlspecialchars($_GET['ac'])));
		if (isset($ac)) {
			if ($ac == 'add') {
				echo '<div class="container content">
						<h4 class="text-success font-weight-bold">Thêm thông tin trang web</h4>
						<a href="' . $_DOMAIN . 'site" class="btn btn-light">
			                        <span class="fa fa-arrow-left"></span> Trở về
			                    </a> 
			                    <div class="form-add-info">
			                    	<form method="POST" id="formAddSi" name="formAddSi" onsubmit="return false">
			                    		<div class="form-group">
			                    			<label>Tiêu đề</label>
			                    			<input type="text" name="titleAddSi" id="titleAddSi" class="form-control">
			                    		</div>
			                    		<div class="form-group">
			                    			<label>Mục cha</label>
			                    			<select class="custom-select" id="selAddPar">
			                    				<option value="0">Chọn đây là mục cha</option>
			    ';
			    $sql_get_par = "SELECT id_si, tieude_si FROM fd_siteinfo WHERE idcha_si=0";
			    if ($db->db_num_rows($sql_get_par)) {
			    	foreach ($db->db_fetch_assoc($sql_get_par, 0) as $key => $data_par) {
			    		echo '<option value="'.$data_par['id_si'].'">'.$data_par['tieude_si'].'</option>';
			    	}
			    }
			    else echo '</select></div>';
			    echo '</select></div>
						<div class="form-group">
							<label>Nội dung</label>
							<textarea id="ed_addNdSi" class="form-control" name="ed_addNdSi"></textarea>
						</div>
						<div class="form-group">
									<p id="errAddSi" class="text-danger d-none"><small><i></i></small></p>
								</div>
						<div class="form-group">
							<button type="button" class="btn btn-info" id="btnAddSi">Thêm</button>
						</div>
						</form></div></div>
			    ';

			}
			elseif ($ac == 'edit') {
				$id = empty($_GET['id']) ? '' : trim(addslashes(htmlspecialchars($_GET['id'])));
				$sql_get_si = "SELECT * FROM fd_siteinfo WHERE id_si='$id'";
				if ($db->db_num_rows($sql_get_si)) {
					$data_si = $db->db_fetch_assoc($sql_get_si, 1);
					
					echo '<div class="container content">
							<h4 class="text-success font-weight-bold">Chỉnh sửa thông tin trang web</h4>
						<a href="' . $_DOMAIN . 'site" class="btn btn-light">
			                        <span class="fa fa-arrow-left"></span> Trở về
			                    </a> 
			                   <div class="container content">
			                   		<div class="row img-food">
										<img src="'.strstr($_DOMAIN, 'admin', 1) . $data_si['url_thumb_si'].'" alt="'.$data_si['tieude_si'].'" width="200px" height="200px" class="mx-auto mt-5">
		                        </div>
								<div class="form-edit-info-thumb text-center">
									<form id="formEditInfoThumb" action="'.$_DOMAIN.'siteinfo.php" method="POST" enctype="multipart/form-data" onsubmit="return false" class="formUpAvt">
					            		<h6 class="mt-4">Chọn ảnh thumbnail</h6>
					            		<div class="form-group box-pre-img d-none">
											<p><strong>Ảnh xem trước</strong></p>
										</div>
										<div class="form-group">
											<div class="custom-file w-25">
											    <input type="file" class="custom-file-input inp_up_avt" id="inpEditInfoThumb" name="inpEditInfoThumb" onchange="preViewAvt()">
											    <label class="custom-file-label text-left" for="inpEditInfoThumb" style="overflow:hidden;">Choose an image</label>
											</div>
										</div>
										<div class="form-group">
											<p id="errEditInfoThumb" class="text-danger d-none errf"><small><i></i></small></p>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-info mt-3 btnEditInfoThumb" id="btnEditInfoThumb">Đồng ý</button>
										</div>
										<input type="text" value="'.$data_si['id_si'].'" class="d-none hidden-id" name="hiddenID">
										<div class="form-group box-progress-bar d-none">
											<div class="progress">
												<div class="progress-bar" role="progressbar"></div>
											</div>
										</div>
					            	</form>
								</div>
							</div>
			                <div class="form-edit-si">
			                	<form method="POST" name="formEditSi" id="formEditSi" onsubmit="return false">
			                	<span di="'.$id.'" class="d-none hidden-id"></span>
			                		<div class="form-group">
			                			<label>Tiêu đề</label>
			                			<input type="text" name="titleEditSi" id="titleEditSi" class="form-control" value="'.$data_si['tieude_si'].'">
			                		</div>
			                		<div class="form-group">
			                			<label>Mục cha</label>
			                			<select class="custom-select" id="selEditPar">
			                			<option value="0">Đây đã là mục cha</option>
			                			 
					';
					$sql_get_par = "SELECT id_si, tieude_si FROM fd_siteinfo WHERE idcha_si=0";
				    if ($db->db_num_rows($sql_get_par)) {
				    	foreach ($db->db_fetch_assoc($sql_get_par, 0) as $key => $data_par) {
				    		if ($data_par['id_si'] == $data_si['idcha_si']) {
				    			echo '<option value="'.$data_par['id_si'].'" selected="selected">'.$data_par['tieude_si'].'</option>';
				    		}
				    		else echo '<option value="'.$data_par['id_si'].'">'.$data_par['tieude_si'].'</option>';
				    	}
				    }
			    	else echo '</select></div>';
			    	echo '</select></div>
			    	<div class="form-group">
							<label>Nội dung</label>
							<textarea id="ed_editSi" class="form-control" name="ed_editSi">'.$data_si['noidung_si'].'</textarea>
						</div>
						<div class="form-group">
									<p id="errEditSi" class="text-danger d-none"><small><i></i></small></p>
								</div>
						<div class="form-group">
							<button type="button" class="btn btn-info" id="btnEditSi">Lưu</button>
						</div>
						</form></div></div>';

				}
			}
			else {//ko co ac
				echo '<div class="container content">
						<h4 class="text-success font-weight-bold">Thông tin trang web</h4>
						<a href="' . $_DOMAIN . 'site/add" class="btn btn-light">
			                        <span class="fa fa-plus"></span> Thêm
			                    </a> ';
			    echo '<div class="table-responsive" id="list_si" style="overflow:auto;">
                        <table class="table table-striped list" style="min-width:930px;">
                            <tr>
                                <td><strong>Tiêu đề</strong></td>
                                <td><strong>Mục cha</strong></td>
                                <td><strong>Tools</strong></td>
                            </tr>';
                $sql_get_all_si = "SELECT * FROM fd_siteinfo ORDER BY tieude_si";
			    if ($db->db_num_rows($sql_get_all_si)) {
			    	foreach ($db->db_fetch_assoc($sql_get_all_si, 0) as $key => $data_si) {
			    		$sql_get_name_par = "SELECT tieude_si FROM fd_siteinfo WHERE id_si='$data_si[idcha_si]'";
			    		if ($db->db_num_rows($sql_get_name_par)) {
			    			$name_par = $db->db_fetch_assoc($sql_get_name_par, 1)['tieude_si'];
			    		}
			    		else $name_par = '&nbsp;';
			    		echo '<tr><td>'.$data_si['tieude_si'].'</td>
							<td>'.$name_par.'</td>
							<td>
									<a href="'.$_DOMAIN.'site/edit/'.$data_si['id_si'].'" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
									<button type="button" class="btn btn-danger btn-sm del-si" di="'.$data_si['id_si'].'"><span class="fa fa-trash"></span></button>
								</td></tr>';
			    	}
			    }
			}
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>