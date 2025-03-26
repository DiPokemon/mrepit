<?php
if (! defined ('ABSPATH')){
    exit;
}

add_action('init', 'register_custom_post_types');
function register_custom_post_types() {

    // Преподаватели
    // register_post_type('teacher', [
    //     'labels' => [
    //         'name' => 'Преподаватели',
    //         'singular_name' => 'Преподаватель',
    //         'add_new' => 'Добавить',
    //         'add_new_item' => 'Добавить преподавателя',
    //         'edit_item' => 'Редактировать преподавателя',
    //         'new_item' => 'Новый преподаватель',
    //         'view_item' => 'Просмотреть преподавателя',
    //         'search_items' => 'Искать преподавателей',
    //         'not_found' => 'Преподаватели не найдены',
    //         'not_found_in_trash' => 'В корзине преподавателей не найдено',
    //         'all_items' => 'Все преподаватели',
    //         'menu_name' => 'Преподаватели',
    //         'name_admin_bar' => 'Преподаватель',
    //     ],
    //     'public' => true,
    //     'has_archive' => true,
    //     'menu_icon' => 'dashicons-welcome-learn-more',
    //     'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
    //     'taxonomies' => ['teacher_subjects', 'post_tag'],
    // ]);

    // Ученики
    // register_post_type('student', [
    //     'labels' => [
    //         'name' => 'Ученики',
    //         'singular_name' => 'Ученик',
    //         'add_new' => 'Добавить',
    //         'add_new_item' => 'Добавить ученика',
    //         'edit_item' => 'Редактировать ученика',
    //         'new_item' => 'Новый ученик',
    //         'view_item' => 'Просмотреть ученика',
    //         'search_items' => 'Искать учеников',
    //         'not_found' => 'Ученики не найдены',
    //         'not_found_in_trash' => 'В корзине учеников не найдено',
    //         'all_items' => 'Все ученики',
    //         'menu_name' => 'Ученики',
    //         'name_admin_bar' => 'Ученик',
    //     ],
    //     'public' => true,
    //     'has_archive' => true,
    //     'menu_icon' => 'dashicons-id-alt',
    //     'supports' => ['title', 'editor', 'thumbnail'],
    // ]);

    // Родители
    // register_post_type('parent', [
    //     'labels' => [
    //         'name' => 'Родители',
    //         'singular_name' => 'Родитель',
    //         'add_new' => 'Добавить',
    //         'add_new_item' => 'Добавить родителя',
    //         'edit_item' => 'Редактировать родителя',
    //         'new_item' => 'Новый родитель',
    //         'view_item' => 'Просмотреть родителя',
    //         'search_items' => 'Искать родителей',
    //         'not_found' => 'Родители не найдены',
    //         'not_found_in_trash' => 'В корзине родителей не найдено',
    //         'all_items' => 'Все родители',
    //         'menu_name' => 'Родители',
    //         'name_admin_bar' => 'Родитель',

    //     ],
    //     'public' => true,
    //     'has_archive' => true,
    //     'menu_icon' => 'dashicons-admin-users',
    //     'supports' => ['title'],
    // ]);

    // Занятия
    register_post_type('lesson', [
        'labels' => [
            'name' => 'Занятия',
            'singular_name' => 'Занятие',
            'add_new_item' => 'Добавить занятие',
            'edit_item' => 'Редактировать занятие',
            'new_item' => 'Новое занятие',
            'view_item' => 'Просмотреть занятие',
            'search_items' => 'Искать занятия',
            'not_found' => 'Занятия не найдены',
            'not_found_in_trash' => 'В корзине занятий не найдено',
            'all_items' => 'Все занятия',
            'menu_name' => 'Занятия',
            'name_admin_bar' => 'Занятие',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => ['title'],
        'taxonomies' => ['teacher_subjects', 'post_tag']
    ]);

    // // Предметы
    // register_post_type('subject', [
    //     'labels' => [
    //         'name' => 'Предметы',
    //         'singular_name' => 'Предмет',
    //     ],
    //     'public' => true,
    //     'has_archive' => true,
    //     'menu_icon' => 'dashicons-welcome-write-blog',
    //     'supports' => ['title'],
    // ]);
}





/* КАСТОМНЫЕ ТАКСОНОМИИ */
add_action('init', 'register_teacher_subjects_taxonomy');
function register_teacher_subjects_taxonomy() {
    register_taxonomy('teacher_subjects', ['teacher', 'lesson'], [
        'labels' => [
            'name' => 'Предметы',
            'singular_name' => 'Предмет',
            'search_items' => 'Искать предметы',
            'all_items' => 'Все предметы',
            'edit_item' => 'Редактировать предмет',
            'update_item' => 'Обновить предмет',
            'add_new_item' => 'Добавить новый предмет',
            'new_item_name' => 'Название нового предмета',
            'menu_name' => 'Предметы',
        ],
        'hierarchical' => true, // как категории
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'subject'],
    ]);
}