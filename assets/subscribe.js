//set cookies
function setSubscribeCookies() {
    var date = new Date(new Date().getTime() + 2592000000);
    document.cookie = "my_subscribe=1; expires=" + date.toUTCString();
}

//if click on close subscribe bar
$(".subscribe__close").click(function() {
    setSubscribeCookies();
    setTimeout(hideWidget, 1000);
});


//functions for displaying the form
function showWidget() {
    $(".subscribe__wrap").show(1500);
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
if (getCookie('my_subscribe')) {

} else {
    setTimeout(showWidget, 1000);
}


function hideWidget() {
    $(".subscribe__wrap").hide(1500);
}

jQuery(document).ready(function() {
    //valid keyup Enter
    $('.subscribe__form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            var email = jQuery('.subscribe__email');
            if (pattern.test($(email).val())) {
                $(email).removeClass('error');
                $(email).addClass('success');
            } else {
                $(email).addClass('error');
            }
            return false;
        }
    });
    //validation email
    jQuery('.subscribe__email').blur(function() {
        if ($(this).val() != '') {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
            if (pattern.test($(this).val())) {
                $(this).removeClass('error');
                $(this).addClass('success');
            } else {
                $(this).addClass('error');
            }
        }
    });


    //send data and validation
    jQuery('.subscribe__send').click(function() {
        var data = $('.subscribe__form').serialize();
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        if (pattern.test($('.subscribe__email').val())) {
            $('.subscribe__email').removeClass('error');
            $('.subscribe__email').addClass('success');
            var url = window.location.href;
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(res) {
                    $('.subscribe__email').val('');
                    $('.subscribe__header').html('Поздравляем, Вы оформили подписку');
                    setSubscribeCookies();
                    setTimeout(hideWidget, 4000);
                },
                error: function() {
                    $('.subscribe__email').val('');
                    $('.subscribe__email').attr('placeholder', 'Произошла ошибка попробуйте еще раз');
                    $('.subscribe__email').addClass('error');
                }
            });
        } else {
            $('.subscribe__email').removeClass('success');
            $('.subscribe__email').addClass('error');
        }

    });


});