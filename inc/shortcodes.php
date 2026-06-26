<?php

/**
 * Kumpulan shortcode yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
//[excerpt count="150"]
add_shortcode('excerpt', 'vd_getexcerpt');
if (!function_exists('vd_getexcerpt')) {
    function vd_getexcerpt($atts)
    {
        ob_start();
        $atribut = shortcode_atts(array(
            'count' => '150', /// count character
        ), $atts);

        $count   = absint($atribut['count']);
        $excerpt = wp_strip_all_tags(get_the_content());
        $excerpt = substr($excerpt, 0, $count);
        $excerpt = substr($excerpt, 0, strripos($excerpt, ' '));
        $excerpt = $excerpt . '...';

        echo esc_html($excerpt);

        return ob_get_clean();
    }
}

// [vd-breadcrumbs]
add_shortcode('vd-breadcrumbs', 'vd_breadcrumbs');
if (!function_exists('vd_breadcrumbs')) {
    function vd_breadcrumbs()
    {
        ob_start();
        echo justg_breadcrumb();
        return ob_get_clean();
    }
}
