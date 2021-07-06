<div class="lost_pass_form auth_holder single_webinar_register">
    <h2>Reset your <br><span>password</span></h2>
    <div class="auth_alert"></div>
    <form id="lostpasswordform" action="" method="post" data-type="lostpassword" autocomplete="false">
        <p style="font-size:18px;">Please enter your username or email <br> address. You will receive a link to create a <br> new password via email.</p>
        <div class="input_title">
            <label for="user_login">Username or E-mail</label>
        </div>
        <input type="text" required="" name="user_login" id="user_login" placeholder="">
        <input type="submit" name="submit" id="wp-submit" class="button-primary btn red_btn cf_btn" value="Get new password" />
        <div class="bottom">
            <span class="remember">Remember your password?</span>
            <a href="/login/" class="login_link">Log in</a>
        </div>
    </form>
</div>

<div class="lost_pass_form after_submit_block">
    <h2>
        Reset your <br>
        <span>Password</span>
    </h2>
    <div class="check_email">
        <img src="<?= get_template_directory_uri() ?>/assets/img/confirmation.png" alt="" class="lazyloaded" data-ll-status="loaded">
        <h3>Check your mail</h3>
        <div class="check_description">
            We have sent a password recover instructions to your email.
        </div>
        <a href="mailto:info@example.com" class="red_btn big_red_btn btn">Open email app</a>
        <div class="footer_check_description">
            Didn’t receive the email? Check your spam folder, or <a href="">try another email address</a>
        </div>
    </div>
</div>