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
		'icon_url' 		=> get_template_directory_uri() . '/images/menu_settings_icon.png'
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
