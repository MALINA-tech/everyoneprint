<?php
//Template Name: Login Page
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
    if($_GET['checkemail'] == 'confirm'){
        ?>
        <div class="lost_pass_form">
            <h2>
                Reset your <br />
                <span>Password</span>
            </h2>
            <div class="check_email">
                <img src="<?php echo IMAGES;?>/confirmation.png" alt="" />
                <h3>Check your mail</h3>
                <div class="check_description">
                    We have sent a password recover instructions to your email.
                </div>
                <a href="mailto:info@example.com" class="red_btn big_red_btn btn">Open email app</a>
                <div class="footer_check_description">
                    Didn’t receive the email? Check your spam folder, or <a href="<?php the_permalink(8588);?>">try another email address</a>
                </div>
            </div>
        </div>
        <?php
    }
    else if($_GET['errno'] == 'changed'){
        ?>
        <div class="lost_pass_form">
            <h2>
                Reset your <br />
                <span>Password</span>
            </h2>
            <div class="check_email">
                <img src="<?php echo IMAGES;?>/checked.png" alt="" />
                <h3>Password Reset</h3>
                <div class="check_description">
                    Your password has been reset successfully
                </div>
                <a href="<?php the_permalink(2849);?>" class="red_btn big_red_btn btn">Open Partner Zone</a>
            </div>
        </div>
        <?php
    }
    else{
        echo do_shortcode('[misha_custom_login]');
    }
    ?>
</div>
<?php get_footer();?>
