$_DOMAIN = 'http://foodie.getenjoyment.net/admin/';
var isBusy = false;

function Admin() {return this;}
function User() {
	this.username = '';
	this.password = '';

	this.setUser = function(username, password) {
		this.username = username;
		this.password = password;
	}
	this.getUser = function() {
		return [this.username, this.password];
	}
	return this;
}
//
User.prototype.signIn = function(username, password) {
	this.setUser(username, password);
	let err_user = $('#err_name_signin'),
		err_pass = $('#err_pass_signin'),
		notice   = $('#signin_notice'),
		err 	 = false;
	//reset notice
	err_user.addClass('d-none');
	err_pass.addClass('d-none');
	notice.addClass('d-none');
	//validate
	if (isEmpty(this.username)) {
		err_user.removeClass('d-none').find('i').html('*Bắt buộc');
		err = true;
	}
	if (isEmpty(this.password)) {
		err_pass.removeClass('d-none').find('i').html('*Bắt buộc');
		err = true;
	}
	//send
	if (!isBusy && !err) {
		isBusy = true;
		let data = {
			username: this.username,
			password: md5(this.password)
		};
		sendJqXhr($_DOMAIN+'signin.php', 'POST', data, 'json', doneCb, failCb, alwaysCb);
		function doneCb(errors) {
			if (!isEmpty(errors['username'])) {
				err_user.removeClass('d-none').find('i').html(errors['username']);
			}
			if (!isEmpty(errors['password'])) {
				err_pass.removeClass('d-none').find('i').html(errors['password']);
			}
			if (!isEmpty(errors['other'])) {
				notice.find('i').html(errors['other']);
			}
		}
		function failCb() {
			notice.removeClass('d-none').find('i').html('*Có lỗi xảy ra, vui lòng thử lại sau');
		}
		function alwaysCb() {
			isBusy = false;
		}
	}
	else return false;
}
//
Admin.prototype.updatePrfInfo = function(event) {
	event.preventDefault();
	let upDname = $('#inpUpDname').val(),
		upAddr = $('#inpUpAdd').val(),
		upSdt = $('#inpUpSdt').val(),
		upEmail = $('#inpUpEmail').val(),
		err_log = $('#errUpInfo');
		err_log.addClass('d-none');

	if (isEmpty(upDname)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền đầy đủ thông tin');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				upDname: upDname,
				upAddr: upAddr,
				upSdt: upSdt,
				upEmail: upEmail,
				action: 'update_info'
			};
			sendJqXhr($_DOMAIN+'profile.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}
Admin.prototype.updatePrfSecure = function(event) {
	event.preventDefault();
	let oldPass = $('#oldPass').val(),
		newPass = $('#newPass').val(),
		renewPass = $('#renewPass').val(),
		err_log = $('#errUpSecure');
		err_log.addClass('d-none');
	if (isEmpty(oldPass) || isEmpty(newPass) || isEmpty(renewPass)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền đầy đủ thông tin');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				oldPass: oldPass,
				newPass: newPass,
				renewPass: renewPass,
				action: 'update_secure'
			};
			sendJqXhr($_DOMAIN +'profile.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').html(data);
			}
			function failCb() {
				err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}
Admin.prototype.delAvt = function(event) {
	event.preventDefault();
	if (confirm('Bạn có chắc muốn xóa ảnh đại diện này không?')) {
		if (!isBusy) {
			isBusy = true;
			let err_log = $('#errUpAvt'),
				data = {
					action: 'delete_avt'
				};

			sendJqXhr($_DOMAIN+'profile.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.delListSpec = function(event) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn xóa các mục đã chọn không?')) {
		var id_spec = [];
		$('#list_cate input[type="checkbox"]:checkbox:checked').each(function(i){
			id_spec[i] = $(this).val();
		});
		if (id_spec.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_spec: id_spec,
					action: 'del_spec_list'
				};
				sendJqXhr($_DOMAIN+'species.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.delASpec = function(event, self) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn xóa mục đã chọn không?')) {
		if (!isBusy) {
			isBusy = true;
			let id_spec = self.attr('data-id');
			data = {
				id_spec: id_spec,
				action: 'del_a_spec'
			};
			sendJqXhr($_DOMAIN+"species.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.delFoodList = function(event) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn xóa các mục đã chọn không?')) {
		var id_food = [];
		$('#list_food input[type="checkbox"]:checkbox:checked').each(function(i){
			id_food[i] = $(this).val();
		});
		if (id_food.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			console.log(id_food);
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_food: id_food,
					action: 'del_food_list'
				};
				sendJqXhr($_DOMAIN+'foods.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.delAFood = function(event, self) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn xóa mục đã chọn không?')) {
		if (!isBusy) {
			isBusy = true;
			let id_food = self.attr('data-id');
			let data = {
				id_food: id_food,
				action: 'del_a_food'
			};
			sendJqXhr($_DOMAIN+"foods.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.addSpec = function(event) {
	event.preventDefault();
	let nameAddCate = $('#nameAddCate').val(),
		err_log = $('#errAddCate');
		err_log.addClass('d-none');
	if (isEmpty(nameAddCate)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền đầy đủ thông tin');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				nameAddCate: nameAddCate,
				action: 'add_cate'
			};
			sendJqXhr($_DOMAIN+'species.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}

}
Admin.prototype.editSpec = function(event) {
	event.preventDefault();
	let nameEditCate = $('#nameEditCate').val(),
		ed_descrEditCate = $('#ed_descrEditCate').val(),
		sttEdit = $('#editSttCate').val(),
		id_spec = $('#formEditCate .hidden-id').attr('data-id'),
		err_log = $('#errEditCate');
	if (isEmpty(nameEditCate)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền đầy đủ thông tin');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				id_spec: id_spec,
				nameEditCate: nameEditCate,
				ed_descrEditCate: ed_descrEditCate,
				sttEdit: sttEdit,
				action: 'edit_cate'
			};
			sendJqXhr($_DOMAIN+'species.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}

Admin.prototype.addFood = function(event) {
	event.preventDefault();
	let nameAddFood = $('#nameAddFood').val(),
		chlFood = $('#addChlFood').val(),
		err_log = $('#errAddFood');
	err_log.addClass('d-none');
	//console.log(nsxFood+', '+chlFood);
	if (isEmpty(nameAddFood)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền đầy đủ thông tin');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				nameAddFood: nameAddFood,
				chlFood: chlFood,
				action: 'add_food'
			};
			sendJqXhr($_DOMAIN+'foods.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}
Admin.prototype.editFood = function(event) {
	let nameEditFood = $('#nameEditFood').val(),
		editChl = $('#boxChl').val(),
		descrEditFood = $('#descrEditFood').val(),
		ed_detailEditFood = $('#ed_detailEditFood').val(),
		priceEditFood = $('#priceEditFood').val(),
		saleEditFood = $('#saleEditFood').val(),
		newPriceEditFood = $('#newPriceEditFood').val(),
		ed_noteEditFood = $('#ed_noteEditFood').val(),
		stt_food = $('#formEditFood input[type="radio"]:radio:checked').val(),
		id_food = $('#formEditFood .hidden-id').attr('data-id'),
		calEditFood = $('#calEditFood').val(),
		fatEditFood = $('#fatEditFood').val(),
		proteinEditFood = $('#proteinEditFood').val(),
		satFatEditFood = $('#satFatEditFood').val(),
		dieFibEditFood = $('#dieFibEditFood').val(),
		canxiEditFood = $('#canxiEditFood').val(),
		sugarEditFood = $('#sugarEditFood').val(),
		ironEditFood = $('#ironEditFood').val(),
		chlesEditFood = $('#chlesEditFood').val(),
		vitDEditFood = $('#vitDEditFood').val(),
		keyEditFood = $('#keyEditFood').val(),
		err_log = $('#errEditFood');
	err_log.addClass('d-none');
	//console.log(id_food);
	if (isEmpty(nameEditFood) || isEmpty(priceEditFood)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền đầy đủ thông tin');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				nameEditFood: nameEditFood,
				editChl: editChl,
				descrEditFood: descrEditFood,
				ed_detailEditFood: ed_detailEditFood,
				priceEditFood: priceEditFood,
				saleEditFood: saleEditFood,
				newPriceEditFood: newPriceEditFood,
				ed_noteEditFood: ed_noteEditFood,
				stt_food: stt_food,
				id_food: id_food,
				calEditFood : calEditFood,
				fatEditFood :fatEditFood,
				proteinEditFood : proteinEditFood,
				satFatEditFood :satFatEditFood,
				dieFibEditFood :dieFibEditFood,
				canxiEditFood :canxiEditFood,
				sugarEditFood :sugarEditFood,
				ironEditFood :ironEditFood,
				chlesEditFood :chlesEditFood,
				vitDEditFood :vitDEditFood,
				keyEditFood: keyEditFood,
				action: 'edit_food'
			};
			sendJqXhr($_DOMAIN+'foods.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}
Admin.prototype.addAcc = function(event) {
	let nameAddAcc = $('#nameAddAcc').val(),
		dNameAddAcc = $('#dNameAddAcc').val(),
		passAddAcc = $('#passAddAcc').val(),
		rePassAddAcc = $('#rePassAddAcc').val(),
		err_log = $('#errAddAcc');
	err_log.addClass('d-none');
	if (isEmpty(nameAddAcc) || isEmpty(dNameAddAcc) || isEmpty(passAddAcc) || isEmpty(rePassAddAcc)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền đầy đủ thông tin');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				nameAddAcc: nameAddAcc,
				dNameAddAcc: dNameAddAcc,
				passAddAcc: passAddAcc,
				rePassAddAcc: rePassAddAcc,
				action: 'add_acc'
			};
			sendJqXhr($_DOMAIN+"accounts.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}
Admin.prototype.upgradeListAcc = function(event) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn tăng cấp các mục đã chọn không?')) {
		var id_acc = [];
		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i){
			id_acc[i] = $(this).val();
		});
		if (id_acc.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_acc: id_acc,
					action: 'upgrade_acc_list'
				};
				sendJqXhr($_DOMAIN+'accounts.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.downgradeListAcc = function(event) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn hạ cấp các mục đã chọn không?')) {
		var id_acc = [];
		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i){
			id_acc[i] = $(this).val();
		});
		if (id_acc.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_acc: id_acc,
					action: 'downgrade_acc_list'
				};
				sendJqXhr($_DOMAIN+'accounts.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.lockListAcc = function(event) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn khóa các mục đã chọn không?')) {
		var id_acc = [];
		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i){
			id_acc[i] = $(this).val();
		});
		if (id_acc.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_acc: id_acc,
					action: 'lock_acc_list'
				};
				sendJqXhr($_DOMAIN+'accounts.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.unlockListAcc = function(event) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn mở khóa các mục đã chọn không?')) {
		var id_acc = [];
		$('#list_acc input[type="checkbox"]:checkbox:checked').each(function(i){
			id_acc[i] = $(this).val();
		});
		if (id_acc.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_acc: id_acc,
					action: 'unlock_acc_list'
				};
				sendJqXhr($_DOMAIN+'accounts.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.upgradeAnAcc = function(event, self) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn nâng cấp mục đã chọn không?')) {
		if (!isBusy) {
			isBusy = true;
			let id_acc = self.attr('data-id');
			let data = {
				id_acc: id_acc,
				action: 'upgrade_an_acc'
			};
			sendJqXhr($_DOMAIN+"accounts.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.downgradeAnAcc = function(event, self) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn hạ cấp mục đã chọn không?')) {
		if (!isBusy) {
			isBusy = true;
			let id_acc = self.attr('data-id');
			let data = {
				id_acc: id_acc,
				action: 'downgrade_an_acc'
			};
			sendJqXhr($_DOMAIN+"accounts.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.lockAnAcc = function(event, self) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn khóa mục đã chọn không?')) {
		if (!isBusy) {
			isBusy = true;
			let id_acc = self.attr('data-id');
			let data = {
				id_acc: id_acc,
				action: 'lock_an_acc'
			};
			sendJqXhr($_DOMAIN+"accounts.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.unlockAnAcc = function(event, self) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn mở khóa mục đã chọn không?')) {
		if (!isBusy) {
			isBusy = true;
			let id_acc = self.attr('data-id');
			let data = {
				id_acc: id_acc,
				action: 'unlock_an_acc'
			};
			sendJqXhr($_DOMAIN+"accounts.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.lockListCus = function(event) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn khóa các mục đã chọn không?')) {
		var id_cus = [];
		$('#list_cus input[type="checkbox"]:checkbox:checked').each(function(i){
			id_cus[i] = $(this).val();
		});
		if (id_cus.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_cus: id_cus,
					action: 'lock_cus_list'
				};
				sendJqXhr($_DOMAIN+'customers.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.unlockListCus = function(event) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn mở khóa các mục đã chọn không?')) {
		var id_cus = [];
		$('#list_cus input[type="checkbox"]:checkbox:checked').each(function(i){
			id_cus[i] = $(this).val();
		});
		if (id_cus.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_cus: id_cus,
					action: 'unlock_cus_list'
				};
				sendJqXhr($_DOMAIN+'customers.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.lockACus = function(event, self) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn khóa mục đã chọn không?')) {
		if (!isBusy) {
			isBusy = true;
			let id_cus = self.attr('data-id');
			let data = {
				id_cus: id_cus,
				action: 'lock_a_cus'
			};
			sendJqXhr($_DOMAIN+"customers.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.unlockACus = function(event, self) {
	event.preventDefault();
	if (confirm('Bạn có chắc chắn muốn mở khóa mục đã chọn không?')) {
		if (!isBusy) {
			isBusy = true;
			let id_cus = self.attr('data-id');
			let data = {
				id_cus: id_cus,
				action: 'unlock_a_cus'
			};
			sendJqXhr($_DOMAIN+"customers.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}

Admin.prototype.settingSttSite = function(event) {
	let stt_site = $('#formEditStatusSite input[type="radio"]:radio:checked').val(),
		err_log = $('#errEditSttSite');
	err_log.addClass('d-none');
	console.log(stt_site);
	if (!isBusy) {
		isBusy = true;
		let data = {
			stt_site: stt_site,
			action: 'edit_stt'
		};
		sendJqXhr($_DOMAIN+'settings.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
		function doneCb(data) {
			err_log.removeClass('d-none').find('i').html(data);
		}
		function failCb() {
			alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
		}
		function alwaysCb() {
			isBusy = false;
		}
	}
	else return false;

}
Admin.prototype.settingInfoSite = function() {
	let title_site = $('#title_site').val(),
		descr_site = $('#descr_site').val(),
		keywords_site = $('#keywords_site').val(),
		err_log = $('#errEditInfoSite');
	err_log.addClass('d-none');
	if (isEmpty(title_site) || isEmpty(descr_site)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền các thông tin bắt buộc');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				title_site: title_site,
				descr_site: descr_site,
				keywords_site: keywords_site,
				action: 'edit_info'
			};
			sendJqXhr($_DOMAIN+'settings.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}

Admin.prototype.orderProcess = function() {
	if (confirm('Chuyển các mục đã chọn sang trạng thái xử lí?')) {
		var id_or = [];
		$('#list_order input[type="checkbox"]:checkbox:checked').each(function(i){
			id_or[i] = $(this).val();
		});
		if (id_or.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_or: id_or,
					action: 'proc_order_list'
				};
				sendJqXhr($_DOMAIN+'orders.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.orderApply = function() {
	if (confirm('Chuyển các mục đã chọn sang trạng thái đã giao?')) {
		var id_or = [];
		$('#list_order input[type="checkbox"]:checkbox:checked').each(function(i){
			id_or[i] = $(this).val();
		});
		if (id_or.length === 0) {
			alert('Vui lòng chọn ít nhất 1 mục');
		}
		else {
			if (!isBusy) {
				isBusy = true;
				let data = {
					id_or: id_or,
					action: 'apply_order_list'
				};
				sendJqXhr($_DOMAIN+'orders.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
				function doneCb(data) {
					location.reload();
				}
				function failCb() {
					alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
				}
				function alwaysCb() {
					isBusy = false;
				}
			}
			else return false;
		}
	}
	else return false;
}
Admin.prototype.procAnOrder = function(self) {
	if (confirm('Chuyển mục đã chọn sang trạng thái xử lí?')) {
		if (!isBusy) {
			isBusy = true;
			let id_or = self.attr('di');
			let data = {
				id_or: id_or,
				action: 'proc_a_or'
			};
			sendJqXhr($_DOMAIN+"orders.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.applyAnOrder = function(self) {
	if (confirm('Chuyển mục đã chọn sang trạng thái đã giao?')) {
		if (!isBusy) {
			isBusy = true;
			let id_or = self.attr('di');
			let data = {
				id_or: id_or,
				action: 'apply_a_or'
			};
			sendJqXhr($_DOMAIN+"orders.php", 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
	else return false;
}
Admin.prototype.delSlide = function(self) {
	let url_img = self.prev().attr('src'),
		id_slider = self.prev().attr('di');
	if (!isBusy) {
		isBusy = true;
		let data = {
			url_img: url_img,
			id_slider: id_slider,
			action: 'del_slide'
		};
		sendJqXhr($_DOMAIN+'slider.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
		function doneCb(data) {
				location.reload();
		}
		function failCb() {
			alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
		}
		function alwaysCb() {
			isBusy = false;
		}
	}
	else return false;
}
Admin.prototype.addSi = function() {
	let titleAddSi = $('#titleAddSi').val(),
		selAddPar = $("#selAddPar").val(),
		ed_addNdSi = $('#ed_addNdSi').val(),
		err_log = $('#errAddSi');
	err_log.addClass('d-none');
	if (isEmpty(titleAddSi)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền các thông tin bắt buộc');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				titleAddSi: titleAddSi,
				selAddPar: selAddPar,
				ed_addNdSi: ed_addNdSi,
				action: 'add_si'
			};
			sendJqXhr($_DOMAIN+'siteinfo.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}
Admin.prototype.editSi = function() {
	let titleEditSi = $('#titleEditSi').val(),
		selEditPar = $("#selEditPar").val(),
		ed_editSi = $('#ed_editSi').val(),
		id_si = $('#formEditSi .hidden-id').attr('di'),
		err_log = $('#errEditSi');
	err_log.addClass('d-none');
	if (isEmpty(titleEditSi)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền các thông tin bắt buộc');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				titleEditSi: titleEditSi,
				selEditPar: selEditPar,
				ed_editSi: ed_editSi,
				id_si: id_si,
				action: 'edit_si'
			};
			sendJqXhr($_DOMAIN+'siteinfo.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}
Admin.prototype.delSi = function(self) {
	if (confirm('Xóa mục đã chọn?')) {
		if (!isBusy) {
			isBusy = true;
			let id_si = self.attr('di');
			let data = {
				id_si: id_si,
				action: 'del_si'
			};
			sendJqXhr($_DOMAIN+'siteinfo.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
		}
	}
	else return false;
	}
	else return false;
}
Admin.prototype.addSm = function() {
	let titleAddSm = $('#titleAddSm').val(),
		linkAddSm = $("#linkAddSm").val(),
		iconAddSm = $('#iconAddSm').val(),
		err_log = $('#errAddSm');
	err_log.addClass('d-none');
	if (isEmpty(titleAddSm)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền các thông tin bắt buộc');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				titleAddSm: titleAddSm,
				linkAddSm: linkAddSm,
				iconAddSm: iconAddSm,
				action: 'add_sm'
			};
			sendJqXhr($_DOMAIN+'social.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}
Admin.prototype.editSm = function() {
	let titleEditSm = $('#titleEditSm').val(),
		linkEditSm = $("#linkEditSm").val(),
		iconEditSm = $('#iconEditSm').val(),
		id = $('#btnEditSm').attr('di'),
		err_log = $('#errEditSm');
	err_log.addClass('d-none');
	if (isEmpty(titleEditSm)) {
		err_log.removeClass('d-none').find('i').html('*Vui lòng điền các thông tin bắt buộc');
	}
	else {
		if (!isBusy) {
			isBusy = true;
			let data = {
				titleEditSm: titleEditSm,
				linkEditSm: linkEditSm,
				iconEditSm: iconEditSm,
				id: id,
				action: 'edit_sm'
			};
			sendJqXhr($_DOMAIN+'social.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				err_log.removeClass('d-none').find('i').html(data);
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
			}
		}
		else return false;
	}
}
Admin.prototype.delSm = function(self) {
	if (confirm('Xóa mục đã chọn?')) {
		if (!isBusy) {
			isBusy = true;
			let id_sm = self.attr('di');
			let data = {
				id_sm: id_sm,
				action: 'del_sm'
			};
			sendJqXhr($_DOMAIN+'social.php', 'POST', data, 'text', doneCb, failCb, alwaysCb);
			function doneCb(data) {
				location.reload();
			}
			function failCb() {
				alert('*Đã xảy ra lỗi, vui lòng thử lại sau');
			}
			function alwaysCb() {
				isBusy = false;
		}
	}
	else return false;
	}
	else return false;
}