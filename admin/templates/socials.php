<?php
	if ($user) {
		$ac = empty($_GET['ac']) ? '' : trim(addslashes(htmlspecialchars($_GET['ac'])));
		if ($ac) {
			if ($ac == 'add') {
				echo '<div class="container content">
						<h4 class="text-success font-weight-bold">Thêm phương tiện truyền thông</h4>
						<a href="' . $_DOMAIN . 'social" class="btn btn-light">
			                        <span class="fa fa-arrow-left"></span> Trở về
			                    </a> 
			                    <div class="form-add-info">
			                    	<form method="POST" id="formAddSm" name="formAddSm" onsubmit="return false">
			                    		<div class="form-group">
			                    			<label>Tiêu đề <span class="text-danger">*</span></label>
			                    			<input type="text" name="titleAddSm" id="titleAddSm" class="form-control" required="required">
			                    		</div>
			                    		<div class="form-group">
			                    			<label>Link</label>
			                    			<input type="text" name="linkAddSm" id="linkAddSm" class="form-control">
			                    		</div>
			                    		<div class="form-group">
			                    			<label>Icon</label>
			                    			<input type="text" name="iconAddSm" id="iconAddSm" class="form-control">
			                    		</div>
			                    		<div class="form-group">
											<p id="errAddSm" class="text-danger d-none"><small><i></i></small></p>
										</div>
			                    		<div class="form-group">
			                    			<button type="button" class="btn btn-info" id="btnAddSm">Thêm</button>
			                    		</div>
			                    	</form>
			                    </div>
			        </div>
			                    		
			    ';
			    
			}
			elseif ($ac == 'edit') {
				$id = empty($_GET['id']) ? '' : trim(addslashes(htmlspecialchars($_GET['id'])));
				$sql_get_sm = "SELECT * FROM fd_socialmedia WHERE id_sm = '$id'";
				if ($db->db_num_rows($sql_get_sm)) {
					$data_sm = $db->db_fetch_assoc($sql_get_sm, 1);
					echo '<div class="container content">
						<h4 class="text-success font-weight-bold">Thêm phương tiện truyền thông</h4>
						<a href="' . $_DOMAIN . 'social" class="btn btn-light">
			                        <span class="fa fa-arrow-left"></span> Trở về
			                    </a> 
			                    <div class="form-add-info">
			                    	<form method="POST" id="formAddSm" name="formAddSm" onsubmit="return false">
			                    		<div class="form-group">
			                    			<label>Tiêu đề <span class="text-danger">*</span></label>
			                    			<input type="text" name="titleEditSm" id="titleEditSm" class="form-control" required="required" value="'.$data_sm['tieude_sm'].'">
			                    		</div>
			                    		<div class="form-group">
			                    			<label>Link</label>
			                    			<input type="text" name="linkEditSm" id="linkEditSm" class="form-control" value="'.$data_sm['link_sm'].'">
			                    		</div>
			                    		<div class="form-group">
			                    			<label>Icon</label>
			                    			<input type="text" name="iconEditSm" id="iconEditSm" class="form-control" value="'.$data_sm['icon_sm'].'">
			                    		</div>
			                    		<div class="form-group">
											<p id="errEditSm" class="text-danger d-none"><small><i></i></small></p>
										</div>
			                    		<div class="form-group">
			                    			<button type="button" class="btn btn-info" id="btnEditSm" di="'.$id.'">Lưu</button>
			                    		</div>
			                    	</form>
			                    </div>
			        </div>
			                    		
			    ';
				}
				else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Không xác định</h4></div>';
			}
			else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Không xác định</h4></div>';
		}
		else {
				$sql_get_all_sm = "SELECT * FROM fd_socialmedia";
				if ($db->db_num_rows($sql_get_all_sm)) {
					echo
			            '<div class="container content">
			            <h4 class="text-success font-weight-bold">Cộng đồng</h4>
			                <a href="' . $_DOMAIN . 'social/add" class="btn btn-light">
			                    <span class="fa fa-plus"></span> Thêm
			                </a> 
			                <a href="' . $_DOMAIN . 'social" class="btn btn-light">
			                    <span class="fa fa-repeat"></span> Reload
			                </a> 
			            ';
			        echo
	                '
	                    <div class="table-responsive" id="list_sm" style="overflow:auto;">
	                        <table class="table table-striped list" style="min-width:930px;">
	                            <tr>
	                                <td><strong>Tiêu đề</strong></td>
	                                <td><strong>Link</strong></td>
	                                <td><strong>Icon</strong></td>
	                                <td><strong>Tools</strong></td>
	                            </tr>
	                ';
					foreach ($db->db_fetch_assoc($sql_get_all_sm, 0) as $key => $data_sm) {
						echo '
						<tr>
							<td><a href="'.$_DOMAIN.'social/edit/'.$data_sm['id_sm'].'">'.$data_sm['tieude_sm'].'</a></td>
							
							<td>'.$data_sm['link_sm'].'</td>
							<td>'.$data_sm['icon_sm'].'</td>
							
							<td>
									<a href="'.$_DOMAIN.'social/edit/'.$data_sm['id_sm'].'" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>
									<button type="button" class="btn btn-danger btn-sm del-sm" di="'.$data_sm['id_sm'].'"><span class="fa fa-trash"></span></button>
								</td>
						</tr>
	            	';
					}
					echo '</table></div></div>';
				}
				else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Không có dữ liệu</h4></div>';
			}
	}
	else new Redirect($_DOMAIN);
?>