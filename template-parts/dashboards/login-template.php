<?php
get_header();

$login_url = wp_login_url(home_url('/dashboard/'));
?>

<h2>Вход в личный кабинет</h2>

<?php wp_login_form([
    'redirect' => home_url('/dashboard/'), // после входа снова на дашборд
]); ?>

<p>Нет аккаунта? Обратитесь к администратору.</p>

<?php get_footer(); ?>
