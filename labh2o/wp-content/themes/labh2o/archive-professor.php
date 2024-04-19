<?php

get_header();
pageBanner(array(
    'title' => __('All Professors', 'university-theme'),
    'subtitle' => __('Water Resources and Environment Laboratory', 'university-theme'),
    'photo' => get_theme_file_uri('/images/about_labh2o.png')
));


$professors = new WP_Query(
    array(
        'posts_per_page' => 10,
        'post_type' => 'professor',
        'meta_key' => 'affiliate_category',
        'meta_query' => array(
            array(
                'key' => 'affiliate_category',
                'compare' => '=',
                'value' => 'pr',
            )
        )
    )
);

?>


<div class="container container--narrow page-section">
    <?php
    while ($professors->have_posts()) {
        $professors->the_post();
        get_template_part('template-parts/content-professor-list');
    }

    echo paginate_links();

    ?>
    <hr class="section-break">
    <p> <?php _e('Check out our Ex-Professors', 'university-theme'); ?> <a href="<?php echo site_url('/ex-professors') ?>"><?php _e('Here', 'university-theme'); ?></a></p>

</div>

<?php

get_footer();

?>