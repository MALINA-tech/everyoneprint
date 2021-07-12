<?php
/**
 * Template Name: Login Page
 *
 * @package ricoh
 */

get_header('forms');

$get_uri_login = '';
$get_uri_check = '';

$get_uri_login = $_GET['action'];
$get_uri_check = $_GET['checkemail'];

if ( $get_uri_login == '' ) {
  $get_uri_login = '';
}

$site_url = get_site_url();
?>

<div class="wrapper form_wrapper">
<?php if ( $get_uri_login == 'register' ): ?>

  <!-- Форма регистрации -->
  <?php get_template_part( 'template-parts/auth/content', $get_uri_login ); ?>

<?php elseif ( $get_uri_login == 'lostpassword' ): ?>

  <!-- Форма восстановления пароля -->
  <?php get_template_part( 'template-parts/auth/content', $get_uri_login ); ?>

<?php elseif ( $get_uri_login == 'rp' ): ?>

  <!-- Форма изменения пароля -->
  <?php get_template_part( 'template-parts/auth/form/resetpass' ); ?>

<?php elseif ( $get_uri_login == 'regconfirm' ): ?>

  <!-- Страница изменения пароля после регистрации -->
  <?php get_template_part( 'template-parts/auth/check/content-register', 'confirm' ); ?>

<?php elseif ( $get_uri_login == 'hcp-trial' ): ?>

  <!-- Страница отправки запроса на регистрацию HCP TRIAL -->
  <?php get_template_part( 'template-parts/auth/form/hcp-trial' ); ?>

<?php elseif ( $get_uri_login == 'logout' ): ?>

  <script>window.location='/login/'</script>

<?php else: ?>

  <!-- Форма авторизации -->
  <?php get_template_part( 'template-parts/auth/content', 'login' ); ?>

<?php endif; ?>
</div>

  <?php
get_footer('forms');
