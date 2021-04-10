<div class="container content">
	<div class="row">
		<form method="POST" id="formSignIn" onsubmit="return false" class="mx-auto mt-5">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-user"></i></span>
					</div>
					<input type="text" class="form-control" id="name_signin" placeholder="Tên đăng nhập" autocomplete="autocomplete">
				</div>
				<p id="err_name_signin" class="text-danger d-none"><small><i></i></small></p>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-lock"></i></span>
					</div>
					<input type="password" class="form-control" id="pass_signin" placeholder="Mật khẩu" autocomplete="autocomplete">
				</div>
				<p id="err_pass_signin" class="text-danger d-none"><small><i></i></small></p>
			</div>
			<div class="form-group clearfix">
				<p id="signin_notice" class="text-danger d-none"><small><i></i></small></p>
				<button type="button" class="btn btn-info float-right" id="submitSignin">Đăng nhập</button>
			</div>
		</form>
	</div>
</div>