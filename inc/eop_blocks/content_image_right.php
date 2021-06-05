<?php
    $block_bg = get_sub_field('block_bg');
    $custom_style_block = get_sub_field('custom_style_of_block');
?>
<section class="content_image" style="background-image: url(<?php echo $block_bg?>);<?php echo $custom_style_block;?>">
    <div class="wrapper">
        <div class="ci_block">
            <?php $content_column_style = get_sub_field('content_column_style');?>
            <div class="ci_col ci_left" style="<?php echo $content_column_style;?>">
                <?php
                    $custom_style_title = get_sub_field('custom_style_of_title');
                ?>
                <h1 class="title" style="<?php echo $custom_style_title;?>"><?php the_sub_field('title');?></h1>
                <div class="sub_title" style=""><?php the_sub_field('sub_title');?></div>
                <div class="content"><?php the_sub_field('content');?></div>
                <a href="<?php the_sub_field('btn_link');?>" class="btn red_btn"><?php the_sub_field('btn_text');?></a>
            </div>
            <?php $image_column_style = get_sub_field('image_column_style');?>
            <div class="ci_col ci_right" style="<?php echo $image_column_style;?>">
                <?php $image = get_sub_field('image');?>
                <a data-fancybox href="<?php echo $image['url'];?>"><img src="<?php echo $image['sizes']['medium_large'];?>" alt="" /></a>
            </div>
        </div>
    </div>
</section>