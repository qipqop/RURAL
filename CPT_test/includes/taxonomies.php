// Специализация — иерархическая
register_taxonomy('specialization', 'doctors', array(
    'labels' => array('name' => 'Специализации'),
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'specialization'),
));

// Город — НЕ иерархическая
register_taxonomy('city', 'doctors', array(
    'labels' => array('name' => 'Города'),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'city'),
));
        