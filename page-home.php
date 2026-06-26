<?php

/**
 * Template Name: Home Page
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package velocity
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitychild_theme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="index-wrapper">

    <div class="container-home-first container d-none d-md-block p-3 bg-pattern">

        <div class="row m-0 align-items-center">

            <div class="col-md px-md-2">
                <?php
                // The Query
                $posts_query = new WP_Query(
                    array(
                        'post_type'         => 'post',
                        'posts_per_page'    => 5,
                    )
                );
                // The Loop
                $nm = 1;
                if ($posts_query->have_posts()) {
                    echo '<div id="carouselHome" class="carousel slide carousel-fade" data-bs-ride="carousel">';
                    echo '<div class="carousel-inner">';
                    while ($posts_query->have_posts()) {
                        $posts_query->the_post();
                ?>
                        <div class="slideshow-post-item carousel-item  <?php echo ($nm == 1 ? 'active' : ''); ?>">
                            <a class="d-block position-relative" href="<?php echo esc_url(get_the_permalink()); ?>">
                                <?php echo velocitychild_get_thumbnail_markup(get_the_ID(), 21, 9, 'w-100', false); ?>

                                <div class="carousel-caption text-md-start text-center">
                                    <span class="bg-dark d-inline-block p-2" style="--bs-bg-opacity: 0.90;">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </span>
                                </div>

                            </a>
                        </div>
                <?php
                        $nm++;
                    }
                    $nm = 0;
                    echo '</div>';
                    echo '<div class="carousel-indicators">';
                    while ($posts_query->have_posts()) {
                        $posts_query->the_post();
                        echo '<button type="button" data-bs-target="#carouselHome" data-bs-slide-to="' . $nm . '" ' . ($nm == 0 ? 'class="active"' : '') . ' aria-current="true" aria-label="Slide ' . $nm . '"></button>';
                        $nm++;
                    }
                    echo '</div>';
                    echo '</div>';
                }
                /* Restore original Post Data */
                wp_reset_postdata();
                ?>
            </div>
            <div class="col-md-4 px-md-2">
                <?php echo vdbanner('banner01', 'text-center'); ?>
            </div>
        </div>
    </div>

    <div class="my-md-3 <?php echo esc_attr($container); ?>" id="content" tabindex="-1">
        <div class="row m-0">
            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>
            <div class="col-md">
                <main class="site-main col order-2" id="main">
                    <div class="part_posts_home">
                        <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                            <?php
                            if (velocitychild_theme_option('home_post_1')) :
                                $category = get_category(velocitychild_theme_option('home_post_1'));
                                $category_title = $category->name;
                                $category_link = get_category_link($category->term_id);
                            else :
                                $category_title = 'RECENT POSTS';
                                $category_link = '#';
                            endif;
                            ?>
                            <span><a class="text-dark" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_title); ?></a></span>
                            <span><a class="text-white ikon-home" href="<?php echo esc_url($category_link); ?>"><?php echo velocitychild_svg_icon('rss'); ?></a></span>
                        </h6>

                        <div class="part-post-home-2 py-2">
                            <div class="row m-0">
                                <div class="col-md-9 p-0 pe-md-1">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => velocitychild_theme_option('home_post_1'),
                                        'posts_per_page' => 1,
                                    );
                                    $query1 = new WP_Query($post2_args);

                                    if ($query1->have_posts()) :
                                        while ($query1->have_posts()) :
                                            $query1->the_post(); ?>
                                            <div class="bg-theme">
                                                <div class="post_thumbnail"><?php echo do_shortcode('[ratio-thumbnail size="medium" ratio="8:5"]'); ?></div>
                                                <div class="p-3" style="min-height: 170px;">
                                                    <h5 class="my-1 fw-bold"><a class="text-dark" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
                                                    <div class="konten"><?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?></div>
                                                </div>
                                            </div>
                                    <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>
                                <div class="col-md-3 p-0">
                                    <?php
                                    $args2 = array(
                                        'post_type' => 'post',
                                        'cat'       => velocitychild_theme_option('home_post_1'),
                                        'posts_per_page' => 4,
                                        'offset' => 1,
                                    );
                                    $query2 = new WP_Query($args2);

                                    if ($query2->have_posts()) :
                                        echo  '<div class="row m-0">';
                                        while ($query2->have_posts()) :
                                            $query2->the_post(); ?>
                                            <div class="col-md-12 col-6 p-2 flip-card">
                                                <div class="flip-card-inner bg-theme">
                                                    <div class="flip-card-front post_thumbnail"><?php echo do_shortcode('[ratio-thumbnail size="medium" ratio="4:3"]'); ?></div>
                                                    <div class="flip-card-back p-2">
                                                        <h6 class="my-1 fw-bold"><a class="text-dark" href="<?php echo get_the_permalink(); ?>"><?php echo vdlimit_title(get_the_title(), 5); ?></a></h6>
                                                    </div>
                                                </div>

                                            </div>
                                    <?php
                                        endwhile;
                                        echo '</div>';
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>

                        <h6 class="widget-title d-flex p-2 mt-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                            <?php
                            if (velocitychild_theme_option('home_post_2')) :
                                $category = get_category(velocitychild_theme_option('home_post_2'));
                                $category_title = $category->name;
                                $category_link = get_category_link($category->term_id);
                            else :
                                $category_title = 'RECENT POSTS';
                                $category_link = '#';
                            endif;
                            ?>
                            <span><a class="text-dark" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_title); ?></a></span>
                            <span><a class="text-white ikon-home" href="<?php echo esc_url($category_link); ?>"><?php echo velocitychild_svg_icon('rss'); ?></a></span>
                        </h6>
                        <div class="part-post-home-3 py-2">
                            <div class="row m-0">
                                <div class="col-md-6 p-0 pe-md-1">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => velocitychild_theme_option('home_post_2'),
                                        'posts_per_page' => 1,
                                    );
                                    $query1 = new WP_Query($post2_args);

                                    if ($query1->have_posts()) :
                                        while ($query1->have_posts()) :
                                            $query1->the_post(); ?>
                                            <div class="left-posthome position-relative">
                                                <div class="post_thumbnail"><?php echo do_shortcode('[ratio-thumbnail size="medium" ratio="4:3"]'); ?></div>
                                                <div class="hover-konten bg-theme p-3">
                                                    <h5 class="my-1 fw-bold"><a class="text-dark" href="<?php echo get_the_permalink(); ?>"><?php echo vdlimit_title(get_the_title(), 5); ?></a></h5>
                                                    <div class="konten"><?php echo vdberita_limit_text(strip_tags(get_the_content()), 15); ?></div>
                                                </div>
                                            </div>
                                    <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>
                                <div class="col-md-6 p-0">
                                    <?php
                                    $args2 = array(
                                        'post_type' => 'post',
                                        'cat'       => velocitychild_theme_option('home_post_2'),
                                        'posts_per_page' => 4,
                                        'offset' => 1,
                                    );
                                    echo '<div class="py-2">' . module_vdposts($args2, 'gallery-flip', 'row m-0') . '</div>'; ?>
                                </div>
                            </div>
                        </div>

                        <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                            <?php
                            if (velocitychild_theme_option('home_post_3')) :
                                $category = get_category(velocitychild_theme_option('home_post_3'));
                                $category_title = $category->name;
                                $category_link = get_category_link($category->term_id);
                            else :
                                $category_title = 'RECENT POSTS';
                                $category_link = '#';
                            endif;
                            ?>
                            <span><a class="text-dark" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_title); ?></a></span>
                            <span><a class="text-white ikon-home" href="<?php echo esc_url($category_link); ?>"><?php echo velocitychild_svg_icon('rss'); ?></a></span>
                        </h6>
                        <div class="part-post-home-4 py-2">
                            <div class="row m-0">
                                <div class="col-md-6 p-0 pe-md-1">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => velocitychild_theme_option('home_post_3'),
                                        'posts_per_page' => 1,
                                    );
                                    $query1 = new WP_Query($post2_args);

                                    if ($query1->have_posts()) :
                                        while ($query1->have_posts()) :
                                            $query1->the_post(); ?>
                                            <div class="position-relative">
                                                <div class="post_thumbnail"><?php echo do_shortcode('[ratio-thumbnail size="medium" ratio="8:5"]'); ?></div>
                                                <div class="bg-theme p-3">
                                                    <h5 class="my-1 fw-bold"><a class="text-dark" href="<?php echo get_the_permalink(); ?>"><?php echo vdlimit_title(get_the_title(), 5); ?></a></h5>
                                                    <div class="konten"><?php echo vdberita_limit_text(strip_tags(get_the_content()), 15); ?></div>
                                                </div>
                                            </div>
                                    <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>
                                <div class="col-md-6 py-2">
                                    <?php
                                    $args3 = array(
                                        'post_type' => 'post',
                                        'cat'       => velocitychild_theme_option('home_post_3'),
                                        'posts_per_page' => 4,
                                        'offset' => 1,
                                    );
                                    echo module_vdposts($args3, 'listpost'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- part home 4 & 5 -->
                        <div class="row m-0">
                            <div class="col-md-6 p-0 pe-md-2">
                                <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                                    <?php
                                    if (velocitychild_theme_option('home_post_4')) :
                                        $category = get_category(velocitychild_theme_option('home_post_4'));
                                        $category_title = $category->name;
                                        $category_link = get_category_link($category->term_id);
                                    else :
                                        $category_title = 'RECENT POSTS';
                                        $category_link = '#';
                                    endif;
                                    ?>
                                    <span><a class="text-dark" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_title); ?></a></span>
                                    <span><a class="text-white ikon-home" href="<?php echo esc_url($category_link); ?>"><?php echo velocitychild_svg_icon('rss'); ?></a></span>
                                </h6>
                                <?php
                                $args4 = array(
                                    'post_type' => 'post',
                                    'cat'       => velocitychild_theme_option('home_post_4'),
                                    'posts_per_page' => 6,
                                );
                                echo module_vdposts($args4, 'gallery-flip', 'row m-0'); ?>
                            </div>
                            <div class="col-md-6 p-0 ps-md-2">
                                <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                                    <?php
                                    if (velocitychild_theme_option('home_post_5')) :
                                        $category = get_category(velocitychild_theme_option('home_post_5'));
                                        $category_title = $category->name;
                                        $category_link = get_category_link($category->term_id);
                                    else :
                                        $category_title = 'RECENT POSTS';
                                        $category_link = '#';
                                    endif;
                                    ?>
                                    <span><a class="text-dark" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_title); ?></a></span>
                                    <span><a class="text-white ikon-home" href="<?php echo esc_url($category_link); ?>"><?php echo velocitychild_svg_icon('rss'); ?></a></span>
                                </h6>
                                <?php
                                $args5 = array(
                                    'post_type' => 'post',
                                    'cat'       => velocitychild_theme_option('home_post_5'),
                                    'posts_per_page' => 4,
                                );
                                echo module_vdposts($args5, 'listpost'); ?>
                            </div>
                        </div>

                    </div>
                </main><!-- #main -->
            </div>
            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>
        </div><!-- .row -->

        <div class="row m-0 py-3">
            <div class="col-md-6 p-1">
                <?php echo vdbanner('banner02', 'text-center'); ?>
            </div>
            <div class="col-md-6 p-1">
                <?php echo vdbanner('banner02', 'text-center'); ?>
            </div>
        </div>

        <div class="row m-0">
            <div class="col-md-4 px-1">
                <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                    <?php
                    if (velocitychild_theme_option('home_post_6')) :
                        $category = get_category(velocitychild_theme_option('home_post_6'));
                        $category_title = $category->name;
                        $category_link = get_category_link($category->term_id);
                    else :
                        $category_title = 'RECENT POSTS';
                        $category_link = '#';
                    endif;
                    ?>
                    <span><a class="text-dark" href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a></span>
                </h6>

                <?php
                $args6 = array(
                    'post_type' => 'post',
                    'cat'       => velocitychild_theme_option('home_post_6'),
                    'posts_per_page' => 4,
                );
                echo module_vdposts($args6, 'sliderpost', 'slick-post'); ?>
                <?php echo '<div class="py-2">' . vdbanner('banner04', 'text-center') . '</div>'; ?>
            </div>
            <div class="col-md-4 px-1">
                <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                    <?php
                    if (velocitychild_theme_option('home_post_7')) :
                        $category = get_category(velocitychild_theme_option('home_post_7'));
                        $category_title = $category->name;
                        $category_link = get_category_link($category->term_id);
                    else :
                        $category_title = 'RECENT POSTS';
                        $category_link = '#';
                    endif;
                    ?>
                    <span><a class="text-dark" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_title); ?></a></span>
                    <span><a class="text-white ikon-home" href="<?php echo esc_url($category_link); ?>"><?php echo velocitychild_svg_icon('rss'); ?></a></span>
                </h6>
                <?php
                $args7 = array(
                    'post_type' => 'post',
                    'cat'       => velocitychild_theme_option('home_post_7'),
                    'posts_per_page' => 4,
                );
                echo module_vdposts($args7, 'listpost'); ?>
            </div>
            <div class="col-md-4 px-1">
                <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                    <?php
                    if (velocitychild_theme_option('home_post_8')) :
                        $category = get_category(velocitychild_theme_option('home_post_8'));
                        $category_title = $category->name;
                        $category_link = get_category_link($category->term_id);
                    else :
                        $category_title = 'RECENT POSTS';
                        $category_link = '#';
                    endif;
                    ?>
                    <span><a class="text-dark" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($category_title); ?></a></span>
                    <span><a class="text-white ikon-home" href="<?php echo esc_url($category_link); ?>"><?php echo velocitychild_svg_icon('rss'); ?></a></span>
                </h6>
                <?php
                $args8 = array(
                    'post_type' => 'post',
                    'cat'       => velocitychild_theme_option('home_post_8'),
                    'posts_per_page' => 6,
                );
                echo module_vdposts($args8, 'gallery-flip', 'row m-0'); ?>
            </div>
        </div>
    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
