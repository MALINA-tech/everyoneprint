<?php
//Template Name: HCP Trial
get_header('forms');?>
<section class="single_webinar_title">
    <h2>Get your free <span>HCP trial</span></h2>
</section>

<section class="single_webinar form_request">
    <div class="wrapper">
        <div class="single_webinar_body">
            <div class="single_webinar_body_left">
                <div class="webinar_item">
                    <div class="webinar_content">
                        <?php the_content();?>
                    </div>
                </div>
            </div>
            <div id="webinar_form" class="single_webinar_body_right contact_form_block">
                <div class="single_webinar_register cf_form">
                    <?php echo do_shortcode('[contact-form-7 id="8900" html_name="HCP_Trial_Form" html_title="HCP Trial" html_id="EOPNEW-HCP_Trial_Form"]');?>
                </div>
                <div class="cf_form after_submit_block after_webinar_block">
                    <img class="as_icon" src="<?php echo IMAGES;?>/checked_big.png" alt="" />
                    <div class="as_title">
                        Thank you!
                    </div>
                    <div class="as_description">
                        We’ve received your message and we’ll get back to you shortly
                    </div>
                    <a href="<?php echo site_url();?>" class="btn red_btn big_red_btn">Go to homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer('nobanner');?>

