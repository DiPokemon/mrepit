<?php
add_action('init', 'register_custom_user_roles');
function register_custom_user_roles() {
    // Преподаватели
    add_role('teacher', 'Преподаватель', [
        'read' => true,
        'edit_posts' => false,
    ]);

    // Ученики
    add_role('student', 'Ученик', [
        'read' => true,
        'edit_posts' => false,
    ]);

    // Родители
    add_role('parent', 'Родитель', [
        'read' => true,
        'edit_posts' => false,
    ]);
}
