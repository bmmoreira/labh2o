<?php
get_header();
pageBanner();

   while(have_posts()) {
    the_post(); ?>


    <div class="container container--narrow page-section">
         
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php _e( 'Home - Campuses','university-theme' ); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>
        <div class="generic-content">
            <?php  the_content(); ?>
        <?php
            $mapLocation = get_field('map_location');
        ?>
        <div class="acf-map">  
            <div data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>" class="marker">
                <h3><?php the_title(); ?></h3>
                <?php echo $mapLocation['address']; ?>
            </div>
         </div>
    </div>

<?php
// give any programs posts where the related campus contain the id of the current page campus
$relatedPrograms = new WP_Query(
    array(
        'posts_per_page' => -1,
        'post_type' => 'program',
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'related_campus',
                'compare' => 'LIKE',
                'value' => '"'. get_the_ID() .'"'
            )
        )
    )

);
print_r($relatedPrograms);
if($relatedPrograms->have_posts()){
    echo '<hr class="section-brake" style="margin: 20px">';
    echo '<h2 class=headline headline-small style="margin-bottom: 20px">Programs availabe at this Campus </h2>';

    echo '<ul class="min-list link-list">';
    while($relatedPrograms->have_posts()) {
        $relatedPrograms->the_post(); ?>
        <li>
            <a href="<?php the_permalink();?>"> 
                <?php the_title(); ?> 
            </a> 
        </li> 
    <?php }
    echo '</ul>';
}

            // reset global post object
            wp_reset_postdata();

            $today = date('Ymd');
            $homePageEvents = new WP_Query(
                array(
                    'posts_per_page' => 2,
                    'post_type' => 'event',
                    'meta_key' => 'event_date',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'event_date',
                            'compare' => '>=',
                            'value' => $today,
                            'type' => 'numeric'
                        ),
                        array(
                            'key' => 'related_programs',
                            'compare' => 'LIKE',
                            'value' => '"'. get_the_ID() .'"'
                        )
                    )
                )

            );

            if($homePageEvents->have_posts()){
                echo '<hr class="section-brake" style="margin: 20px">';
                echo '<h2 class=headline headline-small style="margin-bottom: 20px">Upcoming ' . get_the_title() . ' Events </h2>';
    
                while($homePageEvents->have_posts()) {
                    $homePageEvents->the_post(); 
                    get_template_part('template-parts/content-event');
               
                }
            }
        
          ?>

   </div>
    <?php
   }
get_footer();

?>