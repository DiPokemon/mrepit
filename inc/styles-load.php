<?php

//Register and load CSS
function load_styles(){
	//wp_enqueue_style('fontawesome', get_template_directory_uri().'/static/fontawesome/css/all.css');
  	wp_enqueue_style('style_min', get_template_directory_uri().'/static/css/style.min.css');
  	//wp_enqueue_style('slick', get_template_directory_uri().'/static/libs/slick/slick.min.css');
  	//wp_enqueue_style('slick_theme', get_template_directory_uri().'/static/libs/slick/slick-theme.min.css');
	//wp_enqueue_style('slick_theme', get_template_directory_uri().'/static/libs/slick/slick-theme.min.css');
	//wp_enqueue_style('select2', get_template_directory_uri().'/static/libs/select2/select2.min.css');
}; 
add_action('wp_enqueue_scripts', 'load_styles', 10);

// Функция для добавления стилей в админ-панель
// function load_custom_admin_style() {    
//     $admin_style = get_template_directory_uri() . '/static/admin-styles.css';
//     wp_register_style('custom_admin_css', $admin_style, false, '1.0.0');
//     wp_enqueue_style('custom_admin_css');
// }

// Добавляем хук для админ-страницы
// add_action('admin_enqueue_scripts', 'load_custom_admin_style');

// function custom_login_styles() {
// 	wp_enqueue_style('custom-login', get_template_directory_uri() . '/static/css/style.min.css');
//   }
//   add_action('login_enqueue_scripts', 'custom_login_styles');

function load_dashboards_styles() {
    if (is_page('dashboard') && is_user_logged_in()) {
        wp_enqueue_style('dashboard_style_min', get_template_directory_uri() . '/static/css/dashboard.min.css');
    }
}
add_action('wp_enqueue_scripts', 'load_dashboards_styles', 10);
