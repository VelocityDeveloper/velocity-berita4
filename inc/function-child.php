<?php
/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('velocity_categories')) {
    function velocity_categories()
    {
        $args = array(
            'orderby'    => 'name',
            'hide_empty' => false,
            'exclude'    => 1,
        );
        $cats = array(
            '' => 'Show All',
        );

        $categories = get_categories($args);
        foreach ($categories as $category) {
            $cats[(string) $category->term_id] = $category->name;
        }

        return $cats;
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
        $image = esc_url_raw($image);

        return $image ? $image : $setting->default;
    }
}

if (!function_exists('velocitychild_sanitize_url')) {
    function velocitychild_sanitize_url($url, $setting)
    {
        $url = esc_url_raw($url);

        return $url ? $url : $setting->default;
    }
}

if (!function_exists('velocitychild_theme_option')) {
    function velocitychild_theme_option($option_name = null, $default = null)
    {
        if (function_exists('velocitytheme_option')) {
            return velocitytheme_option($option_name, $default);
        }

        if (null === $option_name) {
            return $default;
        }

        return get_theme_mod($option_name, $default);
    }
}

if (!function_exists('velocitychild_capture_callback')) {
    function velocitychild_capture_callback($callback, $fallback = '')
    {
        if (!is_callable($callback)) {
            return $fallback;
        }

        ob_start();
        $result = call_user_func($callback);
        $output = ob_get_clean();

        if (is_string($result) && '' !== $result) {
            $output .= $result;
        }

        return '' !== $output ? $output : $fallback;
    }
}

if (!function_exists('velocitychild_breadcrumb')) {
    function velocitychild_breadcrumb()
    {
        if (function_exists('justg_breadcrumb')) {
            return velocitychild_capture_callback('justg_breadcrumb');
        }

        if (is_front_page()) {
            return '';
        }

        $items = array(
            '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'velocity') . '</a>',
        );

        if (is_singular('post')) {
            $categories = get_the_category();
            if (!empty($categories) && !is_wp_error($categories)) {
                $items[] = '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
            }
        } elseif (is_page()) {
            $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
            foreach ($ancestors as $ancestor_id) {
                $items[] = '<a href="' . esc_url(get_permalink($ancestor_id)) . '">' . esc_html(get_the_title($ancestor_id)) . '</a>';
            }
        } elseif (is_archive()) {
            $items[] = esc_html(strip_tags(get_the_archive_title()));
        }

        if (is_singular()) {
            $items[] = esc_html(get_the_title());
        }

        return implode(' / ', $items);
    }
}

if (!function_exists('velocitychild_share')) {
    function velocitychild_share()
    {
        if (function_exists('justg_share')) {
            return velocitychild_capture_callback('justg_share');
        }

        if (!is_singular()) {
            return '';
        }

        $url   = rawurlencode(get_permalink());
        $title = rawurlencode(get_the_title());

        return '<div class="btn-group btn-group-sm" role="group" aria-label="' . esc_attr__('Share post', 'velocity') . '">'
            . '<a class="btn btn-light border" href="https://www.facebook.com/sharer/sharer.php?u=' . esc_attr($url) . '" target="_blank" rel="noopener noreferrer">Facebook</a>'
            . '<a class="btn btn-light border" href="https://twitter.com/intent/tweet?url=' . esc_attr($url) . '&text=' . esc_attr($title) . '" target="_blank" rel="noopener noreferrer">X</a>'
            . '<a class="btn btn-light border" href="https://api.whatsapp.com/send?text=' . esc_attr($title) . '%20' . esc_attr($url) . '" target="_blank" rel="noopener noreferrer">WhatsApp</a>'
            . '</div>';
    }
}

if (!function_exists('velocitychild_pagination')) {
    function velocitychild_pagination()
    {
        if (function_exists('justg_pagination')) {
            return velocitychild_capture_callback('justg_pagination');
        }

        $links = paginate_links(
            array(
                'type'      => 'list',
                'prev_text' => esc_html__('Previous', 'velocity'),
                'next_text' => esc_html__('Next', 'velocity'),
            )
        );

        return $links ? '<nav class="pagination-wrap" aria-label="' . esc_attr__('Posts navigation', 'velocity') . '">' . $links . '</nav>' : '';
    }
}

if (!function_exists('velocitychild_nav_walker')) {
    function velocitychild_nav_walker()
    {
        return class_exists('justg_WP_Bootstrap_Navwalker') ? new justg_WP_Bootstrap_Navwalker() : null;
    }
}

