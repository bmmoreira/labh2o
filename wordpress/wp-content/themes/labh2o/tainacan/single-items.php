<?php
get_header();
pageBanner();
while (have_posts()) {
    the_post(); ?>

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo tainacan_get_the_collection_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php _e('Go to Repository Home', 'university-theme'); ?></a> <span class="metabox__main"> <?php echo tainacan_get_the_collection_name(); ?></span>
            </p>
        </div>
        <div class="generic-content">

            <?php the_content(); ?>
        </div>

    </div>
<?php
}
get_footer();

?>