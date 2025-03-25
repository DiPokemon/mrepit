<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'register_custom_fields');
function register_custom_fields() {

    // Ученики — привязка родителей
    Container::make('post_meta', 'Связь с родителями')
        ->where('post_type', '=', 'student')
        ->add_fields([
            Field::make('association', 'student_parents', 'Родители')
                ->set_types([
                    [
                        'type' => 'post',
                        'post_type' => 'parent',
                    ],
                ])
        ]);

    // Родители — привязка учеников
    Container::make('post_meta', 'Связь с учениками')
        ->where('post_type', '=', 'parent')
        ->add_fields([
            Field::make('association', 'parent_students', 'Ученики')
                ->set_types([
                    [
                        'type' => 'post',
                        'post_type' => 'student',
                    ],
                ])
        ]);

    // Занятия — выбор преподавателя и ученика, дата, статус
    Container::make('post_meta', 'Детали занятия')
        ->where('post_type', '=', 'lesson')
        ->add_fields([
            Field::make('select', 'lesson_status', 'Статус занятия')
                ->add_options([
                    'scheduled' => 'Запланировано',
                    'completed' => 'Завершено',
                    'cancelled' => 'Отменено',
                ]),
            Field::make('association', 'lesson_teacher', 'Преподаватель')
                ->set_types([
                    [
                        'type' => 'post',
                        'post_type' => 'teacher',
                    ],
                ]),
            Field::make('association', 'lesson_student', 'Ученик')
                ->set_types([
                    [
                        'type' => 'post',
                        'post_type' => 'student',
                    ],
                ]),
            Field::make('date_time', 'lesson_date', 'Дата и время занятия'),
            Field::make('text', 'lesson_duration', 'Длительность (в минутах)'),
            Field::make('textarea', 'lesson_notes', 'Заметки'),
        ]);

    // Преподаватели — предметы
    Container::make('post_meta', 'Предметы преподавателя')
        ->where('post_type', '=', 'teacher')
        ->add_fields([
            Field::make('association', 'teacher_subjects', 'Предметы')
                ->set_types([
                    [
                        'type' => 'post',
                        'post_type' => 'subject',
                    ],
                ])
        ]);
}
