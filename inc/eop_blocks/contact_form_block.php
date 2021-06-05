<?php
    $style = get_sub_field('style');
    $red_title = get_sub_field('red_title');
    $main_title = get_sub_field('main_title');
    $content = get_sub_field('content');
?>
<section class="contact_form_block">
    <div class="wrapper">
        <div class="cf_block">
            <div class="cf_left">
                <?php if($red_title != ''){ ?><div class="red_title"><?php echo $red_title;?></div><?php };?>
                <?php if($main_title != ''){ ?><h2 class=""><?php echo $main_title;?></h2><?php };?>
                <?php if($content != ''){ ?><div class="content"><?php echo $content;?></div><?php };?>
            </div>
            <div class="cf_right">
                <div class="cf_form">
                    <?php echo do_shortcode('[contact-form-7 id="95" title="Contact Form" html_class="test_forming" html_id="EOPNEW-Contact_Us_Form"]');?>
                    <?php //echo do_shortcode('[hubspot type=form portal=6324993 id=d7106ba1-0219-4e2c-ae40-d30d3b9cfaa9]');?>
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
