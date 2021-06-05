<?php
$wp_login_page = ABSPATH.'/wp-login.php';
require 'lib/post_type.php';
require 'lib/functions.php';

if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
}

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/template-assets.php';

//Регистрация миниатюр
if(function_exists('add_theme_support')){
    add_theme_support('post-thumbnails');
}
register_nav_menus(array(
	'top_menu'=>'Top Menu',
	'footer_menu'=>'Footer Menu',
	'sub_footer_menu'=>'Sub Footer Menu',
    'portal_header_menu'=>'Portal Header Menu',
    'resources_menu'=>'Resources Menu',
    'product_menu'=>'Product Menu',
    'mobile_print_menu'=>'Mobile Print Menu',
    'blog_menu'=>'Blog Menu',
    'second_top_menu'=>'Second Top Menu',
    'mobile_menu'=>'Mobile Menu'
));
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'post_id' => 'everyoneprint_options',
		'page_title' 	=> 'Everyoneprint Settings',
		'menu_title'	=> 'Everyoneprint Settings',
		'menu_slug' 	=> 'everyoneprint-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'icon_url' => get_template_directory_uri().'/images/menu_settings_icon.png'
	));
}
add_filter( 'upload_mimes', 'svg_upload_allow' );

//Функция добавления колонки "Миниатюра" в списке записей и страниц
function wph_columns_names($defaults){
    $defaults['wph_thumbs'] = 'Миниатюры';
    return $defaults;
}
function wph_add_thumbs($column_name, $id){
    if($column_name === 'wph_thumbs'){
        echo the_post_thumbnail(array(125,80));
    }
}
add_filter('manage_posts_columns', 'wph_columns_names', 5);
add_action('manage_posts_custom_column', 'wph_add_thumbs', 5, 2);
add_filter('manage_pages_columns', 'wph_columns_names', 5);
add_action('manage_pages_custom_column', 'wph_add_thumbs', 5, 2);
# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	return $mimes;
}

add_shortcode('news_block','news_block_function');

function news_block_function($atts){
    $atts = shortcode_atts( array(
        'id' => ''
    ), $atts, 'news_block' );
    ?>
    <div class="news_block_wrapper">
        <div class="wrapper">
            <?php $portal_news = new WP_Query(array(
                'post_type'=>'partnernews',
                'posts_per_page'=>3,
                'order'=>'DESC',
                'tax_query'=>array(
                    array(
                        'taxonomy'=>'newscategory',
                        'terms'=>$atts['id']
                    )
                )
            ))?>
            <div class="news_block">
                <?php while($portal_news->have_posts()){ $portal_news->the_post();?>
                    <div class="news_item">
                        <a class="news_item_title" href="<?php the_permalink();?>"><?php the_title();?></a>
                        <div class="news_meta">
                            <?php $tax = get_the_terms(get_the_ID(),'newscategory'); $term_id = $tax[0]->term_id?>
                            <span class="news_meta_date"><?php the_time('M d, Y');?></span> | <a class="news_meta_tax" href="<?php echo get_term_link($term_id)?>"><?php echo $tax[0]->name;?></a>
                        </div>
                        <div class="news_item_excerpt"><?php echo kama_excerpt(['maxchar'=>100]);?></div>
                    </div>
                <?php };?>
            </div>
            <?php if ($portal_news->max_num_pages > 1){ ?>
                <script>
                    var true_posts = '<?php echo serialize($portal_news->query_vars); ?>';
                    var current_page = '<?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>';
                    var max_pages = '<?php echo $portal_news->max_num_pages; ?>';
                </script>
                <div class="loadmore_block">
                    <a href="#" data-wrapper="news_block" data-block="load_news" class="load_more_btn ib">Older Entries</a>
                </div>
            <?php }; ?>
        </div>
    </div>
    <?php
}

