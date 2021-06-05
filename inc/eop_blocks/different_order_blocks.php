<section class="different_order_blocks">
    <div class="wrapper">
        <?php $cnt = 1;while(have_rows('blocks')){ the_row();?>
            <?php $color = get_sub_field('count_color');?>
            <div class="df_block wow fadeIn"  data-wow-duration="1s" data-wow-delay="0.1s">
                <?php if($cnt%2 != 0){ ?>
                    <!--Блок нечётный, картинка справа-->
                    <div class="df_info">
                        <h3 class="df_title"><?php the_sub_field('title');?></h3>
                        <div class="df_content"><?php the_sub_field('content');?></div>
                    </div>
                    <div class="df_count">
                        <div class="df_cnt" style="color:<?php echo $color;?>">
                            <?php if($cnt == 1){ ?>
                                <div class="vertical_line"></div>
                            <?php };?>
                            <?php echo $cnt;?>
                        </div>
                    </div>
                    <div class="df_image">
                        <img src="<?php echo get_sub_field('image')['url']?>" alt="<?php echo get_sub_field('image')['alt']?>" />
                    </div>
                <?php }else{ ?>
                    <!--Блок чётный, картинка слева-->
                    <div class="df_image">
                        <img src="<?php echo get_sub_field('image')['url']?>" alt="<?php echo get_sub_field('image')['alt']?>" />
                    </div>
                    <div class="df_count">
                        <div class="df_cnt" style="color:<?php echo $color;?>">
                            <?php echo $cnt;?>
                        </div>
                    </div>
                    <div class="df_info">
                        <h3 class="df_title"><?php the_sub_field('title');?></h3>
                        <div class="df_content"><?php the_sub_field('content');?></div>
                    </div>
                <?php };?>
            </div>
        <?php $cnt++; };?>
    </div>
</section>
