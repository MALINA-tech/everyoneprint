<?php if(is_user_logged_in()){ ?>
    <?php $current_term_id = get_queried_object_id();?>
    <?php get_template_part('portal/header-portalnew');?>
    <div id="portal_header" class="infinite-page-title-wrap  infinite-style-small infinite-left-align portal_header_news">
        <div class="infinite-header-transparent-substitute"></div>
        <div class="infinite-page-title-container infinite-container">
            <div class="infinite-page-title-content infinite-item-pdlr"><h3 class="infinite-page-title"><?php echo single_cat_title();?></h3>
            </div>
        </div>
    </div>
    <div class="portal_wrapper">
        <div class="wrapper">
            <div class="single_news">
                <div class="single_news_left">
                    <?php while(have_posts()){ the_post();?>
                        <div class="news_post">
                            <h2>
                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                            </h2>
                            <div class="news_meta">
                                <?php $tax = get_the_terms(get_the_ID(),'newscategory'); $term_id = $tax[0]->term_id?>
                                <span class="news_meta_date"><?php the_time('M d, Y');?></span> | <a class="news_meta_tax" href="<?php echo get_term_link($term_id)?>"><?php echo $tax[0]->name;?></a>
                            </div>
                            <div class="news_content">
                                <?php the_content();?>
                            </div>
                        </div>
                    <?php };?>
                    <?php if(function_exists('wp_pagenavi')){ ?>
                        <div class="pagenavi">
                            <?php wp_pagenavi();?>
                        </div>
                    <?php };?>
                </div>
                <div class="single_news_right">
                    <?php get_sidebar('portal')?>
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part('portal/footer-portal');?>
<?php }else{ ?>
    <?php $login_link = wp_login_url();?>
    <?php header('Location: '.$login_link);?>
<?php }?>
