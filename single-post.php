<?php
//$curr_id = get_queried_object_id();
//echo get_the_category($curr_id)[0]->slug;
if(get_the_category(get_queried_object_id())[0]->slug == 'webinar'){
    require 'single_webinars.php';
}else{
$current_id = get_queried_object_id();
get_header('forms');?>
<div class="sticky-element">
    <div class="sticky-anchor"></div>
    <div class="sticky-content">
        <progress value="0" class="sticky">
            <div class="progress-container">
                <span class="progress-bar"></span>
            </div>
        </progress>
    </div>
</div>
<section class="breadcrumbs">
    <div class="wrapper">
        <div class="bread_block">
            <?php if(function_exists('bcn_display')){ ?>
                <?php bcn_display();?>
            <?php };?>
        </div>
    </div>
</section>
<?php
while(have_posts()){ the_post();
    //do_action('gdlr_core_print_page_builder');
    ?>
    <div class="wrapper">
        <section class="hero_blog_post" style="background: url(<?php echo get_the_post_thumbnail_url();?>);">
            <div class="hero_blog_info">
                <div class="hero_title"><?php the_title();?></div>
                <div class="hero_meta">
                    <span class="hero_meta_item hero_meta_author"><?php the_author();?></span>
                    <span class="hero_meta_item hero_meta_date"><?php the_time('d M Y');?></span>
					<?php if(get_field('time_to_read') != ''){ ?>
						<span class="hero_meta_item hero_meta_read"><?php the_field('time_to_read');?></span>
					<?php };?>
                </div>
            </div>
        </section>
    </div>
    <section class="blog_body">
        <div class="wrapper">
            <div class="blog_col">
                <div class="blog_left">
                    <div class="blog_anchors">
                        <div class="blog_anchors_line"></div>
                    </div>
                </div>
                <div class="blog_center">
                    <?php the_content();?>
					<?php if(get_field('show_promo_block') == 1){ ?>
                    <div class="blog_promo">
                        <div class="blog_promo_title">
                            Want to learn more about the possibilities and benefits with the Hybrid Cloud Platform?
                        </div>
                        <a href="<?php the_permalink(8860);?>">Learn more ></a>
                    </div>
					<?php };?>
                </div>
                <div class="blog_right">
                    <div id="socials_share">
                        <?php echo do_shortcode('[Sassy_Social_Share]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="debug"></div>
    <section class="related loading_wrapper">
        <div class="wrapper">
            <div class="related_title">Want to read more?</div>
            <div class="loading">
                <?php $all = new WP_Query(array(
                    'category_name'=>'blog',
                    'posts_per_page'=>3,
                    'orderby'=>'rand',
                    'post__not_in'=>array($current_id)
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
    </section>
    <?php
}
while(have_rows('eop_blocks')) {
    the_row();
    if(get_row_layout() == 'content_image'){
        $type_grid = get_sub_field('type_of_grid');
        if($type_grid == 'image_left'){
            get_template_part('inc/eop_blocks/content_image_left');
        }
        if($type_grid == 'image_right'){
            get_template_part('inc/eop_blocks/content_image_right');
        }
    }
    if(get_row_layout() == 'solutions'){
        get_template_part('inc/eop_blocks/solutions');
    }
    if(get_row_layout() == 'customers'){
        get_template_part('inc/eop_blocks/customers');
    }
    if(get_row_layout() == 'simple_grid'){
        get_template_part('inc/eop_blocks/simple_grid');
    }
    if(get_row_layout() == 'reviews_slider'){
        get_template_part('inc/eop_blocks/reviews_slider');
    }
    if(get_row_layout() == 'support'){
        get_template_part('inc/eop_blocks/support');
    }
    if(get_row_layout() == 'card_grid'){
        get_template_part('inc/eop_blocks/card_grid');
    }
    if(get_row_layout() == 'full_width_block'){
        get_template_part('inc/eop_blocks/full_width_block');
    }
    if(get_row_layout() == 'numbers'){
        get_template_part('inc/eop_blocks/numbers');
    }
    if(get_row_layout() == 'different_order_blocks'){
        get_template_part('inc/eop_blocks/different_order_blocks');
    }
    if(get_row_layout() == 'hero_image'){
        get_template_part('inc/eop_blocks/hero_image');
    }
    if(get_row_layout() == 'contact_form_block'){
        get_template_part('inc/eop_blocks/contact_form_block');
    }
    if(get_row_layout() == 'map'){
        get_template_part('inc/eop_blocks/map');
    }
};
if( !is_user_logged_in() ){
	?>
	<style>
		.sticky-content.fixed{
			top:0 !important;
		}
	</style>
	<?php
};
?>
<?php get_footer(); };?>
