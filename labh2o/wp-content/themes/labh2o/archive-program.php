<?php

get_header(); 
pageBanner(array(
    'title' => __( 'All Programs','university-theme' ),
    'subtitle' => __( 'Programs List','university-theme' ),
    'photo' => get_theme_file_uri('/images/about_labh2o.png')
));
?>

<div class="container container--narrow page-section">
    <ul class="link-list min-list">
    <?php
    while(have_posts()){
        the_post(); ?>
    
        <li><a href="<?php the_permalink(); ?>"><?php the_title() ?> </a></li>

    <?php }
    
    echo paginate_links();

    ?>
    </ul>
    

</div>

<?php

get_footer();

?>