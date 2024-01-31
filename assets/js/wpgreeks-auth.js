jQuery(document).ready(function($) {
    $('form#wpgreeks-login-form').on('submit', function(e){
        $('form#wpgreeks-login-form p.status').show().html(ajax_wpgreeks_login.loadingmessage);
        setTimeout(function() {
            $("form#wpgreeks-login-form p.status").hide('blind', {}, 500)
        }, 5000);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_wpgreeks_login.ajaxurl,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#wpgreeks-login-form #username').val(), 
                'password': $('form#wpgreeks-login-form #password').val(), 
                'security': $('form#wpgreeks-login-form #security').val()
              },
            success: function(data){
                $('form#wpgreeks-login-form p.status').html(data.message);
                if (data.status == true){
                    document.location.href = ajax_wpgreeks_login.redirecturl;
                }
            }
        });
        e.preventDefault();
    });

});