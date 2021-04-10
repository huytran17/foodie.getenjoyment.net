
$('.list input[type="checkbox"]').eq(0).change(function() {
    $('.list input[type="checkbox"]').prop('checked', $(this).prop('checked'));
});
$('#formSignIn input').keyup(function(event) {
    if (event.keyCode == 13) {
        $('#submitSignin').click();
    }
});
//
$('#formUpAvt').submit(function(event) {
    event.preventDefault();
    let img_val = $('#formUpAvt #inpUpAvt').val(),
        err_log = $('#errUpAvt'),
        progress_bar = $('#formUpAvt .progress-bar');
    err_log.addClass('d-none');
    if (img_val) {
        let size_img = $('#inpUpAvt')[0].files[0].size,
            type_img = $('#inpUpAvt')[0].files[0].type;
        if (size_img > 5242880) {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có dung lượng lớn hơn mức cho phép, vui lòng chọn lại');
        }
        else if (type_img != 'image/jpeg' && type_img != 'image/png' && type_img != 'image/gif' && type_img != 'image/jpg' && type_img != 'image/webp') {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có định dạng không phù hợp');
        }
        else {
            if (!isBusy) {
                isBusy = true;
                $(this).ajaxSubmit({
                    beforeSubmit: () => {
                        target: err_log,
                        $('#formUpAvt .box-progress-bar').removeClass('d-none');
                        progress_bar.width('0%');
                    },
                    uploadProgress: (event, position, total, percent) => {
                        progress_bar.animate({width: percent + '%'});
                        progress_bar.html(percent + '%');
                    },
                    success: data => {
                        err_log.html(data);
                    },
                    error: () => {
                        err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
                    },
                    always: () => {
                        isBusy = false;
                    },
                    resetForm: true
                });
                return false;
            }
            else return false;
        }
    }
    else err_log.removeClass('d-none').find('i').html('*Bạn chưa chọn ảnh');
});
//
$('#formAddThumbNsx').submit(function(event) {
    event.preventDefault();
    let img_val = $('#formAddThumbNsx #inpAddThumbNsx').val(),
        err_log = $('#errAddThumbNsx'),
        progress_bar = $('#formAddThumbNsx .progress-bar');
    err_log.addClass('d-none');
    if (img_val) {
        let size_img = $('#inpAddThumbNsx')[0].files[0].size,
            type_img = $('#inpAddThumbNsx')[0].files[0].type;
        if (size_img > 5242880) {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có dung lượng lớn hơn mức cho phép, vui lòng chọn lại');
        }
        else if (type_img != 'image/jpeg' && type_img != 'image/png' && type_img != 'image/gif' && type_img != 'image/jpg' && type_img != 'image/webp') {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có định dạng không phù hợp');
        }
        else {
            if (!isBusy) {
                isBusy = true;
                $(this).ajaxSubmit({
                    beforeSubmit: () => {
                        target: err_log,
                        $('#formAddThumbNsx .box-progress-bar').removeClass('d-none');
                        progress_bar.width('0%');
                    },
                    uploadProgress: (event, position, total, percent) => {
                        progress_bar.animate({width: percent + '%'});
                        progress_bar.html(percent + '%');
                    },
                    success: data => {
                        err_log.html(data);
                    },
                    error: () => {
                        err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
                    },
                    always: () => {
                        isBusy = false;
                    },
                    resetForm: true
                });
                return false;
            }
            else return false;
        }
    }
    else err_log.removeClass('d-none').find('i').html('*Bạn chưa chọn ảnh');
});
//
$('#formEditThumbNsx').submit(function(event) {
    event.preventDefault();
    let img_val = $('#formEditThumbNsx #inpEditThumbNsx').val(),
        err_log = $('#errEditThumbNsx'),
        progress_bar = $('#formEditThumbNsx .progress-bar');
    err_log.addClass('d-none');
    if (img_val) {
        let size_img = $('#inpEditThumbNsx')[0].files[0].size,
            type_img = $('#inpEditThumbNsx')[0].files[0].type;
        if (size_img > 5242880) {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có dung lượng lớn hơn mức cho phép, vui lòng chọn lại');
        }
        else if (type_img != 'image/jpeg' && type_img != 'image/png' && type_img != 'image/gif' && type_img != 'image/jpg' && type_img != 'image/webp') {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có định dạng không phù hợp');
        }
        else {
            if (!isBusy) {
                isBusy = true;
                $(this).ajaxSubmit({
                    beforeSubmit: () => {
                        target: err_log,
                        $('#formEditThumbNsx .box-progress-bar').removeClass('d-none');
                        progress_bar.width('0%');
                    },
                    uploadProgress: (event, position, total, percent) => {
                        progress_bar.animate({width: percent + '%'});
                        progress_bar.html(percent + '%');
                    },
                    success: data => {
                        //location.reload();
                        err_log.html(data);
                    },
                    error: () => {
                        err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
                    },
                    always: () => {
                        isBusy = false;
                    },
                    resetForm: true
                });
                return false;
            }
            else return false;
        }
    }
    else err_log.removeClass('d-none').find('i').html('*Bạn chưa chọn ảnh');
});
//
$('#formEditFoodThumb').submit(function(event) {
    event.preventDefault();
    let img_val = $('#formEditFoodThumb #inpEditThumbFood').val(),
        err_log = $('#errEditThumbFood'),
        progress_bar = $('#formEditFoodThumb .progress-bar');
    err_log.addClass('d-none');
    if (img_val) {
        let size_img = $('#inpEditThumbFood')[0].files[0].size,
            type_img = $('#inpEditThumbFood')[0].files[0].type;
        if (size_img > 5242880) {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có dung lượng lớn hơn mức cho phép, vui lòng chọn lại');
        }
        else if (type_img != 'image/jpeg' && type_img != 'image/png' && type_img != 'image/gif' && type_img != 'image/jpg' && type_img != 'image/webp') {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có định dạng không phù hợp');
        }
        else {
            if (!isBusy) {
                isBusy = true;
                $(this).ajaxSubmit({
                    beforeSubmit: () => {
                        target: err_log,
                        $('#formEditFoodThumb .box-progress-bar').removeClass('d-none');
                        progress_bar.width('0%');
                    },
                    uploadProgress: (event, position, total, percent) => {
                        progress_bar.animate({width: percent + '%'});
                        progress_bar.html(percent + '%');
                    },
                    success: data => {
                        //location.reload();
                        err_log.html(data);
                    },
                    error: () => {
                        err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
                    },
                    always: () => {
                        isBusy = false;
                    },
                    resetForm: true
                });
                return false;
            }
            else return false;
        }
    }
    else err_log.removeClass('d-none').find('i').html('*Bạn chưa chọn ảnh');
});
$('#formEditFoodAvt').submit(function(event) {
    event.preventDefault();
    let img_val = $('#formEditFoodAvt #inpEditFoodAvt').val(),
        err_log = $('#errEditFoodAvt'),
        progress_bar = $('#formEditFoodAvt .progress-bar');
    err_log.addClass('d-none');
    if (img_val) {
        let size_img = $('#inpEditFoodAvt')[0].files[0].size,
            type_img = $('#inpEditFoodAvt')[0].files[0].type;
        if (size_img > 5242880) {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có dung lượng lớn hơn mức cho phép, vui lòng chọn lại');
        }
        else if (type_img != 'image/jpeg' && type_img != 'image/png' && type_img != 'image/gif' && type_img != 'image/jpg' && type_img != 'image/webp') {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có định dạng không phù hợp');
        }
        else {
            if (!isBusy) {
                isBusy = true;
                $(this).ajaxSubmit({
                    beforeSubmit: () => {
                        target: err_log,
                        $('#formEditFoodAvt .box-progress-bar').removeClass('d-none');
                        progress_bar.width('0%');
                    },
                    uploadProgress: (event, position, total, percent) => {
                        progress_bar.animate({width: percent + '%'});
                        progress_bar.html(percent + '%');
                    },
                    success: data => {
                        //location.reload();
                        err_log.html(data);
                    },
                    error: () => {
                        err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
                    },
                    always: () => {
                        isBusy = false;
                    },
                    resetForm: true
                });
                return false;
            }
            else return false;
        }
    }
    else err_log.removeClass('d-none').find('i').html('*Bạn chưa chọn ảnh');
});
$('#formAddSlide').submit(function(event) {
    event.preventDefault();
    let img_val = $('#formAddSlide #inpAddSlide').val(),
        err_log = $('#errUpSlide'),
        progress_bar = $('#formAddSlide .progress-bar');
    err_log.addClass('d-none');
    if (img_val) {
        let size_img = $('#inpAddSlide')[0].files[0].size,
            type_img = $('#inpAddSlide')[0].files[0].type;
        if (size_img > 5242880) {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có dung lượng lớn hơn mức cho phép, vui lòng chọn lại');
        }
        else if (type_img != 'image/jpeg' && type_img != 'image/png' && type_img != 'image/gif' && type_img != 'image/jpg' && type_img != 'image/webp') {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có định dạng không phù hợp');
        }
        else {
            if (!isBusy) {
                isBusy = true;
                $(this).ajaxSubmit({
                    beforeSubmit: () => {
                        target: err_log,
                        $('#formAddSlide .box-progress-bar').removeClass('d-none');
                        progress_bar.width('0%');
                    },
                    uploadProgress: (event, position, total, percent) => {
                        progress_bar.animate({width: percent + '%'});
                        progress_bar.html(percent + '%');
                    },
                    success: data => {
                        //location.reload();
                        err_log.html(data);
                    },
                    error: () => {
                        err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
                    },
                    always: () => {
                        isBusy = false;
                    },
                    resetForm: true
                });
                return false;
            }
            else return false;
        }
    }
    else err_log.removeClass('d-none').find('i').html('*Bạn chưa chọn ảnh');
});
$('#formAddCateThumb').submit(function(event) {
    event.preventDefault();
    let img_val = $('#formAddCateThumb #inpAddThumbCate').val(),
        err_log = $('#errAddThumbCate'),
        progress_bar = $('#formAddCateThumb .progress-bar');
    err_log.addClass('d-none');
    if (img_val) {
        let size_img = $('#inpAddThumbCate')[0].files[0].size,
            type_img = $('#inpAddThumbCate')[0].files[0].type;
        if (size_img > 5242880) {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có dung lượng lớn hơn mức cho phép, vui lòng chọn lại');
        }
        else if (type_img != 'image/jpeg' && type_img != 'image/png' && type_img != 'image/gif' && type_img != 'image/jpg' && type_img != 'image/webp') {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có định dạng không phù hợp');
        }
        else {
            if (!isBusy) {
                isBusy = true;
                $(this).ajaxSubmit({
                    beforeSubmit: () => {
                        target: err_log,
                        $('#formAddCateThumb .box-progress-bar').removeClass('d-none');
                        progress_bar.width('0%');
                    },
                    uploadProgress: (event, position, total, percent) => {
                        progress_bar.animate({width: percent + '%'});
                        progress_bar.html(percent + '%');
                    },
                    success: data => {
                        //location.reload();
                        err_log.html(data);
                    },
                    error: () => {
                        err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
                    },
                    always: () => {
                        isBusy = false;
                    },
                    resetForm: true
                });
                return false;
            }
            else return false;
        }
    }
    else err_log.removeClass('d-none').find('i').html('*Bạn chưa chọn ảnh');
});
//
$('#formEditInfoThumb').submit(function(event) {
    event.preventDefault();
    let img_val = $('#formEditInfoThumb #inpEditInfoThumb').val(),
        err_log = $('#errEditInfoThumb'),
        progress_bar = $('#formEditInfoThumb .progress-bar');
    err_log.addClass('d-none');
    if (img_val) {
        let size_img = $('#inpEditInfoThumb')[0].files[0].size,
            type_img = $('#inpEditInfoThumb')[0].files[0].type;
        if (size_img > 5242880) {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có dung lượng lớn hơn mức cho phép, vui lòng chọn lại');
        }
        else if (type_img != 'image/jpeg' && type_img != 'image/png' && type_img != 'image/gif' && type_img != 'image/jpg' && type_img != 'image/webp') {
            err_log.removeClass('d-none').find('i').html('*Tệp đã chọn có định dạng không phù hợp');
        }
        else {
            if (!isBusy) {
                isBusy = true;
                $(this).ajaxSubmit({
                    beforeSubmit: () => {
                        target: err_log,
                        $('#formEditInfoThumb .box-progress-bar').removeClass('d-none');
                        progress_bar.width('0%');
                    },
                    uploadProgress: (event, position, total, percent) => {
                        progress_bar.animate({width: percent + '%'});
                        progress_bar.html(percent + '%');
                    },
                    success: data => {
                        //location.reload();
                        err_log.html(data);
                    },
                    error: () => {
                        err_log.removeClass('d-none').find('i').html('*Đã xảy ra lỗi, vui lòng thử lại sau');
                    },
                    always: () => {
                        isBusy = false;
                    },
                    resetForm: true
                });
                return false;
            }
            else return false;
        }
    }
    else err_log.removeClass('d-none').find('i').html('*Bạn chưa chọn ảnh');
});
function sendJqXhr(url, type, data, dataType, doneCallback, failCallback, alwaysCallback) {
    $.ajax({
        url : url,
        type: type,
        dataType: dataType,
        data: data
    })
    .done(doneCallback)
    .fail(failCallback)
    .always(alwaysCallback);
}
//
function isEmpty(variable) {
    if (variable === '' || variable === null || variable === 'undefined' || variable === false) {
        return true;
    }
    else return false;
}
//
function preViewAvt() {
    $img_val = $('.formUpAvt .inp_up_avt').val();
    $box_pre_img = $('.formUpAvt .box-pre-img');
    if ($img_val != '') {
        $box_pre_img.removeClass('d-none');
        $('.formUpAvt .box-pre-img img').remove();
        $box_pre_img.append('<img src="'+URL.createObjectURL(event.target.files[0])+'" alt="no image" style="border: 1px solid #ddd; width: 190px; height: 190px; margin-right: 5px; margin-bottom: 5px;">');
    }
    else {
        $box_pre_img.html('');
        $box_pre_img.addClass('d-none');
    }
}
//
function preViewAvtS() {
    $img_val = $('#formEditFoodAvt .inp_up_avt').val();
    $box_pre_img = $('#formEditFoodAvt .box-pre-img');
    if ($img_val != '') {
        $box_pre_img.removeClass('d-none');
        $('#formEditFoodAvt .box-pre-img img').remove();
        $box_pre_img.append('<img src="'+URL.createObjectURL(event.target.files[0])+'" alt="no image" style="border: 1px solid #ddd; width: 190px; height: 190px; margin-right: 5px; margin-bottom: 5px;">');
    }
    else {
        $box_pre_img.html('');
        $box_pre_img.addClass('d-none');
    }
}
//
function calcSale() {
    var begin = parseFloat($('#priceEditFood').val()),
        percent = parseFloat($('#saleEditFood').val()),
        btnEdit = $('#btnEditFood'),
        errSaleEditFood = $('#errSaleEditFood');
    errSaleEditFood.addClass('d-none');
    //console.log(percent);
    if (percent < 0 || percent > 100 || isEmpty(percent) || isNaN(percent)) {
        errSaleEditFood.removeClass('d-none').find('i').text('*Vui lòng nhập trong khoảng 0 - 100');
        btnEdit.attr('disabled', 'disabled');
        return false;
    }
    else {
        var result = begin - (begin * (percent / 100));
        $('#newPriceEditFood').val(Math.round(parseFloat(result)));
        btnEdit.removeAttr('disabled');
    }
    return true;
}
//
$('#saleEditFood').keyup(calcSale);
$('#saleEditFood').change(calcSale);
$('#priceEditFood').keyup(calcSale);
//
function onlyNum(needle, erl, btn) {
    let num = parseFloat($(needle).val()),
        err_log = $(erl),
        btn_submit = $(btn);
    err_log.addClass('d-none');
    //console.log(num);
    if (isNaN(num) || isEmpty(num)) {
        err_log.removeClass('d-none').find('i').html('*Định dạng không hợp lệ');
        btn_submit.attr('disabled', 'disabled');
        return false;
    }
    else {
        btn_submit.removeAttr('disabled');
    }
    return true;
}
//
$('#priceEditFood').keyup(function(){
    onlyNum('#priceEditFood', '#errPriceEditFood', '#btnEditFood')
});
//
$('#priceAddFood').keyup(function(){
    onlyNum('#priceAddFood', '#errPriceAddFood', '#btnAddFood');
});
//
var md5 = function (string) {
 
        function RotateLeft(lValue, iShiftBits) {
            return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));
        }
 
        function AddUnsigned(lX,lY) {
            var lX4,lY4,lX8,lY8,lResult;
            lX8 = (lX & 0x80000000);
            lY8 = (lY & 0x80000000);
            lX4 = (lX & 0x40000000);
            lY4 = (lY & 0x40000000);
            lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);
            if (lX4 & lY4) {
                return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
            }
            if (lX4 | lY4) {
                if (lResult & 0x40000000) {
                    return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
                } else {
                    return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
                }
            } else {
                return (lResult ^ lX8 ^ lY8);
            }
        }
 
        function F(x,y,z) {
            return (x & y) | ((~x) & z);
        }
        function G(x,y,z) {
            return (x & z) | (y & (~z));
        }
        function H(x,y,z) {
            return (x ^ y ^ z);
        }
        function I(x,y,z) {
            return (y ^ (x | (~z)));
        }
 
        function FF(a,b,c,d,x,s,ac) {
            a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));
            return AddUnsigned(RotateLeft(a, s), b);
        };
 
        function GG(a,b,c,d,x,s,ac) {
            a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));
            return AddUnsigned(RotateLeft(a, s), b);
        };
 
        function HH(a,b,c,d,x,s,ac) {
            a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));
            return AddUnsigned(RotateLeft(a, s), b);
        };
 
        function II(a,b,c,d,x,s,ac) {
            a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));
            return AddUnsigned(RotateLeft(a, s), b);
        };
 
        function ConvertToWordArray(string) {
            var lWordCount;
            var lMessageLength = string.length;
            var lNumberOfWords_temp1=lMessageLength + 8;
            var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64;
            var lNumberOfWords = (lNumberOfWords_temp2+1)*16;
            var lWordArray=Array(lNumberOfWords-1);
            var lBytePosition = 0;
            var lByteCount = 0;
            while ( lByteCount < lMessageLength ) {
                lWordCount = (lByteCount-(lByteCount % 4))/4;
                lBytePosition = (lByteCount % 4)*8;
                lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount)<<lBytePosition));
                lByteCount++;
            }
            lWordCount = (lByteCount-(lByteCount % 4))/4;
            lBytePosition = (lByteCount % 4)*8;
            lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition);
            lWordArray[lNumberOfWords-2] = lMessageLength<<3;
            lWordArray[lNumberOfWords-1] = lMessageLength>>>29;
            return lWordArray;
        };
 
        function WordToHex(lValue) {
            var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;
            for (lCount = 0;lCount<=3;lCount++) {
                lByte = (lValue>>>(lCount*8)) & 255;
                WordToHexValue_temp = "0" + lByte.toString(16);
                WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);
            }
            return WordToHexValue;
        };
 
        function Utf8Encode(string) {
            string = string.replace(/\r\n/g,"\n");
            var utftext = "";
 
            for (var n = 0; n < string.length; n++) {
 
                var c = string.charCodeAt(n);
 
                if (c < 128) {
                    utftext += String.fromCharCode(c);
                }
                else if((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
                else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
 
            }
 
            return utftext;
        };
 
        var x=Array();
        var k,AA,BB,CC,DD,a,b,c,d;
        var S11=7, S12=12, S13=17, S14=22;
        var S21=5, S22=9 , S23=14, S24=20;
        var S31=4, S32=11, S33=16, S34=23;
        var S41=6, S42=10, S43=15, S44=21;
 
        string = Utf8Encode(string);
 
        x = ConvertToWordArray(string);
 
        a = 0x67452301;
        b = 0xEFCDAB89;
        c = 0x98BADCFE;
        d = 0x10325476;
 
        for (k=0;k<x.length;k+=16) {
            AA=a;
            BB=b;
            CC=c;
            DD=d;
            a=FF(a,b,c,d,x[k+0], S11,0xD76AA478);
            d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756);
            c=FF(c,d,a,b,x[k+2], S13,0x242070DB);
            b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE);
            a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF);
            d=FF(d,a,b,c,x[k+5], S12,0x4787C62A);
            c=FF(c,d,a,b,x[k+6], S13,0xA8304613);
            b=FF(b,c,d,a,x[k+7], S14,0xFD469501);
            a=FF(a,b,c,d,x[k+8], S11,0x698098D8);
            d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF);
            c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);
            b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE);
            a=FF(a,b,c,d,x[k+12],S11,0x6B901122);
            d=FF(d,a,b,c,x[k+13],S12,0xFD987193);
            c=FF(c,d,a,b,x[k+14],S13,0xA679438E);
            b=FF(b,c,d,a,x[k+15],S14,0x49B40821);
            a=GG(a,b,c,d,x[k+1], S21,0xF61E2562);
            d=GG(d,a,b,c,x[k+6], S22,0xC040B340);
            c=GG(c,d,a,b,x[k+11],S23,0x265E5A51);
            b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);
            a=GG(a,b,c,d,x[k+5], S21,0xD62F105D);
            d=GG(d,a,b,c,x[k+10],S22,0x2441453);
            c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681);
            b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);
            a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6);
            d=GG(d,a,b,c,x[k+14],S22,0xC33707D6);
            c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87);
            b=GG(b,c,d,a,x[k+8], S24,0x455A14ED);
            a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905);
            d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8);
            c=GG(c,d,a,b,x[k+7], S23,0x676F02D9);
            b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);
            a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942);
            d=HH(d,a,b,c,x[k+8], S32,0x8771F681);
            c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122);
            b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);
            a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44);
            d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9);
            c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60);
            b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);
            a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6);
            d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA);
            c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085);
            b=HH(b,c,d,a,x[k+6], S34,0x4881D05);
            a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039);
            d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);
            c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);
            b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665);
            a=II(a,b,c,d,x[k+0], S41,0xF4292244);
            d=II(d,a,b,c,x[k+7], S42,0x432AFF97);
            c=II(c,d,a,b,x[k+14],S43,0xAB9423A7);
            b=II(b,c,d,a,x[k+5], S44,0xFC93A039);
            a=II(a,b,c,d,x[k+12],S41,0x655B59C3);
            d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92);
            c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D);
            b=II(b,c,d,a,x[k+1], S44,0x85845DD1);
            a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F);
            d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);
            c=II(c,d,a,b,x[k+6], S43,0xA3014314);
            b=II(b,c,d,a,x[k+13],S44,0x4E0811A1);
            a=II(a,b,c,d,x[k+4], S41,0xF7537E82);
            d=II(d,a,b,c,x[k+11],S42,0xBD3AF235);
            c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB);
            b=II(b,c,d,a,x[k+9], S44,0xEB86D391);
            a=AddUnsigned(a,AA);
            b=AddUnsigned(b,BB);
            c=AddUnsigned(c,CC);
            d=AddUnsigned(d,DD);
        }
 
        var temp = WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);
 
        return temp.toLowerCase();
    }
