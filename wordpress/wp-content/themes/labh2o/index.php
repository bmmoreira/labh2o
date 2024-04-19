<?php

get_header();
pageBanner(array(
    'title' => __('Welcome to News Section!', 'university-theme'),
    'subtitle' => __('Keep up to date!', 'university-theme')
));
?>

<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post(); ?>
        <div class="post-item">
            <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
            <div class="metabox">
                <p><?php _e('Article by', 'university-theme'); ?> <?php the_author_posts_link(); ?> <?php _e('in', 'university-theme'); ?> <?php the_time('F Y'); ?> - <?php echo get_the_category_list(', '); ?></p>
            </div>

            <div class="generic-content">
                <?php the_excerpt(); ?>
                <p><a class="btn btn--blue" href="<?php the_permalink(); ?>"><?php _e('Continue reading', 'university-theme'); ?> &raquo;</a>
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