<?php
get_header();
pageBanner();

   while(have_posts()) {
    the_post(); ?>


    <div class="container container--narrow page-section">
         
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php _e( 'Home - Programs','university-theme' ); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>
        <div class="generic-content">
            <?php  the_field('program_body_content'); ?>
        </div>

        <?php

$relatedProfessors = new WP_Query(
    array(
        'posts_per_page' => -1,
        'post_type' => 'professor',
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"'. get_the_ID() .'"'
            )
        )
    )

);

if($relatedProfessors->have_posts()){
    echo '<hr class="section-brake" style="margin: 20px">';
    echo '<h2 class=headline headline-small style="margin-bottom: 20px">' . __( 'Professors','university-theme' ) . '</h2>';

    echo '<ul class="professor-cards">';
    while($relatedProfessors->have_posts()) {
        $relatedProfessors->the_post(); ?>
        <li class="professor-card__list-item">
            <a class="professor-card" href="<?php the_permalink();?>"> 
                
                <img class="professor-card__image" src="<?php the_post_thumbnail_url(); ?> ">
                <span class="professor-card__name"><?php the_title(); ?> </span>
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
                echo '<h2 class=headline headline-small style="margin-bottom: 20px">' . __( 'Upcoming Events','university-theme' ) . ' ' . get_the_title() . ' </h2>';
    
                while($homePageEvents->have_posts()) {
                    $homePageEvents->the_post(); 
                    get_template_part('template-parts/content-event');
               
                }
            }

            wp_reset_postdata();
            $relatedCampuses = get_field('related_campus');
            if($relatedCampuses){
                echo '<hr class="section-brake" style="margin: 20px">';

                echo '<h2 class="headline headline--small" >' . get_the_title() .' is Available At These Campuses: </h2>';
                echo '<ul class="min-list link-list">';
                foreach($relatedCampuses as $campus){
                    ?>  <li><a href="<?php echo get_the_permalink($campus); ?>"><?php echo get_the_title($campus);?></li>      <?php

                }
                echo '</ul>';
            }
        
          ?>

   </div>
    <?php
   }
get_footer();

?>