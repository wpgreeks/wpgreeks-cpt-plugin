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

    $("form[name='register-form']").validate({

        // Specify validation rules
        rules: {
          new_user_name: "required",
          new_user_email: {
            required: true,
            email: true
          },
          new_user_password: {
            required: true,
            minlength: 5
          }
        },

        // Specify validation error messages
        messages: {
          new_user_name: "Please enter your username",
          new_user_password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          new_user_email: "Please enter a valid email address"
        },

        submitHandler: function(form) {
            var newUserName = jQuery('#new-username').val();
            var newUserEmail = jQuery('#new-useremail').val();
            var newUserPassword = jQuery('#new-userpassword').val();
            jQuery.ajax({
                type:"POST",
                url: ajax_wpgreeks_login.ajaxurl,
                data: {
                    action: "wpgreeks_signup",
                    new_user_name : newUserName,
                    new_user_email : newUserEmail,
                    new_user_password : newUserPassword
                },
                success: function(results){
                    jQuery('.register-message').text(results).show();
                },
                error: function(results) {
                }
            });
        }
      });

});