if (!function_exists('velocitychild_get_category_choices')) {
    function velocitychild_get_category_choices()
    {
        $choices = array(
            '' => __('Show All', 'velocity'),
        );

        $categories = get_categories(
            array(
                'orderby'    => 'name',
                'hide_empty' => false,
                'exclude'    => 1,
            )
        );

        foreach ($categories as $category) {
            $choices[(string) $category->term_id] = $category->name;
        }

        return $choices;
    }
}

if (!function_exists('velocitychild_get_post_id')) {
    function velocitychild_get_post_id($post_id = 0)
    {
        $post_id = absint($post_id);
        if ($post_id > 0) {
            return $post_id;
        }

        global $post;
        if ($post instanceof WP_Post && !empty($post->ID)) {
            return (int) $post->ID;
        }

        return (int) get_the_ID();
    }
}

if (!function_exists('velocitychild_get_thumbnail_url')) {
    function velocitychild_get_thumbnail_url($post_id = 0, $size = 'full')
    {
        $post_id = velocitychild_get_post_id($post_id);

        $thumbnail_id = get_post_thumbnail_id($post_id);
        if ($thumbnail_id) {
            $url = wp_get_attachment_image_url($thumbnail_id, $size);
            if ($url) {
                return $url;
            }
        }

        $content = get_post_field('post_content', $post_id);
        if ($content && preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches) && !empty($matches[1])) {
            return esc_url_raw($matches[1]);
        }

        return get_stylesheet_directory_uri() . '/img/no-image.webp';
    }
}

if (!function_exists('velocitychild_get_ratio_style')) {
    function velocitychild_get_ratio_style($width, $height)
    {
        $width  = absint($width);
        $height = absint($height);

        if (!$width || !$height) {
            return '--bs-aspect-ratio: 56.25%;';
        }

        return '--bs-aspect-ratio: ' . round(($height / $width) * 100, 6) . '%;';
    }
}

if (!function_exists('velocitychild_get_thumbnail_markup')) {
    function velocitychild_get_thumbnail_markup($post_id = 0, $width = 400, $height = 300, $class = 'w-100', $linked = true)
    {
        $post_id = velocitychild_get_post_id($post_id);
        $url     = velocitychild_get_thumbnail_url($post_id, 'large');
        $title   = get_the_title($post_id);
        $style   = velocitychild_get_ratio_style($width, $height);
        $class   = trim('velocity-thumb-image ' . $class);

        $html = '';
        if ($linked) {
            $html .= '<a class="d-block position-relative overflow-hidden text-decoration-none" href="' . esc_url(get_permalink($post_id)) . '" aria-label="' . esc_attr($title) . '">';
        }
        $html .= '<div class="ratio" style="' . esc_attr($style) . '">';
        $html .= '<img class="' . esc_attr($class) . '" src="' . esc_url($url) . '" alt="' . esc_attr($title) . '" loading="lazy" decoding="async">';
        $html .= '</div>';
        if ($linked) {
            $html .= '</a>';
        }

        return $html;
    }
}

if (!function_exists('velocitychild_render_thumbnail')) {
    function velocitychild_render_thumbnail($post_id = 0, $width = 400, $height = 300, $class = 'w-100', $linked = true)
    {
        echo velocitychild_get_thumbnail_markup($post_id, $width, $height, $class, $linked);
    }
}