$('#or_filter').change(function() {
    let type = $(this).val();
    $.ajax({
        url: $_DOMAIN +'orders.php',
        type: 'POST',
        dataType: 'text',
        data: {
            type: type,
            action: 'filter'
        }
    })
    .done(data=>{
        $('#list_order tbody').empty();
        $('#table_order .pagination').addClass('d-none');
        if (!isEmpty(data)) {
            let obj = JSON.parse(data),
                html = '';
        
            for (var i = 0; i < obj.length; i++) {
                html += '<tr>';
                    html += '<td><input type="checkbox" name="id_order[]" value="'+obj[i].iddh+'"></td>';
                    html += '<td>'+obj[i].iddh+'</td>';
                    html += '<td>'+obj[i].tenkh+'</td>';
                    html += '<td>'+obj[i].tensp+'</td>';
                    html += '<td>'+obj[i].dcnh+'</td>';
                    html += '<td>'+obj[i].sdt+'</td>';
                    html += '<td>'+obj[i].ngdh+'</td>';
                    html += '<td>'+obj[i].ngnhh+'</td>';
                    html += '<td>'+obj[i].slg+'</td>';
                    html += '<td>'+new Intl.NumberFormat().format(obj[i].thtien)+'</td>';
                    html += '<td>'+obj[i].trth+'</td>';
                    html += '<td>';
                        html += '<button type="button" class="btn btn-info btn-sm proc-order" di="'+obj[i].iddh+'"><span class="fa fa-spinner"></span></button>';
                        html += '<button type="button" class="btn btn-success btn-sm apply-order" di="'+obj[i].iddh+'"><span class="fa fa-check"></span></button>';
                    html +=  '</td>';
                html += '</tr>';
            }
            $('#list_order tbody').html(html);
        }
        else $('#list_order tbody').html('<h3 class="text-primary">Danh sách trống</h3>');
    })
    .fail(()=>{
        $('#list_order tbody').html('<h3>*Lỗi</h3>');
    });
});
$('#sp_filter').change(function() {
    let type = $(this).val();
    $.ajax({
        url: $_DOMAIN +'foods.php',
        type: 'POST',
        dataType: 'text',
        data: {
            type: type,
            action: 'filter'
        }
    })
    .done(data=>{
        $('#list_food tbody').empty();
        $('.pagination').addClass('d-none');
        if (!isEmpty(data)) {
            let obj = JSON.parse(data),
                html = '';
            
            for (var i = 0; i < obj.length; i++) {
                html += '<tr>';
                        html += '<td><input type="checkbox" name="id_order[]" value="'+obj[i].idsp+'"></td>';
                        html += '<td><a href="'+$_DOMAIN+'foods/edit/'+obj[i].idsp+'">'+obj[i].tensp+'</a></td>';
                        html += '<td>'+obj[i].tenchl+'</td>';
                        html += '<td>'+new Intl.NumberFormat().format(obj[i].gia)+'</td>';
                        html += '<td>'+obj[i].date+'</td>';
                        html += '<td>'+obj[i].sold+'</td>';
                        html += '<td>'+obj[i].stt+'</td>';
                        html += '<td>';
                            html += '<a href="'+$_DOMAIN+'foods/edit/'+obj[i].idsp+'" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a>';
                            html += '<button type="button" class="btn btn-danger btn-sm del-food" data-id="'+obj[i].idsp+'"><span class="fa fa-trash"></span></button>';
                        html += '</td>';
                html += '</tr>';
            }
            $('#list_food tbody').html(html);
        }
        else $('#list_order tbody').html('<h3 class="text-primary">Danh sách trống</h3>');
    })
    .fail(()=>{
        $('#list_food tbody').html('<h3>*Lỗi</h3>');
    });
});