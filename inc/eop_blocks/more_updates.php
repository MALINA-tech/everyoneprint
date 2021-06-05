<?php
    $main_title = get_sub_field('main_title');
    $ids = get_sub_field('items');
?>
<section class="other_updates wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
    <div class="wrapper">
        <div class="ou_title"><?php echo $main_title;?></div>
        <?php $other_updates = new WP_Query(array(
            'post_type'=>'post',
            'orderby'=>'post__in',
            'post__in'=>$ids
        ));?>
        <div class="ou_list">
            <?php while($other_updates->have_posts()){ $other_updates->the_post();?>
                <div class="ou_item">
                    <div class="ou_left">
                        <a href="<?php the_permalink();?>" class="ou_thumb">
                            <?php $ou_image = get_field('other_updates_image');?>
                            <?php if($ou_image['url'] != ''){ ?>
                                <img src="<?php echo $ou_image['url'];?>" alt="<?php echo $ou_image['alt'];?>" />
                            <?php }else{ ?>
                                <?php the_post_thumbnail();?>
                            <?php };?>
                        </a>
                    </div>
                    <div class="ou_right">
                        <?php $current_pt = get_the_category();
                        $curr_name = $current_pt[0]->slug;
                        ?>
                        <div class="ou_category<?php if($curr_name == 'webinar'){ ?> ou_category_webinar <?php };?>">
                            <a href="<?php echo get_category_link($current_pt[0]->term_id);?>"><?php echo $current_pt[0]->name?></a>
                        </div>
                        <?php
                        $ou_title = get_field('other_updates_title');
                        $ou_link_text = get_field('other_updates_link_text');
                        ?>
                        <div class="ou_item_title">
                            <a href="<?php the_permalink();?>">
                                <?php if($ou_title != ''){ echo $ou_title;?>

                                <?php }else{ the_title(); };?>
                            </a>
                        </div>
                        <a href="<?php the_permalink();?>" class="ou_permalink"><?php if($ou_link_text != ''){ echo $ou_link_text; }else{ ?>Read more ><?php };?></a>
                    </div>
                </div>
            <?php };?>
        </div>
    </div>
</section>
