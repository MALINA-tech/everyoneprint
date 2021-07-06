<div class="login-form-container auth_holder">
  <h2>Partner Zone <br /><span>Log In</span></h2>

  <div class="auth_alert"></div>

  <form id="Loginform" action="" method="post" data-type="authorization" autocomplete="false">

    <div class="input_wrap">
      <div class="input_title">
        <label for="user_login">Username or E-mail</label>                   
      </div>                  
      <div class="pass_wrapper">                
        <input class="input_form" required type="text" name="auth_login" id="user_login" class="input" value="" size="20" tabindex="10" />
      </div>
    </div>
    <div class="input_wrap">
      <div class="input_title">
        <label for="user_pass">Password</label>                 
      </div>                    
      <div class="pass_wrapper">                
        <input class="input_form" required type="password" name="auth_password" id="user_pass" class="input" value="" size="20" tabindex="20" />
        <div class="show_password hide"><div class="icon"></div></div>
      </div>
    </div>
    <div class="input_wrap remember_footer">
      <div class="input_col">
        <label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /><span>Remember me</span></label>
      </div>
      <div class="input_col right"><a href="<?= esc_url( wp_lostpassword_url() ); ?>"><span>Lost password?</span></a></div>
    </div>

    <p class="login-submit">
      <input type="submit" name="submit" id="wp-submit" class="button-primary btn red_btn" value="Log In" tabindex="100" />
    </p>
    
    <div class="sub_footer">
      <span>Don’t have an account?</span>
      <a href="<?= wp_registration_url() ?>" class="">Sign up</a>
    </div>

  </form>

</div>