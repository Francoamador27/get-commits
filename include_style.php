<?php
function load_custom_wp_admin_style() {
    wp_enqueue_style('custom_wp_admin_css', plugin_dir_url(__FILE__) . 'style.css');
}

// Enganchar la función al gancho admin_enqueue_scripts
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');