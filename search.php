<?php
$post_type = $_GET['post_type'];
if($post_type == 'partnernews' || $post_type == array('partnernews','portal')){
    include 'portal/search.php';
}else {
    get_header();?>
<div class="title"><?php the_archive_title();?></div>
<ul class="archive-list">
<?php while(have_posts()) : the_post();?>
	<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
<?php endwhile;?>
</ul>
<?php get_footer();

}

?>