<?php
// stye = listpost,gallery-flip, sliderpost
if (!function_exists('module_vdposts')) {
    function module_vdposts($args = null, $style = null, $class = null)
    {
    // The Query
    $the_query = new WP_Query($args);

    // The Loop
    if ($the_query->have_posts()) :
        echo '<div class="module-vdposts module-vdposts-' . $style . '">';
        echo '<div class="' . $class . '">';
        while ($the_query->have_posts()) :
            $the_query->the_post();

            switch ($style) {
                case 'listpost': ?>
                    <div class="row m-0 mb-2">
                        <div class="col-4 p-0"><?= do_shortcode('[ratio-thumbnail size="medium" ratio="4:3"]'); ?></div>
                        <div class="col-8 p-0 ps-2">
                            <div class="related-post-title fw-bold"><a href="<?= get_the_permalink(); ?>"><?= vdlimit_title(get_the_title(), 5); ?></a></div>
                            <small class="text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                </svg> <?= get_the_date('F j, Y'); ?>
                            </small>
                        </div>
                        <hr class="my-2 hr-dotted">
                    </div>
                <?php
                    break;
                case 'sliderpost':
                ?>
                    <div class="posts-items bg-muted p-2">
                        <div class="row m-0 align-items-center">
                            <div class="col-3 p-0">
                                <?php echo velocitychild_get_thumbnail_markup(get_the_ID(), 1, 1, 'rounded rounded-2'); ?>
                            </div>
                            <div class="col-9 p-0 ps-2">
                                <span class="fw-bold"><a href="<?php echo get_the_permalink(); ?>"><?php echo vdlimit_title(get_the_title(), 6); ?></a></span>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'gallery-flip':
                ?>
                    <div class="col-6 p-2 mb-1 flip-card">
                        <div class="flip-card-inner bg-theme">
                            <div class="flip-card-front post_thumbnail"><?php echo do_shortcode('[ratio-thumbnail size="medium" ratio="1:1"]'); ?></div>
                            <div class="flip-card-back p-2">
                                <h6 class="my-1 fw-bold"><a class="text-dark" href="<?php echo get_the_permalink(); ?>"><?php echo vdlimit_title(get_the_title(), 5); ?></a></h6>
                            </div>
                        </div>
                    </div>
<?php
                    break;
                default:
                    echo '<div class="posts-item border-bottom pb-1 mb-2">';
                    echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
                    echo '</div>';
                    break;
            }
        endwhile;
        echo '</div>';
        echo '</div>';
    endif;
    /* Restore original Post Data */
    wp_reset_postdata();
    }
}
