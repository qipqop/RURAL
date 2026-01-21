<?php
/**
 * Plugin Name: Doctors CPT
 * Description: Custom Post Type for Doctors with filtering and archive
 */
defined('ABSPATH') || exit;

// Подключаем компоненты
require_once plugin_dir_path(__FILE__) . 'includes/cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/taxonomies.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/query-filters.php';

// Подключаем шаблоны из папки плагина
add_filter('template_include', function($template) {
    if (is_singular('doctors')) {
        return plugin_dir_path(__FILE__) . 'templates/single-doctors.php';
    }
    if (is_post_type_archive('doctors')) {
        return plugin_dir_path(__FILE__) . 'templates/archive-doctors.php';
    }
    return $template;
});

add_filter('template_include', 'doctors_load_custom_templates');
function doctors_load_custom_templates($template) {
    // Одиночная запись типа "doctors"
    if (is_singular('doctors')) {
        $custom_template = plugin_dir_path(__FILE__) . 'templates/single-doctors.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    // Архив записей типа "doctors"
    if (is_post_type_archive('doctors')) {
        $custom_template = plugin_dir_path(__FILE__) . 'templates/archive-doctors.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    // Если не нашли — оставляем стандартный шаблон
    return $template;
}