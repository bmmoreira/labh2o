<?php
get_header();

// php logic will live here
if (!isset($args['title'])) {
    $args['title'] = get_the_title();
}
if (!isset($args['subtitle'])) {
    $args['subtitle'] = get_field('page_banner_subtitle');
}
if (!isset($args['photo'])) {
    if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
        $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
        $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
}

?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo  $args['photo']; ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <h3 class="page-banner__title-small">MapHidro</h3>
        <div class="page-banner__intro">
            <p><?php echo $args['subtitle']; ?></p>
        </div>
    </div>
</div>
<?php



while (have_posts()) {
    the_post(); ?>

    <?php the_content(); ?>


<?php
}
get_footer();

?>