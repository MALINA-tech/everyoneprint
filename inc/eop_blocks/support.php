<section class="support_section">
    <div class="wrapper">
        <div class="support_block">
            <div class="support_left">
                <h2 class="support_title"><?php the_sub_field('support_title');?></h2>
                <div class="content support_content">
                    <?php the_sub_field('content');?>
                </div>
            </div>
            <div class="support_right">
                <?php $support_images = get_field('support_logos','everyoneprint_options');?>
                <?php foreach ($support_images as $support_image){ ?>
                    <img src="<?php echo $support_image['url']?>" alt="<?php echo $support_image['alt']?>" title="<?php echo $support_image['title']?>" />
                <?php };?>
            </div>
        </div>
    </div>
</section>

