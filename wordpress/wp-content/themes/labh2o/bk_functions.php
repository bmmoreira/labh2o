<?php

function labhid_files() {
    wp_enqueue_script( 'main-labhid-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style( 'cutom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style( 'labhid_main_styles', get_theme_file_uri( '/build/style-index.css' ));
    wp_enqueue_style( 'labhid_extra_styles', get_theme_file_uri( '/build/index.css' ));
}

function labhid_features() {
    register_nav_menu( 'headerMenuLocation', 'Header Menu Location' );
    register_nav_menu( 'footerLocationOne', 'Footer Location One' );
    register_nav_menu( 'footerLocationTwo', 'Footer Location Two' );
    add_theme_support('title-tag');
}
// after seutup hook event
add_action('wp_enqueue_scripts','labhid_files');
add_action( 'after_setup_theme', 'labhid_features');