function loadmore_function(){
    $data_block = wp_strip_all_tags($_POST['data_block']);
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';
    $q = new WP_Query($args);
    while($q->have_posts()){ $q->the_post();//the_title();
        ?>
        <?php if($data_block == 'search_load_news'){ ?>
            <?php //Loading search news block ?>
            <div class="news_post">
                <h2>
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </h2>
                <div class="news_meta">
                    <?php $tax = get_the_terms(get_the_ID(),'newscategory'); $term_id = $tax[0]->term_id?>
                    <span class="news_meta_date"><?php the_time('M d, Y');?></span> | <a class="news_meta_tax" href="<?php echo get_term_link($term_id)?>"><?php echo $tax[0]->name;?></a>
                </div>
                <div class="news_content">
                    <?php the_excerpt();?>
                </div>
            </div>
        <?php }else{ ?>
            <div class="news_item">
                <a class="news_item_title" href="<?php the_permalink();?>"><?php the_title();?></a>
                <div class="news_meta">
                    <?php $tax = get_the_terms(get_the_ID(),'newscategory'); $term_id = $tax[0]->term_id?>
                    <span class="news_meta_date"><?php the_time('M d, Y');?></span> | <a class="news_meta_tax" href="<?php echo get_term_link($term_id);?>"><?php echo $tax[0]->name;?></a>
                </div>
                <div class="news_item_excerpt"><?php echo kama_excerpt(['maxchar'=>100]);?></div>
            </div>
        <?php };?>
        <?php
    };
    die();
}


add_action('wp_ajax_loadmore', 'loadmore_function');
add_action('wp_ajax_nopriv_loadmore', 'loadmore_function');

function wph_create_excerpt_box() {
    global $post;
    $id = 'excerpt';
    $excerpt = wph_get_excerpt($post->ID);
    wp_editor($excerpt, $id);
}
function wph_get_excerpt($id) {
    global $wpdb;
    $row = $wpdb->get_row("SELECT post_excerpt FROM $wpdb->posts WHERE id = $id");
    return $row->post_excerpt;
}
function wph_replace_excerpt() {
    foreach (array("partnernews") as $type) {
        remove_meta_box('postexcerpt', $type, 'normal');
        add_meta_box('postexcerpt', __('Excerpt'), 'wph_create_excerpt_box', $type, 'normal');
    }
}
add_action('admin_init', 'wph_replace_excerpt');

/**
 * Cuts the specified text up to specified number of characters.
 *
 * Strips any of WordPress shortcodes.
 *
 * @author Kama (wp-kama.ru)
 *
 * @version 2.7.0
 *
 * @param string|array $args {
 *     Optional. Arguments to customize output.
 *
 *     @type int       $maxchar            Макс. количество символов.
 *     @type string    $text               Текст который нужно обрезать. По умолчанию post_excerpt, если нет post_content.
 *                                         Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется
 *                                         все до `<!--more-->` вместе с HTML.
 *     @type bool      $autop              Заменить переносы строк на `<p>` и `<br>` или нет?
 *     @type string    $more_text          Текст ссылки `Читать дальше`.
 *     @type string    $save_tags          Теги, которые нужно оставить в тексте. Например `'<strong><b><a>'`.
 *     @type string    $sanitize_callback  Функция очистки текста.
 *     @type bool      $ignore_more        Нужно ли игнорировать <!--more--> в контенте.
 *
 * }
 *
 * @return string HTML
 */
