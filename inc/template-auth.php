<?php

/**
 * Скрыть Admin Bar если не администратор
 */

if (!current_user_can('administrator')) {
  show_admin_bar( false );
}

function redirectToLogin() {
  header( 'Location: ' . wp_login_url() );
}

/**
 * Отключить стандартные Email авторизации
 */

add_filter( 'send_password_change_email', '__return_false' );

/**
 * Изменить имя отправителя
 */

function change_name( $name ) {
  return 'Ricoh Support Site';
}

add_filter( 'wp_mail_from_name', 'change_name' );

/**
 * Изменить Email отправителя
 */

function change_email( $email ) {
  return 'admin@ricoh.everyoneprint.com';
}

add_filter( 'wp_mail_from', 'change_email' );

/**
 * Новый адрес страницы авторизации (редирект с /wp-admin на /login)
 */

add_filter('site_url', 'wplogin_filter', 10, 3);

if ( $_GET['action'] != 'logout' ) {
  function wplogin_filter( $url, $path, $orig_scheme ) {

    $old = array( "/(wp-login\.php)/");
    $new = array( "login");
    return preg_replace( $old, $new, $url, 1);
  }
}

/**
 * #Logout
 */

function logoutUser(){
  if ( $_GET["action"] == 'logout' ) {
      wp_logout();
      $site_url = get_site_url();
      wp_redirect($site_url);
  }
}
add_action('init', 'logoutUser');

/**
 * #Поля профиля в админке
 */

// дополнительные данные на странице профиля
add_action('show_user_profile', 'my_profile_new_fields_add');
add_action('edit_user_profile', 'my_profile_new_fields_add');

add_action('personal_options_update', 'my_profile_new_fields_update');
add_action('edit_user_profile_update', 'my_profile_new_fields_update');

function my_profile_new_fields_add($user){ 
?>
  <h3>Дополнительные данные</h3>
  <table class="form-table">
    <tr>
      <th><label for="activation">User Activation</label></th>
      <td>
        <label><input type="radio" checked name="activation" value="Active" <?php checked('Active', get_user_meta($user->ID, 'activation', true)); ?>> Active</label><br>
        <label><input type="radio" name="activation" value="Inactive" <?php checked('Inactive', get_user_meta($user->ID, 'activation', true)); ?>> Inactive</label>
      </td>
    </tr>
  </table>
  <?php            
}

// обновление
function my_profile_new_fields_update($user_id){
  if ( !current_user_can( 'edit_user', $user_id ) )
    return false;
  update_usermeta( $user_id, 'activation', $_POST['activation'] );
}

add_filter('user_contactmethods', 'ved_user_contactmethods');
function ved_user_contactmethods($user_contactmethods){
  $user_contactmethods['first_name'] = 'Name';
  $user_contactmethods['last_name'] = 'Last Name';
  $user_contactmethods['user_company'] = 'Company';
  $user_contactmethods['user_title'] = 'Title';
  $user_contactmethods['phone'] = 'Phone';
  $user_contactmethods['user_roles'] = 'Role';
  $user_contactmethods['user_country'] = 'Country';
  $user_contactmethods['user_state'] = 'State';
  $user_contactmethods['user_message'] = 'Message';
  return $user_contactmethods;
}

/**
 * Ajax Auth / Register (Disabled)
 */

// Добавляем событие в процесс инициализации JS скриптов
add_action( 'wp_enqueue_scripts', 'auth_ajax_enqueue' );

//Описываем событие
function auth_ajax_enqueue() {

    // Подключаем файл js скрипта.
    wp_enqueue_script(
        'auth-ajax', // Имя
        get_stylesheet_directory_uri() . '/assets/js/ajax-auth.js', // Путь до JS файла.
        array('jquery') // В массив jquery.
    );

    // Используем функцию wp_localize_script для передачи переменных в JS скрипт.
    wp_localize_script(
        'auth-ajax', // Куда будем передавать
        'auth_ajax_obj', // Название массива, который будет содержать передаваемые данные
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ), // Элемент массива, содержащий путь к admin-ajax.php
            'nonce' => wp_create_nonce('auth-nonce') // Создаем nonce
        )
    );

}

// Создаём событие обработки Ajax в WordPress теме.
add_action( 'wp_ajax_nopriv_auth_ajax_request', 'auth_ajax_request' );
//add_action( 'wp_ajax_auth_ajax_request', 'auth_ajax_request' );

