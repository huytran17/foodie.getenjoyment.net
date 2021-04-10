
$('.footer-media .media-item').hover(function() {
	$(this).css('border', 'none');
	if ($(this).find('span').hasClass('fa-facebook')) {
		$(this).css('background-color', '#3B5998');
	}
	else if ($(this).find('span').hasClass('fa-twitter')) {
		$(this).css('background-color', '#1DA1F2');
	}
	else if ($(this).find('span').hasClass('fa-instagram')) {
		$(this).css({'background':'#d6249f', 'background':'radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%)'});
	}
	else if ($(this).find('span').hasClass('fa-spotify')) {
		$(this).css('background-color', '#1DB753');
	}
	else if ($(this).find('span').hasClass('fa-youtube')) {
		$(this).css('background-color', '#C4302B');
	}
}, function() {
	$(this).css({'border':'1px solid black', 'background-color':'white', 'background':'white'});
});
//
$('.footer-footer .expand').click(function() {
	$(this).next().toggleClass('showH');
	if ($(this).find('span').hasClass('fa-plus')) {
		$(this).find('span').removeClass('fa-plus').addClass('fa-minus');
	}
	else {
		$(this).find('span').removeClass('fa-minus').addClass('fa-plus');
	}
});	
//
$('.header .sec-row .drop-link').click(function(e) {
	e.preventDefault();
	$('.header .nav-header .menu-list').toggleClass('showHa');
	rotateArrow.call(this);
});
//
$('.post .detail-product h3').click(function() {
	//console.log('wwww');
	$(this).next().slideToggle(400);
});
$('.post .nutri-summary h3').click(function() {
	$(this).next().slideToggle(400);
});
//
$('.fa-angle-down').css('transition', 'all .2s linear 0s');
$('.post .nutri-summary h3').click(rotateArrow);
$('.post .detail-product h3').click(rotateArrow);
//
$('#tab_common .fa-edit').click(function() {
	$(this).parent().next().toggleClass('d-none');
});
//
function sendJqXhr(url, type, data, dataType, err_log) {
    if (!isBusy) {
    	isBusy = true;
    	$.ajax({
	        url : url,
	        type: type,
	        dataType: dataType,
	        data: data
	    })
	    .done((data) => {
			err_log.removeClass('d-none').find('small').html(data);
		})
	    .fail(() => {
			err_log.removeClass('d-none').find('small').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
		})
	    .always(() => {
			isBusy = false;
		});
    }
    else return false;
}
//
function isEmpty(variable) {
    if (variable === '' || variable === null || variable === 'undefined' || variable === false || variable === 'none') {
        return true;
    }
    else return false;
}
//
function calPr() {
	let idsp = $('#formOrder .btnOrder').attr('s'),
		err_log = $('#formOrder .err');
	err_log.addClass('d-none');
	if (!isBusy) {
		isBusy = true;
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
			let price = data.giamoi_sp,
				amount = Number($('.order-sp .selector input[type="number"]').val());
			let total = price * amount;
			$('#formOrder .total').find('span').html(new Intl.NumberFormat('ja-JP').format(total));
		}).fail(()=>{
			err_log.removeClass('d-none').find('small').html("*Đã xảy ra lỗi, vui lòng thử lại sau");
		}).always(()=>{
			isBusy = false;
		});
	}
	else return false;
	//console.log(pr+', '+am);
}
//
$('#formOrder .fa-minus').click(function() {
	let am = $('#formOrder input[type="number"]');
	if (parseInt(am.val()) > 1) {
		am.val(parseInt(am.val()) - 1);
		calPr();
	}
});
//
$('#formOrder .fa-plus').click(function() {
	let am = $('#formOrder input[type="number"]');
	if (isEmpty(am.val())) {
		am.val(1);
	}
	else {
		am.val(parseInt(am.val()) + 1);
	}
	calPr();
});
//
$('#formOrder input[type="number"]').keyup(calPr);
//$(document).ready(calPr);
$('#formOrder #capt_reload').click(function() {
	$('#img_capt').attr('src', '../capt.php?rand='+Math.random());
});
//
$('.basket .opt .btn-discard').click(function() {
	let iddh = $(this).attr('val');
	$('.basket #mo_conf .modal-footer button:first-child').attr('val', iddh);
});
//
$('#mo_conf .modal-footer button:first-child').click(function() {
	let iddh = $(this).attr('val'),
		err_log = $('#mo_conf .modal-body .err');
	err_log.addClass('d-none');
	let data = {
		iddh: iddh,
		act: 'discard'
	}
	sendJqXhr($_DOMAIN+'basket.php', 'POST', data, 'text', err_log);
});
//
/*function locateDrmn() {
	let w = window.outerWidth
	|| document.documentElement.clientWidth
	|| document.body.clientWidth;
	if (w > 1200) {
		console.log('j');
		$('.header .nav-header').append($('.header .sec-row .dropdown-menu'));
		$('.header .sec-row .dropdown-menu').addClass('d-block');
		$('.header .sec-row .dropdown-menu').remove();
	}
}
$(document).ready(locateDrmn);
$(window).resize(locateDrmn);*/
//
function rotateArrow() {
	let yon = $(this).find('.fa-angle-down').css("transform");

	if (isEmpty(yon)) {
		$(this).find('.fa-angle-down').css("transform", "rotate(180deg)");
	}
	else {
		$(this).find('.fa-angle-down').css("transform", "");
	}
}