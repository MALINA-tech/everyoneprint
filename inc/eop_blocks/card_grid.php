<?php $custom_style = get_sub_field('custom_style');?>
<section class="card_grid" style="<?php echo $custom_style;?>">
    <div class="wrapper">
        <?php if(get_sub_field('title') != ''){ ?>
            <h2 class="center"><?php the_sub_field('title');?></h2>
        <?php };?>
        <?php $classname = ''; $items_per_column = get_sub_field('items_per_column');?>
        <?php switch($items_per_column){
            case '3': $classname = '';break;
            case '2': $classname = 'cards_two';break;
            case '1': $classname = 'cards_full_width';break;
            default: $classname = '';
        };?>
        <div class="card_items <?php echo $classname;?>">
            <?php while(have_rows('cards')){ the_row();?>
                <div class="card">
                    <div class="card_icon">
                        <img src="<?php echo get_sub_field('icon')['url'];?>" alt="<?php echo get_sub_field('icon')['alt'];?>" />
                    </div>
                    <div class="card_info">
                        <div class="card_info_title">
                            <?php the_sub_field('title');?>
                        </div>
                        <div class="card_info_content">
                            <?php the_sub_field('content');?>
                        </div>
                    </div>
                </div>
            <?php };?>
        </div>
    </div>
</section>
