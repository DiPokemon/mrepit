<?php

// Перенаправление после логина
add_filter('login_redirect', 'custom_login_redirect', 10, 3);
function custom_login_redirect($redirect_to, $request, $user) {
    if (!is_wp_error($user)) {
        if (!in_array('administrator', $user->roles)) {
            return home_url('/dashboard/');
        }
    }
    return $redirect_to;
}

// Перенаправление из админки, кроме AJAX и /dashboard
add_action('admin_init', 'redirect_non_admin_from_admin');
function redirect_non_admin_from_admin() {
    if (!current_user_can('administrator') && !defined('DOING_AJAX')) {
        $request_uri = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($request_uri, '/dashboard') === false) {
            wp_redirect(home_url('/dashboard/'));
            exit;
        }
    }
}

add_filter('template_include', 'load_dashboard_template_by_role');
function load_dashboard_template_by_role($template) {
    global $post;

    if (!$post || $post->post_name !== 'dashboard') {
        return $template;
    }

    // Пользователь не залогинен — показать форму входа
    if (!is_user_logged_in()) {
        return get_theme_file_path('template-parts/dashboards/login-template.php');
    }

    // Пользователь залогинен — подключаем нужный шаблон
    $user = wp_get_current_user();

    if (in_array('teacher', $user->roles)) {
        return get_theme_file_path('template-parts/dashboards/teacher-dashboard-template.php');
    }

    if (in_array('student', $user->roles)) {
        return get_theme_file_path('template-parts/dashboards/student-dashboard-template.php');
    }

    if (in_array('parent', $user->roles)) {
        return get_theme_file_path('template-parts/dashboards/parent-dashboard-template.php');
    }

    // fallback
    return get_theme_file_path('template-parts/dashboards/unknown-role.php');
}
