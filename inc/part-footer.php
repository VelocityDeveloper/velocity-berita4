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

    <div class="container wrappborder border-bottom bg-pattern">
        <div class="row align-items-center text-white py-2">
            <div class="col-md-6">
                <div class="site-info">
                    <small>
                        © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
                        <br>
                        Design by <a class="text-secondary" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
                    </small>
                </div>
                <!-- .site-info -->
            </div>
            <div class="col-md-6 text-md-end pt-2 pt-md-0">
                <?php
                $sosmed = ['facebook', 'twitter', 'instagram', 'youtube', 'tiktok'];
                foreach ($sosmed as $key) {
                    $datalink  = velocitytheme_option('link_sosmed_' . $key);
                    if ($key != 'twitter' && $key != 'tiktok') {
                        echo '<a class="border-0 btn btn-sm btn-secondary btn-' . $key . ' ms-1" href="' . $datalink . '" target="_blank"><i class="fa fa-' . $key . '"></i></a>';
                    } else if ($key == 'twitter') {
                        echo '<a class="border-0 btn btn-sm btn-dark ms-1" href="' . $datalink . '" target="_blank">';
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16"><path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/></svg>';
                        echo '</a>';
                    } else if ($key == 'tiktok') {
                        echo '<a class="border-0 btn btn-sm btn-dark ms-1" href="' . $datalink . '" target="_blank">';
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16"><path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/></svg>';
                        echo '</a>';
                    }
                }
                ?>
            </div>
        </div>
    </div>

</footer>