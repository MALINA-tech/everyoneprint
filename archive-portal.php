<?php if(is_user_logged_in()){ ?>
    <?php get_template_part('portal/header-portalnew');?>
    <div id="portal_header">
        <h3 class="infinite-page-title">Welcome to the Partner Zone</h3>
    </div>
    <div class="portal_main">
        <div class="wrapper">
            <h5>We work closely with our partners to provide continued support and a personal approach that cultivates long-lasting relationships.</h5>
            <div class="portal_content_line">
                <h1>What's new</h1>
                <a class="view_all_btn" href="<?php echo get_term_link(134,'newscategory')?>">View more</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <?php echo do_shortcode('[news_block id=134]')?>
    <?php get_template_part('portal/footer-portal');?>
<?php }else{ ?>
    <?php $login_link = wp_login_url(); ?>
    <?php header('Location: '.$login_link);?>
<?php }?>