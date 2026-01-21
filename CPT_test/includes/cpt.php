function register_doctors_cpt() {
    $labels = array(
        'name'                  => _x('Доктора', 'Post type general name', 'doctors-cpt'),
        'singular_name'         => _x('Доктор', 'Post type singular name', 'doctors-cpt'),
        'menu_name'             => __('Доктора', 'doctors-cpt'),
        'archives'              => __('Архив докторов', 'doctors-cpt'),
        'all_items'             => __('Все доктора', 'doctors-cpt'),
        'add_new_item'          => __('Добавить нового доктора', 'doctors-cpt'),
        'edit_item'             => __('Редактировать доктора', 'doctors-cpt'),
        'search_items'          => __('Искать доктора', 'doctors-cpt'),
        'not_found'             => __('Не найдено', 'doctors-cpt'),
    );

    $args = array(
        'label'                 => __('Доктор', 'doctors-cpt'),
        'description'           => __('Кастомный тип записей для врачей', 'doctors-cpt'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'public'                => true,
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'doctors'),
        'show_in_rest'          => true,
    );
    register_post_type('doctors', $args);
}
add_action('init', 'register_doctors_cpt');