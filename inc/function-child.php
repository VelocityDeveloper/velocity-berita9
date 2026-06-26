<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

if (!function_exists('velocitychild_theme_setup')) {
    function velocitychild_theme_setup()
    {
        register_nav_menus(
            array(
                'secondary' => __('Secondary Menu', 'justg'),
            )
        );

        remove_action('justg_header', 'justg_header_menu');
        remove_action('justg_do_footer', 'justg_the_footer_open');
        remove_action('justg_do_footer', 'justg_the_footer_content');
        remove_action('justg_do_footer', 'justg_the_footer_close');
    }
}

add_action('customize_register', 'velocitychild_customize_register');

if (!function_exists('velocitychild_customize_register')) {
    function velocitychild_customize_register($wp_customize)
    {
        $theme       = wp_get_theme();
        $panel_id    = 'velocitychild_panel_' . sanitize_key($theme->get('Name'));
        $section_id  = 'velocitychild_section_' . sanitize_key($theme->get('Name'));
        $media_section_id  = $section_id . '_media';
        $social_section_id = $section_id . '_social';
        $home_section_id   = $section_id . '_home';
        $categories  = velocitychild_get_category_choices();
        $media_items = velocitychild_get_media_fields();

        $wp_customize->add_panel(
            $panel_id,
            array(
                'title'    => $theme->get('Name'),
                'priority' => 1,
            )
        );

        $wp_customize->add_section(
            $media_section_id,
            array(
                'title'    => __('Banner Iklan', 'justg'),
                'panel'    => $panel_id,
                'priority' => 10,
            )
        );

        $wp_customize->add_section(
            $social_section_id,
            array(
                'title'    => __('Sosial Media', 'justg'),
                'panel'    => $panel_id,
                'priority' => 20,
            )
        );

        $wp_customize->add_section(
            $home_section_id,
            array(
                'title'    => __('Home', 'justg'),
                'panel'    => $panel_id,
                'priority' => 30,
            )
        );

        foreach ($media_items as $idfield => $datafield) {
            $image_setting = 'image_' . $idfield;
            $link_setting  = 'link_' . $idfield;

            $wp_customize->add_setting(
                $image_setting,
                array(
                    'default'           => '',
                    'sanitize_callback' => 'velocitychild_sanitize_image',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    $image_setting,
                    array(
                        'label'       => sprintf(__('Gambar %s', 'justg'), $datafield['label']),
                        'description' => $datafield['description'],
                        'section'     => $media_section_id,
                    )
                )
            );

            $wp_customize->add_setting(
                $link_setting,
                array(
                    'default'           => '',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );

            $wp_customize->add_control(
                $link_setting,
                array(
                    'type'    => 'url',
                    'label'   => sprintf(__('Link %s', 'justg'), $datafield['label']),
                    'section' => $media_section_id,
                )
            );
        }

        foreach (velocitychild_get_social_fields() as $idfield => $label) {
            $setting_id = 'link_sosmed_' . $idfield;

            $wp_customize->add_setting(
                $setting_id,
                array(
                    'default'           => 'https://' . $idfield . '.com/',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );

            $wp_customize->add_control(
                $setting_id,
                array(
                    'type'    => 'url',
                    'label'   => sprintf(__('Link %s', 'justg'), $label),
                    'section' => $social_section_id,
                )
            );
        }

        foreach (velocitychild_get_home_post_fields() as $idfield => $datafield) {
            $title_setting = 'title_' . $idfield;
            $cat_setting   = 'cat_' . $idfield;

            $wp_customize->add_setting(
                $title_setting,
                array(
                    'default'           => $datafield['title'],
                    'sanitize_callback' => 'sanitize_text_field',
                )
            );

            $wp_customize->add_control(
                $title_setting,
                array(
                    'type'    => 'text',
                    'label'   => sprintf(__('Judul %s', 'justg'), $datafield['label']),
                    'section' => $home_section_id,
                )
            );

            $wp_customize->add_setting(
                $cat_setting,
                array(
                    'default'           => '',
                    'sanitize_callback' => 'velocitychild_sanitize_select',
                )
            );

            $wp_customize->add_control(
                $cat_setting,
                array(
                    'type'        => 'select',
                    'label'       => sprintf(__('Kategori %s', 'justg'), $datafield['label']),
                    'section'     => $home_section_id,
                    'choices'     => $categories,
                    'description' => __('Pilih kategori atau nonaktifkan bagian ini.', 'justg'),
                )
            );
        }
    }
}

if (!function_exists('velocitychild_get_media_fields')) {
    function velocitychild_get_media_fields()
    {
        return array(
            'iklan_header'       => array(
                'label'       => 'Header',
                'description' => 'Ukuran rekomendasi 728x90',
            ),
            'iklan_home_1'       => array(
                'label'       => 'Home 1',
                'description' => 'Ukuran rekomendasi 310x350',
            ),
            'iklan_home_2'       => array(
                'label'       => 'Home 2',
                'description' => 'Ukuran rekomendasi 300x250',
            ),
            'iklan_home_3'       => array(
                'label'       => 'Home 3',
                'description' => 'Ukuran rekomendasi 300x250',
            ),
            'iklan_home_bawah_1' => array(
                'label'       => 'Home Bawah 1',
                'description' => 'Ukuran rekomendasi 600x80',
            ),
            'iklan_home_bawah_2' => array(
                'label'       => 'Home Bawah 2',
                'description' => 'Ukuran rekomendasi 600x80',
            ),
            'iklan_content'      => array(
                'label'       => 'Single',
                'description' => 'Ukuran rekomendasi 600x80',
            ),
            'iklan_content_2'    => array(
                'label'       => 'Single 2',
                'description' => 'Ukuran rekomendasi 300x250',
            ),
            'iklan_archive'      => array(
                'label'       => 'Archive',
                'description' => 'Ukuran rekomendasi 600x60',
            ),
            'iklan_archive_2'    => array(
                'label'       => 'Archive 2',
                'description' => 'Ukuran rekomendasi 600x60',
            ),
            'iklan_sidebar'      => array(
                'label'       => 'Sidebar',
                'description' => 'Gambar sidebar',
            ),
            'iklan_sidebar_2'    => array(
                'label'       => 'Sidebar 2',
                'description' => 'Gambar sidebar kedua',
            ),
        );
    }
}

if (!function_exists('velocitychild_get_social_fields')) {
    function velocitychild_get_social_fields()
    {
        return array(
            'facebook'  => 'Facebook',
            'twitter'   => 'Twitter',
            'instagram' => 'Instagram',
            'youtube'   => 'Youtube',
        );
    }
}

if (!function_exists('velocitychild_get_home_post_fields')) {
    function velocitychild_get_home_post_fields()
    {
        return array(
            'posts_home_1' => array(
                'label' => 'Posts Home 1',
                'title' => 'Recent Posts',
            ),
            'posts_home_2' => array(
                'label' => 'Posts Home 2',
                'title' => 'Recent Posts',
            ),
            'posts_home_3' => array(
                'label' => 'Posts Home 3',
                'title' => 'Recent Posts',
            ),
            'posts_home_4' => array(
                'label' => 'Posts Home 4',
                'title' => 'Recent Posts',
            ),
            'posts_home_5' => array(
                'label' => 'Posts Home 5',
                'title' => 'Recent Posts',
            ),
            'posts_home_6' => array(
                'label' => 'Posts Home 6',
                'title' => 'Recent Posts',
            ),
        );
    }
}

if (!function_exists('velocitychild_get_category_choices')) {
    function velocitychild_get_category_choices()
    {
        $choices = array(
            ''        => __('Pilih kategori', 'justg'),
            'disable' => __('Nonaktifkan', 'justg'),
        );

        $categories = get_categories(
            array(
                'hide_empty' => false,
                'orderby'    => 'name',
                'order'      => 'ASC',
            )
        );

        foreach ($categories as $category) {
            $choices[(string) $category->term_id] = $category->name;
        }

        return $choices;
    }
}

if (!function_exists('velocitychild_sanitize_select')) {
    function velocitychild_sanitize_select($value, $setting)
    {
        $value   = sanitize_text_field($value);
        $control = $setting->manager->get_control($setting->id);
        $choices = $control ? $control->choices : array();

        return isset($choices[$value]) ? $value : $setting->default;
    }
}

if (!function_exists('velocitychild_sanitize_image')) {
    function velocitychild_sanitize_image($image, $setting)
    {
        if (empty($image)) {
            return '';
        }

        $file = wp_check_filetype($image);

        return !empty($file['ext']) ? esc_url_raw($image) : $setting->default;
    }
}

add_action('wp_enqueue_scripts', 'velocitychild_theme_color_css', 20);

if (!function_exists('velocitychild_theme_color_css')) {
    function velocitychild_theme_color_css()
    {
        $primary_color = velocitytheme_option('primary_color', '#1e73be');

        if (function_exists('velocitytheme_sanitize_color')) {
            $primary_color = velocitytheme_sanitize_color($primary_color);
        } else {
            $primary_color = sanitize_hex_color($primary_color);
        }

        if (!$primary_color) {
            return;
        }

        $css = ':root{--color-theme:' . $primary_color . ';}.border-color-theme{--bs-border-color:' . $primary_color . ';}';
        wp_add_inline_style('custom-style', $css);
    }
}

///add action builder part
add_action('justg_header', 'justg_header_berita');
if (!function_exists('justg_header_berita')) {
    function justg_header_berita()
    {
        require get_stylesheet_directory() . '/inc/part-header.php';
    }
}

add_action('justg_do_footer', 'justg_footer_berita');
if (!function_exists('justg_footer_berita')) {
    function justg_footer_berita()
    {
        require get_stylesheet_directory() . '/inc/part-footer.php';
    }
}

if (!function_exists('get_berita_iklan')) {
    function get_berita_iklan($idiklan = null)
    {
        $media_content = velocitytheme_option('image_' . $idiklan, '');
        $slot_key      = sanitize_html_class(str_replace('iklan_', '', (string) $idiklan));

        echo '<div class="media-placement media-placement-' . esc_attr($slot_key) . '">';
        if ($media_content) {
            $media_link = velocitytheme_option('link_' . $idiklan, '');
            echo '<div class="text-center">';
            echo $media_link ? '<a href="' . esc_url($media_link) . '" target="_blank" rel="noopener noreferrer">' : '';
            echo '<img class="img-fluid" src="' . esc_url($media_content) . '" alt="" loading="lazy">';
            echo $media_link ? '</a>' : '';
            echo '</div>';
        }
        echo '</div>';
    }
}

if (!function_exists('vdberita_get_no_image_url')) {
    function vdberita_get_no_image_url()
    {
        return get_stylesheet_directory_uri() . '/img/no-image.webp';
    }
}

if (!function_exists('vdberita_get_thumbnail_url')) {
    function vdberita_get_thumbnail_url($post_id = 0, $size = 'medium')
    {
        $post_id = $post_id ? absint($post_id) : get_the_ID();

        if ($post_id && has_post_thumbnail($post_id)) {
            $thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id($post_id), $size);
            if ($thumbnail) {
                return $thumbnail;
            }
        }

        return vdberita_get_no_image_url();
    }
}

if (!function_exists('vdberita_post_thumbnail')) {
    function vdberita_post_thumbnail($args = array())
    {
        $args = wp_parse_args(
            $args,
            array(
                'post_id'       => get_the_ID(),
                'size'          => 'medium',
                'ratio'         => 'ratio-16x9',
                'wrapper_class' => 'bg-light overflow-hidden',
                'link_class'    => 'd-block',
                'img_class'     => 'w-100 h-100 object-fit-cover',
                'lazy'          => true,
                'flickity_lazy' => false,
            )
        );

        $post_id    = absint($args['post_id']);
        $image_url  = vdberita_get_thumbnail_url($post_id, $args['size']);
        $title      = get_the_title($post_id);
        $image_attr = $args['flickity_lazy'] ? 'data-flickity-lazyload' : 'src';
        $loading    = $args['lazy'] && !$args['flickity_lazy'] ? ' loading="lazy"' : '';

        $output  = '<div class="ratio ' . esc_attr($args['ratio'] . ' ' . $args['wrapper_class']) . '">';
        $output .= '<a class="' . esc_attr($args['link_class']) . '" href="' . esc_url(get_permalink($post_id)) . '" title="' . esc_attr($title) . '">';
        $output .= '<img class="' . esc_attr($args['img_class']) . '" ' . $image_attr . '="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '"' . $loading . '>';
        $output .= '</a>';
        $output .= '</div>';

        return $output;
    }
}

if (!function_exists('vdberita_limit_text')) {
    function vdberita_limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
}

// Fungsi left sidebar archive
if (!function_exists('left_sidebar')) {
    function left_sidebar()
    {
        if (is_active_sidebar('secondary-sidebar')) :
            echo '<div class="d-none d-md-block col-2 p-0">';
            echo '<div class="sticky-top">';
            dynamic_sidebar('secondary-sidebar');
            echo '</div>';
            echo '</div>';
        endif;
    }
}

if (!function_exists('vdberita_get_icon')) {
    function vdberita_get_icon($name, $class = 'bi', $label = '')
    {
        $icons = array(
            'search'    => '<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>',
            'rss'       => '<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/> <path d="M5.5 12a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-3-8.5a1 1 0 0 1 1-1c5.523 0 10 4.477 10 10a1 1 0 1 1-2 0 8 8 0 0 0-8-8 1 1 0 0 1-1-1m0 4a1 1 0 0 1 1-1 6 6 0 0 1 6 6 1 1 0 1 1-2 0 4 4 0 0 0-4-4 1 1 0 0 1-1-1"/>',
            'facebook'  => '<path d="M16 8.049C16 3.603 12.418 0 8 0S0 3.603 0 8.049c0 4.016 2.926 7.347 6.75 7.951v-5.625H4.719V8.05H6.75V6.275c0-2.017 1.194-3.131 3.022-3.131.875 0 1.791.157 1.791.157v1.98h-1.009c-.994 0-1.304.621-1.304 1.258v1.51h2.219l-.355 2.326H9.25V16c3.824-.604 6.75-3.935 6.75-7.951z"/>',
            'twitter'   => '<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.213-.01-.425A6.7 6.7 0 0 0 16 3.542a6.6 6.6 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03 9.32 9.32 0 0 1 1.108 2.6a3.29 3.29 0 0 0 1.017 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.633 3.218 3.2 3.2 0 0 1-.865.115q-.318 0-.614-.057a3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58 7 7 0 0 1 0 13.534 9.3 9.3 0 0 0 5.026 15"/>',
            'instagram' => '<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.318.92.598s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919 2.5 2.5 0 0 1-.92.598c-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.232s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.275.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>',
            'youtube'   => '<path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818L10.578 7.62z"/>',
            'file-text' => '<path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>',
        );

        if (!isset($icons[$name])) {
            return '';
        }

        $aria = $label ? ' role="img" aria-label="' . esc_attr($label) . '"' : ' aria-hidden="true" focusable="false"';

        return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class) . '"' . $aria . ' viewBox="0 0 16 16">' . $icons[$name] . '</svg>';
    }
}
