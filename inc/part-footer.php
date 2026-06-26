<footer class="site-footer container bg-dark text-white py-2 px-3" id="colophon">
    <div class="row align-items-center text-center">
        <div class="col-md-6 order-md-1 order-2 text-md-start">
            <div class="site-info small text-white">
                © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
                <div class="opacity-50">
                Design by <a class="text-white" href="https://velocitydeveloper.com/" target="_blank" rel="noopener noreferrer">Velocity Developer</a>.
                </div>
            </div>
            <!-- .site-info -->
        </div>
        <div class="col-md-6 text-md-end pt-2 pt-md-0 order-md-2 order-1 mb-2 mb-md-0">
            <?php
            $sosmed = ['facebook', 'twitter', 'instagram', 'youtube'];
            foreach ($sosmed as $key) {
                $datalink  = velocitytheme_option('link_sosmed_' . $key);
                if ($datalink) {
                    echo '<a class="btn btn-sm btn-secondary ms-1" href="' . esc_url($datalink) . '" target="_blank" rel="noopener noreferrer">' . vdberita_get_icon($key, 'bi', ucfirst($key)) . '</a>';
                }
            }
            ?>
            <a class="btn btn-sm btn-secondary" href="<?php echo esc_url(get_feed_link()); ?>" target="_blank" rel="noopener noreferrer"><?php echo vdberita_get_icon('rss', 'bi', 'RSS'); ?></a>
        </div>
    </div>
</footer>
