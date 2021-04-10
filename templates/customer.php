<?php
	if ($user) {
		$slug_kh = empty($_GET['slug_cus']) ? '' : trim(addslashes(htmlspecialchars($_GET['slug_cus'])));
		$id_kh = empty($_GET['id']) ? '' : trim(addslashes(htmlspecialchars($_GET['id'])));
		if ($slug_kh && $id_kh) {
			$sql_check_kh = "SELECT id_kh, username_kh, displayname_kh, slug_kh, email_kh, ngaythamgia_kh, url_thumb_kh FROM fd_khachhang WHERE slug_kh='$slug_kh' AND id_kh='$id_kh' AND trangthai_kh=1";
			if ($db->num_rows($sql_check_kh)) {
				$data_kh = $db->fetch_assoc($sql_check_kh, 1);
				echo '<div class="cont inf-kh mt-3">
							<ul class="nav nav-tabs" id="prf_tabs" tole="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" id="common" href="#tab_common" role="tab" aria-controls="tab_common" aria-selected="true">
										Tổng quan
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" id="secure" href="#tab_secure" role="tab" aria-controls="tab_secure" aria-selected="false">
										Bảo mật
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" id="setting" href="#tab_setting" role="tab" aria-controls="tab_setting" aria-selected="false">
										Cài đặt
									</a>
								</li>
							</ul>
							<div class="tab-content" id="tab_content">
								<div class="tab-pane active" id="tab_common" role="tabpanel" aria-labelledby="tab_common">
									<div class="info-common">
										<div class="thumb-cm mb-3">
											<img src="'.$_DOMAIN .$data_kh['url_thumb_kh'].'" alt="'.$data_kh['displayname_kh'].'" width="50" height="50">
										</div>
										<div class="info-cm">
											<p><strong>Tài khoản:</strong> '.$data_kh['username_kh'].'</p>
											<p>
												<strong>E-mail:</strong> '.$data_kh['email_kh'].'&nbsp;<span class="fa fa-edit text-primary"></span>
											</p>
											<div class="form-edit-mail d-none">
												<form id="formEdMail" method="POST" onsubmit="return false">
													
													<div class="form-group">
														<div class="input-group">
															<input type="email" id="edmail" value="'.$data_kh['email_kh'].'">
															<div class="input-group-append">
																<span class="input-group-text p-0" style="border: none !important;">
																	<button type="button" class="btn btn-warning btn-edmail">Ok</button>
																</span>
															</div>
														</div>
													</div>
													<div class="form-group">
														<p class="err m-0 d-none"><small class="text-danger"></small></p>
													</div>
												</form>
											</div>
											<p><strong>Ngày tham gia:</strong> '.$data_kh['ngaythamgia_kh'].'</p>
											<p><strong>Trạng thái:</strong> <span class="badge badge-success">Online</span></p>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="tab_secure" role="tabpanel" aria-labelledby="tab_secure">
									<div class="form-secure">
										<h5>Đổi mật khẩu</h5>
										<form onsubmit="return false" method="POST" id="formChangePass">
											<div class="form-group">
												<label for="oldPass">Mật khẩu cũ</label>
												<input type="password" id="oldPass" class="form-control" autocomplete="autocomplete">
											</div>
											<div class="form-group">
												<label for="newPass">Mật khẩu mới</label>
												<input type="password" id="newPass" class="form-control" autocomplete="autocomplete">
											</div>
											<div class="form-group">
												<label for="renewPass">Xác nhận mật khẩu mới</label>
												<input type="password" id="renewPass" class="form-control" autocomplete="autocomplete">
											</div>
											<div class="form-group">
													<p class="err m-0 d-none"><small class="text-danger"></small></p>
											</div>
											<div class="form-group">
												<button class="btn badge-warning btnChw">Lưu</button>
											</div>
										</form>
									</div>
								</div>
								<div class="tab-pane fade" id="tab_setting" role="tabpanel" aria-labelledby="tab_setting">

								</div>
							</div>
				</div>';
			}
			else new Redirect($_DOMAIN);
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>