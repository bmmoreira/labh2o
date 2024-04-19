<?php

get_header();
pageBanner(array(
    'title' =>  __('Archives', 'university-theme'),
    'subtitle' => __('Repository LABH2O', 'university-theme')
));
?>

<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post(); ?>
        <div class="post-item">
            <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>


            <div class="generic-content">
                <?php the_excerpt(); ?>
                <p><a class="btn btn--blue" href="<?php the_permalink(); ?>"><?php _e('Access Collection', 'university-theme'); ?> &raquo;</a>
                </p>
            </div>


        </div>
    <?php }

    echo paginate_links();

    ?>
</div>

<?php

get_footer();

?>