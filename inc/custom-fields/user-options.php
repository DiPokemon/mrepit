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
            Field::make('text', 'teacher_last_name', 'Фамилия'),
            Field::make('text', 'teacher_first_name', 'Имя'),
            Field::make('text', 'teacher_middle_name', 'Отчество'),
            Field::make('date', 'teacher_birthdate', 'Дата рождения'),
            Field::make('image', 'teacher_photo', 'Фотография')->set_value_type('url'),
            Field::make('complex', 'teacher_experience', 'Опыт работы')
                ->add_fields([
                    Field::make('text', 'workplace', 'Место работы'),
                    Field::make('date', 'from_date', 'С даты'),
                    Field::make('date', 'to_date', 'По дату'),
                ]),            
            Field::make('textarea', 'bio', 'О себе'),
            Field::make('multiselect', 'teacher_subjects', 'Преподаваемые дисциплины')
                ->set_options(function () {
                    $terms = get_terms([
                        'taxonomy' => 'teacher_subjects',
                        'hide_empty' => false,
                    ]);

                    $options = [];

                    if (!is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            $options[$term->term_id] = $term->name;
                        }
                    }

                    return $options;
                })


        ]);
}
