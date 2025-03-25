<?php
add_filter('template_include', 'load_custom_dashboard_template');
function load_custom_dashboard_template($template) {
    if (!is_user_logged_in()) {
        return $template;
    }

    global $post;
    $user = wp_get_current_user();

    if ($post) {
        if ($post->post_name === 'dashboard' && in_array('teacher', $user->roles)) {
            return get_theme_file_path('template-parts/dashboards/teacher-dashboard-template.php');
        }

        if ($post->post_name === 'dashboard' && in_array('student', $user->roles)) {
            return get_theme_file_path('template-parts/dashboards/student-dashboard-template.php');
        }

        if ($post->post_name === 'dashboard' && in_array('parent', $user->roles)) {
            return get_theme_file_path('template-parts/dashboards/parent-dashboard-template.php');
        }
    }

    return $template;
}
