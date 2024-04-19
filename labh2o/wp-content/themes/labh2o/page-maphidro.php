<?php
get_header();
pageBanner();
   while(have_posts()) {
    the_post(); ?>     
        
            <?php  the_content(); ?>
      

    <?php
   }
get_footer();

?>