<form class="search-form" method="get" action="<?php echo esc_url(site_url('/')); ?>">
  <label class="headline headline--medium" for="s"><?php _e('Perform a New Search:', 'university-theme'); ?></label>
  <div class="search-form-row">
    <input placeholder="<?php _e('What are you looking for?', 'university-theme'); ?>" class="s" id="s" type="search" name="s">
    <input class="search-submit" type="submit" value="Search">
  </div>
</form>