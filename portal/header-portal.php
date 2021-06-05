<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <script src="https://kit.fontawesome.com/14cb8d023c.js" crossorigin="anonymous"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-home-url="<?php echo esc_url(home_url('/')); ?>" >
<?php
do_action('gdlr_core_after_body');
do_action('gdlr_core_top_privacy_box');

$body_wrapper_class = '';

$header_style = infinite_get_option('general', 'header-style', 'plain');
if( $header_style == 'side' ){

    $header_side_class  = ' infinite-style-side';
    $header_side_style = infinite_get_option('general', 'header-side-style', 'top-left');

    switch( $header_side_style ){
        case 'top-left':
            $header_side_class .= ' infinite-style-left';
            $body_wrapper_class .= ' infinite-left';
            break;
        case 'top-right':
            $header_side_class .= ' infinite-style-right';
            $body_wrapper_class .= ' infinite-right';
            break;
        case 'middle-left':
        case 'middle-left-2':
            $header_side_class .= ' infinite-style-left infinite-style-middle';
            $body_wrapper_class .= ' infinite-left';
            break;
        case 'middle-right':
        case 'middle-right-2':
            $header_side_class .= ' infinite-style-right infinite-style-middle';
            $body_wrapper_class .= ' infinite-right';
            break;
        default:
            break;
    }
}else if( $header_style == 'side-toggle' ){

    $header_side_style = infinite_get_option('general', 'header-side-toggle-style', 'left');

    $header_side_class  = ' infinite-style-side-toggle';
    $header_side_class .= ' infinite-style-' . $header_side_style;
    $body_wrapper_class .= ' infinite-' . $header_side_style;

}else if( $header_style == 'boxed' ){

    $body_wrapper_class .= ' infinite-with-transparent-header';

}else{

    $header_background_style = infinite_get_option('general', 'header-background-style', 'solid');

    if( $header_background_style == 'transparent' ){
        if( $header_style == 'plain' ){
            $body_wrapper_class .= ' infinite-with-transparent-header';
        }else if( $header_style == 'bar' ){
            $body_wrapper_class .= ' infinite-with-transparent-navigation';
        }
    }
}
$layout = infinite_get_option('general', 'layout', 'full');
if( $layout == 'full' && in_array($header_style, array('plain', 'bar', 'boxed')) ){
    $body_wrapper_class .= ' infinite-with-frame';
}

$post_option = infinite_get_post_option(get_the_ID());

// mobile menu
$body_outer_wrapper_class = '';
if( empty($post_option['enable-header-area']) || $post_option['enable-header-area'] == 'enable' ){
    get_template_part('header/header', 'mobile');
}else{
    $body_outer_wrapper_class = ' infinite-header-disable';
}

