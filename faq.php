<?php
/*
Template Name: FAQ
*/
get_header();?>
<section class="faq_wrap">
	<div class="wrapper">
        <div class="faq_header center">
            <div class="red_title">
		        <?php the_title();?>
            </div>
            <div class="page_subtitle_general">
		        <?php the_field('page_subtitle');?>
            </div>
            <div class="faq_search_block">
                <div class="faq_search_block_title">
                    Browse help topics or use the search bar
                </div>
            </div>
        </div>
	</div>
</section>
<?php get_footer();?>
