<footer class="site-footer">
  <div class="site-footer__inner container container--narrow">
    <div class="group">
      <div class="site-footer__col-one">
        <img src="<?php echo get_theme_file_uri('/images/labh2o_small.png') ?>" alt="Labh2o Logo" />
        <h1 class="theme-logo-text-footer school-logo-text--alt-color">
          <a href="<?php echo site_url(); ?>"><strong><?php echo get_option('blogname'); ?> | UFRJ | PEC | COPPE</strong> </a>
        </h1>

        <p>Av. Horácio de Macedo No. 2.030 <br />BLOCO I - SALAS I106/ I-206 <br /> CEP 21941-914 - Tel.:21 3938-7841<br />
      </div>

      <div class="site-footer__col-two-three-group">
        <div class="site-footer__col-two">
          <h3 class="headline headline--small"><?php _e('Explore', 'university-theme'); ?></h3>
          <nav class="nav-list">
            <?php if (pll_current_language() == 'pt') : ?>
              <ul>
                <li><a href="<?php echo site_url('/sobre-o-labh2o') ?>"><?php _e('About LABH2O', 'university-theme'); ?></a></li>
                <li <?php if (is_page('Contato')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/contato') ?>"><?php _e('Contact', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/equipe/#') ?>"><?php _e('Staff', 'university-theme'); ?></a></li>
                <li><a href="#"><?php _e('Privacy Policy', 'university-theme'); ?></a></li>
              </ul>
            <?php endif; ?>
            <?php if (pll_current_language() == 'en') : ?>
              <ul>
                <li <?php if (is_page('sobre-o-labh2o') or wp_get_post_parent_id(0) == 11) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/en/about-labh2o/') ?>"><?php _e('About LABH2O', 'university-theme'); ?></a></li>
                <li <?php if (is_page('Contact')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/en/contact') ?>"><?php _e('Contact', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/en/staff/#') ?>"><?php _e('Staff', 'university-theme'); ?></a></li>
                <li><a href="#"><?php _e('Privacy Policy', 'university-theme'); ?></a></li>
              </ul>
            <?php endif; ?>
            <?php if (pll_current_language() == 'es') : ?>
              <ul>
                <li <?php if (is_page('sobre-o-labh2o') or wp_get_post_parent_id(0) == 11) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/es/sobre-labh2o/') ?>"><?php _e('About LABH2O', 'university-theme'); ?></a></li>
                <li <?php if (is_page('Contacto')) echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/es/contacto') ?>"><?php _e('Contact', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/es/personal/#') ?>"><?php _e('Staff', 'university-theme'); ?></a></li>
                <li><a href="#"><?php _e('Privacy Policy', 'university-theme'); ?></a></li>
              </ul>
            <?php endif; ?>




          </nav>
        </div>

        <div class="site-footer__col-three">
          <h3 class="headline headline--small"><?php _e('Content', 'university-theme'); ?></h3>
          <nav class="nav-list">
            <?php if (pll_current_language() == 'pt') : ?>
              <ul>
                <li><a href="<?php echo site_url('/noticias') ?>"><?php _e('News', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/colecoes') ?>"><?php _e('Repository', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/eventos') ?>"><?php _e('Events', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/pet-civil-ufrj') ?>"><?php _e('Pet Civil', 'university-theme'); ?></a></li>
              </ul>
            <?php endif; ?>
            <?php if (pll_current_language() == 'en') : ?>
              <ul>
                <li><a href="<?php echo site_url('/en/news') ?>"><?php _e('News', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/colecoes') ?>"><?php _e('Repository', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/eventos') ?>"><?php _e('Events', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/pet-civil-ufrj') ?>"><?php _e('Pet Civil', 'university-theme'); ?></a></li>
              </ul>
            <?php endif; ?>
            <?php if (pll_current_language() == 'es') : ?>
              <ul>
                <li><a href="<?php echo site_url('/es/noticias-2') ?>"><?php _e('News', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/colecoes') ?>"><?php _e('Repository', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/eventos') ?>"><?php _e('Events', 'university-theme'); ?></a></li>
                <li><a href="<?php echo site_url('/pet-civil-ufrj') ?>"><?php _e('Pet Civil', 'university-theme'); ?></a></li>
              </ul>
            <?php endif; ?>
          </nav>
        </div>
      </div>

      <div class="site-footer__col-four" style="text-align: center;">
        <img src="<?php echo get_theme_file_uri('/images/logo_brunomoreira_dev.png') ?>" alt="brunomoreira Logo" />
        <h5 class="headline headline--extratiny">Desenvolvimento: brunomoreira.dev </h5>
      </div>
    </div>
  </div>
</footer>


<?php wp_footer(); ?>

</body>

</html>