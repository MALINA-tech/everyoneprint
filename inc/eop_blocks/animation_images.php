<?php
    $style = get_sub_field('style');
    $red_title = get_sub_field('red_title');
    $main_title = get_sub_field('main_title');
?>
<section class="animation_images" style="<?php echo $style;?>">
    <div class="wrapper">
        <?php if($red_title != ''){ ?><div class="red_title"><?php echo $red_title;?></div><?php };?>
        <?php if($main_title != ''){ ?><h2 class=""><?php echo $main_title;?></h2><?php };?>
        <div class="animation_images_block">
            <?php $images = get_sub_field('gallery_images'); //var_dump($images);?>
            <?php foreach ($images as $image){ ?>
                <?php $image_url = $image['url'];?>
                <img src="<?php echo $image_url;?>" alt="" class="animation_image wow fadeIn" data-wow-duration="3s" data-wow-delay="1s" />
            <?php };?>
            <?php //$image_url - Последнее изображение (уже полное и включающее все части);?>
                <img id="modal_way" src="<?php echo $image_url;?>" alt="" />
            <div class="pos_abs">
                <a class="modal_way_btn" href="#modal_way">Open in modal</a>
            </div>
        </div>
    </div>
</section>
