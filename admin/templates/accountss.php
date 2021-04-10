<?php
	if ($user) {
		if ($data_user['vitri_ad'] == 1) {
			$ac = empty($_GET['ac']) ? '' : trim(addslashes(htmlspecialchars($_GET['ac'])));
			if ($ac) {
				if ($ac == 'add') {
					echo '
						<div class="container content">
							<h4 class="text-success font-weight-bold">Thêm quản trị viên</h4>
							<a href="'.$_DOMAIN.'accounts" class="btn btn-light">
								<span class="fa fa-arrow-left mr-1"></span> Trở về
							</a>';
					echo '
						<div class="form-add-acc">
							<form id="formAddAcc" onsubmit="return false" name="formAddAcc">
								<div class="form-group">
									<label for="nameAddAdd">Tên đăng nhập <span class="text-danger">*</span></label>
									<input type="text" name="nameAddAcc" class="form-control" id="nameAddAcc" required="required">
								</div>
								<div class="form-group">
									<label for="dNameAddAdd">Tên hiển thị <span class="text-danger">*</span></label>
									<input type="text" name="dNameAddAcc" class="form-control" id="dNameAddAcc" required="required">
								</div>
								<div class="form-group">
									<label for="passAddAcc">Mật khẩu <span class="text-danger">*</span></label>
									<input type="text" name="passAddAcc" class="form-control" id="passAddAcc" required="required">
								</div>
								<div class="form-group">
									<label for="rePassAddAcc">Nhập lại mật khẩu <span class="text-danger">*</span></label>
									<input type="text" name="rePassAddAcc" class="form-control" id="rePassAddAcc" required="required">
								</div>
								<div class="form-group">
									<p id="errAddAcc" class="text-danger d-none errf"><small><i></i></small></p>
								</div>
								<div class="form-group">
									<button type="button" class="btn btn-info btn-addAcc" id="btnAddAcc">Đồng ý</button>
								</div>
							</form>
						</div>
					';
				}
				else {
					echo '<div class="container content"><h4 class="text-warning font-weight-bold">Hành động không xác định</h4></div>';
				}
			}
			else {

					$sql_get_all_acc = $db->db_create_query('select', 'id_ad, username_ad, displayname_ad, diachi_ad, sdt_ad, email_ad, vitri_ad, trangthai_ad', 'fd_admin');

					$current_page = empty($_GET['page']) ? '' : trim(addslashes(htmlspecialchars($_GET['page'])));
					//reset page
					if ($current_page == '') {
						$current_page = 1;
					}
					$limit = 10;
					$start = ($current_page - 1) * $limit;
			
					$sql_get_all_limit_acc = $db->db_create_query('select', 'id_ad, username_ad, displayname_ad, diachi_ad, sdt_ad, email_ad, vitri_ad, trangthai_ad', 'fd_admin', array(), 'LIMIT '.$start.', '.$limit.'');

					if ($db->db_num_rows($sql_get_all_limit_acc)) {
						echo '
							<div class="container content">
							<h4 class="text-success font-weight-bold">Quản trị viên</h4>
								<a href="'.$_DOMAIN.'accounts/add" class="btn btn-light">
									<span class="fa fa-plus mr-1"></span> Thêm
								</a>
								<a href="'.$_DOMAIN.'accounts" class="btn btn-light">
									<span class="fa fa-repeat mr-1"></span> Tải lại
								</a>
								<button id="upgrade_acc_list" class="btn btn-primary">
									<span class="fa fa-angle-double-up mr-1"></span> Nâng cấp
								</button>
								<button id="downgrade_acc_list" class="btn btn-info">
									<span class="fa fa-angle-double-down mr-1"></span> Hạ cấp
								</button>
								<button id="lock_acc_list" class="btn btn-warning">
									<span class="fa fa-lock mr-1"></span> Khóa
								</button>
								<button id="unlock_acc_list" class="btn btn-success">
									<span class="fa fa-unlock mr-1"></span> Mở khóa
								</button>
								';
						echo '
							<div class="table-list-acc table-responsive mt-4" style="overflow:auto;">
								<table class="table table-striped list" id="list_acc" style="min-width:930px;">
									<thead>
										<th><input type="checkbox"></th>
										<th>Tên đăng nhập</th>
										<th>Tên hiển thị</th>
										<th>Cấp bậc</th>
										<th>Phone</th>
										<th>Email</th>
										<th>Address</th>
										<th>Trạng thái</th>
										<th>Tools</th>
									</thead>
									<tbody>
						';
						foreach ($db->db_fetch_assoc($sql_get_all_limit_acc, 0) as $key => $data_acc) {
							$level_acc = $data_acc['vitri_ad']==1 ? '<span class="badge badge-primary">Admin</span>' : ($data_acc['vitri_ad']==2 ? '<span class="badge badge-info">Nhân viên</span>' : '<span class="badge badge-success">Dịch vụ</span>');
							$stt_acc = $data_acc['trangthai_ad']==0 ? '<span class="badge badge-danger">Locked</span>' : '<span class="badge badge-info">Activated</span>';
							echo '
								<tr>
									';
							if ($data_acc['id_ad'] != $data_user['id_ad']) {
								echo '<td><input type="checkbox" name="id_cate[]" value="'.$data_acc['id_ad'].'"></td>';
							}
							else echo '<td>&nbsp;</td>';
							echo '
									<td>'.$data_acc['username_ad'].'</td>
									<td>'.$data_acc['displayname_ad'].'</td>
									<td>'.$level_acc.'</td>
									<td>'.$data_acc['sdt_ad'].'</td>
									<td>'.$data_acc['email_ad'].'</td>
									<td>'.$data_acc['diachi_ad'].'</td>
									<td>'.$stt_acc.'</td>
							';
							if ($data_acc['id_ad'] != $data_user['id_ad']) {
								echo '<td>
										<button type="button" class="btn btn-primary btn-sm upgrade-acc" data-id="'.$data_acc['id_ad'].'"><span class="fa fa-angle-double-up"></span></button>
										<button type="button" class="btn btn-info btn-sm downgrade-acc" data-id="'.$data_acc['id_ad'].'"><span class="fa fa-angle-double-down"></span></button>
										<button type="button" class="btn btn-warning btn-sm lock-acc" data-id="'.$data_acc['id_ad'].'"><span class="fa fa-lock"></span></button>
										<button type="button" class="btn btn-success btn-sm unlock-acc" data-id="'.$data_acc['id_ad'].'"><span class="fa fa-unlock"></span></button>
									</td>
								</tr>';
							}
							else echo '<td>&nbsp;</td></tr>';
						}
						echo '</tbody></table></div>';
						//nút
						$config = array(
							'current_page' => $current_page,
							'total_record' => $db->db_num_rows($sql_get_all_acc),
							'limit' => $limit,
							'link_first' => $_DOMAIN .'accounts',
							'link_full' => $_DOMAIN .'accounts&page={page}',
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
		else echo '<div class="container content"><h4 class="text-warning font-weight-bold">Không đủ thẩm quyền</h4></div>';
	}
	else new Redirect($_DOMAIN);
?>
