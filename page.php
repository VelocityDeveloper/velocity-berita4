<?php

/**
 * The template for displaying all pages.
 *
 * @package velocity-berita4
 */

defined('ABSPATH') || exit;

get_header();

$container           = velocitychild_theme_option('justg_container_type', 'container');
$breadcrumb_position = velocitychild_theme_option('breadcrumb_position', 'justg_before_title');

if (function_exists('justg_breadcrumb')) {
    remove_action($breadcrumb_position, 'justg_breadcrumb');
}
?>

<div class="wrapper page-shell" id="page-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="breadcrumbs-wrap pt-2 px-3 mb-3">
            <?php echo velocitychild_breadcrumb(); ?>
        </div>

        <div class="row">

            <?php do_action('justg_before_content'); ?>

            <main class="site-main page-main" id="main" role="main">

                <?php
                while (have_posts()) {
                    the_post();
                    get_template_part('loop-templates/content', 'page');

                    if (comments_open() || get_comments_number()) {
                        do_action('justg_before_comments');
                        comments_template();
                        do_action('justg_after_comments');
                    }
                }
                ?>

            </main>

            <?php do_action('justg_after_content'); ?>

        </div>

    </div>

</div>

<?php
get_footer();
