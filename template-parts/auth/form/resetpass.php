<?php
$email = $_GET[ 'email' ];
?>

<div class="lost_pass_form auth_holder single_webinar_register">
  <h2>Reset your <br><span>password</span></h2>
  <div id="password-change-repeat">Пароли не совпадают</div>
	<form id="resetpassform" action="" method="post" data-type="resetpassword" autocomplete="false">
		<input type="hidden" id="user_login" name="login" value="<?= $email ?>" autocomplete="off">
		<h3>Create new password</h3>
		<div class="attention">
		    Your new password must be different from previous used passwords.
        </div>
        <div class="input_title">                
            <label for="user_pass">Password</label>
        </div>
        <div class="pass_wrapper">                
            <input type="password" name="user_pass" id="user_pass" class="input" value="" autocomplete="off">
            <div class="show_password hide"><div class="icon"></div></div>
        </div>
        <ul class="check">
           <li id="length">Must be at least 8 characters.</li> 
           <li id="lowercase">Must have at least 1 lowercase character.</li> 
           <li id="numb">Must have at least 1 number.</li> 
           <li id="upper">Must have at least 1 upercase character.</li> 
        </ul>
        <div class="input_title">    
            <label for="user_pass_repeat">Confirm password</label>
        </div>
        <div class="pass_wrapper">    
            <input type="password" name="user_pass_repeat" id="user_pass_repeat" class="input" value="" autocomplete="off"> 
            <div class="show_password hide"><div class="icon"></div></div>
        </div>
        <ul class="check">
           <li id="match">Both passwords must match.</li>
        </ul>
      <input type="submit" name="submit" id="wp-submit" disabled="disabled" class="button-primary btn red_btn change-pass form-send-btn" value="Reset password" tabindex="100" />
    </form>
</div>

<div class="lost_pass_form after_submit_block">
    <h2>
        Reset your <br>
        <span>Password</span>
    </h2>
    <div class="check_email">
        <img src="<?= get_template_directory_uri() ?>/images/checked.png" alt="" class="lazyloaded" data-ll-status="loaded"><noscript>&lt;img src="https://everyoneprint.com/wp-content/themes/everyoneprint/images/checked.png" alt="" /&gt;</noscript>
        <h3>Password Reset</h3>
        <div class="check_description">
            Your password has been reset successfully
        </div>
        <a href="/login/" class="red_btn big_red_btn btn">Open Partner Zone</a>
    </div>
</div>