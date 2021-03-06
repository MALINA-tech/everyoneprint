
<?php 
$page_no_banner = 'footer_nobanner';

if ( ! is_404() && ! is_page( array('careers', 'hcp-demo-request', 'hcp-trial', 'login') )): 

$page_no_banner = '';
?>
<section class="promo_section wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
    <div class="wrapper">
        <div class="promo_block">
            <div class="promo_title">Ready to get started?</div>
            <a href="/login/?action=hcp-trial" class="btn red_btn">Try for free</a>
        </div>
    </div>
</section>
<?php endif ?>

<footer class=" <?= $page_no_banner ?>">
    <div class="wrapper">
        <div class="footer_line">
            <div class="col_3 ib">
                <div class="footer_logo">
                    <?php $footer_logo = get_field('footer_logo','everyoneprint_options');?>
	                <?php if(is_front_page()){ ?>
                        <img src="<?php echo $footer_logo['url']?>" alt="<?php echo $footer_logo['alt']?>" />
	                <?php }else{ ?>
                        <a href="/">
                            <img src="<?php echo $footer_logo['url']?>" alt="<?php echo $footer_logo['alt']?>" />
                        </a>
	                <?php };?>
                </div>
            </div>
            <div class="col_6 ib">
                <ul class="footer_menu">
                    <?php draim_menu('footer_menu');?>
                </ul>
            </div>
            <div class="col_3 ib">
                <div class="socials">
                    <?php while(have_rows('socials','everyoneprint_options')){ the_row();?>
                        <a href="<?php the_sub_field('link');?>"><?php the_sub_field('icon');?></a>
                    <?php };?>
                </div>
            </div>
        </div>
        <div class="sub_footer_line">
            <span class="footer_copy"><?php the_field('footer_copy','everyoneprint_options');?></span>
            <ul><?php draim_menu('sub_footer_menu');?></ul>
        </div>
    </div>
</footer>
</div>
<?php wp_footer();?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/css/intlTelInput.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/intlTelInput.js"></script>
</body>
</html>