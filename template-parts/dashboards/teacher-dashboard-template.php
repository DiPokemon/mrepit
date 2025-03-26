<?php get_header(); ?>


<?php
$user_id = get_current_user_id();
$last = carbon_get_user_meta($user_id, 'teacher_last_name');
$first = carbon_get_user_meta($user_id, 'teacher_first_name');
$middle = carbon_get_user_meta($user_id, 'teacher_middle_name');
$birthdate = carbon_get_user_meta($user_id, 'teacher_birthdate');
$age = calculate_age_in_years_and_months($birthdate);
$photo = carbon_get_user_meta($user_id, 'teacher_photo');
$experience = carbon_get_user_meta($user_id, 'teacher_experience');
$exp_data = calculate_total_experience($experience);
$term_ids = carbon_get_user_meta($user_id, 'teacher_subjects');
?>

<div class="dashboard-wrapper">
    <div class="sidebar">
        <ul>
            <li><a href="#" class="dashboard-tab active" data-target="profile">🧍‍♂️ Личный профиль</a></li>
            <li><a href="#" class="dashboard-tab" data-target="students">🎓 Ученики</a></li>
            <li><a href="#" class="dashboard-tab" data-target="schedule">📅 Расписание</a></li>
            <li><a href="#" class="dashboard-tab" data-target="materials">📚 Материалы / Тесты</a></li>
        </ul>
    </div>

    <div class="content-area">
        <!-- Личный профиль -->
        <div id="section-profile" class="dashboard-section active">
            <h2>Личный профиль <a href="">(редактировать)</a></h2>
                <div class="profile-info-wrapper">
                    <div class="profile-info-column">
                        <img src="<?= $photo ?>" alt="<? get_full_name($last, $first, $middle) ?>">
                        <div class="profile-info-text">
                            <p class="full-name"><?= get_full_name($last, $first, $middle) ?> <?php echo $age ? '<span class="age">(' . $age['years'] . ' лет' . ($age['months'] > 0 ? ' ' . $age['months'] . ' мес.' : '').')</span>' : ''; ?></p>
                            
                        </div>
                    </div>

                    <div class="profile-info-column">
                        <?php if ($term_ids): ?>
                            <div class="subjects">
                                <?php foreach ($term_ids as $term_id) : ?>
                                    <?php 
                                        $term = get_term($term_id, 'teacher_subjects');
                                        if ($term && !is_wp_error($term)) : ?>
                                            <span><?= esc_html($term->name) ?></span>
                                        <?php endif; ?>
                                <?php endforeach; ?>
                            </div>                            
                        <?php endif; ?>
                        <?php if ($exp_data['years'] || $exp_data['months']) : ?>
                            <div class="experience">
                                <h3>Опыт работы (<?= esc_html($exp_data['text']) ?>)</h3>
                                <div class="workplace-list">
                                    <?php foreach ($experience as $i => $job): ?>
                                        <span class="work-place"><?= $job['workplace'] ?> (<?= $job['from_date'].' - '.$job['to_date'] ?>)</span>
                                    <?php endforeach; ?>
                                </div>                                
                            </div>                            
                        <?php endif; ?>
                        
                    </div>
                    
                </div>

            <!--<form method="post" enctype="multipart/form-data">
                <label>Фамилия: <input type="text" name="last_name" value="<?php echo esc_attr($last); ?>"></label><br>
                <label>Имя: <input type="text" name="first_name" value="<?php echo esc_attr($first); ?>"></label><br>
                <label>Отчество: <input type="text" name="middle_name" value="<?php echo esc_attr($middle); ?>"></label><br>
                <label>Дата рождения: <input type="date" name="birthdate" value="<?php echo esc_attr($birthdate); ?>"></label><br>
                
                
                <h4>Опыт работы</h4>
                <?php if (!empty($experience)): ?>
                    <?php foreach ($experience as $i => $job): ?>
                        <p>
                            <label>Место работы: <input type="text" name="exp[<?php echo $i; ?>][workplace]" value="<?php echo esc_attr($job['workplace']); ?>"></label><br>
                            <label>С даты: <input type="date" name="exp[<?php echo $i; ?>][from]" value="<?php echo esc_attr($job['from_date']); ?>"></label><br>
                            <label>По дату: <input type="date" name="exp[<?php echo $i; ?>][to]" value="<?php echo esc_attr($job['to_date']); ?>"></label>
                        </p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Нет добавленного опыта.</p>
                <?php endif; ?>
                
                <button type="submit" name="save_profile">Сохранить</button>
            </form>-->

        </div>

        <!-- Ученики -->
        <div id="section-students" class="dashboard-section">
            <h2>Мои ученики</h2>
            <p>Здесь будет список учеников и возможность добавить нового.</p>
        </div>

        <!-- Расписание -->
        <div id="section-schedule" class="dashboard-section">
            <h2>Расписание занятий</h2>
            <p>Вывод календаря занятий с учениками.</p>
        </div>

        <!-- Материалы / Тесты -->
        <div id="section-materials" class="dashboard-section">
            <h2>Материалы / Тесты</h2>
            <p>Раздел для загрузки файлов или ссылок на материалы.</p>
        </div>
    </div>
</div>



<?php get_footer(); ?>