// preload
$preload = infinite_get_option('plugin', 'enable-preload', 'disable');
if( $preload == 'enable' ){
    echo '<div class="infinite-page-preload gdlr-core-page-preload gdlr-core-js" id="infinite-page-preload" data-animation-time="500" ></div>';
}
?>
<div class="infinite-body-outer-wrapper <?php echo esc_attr($body_outer_wrapper_class); ?>">
    <?php
    get_template_part('header/header', 'bullet-anchor');

    if( $layout == 'boxed' ){
        if( !empty($post_option['body-background-type']) && $post_option['body-background-type'] == 'image' ){
            echo '<div class="infinite-body-background" ' . gdlr_core_esc_style(array(
                    'background-image' => empty($post_option['body-background-image'])? '': $post_option['body-background-image'],
                    'opacity' => empty($post_option['body-background-image-opacity'])? '': (floatval($post_option['body-background-image-opacity']) / 100)
                )) . ' ></div>';
        }else{
            $background_type = infinite_get_option('general', 'background-type', 'color');
            if( $background_type == 'image' ){
                echo '<div class="infinite-body-background" ></div>';
            }
        }
    }
    ?>
    <div class="infinite-body-wrapper clearfix <?php echo esc_attr($body_wrapper_class); ?>">
        <?php

        if( empty($post_option['enable-header-area']) || $post_option['enable-header-area'] == 'enable' ){

            if( $header_style == 'side' || $header_style == 'side-toggle' ){


                echo '<div class="infinite-header-side-nav infinite-header-background ' . esc_attr($header_side_class) . '" id="infinite-header-side-nav" >';

                // header - logo area
                get_template_part('header/header-style', $header_style);

                echo '</div>';
                echo '<div class="infinite-header-side-content ' . esc_attr($header_side_class) . '" >';

                get_template_part('header/header', 'top-bar');

                // closing tag is in footer

            }else{

                // header slider
                $print_top_bar = false;
                if( !empty($post_option['header-slider']) && $post_option['header-slider'] != 'none' ){
                    $print_top_bar = true;
                    get_template_part('header/header', 'top-bar');

                    get_template_part('header/header', 'top-slider');
                }

                // header nav area
                $close_div = false;
                if( $header_style == 'plain' ){
                    if( $header_background_style == 'transparent' ){
                        $close_div = true;
                        echo '<div class="infinite-header-background-transparent" >';
                    }
                }else if( $header_style == 'boxed' ){
                    $close_div = true;
                    echo '<div class="infinite-header-boxed-wrap" >';
                }

                // top bar area
                if( !$print_top_bar ){
                    get_template_part('header/header', 'top-bar');
                }
                // header - logo area
	/* a template for displaying the header area */

	// header container
	$body_layout = infinite_get_option('general', 'layout', 'full');
	$body_margin = infinite_get_option('general', 'body-margin', '0px');
	$header_width = infinite_get_option('general', 'header-width', 'boxed');
	$header_background_style = infinite_get_option('general', 'header-background-style', 'solid');

	if( $header_width == 'boxed' ){
		$header_container_class = ' infinite-container';
	}else if( $header_width == 'custom' ){
		$header_container_class = ' infinite-header-custom-container';
	}else{
		$header_container_class = ' infinite-header-full';
	}

	$header_style = infinite_get_option('general', 'header-plain-style', 'menu-right');
	$navigation_offset = infinite_get_option('general', 'fixed-navigation-anchor-offset', '');

	$header_wrap_class  = ' infinite-style-' . $header_style;
	$header_wrap_class .= ' infinite-sticky-navigation';
	if( $header_style == 'center-logo' || $body_layout == 'boxed' ||
		$body_margin != '0px' || $header_background_style == 'transparent' ){

		$header_wrap_class .= ' infinite-style-slide';
	}else{
		$header_wrap_class .= ' infinite-style-fixed';
	}
?>
        <header class="infinite-header-wrap infinite-header-style-plain <?php echo esc_attr($header_wrap_class); ?>" <?php
        if( !empty($navigation_offset) ){
            echo 'data-navigation-offset="' . esc_attr($navigation_offset) . '" ';
        }
        ?> >
            <div class="infinite-header-background" ></div>
            <div class="infinite-header-container <?php echo esc_attr($header_container_class); ?>">

                <div class="infinite-header-container-inner clearfix">
                    <?php

                    if( $header_style == 'splitted-menu' && has_nav_menu('main_menu') ){
                        add_filter('infinite_center_menu_item', 'infinite_get_logo');
                    }else{
                        echo infinite_get_logo();
                    }

                    $navigation_class = '';
                    if( infinite_get_option('general', 'enable-main-navigation-submenu-indicator', 'disable') == 'enable' ){
                        $navigation_class = 'infinite-navigation-submenu-indicator ';
                    }
                    ?>
                    <div class="infinite-navigation infinite-item-pdlr clearfix <?php echo esc_attr($navigation_class); ?>" >
                        <?php
                        // print main menu
                        if( has_nav_menu('main_menu') ){
                            echo '<div class="infinite-main-menu" id="infinite-main-menu" >';
                            wp_nav_menu(array(
                                'theme_location'=>'portal_header_menu',
                                'container'=> '',
                                'menu_class'=> 'sf-menu',
                                'walker' => new infinite_menu_walker()
                            ));
                            $slide_bar = infinite_get_option('general', 'navigation-slide-bar', 'enable');
                            if( $slide_bar == 'enable' ){
                                echo '<div class="infinite-navigation-slide-bar" id="infinite-navigation-slide-bar" ></div>';
                            }
                            echo '</div>';
                        }

                        // menu right side
                        $menu_right_class = '';
                        if( in_array($header_style, array('center-menu', 'center-logo', 'splitted-menu')) ){
                            $menu_right_class = ' infinite-item-mglr infinite-navigation-top';
                        }

                        $enable_search = (infinite_get_option('general', 'enable-main-navigation-search', 'enable') == 'enable')? true: false;
                        $enable_cart = (infinite_get_option('general', 'enable-main-navigation-cart', 'enable') == 'enable' && class_exists('WooCommerce'))? true: false;
                        $enable_right_button = (infinite_get_option('general', 'enable-main-navigation-right-button', 'disable') == 'enable')? true: false;
                        if( has_nav_menu('right_menu') || $enable_search || $enable_cart || $enable_right_button ){
                            echo '<div class="infinite-main-menu-right-wrap clearfix ' . esc_attr($menu_right_class) . '" >';

                            // search icon
                            if( $enable_search ){
                                echo '<div class="infinite-main-menu-search" id="infinite-top-search" >';
                                echo '<i class="fa fa-search" ></i>';
                                echo '</div>';
                                infinite_get_top_search();
                            }

                            // cart icon
                            if( $enable_cart ){
                                echo '<div class="infinite-main-menu-cart" id="infinite-menu-cart" >';
                                echo '<i class="fa fa-shopping-cart" data-infinite-lb="top-bar" ></i>';
                                infinite_get_woocommerce_bar();
                                echo '</div>';
                            }

                            // menu right button
                            if( $enable_right_button ){
                                $button_class = 'infinite-style-' . infinite_get_option('general', 'main-navigation-right-button-style', 'default');
                                $button_link = infinite_get_option('general', 'main-navigation-right-button-link', '');
                                $button_link_target = infinite_get_option('general', 'main-navigation-right-button-link-target', '_self');
                                echo '<a class="infinite-main-menu-right-button ' . esc_attr($button_class) . '" href="' . esc_url($button_link) . '" target="' . esc_attr($button_link_target) . '" >';
                                echo infinite_get_option('general', 'main-navigation-right-button-text', '');
                                echo '</a>';
                            }

                            // print right menu
                            if( has_nav_menu('right_menu') && $header_style != 'splitted-menu' ){
                                infinite_get_custom_menu(array(
                                    'container-class' => 'infinite-main-menu-right',
                                    'button-class' => 'infinite-right-menu-button infinite-top-menu-button',
                                    'icon-class' => 'fa fa-bars',
                                    'id' => 'infinite-right-menu',
                                    'theme-location' => 'right_menu',
                                    'type' => infinite_get_option('general', 'right-menu-type', 'right')
                                ));
                            }

                            echo '</div>'; // infinite-main-menu-right-wrap

                            if( has_nav_menu('right_menu') && $header_style == 'splitted-menu'  ){
                                echo '<div class="infinite-main-menu-left-wrap clearfix infinite-item-pdlr infinite-navigation-top" >';
                                infinite_get_custom_menu(array(
                                    'container-class' => 'infinite-main-menu-right',
                                    'button-class' => 'infinite-right-menu-button infinite-top-menu-button',
                                    'icon-class' => 'fa fa-bars',
                                    'id' => 'infinite-right-menu',
                                    'theme-location' => 'right_menu',
                                    'type' => infinite_get_option('general', 'right-menu-type', 'right')
                                ));
                                echo '</div>';
                            }
                        }
                        ?>
                    </div><!-- infinite-navigation -->

                </div><!-- infinite-header-inner -->
            </div><!-- infinite-header-container -->
        </header><!-- header -->
                <?php
                if( !empty($close_div) ){
                    echo '</div>';
                }

            }

            // page title area
            if(!is_singular('partnernews')) {
                get_template_part('header/header', 'title');
            };

        } // enable header area

        ?>
        <div class="infinite-page-wrapper" id="infinite-page-wrapper" >