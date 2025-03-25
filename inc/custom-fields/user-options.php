<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'register_user_fields');
function register_user_fields() {

    // Для ученика — связь с родителем
    Container::make('user_meta', 'Информация об ученике')
        ->where('user_role', '=', 'student')
        ->add_fields([
            Field::make('association', 'student_parents', 'Родители')
                ->set_types([
                    [
                        'type' => 'user',
                        'role' => 'parent',
                    ],
                ]),
            Field::make('textarea', 'teacher_notes', 'Заметки преподавателя'),
        ]);

    // Для родителя — связь с учеником
    Container::make('user_meta', 'Информация о родителе')
        ->where('user_role', '=', 'parent')
        ->add_fields([
            Field::make('association', 'parent_students', 'Дети')
                ->set_types([
                    [
                        'type' => 'user',
                        'role' => 'student',
                    ],
                ]),
        ]);

    // Для преподавателя — предметы
    Container::make('user_meta', 'Информация о преподавателе')
        ->where('user_role', '=', 'teacher')
        ->add_fields([
            Field::make('text', 'subjects', 'Предметы (через запятую)'),
            Field::make('textarea', 'bio', 'О себе'),
        ]);
}
