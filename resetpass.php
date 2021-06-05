<?php
//Template Name: Reset Password
get_header('forms');?>
<div class="wrapper form_wrapper">
    <?php
    while(have_posts()){ the_post();
        $current_content = get_the_content(null,null,get_the_ID());
        if($current_content != ''){
            the_content();
        }else{
            do_action('gdlr_core_print_page_builder');
        }
    }
    //echo do_shortcode('[misha_custom_passreset]');
    ?>
    <div class="lost_pass_form">
        <h2>Reset your <br /><span>password</span></h2>
        <form name="resetpassform" id="resetpassform" action="<?php  site_url('wp-login.php?action=resetpass');?>" method="post" autocomplete="off">
            <input type="hidden" id="user_login" name="login" value="' . esc_attr( $_REQUEST['login'] ) . '" autocomplete="off" />
            <input type="hidden" name="key" value="' . esc_attr( $_REQUEST['key'] ) . '" />
            <h3>Create new password</h3>
            <div class="attention">
                Your new password must be different from previous used passwords.
            </div>
            <div class="input_title">
                <label for="pass1">Password</label>
            </div>
            <div class="pass_wrapper">
                <input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" />
                <a href="#" class="show_pass"></a>
            </div>
            <ul class="check">
                <li id="length">Must be at least 8 characters.</li>
                <li id="lowercase">Must have at least 1 lowercase character.</li>
                <li id="numb">Must have at least 1 number.</li>
                <li id="upper">Must have at least 1 upercase character.</li>
            </ul>
            <div class="input_title">
                <label for="pass2">Confirm password</label>
            </div>
            <div class="pass_wrapper">
                <input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" />
                <a href="#" class="show_pass"></a>
            </div>
            <ul class="check">
                <li id="match">Both passwords must match.</li>
            </ul>
            <a href="#" class="reset_click btn red_btn">Reset password</a>
            <input type="submit" name="submit" id="resetpass-button" class="button btn red_btn" value="Reset password" />
        </form>
    </div>
</div>
<?php get_footer('nobanner');?>

