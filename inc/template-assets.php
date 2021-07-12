<?php

/**
* Include Styles & Scripts
*/

function print_styles_scripts() {

  $uniq = wp_generate_uuid4();
  $current_timestamp = time();
  $result_version = $uniq . $current_timestamp;

  if ( 
    is_post_type_archive( array( 'portal', 'partnernews' )) || 
    is_singular( array( 'portal', 'partnernews' )) || 
    is_tax( 'newscategory' ) || 
    is_page( 'partnerinfo' )) {

    wp_enqueue_style( 'draim_fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.css', array(), $result_version );
    wp_enqueue_style( 'draim_app', get_template_directory_uri() . '/assets/css/app.css', array(), $result_version );
    wp_enqueue_style( 'draim_portal_app', get_template_directory_uri() . '/assets/css/portal-app.css', array(), $result_version );
    wp_enqueue_style( 'draim_main', get_template_directory_uri() . '/assets/css/main.css', array(), $result_version );

    wp_enqueue_script( 'draim_jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true );
    wp_enqueue_script( 'draim_jmigrate', '//code.jquery.com/jquery-migrate-1.4.1.min.js', array(), '1.4.1', true );
    wp_enqueue_script( 'draim_app', get_template_directory_uri() . '/assets/js/app.js', array(), $result_version, true );
    wp_enqueue_script( 'draim_country', get_template_directory_uri() . '/assets/js/countrySelect.js', array(), $result_version, true );
    wp_enqueue_script( 'draim_ajax', get_template_directory_uri() . '/assets/js/ajax-auth.js', array(), $result_version, true );
    wp_enqueue_script( 'draim_main', get_template_directory_uri() . '/assets/js/main.js', array(), $result_version, true );
    // wp_enqueue_script( 'draim_portal_app', get_template_directory_uri() . '/portal/view/app.js', array(), $result_version, true );

    // wp_localize_script( 'draim_script_portal_app', 'ajaxurl',
    //   array(
    //     'url' => admin_url('admin-ajax.php')
    //   ));

  } else {
    
    wp_enqueue_style( 'draim_fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.css', array(), $result_version );
    wp_enqueue_style( 'draim_app', get_template_directory_uri() . '/assets/css/app.css', array(), $result_version );
    wp_enqueue_style( 'draim_main', get_template_directory_uri() . '/assets/css/main.css', array(), $result_version );

    wp_enqueue_script( 'draim_jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true );
    wp_enqueue_script( 'draim_country', get_template_directory_uri() . '/assets/js/countrySelect.js', array(), $result_version, true );
    wp_enqueue_script( 'draim_inptel', get_template_directory_uri() . '/assets/js/intl-tel-input/js/intlTelInput.js', array(), $result_version, true );
    wp_enqueue_script( 'draim_main', get_template_directory_uri() . '/assets/js/main.js', array(), $result_version, true );

    // wp_localize_script( 'draim_script_app', 'ajaxurl',
    // array(
    //   'url' => admin_url('admin-ajax.php')
    // ));

  }
}

add_action('wp_enqueue_scripts','print_styles_scripts');
