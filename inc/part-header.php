<div class="header-menu bg-dark">
    <div class="container">
        <div class="row m-0">
            <div class="col-md-9 col-12 p-0 d-none d-md-inline-block">
                <div class="container p-0 secondary-menuset">
                    <nav id="main-nav" class="navbar navbar-expand-md navbar-light p-md-0 p-2" aria-labelledby="main-nav-label">
                        <div class="menu-second">
                            <div class="nocanvas">
                                <!-- The WordPress Menu goes here -->
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location'  => 'secondary',
                                        'container_class' => 'nocanvas-body',
                                        'container_id'    => '',
                                        'menu_class'      => 'navbar-nav justify-content-end text-uppercase flex-grow-1 pe-3',
                                        'fallback_cb'     => '',
                                        'menu_id'         => 'secondary-menu',
                                        'depth'           => 4,
                                        'walker'          => new justg_WP_Bootstrap_Navwalker(),
                                    )
                                );
                                ?>
                            </div><!-- .offcanvas -->
                        </div><!-- .menu-second -->
                    </nav><!-- .site-navigation -->
                </div><!-- .secondary-menuset -->
            </div>
            <div class="col-md-3 col-12 p-0">
                <?php echo do_shortcode('[vdcari]'); ?>
            </div>
        </div>
    </div>
</div>

<div class="container wrappborder bg-white">
    <div class="row m-0 py-2 align-items-center">
        <div class="col-md-4 px-1 text-start">
            <?php
            $sitelogo = velocitytheme_option('custom_logo');
            if ($sitelogo) : ?>
                <a href="<?php echo get_home_url(); ?>">
                    <img src="<?php echo wp_get_attachment_image_url($sitelogo, 'full'); ?>" alt="Site Logo" loading="lazy">
                </a>
            <?php endif;  ?>
        </div>
        <div class="col-md-8 px-1 text-end">
            <?php $bannerheader = get_theme_mod('banner_header', ''); ?>
            <img src="<?= $bannerheader; ?>" />
        </div>
    </div>
</div>

<div class="container wrappborder bg-theme">
    <nav id="main-navi" class="navbar navbar-expand-md d-block navbar-light  bg-theme p-0" aria-labelledby="main-nav-label">

        <div class="menu-header text-start d-md-none position-relative" data-bs-theme="dark">

            <button class="navbar-toggler text-dark p-1 rounded-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>

        <div class="menu-styles bg-theme">
            <div class="pb-0">

                <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNavOffcanvas">

                    <div class="offcanvas-header justify-content-end">
                        <button type="button" class="btn-close btn-close-dark text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div><!-- .offcancas-header -->

                    <!-- The WordPress Menu goes here -->
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container_class' => 'offcanvas-body',
                            'container_id'    => '',
                            'menu_class'      => 'navbar-nav navbar-light justify-content-md-start justify-content-start flex-md-wrap flex-grow-1',
                            'fallback_cb'     => '',
                            'menu_id'         => 'primary-menu',
                            'depth'           => 4,
                            'walker'          => new justg_WP_Bootstrap_Navwalker(),
                        )
                    ); ?>

                </div><!-- .offcanvas -->
            </div>

    </nav><!-- .site-navigation -->
</div>