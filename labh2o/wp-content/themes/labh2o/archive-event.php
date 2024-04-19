<?php

get_header();
pageBanner(array(
    'title' => __('All Events', 'university-theme'),
    'subtitle' => __('Laboratory of Water Resources and Environmental Studies', 'university-theme')
));

?>



<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post();
        get_template_part('template-parts/content-event');
    }

    echo paginate_links();

    ?>
    <hr class="section-break">
    <p> <?php _e('Past Events', 'university-theme'); ?>? <a href="<?php echo site_url('/past-events') ?>"><?php _e('Click Here', 'university-theme'); ?></a></p>

</div>

<?php

get_footer();

?>