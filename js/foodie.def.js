$_DOMAIN = 'http://foodie.getenjoyment.net/';
var isBusy = false;

class User {
	constructor() {
		this.url = '';
		this.type = '';
		this.data = '';
		this.dataType = '';
		this.err_log = '';
	}
	setParams(url, type, data, dataType, err_log) {
		this.url = url;
		this.type = type;
		this.data = data;
		this.dataType = dataType;
		this.err_log = err_log;
	}
	sendAjax() {
		sendJqXhr(this.url, this.type, this.data, this.dataType, this.err_log);
	}
	signIn() {
		this.sendAjax();
	}
	signUp() {
		this.sendAjax();
	}
	order() {
		this.sendAjax();
	}
	chw() {
		this.sendAjax();
	}
	resetPass() {
		this.sendAjax();
	}
	chm() {
		this.sendAjax();
	}
};
var user = new User();