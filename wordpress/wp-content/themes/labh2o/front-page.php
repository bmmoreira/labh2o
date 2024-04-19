<?php
get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/labh2o_water.jpg') ?>)"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large"><img src="<?php echo get_theme_file_uri('/images/labh2o.png') ?>" alt="Labh2o Logo" /></h1>
    <h2 class="headline headline--medium"><?php _e('Laboratory of Water Resources and Environmental Studies', 'university-theme'); ?></h2>
    <h3 class="headline headline--small"><?php _e('Civil Engineering Program', 'university-theme'); ?> (PEC) - UFRJ</h3>
    <a href="<?php echo site_url('/sobre-o-labh2o') ?>" class="btn btn--large btn--blue"><?php _e('Know more', 'university-theme'); ?></a>
  </div>
</div>

<div class="full-width-split group">
  <div class="full-width-split__one">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center"><?php _e('Upcoming Events', 'university-theme'); ?></h2>


      <?php
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
            )
          )
        )
      );

      while ($homePageEvents->have_posts()) {
        $homePageEvents->the_post();
        get_template_part('template-parts/content', 'event');
      }
      ?>

      <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue"><?php _e('View All Events', 'university-theme'); ?></a></p>
    </div>
  </div>
  <div class="full-width-split__two">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center"><?php _e('News', 'university-theme'); ?></h2>
      <?php
      $homepagePosts = new WP_Query(array(
        'posts_per_page' => 2
      ));

      while ($homepagePosts->have_posts()) {
        $homepagePosts->the_post();
        get_template_part('template-parts/content', 'post');
      }
      wp_reset_postdata();
      ?>

      <p class="t-center no-margin"><a href="<?php echo site_url('/noticias'); ?>" class="btn btn--blue"><?php _e('View All News', 'university-theme'); ?></a></p>
    </div>
  </div>
</div>

<div class="hero-slider">
  <div data-glide-el="track" class="glide__track">
    <div class="glide__slides">

      <?php
      $today = date('Ymd');
      $homePageDefenses = new WP_Query(
        array(
          'posts_per_page' => 3,
          'post_type' => 'defense',
          'meta_key' => 'defense_date',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',

        )
      );

      while ($homePageDefenses->have_posts()) {
        /*
                Function the_post() checks whether the loop has started and then sets the current post by moving, each time, to the next post in the queue.
              */
        $homePageDefenses->the_post();
        $defenseDate = new DateTime(get_field('defense_date'));
        $defenseTime = new DateTime(get_field('defense_hour'));
        $defType = get_field_object('defense_type');
        $value = $defType['value'];
        $label = $defType['choices'][$value];


      ?>
        <div class="hero-slider__slide" style="background-image: url(<?php echo get_field('page_banner_background_image')['sizes']['pageBanner']; ?>)">
          <div class="hero-slider__interior container">
            <div class="hero-slider__overlay">
              <div class="headline headline--small t-center"><?php echo $label; ?>:
                <?php echo $defenseDate->format('d/m/Y') . ' - ' . get_field('defense_hour'); ?> </div>

              <h2 class="headline headline--small t-center"><?php echo get_field('student_name'); ?></h2>
              <p class="t-center" style="white-space: break-spaces;"><?php echo get_the_title(); ?></p>
              <p class="t-center no-margin"><a href="<?php the_permalink(); ?>" class="btn btn--blue"><?php _e('Know more', 'university-theme'); ?></a></p>
            </div>
          </div>
        </div>

      <?php }
      ?>

    </div>
    <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
  </div>
</div>

<div class="cards">
  <?php
  $homePageCard1 = new WP_Query(
    array(
      'posts_per_page' => 1,
      'post_type' => 'card',
      'category_name' => 'mestrado-doutorado',
    )
  );
  while ($homePageCard1->have_posts()) {
    $homePageCard1->the_post();
    $category = get_the_category();
    $currentcatname = $category[0]->cat_name;
  ?>

    <div class="card">

      <div class="card-image" style="background-image: url(<?php the_post_thumbnail_url('card-image') ?>)"></div>
      <div class="card-text">
        <span class="date"><?php echo $currentcatname;  ?></span>
        <h2><?php the_title(); ?></h2>
        <p><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></p>
      </div>
      <div class="card-stats">
        <div class="stat">
          <div class="value"><span class="dashicons dashicons-info"></span></div>
          <div class="type">PEC</div>
        </div>
        <div class="stat border">
          <div class="value"><a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('Read more', 'university-theme'); ?></a></div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>

  <?php
  $homePageCard2 = new WP_Query(
    array(
      'posts_per_page' => 1,
      'post_type' => 'card',
      'category_name' => 'bolsas',
    )
  );
  while ($homePageCard2->have_posts()) {
    $homePageCard2->the_post();
    $category = get_the_category();
    $currentcatname = $category[0]->cat_name;
  ?>
    <div class="card">

      <div class="card-image card2" style="background-image: url(<?php the_post_thumbnail_url('card-image') ?>)"></div>
      <div class="card-text card2">
        <span class="date"><?php echo $currentcatname;  ?></span>
        <h2><?php the_title(); ?></h2>
        <p><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></p>
      </div>
      <div class="card-stats card2">
        <div class="stat">
          <div class="value"><span class="dashicons dashicons-info"></span></div>
          <div class="type">CAPES</div>
        </div>
        <div class="stat border">
          <div class="value"><a href="<?php the_permalink(); ?>" class="btn btn-primary stretched-link"><?php _e('Read more', 'university-theme'); ?></a></div>

        </div>
      </div>
    </div>
  <?php
  }
  ?>

  <?php
  $homePageCard3 = new WP_Query(
    array(
      'posts_per_page' => 1,
      'post_type' => 'card',
      'category_name' => 'publicacoes',
    )
  );
  while ($homePageCard3->have_posts()) {
    $homePageCard3->the_post();
    $category = get_the_category();
    $currentcatname = $category[0]->cat_name;
  ?>
    <div class="card">

      <div class="card-image card3" style="background-image: url(<?php the_post_thumbnail_url('card-image') ?>)"></div>
      <div class="card-text card3">
        <span class="date"><?php echo $currentcatname;  ?></span>
        <h2><?php the_title(); ?></h2>
        <p><?php echo wp_trim_words(get_the_excerpt(), 14, '...'); ?></p>
      </div>
      <div class="card-stats card3">
        <div class="stat">
          <div class="value"><span class="dashicons dashicons-info"></span></div>
          <div class="type">LABH2O</div>
        </div>
        <div class="stat border">
          <div class="value"><a href="<?php the_permalink(); ?>" class="btn btn-primary stretched-link"><?php _e('Read more', 'university-theme'); ?></a></div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>


</div>

<?php get_template_part('template-parts/content', 'testimonial'); ?>

<?php get_template_part('template-parts/content', 'partners'); ?>

<?php get_footer(); ?>