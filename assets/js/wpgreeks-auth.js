jQuery(document).ready(function($) {
    $('form#wpgreeks-login-form').on('submit', function(e){
        $('form#wpgreeks-login-form p.status').show().html(ajax_wpgreeks_login.loadingmessage).addClass(ajax_wpgreeks_login.infoclass).removeClass('error');
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
                $('form#wpgreeks-login-form p.status').html(data.message).addClass(data.class);
                if (data.status == true){
                    document.location.href = ajax_wpgreeks_login.redirecturl;
                }
            }
        });
        e.preventDefault();
    });

    jQuery('#register-button').on('click',function(e){
        e.preventDefault();
        var newUserName = jQuery('#new-username').val();
        var newUserEmail = jQuery('#new-useremail').val();
        var newUserPassword = jQuery('#new-userpassword').val();
        jQuery.ajax({
            type:"POST",
            url: ajax_wpgreeks_login.ajaxurl,
            data: {
                action: "register_user_front_end",
                new_user_name : newUserName,
                new_user_email : newUserEmail,
                new_user_password : newUserPassword
            },
            success: function(results){
                console.log(results);
                jQuery('.register-message').text(results).show();
            },
            error: function(results) {
            }
        });
    });

});