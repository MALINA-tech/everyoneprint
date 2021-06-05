<!doctype html>
<html lang="ru">
<head>
    <title><?php echo NAME;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-cache">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="https://kit.fontawesome.com/14cb8d023c.js" crossorigin="anonymous"></script>
    <?php wp_head();?>
</head>
<?php $current_id = get_queried_object_id();?>
<?php $current_page_bg = get_field('page_bg',$current_id);?>
<?php $current_page_bg_style = get_field('bg_style',$current_id);?>
<body data-path="<?php echo get_template_directory_uri();?>" class="gdlr-core-body infinite-body">
<?php $eop_options = 'everyoneprint_options';?>
<div id="perfect" class="archive_webinar_bg">
<header>
    <div class="wrapper">
        <div class="header_second_top">
            <ul>
                <?php draim_menu('second_top_menu');?>
            </ul>
        </div>
        <div class="header_block">
            <div class="col_2 ib">
                <div class="header_logo">
                    <?php $header_logo = get_field('header_logo',$eop_options);?>
                    <?php if(is_front_page()){ ?>
                        <img src="<?php echo $header_logo['url']?>" alt="<?php echo $header_logo['alt']?>" />
                    <?php }else{ ?>
                        <a href="/">
                            <img src="<?php echo $header_logo['url']?>" alt="<?php echo $header_logo['alt']?>" />
                        </a>
                    <?php };?>
                </div>
            </div>
            <div class="col_10 ib">
                <div class="header_menu_wrapper">
                    <ul class="header_menu">
                        <?php draim_menu('top_menu');?>
                    </ul>
                    <a href="<?php the_permalink(20);?>" class="red_btn btn header_menu_btn">Try for free</a>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="header_mobile">
    <div class="wrapper">
        <div class="col_3 ib">
            <div class="header_logo">
                <?php $header_logo = get_field('header_logo',$eop_options);?>
                <?php if(is_front_page()){ ?>
                    <img src="<?php echo $header_logo['url']?>" alt="<?php echo $header_logo['alt']?>" />
                <?php }else{ ?>
                    <a href="/">
                        <img src="<?php echo $header_logo['url']?>" alt="<?php echo $header_logo['alt']?>" />
                    </a>
                <?php };?>
            </div>
        </div>
        <div class="col_9 ib">
            <a href="#" class="mobile_menu_toggle"><i class="fas fa-bars"></i></a>
        </div>
    </div>
    <div class="header_mobile_menu">
        <ul>
            <?php draim_menu('top_menu');?>
        </ul>
    </div>
</header>
<?php
$current_cat = get_queried_object_id();
$hero_image = get_field('blog_image','everyoneprint_options');
$hero_image_url = $hero_image['url'];
?>
    <section class="hero hero_blog" style="background-image: url(<?php echo $hero_image_url;?>);">
        <div class="wrapper">
            <div class="hero_title">EveryonePrint Webinars</div>
        </div>
    </section>
    <section class="hero_line webinar_hero_line">
        <div class="wrapper">
            <div class="hero_blog_menu">
                <ul>
                    <?php draim_menu('blog_menu');?>
                </ul>
            </div>
        </div>
    </section>
    <section class="webinars_list">
        <div class="wrapper">
            <?php $webinars = new WP_Query(array(
                'post_type'=>'webinars',
                'posts_per_page'=>4,
                'order'=>'ASC'
            ));?>
            <?php while($webinars->have_posts()){ $webinars->the_post(); $curr_id = get_the_ID();?>
                <div class="webinar_item">
                    <div class="webinar_col">
                        <div class="webinar_image">
                            <?php the_post_thumbnail();?>
                        </div>
                    </div>
                    <div class="webinar_col">
                        <div class="webinar_info">
                            <div class="webinar_title">
                                <?php the_title();?>
                            </div>
                            <div class="webinar_meta">
                                <span class="webinar_meta_item webinar_meta_date"><?php the_field('webinar_date');?></span>
                                <span class="webinar_meta_item webinar_meta_time"><?php the_field('webinar_time');?></span>
                                <span class="webinar_meta_item webinar_meta_duration"><?php the_field('webinar_duration');?></span>
                            </div>
                            <div class="webinar_content">
                                <?php the_excerpt();?>
                            </div>
                            <a href="<?php the_permalink();?>" class="btn red_btn">Register</a>
                        </div>
                    </div>
                </div>
            <?php };?>
        </div>
    </section>
<?php echo do_shortcode('[other_updates post_type="post" posts_per_page="2"]')?>
<?php get_footer();?>