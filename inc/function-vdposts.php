<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('module_vdposts')) {
    function module_vdposts($args = null, $style = null)
    {

    if (isset($args['sortby'])) {
        if ($args['sortby'] === 'popular') {
            $args['orderby'] = 'comment_count';
            $args['order']   = 'DESC';
        }
        unset($args['sortby']);
    }

    // The Query
    $the_query = new WP_Query($args);

    // The Loop
    if ($the_query->have_posts()) {
        echo '<div class="module-vdposts module-vdposts-' . $style . '">';
        while ($the_query->have_posts()) {
            $the_query->the_post();

            switch ($style) {
                case 'posts1':
?>
                    <div class="posts-item pb-1 mb-2">
                        <?php echo vdberita_post_thumbnail(array('size' => 'medium', 'ratio' => 'ratio-16x9', 'wrapper_class' => 'bg-light border border-4 mb-2 overflow-hidden')); ?>
                        <div class="post-text">
                            <h6><a class="fw-bold mb-2 d-block" href="<?php echo get_the_permalink(); ?>">
                                    <?php echo get_the_title(); ?>
                                </a></h6>
                            <div class="post-excerpt mb-2 text-muted">
                                <small>
                                    <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
                                </small>
                            </div>
                            <div class="py-1 px-2 border-bottom border-top text-muted bg-light">
                                <small> <?php echo get_the_date(); ?> </small>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts2':

                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="row">
                            <div class="col-4 col-md-3">
                                <?php echo vdberita_post_thumbnail(array('size' => 'thumbnail', 'ratio' => 'ratio-1x1', 'wrapper_class' => 'bg-light border border-4 overflow-hidden')); ?>
                            </div>
                            <div class="col-8 col-md-9 ps-0">
                                <div class="post-date">
                                    <small> <?php echo get_the_date(); ?> </small>
                                </div>
                                <h6>
                                    <a class="fw-bold" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                        <?php echo vdberita_limit_text(get_the_title(), 8); ?>
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'carousel':
                ?>
                    <div class="carousel-post-item px-1">
                        <div class="shadow-sm bg-light">
                            <div class="row m-0">
                                <div class="col-4 px-1">
                                    <?php echo vdberita_post_thumbnail(array('size' => 'thumbnail', 'ratio' => 'ratio-1x1', 'wrapper_class' => 'bg-light overflow-hidden', 'flickity_lazy' => true)); ?>
                                </div>
                                <div class="col px-1">
                                    <div class="post-date">
                                        <small> <?php echo get_the_date(); ?> </small>
                                    </div>
                                    <h6>
                                        <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                            <?php echo vdberita_limit_text(get_the_title(), 5); ?>
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts3':
                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="row">
                            <div class="col-4">
                                <?php echo vdberita_post_thumbnail(array('size' => 'thumbnail', 'ratio' => 'ratio-1x1', 'wrapper_class' => 'bg-light border border-4 overflow-hidden')); ?>
                            </div>
                            <div class="col-8 ps-0">
                                <div class="post-date">
                                    <small> <?php echo get_the_date(); ?> </small>
                                </div>
                                <h6>
                                    <a class="fw-bold" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                        <?php echo vdberita_limit_text(get_the_title(), 8); ?>
                                    </a>
                                </h6>
                                <div class="post-excerpt text-muted">
                                    <small>
                                        <?php echo vdberita_limit_text(strip_tags(get_the_content()), 5); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts4':
                    echo '<a class="d-flex w-100 border-bottom pb-1 mb-1" href="' . get_the_permalink() . '">';
                    echo vdberita_get_icon('file-text', 'bi mt-1 me-2 flex-shrink-0');
                    echo '<span>' . get_the_title() . '</span>';
                    echo '</a>';
                ?>
                <?php
                    break;
                case 'posts5':
                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="post-date">
                            <small> <?php echo get_the_date(); ?> </small>
                        </div>
                        <h6>
                            <a class="fw-bold" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                <?php echo vdberita_limit_text(get_the_title(), 9); ?>
                            </a>
                        </h6>
                    </div>
                <?php
                    break;
                case 'homespecial':
                ?>
                    <div class="posts-item home-special p-2 shadow mb-2 position-relative">
                        <?php echo vdberita_post_thumbnail(array('size' => 'medium', 'ratio' => 'ratio-16x9', 'wrapper_class' => 'bg-light mb-2 overflow-hidden', 'link_class' => 'd-block text-white')); ?>
                        <div class="post-text text-white">
                            <div class="py-2 px-1 text-white">
                                <small> <?php echo get_the_date(); ?> </small>
                            </div>
                            <h6>
                                <a class="fw-bold text-white d-block h6" href="<?php echo get_the_permalink(); ?>">
                                    <?php echo get_the_title(); ?>
                                </a>
                            </h6>
                            <div class="konten">
                                <small>
                                    <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
                                </small>
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
        }
        echo '</div>';
    }
    /* Restore original Post Data */
    wp_reset_postdata();
    }
}
