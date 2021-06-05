<?php
    $style = get_sub_field('style');
    $main_title = get_sub_field('main_title');
    $red_title = get_sub_field('red_title');
    $btn_text = get_sub_field('btn_text');
    $btn_link = get_sub_field('btn_link');
    $image = get_sub_field('image');
    $content = get_sub_field('content');
?>
<section class="full_width_block" style="<?php echo $style;?>">
    <div class="wrapper">
        <div class="fw_block_inner">
            <?php if($red_title != ''){ ?><div class="red_title"><?php echo $red_title;?></div><?php };?>
            <?php if($main_title != ''){ ?>
                <?php $title_type = get_sub_field('title_type');?>
                <?php
                    switch($title_type){
                        case 'h2':
                            ?>
                            <h2><?php echo $main_title;?></h2>
                            <?php break;
                        case 'h3':
                            ?>
                            <h3><?php echo $main_title;?></h3>
                            <?php break;
                        case 'default':
                            ?>
                            <div class="fw_main_title"><?php echo $main_title;?></div>
                            <?php break;
                        default:
                            ?>
                            <div class="fw_main_title"><?php echo $main_title;?></div>
                            <?php
                    }
                ?>
            <?php };?>
            <?php if($image['url']){ ?>
                <img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>" />
            <?php };?>
            <?php if($btn_text != ''){ ?>
                <a href="<?php echo $btn_link;?>" class="btn red_btn fw_btn"><?php echo $btn_text;?></a>
            <?php };?>
            <?php if($content != ''){ ?>
                <div class="content"><?php echo $content;?></div>
            <?php };?>
        </div>
    </div>
</section>
