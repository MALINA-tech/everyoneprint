<?php 
/*
Template Name: Main Page
*/
get_header();?>

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
        if(get_row_layout() == 'more_updates'){
            get_template_part('inc/eop_blocks/more_updates');
        }
    };
?>

<?php get_footer();?>