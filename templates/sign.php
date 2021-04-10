<?php
	$ac = empty($_GET['sign']) ? '' : trim(addslashes(htmlspecialchars($_GET['sign'])));
	if ($ac == 'in') {
		echo '<div class="cont mt-3">
					<div class="form-sign-in">
						<form method="POST" id="formSignIn" onsubmit="return false">
							<div class="form-row">
								<div class="form-group">
									<label for="nameSignIn">Tên đăng nhập</label>
									<input type="text" class="form-control" id="nameSignIn" autocomplete="autocomplete">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group">
									<label for="passSignIn">Mật khẩu</label>
									<input type="password" class="form-control" id="passSignIn" autocomplete="autocomplete">
								</div>
							</div>
							<div class="form-row">
									<p class="err m-0 d-none"><small class="text-danger"></small></p>
							</div>
							<div class="form-row my-3">
									<button class="btn btn-warning signInBtn">Đăng nhập</button>
							</div>
							<div class="form-row d-block">
									<p class="mb-0">Chưa có tài khoản?&nbsp; <a href="'.$_DOMAIN .'sign-up'.'">Đăng kí</a></p>
									<p><a href="'.$_DOMAIN .'reset/password&step=1'.'">Quên mật khẩu?</a></p>
							</div>
						</form>
					</div>
			</div>
		';
	}
	elseif ($ac == 'up') {
		echo '<div class="cont mt-3">
					<div class="form-sign-up">
						<form method="POST" id="formSignUp" onsubmit="return false">
							<div class="form-row">
								<div class="form-group">
									<label for="nameSignUp">Tên đăng nhập</label>
									<input type="text" class="form-control" id="nameSignUp">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group">
									<label for="mailSignUp">E-mail</label>
									<input type="text" class="form-control" id="mailSignUp" autocomplete="autocomplete">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group">
									<label for="passSignUp">Mật khẩu</label>
									<input type="password" class="form-control" id="passSignUp" autocomplete="autocomplete">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group">
									<label for="repassSignUp">Xác nhận mật khẩu</label>
									<input type="password" class="form-control" id="repassSignUp" autocomplete="autocomplete">
								</div>
							</div>
							<div class="form-row">
									<p class="err m-0 d-none"><small class="text-danger"></small></p>
							</div>
							<div class="form-row my-3">
									<button class="btn btn-warning signUpBtn">Đăng kí</button><span class="spinner-grow text-warning mt-1 d-none"></span>
							</div>
							<div class="form-row">
									<p>Đã có tài khoản?&nbsp; </p><a href="'.$_DOMAIN .'sign-in'.'">Đăng nhập.</a>
							</div>
						</form>
					</div>
					<canvas id="canvas_avt" class="d-none" width="80" height="80"></canvas>
			</div>
		';
	}
	else new Redirect($_DOMAIN);
?>