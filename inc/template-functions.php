<?php

/**
 * Регистрация миниатюр в шаблоне
 */

if ( function_exists( 'add_theme_support' )) {
   add_theme_support('post-thumbnails');
}

register_nav_menus( array(
	'top_menu'						=> 'Top Menu',
	'footer_menu'					=> 'Footer Menu',
	'sub_footer_menu'			=> 'Sub Footer Menu',
  'portal_header_menu'	=> 'Portal Header Menu',
  'resources_menu'			=> 'Resources Menu',
  'product_menu'				=> 'Product Menu',
  'mobile_print_menu'		=> 'Mobile Print Menu',
  'blog_menu'						=> 'Blog Menu',
  'second_top_menu'			=> 'Second Top Menu',
  'mobile_menu'					=> 'Mobile Menu'
));

if( function_exists( 'acf_add_options_page' )) {
	acf_add_options_page( array(
		'post_id'			=> 'everyoneprint_options',
		'page_title' 	=> 'Everyoneprint Settings',
		'menu_title'	=> 'Everyoneprint Settings',
		'menu_slug' 	=> 'everyoneprint-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'icon_url' 		=> get_template_directory_uri() . '/assets/img/menu_settings_icon.png'
	));
}

add_filter( 'upload_mimes', 'svg_upload_allow' );

/**
 * Функция добавления колонки "Миниатюра" в списке записей и страниц
 */

function wph_columns_names( $defaults ) {
  $defaults[ 'wph_thumbs' ] = 'Миниатюры';
  return $defaults;
}

function wph_add_thumbs($column_name, $id){
  if ( $column_name === 'wph_thumbs' ){
		echo the_post_thumbnail( array( 125, 80 ));
  }
}

add_filter( 'manage_posts_columns', 'wph_columns_names', 5 );
add_filter( 'manage_pages_columns', 'wph_columns_names', 5 );
add_action( 'manage_posts_custom_column', 'wph_add_thumbs', 5, 2 );
add_action( 'manage_pages_custom_column', 'wph_add_thumbs', 5, 2 );

/**
 * Добавляет SVG в список разрешенных для загрузки файлов.
 */

function svg_upload_allow( $mimes ) {
	$mimes[ 'svg' ]  = 'image/svg+xml';
	return $mimes;
}

add_shortcode( 'news_block','news_block_function' );

// Register a testimonial ACF Block
if( function_exists('acf_register_block') ) {
	
	$result = acf_register_block(array(
		'name'				=> 'testimonial',
		'title'				=> __('Testimonial'),
		'description'		=> __('A custom testimonial block.'),
		'render_callback'	=> 'my_testimonial_block_html'
		//'category'		=> '',
		//'icon'			=> '',
		//'keywords'		=> array(),
	));
}

// Callback to render the testimonial ACF Block
function my_testimonial_block_html() {
	
	// vars
	$testimonial = get_field('testimonial');
	$author = get_field('author');
	$avatar = get_field('avatar');
	
	?>
	<blockquote class="testimonial">
	    <p><?php echo $testimonial; ?></p>
	    <cite>
	    	<img src="<?php echo $avatar['url']; ?>" alt="<?php echo $avatar['alt']; ?>" />
	    	<span><?php echo $author; ?></span>
	    </cite>
	</blockquote>
	<?php
}