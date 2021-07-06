<?php 

$back_url = $_SERVER['HTTP_REFERER'];

get_header('nobg');
?>

<section class="page_404">
    <div class="wrapper">
        <div class="block_404">
            <div class="title_404">
                Oops!
            </div>
            <div class="description_404">
                We can’t seem to find the <br /> page you are looking for
            </div>
            <a href="javascript:history.go(-1)" class="btn red_btn big_red_btn">Go back</a>
        </div>
    </div>
</section>

<?php get_footer();?>