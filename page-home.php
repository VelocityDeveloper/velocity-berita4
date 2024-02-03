<?php

/**
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

$container = velocitytheme_option('justg_container_type', 'container');
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
                            <a class="d-block position-relative" href="<?php echo get_the_permalink(); ?>">

                                <div class="ratio ratio-21x9 bg-light overflow-hidden">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                        echo '<img class="w-100" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" loading="lazy">';
                                    } else {
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                                    } ?>
                                </div>

                                <div class="carousel-caption text-md-start text-center">
                                    <span class="bg-dark d-inline-block p-2" style="--bs-bg-opacity: 0.90;">
                                        <?php echo get_the_title(); ?>
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
                            if (velocitytheme_option('home_post_1')) :
                                $category = get_category(velocitytheme_option('home_post_1'));
                                $category_title = $category->name;
                                $category_link = get_category_link($category->term_id);
                            else :
                                $category_title = 'RECENT POSTS';
                                $category_link = '#';
                            endif;
                            ?>
                            <span><a class="text-dark" href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a></span>
                            <span><a class="text-white ikon-home" href="<?php echo $category_link; ?>"><i class="fa fa-rss"></i></a></span>
                        </h6>

                        <div class="part-post-home-2 py-2">
                            <div class="row m-0">
                                <div class="col-md-9 p-0 pe-md-1">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => velocitytheme_option('home_post_1'),
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
                                        'cat'       => velocitytheme_option('home_post_1'),
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
                            if (velocitytheme_option('home_post_2')) :
                                $category = get_category(velocitytheme_option('home_post_2'));
                                $category_title = $category->name;
                                $category_link = get_category_link($category->term_id);
                            else :
                                $category_title = 'RECENT POSTS';
                                $category_link = '#';
                            endif;
                            ?>
                            <span><a class="text-dark" href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a></span>
                            <span><a class="text-white ikon-home" href="<?php echo $category_link; ?>"><i class="fa fa-rss"></i></a></span>
                        </h6>
                        <div class="part-post-home-3 py-2">
                            <div class="row m-0">
                                <div class="col-md-6 p-0 pe-md-1">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => velocitytheme_option('home_post_2'),
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
                                        'cat'       => velocitytheme_option('home_post_2'),
                                        'posts_per_page' => 4,
                                        'offset' => 1,
                                    );
                                    echo '<div class="py-2">' . module_vdposts($args2, 'gallery-flip', 'row m-0') . '</div>'; ?>
                                </div>
                            </div>
                        </div>

                        <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                            <?php
                            if (velocitytheme_option('home_post_3')) :
                                $category = get_category(velocitytheme_option('home_post_3'));
                                $category_title = $category->name;
                                $category_link = get_category_link($category->term_id);
                            else :
                                $category_title = 'RECENT POSTS';
                                $category_link = '#';
                            endif;
                            ?>
                            <span><a class="text-dark" href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a></span>
                            <span><a class="text-white ikon-home" href="<?php echo $category_link; ?>"><i class="fa fa-rss"></i></a></span>
                        </h6>
                        <div class="part-post-home-4 py-2">
                            <div class="row m-0">
                                <div class="col-md-6 p-0 pe-md-1">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => velocitytheme_option('home_post_3'),
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
                                        'cat'       => velocitytheme_option('home_post_3'),
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
                                    if (velocitytheme_option('home_post_4')) :
                                        $category = get_category(velocitytheme_option('home_post_4'));
                                        $category_title = $category->name;
                                        $category_link = get_category_link($category->term_id);
                                    else :
                                        $category_title = 'RECENT POSTS';
                                        $category_link = '#';
                                    endif;
                                    ?>
                                    <span><a class="text-dark" href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a></span>
                                    <span><a class="text-white ikon-home" href="<?php echo $category_link; ?>"><i class="fa fa-rss"></i></a></span>
                                </h6>
                                <?php
                                $args4 = array(
                                    'post_type' => 'post',
                                    'cat'       => velocitytheme_option('home_post_4'),
                                    'posts_per_page' => 6,
                                );
                                echo module_vdposts($args4, 'gallery-flip', 'row m-0'); ?>
                            </div>
                            <div class="col-md-6 p-0 ps-md-2">
                                <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                                    <?php
                                    if (velocitytheme_option('home_post_5')) :
                                        $category = get_category(velocitytheme_option('home_post_5'));
                                        $category_title = $category->name;
                                        $category_link = get_category_link($category->term_id);
                                    else :
                                        $category_title = 'RECENT POSTS';
                                        $category_link = '#';
                                    endif;
                                    ?>
                                    <span><a class="text-dark" href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a></span>
                                    <span><a class="text-white ikon-home" href="<?php echo $category_link; ?>"><i class="fa fa-rss"></i></a></span>
                                </h6>
                                <?php
                                $args5 = array(
                                    'post_type' => 'post',
                                    'cat'       => velocitytheme_option('home_post_5'),
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
                    if (velocitytheme_option('home_post_6')) :
                        $category = get_category(velocitytheme_option('home_post_6'));
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
                    'cat'       => velocitytheme_option('home_post_6'),
                    'posts_per_page' => 4,
                );
                echo module_vdposts($args6, 'sliderpost', 'slick-post'); ?>
                <?php echo '<div class="py-2">' . vdbanner('banner04', 'text-center') . '</div>'; ?>
            </div>
            <div class="col-md-4 px-1">
                <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                    <?php
                    if (velocitytheme_option('home_post_7')) :
                        $category = get_category(velocitytheme_option('home_post_7'));
                        $category_title = $category->name;
                        $category_link = get_category_link($category->term_id);
                    else :
                        $category_title = 'RECENT POSTS';
                        $category_link = '#';
                    endif;
                    ?>
                    <span><a class="text-dark" href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a></span>
                    <span><a class="text-white ikon-home" href="<?php echo $category_link; ?>"><i class="fa fa-rss"></i></a></span>
                </h6>
                <?php
                $args7 = array(
                    'post_type' => 'post',
                    'cat'       => velocitytheme_option('home_post_7'),
                    'posts_per_page' => 4,
                );
                echo module_vdposts($args7, 'listpost'); ?>
            </div>
            <div class="col-md-4 px-1">
                <h6 class="widget-title d-flex p-2 fw-bold text-uppercase bg-theme rounded-0 align-items-center justify-content-between">
                    <?php
                    if (velocitytheme_option('home_post_8')) :
                        $category = get_category(velocitytheme_option('home_post_8'));
                        $category_title = $category->name;
                        $category_link = get_category_link($category->term_id);
                    else :
                        $category_title = 'RECENT POSTS';
                        $category_link = '#';
                    endif;
                    ?>
                    <span><a class="text-dark" href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a></span>
                    <span><a class="text-white ikon-home" href="<?php echo $category_link; ?>"><i class="fa fa-rss"></i></a></span>
                </h6>
                <?php
                $args8 = array(
                    'post_type' => 'post',
                    'cat'       => velocitytheme_option('home_post_8'),
                    'posts_per_page' => 6,
                );
                echo module_vdposts($args8, 'gallery-flip', 'row m-0'); ?>
            </div>
        </div>
    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