if (!function_exists('velocitychild_svg_icon')) {
    function velocitychild_svg_icon($icon, $class = 'bi')
    {
        $svg = '';

        switch ($icon) {
            case 'rss':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-rss') . '" viewBox="0 0 16 16"> <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/> <path d="M5.5 12a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-3-8.5a1 1 0 0 1 1-1c5.523 0 10 4.477 10 10a1 1 0 1 1-2 0 8 8 0 0 0-8-8 1 1 0 0 1-1-1m0 4a1 1 0 0 1 1-1 6 6 0 0 1 6 6 1 1 0 1 1-2 0 4 4 0 0 0-4-4 1 1 0 0 1-1-1"/> </svg>';
                break;
            case 'person':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-person-fill') . '" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg>';
                break;
            case 'calendar':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-calendar') . '" viewBox="0 0 16 16"><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg>';
                break;
            case 'list':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-list') . '" viewBox="0 0 16 16"><path d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/></svg>';
                break;
            case 'search':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-search') . '" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>';
                break;
            case 'facebook':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-facebook') . '" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>';
                break;
            case 'twitter':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-twitter-x') . '" viewBox="0 0 16 16"><path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/></svg>';
                break;
            case 'instagram':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-instagram') . '" viewBox="0 0 16 16"><path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.086 3.269.222 2.76.42a4.92 4.92 0 0 0-1.675 1.094A4.92 4.92 0 0 0 .42 3.76C.222 4.27.086 4.85.048 5.703.01 6.556 0 6.829 0 9s.01 2.444.048 3.297c.038.853.174 1.433.372 1.943.206.526.48.972.842 1.334.362.362.808.636 1.334.842.51.198 1.09.334 1.943.372C5.556 15.99 5.829 16 8 16s2.444-.01 3.297-.048c.853-.038 1.433-.174 1.943-.372a4.9 4.9 0 0 0 2.176-1.676 4.9 4.9 0 0 0 .842-1.334c.198-.51.334-1.09.372-1.943C15.99 9.444 16 9.171 16 7s-.01-2.444-.048-3.297c-.038-.853-.174-1.433-.372-1.943a4.9 4.9 0 0 0-1.676-2.176A4.9 4.9 0 0 0 12.57.42c-.51-.198-1.09-.334-1.943-.372C9.773.01 9.5 0 8 0zm0 1.44c2.144 0 2.388.008 3.23.047.778.036 1.2.166 1.483.276.375.146.642.321.923.602.281.281.456.548.602.923.11.283.24.705.276 1.483.039.842.047 1.086.047 3.23s-.008 2.388-.047 3.23c-.036.778-.166 1.2-.276 1.483-.146.375-.321.642-.602.923-.281.281-.548.456-.923.602-.283.11-.705.24-1.483.276C10.388 14.56 10.144 14.568 8 14.568s-2.388-.008-3.23-.047c-.778-.036-1.2-.166-1.483-.276a3.47 3.47 0 0 1-.923-.602 3.47 3.47 0 0 1-.602-.923c-.11-.283-.24-.705-.276-1.483C1.44 10.388 1.432 10.144 1.432 8s.008-2.388.047-3.23c.036-.778.166-1.2.276-1.483.146-.375.321-.642.602-.923.281-.281.548-.456.923-.602.283-.11.705-.24 1.483-.276C5.612 1.448 5.856 1.44 8 1.44zm0 1.912a4.648 4.648 0 1 0 0 9.296 4.648 4.648 0 0 0 0-9.296zm0 7.667a3.019 3.019 0 1 1 0-6.038 3.019 3.019 0 0 1 0 6.038zm5.03-7.852a1.086 1.086 0 1 0 0 2.172 1.086 1.086 0 0 0 0-2.172z"/></svg>';
                break;
            case 'youtube':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-youtube') . '" viewBox="0 0 16 16"><path d="M8.051 1.999h-.002c-1.68 0-3.247.05-4.546.14-1.372.094-2.3 1.14-2.41 2.542C1.01 5.72 1 6.792 1 8s.01 2.28.093 3.318c.11 1.403 1.038 2.448 2.41 2.542 1.299.09 2.866.14 4.546.14h.002c1.68 0 3.247-.05 4.546-.14 1.372-.094 2.3-1.14 2.41-2.542C15.99 10.28 16 9.208 16 8s-.01-2.28-.093-3.318c-.11-1.403-1.038-2.448-2.41-2.542-1.299-.09-2.866-.14-4.546-.14zM6.545 5.5l4.5 2.5-4.5 2.5z"/></svg>';
                break;
            case 'tiktok':
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($class . ' bi-tiktok') . '" viewBox="0 0 16 16"><path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/></svg>';
                break;
            default:
                $svg = '';
                break;
        }

        return $svg;
    }
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);
add_action('customize_register', 'velocitychild_customize_register', 20);

function velocitychild_theme_setup()
{
    register_nav_menus(
        array(
            'secondary' => __('Secondary Menu', 'velocity'),
        )
    );

    remove_action('justg_header', 'justg_header_menu');
    remove_action('justg_do_footer', 'justg_the_footer_open');
    remove_action('justg_do_footer', 'justg_the_footer_content');
    remove_action('justg_do_footer', 'justg_the_footer_close');
    remove_theme_support('widgets-block-editor');
}

