<?php if(is_user_logged_in()){ ?>
    <?php get_template_part('portal/header-portalnew');?>
    <?php while(have_posts()){ the_post();?>
        <div class="portal_wrapper">
            <div class="wrapper">
                <div class="single_news">
                    <div class="single_news_left">
                        <h1><?php the_title();?></h1>
                        <div class="news_meta">
                            <?php $tax = get_the_terms(get_the_ID(),'newscategory'); $term_id = $tax[0]->term_id?>
                            <span class="news_meta_date"><?php the_time('M d, Y');?></span> | <a class="news_meta_tax" href="<?php echo get_term_link($term_id)?>"><?php echo $tax[0]->name;?></a>
                        </div>
                        <div class="news_content">
                            <?php the_content();?>
                        </div>
                        <div class="news_nav">
                            <?php $prev_post = get_previous_post(true,"",'newscategory'); //$prev_post_title = $prev_post->post_title;?>
                            <?php $next_post = get_next_post(true,"",'newscategory'); //$next_post_title = $next_post->post_title;?>
                            <?php //echo $prev_post;?>
                            <?php //echo $next_post;?>
                            <?php if($prev_post->ID != ''){ ?>
                                <a class="news_nav_left" href="<?php the_permalink($prev_post->ID);?>">< <?php echo $prev_post->post_title;?></a>
                            <?php };?>
                            <?php if($next_post->ID != ''){ ?>
                                <a class="news_nav_right" href="<?php the_permalink($next_post->ID);?>"><?php echo $next_post->post_title;?> ></a>
                            <?php };?>
                        </div>
                    </div>
                    <div class="single_news_right">
                        <?php get_sidebar('portal');?>
                    </div>
                </div>
            </div>
        </div>
    <?php };
    get_template_part('portal/footer-portal');?>
<?php }else{ ?>
    <?php $login_link = wp_login_url();?>
    <?php header('Location: '.$login_link);?>
<?php }?>