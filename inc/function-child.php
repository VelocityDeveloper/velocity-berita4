<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
function velocity_categories()
{
    $args = array(
        'orderby' => 'name',
        'hide_empty' => false,
        'exclude'   => 1,
    );
    $cats = array(
        '' => 'Show All'
    );
    $categories = get_categories($args);
    foreach ($categories as $category) {
        $cats[$category->term_id] = $category->name;
    }
    return $cats;
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

function velocitychild_theme_setup()
{


    if (class_exists('Kirki')) :

        /**
         * Customizer control in child themes
         * Sample Panel
         * 
         */
        Kirki::add_panel('panel_berita', [
            'priority'    => 10,
            'title'       => esc_html__('Berita Setting', 'velocity'),
            'description' => esc_html__('', 'velocity'),
        ]);

        /**
         * Section Banner Home
         * 
         */
        Kirki::add_section('section_banner_home', [
            'panel'    => 'panel_berita',
            'title'    => __('Banner Home', 'velocity'),
            'priority' => 10,
        ]);

        /**
         * Field Banner Home
         * 
         */
        new \Kirki\Field\Image(
            [
                'settings'    => 'banner_header',
                'label'       => esc_html__('Banner Header', 'velocity'),
                'description' => esc_html__('Size : 468x60px. Tampil di header web.', 'velocity'),
                'section'     => 'section_banner_home',
                'default'     => '',
            ]
        );
        new \Kirki\Field\Image(
            [
                'settings'    => 'banner01',
                'label'       => esc_html__('Banner Home 01', 'velocity'),
                'description' => esc_html__('Size : 300x250px. Tampil di samping slider home.', 'velocity'),
                'section'     => 'section_banner_home',
                'default'     => '',
            ]
        );
        new \Kirki\Field\Image(
            [
                'settings'    => 'banner02',
                'label'       => esc_html__('Banner Home 02', 'velocity'),
                'description' => esc_html__('Size : 468x60px. Tampil di tengah home.', 'velocity'),
                'section'     => 'section_banner_home',
                'default'     => '',
            ]
        );
        new \Kirki\Field\Image(
            [
                'settings'    => 'banner03',
                'label'       => esc_html__('Banner Home 03', 'velocity'),
                'description' => esc_html__('Size : 468x60px. Tampil di tengah home.', 'velocity'),
                'section'     => 'section_banner_home',
                'default'     => '',
            ]
        );
        new \Kirki\Field\Image(
            [
                'settings'    => 'banner04',
                'label'       => esc_html__('Banner Home 04', 'velocity'),
                'description' => esc_html__('Size : 300x250px. Tampil di tengah home.', 'velocity'),
                'section'     => 'section_banner_home',
                'default'     => '',
            ]
        );

        /**
         * Section Banner Arsip & Single
         * 
         */
        Kirki::add_section('section_banner', [
            'panel'    => 'panel_berita',
            'title'    => __('Banner Archive & Single', 'velocity'),
            'priority' => 10,
        ]);

        /**
         * Field Banner Arsip & Single
         * 
         */
        new \Kirki\Field\Image(
            [
                'settings'    => 'banner05',
                'label'       => esc_html__('Banner Archive', 'velocity'),
                'description' => esc_html__('Size : 468x60px. Tampil di samping slider home.', 'velocity'),
                'section'     => 'section_banner',
                'default'     => '',
            ]
        );
        new \Kirki\Field\Image(
            [
                'settings'    => 'banner06',
                'label'       => esc_html__('Banner Single Atas', 'velocity'),
                'description' => esc_html__('Size : 468x60px. Tampil di bawah judul.', 'velocity'),
                'section'     => 'section_banner',
                'default'     => '',
            ]
        );
        new \Kirki\Field\Image(
            [
                'settings'    => 'banner07',
                'label'       => esc_html__('Banner Single Atas', 'velocity'),
                'description' => esc_html__('Size : 468x60px. Tampil di bawah konten.', 'velocity'),
                'section'     => 'section_banner',
                'default'     => '',
            ]
        );

        /**
         * Section Sosial Media
         * 
         */
        Kirki::add_section('section_sosmed', [
            'panel'    => 'panel_berita',
            'title'    => __('Sosial Media', 'velocity'),
            'priority' => 10,
        ]);

        new \Kirki\Field\URL(
            [
                'settings' => 'link_sosmed_facebook',
                'label'    => esc_html__('URL Facebook', 'velocity'),
                'section'  => 'section_sosmed',
                'default'  => 'https://facebook.com/',
                'priority' => 10,
            ]
        );
        new \Kirki\Field\URL(
            [
                'settings' => 'link_sosmed_twitter',
                'label'    => esc_html__('URL Twitter', 'velocity'),
                'section'  => 'section_sosmed',
                'default'  => 'https://twitter.com/',
                'priority' => 10,
            ]
        );
        new \Kirki\Field\URL(
            [
                'settings' => 'link_sosmed_instagram',
                'label'    => esc_html__('URL Instagram', 'velocity'),
                'section'  => 'section_sosmed',
                'default'  => 'https://instagram.com/',
                'priority' => 10,
            ]
        );
        new \Kirki\Field\URL(
            [
                'settings' => 'link_sosmed_youtube',
                'label'    => esc_html__('URL Youtube', 'velocity'),
                'section'  => 'section_sosmed',
                'default'  => 'https://youtube.com/',
                'priority' => 10,
            ]
        );
        new \Kirki\Field\URL(
            [
                'settings' => 'link_sosmed_tiktok',
                'label'    => esc_html__('URL Tiktok', 'velocity'),
                'section'  => 'section_sosmed',
                'default'  => 'https://tiktok.com/',
                'priority' => 10,
            ]
        );

        // Section Berita Home
        Kirki::add_section('section_homepost', [
            'panel'    => 'panel_berita',
            'title'    => __('Berita Home', 'velocity'),
            'priority' => 10,
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'home_post_1',
            'label'     => esc_html__('Home Post 1', 'velocity'),
            'section'   => 'section_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'velocity'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'home_post_2',
            'label'     => esc_html__('Home Post 2', 'velocity'),
            'section'   => 'section_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'velocity'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'home_post_3',
            'label'     => esc_html__('Home Post 3', 'velocity'),
            'section'   => 'section_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'velocity'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'home_post_4',
            'label'     => esc_html__('Home Post 4', 'velocity'),
            'section'   => 'section_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'velocity'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'home_post_5',
            'label'     => esc_html__('Home Post 5', 'velocity'),
            'section'   => 'section_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'velocity'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'home_post_6',
            'label'     => esc_html__('Home Post 6', 'velocity'),
            'section'   => 'section_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'velocity'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'home_post_7',
            'label'     => esc_html__('Home Post 7', 'velocity'),
            'section'   => 'section_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'velocity'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'home_post_8',
            'label'     => esc_html__('Home Post 8', 'velocity'),
            'section'   => 'section_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'velocity'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);

    endif;

    register_nav_menus(
        array(
            'secondary' => __('Secondary Menu', 'velocity'),
        )
    );

    //remove action from Parent Theme
    remove_action('justg_header', 'justg_header_menu');
    remove_action('justg_do_footer', 'justg_the_footer_open');
    remove_action('justg_do_footer', 'justg_the_footer_content');
    remove_action('justg_do_footer', 'justg_the_footer_close');
    remove_theme_support('widgets-block-editor');
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

///add action builder part
add_action('justg_header', 'justg_header_berita');
function justg_header_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_berita');
function justg_footer_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}

add_action('justg_before_wrapper_content', 'justg_before_wrapper_content');
function justg_before_wrapper_content()
{
    echo '<div class="px-md-2">';
    echo '<div class="card rounded-0 border-light border-top-0 border-bottom-0 p-0 container">';
}
add_action('justg_after_wrapper_content', 'justg_after_wrapper_content');
function justg_after_wrapper_content()
{
    echo '</div>';
    echo '</div>';
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
function vdberita_limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '[...]';
    }
    return $text;
}

function vdlimit_title($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

// banner func
function vdbanner($sett, $class)
{
    $img = velocitytheme_option($sett);
    if ($img) :
        $banner = '<div class="' . $class . '"><img src="' . $img . '" /></div>';
    endif;
    return $banner;
}

// related post
function vdpost_related()
{
    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category($post_id);

    if (!empty($categories) && !is_wp_error($categories)) :
        foreach ($categories as $category) :
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);

    $query_args = array(
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => '6',
    );
    $related_query = new WP_Query($query_args);
    // The Loop
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
                                    if (has_post_thumbnail()) :
                                        $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                        echo '<img class="rounded rounded-2" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" />';
                                    else :
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <div class="col-9 p-0 ps-2">
                                <span class="fw-bold"><a href="<?php echo get_the_permalink(); ?>"><?php echo vdlimit_title(get_the_title(), 6); ?></a></span>
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
