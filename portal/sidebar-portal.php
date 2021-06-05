<div class="sidebar">
    <div class="search_form">
        <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="search" class="search-field" placeholder="<?php esc_attr_e('Search...', 'infinite'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
            <input type="hidden" value="partnernews" name="post_type" />
            <input type="submit" class="search-submit" value="<?php esc_attr_e('Go', 'infinite'); ?>" />
        </form>
    </div>
    <?php $wh_term_id = 133;?>
    <div class="last_news sidebar_block">
        <h4>News</h4>
        <ul class="news_list sidebar_list">
            <?php $last_news = new WP_Query(array(
                'post_type'=>'partnernews',
                'tax_query'=>array(
                    array(
                        'taxonomy'=>'newscategory',
                        'terms'=>$wh_term_id
                    )
                ),
                'posts_per_page'=>5,
                'order'=>'DESC'
            ))?>
            <?php while($last_news->have_posts()){ $last_news->the_post();?>
                <li>
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </li>
            <?php };?>
        </ul>
    </div>
    <?php $news_id = 134;?>
    <div class="news_categories sidebar_block">
        <h4>What's New</h4>
        <ul class="news_list sidebar_list">
            <?php $last_news = new WP_Query(array(
                'post_type'=>'partnernews',
                'tax_query'=>array(
                    array(
                        'taxonomy'=>'newscategory',
                        'terms'=>$news_id
                    )
                ),
                'posts_per_page'=>5,
                'order'=>'DESC'
            ))?>
            <?php while($last_news->have_posts()){ $last_news->the_post();?>
                <li>
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </li>
            <?php };?>
        </ul>
    </div>
</div>
