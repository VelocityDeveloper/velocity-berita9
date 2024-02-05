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
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <div class="col-md">

                <main class="site-main col order-2" id="main">

                    <?php
                    $post1_title    = velocitytheme_option('title_posts_home_1', 'Recent Posts');
                    $post1_cat      = velocitytheme_option('cat_posts_home_1');
                    ?>
                    <div class="part_posts_home_1">
                        <h3 class="home-title d-flex align-items-center justify-content-between">
                            <span><?php echo $post1_title; ?></span>
                            <?php if ($post1_cat && $post1_cat !== 'disable') : ?>
                                <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post1_cat); ?>">
                                    <i class="fa fa-rss"></i>
                                </a>
                            <?php endif; ?>
                        </h3>
                        <div class="part-post-home-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    $post1_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post1_cat,
                                        'posts_per_page' => 1,
                                    );
                                    module_vdposts($post1_args, 'posts1');
                                    ?>
                                </div>
                                <div class="col-md">
                                    <?php
                                    $post1_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post1_cat,
                                        'posts_per_page' => 5,
                                        'offset' => 1,
                                    );
                                    module_vdposts($post1_args, 'posts2');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $post2_title    = velocitytheme_option('title_posts_home_2', 'Recent Posts');
                    $post2_cat      = velocitytheme_option('cat_posts_home_2');
                    ?>
                    <div class="part_posts_home_2 py-2">
                        <h3 class="home-title d-flex align-items-center justify-content-between">
                            <span><?php echo $post2_title; ?></span>
                            <?php if ($post2_cat && $post2_cat !== 'disable') : ?>
                                <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post2_cat); ?>">
                                    <i class="fa fa-rss"></i>
                                </a>
                            <?php endif; ?>
                        </h3>
                        <div class="part-post-home-2 pt-2">
                            <?php
                            $post2_args = array(
                                'post_type' => 'post',
                                'cat'       => $post2_cat,
                                'posts_per_page' => 5,
                            ); ?>
                            <div class="part-carousel-home">
                                <?php echo module_vdposts($post2_args, 'carousel'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="part-home-2">
                        <div class="row">
                            <div class="col-md-6">
                                <?php get_berita_iklan('iklan_home_2'); ?>

                                <?php
                                $post3_title    = velocitytheme_option('title_posts_home_3', 'Recent Posts');
                                $post3_cat      = velocitytheme_option('cat_posts_home_3');
                                ?>
                                <div class="part_posts_home_3 bg-muted mt-3 p-1">
                                    <h3 class="home-special-title m-0 p-0 d-flex align-items-center justify-content-between">
                                        <span class="bg-lightening"><?php echo $post3_title; ?></span>
                                        <?php if ($post3_cat && $post3_cat !== 'disable') : ?>
                                            <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post3_cat); ?>">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="part-post-home-3 bg-lightening p-2">
                                        <div class="col-post-first">
                                            <?php
                                            $post3_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post3_cat,
                                                'posts_per_page' => 1,
                                            );
                                            module_vdposts($post3_args, 'posts2');
                                            ?>
                                        </div>
                                        <div class="col-post">
                                            <?php
                                            $post3_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post3_cat,
                                                'posts_per_page' => 5,
                                                'offset' => 1,
                                            );
                                            module_vdposts($post3_args, '');
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $post6_title    = velocitytheme_option('title_posts_home_6', 'Recent Posts');
                                $post6_cat      = velocitytheme_option('cat_posts_home_6');
                                ?>
                                <div class="part_posts_home_6 py-2">
                                    <h3 class="home-title d-flex align-items-center justify-content-between">
                                        <span><?php echo $post6_title; ?></span>
                                        <?php if ($post6_cat && $post6_cat !== 'disable') : ?>
                                            <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post6_cat); ?>">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="part-post-home-6">
                                        <div class="col-posts">
                                            <?php
                                            $post6_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post6_cat,
                                                'posts_per_page' => 5,
                                            );
                                            module_vdposts($post6_args, 'posts3');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="py-2"><?php get_berita_iklan('iklan_home_2'); ?></div>

                            </div>
                            <div class="col-md-6">
                                <?php
                                $post4_title    = velocitytheme_option('title_posts_home_4', 'Recent Posts');
                                $post4_cat      = velocitytheme_option('cat_posts_home_4');
                                ?>
                                <div class="part_posts_home_4">
                                    <h3 class="home-title d-flex m-0 align-items-center justify-content-between">
                                        <span><?php echo $post4_title; ?></span>
                                        <?php if ($post4_cat && $post4_cat !== 'disable') : ?>
                                            <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post4_cat); ?>">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="part-post-home-4">
                                        <div class="col-posts-first">
                                            <?php
                                            $post4_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post4_cat,
                                                'posts_per_page' => 1,
                                            );
                                            module_vdposts($post4_args, 'homespecial');
                                            ?>
                                        </div>
                                        <div class="col-posts">
                                            <?php
                                            $post4_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post4_cat,
                                                'posts_per_page' => 4,
                                                'offset' => 1,
                                            );
                                            module_vdposts($post4_args, 'posts3');
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $post5_title    = velocitytheme_option('title_posts_home_5', 'Recent Posts');
                                $post5_cat      = velocitytheme_option('cat_posts_home_5');
                                ?>
                                <div class="part_posts_home_5">
                                    <h3 class="home-title d-flex align-items-center justify-content-between">
                                        <span><?php echo $post5_title; ?></span>
                                        <?php if ($post5_cat && $post5_cat !== 'disable') : ?>
                                            <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post5_cat); ?>">
                                                <i class="fa fa-rss"></i>
                                            </a>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="part-post-home-5">
                                        <div class="col-posts">
                                            <?php
                                            $post5_args = array(
                                                'post_type' => 'post',
                                                'cat'       => $post5_cat,
                                                'posts_per_page' => 5,
                                            );
                                            module_vdposts($post5_args, 'posts5');
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                </main><!-- #main -->
            </div>
            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>
        </div><!-- .row -->

        <div class="row m-0">
            <div class="col-md-6 px-1 py-2">
                <?php get_berita_iklan('iklan_home_bawah_1'); ?>
            </div>
            <div class="col-md-6 px-1 py-2">
                <?php get_berita_iklan('iklan_home_bawah_2'); ?>
            </div>
        </div>

    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