function kama_excerpt( $args = '' ){
    global $post;

    if( is_string( $args ) ){
        parse_str( $args, $args );
    }

    $rg = (object) array_merge( [
        'maxchar'           => 350,
        'text'              => '',
        'autop'             => true,
        'more_text'         => 'Читать дальше...',
        'ignore_more'       => false,
        'save_tags'         => '',
        'sanitize_callback' => 'strip_tags',
    ], $args );

    $rg = apply_filters( 'kama_excerpt_args', $rg );

    if( ! $rg->text ){
        $rg->text = $post->post_excerpt ?: $post->post_content;
    }

    $text = $rg->text;
    // strip content shortcodes: [foo]some data[/foo]. Consider markdown
    $text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
    // strip others shortcodes: [singlepic id=3]. Consider markdown
    $text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
    $text = trim( $text );

    // <!--more-->
    if( ! $rg->ignore_more && strpos( $text, '<!--more-->' ) ){
        preg_match( '/(.*)<!--more-->/s', $text, $mm );

        $text = trim( $mm[1] );

        $text_append = ' <a href="' . get_permalink( $post ) . '#more-' . $post->ID . '">' . $rg->more_text . '</a>';
    }
    // text, excerpt, content
    else {

        $text = 'strip_tags' === $rg->sanitize_callback
            ? strip_tags( $text, $rg->save_tags )
            : call_user_func( $rg->sanitize_callback, $text, $rg );

        $text = trim( $text );

        // cut
        if( mb_strlen( $text ) > $rg->maxchar ){
            $text = mb_substr( $text, 0, $rg->maxchar );
            $text = preg_replace( '/(.*)\s[^\s]*$/s', '\\1...', $text ); // del last word, it not complate in 99%
        }
    }

    // add <p> tags. Simple analog of wpautop()
    if( $rg->autop ){
        $text = preg_replace(
            [ "/\r/", "/\n{2,}/", "/\n/", '~</p><br ?/?>~' ],
            [ '', '</p><p>', '<br />', '</p>' ],
            $text
        );
    }

    $text = apply_filters( 'kama_excerpt', $text, $rg );

    if( isset( $text_append ) ){
        $text .= $text_append;
    }

    return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}


function draim_menu($menu){
    wp_nav_menu(array('theme_location'=>$menu,'items_wrap' => '%3$s','container'=>false));
}



/*function redirect_login_page() {
    $login_page  = home_url( '/login' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);

    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}*/
//add_action('init','redirect_login_page');
/*
 * Редиректы обратно на кастомную форму входа в случае ошибки
 */
add_filter( 'authenticate', 'misha_redirect_at_authenticate', 101, 3 );

function misha_redirect_at_authenticate( $user, $username, $password ) {

    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        if ( is_wp_error( $user ) ) {
            $error_codes = join( ',', $user->get_error_codes() );

            $login_url = home_url( '/login/' );
            $login_url = add_query_arg( 'errno', $error_codes, $login_url );

            wp_redirect( $login_url );
            exit;
        }
    }

    return $user;
}


add_shortcode( 'misha_custom_passreset', 'misha_render_pass_reset_form' ); // шорткод [misha_custom_passreset]

