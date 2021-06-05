<?php

/**
* Include Styles & Scripts
*/

$uniq = wp_generate_uuid4();
$current_timestamp = mktime();
$result_version = $uniq.$current_timestamp;

function print_styles_scripts() {
  if ( 
    is_post_type_archive( array( 'portal', 'partnernews' )) || 
    is_singular( array( 'portal', 'partnernews' )) || 
    is_tax( 'newscategory' ) || 
    is_page( 'partnerinfo' )) {

    wp_enqueue_style( 'draim_fancybox', get_template_directory_uri() . '/portal/css/jquery.fancybox.css', array(), $result_version );
    wp_enqueue_style( 'draim_app', get_template_directory_uri() . '/view/app.css', array(), $result_version );
    wp_enqueue_style( 'draim_portal_app', get_template_directory_uri() . '/portal/view/app.css', array(), $result_version );

    wp_enqueue_script( 'draim_jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true );
    wp_enqueue_script( 'draim_jmigrate', '//code.jquery.com/jquery-migrate-1.4.1.min.js', array(), '1.4.1', true );
    wp_enqueue_script( 'draim_app', get_template_directory_uri() . '/view/app.js', array(), $result_version, true );
    wp_enqueue_script( 'draim_portal_app', get_template_directory_uri() . '/portal/view/app.js', array(), $result_version, true );

    wp_localize_script( 'draim_script_portal_app', 'ajaxurl',
      array(
        'url' => admin_url('admin-ajax.php')
      ));

  } else {

    wp_enqueue_style( 'draim_fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), $result_version );
    wp_enqueue_style( 'draim_app', get_template_directory_uri() . '/view/app.css', array(), $result_version );

    wp_enqueue_script( 'draim_jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true );
    wp_enqueue_script( 'draim_app', get_template_directory_uri() . '/view/app.js', array(), $result_version, true );

    wp_localize_script( 'draim_script_app', 'ajaxurl',
    array(
      'url' => admin_url('admin-ajax.php')
    ));

  }
}

add_action('wp_enqueue_scripts','print_styles_scripts');