function velocitychild_customize_register(WP_Customize_Manager $wp_customize)
{
    $wp_customize->add_panel(
        'panel_berita4',
        array(
            'title'       => __('Velocity Berita 4', 'velocity'),
            'description' => __('Pengaturan custom child theme Velocity Berita4.', 'velocity'),
            'priority'    => 10,
        )
    );

    $wp_customize->add_section(
        'section_banner_home',
        array(
            'title'    => __('Banner Home', 'velocity'),
            'panel'    => 'panel_berita4',
            'priority' => 10,
        )
    );

    $banner_fields = array(
        'banner_header' => array(
            'label'       => __('Banner Header', 'velocity'),
            'description'  => __('Size : 468x60px. Tampil di header web.', 'velocity'),
        ),
        'banner01' => array(
            'label'       => __('Banner Home 01', 'velocity'),
            'description'  => __('Size : 300x250px. Tampil di samping slider home.', 'velocity'),
        ),
        'banner02' => array(
            'label'       => __('Banner Home 02', 'velocity'),
            'description'  => __('Size : 468x60px. Tampil di tengah home.', 'velocity'),
        ),
        'banner03' => array(
            'label'       => __('Banner Home 03', 'velocity'),
            'description'  => __('Size : 468x60px. Tampil di tengah home.', 'velocity'),
        ),
        'banner04' => array(
            'label'       => __('Banner Home 04', 'velocity'),
            'description'  => __('Size : 300x250px. Tampil di tengah home.', 'velocity'),
        ),
    );

    foreach ($banner_fields as $setting => $data) {
        $wp_customize->add_setting(
            $setting,
            array(
                'default'           => '',
                'sanitize_callback' => 'velocitychild_sanitize_image',
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                $setting,
                array(
                    'label'       => $data['label'],
                    'description' => $data['description'],
                    'section'     => 'section_banner_home',
                )
            )
        );
    }

    $wp_customize->add_section(
        'section_banner',
        array(
            'title'    => __('Banner Archive & Single', 'velocity'),
            'panel'    => 'panel_berita4',
            'priority' => 11,
        )
    );

    $archive_single_fields = array(
        'banner05' => array(
            'label'       => __('Banner Archive', 'velocity'),
            'description'  => __('Size : 468x60px. Tampil di samping slider home.', 'velocity'),
        ),
        'banner06' => array(
            'label'       => __('Banner Single Atas', 'velocity'),
            'description'  => __('Size : 468x60px. Tampil di bawah judul.', 'velocity'),
        ),
        'banner07' => array(
            'label'       => __('Banner Single Bawah', 'velocity'),
            'description'  => __('Size : 468x60px. Tampil di bawah konten.', 'velocity'),
        ),
    );

    foreach ($archive_single_fields as $setting => $data) {
        $wp_customize->add_setting(
            $setting,
            array(
                'default'           => '',
                'sanitize_callback' => 'velocitychild_sanitize_image',
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                $setting,
                array(
                    'label'       => $data['label'],
                    'description' => $data['description'],
                    'section'     => 'section_banner',
                )
            )
        );
    }

    $wp_customize->add_section(
        'section_sosmed',
        array(
            'title'    => __('Sosial Media', 'velocity'),
            'panel'    => 'panel_berita4',
            'priority' => 12,
        )
    );

    $social_fields = array(
        'facebook' => __('URL Facebook', 'velocity'),
        'twitter'  => __('URL Twitter', 'velocity'),
        'instagram'=> __('URL Instagram', 'velocity'),
        'youtube'  => __('URL Youtube', 'velocity'),
        'tiktok'   => __('URL Tiktok', 'velocity'),
    );

    foreach ($social_fields as $key => $label) {
        $setting_id = 'link_sosmed_' . $key;
        $wp_customize->add_setting(
            $setting_id,
            array(
                'default'           => '',
                'sanitize_callback' => 'velocitychild_sanitize_url',
            )
        );
        $wp_customize->add_control(
            $setting_id,
            array(
                'type'    => 'url',
                'label'   => $label,
                'section' => 'section_sosmed',
            )
        );
    }

    $wp_customize->add_section(
        'section_homepost',
        array(
            'title'    => __('Berita Home', 'velocity'),
            'panel'    => 'panel_berita4',
            'priority' => 13,
        )
    );

    $category_choices = velocitychild_get_category_choices();
    for ($i = 1; $i <= 8; $i++) {
        $setting_id = 'home_post_' . $i;
        $wp_customize->add_setting(
            $setting_id,
            array(
                'default'           => '',
                'sanitize_callback' => 'velocitychild_sanitize_select',
            )
        );
        $wp_customize->add_control(
            $setting_id,
            array(
                'type'        => 'select',
                'label'       => sprintf(__('Home Post %d', 'velocity'), $i),
                'section'     => 'section_homepost',
                'choices'     => $category_choices,
                'description' => __('Pilih kategori untuk blok ini.', 'velocity'),
            )
        );
    }
}

