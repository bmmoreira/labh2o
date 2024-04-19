<?php
get_header();
pageBanner();
   while(have_posts()) {
    the_post(); ?>

    <div class="container container--narrow page-section">
         
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
          <a class="metabox__blog-home-link" href="<?php echo site_url('/noticias'); ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php _e( 'Home - News','university-theme' ); ?></a> <span class="metabox__main"><?php _e( 'Article by','university-theme' ); ?> <?php the_author_posts_link(); ?> em <?php the_time('F Y'); ?> - <?php echo get_the_category_list(', '); ?></span>
            </p>
        </div>
        <div class="generic-content">
            <?php  the_content(); ?>
        </div>

   </div>
    <?php
   }
get_footer();

?>