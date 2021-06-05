<section class="reviews_slider">
    <div class="reviews_block">
        <div class="reviews_col reviews_col_left">
            <div class="reviews_col_left_info">
                <h2 class="reviews_main_title">
                    <?php the_sub_field('title');?>
                </h2>
                <div class="content reviews_main_content">
                    <?php the_sub_field('content');?>
                </div>
            </div>
        </div>
        <div class="reviews_col reviews_col_right">
            <div class="reviews_slider_main_pagination"></div>
            <div class="reviews_slider_main">
                <div class="swiper-wrapper">
                    <?php $reviews = get_posts(array(
                        'post_type'=>'review',
                        'posts_per_page'=>-1,
                        'order'=>'DESC'
                    ));?>
                    <?php $reviews_id_array = array();foreach ($reviews as $review){ ?>
                        <?php $reviews_id_array[] = $review->ID;?>
                        <?php $review_pdf = get_field('pdf',$review->ID);?>
                        <a href="<?php echo $review_pdf['url'];?>" class="swiper-slide review_slide_main">
                            <div class="reviews_blockquote">
                                <img src="<?php echo IMAGES;?>/Vector.png" alt="" />
                            </div>
                            <div class="reviews_content">
                                <?php echo $review->post_content;?>
                            </div>
                            <div class="reviews_meta">
                                <?php if(get_the_post_thumbnail_url($review->ID) != ''){ ?>
                                <div class="reviews_thumb">
                                    <img src="<?php echo get_the_post_thumbnail_url($review->ID);?>" alt="" />
                                </div>
                                <?php };?>
                                <div class="reviews_meta_info">
                                    <div class="reviews_meta_info_title">
                                        <?php echo $review->post_title;?>
                                    </div>
                                    <div class="reviews_meta_info_position">
                                        <?php the_field('position',$review->ID);?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php };?>
                </div>
            </div>
            <div class="reviews_slider_logo">
                <div class="swiper-wrapper">
                    <?php
                        foreach ($reviews_id_array as $review){
                            ?>
                            <div class="swiper-slide review_logo_slide">
                                <img src="<?php echo get_field('logo',$review)['url'];?>" alt="<?php echo get_field('logo',$review)['alt'];?>" />
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
