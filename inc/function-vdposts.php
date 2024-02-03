<?php
// stye = listpost,gallery-flip, sliderpost
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
                                <div class="relate-thumb ratio ratio-1x1">
                                    <?php
                                    if (has_post_thumbnail()) :
                                        $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                        echo '<img class="rounded rounded-2" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" />';
                                    else :
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g></svg>';
                                    endif;
                                    ?>
                                </div>
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
