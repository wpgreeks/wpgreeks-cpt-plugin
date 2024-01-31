<div class="login-container">
    <form id="wpgreeks-login-form" method="post" action="#" class="login-form">
        <h2>Welcome Back</h2>
        <p>Please login to your account</p>
        <p class="status"></p>
        <div class="form-group">
            <label for="username">Username or Email Address</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
        </div>
        <div class="login-form-btn-action">
            <button type="submit" name="submit" class="btn btn-primary btn-dark">LOG IN</button>
            <a href="<?php echo wp_lostpassword_url(); ?>">Request a new password?</a>

            <input type="hidden" name="action" value="wpgreeks_login_form">
            <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
        </div>
    </form>
</div>