<?php

/*
 * Редиректы обратно на кастомную форму входа в случае ошибки
 */

function misha_redirect_at_authenticate( $user, $username, $password ) {
	if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
		if ( is_wp_error( $user )) {

			$error_codes = join( ',', $user->get_error_codes() );

			$login_url = home_url( '/login/' );
			$login_url = add_query_arg( 'errno', $error_codes, $login_url );

			wp_redirect( $login_url );
			exit;
		}
	}
	return $user;
}

add_filter( 'authenticate', 'misha_redirect_at_authenticate', 101, 3 );

/**
 * Сброс пароля
 *
 * Шорткод: [misha_custom_passreset]
 */

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

    // Тем, кто пришёл сюда по ссылке из email, показываем форму установки нового пароля
    if ( isset( $_GET['login'] ) && isset( $_GET['key'] ) ) {
        $return .= '            
					<div class="lost_pass_form">
						<h2>Reset your <br /><span>password</span></h2>
						<form name="resetpassform" 
									id="resetpassform" 
									action="' . site_url( 'wp-login.php?action=resetpass' ) . '" 
									method="post" 
									autocomplete="off">

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

        // Возвращаем форму и выходим из функции
        return $return;
    }

    // Всем остальным - обычная форма сброса пароля (1-й шаг, где указываем email)
    $return .= '
			<div class="lost_pass_form">
				<h2>Reset your <br /><span>password</span></h2>
				<form id="lostpasswordform" action="' . wp_lostpassword_url() . '" method="post">

				<p style="font-size:18px;">
					Please enter your username or email <br /> address. You will receive a link to create a <br /> new password via email.
				</p>

				<div class="input_title">
					<label for="user_login">Username or E-mail</label>
				</div>

				<input type="text" required name="user_login" id="user_login" placeholder="example@gmail.com">
				<input type="submit" name="submit" class="lostpassword-button btn red_btn" value="Get new password" />

				<div class="bottom">
					<span class="remember">Remember your password?</span>
					<a href="' . get_permalink( 2849 ) . '" class="login_link">Log in</a>
				</div>

				</form>
			</div>';

    // Возвращаем форму и выходим из функции
    return $return;
}

add_shortcode( 'misha_custom_passreset', 'misha_render_pass_reset_form' );

/**
 * Перенаправляем стандартную форму сброса пароля
 */

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

add_action( 'lostpassword_form', 'misha_pass_reset_redir' );

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