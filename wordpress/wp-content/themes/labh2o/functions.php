<?php

require get_theme_file_path('/includes/like-route.php');

function pageBanner($args = NULL)
{
  // php logic will live here
  if (!isset($args['title'])) {
    $args['title'] = get_the_title();
  }
  if (!isset($args['subtitle'])) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }
  if (!isset($args['photo'])) {
    if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }

?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo  $args['photo']; ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo   $args['title']; ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>
  </div>
<?php
}


function my_theme_load_theme_textdomain()
{
  load_theme_textdomain('university-theme', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'my_theme_load_theme_textdomain');

function labhid_files()
{


  wp_enqueue_script('main-labhid-js', get_theme_file_uri('/build/index.js'), array('jquery', 'wp-i18n'), '1.0', true);
  wp_enqueue_script('script-name', get_theme_file_uri('/src/vanilla-tilt.min.js'), array(), NULL);
  wp_enqueue_style('cutom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('labhid_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('labhid_extra_styles', get_theme_file_uri('/build/index.css'));





  wp_enqueue_style('dashicons');
  wp_set_script_translations('main-labhid-js', 'university-theme', get_theme_file_uri('/languages'));
  //whenever we success at login in wordpress
  //create a secret property random number for user session
  wp_localize_script('main-labhid-js', 'universityData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest')
  ));
}

function labhid_features()
{

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 150, 150, true);
  add_image_size('professorPortrait', 150, 150, true);
  add_image_size('pageBanner', 1500, 350, true);
  add_image_size('pageBannerSmall', 1500, 200, true);
  add_image_size('pageBannerTiny', 1500, 100, true);
  add_image_size('card-image', 287, 247, true);
}
// after seutup hook event
add_action('wp_enqueue_scripts', 'labhid_files');
add_action('after_setup_theme', 'labhid_features');




function universityMapKey($api)
{
  $api['key'] = 'AIzaSyD0gvlF-P2YxjMqgJZX5v4lVHX-J5s015g';
  return $api;
}
add_filter('acf/fields/google_map/api', 'universityMapKey');



require get_theme_file_path('/includes/search-route.php');

// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend()
{
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar()
{
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');
function ourHeaderUrl()
{
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCss');
function ourLoginCss()
{
  wp_enqueue_style('cutom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('labhid_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('labhid_extra_styles', get_theme_file_uri('/build/index.css'));
}
add_filter('login_headertitle', 'ourLoginTitle');
function ourLoginTitle()
{
  return get_bloginfo('name');
}

add_action('pre_get_posts', function ($query) {
  if (is_post_type_archive('professor')) :
    //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
    //Set the order ASC or DESC
    $query->set('order', 'ASC');
    //Set the orderby
    $query->set('orderby', 'title');
  endif;
});

add_action('wp_head', 'my_analytics', 20);
function my_analytics()
{
?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-P2JNCTQGBN"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-P2JNCTQGBN');
  </script>
<?php
}

require get_theme_file_path('/includes/acf-pagebanner.php');
