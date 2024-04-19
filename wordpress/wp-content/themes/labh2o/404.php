<?php
get_header();
pageBanner(array(
    'title' => __('Page Not Found', 'university-theme'),
    'subtitle' => __('The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'university-theme'),
    'photo' => get_theme_file_uri('/images/about_labh2o.png')
));
?>

<div class="container container--narrow page-section">


    <div class="generic-content">

        <?php
        get_search_form(
            array(
                'label' => __('404 not found', 'labh2o'),
            )
        );
        ?>
    </div>

</div>
<?php

get_footer();

?>