
$('#formSignIn .signInBtn').click(function() {
	let nameSignIn = $('#nameSignIn').val(),
		passSignIn = $('#passSignIn').val(),
		err_log = $('#formSignIn .err');
	err_log.addClass('d-none');
	if (isEmpty(nameSignIn) || isEmpty(passSignIn)) {
		err_log.removeClass('d-none').find('small').html("*Vui lòng điền đầy đủ thông tin");
	}
	else {
		let data = {
			u: nameSignIn,
			p: md5(passSignIn),
			act: 'in'
		};
		user.setParams($_DOMAIN+'sign.php', 'POST', data, 'text', err_log);
		user.signIn();
	}
});
$('#formSignUp .signUpBtn').click(function() {
	let nameSignUp = $('#nameSignUp').val(),
		passSignUp = $('#passSignUp').val(),
		repassSignUp = $('#repassSignUp').val(),
		mailSignUp = $('#mailSignUp').val(),
		err_log = $('#formSignUp .err');
	err_log.addClass('d-none');
	if (isEmpty(nameSignUp) || isEmpty(passSignUp) || isEmpty(repassSignUp)) {
		err_log.removeClass('d-none').find('small').html("*Vui lòng điền đầy đủ thông tin");
	}
	else if (nameSignUp.length < 6) {
		err_log.removeClass('d-none').find('small').html("*Tên đăng nhập phải chứa ít nhất 6 kí tự");
	}
	else if (!(/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/gm).test(mailSignUp)) {
		err_log.removeClass('d-none').find('small').html("*Định dạng email không hợp lệ");
	}
	else if (passSignUp.length < 8) {
		err_log.removeClass('d-none').find('small').html("*Mật khẩu phải chứa ít nhất 8 kí tự");
	}
	else if (passSignUp != repassSignUp) {
		err_log.removeClass('d-none').find('small').html("*Mật khẩu nhập lại không khớp");
	}
	else {
		if (nameSignUp.split(" ").length == 1) {
			short_dname = nameSignUp.substr(0, 1).toUpperCase();
		}
		else short_dname = nameSignUp.split(" ")[0].substr(0, 1).toUpperCase() + nameSignUp.split(" ")[1].substr(0, 1).toUpperCase();
		let canvasavt = document.getElementById('canvas_avt'),
			ctx = canvasavt.getContext('2d'),
			x = canvasavt.width /2,
			y = canvasavt.height /2,
			r=g=b=0;
		let randColor = "rgb("+ Math.floor(Math.random()*256)+","+ Math.floor(Math.random()*256)+","+ Math.floor(Math.random()*256) +")";
		ctx.rect(0, 0, 360, 360);
		ctx.fillStyle = randColor;
		ctx.fill();
		ctx.font = "30px Arial";
		ctx.textAlign = "center";
		ctx.fillStyle = "white";
		ctx.fillText(short_dname, x, y+12);
		let avt = canvasavt.toDataURL();

		let data = {
			u: nameSignUp,
			p: md5(passSignUp),
			rp: md5(repassSignUp),
			m: mailSignUp,
			avt: avt,
			act: 'up'
		};
		$(this).attr('disabled', 'disabled');
		$('#formSignUp .spinner-grow').removeClass('d-none');
		user.setParams($_DOMAIN+'sign.php', 'POST', data, 'text', err_log);
		user.signUp();
	}
});
$('#formOrder .btnOrder').click(function() {
	let idsp = $(this).attr('s'),
		add = $('#formOrder .add').val(),
		sdt = $('#formOrder .tel').val(),
		amount = Number($('#formOrder .selector input[type="number"]').val()),
		//price = $('#formOrder .total span').html(),
		capt_code = $('#formOrder #capt_code').val(),
		err_log = $('#formOrder .err');
	err_log.addClass('d-none');
	//get info sp
	if (!isBusy) {
		isBusy = true;
		//console.log(isBusy);
		$.ajax({
			url: $_DOMAIN +'order.php',
			type: 'POST',
			dataType: 'text',
			data : {
				idsp: idsp,
				act: 'getinfsp'
			}
		}).done(data => {
			data = $.parseJSON(data);
			let price_one = data.giamoi_sp;
			if (isEmpty(idsp) || isEmpty(price_one)) {
				err_log.removeClass('d-none').find('small').html("*Đã xảy ra lỗi, vui lòng thử lại sau");
			}
			else if (isEmpty(amount) || amount <= 0) {
				err_log.removeClass('d-none').find('small').html("*Vui lòng nhập số lượng");
			}
                        else if (price_one * amount <=0 || price_one * amount > 2147483647) {
				err_log.removeClass('d-none').find('small').html("*Đã xảy ra lỗi, tổng thanh toán tối đa: 2.147.483.647");
			}
			else if (isEmpty(add) || isEmpty(sdt)) {
				err_log.removeClass('d-none').find('small').html("*Vui lòng điền đầy đủ thông tin");
			}
			else if ((/((09|03|07|08|05)+([0-9]{8})\b)/g).test(sdt) == false) {
				err_log.removeClass('d-none').find('small').html("*Số điện thoại không hợp lệ");
			}
			else if (isEmpty(capt_code)) {
				err_log.removeClass('d-none').find('small').html("*Vui lòng nhập mã xác nhận");
			}
			else {
				isBusy = false;
				let price = price_one * amount;
				let data = {
					idsp: idsp,
					add: add,
					sdt: sdt,
					amount: amount,
					price: price,
					capt_code: capt_code,
					act: 'ord'
				}
				user.setParams($_DOMAIN+'order.php', 'POST', data, 'text', err_log);
				user.order();
			}
		}).fail(()=>{
			err_log.removeClass('d-none').find('small').html("*Đã xảy ra lỗi, vui lòng thử lại sau");
		}).always(()=>{
			isBusy = false;
		});
	}
	else return false;
	//console.log(amount);
});
$('#formChangePass .btnChw').click(function() {
	let oldPass = $('#oldPass').val(),
		newPass = $('#newPass').val(),
		renewPass = $('#renewPass').val(),
		err_log = $('#formChangePass .err');
	err_log.addClass('d-none');
	if (isEmpty(oldPass) || isEmpty(newPass) || isEmpty(renewPass)) {
		err_log.removeClass('d-none').find('small').html('*Vui lòng điền đầy đủ thông tin');
	}
	else if (newPass.length < 8) {
		err_log.removeClass('d-none').find('small').html('*Mật khẩu phải chứa ít nhất 8 kí tự');
	}
	else if (newPass != renewPass) {
		err_log.removeClass('d-none').find('small').html("*Mật khẩu nhập lại không khớp");
	}
	else {
		let data = {
			oldPass: md5(oldPass),
			newPass: newPass,
			renewPass: renewPass,
			act: "chw"
		};
		user.setParams($_DOMAIN+'customer.php', 'POST', data, 'text', err_log);
		user.chw();
	}
});
$('#formRsPw .btnRsPw').click(function() {
	let mail = $('#formRsPw .rsmail').val(),
		err_log = $('#formRsPw .err');
	err_log.addClass('d-none');
	if (isEmpty(mail)) {
		err_log.removeClass('d-none').find('small').html('*Vui lòng điền đầy đủ thông tin');
	}
	else {
		let data = {
			mail: mail,
			act: 'rspw'
		};
		$(this).attr('disabled', 'disabled');
		$('#formRsPw .spinner-grow').removeClass('d-none');
		user.setParams($_DOMAIN+'resetpass.php', 'POST', data, 'text', err_log);
		user.resetPass();
	}
});
$('#formVrPass .btnrerspw').click(function() {
	let rsnewpw = $('#formVrPass #rsnewpw').val(),
		rersnewpw = $('#formVrPass #rersnewpw').val(),
		err_log = $('#formVrPass .err');
	err_log.addClass('d-none');
	if (isEmpty(rsnewpw) || isEmpty(rersnewpw)) {
		err_log.removeClass('d-none').find('small').html('*Vui lòng điền đầy đủ thông tin');
	}
	else if (rsnewpw.length < 8) {
		err_log.removeClass('d-none').find('small').html('*Mật khẩu phải chứa ít nhất 8 kí tự');
	}
	else if (rsnewpw != rersnewpw) {
		err_log.removeClass('d-none').find('small').html('*Mật khẩu nhập lại không khớp');
	}
	else {
		let data = {
			rsnewpw: rsnewpw,
			rersnewpw: rersnewpw,
			act: 'rerspw'
		};
		user.setParams($_DOMAIN+'resetpass.php', 'POST', data, 'text', err_log);
		user.resetPass();
	}
});
$('#formEdMail .btn-edmail').click(function() {
	let mail = $('#formEdMail #edmail').val(),
		err_log = $('#formEdMail .err');
	err_log.addClass('d-none');
	if (isEmpty(mail)) {
		err_log.removeClass('d-none').find('small').html('*Vui lòng điền đầy đủ thông tin');
	}
	else {
		let data = {
			mail: mail,
			act: 'chm'
		};
		user.setParams($_DOMAIN+'customer.php', 'POST', data, 'text', err_log);
		user.chm();
	}
});