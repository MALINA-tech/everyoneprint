jQuery(document).ready(function ($) {

  // Функция отправки форм.
  $('.auth_holder').on('submit', 'form', function (ev) {
    // Определяем какую форму пользователь заполнил.
    let this_is = $(this);

    // Определяем кнопку.
    let button = $(this).find('input[type="submit"]');

    // Определяем inputs
    let input_form = $(this).find('.input_form');

    // Определяем тип формы.
    let type = $(this).attr('data-type');

    // Отправляем запрос Ajax в WordPress.
    $.ajax({

      // Путь к файлу admin-ajax.php.
      url: auth_ajax_obj.ajaxurl,

      // Создаем объект, содержащий параметры отправки.
      data: {

        // Событие к которому будем обращаться.
        'action': 'auth_ajax_request',

        // Передаём тип формы.
        'type': type,

        // Передаём значения формы.
        'content': $(this).serialize(),

        // Используем nonce для защиты.
        'security': auth_ajax_obj.nonce,

        // Перед отправкой Ajax в WordPress.
        // Перед отправкой запроса Ajax в WordPress ядро.
        beforeSend: function () {

          // Спрячем кнопку и поля после отправки запроса
          $('.auth_alert').fadeOut();
          button.attr('disabled', true);
          input_form.attr('disabled', true);
        }
      },
      success: function(data) {
        let $result = JSON.parse(data);
        auth_alert = $('.auth_alert');

        // Разблокируем поля и кнопку после выполнения запроса
        button.attr('disabled', false);
        input_form.attr('disabled', false);
        
        switch($result.type) {

          // Авторизация
          case 'auth':
            if ( $result.make === 'good' ) {
              window.location='/';
            } else {
              $(auth_alert).addClass('auth_alert_error').html($result.content).fadeIn();
            }
            break;

          // Регистрация
          case 'registration':
            if ( $result.make === 'good' ) {
              $(".single_webinar_register").fadeOut("slow");
              setTimeout(function () {
                $(".after_submit_block").fadeIn();
              }, 600);
            } else {
              $(auth_alert).addClass('auth_alert_error').html($result.content).fadeIn();
            }
            break;

          case 'lostpassword':
            if ( $result.make === 'good' ) {
              $(".single_webinar_register").fadeOut("slow");
              setTimeout(function () {
                $(".after_submit_block").fadeIn();
              }, 600);
            } else {
              $(auth_alert).addClass('auth_alert_error').html($result.content).fadeIn();
            }
            break;

          case 'resetpassword':
            if ( $result.make === 'good' ) {
              $(".single_webinar_register").fadeOut("slow");
              setTimeout(function () {
                $(".after_submit_block").fadeIn();
              }, 600);
            } else {
              $(auth_alert).addClass('auth_alert_error').html($result.content).fadeIn();
            }
            break;

          case 'hcp':
            if ( $result.make === 'good' ) {
              $(".single_webinar_register").fadeOut("slow");
              setTimeout(function () {
                $(".after_submit_block").fadeIn();
              }, 600);
            } else {
              $(auth_alert).addClass('auth_alert_error').html($result.content).fadeIn();
            }
            break;
        }
      }
    })
    // .always(function() {
    //     // Выполнять после каждого Ajax запроса.

    // })
    // .done(function(data) {
    //     // Функция для работы с обработанными данными.

    //     // Переменная $reslut будет хранить результат обработки.
    //     console.log(data);
    //     let $result = JSON.parse(data);

    //     // Проверяем какой статус пришел
    //     if ( $result.status == false ) {

    //         //Пришла ошибка, скрываем не нужные элементы и возвращаем кнопку.
    //         $('.auth_alert').addClass('auth_alert_error').html($result.content).fadeIn();
    //         button.attr('disabled', false);

    //     } else {

    //         $('.auth_alert').addClass('auth_alert_error').html($result.content).fadeIn();
    //     }

    // })
    // .fail(function(errorThrown) {
    //     // Читать ошибки будем в консоли если что-то пойдет не по плану.

    //     console.log(errorThrown);

    // });

    // Предотвращаем действие, заложенное в форму по умолчанию.
    ev.preventDefault();
  });

});
