<?php
//Template Name: Partner News
if(is_user_logged_in()){ ?>
    <?php get_template_part('portal/header-portalnew');?>
    <div id="portal_header" class="infinite-page-title-wrap infinite-style-small infinite-left-align portal_header_news">
        <div class="infinite-header-transparent-substitute"></div>
        <div class="infinite-page-title-container infinite-container">
            <div class="infinite-page-title-content infinite-item-pdlr">
                <h3 class="infinite-page-title">News</h3>
            </div>
        </div>
    </div>
    <?php echo do_shortcode('[news_block id=133]')?>
    <?php get_template_part('portal/footer-portal');?>
<?php }else{ ?>
    <?php $login_link = get_permalink(2849);?>
    <?php header('Location: '.$login_link);?>
<?php }?>