function misha_render_pass_reset_form() {

    // если пользователь авторизован, просто выводим сообщение и выходим из функции
    if ( is_user_logged_in() ) {
        $portal_page = get_post_type_archive_link('portal');
        wp_safe_redirect($portal_page);
        //return sprintf( "Вы уже авторизованы на сайте. <a href='%s'>Выйти</a>.", wp_logout_url() );
    }

    $return = ''; // переменная, в которую всё будем записывать

    // обработка ошибок, если вам нужны такие же стили уведомлений, как в видео, CSS-код прикладываю чуть ниже
    if ( isset( $_REQUEST['errno'] ) ) {
        $errors = explode( ',', $_REQUEST['errno'] );

        foreach ( $errors as $error ) {
            switch ( $error ) {
                case 'empty_username':
                    $return .= '<p class="errno">Вы не забыли указать свой email?</p>';
                    break;
                case 'password_reset_empty':
                    $return .= '<p class="errno">Укажите пароль!</p>';
                    break;
                case 'password_reset_mismatch':
                    $return .= '<p class="errno">Пароли не совпадают!</p>';
                    break;
                case 'invalid_email':
                case 'invalidcombo':
                    $return .= '<p class="errno">На сайте не найдено пользователя с указанным email.</p>';
                    break;
            }
        }
    }

    // тем, кто пришёл сюда по ссылке из email, показываем форму установки нового пароля
    if ( isset( $_GET['login'] ) && isset( $_GET['key'] ) ) {
        $return .= '            
        <div class="lost_pass_form">
            <h2>Reset your <br /><span>password</span></h2>
			<form name="resetpassform" id="resetpassform" action="' . site_url( 'wp-login.php?action=resetpass' ) . '" method="post" autocomplete="off">
				<input type="hidden" id="user_login" name="login" value="' . esc_attr( $_REQUEST['login'] ) . '" autocomplete="off" />
				<input type="hidden" name="key" value="' . esc_attr( $_REQUEST['key'] ) . '" />
				<h3>Create new password</h3>
				<div class="attention">
				    Your new password must be different from previous used passwords.
                </div>
                <div class="input_title">                
                    <label for="pass1">Password</label>
                </div>
                <div class="pass_wrapper">                
                    <input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" />
                    <a href="#" class="show_pass"></a>
                </div>
                <ul class="check">
                   <li id="length">Must be at least 8 characters.</li> 
                   <li id="lowercase">Must have at least 1 lowercase character.</li> 
                   <li id="numb">Must have at least 1 number.</li> 
                   <li id="upper">Must have at least 1 upercase character.</li> 
                </ul>
                <div class="input_title">    
                    <label for="pass2">Confirm password</label>
                </div>
                <div class="pass_wrapper">    
                    <input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" /> 
                    <a href="#" class="show_pass"></a>
                </div>
                <ul class="check">
                   <li id="match">Both passwords must match.</li>
                </ul>
                <a href="#" class="reset_click btn red_btn">Reset password</a>
                <input type="submit" name="submit" id="resetpass-button" class="button btn red_btn" value="Reset password" />
            </form>
		</div>';

        // возвращаем форму и выходим из функции
        return $return;
    }

    // всем остальным - обычная форма сброса пароля (1-й шаг, где указываем email)
    $return .= '
        <div class="lost_pass_form">
            <h2>Reset your <br /><span>password</span></h2>
            <form id="lostpasswordform" action="' . wp_lostpassword_url() . '" method="post">
                <p style="font-size:18px;">Please enter your username or email <br /> address. You will receive a link to create a <br /> new password via email.</p>
                <div class="input_title">
                    <label for="user_login">Username or E-mail</label>
                </div>
                <input type="text" required name="user_login" id="user_login" placeholder="example@gmail.com">
                <input type="submit" name="submit" class="lostpassword-button btn red_btn" value="Get new password" />
                <div class="bottom">
                    <span class="remember">Remember your password?</span>
                    <a href="' .get_permalink(2849). '" class="login_link">Log in</a>
                </div>
            </form>
		</div>';

    // возвращаем форму и выходим из функции
    return $return;
}

/*
 * перенаправляем стандартную форму
 */
add_action( 'lostpassword_form', 'misha_pass_reset_redir' );

function misha_pass_reset_redir() {
    require_once ABSPATH . '/wp-login.php';
    $forgot_pass_page_slug = '/lostpass';
    $login_page_slug = '/login';
    // если кто-то перешел на страницу сброса пароля
    // (!) именно перешел, а не отправил формой,
    // тогда перенаправляем на нашу кастомную страницу сброса пароля
    if ( 'GET' == $_SERVER['REQUEST_METHOD'] && !is_user_logged_in() ) {
        wp_redirect( site_url( $forgot_pass_page_slug ) );
        exit;
    }
    else if ( 'POST' == $_SERVER['REQUEST_METHOD']) {
        // если же напротив, была отправлена форма
        // юзаем retrieve_password()
        // которая отправляет на почту ссылку сброса пароля
        // пользователю, который указан в $_POST['user_login']
        $errors = retrieve_password();
        if ( is_wp_error( $errors ) ) {
            // если возникли ошибки, возвращаем пользователя назад на форму
            $to = site_url( $forgot_pass_page_slug );
            $to = add_query_arg( 'errno', join( ',', $errors->get_error_codes() ), $to );
            exit;
        } else {
            // если ошибок не было, перенаправляем на логин с сообщением об успехе
            $to = site_url( $login_page_slug );
            $to = add_query_arg( 'errno', 'confirm', $to );
        }

        // собственно сам редирект
        wp_redirect( $to );
        exit;
    }
}

