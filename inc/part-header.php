<div class="container first-head-part bg-gradients">
    <div class="row m-0 align-items-center">
        <div class="col-9 p-0 d-flex align-items-center justify-content-md-between">
            <nav id="main-nav" class="navbar navbar-expand-md d-block navbar-light p-0" aria-labelledby="main-nav-label">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarsecondarymenu" aria-controls="navbarsecondarymenu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="secondary-menu position-relative">
                    <div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="navbarsecondarymenu">

                        <div class="offcanvas-header justify-content-end">
                            <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div><!-- .offcancas-header -->
                        <!-- The WordPress Menu goes here -->
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'secondary',
                                'container_class' => 'secondary-menu-body',
                                'container_id'    => '',
                                'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 px-2',
                                'fallback_cb'     => '',
                                'menu_id'         => 'secondary-menu',
                                'depth'           => 1,
                                'walker'          => new justg_WP_Bootstrap_Navwalker(),
                            )
                        );
                        ?>
                    </div><!-- .offcanvas -->
                </div>
            </nav>

            <div class="datenow text-end text-md-start">
                <small class="text-danger fw-bold px-2 py-1 d-inline-block position-relative">
                    <?php echo date('l jS F Y', current_time('timestamp', 0)); ?>
                </small>
            </div>
        </div>
        <div class="col-md-3 p-0">
            <div class="search-header float-end">
                <form action="" method="get" id="search" class="d-flex overflow-hidden">
                    <input type="text" name="s" placeholder="Search" class="form-control-sm bg-transparent border-0 rounded-0">
                    <button type="submit" class="btn btn-link text-secondary py-1 px-2">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="head-part-top bg-light">
    <div class="row m-0 py-2 align-items-center">
        <div class="col-md-3">
            <div class="text-center p-1">
                <?php echo the_custom_logo(); ?>
            </div>
        </div>
        <div class="col-md">
            <?php echo get_berita_iklan('iklan_header'); ?>
        </div>
    </div>
</div>

<div class="velocity-navbar">
    <nav id="main-nav" class="navbar navbar-expand-md d-block bg-color-theme navbar-dark shadow-sm p-0" aria-labelledby="main-nav-label">

        <h2 id="main-nav-label" class="screen-reader-text">
            <?php esc_html_e('Main Navigation', 'justg'); ?>
        </h2>


        <div class="head-part-menu navbar-dark">
            <div class="menu-header">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                    <span class="navbar-toggler-icon"></span>
                    <small>Menu</small>
                </button>

                <div class="offcanvas offcanvas-start bg-color-theme" tabindex="-1" id="navbarNavOffcanvas">

                    <div class="offcanvas-header justify-content-end">
                        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div><!-- .offcancas-header -->

                    <!-- The WordPress Menu goes here -->
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container_class' => 'offcanvas-body',
                            'container_id'    => '',
                            'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 pe-3',
                            'fallback_cb'     => '',
                            'menu_id'         => 'main-menu',
                            'depth'           => 4,
                            'walker'          => new justg_WP_Bootstrap_Navwalker(),
                        )
                    );
                    ?>
                </div><!-- .offcanvas -->
            </div>
        </div>

    </nav><!-- .site-navigation -->
</div>