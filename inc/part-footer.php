<footer class="site-footer container bg-white p-0" id="colophon">
    <div class="row wrappborder footer-widget text-start mx-auto px-2 pt-4">
        <?php for ($x = 1; $x <= 4; $x++) { ?>
            <?php if (is_active_sidebar('footer-widget-' . $x)) { ?>
                <div class="col-md">
                    <?php dynamic_sidebar('footer-widget-' . $x); ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="container wrappborder border-bottom bg-pattern p-3">
        <div class="row align-items-center text-white">
            <div class="col-md-6">
                <div class="site-info small text-white">
                        © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
                        <div class="opacity-50">
                        Design by <a class="text-white" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
                        </div>
                </div>
                <!-- .site-info -->
            </div>
            <div class="col-md-6 text-md-end pt-2 pt-md-0">
                <?php
                $sosmed = ['facebook', 'twitter', 'instagram', 'youtube', 'tiktok'];
                foreach ($sosmed as $key) {
                    $datalink  = velocitychild_theme_option('link_sosmed_' . $key);
                    if ($key == 'twitter') {
                        echo '<a class="border-light btn btn-sm btn-dark ms-1" href="' . $datalink . '" target="_blank">';
                        echo velocitychild_svg_icon('twitter');
                        echo '</a>';
                    } else if ($key == 'tiktok') {
                        echo '<a class="border-light btn btn-sm btn-dark ms-1" href="' . $datalink . '" target="_blank">';
                        echo velocitychild_svg_icon('tiktok');
                        echo '</a>';
                    } else {
                        echo '<a class="btn btn-sm btn-secondary btn-' . esc_attr($key) . ' ms-1" href="' . esc_url($datalink) . '" target="_blank">';
                        echo velocitychild_svg_icon($key);
                        echo '</a>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

</footer>