/*
 * Манипуляции уже после перехода по ссылке из письма
 */
add_action( 'login_form_rp', 'misha_to_custom_password_reset' );
add_action( 'login_form_resetpass', 'misha_to_custom_password_reset' );

function misha_to_custom_password_reset(){

    $key = $_REQUEST['key'];
    $login = $_REQUEST['login'];
    // если используете другой ярлык страницы сброса пароля, укажите здесь
    $forgot_pass_page_slug = '/lostpass';
    // если используете другой ярлык страницы входа, укажите здесь
    $login_page_slug = '/login';

    // проверку соответствия ключа и логина проводим в обоих случаях
    if ( ( 'GET' == $_SERVER['REQUEST_METHOD'] || 'POST' == $_SERVER['REQUEST_METHOD'] )
        && isset( $key ) && isset( $login ) ) {

        $user = check_password_reset_key( $key, $login );

        if ( ! $user || is_wp_error( $user ) ) {
            if ( $user && $user->get_error_code() === 'expired_key' ) {
                wp_redirect( site_url( $login_page_slug . '?errno=expiredkey' ) );
            } else {
                wp_redirect( site_url( $login_page_slug . '?errno=invalidkey' ) );
            }
            exit;
        }

    }

    if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {

        $to = site_url( $forgot_pass_page_slug );
        $to = add_query_arg( 'login', esc_attr( $login ), $to );
        $to = add_query_arg( 'key', esc_attr( $key ), $to );

        wp_redirect( $to );
        exit;

    } elseif ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {

        if ( isset( $_POST['pass1'] ) ) {

            if ( $_POST['pass1'] != $_POST['pass2'] ) {
                // если пароли не совпадают
                $to = site_url( $forgot_pass_page_slug );

                $to = add_query_arg( 'key', esc_attr( $key ), $to );
                $to = add_query_arg( 'login', esc_attr( $login ), $to );
                $to = add_query_arg( 'errno', 'password_reset_mismatch', $to );

                wp_redirect( $to );
                exit;
            }

            if ( empty( $_POST['pass1'] ) ) {
                // если поле с паролем пустое
                $to = site_url( $forgot_pass_page_slug );

                $to = add_query_arg( 'key', esc_attr( $key ), $to );
                $to = add_query_arg( 'login', esc_attr( $login ), $to );
                $to = add_query_arg( 'errno', 'password_reset_empty', $to );

                wp_redirect( $to );
                exit;
            }

            // тут кстати вы можете задать и свои проверки, например, чтобы длина пароля была 8 символов
            // с паролями всё окей, можно сбрасывать
            reset_password( $user, $_POST['pass1'] );
            wp_redirect( site_url( $login_page_slug . '?errno=changed' ) );

        } else {
            // если что-то пошло не так
            echo "Что-то пошло не так.";
        }

        exit;

    }

}
/*
 * Добавляем шорткод, его можно использовать в содержимом любой статьи или страницы, вставив [misha_custom_login]
 */
add_shortcode( 'misha_custom_login', 'misha_render_login' );

