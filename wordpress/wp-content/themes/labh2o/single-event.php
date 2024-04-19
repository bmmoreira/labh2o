<?php
get_header();
pageBanner();
while (have_posts()) {
    the_post();
    $eventDate = new DateTime(get_field('event_date'));
?>

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo site_url('/events'); ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php _e('Home - Events', 'university-theme'); ?></a> <span class="metabox__main"><?php _e('Event Date', 'university-theme'); ?>: <?php echo date_i18n('F Y', $eventDate); ?> </span>
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