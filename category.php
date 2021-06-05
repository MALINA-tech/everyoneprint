<?php
$current_cat = get_queried_object_id();
get_header('forms');
$hero_image = get_field('blog_image','everyoneprint_options');
$hero_image_url = $hero_image['url'];
?>
    <section class="hero hero_blog" style="background-image: url(<?php echo $hero_image_url;?>);">
        <div class="wrapper">
            <div class="hero_title">EveryonePrint <?php echo get_cat_name($current_cat);?></div>
        </div>
    </section>
    <section class="hero_line">
        <div class="wrapper">
            <div class="hero_blog_menu">
                <ul>
                    <?php draim_menu('blog_menu');?>
                </ul>
            </div>
        </div>
    </section>
    <section class="featured_post">
        <div class="wrapper">
            <?php $featured = new WP_Query(array(
                'post_type'=>'post',
                'posts_per_page'=>1,
                'cat'=>$current_cat,
                'meta_query'=>array(
                    array(
                        'key'=>'featured',
                        'value'=>1
                    )
                )
            ));?>
            <?php while($featured->have_posts()){ $featured->the_post(); $featured_id = get_the_ID();?>
                <div class="featured_block">
                    <div class="featured_col_left">
                        <a href="<?php the_permalink();?>" class="featured_image">
                            <span class="featured">Featured</span>
                            <?php the_post_thumbnail();?>
                        </a>
                    </div>
                    <div class="featured_col_right">
                        <div class="featured_info">
                            <div class="featured_date"><?php the_time('d M Y');?></div>
                            <div class="featured_title">
                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                            </div>
                            <div class="featured_excerpt">
                                <?php echo kama_excerpt(['maxchar'=>200]);?>
                            </div>
                            <a class="featured_permalink" href="<?php the_permalink();?>">Read more ></a>
                        </div>
                    </div>
                </div>
            <?php };wp_reset_postdata();?>
        </div>
    </section>
    <section class="loading_wrapper">
        <div class="wrapper">
            <div class="loading_block">
<!--                <div class="loading_header">-->
<!--                    <a class="loading_header_active children_cat" data-cat="--><?php //echo $current_cat;?><!--" href="#">All</a>-->
<!--                    --><?php
//                    $sub_cats = get_categories( array(
//                        'child_of' => $current_cat,
//                        'hide_empty' => 0
//                    ));
//                    ?>
<!--                    --><?php //foreach ($sub_cats as $sub_cat){ ?>
<!--                        <a class="children_cat" data-cat="--><?php //echo $sub_cat->term_id;?><!--" href="#">--><?php //echo $sub_cat->name;?><!--</a>-->
<!--                    --><?php //};?>
<!--                </div>-->
                <div class="loading">
                    <?php $all = new WP_Query(array(
                        'cat'=>$current_cat,
                        'posts_per_page'=>-1,
                        'post__not_in'=>array($featured_id)
                    ))?>
                    <div class="slider_blog">
                        <?php while($all->have_posts()){ $all->the_post();?>
                            <div class="blog_item">
                                <a href="<?php the_permalink();?>" class="blog_item_thumb">
                                    <?php the_post_thumbnail();?>
                                </a>
                                <div class="blog_item_info">
                                    <div class="blog_item_meta">
                                        <span class="blog_item_meta_author"><?php the_author();?></span>
                                        <span class="blog_item_meta_date"><?php the_time('d M Y');?></span>
                                    </div>
                                    <a href="<?php the_permalink();?>" class="blog_item_title"><?php the_title();?></a>
                                    <a class="blog_item_permalink" href="<?php the_permalink();?>">Read more ></a>
                                </div>
                            </div>
                        <?php };?>
<!--                        <div class="blog_pagination_wrapper">-->
<!--                            <div class="blog_pagination"></div>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php echo do_shortcode('[other_updates category="2,153" posts_per_page="2"]')?>
<?php get_footer();?>