function misha_render_login() {

    // проверяем, если пользователь уже авторизован, то выводим соответствующее сообщение и ссылку "Выйти"
    if ( is_user_logged_in() ) {
        $portal_page = get_post_type_archive_link('portal');
        wp_safe_redirect($portal_page);
    }

    // присваиваем содержимое формы переменной и затем возвращаем её, выводить через echo() мы не можем, так как это шорткод
    $return = '<div class="login-form-container"><h2>Partner Zone <br /><span>Log In</span></h2>';

    // если возникли какие-либо ошибки, отображаем их
    if ( isset( $_REQUEST['errno'] ) ) {
        $error_codes = explode( ',', $_REQUEST['errno'] );

        foreach ( $error_codes as $error_code ) {
            switch ( $error_code ) {
                case 'empty_username':
                    $return .= '<p class="errno">Did you remember to enter your email/username?</p>';
                    break;
                case 'empty_password':
                    $return .= '<p class="errno">Please enter your password.</p>';
                    break;
                case 'invalid_username':
                    $return .= '<p class="errno">The specified user was not found on the site.</p>';
                    break;
                case 'incorrect_password':
                    $return .= sprintf( "<p class='errno'>Invalid password. <a href='%s'>Forgot it</a>?</p>", get_permalink(8866) );
                    break;
                case 'confirm':
                    $return .= '<p class="errno success">Instructions for resetting your password have been sent to your email address.</p>';
                    break;
                case 'changed':
                    $return .= '<p class="errno success">The password was successfully changed.</p>';
                    break;
                case 'expiredkey':
                case 'invalidkey':
                    $return .= '<p class="errno">Invalid key.</p>';
                    break;
            }
        }
    }

    // используем wp_login_form() для вывода формы (но можете сделать это и на чистом HTML)
    $return .= '<form name="loginform" id="Loginform" action="'. site_url() . '/login" method="post">
                <div class="input_wrap">
                    <div class="input_title">
                        <label for="user_login">Username or E-mail</label>                   
                    </div>                  
                    <div class="pass_wrapper">                
                        <input required type="text" name="log" id="user_login" class="input" value="" size="20" tabindex="10" />
                    </div>
                </div>
                <div class="input_wrap">
                    <div class="input_title">
                        <label for="user_pass">Password</label>                 
                    </div>                    
                    <div class="pass_wrapper">                
                        <input required type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" />
                        <a href="#" class="show_pass"></a>
                    </div>
                </div>
                <div class="input_wrap remember_footer">
                    <div class="input_col">
                        <label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /><span>Remember me</span></label>
                    </div>
                    <div class="input_col right"><a href="' .get_permalink(8866) .'"><span>Lost password?</span></a></div>
                </div>
            
                <p class="login-submit">
                    <input type="submit" name="wp-submit" id="wp-submit" class="button-primary btn red_btn" value="Log In" tabindex="100" />
                    <input type="hidden" name="redirect_to" value="' . site_url() . '/wp-admin" />
                </p>
                
                <div class="sub_footer">
                    <span>Don’t have an account?</span>
                    <a href="' .get_permalink(8870) . '" class="">Sign up</a>
                </div>
            
            </form>';

    $return .= '</div>';

    // и наконец возвращаем всё, что получилось
    return $return;
}

/*
 * Редиректы после выхода с сайта
 */
add_action( 'wp_logout', 'misha_logout_redirect', 5 );

function misha_logout_redirect(){
    wp_safe_redirect( site_url( '/login/?logged_out=true' ) );
    exit;
}

function load_blog_posts(){
    $cat_id = wp_strip_all_tags($_POST['data_cat']);
    ?>
    <?php $all = new WP_Query(array(
        'cat'=>$cat_id,
        'posts_per_page'=>-1
    ))?>
    <div class="slider_blog">
        <div class="swiper-wrapper">
            <?php while($all->have_posts()){ $all->the_post();?>
                <div class="swiper-slide blog_item">
                    <div class="blog_item_thumb">
                        <?php the_post_thumbnail();?>
                    </div>
                    <div class="blog_item_info">
                        <div class="blog_item_meta">
                            <span class="blog_item_meta_author"><?php the_author();?></span>
                            <span class="blog_item_meta_date"><?php the_time('d M Y');?></span>
                        </div>
                        <div class="blog_item_title"><?php the_title();?></div>
                        <a class="blog_item_permalink" href="<?php the_permalink();?>">Read more ></a>
                    </div>
                </div>
            <?php };?>
        </div>
        <div class="blog_pagination_wrapper">
            <div class="blog_pagination"></div>
        </div>
    </div>
    <script>
        var blog_slider = new Swiper('.slider_blog', {
            slidesPerView:3,
            spaceBetween: 30,
            slidesPerGroup: 3,
            loop:true,
            loopFillGroupWithBlank:true,
            pagination: {
                el: '.blog_pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + (index + 1) + '</span>';
                },
            },
        });
        var pagination_wrap = $('.blog_pagination');
        pagination_wrap.first().before('<a href="#" class="blog_pagination_item blog_pagination_prev"></a>');
        pagination_wrap.last().after('<a href="#" class="blog_pagination_item blog_pagination_next"></a>');
        $('.blog_pagination_prev').on('click',function(e){
            e.preventDefault();
            blog_slider.slidePrev();
        })
        $('.blog_pagination_next').on('click',function(e){
            e.preventDefault();
            blog_slider.slideNext();
        })
    </script>
    <?php
    die();
}
add_action('wp_ajax_load_blog', 'load_blog_posts');
add_action('wp_ajax_nopriv_load_blog', 'load_blog_posts');


