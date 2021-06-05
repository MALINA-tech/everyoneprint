<?php
    $style = get_sub_field('style');
    $block_id = get_sub_field('block_id');
    $general_title = get_sub_field('general_title');
    $block_link = get_sub_field('block_link');
?>
<section class="simple_grid wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s" style="<?php echo $style;?>" id="<?php echo $block_id;?>">
    <div class="wrapper">
        <?php if($general_title != ''){ ?><div class="general_title"><?php echo $general_title;?></div><?php };?>
        <div class="simple_grid_blocks">
            <?php
                while(have_rows('simple_grid_blocks')){
                    the_row();
                    ?>
                    <div class="simple_grid_block_col">
                        <?php
                        if(get_row_layout() == 'simple_grid_block_image'){
                            $image = get_sub_field('image');
                            $custom_style = get_sub_field('custom_style');
                            ?>
                            <?php if($block_link != ''){ ?>
                                <div class="simple_grid_block_col_image" style="<?php echo $custom_style;?>">
                                    <a href="<?php echo $block_link;?>">
                                        <img src="<?php echo $image['url']?>" alt="<?php echo $image['alt']?>" />
                                    </a>
                                </div>
                            <?php }else{ ?>
                                <div style="<?php echo $custom_style;?>">
                                    <img src="<?php echo $image['url']?>" alt="<?php echo $image['alt']?>" />
                                </div>
                            <?php };?>
                            <?php
                        }
                        if(get_row_layout() == 'simple_grid_block_content'){
                            $style = get_sub_field('style');
                            $btn_text = get_sub_field('btn_text');
                            ?>
                            <div class="simple_grid_block_content" style="<?php echo $style;?>">
                                <?php if(get_sub_field('red_title') != ''){ ?>
                                    <div class="red_sub_title"><?php the_sub_field('red_title');?></div>
                                <?php };?>
                                <?php if(get_sub_field('title') != ''){ ?>
	                                <?php $title_type = get_sub_field('title_type');?>
	                                <?php
	                                switch($title_type){
		                                case 'h1':
			                                ?>
                                            <h1 class="title"<?php if(get_sub_field('small_font_content') == 1){ ?> style="margin:0 0 30px;" <?php };?>>
                                                <a href="<?php echo $block_link;?>"><?php the_sub_field('title');?></a>
                                            </h1>
			                                <?php break;
		                                case 'h2':
			                                ?>
                                            <h2 class="title"<?php if(get_sub_field('small_font_content') == 1){ ?> style="margin:0 0 30px;" <?php };?>>
                                                <a href="<?php echo $block_link;?>"><?php the_sub_field('title');?></a>
                                            </h2>
			                                <?php break;
		                                case 'h3':
			                                ?>
                                            <h3 class="title"<?php if(get_sub_field('small_font_content') == 1){ ?> style="margin:0 0 30px;" <?php };?>>
                                                <a href="<?php echo $block_link;?>"><?php the_sub_field('title');?></a>
                                            </h3>
			                                <?php break;
		                                case 'default':
			                                ?>
                                            <div class="title"<?php if(get_sub_field('small_font_content') == 1){ ?> style="margin:0 0 30px;" <?php };?>>
                                                <a href="<?php echo $block_link;?>"><?php the_sub_field('title');?></a>
                                            </div>
			                                <?php break;
		                                default:
			                                ?>
                                            <div class="title"<?php if(get_sub_field('small_font_content') == 1){ ?> style="margin:0 0 30px;" <?php };?>>
                                                <a href="<?php echo $block_link;?>"><?php the_sub_field('title');?></a>
                                            </div>
		                                <?php
	                                }
	                                ?>
                                <?php };?>
                                <?php if(get_sub_field('content') != ''){ ?>
                                    <div class="content<?php if(get_sub_field('small_font_content') == 1){ ?> small_font_content<?php };?>">
                                        <?php the_sub_field('content');?>
                                    </div>
                                <?php };?>
                                <?php if(have_rows('grid_items')){ ?>
                                    <div class="grid_items">
                                        <?php while(have_rows('grid_items')){ the_row();?>
                                            <div class="grid_item">
                                                <div class="grid_item_thumb">
                                                    <img src="<?php echo get_sub_field('image')['url'];?>" alt="<?php echo get_sub_field('image')['alt'];?>" />
                                                </div>
                                                <div class="grid_item_content">
                                                    <?php the_sub_field('content');?>
                                                </div>
                                            </div>
                                        <?php };?>
                                    </div>
                                <?php };?>
                                <?php if($btn_text != ''){ ?>
                                    <a class="btn ib red_btn big_red_btn" href="<?php the_sub_field('btn_link');?>"><?php echo $btn_text;?></a>
                                <?php };?>
                            </div>
                            <?php
                        }
                        if(get_row_layout() == 'simple_grid_block_video'){
                            $style = get_sub_field('style');
                            $video_url = get_sub_field('video_url');
                            $video_bg = get_sub_field('video_thumb');
                            ?>
                            <div class="simple_grid_block_video" style="<?php echo $style;?>">
                                <a data-fancybox style="background-image: url(<?php echo $video_bg;?>);" target="_blank" class="video_item" href="<?php echo $video_url;?>">
                                    <span class="video_icon"></span>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</section>
