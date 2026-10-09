<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitychild_theme_option('justg_container_type', 'container');

if (is_search()) {
    $archive_title = sprintf(__('Hasil Pencarian: %s', 'velocity'), get_search_query());
} else {
    $archive_title = wp_strip_all_tags(get_the_archive_title());
}
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="breadcrumbs-wrap pt-2 px-3 mb-3">
            <?php echo velocitychild_archive_breadcrumb($archive_title); ?>
        </div>

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main velocity-archive" id="main">

                <header class="page-header archive-header bg-theme text-white p-2 mb-3">
                    <h1 class="page-title text-uppercase m-0"><?php echo esc_html($archive_title); ?></h1>
                    <?php the_archive_description('<div class="taxonomy-description small mt-1">', '</div>'); ?>
                </header><!-- .page-header -->

                <?php
                if (have_posts()) {
                    $postcount = 1;
                    while (have_posts()) {
                        the_post();
                        $excerpt = vdberita_limit_text(wp_strip_all_tags(get_the_content()), 25);
                ?>
                        <?php if ($postcount === 1) : ?>
                            <article <?php post_class('archive-item archive-item-utama mb-3'); ?>>
                                <?php echo velocitychild_get_thumbnail_markup(get_the_ID(), 16, 9, 'w-100'); ?>
                                <div class="archive-item-body bg-theme text-white p-3">
                                    <h2 class="archive-item-title h5 fw-bold mb-2"><a class="text-white" href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                    <div class="archive-item-meta small mb-2">
                                        <span class="me-3"><?php echo velocitychild_svg_icon('person', 'me-1'); ?><?php echo esc_html(get_the_author()); ?></span>
                                        <span><?php echo velocitychild_svg_icon('calendar', 'me-1'); ?><?php echo esc_html(get_the_date()); ?></span>
                                    </div>
                                    <div class="archive-item-excerpt"><?php echo esc_html($excerpt); ?></div>
                                </div>
                            </article>
                            <?php echo vdbanner('banner05', 'text-center mb-3'); ?>
                        <?php else : ?>
                            <article <?php post_class('archive-item d-flex gap-3 py-3'); ?>>
                                <div class="archive-item-thumb flex-shrink-0">
                                    <?php echo velocitychild_get_thumbnail_markup(get_the_ID(), 4, 3, 'w-100'); ?>
                                </div>
                                <div class="archive-item-body flex-grow-1">
                                    <h2 class="archive-item-title h6 fw-bold mb-1"><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                    <div class="archive-item-meta small text-muted mb-1">
                                        <span class="me-3"><?php echo velocitychild_svg_icon('person', 'me-1'); ?><?php echo esc_html(get_the_author()); ?></span>
                                        <span><?php echo velocitychild_svg_icon('calendar', 'me-1'); ?><?php echo esc_html(get_the_date()); ?></span>
                                    </div>
                                    <div class="archive-item-excerpt small text-muted d-none d-md-block"><?php echo esc_html($excerpt); ?></div>
                                </div>
                            </article>
                        <?php endif; ?>
                <?php
                        $postcount++;
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
                <!-- Display the pagination component. -->
                <div class="mt-3"><?php echo velocitychild_pagination(); ?></div>
            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
