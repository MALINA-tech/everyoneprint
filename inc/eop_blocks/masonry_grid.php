<?php
    $style = get_sub_field('style');
    $main_title = get_sub_field('main_title');
    $red_title = get_sub_field('red_title');
?>
<section class="masonry_section wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s" style="<?php echo $style;?>">
    <div class="wrapper">
        <ul class="masonry_list">
            <li class="masonry_header">
                <?php if($red_title != ''){ ?><div class="red_title"><?php echo $red_title;?></div><?php };?>
                <?php if($main_title != ''){ ?><h2 class="main_title"><?php echo $main_title;?></h2><?php };?>
            </li>
            <?php while(have_rows('masonry_blocks')){ the_row();?>
                <?php
                    $icon = get_sub_field('icon');
                ?>
                <li class="masonry_item">
                    <div class="masonry_icon">
                        <img src="<?php echo $icon['url'];?>" alt="<?php echo $icon['alt'];?>" />
                    </div>
                    <div class="masonry_title"><?php the_sub_field('title');?></div>
                    <div class="masonry_content"><?php the_sub_field('content');?></div>
                </li>
            <?php };?>
        </ul>
    </div>
</section>
