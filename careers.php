<?php
//Template Name: Careers
get_header('forms');?>
<div class="wrapper">
    <?php
    while(have_posts()){ the_post();
        $current_content = get_the_content(null,null,get_the_ID());
        if($current_content != ''){
            the_content();
        }else{
            do_action('gdlr_core_print_page_builder');
        }
    }
    ?>
</div>
<?php
while(have_rows('eop_blocks')) {
    the_row();
    if(get_row_layout() == 'content_image'){
        $type_grid = get_sub_field('type_of_grid');
        if($type_grid == 'image_left'){
            get_template_part('inc/eop_blocks/content_image_left');
        }
        if($type_grid == 'image_right'){
            get_template_part('inc/eop_blocks/content_image_right');
        }
    }
    if(get_row_layout() == 'solutions'){
        get_template_part('inc/eop_blocks/solutions');
    }
    if(get_row_layout() == 'customers'){
        get_template_part('inc/eop_blocks/customers');
    }
    if(get_row_layout() == 'simple_grid'){
        get_template_part('inc/eop_blocks/simple_grid');
    }
    if(get_row_layout() == 'reviews_slider'){
        get_template_part('inc/eop_blocks/reviews_slider');
    }
    if(get_row_layout() == 'support'){
        get_template_part('inc/eop_blocks/support');
    }
    if(get_row_layout() == 'card_grid'){
        get_template_part('inc/eop_blocks/card_grid');
    }
    if(get_row_layout() == 'full_width_block'){
        get_template_part('inc/eop_blocks/full_width_block');
    }
    if(get_row_layout() == 'numbers'){
        get_template_part('inc/eop_blocks/numbers');
    }
    if(get_row_layout() == 'different_order_blocks'){
        get_template_part('inc/eop_blocks/different_order_blocks');
    }
    if(get_row_layout() == 'hero_image'){
        get_template_part('inc/eop_blocks/hero_image');
    }
    if(get_row_layout() == 'contact_form_block'){
        get_template_part('inc/eop_blocks/contact_form_block');
    }
    if(get_row_layout() == 'map'){
        get_template_part('inc/eop_blocks/map');
    }
    if(get_row_layout() == 'animation_images'){
        get_template_part('inc/eop_blocks/animation_images');
    }
};
?>
<?php get_footer('nobanner');?>