if (!function_exists('justg_header_open')) {
    function justg_header_open()
    {
        echo '<header id="wrapper-header">';
        echo '<div id="wrapper-navbar" class="wrapper-fluid wrapper-navbar position-relative" itemscope itemtype="http://schema.org/WebSite">';
    }
}

if (!function_exists('justg_header_close')) {
    function justg_header_close()
    {
        echo '</div>';
        echo '</header>';
    }
}

if (!function_exists('justg_header_berita')) {
    function justg_header_berita()
    {
        require_once get_stylesheet_directory() . '/inc/part-header.php';
    }
}

if (!function_exists('justg_footer_berita')) {
    function justg_footer_berita()
    {
        require_once get_stylesheet_directory() . '/inc/part-footer.php';
    }
}

add_action('justg_header', 'justg_header_berita');
add_action('justg_do_footer', 'justg_footer_berita');

add_action('justg_before_wrapper_content', 'justg_before_wrapper_content');
if (!function_exists('justg_before_wrapper_content')) {
    function justg_before_wrapper_content()
    {
        echo '<div class="px-md-2">';
        echo '<div class="card rounded-0 border-light border-top-0 border-bottom-0 p-0 container">';
    }
}

add_action('justg_after_wrapper_content', 'justg_after_wrapper_content');
if (!function_exists('justg_after_wrapper_content')) {
    function justg_after_wrapper_content()
    {
        echo '</div>';
        echo '</div>';
    }
}

if (!function_exists('justg_right_sidebar_check')) {
    function justg_right_sidebar_check()
    {
        if (is_singular('fl-builder-template')) {
            return;
        }
        if (!is_active_sidebar('main-sidebar')) {
            return;
        }
        echo '<div class="right-sidebar velocity-widget widget-area px-2 col-sm-12 col-md-4 order-3" id="right-sidebar" role="complementary">';
        echo '<div class="sticky-top">';
        do_action('justg_before_main_sidebar');
        dynamic_sidebar('main-sidebar');
        do_action('justg_after_main_sidebar');
        echo '</div>';
        echo '</div>';
    }
}

// excerpt
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

if (!function_exists('vdlimit_title')) {
    function vdlimit_title($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
}

if (!function_exists('vdbanner')) {
    function vdbanner($sett, $class)
    {
        $banner = '';
        $img    = velocitychild_theme_option($sett);

        if ($img) {
            $banner = '<div class="' . esc_attr($class) . '"><img class="img-fluid" src="' . esc_url($img) . '" alt="' . esc_attr(get_bloginfo('name')) . '" loading="lazy" decoding="async" /></div>';
        }

        return $banner;
    }
}

if (!function_exists('vdpost_related')) {
    function vdpost_related()
    {
        $post_id = get_the_ID();
        $cat_ids = array();
        $categories = get_the_category($post_id);

        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $cat_ids[] = $category->term_id;
            }
        }

        $query_args = array(
            'category__in'   => $cat_ids,
            'post_type'      => get_post_type($post_id),
            'post__not_in'   => array($post_id),
            'posts_per_page' => 6,
        );

        $related_query = new WP_Query($query_args);
        if ($related_query->have_posts()) : ?>
            <div class="related-post block-primary py-3">
                <div class="related-post-title border-bottom border-theme border-3 mb-2">
                    <span class="bg-theme text-white py-1 px-2 d-inline-block">RELATED POSTS</span>
                </div>

                <div class="slick-related">
                    <?php
                    while ($related_query->have_posts()) :
                        $related_query->the_post(); ?>
                        <div class="related-items bg-muted p-2">
                            <div class="row m-0 align-items-center">
                                <div class="col-3 p-0">
                                    <div class="relate-thumb ratio ratio-1x1">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                            echo '<img class="rounded rounded-2" src="' . esc_url($img_atr[0]) . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy" decoding="async" />';
                                        } else {
                                            echo '<img class="rounded rounded-2 w-100 h-100 object-fit-cover" src="' . esc_url(get_stylesheet_directory_uri() . '/img/no-image.webp') . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy" decoding="async" />';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-9 p-0 ps-2">
                                    <span class="fw-bold"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(vdlimit_title(get_the_title(), 6)); ?></a></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php
        endif;

        wp_reset_postdata();
    }
}
