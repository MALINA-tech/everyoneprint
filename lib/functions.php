<?php
//Определение констант для упрощения написания кода в шаблонах
if(function_exists('get_bloginfo')){
	define('NAME',get_bloginfo('name'));
	define('MAIL',get_bloginfo('admin_email'));
	define('IMAGES',get_bloginfo('template_url').'/images');
}
//Подключение стандартной библиотеки
function draim_standart_styles_scripts(){
    $uniq = wp_generate_uuid4();
    $current_timestamp = mktime();
    $result_version = $uniq.$current_timestamp;
	wp_register_style('draim_style_fancybox',get_template_directory_uri().'/css/jquery.fancybox.css?ver='.$result_version,array(),null);
	//wp_register_style('draim_style_swiper',get_template_directory_uri().'/css/swiper-bundle.css');
	wp_register_style('draim_style_app',get_template_directory_uri().'/view/app.css?ver='.$result_version,array(),null);
	wp_register_script('draim_script_jquery','https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	wp_register_script('draim_script_app',get_template_directory_uri().'/view/app.js?ver='.$result_version,'draim_script_jquery',null);
	wp_enqueue_style('draim_style_fancybox');
	//wp_enqueue_style('draim_style_swiper');
	wp_enqueue_style('draim_style_app');
    wp_enqueue_script('draim_script_jquery');
    wp_enqueue_script('draim_script_app');
}
//add_action('wp_enqueue_scripts','draim_standart_styles_scripts');
?>