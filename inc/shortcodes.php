<?php
/**
 * Kumpulan shortcode yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('velocitychild_get_shortcode_post_id')) {
    function velocitychild_get_shortcode_post_id($post_id = 0)
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

// [velocity-excerpt count="150" post_id=""]
add_shortcode('velocity-excerpt', 'vd_getexcerpt');
function vd_getexcerpt($atts)
{
    ob_start();
    $atribut = shortcode_atts(array(
        'count'   => '150',
        'post_id' => 0,
    ), $atts);

    $post_id = velocitychild_get_shortcode_post_id($atribut['post_id']);
    $count   = absint($atribut['count']);
    $excerpt = get_the_excerpt($post_id);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $count);
    $excerpt = substr($excerpt, 0, strripos($excerpt, ' '));

    echo esc_html($excerpt . '...');

    return ob_get_clean();
}

// [vd-breadcrumbs]
add_shortcode('vd-breadcrumbs', 'vd_breadcrumbs');
function vd_breadcrumbs()
{
    ob_start();
    echo velocitychild_breadcrumb();
    return ob_get_clean();
}

// [ratio-thumbnail size="medium" ratio="16:9"]
add_shortcode('ratio-thumbnail', 'ratio_thumbnail');
function ratio_thumbnail($atts)
{
    ob_start();
    $atribut = shortcode_atts(array(
        'size'   => 'medium',
        'ratio'  => '16:9',
        'post_id'=> 0,
    ), $atts);

    $post_id = velocitychild_get_shortcode_post_id($atribut['post_id']);
    $ratio   = $atribut['ratio'] ? str_replace(':', '-', $atribut['ratio']) : '16-9';
    $width   = 16;
    $height  = 9;

    switch ($ratio) {
        case '1-1':
            $width = 1;
            $height = 1;
            break;
        case '4-3':
            $width = 4;
            $height = 3;
            break;
        case '3-2':
            $width = 3;
            $height = 2;
            break;
        case '8-5':
            $width = 8;
            $height = 5;
            break;
        case '16-9':
        default:
            $width = 16;
            $height = 9;
            break;
    }

    echo '<div class="ratio-thumbnail">';
        echo '<a class="ratio-thumbnail-link d-block text-decoration-none" href="' . esc_url(get_the_permalink($post_id)) . '" title="' . esc_attr(get_the_title($post_id)) . '">';
            echo '<div class="ratio" style="' . esc_attr(velocitychild_get_ratio_style($width, $height)) . ';">';
                echo '<img src="' . esc_url(velocitychild_get_thumbnail_url($post_id, $atribut['size'])) . '" loading="lazy" decoding="async" class="ratio-thumbnail-image velocity-thumb-image" alt="' . esc_attr(get_the_title($post_id)) . '">';
            echo '</div>';
        echo '</a>';
    echo '</div>';

    return ob_get_clean();
}

// [vdcari]
add_shortcode('vdcari', 'vdcari');
function vdcari()
{
    ob_start(); ?>
    <div class="pencarian">
        <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
            <label class="visually-hidden" for="s"><?php esc_html_e('Search', 'velocity'); ?></label>
            <div class="input-group">
                <input class="field form-control form-control-sm rounded-0" id="s" name="s" type="text" placeholder="Search" value="<?php the_search_query(); ?>" required>
                <button type="submit" class="submit btn h-100 btn-sm rounded-end">
                    <?php echo velocitychild_svg_icon('search', 'text-white'); ?>
                </button>
            </div>
        </form>
    </div>
    <?php
    return ob_get_clean();
}

// [vd-listpost meta_key="hit" orderby="hit" layout="1" number="5"]
add_shortcode('vd-listpost', 'vd_listpost');
function vd_listpost($atts)
{
    ob_start();

    $atribut = shortcode_atts(array(
        'meta_key' => 'hit',
        'orderby'  => 'meta_value_num',
        'layout'   => 1,
        'number'   => 5,
    ), $atts);

    $orderby = $atribut['orderby'];
    if ('number' === $orderby || 'hit' === $orderby) {
        $orderby = 'meta_value_num';
    }

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => absint($atribut['number']),
        'meta_key'       => $atribut['meta_key'],
        'orderby'        => $orderby,
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        echo '<div class="vdpost">';
        if ((int) $atribut['layout'] === 1) :
            while ($query->have_posts()) :
                $query->the_post(); ?>
                <div class="row m-0 mb-2 bg-rainbow">
                    <div class="col-4 p-0"><?php echo do_shortcode('[ratio-thumbnail size="medium" ratio="1:1"]'); ?></div>
                    <div class="col-8 p-0 ps-2"><a class="text-white" href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(vdlimit_title(get_the_title(), 5)); ?></a></div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
        else :
            while ($query->have_posts()) :
                $query->the_post(); ?>
                <div class="row m-0 mb-2">
                    <div class="col-4 p-0"><?php echo do_shortcode('[ratio-thumbnail size="medium" ratio="1:1"]'); ?></div>
                    <div class="col-8 p-0 ps-2">
                        <div><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(vdlimit_title(get_the_title(), 5)); ?></a></div>
                        <small class="text-muted">
                            <?php echo velocitychild_svg_icon('calendar', 'me-1'); ?> <?php echo esc_html(get_the_date('F j, Y')); ?>
                        </small>
                    </div>
                    <hr class="my-2 hr-dotted">
                </div>
<?php
            endwhile;
            wp_reset_postdata();
        endif;
        echo '</div>';
    endif;

    return ob_get_clean();
}