// Описываем саму функцию.
function auth_ajax_request() {

    // Перемененная $_REQUEST содержит все данные заполненных форм.
    if ( isset( $_REQUEST ) ) {

        // Проверяем nonce, а в случае если что-то пошло не так, то прерываем выполнение функции.
        if ( !wp_verify_nonce( $_REQUEST[ 'security' ], 'auth-nonce' ) ) {
            wp_die( 'Базовая защита не пройдена' );
        }

        // Введём переменную, которая будет содержать массив с результатом отработки события.
        $result = array( 'status' => false, 'content' => false );

        // Создаём массив который содержит значения полей заполненной формы.
        parse_str( $_REQUEST[ 'content' ], $creds );

        switch ( $_REQUEST[ 'type' ] ) {

          case 'registration':
            /**
             * ******************************
             * Заполнена форма регистрации.
             * ******************************
             */
            
            $result[ 'type' ] = 'registration';
            
            // Получаем все данные
            $username = $creds[ 'email' ];
            $email    = $creds[ 'email' ];
            $password = wp_generate_password( 15, true, true ); // Генерируем пароль
            $ph_code  = $creds[ 'phone_code' ];
            $phone    = $creds[ 'phone' ];
            $name     = $creds[ 'your-name' ];
            $lastname = $creds[ 'your-last-name' ];
            $company  = $creds[ 'your-company' ];
            $title    = $creds[ 'your-title' ];
            $roles    = $creds[ 'roles' ];
            $country  = $creds[ 'your-country' ];
            $state    = $creds[ 'your-state' ];
            $message  = $creds[ 'your-message' ];

            if ( is_email( $email ) && false == email_exists( $email )) {

              $user_add = wp_create_user( $username, $password, $email );

              if ( ! is_wp_error( $user_add )) {

                // Показываем приветственное сообщение после регистрации
                $result[ 'status' ] = true;
                $result[ 'make' ] = 'good';

                // Сохраняем доп поля
                update_user_meta( $user_add, 'phone', $ph_code . $phone ); // Сохраняем доп. поля
                update_user_meta( $user_add, 'first_name', $name ); // Сохраняем доп. поля
                update_user_meta( $user_add, 'last_name', $lastname ); // Сохраняем доп. поля
                update_user_meta( $user_add, 'user_company', $company ); // Сохраняем доп. поля
                update_user_meta( $user_add, 'user_title', $title ); // Сохраняем доп. поля
                update_user_meta( $user_add, 'user_roles', $roles ); // Сохраняем доп. поля
                update_user_meta( $user_add, 'user_country', $country ); // Сохраняем доп. поля
                update_user_meta( $user_add, 'user_state', $state ); // Сохраняем доп. поля
                update_user_meta( $user_add, 'user_message', $message ); // Сохраняем доп. поля

                $headers = array(
                  'From: Support Site <admin@ricoh.everyoneprint.com>',
                  'content-type: text/html',
                  'Cc: admin@ricoh.everyoneprint.com', // тут можно использовать только простой email адрес
                );

                $to = $email;
                $subject = 'Welcome to Everyone Print';
                $message = '
                Hi!
                <br><br>
                Thanks for registering for our Support Site
                <br><br>
                You are welcome to access the site using:
                <br>
                Your Email: <b>' . $email . '</b>
                <br><br>
                You are welcome to create your own password via the link
                <br>
                <a href="' . $site_url . '/login/?email=' . $email . '&action=regconfirm">' . $site_url . '/changepassword/</a>
                <br><br>
                In the future, you can log in at <a href="' . $site_url . '/login/">' . $site_url . '/login/</a>
                <br><br>
                Thank you and have a good day!
                ';

                wp_mail( $to, $subject, $message, $headers );


              } else {
                $result[ 'status' ] = false;
                $result[ 'content' ] = esc_html__( 'Your email cannot be registered', 'wplb_ajax_lesson' );
                $result[ 'make' ] = 'error';
              }
            } else {

                // Такой пользователь уже существует, регистрация не возможна, записываем данные в массив.
                $result[ 'status' ] = false;
                $result[ 'content' ] = esc_html__( 'User already exists', 'wplb_ajax_lesson' );
                $result[ 'make' ] = 'error';
            }

            break;

            case 'authorization':
              /**
               * ******************************
               * Заполнена форма авторизации.
               * ******************************
               */
              
              $result[ 'type' ] = 'auth';

              // Создаём массив для авторизации
              $creds = array(
                  'user_login' => $creds[ 'auth_login' ], // Логин пользователя
                  'user_password' => $creds[ 'auth_password' ], // Пароль пользователя
                  'remember' => true // Запоминаем
              );

              $my_user = get_user_by('login', $creds->ID);
              $key = 'activation';
              $single = true;
              $user_last = get_user_meta( $my_user, $key, true ); 

              // Пробуем авторизовать пользователя.
              $signon = wp_signon( $creds, false );

              if ( is_wp_error( $signon ) ) {

                  // Авторизовать не получилось
                  $result[ 'status' ] = false;
                  $result[ 'content' ] = $signon->get_error_message();
                  $result[ 'make' ] = 'error';

              } elseif ( $user_last == 'Inactive' ) {

                $result[ 'status' ] = false;
                $result[ 'content' ] = 'Account not active';
                $result[ 'make' ] = 'error';

              } else {

                  // Авторизация успешна, устанавливаем необходимые куки.
                  wp_clear_auth_cookie();
                  clean_user_cache( $signon->ID );
                  wp_set_current_user( $signon->ID );
                  wp_set_auth_cookie( $signon->ID );
                  update_user_caches( $signon );

                  // Записываем результаты в массив.
                  // Редиректим пользователя после регистрации
                  $result[ 'status' ] = true;
                  $result[ 'make' ] = 'good';
              }

              break;

              case 'lostpassword':
              /**
               * ******************************
               * Заполнена форма восстановления пароля.
               * ******************************
               */

              $result[ 'type' ] = 'lostpassword';

              $username = $creds[ 'user_login' ]; // Логин пользователя
              $site_url = get_site_url();

              if ( username_exists( $username )) {
                $result[ 'status' ] = true;
                $result[ 'make' ] = 'good';

                $headers = array(
                  'From: Support Site <admin@everyoneprint.com>',
                  'content-type: text/html',
                  'Cc: admin@everyoneprint.com', // тут можно использовать только простой email адрес
                );

                $to = $username;
                $subject = 'Password Change Request';
                $message = '
                Hi <b>' . $username . '</b>!
                <br><br>
                You have made a password recovery request.<br>
                To change your password please follow this <a href="' . $site_url . '/login/?email=' . $username . '&action=rp"><b>Link</b></a>
                ';

                wp_mail( $to, $subject, $message, $headers );

              } else {
                $result[ 'status' ] = false;
                $result[ 'content' ] = 'User not found';
                $result[ 'make' ] = 'error';
              }

              break;

              case 'resetpassword':
              /**
               * ******************************
               * Смена пароля.
               * ******************************
               */

              $result[ 'type' ] = 'resetpassword';

              $username = $creds[ 'login' ];
              $password = $creds[ 'user_pass' ];

              $user     = get_user_by( 'email', $username );
              $user_id  = $user->ID;

              $pass_change = wp_set_password( $password, $user_id );

              if ( is_wp_error( $pass_change )) {
                $result[ 'status' ] = false;
                $result[ 'content' ] = $pass_change->get_error_message();
                $result[ 'make' ] = 'error';
              } else {
                $result[ 'status' ] = true;
                $result[ 'make' ] = 'good';
              }

              break;

              case 'hcp':
              /**
               * ******************************
               * Заполнена форма регистрации.
               * ******************************
               */
              
              $result[ 'type' ] = 'hcp';
              
              // Получаем все данные
              $username = $creds[ 'email' ];
              $email    = $creds[ 'email' ];
              $password = wp_generate_password( 15, true, true ); // Генерируем пароль
              $ph_code  = $creds[ 'phone_code' ];
              $phone    = $creds[ 'phone' ];
              $name     = $creds[ 'user_name' ];
              $lastname = $creds[ 'user_last_name' ];
              $company  = $creds[ 'user_company' ];
              $roles    = $creds[ 'roles' ];
              $country  = $creds[ 'user_country' ];

              // Показываем приветственное сообщение после регистрации
              $result[ 'status' ] = true;
              $result[ 'make' ] = 'good';

              $headers = array(
                'From: Support Site <ricoh-pmc.admin@everyoneprint.com>',
                'content-type: text/html',
                'Cc: ricoh-pmc.admin@everyoneprint.com', // тут можно использовать только простой email адрес
              );

              $to = 'ricoh-pmc.admin@everyoneprint.com';
              $subject = 'Welcome to Everyone Print';
              $message = '
              Hi!
              <br><br>
              Thanks for registering for our Support Site
              <br><br>
              You are welcome to access the site using:
              <br>
              Your Email: <b>' . $email . '</b>
              <br><br>
              You are welcome to create your own password via the link
              <br>
              <a href="' . $site_url . '/login/?email=' . $email . '&action=regconfirm">' . $site_url . '/changepassword/</a>
              <br><br>
              In the future, you can log in at <a href="' . $site_url . '/login/">' . $site_url . '/login/</a>
              <br><br>
              Thank you and have a good day!
              ';

              wp_mail( $to, $subject, $message, $headers );

            break;
        }

        // Конвертируем массив с результатами обработки и передаем его обратно как строку в JSON формате.
        echo json_encode( $result );

    }

    // Заканчиваем работу Ajax.
    wp_die();
}