<?php

// Template Name: Blog

get_header();

$hero_image = get_field('blog_image','everyoneprint_options');
$hero_image_url = $hero_image['url'];
?>
<section class="hero hero_blog" style="background-image: url(<?php echo $hero_image_url;?>);">
    <div class="wrapper">
        <div class="hero_title">EveryonePrint Blog</div>
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
            'meta_query'=>array(
                array(
                    'key'=>'featured',
                    'value'=>1
                )
            )
        ));?>
        <?php while($featured->have_posts()){ $featured->the_post();?>
        <div class="featured_block">
            <div class="featured_col_left">
                <div class="featured_image">
                    <span class="featured">Featured</span>
                    <?php the_post_thumbnail();?>
                </div>
            </div>
            <div class="featured_col_right">
                <div class="featured_info">
                    <div class="featured_date"><?php the_time('d M Y');?></div>
                    <div class="featured_title"><?php the_title();?></div>
                    <div class="featured_excerpt">
                        <?php echo kama_excerpt(['maxchar'=>200]);?>
                    </div>
                    <a class="featured_permalink" href="<?php the_permalink();?>">Read more ></a>
                </div>
            </div>
        </div>
        <?php };?>
    </div>
</section>
<section class="loading_wrapper">
    <div class="wrapper">
        <div class="loading_block">
            <div class="loading_header">

            </div>
        </div>
    </div>
</section>
<?php get_footer();?>