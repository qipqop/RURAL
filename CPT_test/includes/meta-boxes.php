add_action('add_meta_boxes', 'doctors_add_meta_box');
function doctors_add_meta_box() {
    add_meta_box('doctors_meta', 'Данные врача',
        'doctors_meta_callback', 'doctors');
}

function doctors_meta_callback($post) {
    wp_nonce_field('doctors_save_meta', 'doctors_meta_nonce');
    $exp = get_post_meta($post->ID, '_doctor_experience', true);
    $price = get_post_meta($post->ID, '_doctor_price', true);
    $rating = get_post_meta($post->ID, '_doctor_rating', true);
    ?>
    <p><label>Стаж (лет):<br>
      <input type="number" name="doctor_experience" value="">
    </label></p>
    <p><label>Цена от (₽):<br>
      <input type="number" name="doctor_price" value="">
    </label></p>
    <p><label>Рейтинг (0–5):<br>
      <input type="number" step="0.1" min="0" max="5" name="doctor_rating" value="">
    </label></p>
    <?php
}

add_action('save_post', 'doctors_save_meta');
function doctors_save_meta($post_id) {
    if (!wp_verify_nonce($_POST['doctors_meta_nonce'] ?? '', 'doctors_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, '_doctor_experience', intval($_POST['doctor_experience'] ?? 0));
    update_post_meta($post_id, '_doctor_price', intval($_POST['doctor_price'] ?? 0));
    update_post_meta($post_id, '_doctor_rating', floatval($_POST['doctor_rating'] ?? 0));
}