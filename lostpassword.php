<?php
//Template Name: Lost Password
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
    echo do_shortcode('[misha_custom_passreset]');
    ?>
</div>
<?php get_footer('nobanner');?>
