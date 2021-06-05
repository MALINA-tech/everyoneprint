<?php get_template_part('portal/header-portalnew');?>
    <div id="portal_header" class="infinite-page-title-wrap  infinite-style-small infinite-left-align">
        <div class="infinite-header-transparent-substitute"></div>
        <div class="infinite-page-title-overlay"></div>
        <div class="infinite-page-title-container infinite-container">
            <div class="infinite-page-title-content infinite-item-pdlr"><h3 class="infinite-page-title"><?php echo single_cat_title();?></h3>
            </div>
        </div>
    </div>
    <div class="portal_wrapper">
        <div class="wrapper">
            <?php echo do_shortcode('[news_block]')?>
        </div>
    </div>
<?php get_template_part('portal/footer-portal');?>
