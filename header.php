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
<?php if($current_page_bg != ''){ ?>
<div id="perfect" style="background-image:url(<?php echo $current_page_bg?>);<?php echo $current_page_bg_style;?>" class="<?php if(is_front_page()){ ?>home_page<?php };?><?php if(is_page()){ ?> page_<?php echo $current_id;?> <?php };?>">
<?php }else{ ?>
<!--<div id="perfect" class="parallax-window" data-image-src="--><?php //echo IMAGES;?><!--/body_bg_new.png">-->
<div id="perfect" style="background-image: url(<?php echo IMAGES;?>/body_bg_new.png)" class="<?php if(is_front_page()){ ?>home_page<?php };?><?php if(is_page()){ ?> page_<?php echo $current_id;?> <?php };?>">
<?php };?>
<?php ?>
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
                    <a href="<?php the_permalink(8863);?>" class="red_btn btn header_menu_btn">Try for free</a>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="header_mobile">
    <div class="wrapper">
        <div class="col_6 ib">
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
        <div class="col_6 ib">
            <a href="#" class="mobile_menu_toggle"><i class="fas fa-bars"></i></a>
        </div>
    </div>
    <div class="header_mobile_menu">
        <ul>
			<?php draim_menu('mobile_menu');?>
        </ul>
    </div>
</header>