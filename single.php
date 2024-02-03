<?php

/**
 * The template for displaying all single posts
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container  = velocitytheme_option('justg_container_type', 'container');
$full_url   = get_the_post_thumbnail_url(get_the_ID(), 'full');
$format     = get_post_format() ?: 'standard';
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="breadcrumbs-wrap pt-2 px-3 mb-3">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row">
            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>
            <main class="site-main col order-2" id="main">
                <?php
                while (have_posts()) {
                    the_post();
                    the_title('<h1 class="entry-title h4 fw-bold">', '</h1>'); ?>
                    <div class="justify-content-between align-items-center py-1 px-2 text-muted bg-light mb-3">
                        <div>
                            <small>
                                <i class="fa fa-user-o"></i> <?php echo get_the_author_posts_link(); ?>
                            </small>
                            <small class="ms-2">
                                <i class="fa fa-calendar-o"></i> <?php echo get_the_date(); ?>
                            </small>
                            <?php $getterms = wp_get_post_terms(get_the_ID(), 'category');; ?>
                            <?php if ($getterms) : ?>
                                <small class="ms-2">
                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                    <?php foreach ($getterms as $index => $term) : ?>
                                        <?php echo $index === 0 ? '' : ','; ?>
                                        <a href="<?php echo get_tag_link($term->term_id); ?>"> <?php echo $term->name; ?> </a>
                                        <?php if ($index > 1) {
                                            break;
                                        } ?>
                                    <?php endforeach; ?>
                                </small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="entry-content">

                        <?php
                        if ($full_url && $format !== 'video') {

                            echo '<img class="img-fluid w-100 mb-2" src="' . $full_url . '" loading="lazy" />';
                            echo '<div class="text-muted py-2"><small>';
                            echo the_post_thumbnail_caption();
                            echo '</small></div>';
                        }
                        ?>
                        <div class="pb-3">
                            <?php echo vdbanner('banner06', 'text-center'); ?>
                        </div>

                        <?php the_content(); ?>

                        <div class="pb-3">
                            <?php echo vdbanner('banner07', 'text-center'); ?>
                        </div>
                        <?php $gettags = get_the_tags(get_the_ID()); ?>
                        <?php if ($gettags) : ?>
                            <div class="p-2">
                                <?php foreach ($gettags as $index => $tag) : ?>
                                    <?php echo $index === 0 ? '' : ' '; ?>
                                    <a class="bg-theme py-1 px-2 mx-1 text-white" href="<?php echo get_tag_link($tag->term_id); ?>"> <?php echo $tag->name; ?> </a>
                                    <?php if ($index > 1) {
                                        break;
                                    } ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div><!-- .entry-content -->

                    <div class="author-single p-2 bg-muted mx-2">
                        <?php
                        $author_id = $post->post_author;
                        $url = get_avatar($author_id);
                        echo '<div class="px-2 fw-bold">Author : ' . get_the_author_posts_link() . '</div>';
                        echo '<div class="px-2">' . $url . '</div>';
                        ?>

                    </div>
                    <div class="single-post-nav bg-muted d-md-flex justify-content-between p-2 my-3">
                        <div class="share-post">
                            <?php echo justg_share(); ?>
                        </div>
                        <div class="nav-post">
                            <div class="btn-group" role="group" aria-label="Navigation Post">
                                <?php
                                $prev_post = get_adjacent_post(false, '', true);
                                if (!empty($prev_post)) {
                                    echo '<a href="' . get_permalink($prev_post->ID) . '" class="btn btn-sm btn-light border" title="' . $prev_post->post_title . '">Prev</a>';
                                }
                                $next_post = get_adjacent_post(false, '', false);
                                if (!empty($next_post)) {
                                    echo '<a href="' . get_permalink($next_post->ID) . '" class="btn btn-sm btn-light border" title="' . $next_post->post_title . '">Next</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php vdpost_related();
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {
                        do_action('justg_before_comments');
                        comments_template();
                        do_action('justg_after_comments');
                    }
                }
                ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
