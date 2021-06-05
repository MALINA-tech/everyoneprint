<?php
    $custom_style_block = get_sub_field('custom_style_of_block');
    $block_bg = get_sub_field('block_bg');
    $custom_image_class = get_sub_field('custom_image_class');
    $custom_image_attr = get_sub_field('custom_image_attr');
    $class_section = get_sub_field('section_style');
?>
<section class="content_image <?php echo $class_section;?>" style="<?php echo $custom_style_block;?>">
    <div class="wrapper">
        <div class="ci_block">
            <?php $image_column_style = get_sub_field('image_column_style');?>
            <div class="ci_col ci_left <?php echo $custom_image_class;?>" style="<?php echo $image_column_style;?>" <?php echo $custom_image_attr;?>>
                <?php $image = get_sub_field('image');?>
                <a data-fancybox href="<?php echo $image['url'];?>"><img src="<?php echo $image['sizes']['medium_large'];?>" alt="" /></a>
            </div>
            <?php $content_column_style = get_sub_field('content_column_style');?>
            <div class="ci_col ci_right" style="<?php echo $content_column_style;?>">
                <?php
                    $custom_style_title = get_sub_field('custom_style_of_title');
                ?>
                <div class="title" style="<?php echo $custom_style_title;?>"><?php the_sub_field('title');?></div>
                <div class="sub_title" style=""><?php the_sub_field('sub_title');?></div>
                <div class="content"><?php the_sub_field('content');?></div>
				<?php if(get_sub_field('btn_text') != ''){ ?>
                <a href="<?php the_sub_field('btn_link');?>" class="btn red_btn"><?php the_sub_field('btn_text');?></a>
				<?php };?>
            </div>
        </div>
    </div>
</section>