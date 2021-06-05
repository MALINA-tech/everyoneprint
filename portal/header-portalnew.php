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
<body>
<?php $eop_options = 'everyoneprint_options';?>
<?php if($current_page_bg != ''){ ?>
<div id="perfect_portal" style="background-image:url(<?php echo $current_page_bg?>);<?php the_field('bg_style');?>">
    <?php }else{ ?>
    <div id="perfect_portal">
        <?php };?>
        <?php ?>
        <header>
            <div class="wrapper">
                <div class="header_block">
                    <div class="back_link_wrapper back_link_wrapper_mobile">
                        <a class="back_link back_link_mobile" href="<?php echo esc_url(home_url('/'));?>">Back to Everyone Print</a>
                        <a class="back_link back_link_logout" href="<?php echo wp_logout_url(); ?>">
                            Logout
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                    <div class="col_4 ib">
                        <div class="header_logo">
                            <?php $header_logo = get_field('header_logo',$eop_options);?>
                            <?php if(is_front_page()){ ?>
                                <img src="<?php echo $header_logo['url']?>" alt="<?php echo $header_logo['alt']?>" />
                            <?php }else{ ?>
                                <a href="<?php echo get_post_type_archive_link('portal');?>">
                                    <img src="<?php echo $header_logo['url']?>" alt="<?php echo $header_logo['alt']?>" />
                                </a>
                            <?php };?>
                        </div>
                    </div>
                    <div class="col_8 ib">
                        <div class="header_menu_wrapper">
                            <ul class="header_menu">
                                <?php draim_menu('portal_header_menu');?>
                            </ul>
                            <div class="draim_search">
                                <a href="#" class="portal_open_search">
                                    <i class="fas fa-search"></i>
                                </a>
                            </div>
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
                    <?php draim_menu('portal_header_menu');?>
                </ul>
            </div>
        </header>
        <div id="search_float">
            <form class="portal_search_form" method="get" action="<?php the_permalink(7911);?>">
                <input required type="text" name="search_val" id="portal_search_input" />
                <input type="submit" id="portal_search_submit" value="Go" />
            </form>
        </div>