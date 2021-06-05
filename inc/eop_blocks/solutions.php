<?php
$post_type = get_post_type();
$red_title = get_sub_field('red_title');
$main_title = get_sub_field('main_title');
$custom_style = get_sub_field('custom_block_style');
?>
<section class="solutions wow fadeIn" style="<?php echo $custom_style;?>" data-wow-delay="0.1s" data-wow-duration="2s">
    <div class="wrapper">
        <?php if($post_type != 'product'){ ?>
            <?php if($red_title != ''){ ?><div class="red_title"><?php echo $red_title;?></div><?php };?>
            <?php if($main_title != ''){ ?><h2><?php echo $main_title;?></h2><?php };?>
        <?php };?>
        <?php if(have_rows('items')){ ?>
            <div class="solution_items">
                <?php if($post_type == 'product'){ ?>
                    <div class="solutions_item solutions_item_col">
                        <?php if($red_title!= ''){ ?><div class="red_title"><?php echo $red_title;?></div><?php };?>
                        <?php if($main_title != ''){ ?><div class="solutions_main_title"><?php echo $main_title;?></div><?php };?>
                    </div>
                <?php };?>
                <?php $cnt = 1;while(have_rows('items')){ the_row();?>
                    <?php $product_id = get_sub_field('item');?>
                    <?php $product_thumb = get_the_post_thumbnail_url($product_id);?>
                    <div class="solutions_item solutions_item_<?php echo $product_id;?>">
                        <div class="overlay solutions_overlay"></div>
                        <div class="solutions_animate solutions_animate_first" style="background-image:url(<?php echo $product_thumb?>);"></div>
                        <div class="solutions_animate solutions_animate_second" style="background-image:url(<?php echo $product_thumb?>);"></div>
                        <div class="solutions_item_info">
                            <div class="solutions_item_info_title"><?php the_field('second_title',$product_id);?></div>
                            <div class="solutions_item_info_excerpt"><?php echo get_the_excerpt($product_id);?></div>
                            <a class="solutions_item_info_link" href="<?php the_permalink($product_id);?>">Explore <?php echo get_the_title($product_id);?> <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                <?php };?>
            </div>
        <?php };?>
    </div>
</section>
