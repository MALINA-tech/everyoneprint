<?php
    $style = get_sub_field('style');
    $red_title = get_sub_field('red_title');
    $main_title = get_sub_field('main_title');
?>
<section class="numbers" style="<?php echo $style;?>">
    <div class="wrapper">
        <div class="numbers_inner">
            <?php if($red_title != ''){ ?><div class="red_title"><?php echo $red_title;?></div><?php };?>
            <?php if($main_title != ''){ ?><h2 class=""><?php echo $main_title;?></h2><?php };?>
            <div class="numbers_list">
                <?php while(have_rows('items')){ the_row();?>
                    <div class="numbers_item">
                        <div class="numbers_icon">
                            <img class="wow fadeIn" data-wow-duration="1500" data-wow-delay="2000" src="<?php echo get_sub_field('icon')['url']?>" alt="<?php echo get_sub_field('icon')['alt']?>" />
                            <svg class="radial-progress" width="84" height="84" data-percentage="<?php the_sub_field('number');?>" viewBox="0 0 84 84">
                                <circle class="incomplete" cx="42" cy="42" r="36" stroke="<?php the_sub_field('number_color');?>"></circle>
                                <circle class="complete" cx="42" cy="42" r="36" stroke="<?php the_sub_field('number_color');?>" style="stroke-dashoffset: 6;"></circle>
                            </svg>
                        </div>
                        <div class="numbers_info">
                            <div class="number" style="color:<?php the_sub_field('number_color');?>"><?php the_sub_field('number');?>%</div>
                            <div class="numbers_content"><?php the_sub_field('content');?></div>
                        </div>
                    </div>
                <?php };?>
            </div>
        </div>
    </div>
</section>
