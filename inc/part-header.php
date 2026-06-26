<div class="header-menu bg-dark">
    <div class="container">
        <div class="row m-0 align-items-center">
            <div class="col-md-9 col-3 p-0">
                <div class="d-none d-md-block secondary-menuset">
                    <nav id="main-nav-secondary" class="navbar navbar-expand-md navbar-light p-md-0 p-2" aria-labelledby="main-nav-label-secondary">
                        <h2 id="main-nav-label-secondary" class="screen-reader-text">
                            <?php esc_html_e('Secondary Navigation', 'justg'); ?>
                        </h2>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'secondary',
                                'container'       => false,
                                'menu_class'      => 'navbar-nav justify-content-start text-uppercase flex-grow-1 pe-3',
                                'fallback_cb'     => '',
                                'menu_id'         => 'secondary-menu-desktop',
                                'depth'           => 4,
                                'walker'          => velocitychild_nav_walker(),
                            )
                        );
                        ?>
                    </nav>
                </div>

                <div class="d-flex d-md-none align-items-center gap-2 py-2 px-1">
                    <button class="btn btn-link secondary-menu-toggler p-0 text-white shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#secondaryNavOffcanvas" aria-controls="secondaryNavOffcanvas" aria-label="<?php esc_attr_e('Toggle secondary navigation', 'justg'); ?>">
                        <?php echo velocitychild_svg_icon('list'); ?>
                    </button>
                </div>
            </div>
            <div class="col-md-3 col-9 p-0">
                <?php echo do_shortcode('[vdcari]'); ?>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-start secondary-nav-offcanvas" tabindex="-1" id="secondaryNavOffcanvas" aria-labelledby="secondaryNavOffcanvasLabel">
    <div class="offcanvas-header justify-content-between align-items-center">
        <h5 class="offcanvas-title mb-0" id="secondaryNavOffcanvasLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-dark text-reset" data-bs-dismiss="offcanvas" aria-label="<?php esc_attr_e('Close', 'justg'); ?>"></button>
    </div>
    <div class="offcanvas-body">
        <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'secondary',
                'container'       => false,
                'menu_class'      => 'navbar-nav flex-column secondary-offcanvas-menu gap-1',
                'fallback_cb'     => '',
                'menu_id'         => 'secondary-menu-mobile',
                'depth'           => 4,
                'walker'          => velocitychild_nav_walker(),
            )
        );
        ?>
    </div>
</div>

<div class="container wrappborder bg-white">
    <div class="row m-0 py-2 align-items-center">
        <div class="col-md-4 px-1 text-start">
            <?php
            $sitelogo = velocitychild_theme_option('custom_logo');
            if ($sitelogo) : ?>
                <a href="<?php echo esc_url(get_home_url()); ?>">
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($sitelogo, 'full')); ?>" alt="Site Logo" loading="lazy">
                </a>
            <?php endif; ?>
        </div>
        <div class="col-md-8 px-1 text-end">
            <?php $bannerheader = get_theme_mod('banner_header', ''); ?>
            <?php if ($bannerheader) : ?>
                <img src="<?php echo esc_url($bannerheader); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" loading="lazy" />
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container wrappborder bg-theme px-md-0">
    <div class="d-none d-md-block primary-menuset">
        <nav id="main-navi-desktop" class="navbar navbar-expand-md navbar-dark p-0" aria-labelledby="main-nav-label-desktop">
            <h2 id="main-nav-label-desktop" class="screen-reader-text">
                <?php esc_html_e('Main Navigation', 'justg'); ?>
            </h2>
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'primary',
                    'container'       => false,
                    'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 primary-desktop-menu',
                    'fallback_cb'     => '',
                    'menu_id'         => 'primary-menu-desktop',
                    'depth'           => 4,
                    'walker'          => velocitychild_nav_walker(),
                )
            );
            ?>
        </nav>
    </div>

    <nav id="main-navi" class="navbar navbar-expand-md d-block navbar-light bg-theme p-0" aria-labelledby="main-nav-label">
        <h2 id="main-nav-label" class="screen-reader-text">
            <?php esc_html_e('Main Navigation', 'justg'); ?>
        </h2>

        <div class="menu-header text-start d-md-none position-relative" data-bs-theme="dark">
            <button class="navbar-toggler text-dark p-1 rounded-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="menu-styles bg-theme d-md-none">
            <div class="pb-0">
                <div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="navbarNavOffcanvas" aria-labelledby="main-nav-label">
                    <div class="offcanvas-header justify-content-end">
                        <button type="button" class="btn-close btn-close-dark text-reset" data-bs-dismiss="offcanvas" aria-label="<?php esc_attr_e('Close', 'justg'); ?>"></button>
                    </div>

                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container'       => false,
                            'menu_class'      => 'navbar-nav navbar-light justify-content-md-start justify-content-start flex-md-wrap flex-grow-1 primary-offcanvas-menu',
                            'fallback_cb'     => '',
                            'menu_id'         => 'primary-menu',
                            'depth'           => 4,
                            'walker'          => velocitychild_nav_walker(),
                        )
                    );
                    ?>
                </div>
            </div>
        </div>
    </nav>
</div>
