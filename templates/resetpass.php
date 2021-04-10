<?php
	$rpw = empty($_GET['repass']) ? '' : trim(addslashes(htmlspecialchars($_GET['repass'])));
	$step = empty($_GET['step']) ? '' : trim(addslashes(htmlspecialchars($_GET['step'])));

	if ($rpw && $step && $rpw == 'password') {
		if ($step == 1) {
			echo '<div class="cont rspwst">
					<form id="formRsPw" method="POST" onsubmit="return false">
						<div class="form-group m-0">
							<label>Địa chỉ e-mail của bạn</label>
							<input type="email" class="rsmail form-control" autocomplete="autocomplete">
						</div>
						<div class="form-group m-0">
									<p class="err m-0 d-none"><small class="text-danger"></small></p>
							</div>
						<div class="form-group">
							<p class="text-danger"><small>Chúng tôi sẽ gửi một liên kết xác nhận đến địa chỉ e-mail này, hãy chắc chắn đó là địa chỉ e-mail của bạn.</small></p>
						</div>
						<div class="form-row">
							<button class="btn btn-warning btnRsPw">Nhận liên kết</button><span class="spinner-grow text-warning mt-1 d-none"></span>
						</div>
					</form>
			</div>';
		}
		else new Redirect($_DOMAIN);
	}
	elseif ($step && $rpw && $rpw == 'verifycode') {
		if (strcmp($step, $session->get('vcode')) == 0) {
			echo '<div class="formVrPw cont">
						<form id="formVrPass" method="post" onsubmit="return false">
							<div class="form-group">
								<label>Mật khẩu mới</label>
								<input type="password" class="form-control" id="rsnewpw">
							</div>
							<div class="form-group">
								<label>Xác nhận mật khẩu mới</label>
								<input type="password" class="form-control" id="rersnewpw">
							</div>
							<div class="form-group">
									<p class="err m-0 d-none"><small class="text-danger"></small></p>
							</div>
							<div class="form-group">
								<button class="btn btnrerspw btn-warning">Lưu</button>
							</div>
						</form>
				</div>
			';
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>