add_shortcode('other_updates','other_updates_callback');


function other_updates_callback($atts){
    global $post_id;
    $atts = shortcode_atts( array(
        'exclude'=>'',
        'posts_per_page'=>'2',
        'show_need'=>'false',
        'category'=>array(2,150)
    ), $atts, 'other_updates' );
    ?>
    <section class="other_updates wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
        <div class="wrapper">
            <div class="ou_title">More Updates</div>
            <div class="ou_list">
                <?php if($atts['show_need'] == 'false'){ ?>
                    <?php $exclude_ids = array($atts['exclude']);?>
                    <?php $other_updates = new WP_Query(array(
                        'post_type'=>'post',
                        'order'=>'DESC',
                        'posts_per_page'=>$atts['posts_per_page'],
                        'post__not_in'=>$exclude_ids,
                        'post_status'=>'publish',
                        'cat'=>$atts['category']
                    ));?>
                <?php }else{ ?>
                    <?php $exclude_ids = array($atts['exclude']);?>
                    <?php $other_updates = new WP_Query(array(
                        'post_type'=>'post',
                        'order'=>'DESC',
                        'posts_per_page'=>$atts['posts_per_page'],
                        'post__not_in'=>$exclude_ids,
                        'post_status'=>'publish',
                        'meta_query'=>array(
                            array(
                                'key'=>'show_in_other_updates',
                                'value'=>1
                            )
                        ),
                        'cat'=>$atts['category']
                    ));?>
                <?php };?>
                <?php while($other_updates->have_posts()){ $other_updates->the_post();?>
                    <div class="ou_item">
                        <div class="ou_left">
                            <a href="<?php the_permalink();?>" class="ou_thumb">
                                <?php $ou_image = get_field('other_updates_image');?>
                                <?php if($ou_image['url'] != ''){ ?>
                                    <img src="<?php echo $ou_image['url'];?>" alt="<?php echo $ou_image['alt'];?>" />
                                <?php }else{ ?>
                                    <?php the_post_thumbnail();?>
                                <?php };?>
                            </a>
                        </div>
                    <div class="ou_right">
                        <?php $current_pt = get_the_category();
                        $curr_name = $current_pt[0]->slug;
                        ?>
                        <div class="ou_category<?php if($curr_name == 'webinar'){ ?> ou_category_webinar <?php };?>">
                            <a href="<?php echo get_category_link($current_pt[0]->term_id);?>"><?php echo $current_pt[0]->name?></a>
                        </div>
                        <?php
                        $ou_title = get_field('other_updates_title');
                        $ou_link_text = get_field('other_updates_link_text');
                        ?>
                        <div class="ou_item_title">
                            <a href="<?php the_permalink();?>">
                                <?php if($ou_title != ''){ echo $ou_title;?>

                                <?php }else{ the_title(); };?>
                            </a>
                        </div>
                        <a href="<?php the_permalink();?>" class="ou_permalink"><?php if($ou_link_text != ''){ echo $ou_link_text; }else{ ?>Read more ><?php };?></a>
                    </div>
                    </div>
                <?php };?>
            </div>
        </div>
    </section>
    <?php
}
function only_admin()
{
    if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
        wp_redirect( get_post_type_archive_link('portal') );
    }
}
add_action( 'admin_init', 'only_admin', 1 );

if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}