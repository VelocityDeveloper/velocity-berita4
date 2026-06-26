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
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="breadcrumbs-wrap pt-2 px-3 mb-3">
            <?php echo velocitychild_breadcrumb(); ?>
        </div>

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main" id="main">

                <?php

                if (have_posts()) {
                ?>
                    <header class="page-header block-primary">
                        <?php
                        the_archive_title('<h1 class="page-title text-uppercase">', '</h1>');
                        the_archive_description('<div class="taxonomy-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->
                    <?php
                    // Start the loop.
                    $postcount = 1;
                    while (have_posts()) {
                        the_post(); ?>
                        <article class="block-primary mb-4">
                            <?php if ($postcount === 1) : ?>
                                <div class="row m-0">
                                    <div class="col-md-5 p-0">
                                        <?php echo velocitychild_get_thumbnail_markup(get_the_ID(), 4, 3, 'w-100'); ?>
                                    </div>
                                    <div class="col-md-7 p-0 ps-2">
                                        <?php
                                        the_title(
                                            sprintf('<h6 class="fw-bold pt-2"><a href="%s" class="" rel="bookmark">', esc_url(get_permalink())),
                                            '</a></h6>'
                                        );
                                        $konten = get_the_content();
                                        ?>
                                        <div class="pb-2 text-muted">
                                            <small>
                                                <?php echo velocitychild_svg_icon('person', 'me-1'); ?> <?php echo get_the_author(); ?>
                                            </small>
                                            <small class="ms-2">
                                                <?php echo velocitychild_svg_icon('calendar', 'me-1'); ?> <?php echo get_the_date(); ?>
                                            </small>
                                        </div>
                                        <div class="konten mb-2"><?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?></div>
                                        <div class="float-md-end"><?php echo velocitychild_share(); ?></div>
                                    </div>
                                </div>
                                <hr class="my-2 hr-dotted">
                            <?php else : ?>
                                <div class="row m-0">
                                    <div class="col-md-3 p-0">
                                        <?php echo velocitychild_get_thumbnail_markup(get_the_ID(), 4, 3, 'w-100'); ?>
                                    </div>
                                    <div class="col-md-9 p-0 ps-md-2">
                                        <div class="post-text">
                                            <?php
                                            the_title(
                                                sprintf('<h6 class="pt-2 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                                '</a></h6>'
                                            );
                                            ?>
                                            <div class="pb-2 text-muted">
                                                <small>
                                                    <?php echo velocitychild_svg_icon('person', 'me-1'); ?> <?php echo get_the_author(); ?>
                                                </small>
                                                <small class="ms-2">
                                                    <?php echo velocitychild_svg_icon('calendar', 'me-1'); ?> <?php echo get_the_date(); ?>
                                                </small>
                                            </div>
                                            <div class="post-excerpt text-muted pb-2">
                                                <div class="d-none d-md-block">
                                                    <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
                                                </div>
                                                <div class="d-md-none">
                                                    <small>
                                                        <?php echo vdberita_limit_text(strip_tags(get_the_content()), 15); ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-start"><?php echo velocitychild_share(); ?></div>
                                    </div>
                                </div>
                                <hr class="my-2 hr-dotted">
                            <?php endif; ?>
                        </article>
                <?php
                        if ($postcount == 1) :
                            echo '<div class="mb-3">';
                            echo vdbanner('banner05', 'text-center');
                            echo '</div>';
                        endif;
                        $postcount++;
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
                <!-- Display the pagination component. -->
                <?php echo velocitychild_pagination(); ?>
            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
