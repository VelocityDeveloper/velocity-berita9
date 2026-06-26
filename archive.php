<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card shadow-sm bg-light pt-2 px-3 mb-3">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row m-0">
            <?php echo left_sidebar(); ?>
            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2 px-0" id="main">

                <?php

                if (have_posts()) {
                ?>
                    <header class="page-header block-primary">
                        <?php
                        the_archive_title('<h1 class="page-title text-uppercase">', '</h1>');
                        the_archive_description('<div class="taxonomy-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->
                    <?php
                    // Start the loop.
                    $postcount = 1;
                    while (have_posts()) {
                        the_post();
                    ?>
                        <article class="block-primary mb-4">
                            <?php if ($postcount === 1) : ?>
                                <div class="post-thumbnail position-relative border border-4">
                                    <?php echo vdberita_post_thumbnail(array('size' => 'large', 'ratio' => 'ratio-21x9')); ?>
                                </div>
                                <div class="pt-2">
                                    <?php
                                    the_title(
                                        sprintf('<h2 class="h5 fw-bold"><a href="%s" class="text-primary" rel="bookmark">', esc_url(get_permalink())),
                                        '</a></h2>'
                                    );
                                    ?>
                                </div>
                                <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
                            <?php else : ?>
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="post-thumbnail position-relative border border-4">
                                            <?php echo vdberita_post_thumbnail(array('size' => 'medium', 'ratio' => 'ratio-4x3')); ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="post-text">
                                            <?php
                                            the_title(
                                                sprintf('<h2 class="h6 mb-md-3 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                                '</a></h2>'
                                            );
                                            ?>
                                            <div class="post-excerpt text-muted">
                                                <div class="d-none d-md-block">
                                                    <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
                                                </div>
                                                <div class="d-md-none">
                                                    <small>
                                                        <?php echo vdberita_limit_text(strip_tags(get_the_content()), 8); ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="d-flex mt-2 justify-content-between align-items-center py-1 px-2 border-bottom border-top text-muted bg-light mb-3">
                                <div>
                                    <small>
                                        Posted by : <?php echo get_the_author(); ?>
                                    </small>
                                    <small class="ms-2">
                                        <?php echo get_the_date(); ?>
                                    </small>
                                    <?php $gettags = get_the_tags(get_the_ID()); ?>
                                    <?php if ($gettags) : ?>
                                        <small class="ms-2">
                                            Tags :
                                            <?php foreach ($gettags as $index => $tag) : ?>
                                                <?php echo $index === 0 ? '' : ','; ?>
                                                <a href="<?php echo get_tag_link($tag->term_id); ?>"> <?php echo $tag->name; ?> </a>
                                                <?php if ($index > 1) {
                                                    break;
                                                } ?>
                                            <?php endforeach; ?>
                                        </small>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </article>

                <?php

                        if ($postcount == 1) :
                            echo '<div class="mb-3">';
                            get_berita_iklan('iklan_archive');
                            echo '</div>';
                        endif;
                        if ($postcount == 8) :
                            echo '<div class="mb-3">';
                            get_berita_iklan('iklan_archive_2');
                            echo '</div>';
                        endif;

                        $postcount++;
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
                <!-- Display the pagination component. -->
                <?php justg_pagination(); ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
