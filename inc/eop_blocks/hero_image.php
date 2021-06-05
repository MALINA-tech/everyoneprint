<?php
    $hero_image = get_sub_field('hero_image');
?>
<section class="hero" style="background: url(<?php echo $hero_image;?>);">
    <div class="wrapper">
        <div class="hero_title"><?php the_sub_field('hero_title');?></div>
        <div class="hero_content"><?php the_sub_field('hero_content');?></div>
    </div>
</section>
