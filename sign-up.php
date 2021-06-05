<?php
//Template Name: Sign Up
get_header('forms');?>
<section class="single_webinar_title">
    <h2>Sign up for EveryonePrint <br /><span>Partner Zone</span></h2>
</section>

<section class="single_webinar form_request">
    <div class="wrapper">
        <div class="single_webinar_body">
            <div class="single_webinar_body_left">
                <div class="webinar_content">
                    <?php the_content();?>
                </div>
            </div>
            <div id="webinar_form" class="single_webinar_body_right contact_form_block">
                <div class="single_webinar_register cf_form">
                    <?php echo do_shortcode('[contact-form-7 id="8901" title="Sign Up Form" html_id="EOPNEW-Sign_Up_Form"]');?>
                </div>
                <div class="cf_form after_submit_block">
                    <img class="as_icon" src="<?php echo IMAGES;?>/confirm_icon.png" alt="" />
                    <div class="as_title">
                        Thank you for getting<br />
                        in contact with us.
                    </div>
                    <div class="as_description">
                        We have now received your request regarding:<br />
                        Partner Zone Signup Request.<br />
                        We will be in contact with you shortly.<br />
                        Thanks in advance – and have a great day.<br />
                        <br />
                        Best regards<br />
                        <strong>The EveryonePrint Team</strong>
                    </div>
                    <a href="#" class="btn red_btn big_red_btn resend">Resend</a>
                    <div class="as_footer">
                        Didn’t receive the email? Check your spam folder, or<br /><a href="#" class="resend"> try another email address</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>

