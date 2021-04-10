
var user = new User;
var ad   = new Admin;

$('#submitSignin').click(function() {
	let username = $('#name_signin').val(),
		password = $('#pass_signin').val();
	user.signIn(username, password);
});
$('#btnUpInfo').click(function(event) {
	ad.updatePrfInfo(event);
});
$('#btnUpSecure').click(function(event) {
	ad.updatePrfSecure(event);
});
$('#del_cate_list').click(function(event) {
	ad.delListSpec(event);
});
$('#list_cate .del-cate').click(function(event) {
	ad.delASpec(event, $(this));
});
$('#del_nsx_list').click(function(event) {
	ad.delListPrd(event);
});
$('#list_nsx .del-nsx').click(function(event) {
	ad.delAPrd(event, $(this));
});
$('#del_food_list').click(function(event) {
	ad.delFoodList(event);
});
$('#list_food').on('click', '.del-food', function(event) {
	ad.delAFood(event, $(this));
});
$('#btnAddCate').click(function(event) {
	ad.addSpec(event);
});
$('#btnEditCate').click(function(event) {
	ad.editSpec(event);
});
$('#btnAddInfoNsx').click(function(event) {
	ad.addPrd(event);
});
$('#btnEditInfoNsx').click(function(event) {
	ad.editPrd(event);
});
$('#btnAddFood').click(function(event) {
	ad.addFood(event);
});
$('#btnEditFood').click(function(event) {
	ad.editFood(event);
});
$('#btnAddAcc').click(function(event) {
	ad.addAcc(event);
});
$('#upgrade_acc_list').click(function(event) {
	ad.upgradeListAcc(event);
});
$('#downgrade_acc_list').click(function(event) {
	ad.downgradeListAcc(event);
});
$('#lock_acc_list').click(function(event) {
	ad.lockListAcc(event);
});
$('#unlock_acc_list').click(function(event) {
	ad.unlockListAcc(event);
});
$('#list_acc .upgrade-acc').click(function(event) {
	ad.upgradeAnAcc(event, $(this));
});
$('#list_acc .downgrade-acc').click(function(event) {
	ad.downgradeAnAcc(event, $(this));
});
$('#list_acc .lock-acc').click(function(event) {
	ad.lockAnAcc(event, $(this));
});
$('#list_acc .unlock-acc').click(function(event) {
	ad.unlockAnAcc(event, $(this));
});
$('#lock_cus_list').click(function(event) {
	ad.lockListCus(event);
});
$('#unlock_cus_list').click(function(event) {
	ad.unlockListCus(event);
});
$('#list_cus .lock-cus').click(function(event) {
	ad.lockACus(event, $(this));
});
$('#list_cus .unlock-cus').click(function(event) {
	ad.unlockACus(event, $(this));
});
$('#btnEditCont').click(function(event) {
	ad.editContact(event);
});
$('#btnEditRule').click(function(event) {
	ad.editRule(event);
});
$('#btnEditPoly').click(function(event) {
	ad.editPolicy(event);
});
$('#btnDelAvt').click(function(event) {
	ad.delAvt(event);
});
$('#btnEditInfoSite').click(function() {
	ad.settingInfoSite();
});
$('#btnEditStatusSite').click(function() {
	ad.settingSttSite();
});
$('#btnAddCity').click(function() {
	ad.addCity();
});
$('#btnAddQh').click(function() {
	ad.addQh();
});
$('#btnEditCity').click(function() {
	ad.editCity();
});
$('#btnEditQh').click(function() {
	ad.editQh();
});
$('#list_city .del-city').click(function(event) {
	event.preventDefault();
	ad.delACity($(this));
});
$('#list_qh .del-qh').click(function(event) {
	event.preventDefault();
	ad.delACity($(this));
});
$('#table_order').on('click', '#proc_list_order', function() {
	ad.orderProcess();
});
$('#table_order').on('click', '#apply_list_order', function() {
	ad.orderApply();
});
$('#table_order').on('click', '.proc-order', function() {
	ad.procAnOrder($(this));
});
$('#table_order').on('click', '.apply-order', function() {
	ad.applyAnOrder($(this));
});
$('.slide-img .span').click(function() {
	ad.delSlide($(this));
});
$('#btnAddSi').click(function() {
	ad.addSi();
});
$('#btnEditSi').click(function() {
	ad.editSi();
});
$('#list_si .del-si').click(function() {
	ad.delSi($(this));
});
$('#btnAddSm').click(function() {
	ad.addSm();
});
$('#btnEditSm').click(function() {
	ad.editSm();
});
$('#list_sm .del-sm').click(function() {
	ad.delSm($(this));
});