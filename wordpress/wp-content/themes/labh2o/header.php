<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <link rel="shortcut icon" href="#">

</head>

<body <?php body_class(); ?>>
  <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left">
        <a href="<?php echo site_url() ?>"><strong><?php echo get_option('blogname'); ?></strong> </a>
      </h1>
      <a href="<?php echo esc_url(site_url('/search')); ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">


          <?php if (pll_current_language() == 'pt') : ?>
            <ul>
              <li <?php if (is_home('')) echo 'class="current-menu-item"' ?>><a href="/">Home</a></li>
              <li <?php if (is_page('sobre-o-labh2o') or wp_get_post_parent_id(0) == 11) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/sobre-o-labh2o') ?>"><?php _e('About LABH2O', 'university-theme'); ?></a></li>
              <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/noticias'); ?>"><?php _e('News', 'university-theme'); ?></a></li>
              <li <?php if (is_page('colecoes')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/colecoes') ?>"><?php _e('Repository', 'university-theme'); ?></a></li>
              <li <?php if (get_post_type() == 'event' or is_page('eventos-passados')) echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('event'); ?>"><?php _e('Events', 'university-theme'); ?></a></li>
              <li <?php if (get_post_type() == 'campus') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('professor'); ?>"><?php _e('Professors', 'university-theme'); ?></a></li>
            </ul>
          <?php endif; ?>
          <?php if (pll_current_language() == 'es') : ?>
            <ul>
              <li <?php if (is_home('')) echo 'class="current-menu-item"' ?>><a href="/es/home-espanol/">Home</a></li>
              <li <?php if (is_page('sobre-o-labh2o') or wp_get_post_parent_id(0) == 11) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/es/sobre-labh2o/') ?>"><?php _e('About LABH2O', 'university-theme'); ?></a></li>
              <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/es/noticias-2'); ?>"><?php _e('News', 'university-theme'); ?></a></li>
              <li <?php if (is_page('colecoes')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/colecoes') ?>"><?php _e('Repository', 'university-theme'); ?></a></li>
              <li <?php if (get_post_type() == 'event' or is_page('eventos-passados')) echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('event'); ?>"><?php _e('Events', 'university-theme'); ?></a></li>
              <li <?php if (get_post_type() == 'campus') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('professor'); ?>"><?php _e('Professors', 'university-theme'); ?></a></li>
            </ul>
          <?php endif; ?>
          <?php if (pll_current_language() == 'en') : ?>
            <ul>
              <li <?php if (is_home('')) echo 'class="current-menu-item"' ?>><a href="/en/home-english/">Home</a></li>
              <li <?php if (is_page('sobre-o-labh2o') or wp_get_post_parent_id(0) == 11) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/en/about-labh2o/') ?>"><?php _e('About LABH2O', 'university-theme'); ?></a></li>
              <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/en/news'); ?>"><?php _e('News', 'university-theme'); ?></a></li>
              <li <?php if (is_page('colecoes')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/colecoes') ?>"><?php _e('Repository', 'university-theme'); ?></a></li>
              <li <?php if (get_post_type() == 'event' or is_page('eventos-passados')) echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('event'); ?>"><?php _e('Events', 'university-theme'); ?></a></li>
              <li <?php if (get_post_type() == 'campus') echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('professor'); ?>"><?php _e('Professors', 'university-theme'); ?></a></li>
            </ul>
          <?php endif; ?>

          <ul>
            <?php pll_the_languages(array('show_flags' => 1, 'show_names' => 0)); ?>
          </ul>

        </nav>
        <div class="site-header__util">
          <?php if (is_user_logged_in()) { ?>
            <a href="<?php echo wp_logout_url(); ?>" class="btn btn--small btn--dark-orange float-left  btn--with-photo">
              <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span>
              <span class="btn__text">Log out</span>
            </a>
          <?php
          } else { ?>

            <a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
            <a href="<?php echo wp_registration_url(); ?>" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
            <a href="<?php echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>

          <?php   }

          ?>

        </div>
      </div>
    </div>
  </header>
