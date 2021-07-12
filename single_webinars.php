<?php get_header();?>
<section class="single_webinar_title">
    <h2>Register for <span>Webinar</span></h2>
    <div class="single_webinar_description">
        Please complete the form and we will be in contact with you shortly.
    </div>
</section>

<section class="single_webinar">
    <div class="wrapper">
        <div class="single_webinar_body">
            <div class="single_webinar_body_left">
                <div class="webinar_item">
                    <?php the_post_thumbnail();?>
                    <div class="single_webinar_info">
                        <div class="webinar_title"><?php the_title(); $webinar_date = get_field('webinar_date');?></div>
                        <div class="webinar_meta">
                            <span class="webinar_meta_item webinar_meta_date"><?php echo $webinar_date;?></span>
                            <span class="webinar_meta_item webinar_meta_time"><?php the_field('webinar_time');?></span>
                            <span class="webinar_meta_item webinar_meta_duration"><?php the_field('webinar_duration');?></span>
                        </div>
                        <div class="webinar_content">
                            <?php the_content();?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $title = get_the_title(); $title_arr = explode(" ",$title); $title_string = implode("-",$title_arr);?>
            <?php $date_arr = explode(" ",$webinar_date); $webinar_string = implode("-",$date_arr);?>
            <?php $result_title = $title_string.'-'.$webinar_string;?>
            <div id="webinar_form" class="single_webinar_body_right contact_form_block">
                <div class="single_webinar_register cf_form">
                    <?php echo do_shortcode('[contact-form-7 id="8898" title="Register to Webinar" html_id="EOPNEW-'. $result_title. '"]');?>
                </div>
                <div class="cf_form after_submit_block after_webinar_block">
                    <img class="as_icon" src="<?php echo IMAGES;?>/checked_big.png" alt="" />
                    <div class="as_title">
                        Your seat is saved
                    </div>
                    <div class="as_description">
                        You’ve successfully registered to <?php the_title();?> webinar! You will receive a<br />
                        confirmation email as well as a reminder<br />
                        shortly before the webinar starts.
                    </div>
                    <a href="<?php echo get_category_link(150)?>" class="btn red_btn big_red_btn">Go to webinars</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>
