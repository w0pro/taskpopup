<?php
class Mail {
   function check_form_fields ($form) {
       // Массив ошибок
       $err_message = array();
// Проверяем nonce. Если проверка не прошла, то блокируем отправку
       if ( ! wp_verify_nonce( $_POST['nonce'], 'feedback-nonce' ) ) {
           wp_die( 'Данные отправлены с неправильного адреса' );
       }

// Проверяем на спам. Если скрытое поле заполнено или снят чек, то блокируем отправку
       if ( false === $_POST['form__anticheck'] || ! empty( $_POST['form__submitted'] ) ) {
           wp_die( 'Это спам' );
       }

// Проверяем полей почты, если пустое, то пишем сообщение в массив ошибок
       if ( empty( $_POST['form__email'] ) || ! isset( $_POST['form__email'] ) || !preg_match( '/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i', $_POST['form__email'] )) {
           array_push($err_message, 'email');
       } else {
           $form_email = sanitize_email($_POST['form__email']);
       }

// Проверяем полей телефон, если пустое, то пишем сообщение в массив ошибок
       if ( empty( $_POST['form__tel'] ) || ! isset( $_POST['form__tel'] ) || ! preg_match( '/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $_POST['form__tel'] ) ) {
           array_push($err_message, 'tel');
       } else {
           $form_tel = $_POST['form__tel'];

       }
// Проверяем полей темы письма, если пустое, то пишем сообщение по умолчанию
       if ( empty( $_POST['form__subject'] ) || ! isset( $_POST['form__subject'] ) ) {
           $form_subject = 'Сообщение с сайта';
       } else {
           $form_subject = sanitize_text_field( $_POST['form__subject'] );
       }


// Проверяем массив ошибок, если не пустой, то передаем сообщение. Иначе отправляем письмо
       if ( $err_message ) {
           wp_send_json_error( $err_message );
       } else {

// Указываем адресата
           $email_to = 'ya.sapronov@gmail.com';

// Если адресат не указан, то берем данные из настроек сайта
           if ( !$email_to ) {
               $email_to = get_option( 'admin_email' );
           }

           $body    = "Телефон: $form_tel \nEmail: $form_email ";
           $headers = 'From: ' . get_option( 'admin_email' ) . ' <' . $email_to . '>' . "\r\n" . 'Reply-To: ' . $email_to;

// Отправляем письмо
           wp_mail( $email_to, $form_subject, $body, $headers );

// Отправляем сообщение об успешной отправке
           wp_send_json_success();
       }

// На всякий случай убиваем еще раз процесс ajax
       wp_die();

   }
}
