<?php

get_header();
pageBanner(array(
    'title' => __('Ex Professors', 'university-theme'),
    'subtitle' => __('Professors who were part of the teaching staff', 'university-theme')
));

$the_slug = 'ex-professors';
$args = array(
    'name'        => $the_slug,
    'post_type'   => 'page',
    'post_status' => 'publish',
    'numberposts' => 1
);
$my_posts = get_posts($args);
$post_content = get_post($my_posts[0]->ID);
$content = $post_content->post_content;


?>

<div class="container container--narrow page-section">


    <p><?php echo $content; ?> </p>
    <?php


    $exProfessors = new WP_Query(
        array(
            'posts_per_page' => 10,
            'post_type' => 'professor',
            'meta_key' => 'affiliate_category',
            'meta_query' => array(
                array(
                    'key' => 'affiliate_category',
                    'compare' => '=',
                    'value' => 'ex',
                )
            )
        )
    );

    while ($exProfessors->have_posts()) {
        $exProfessors->the_post();
        get_template_part('template-parts/content-professor-list');
    }

    ?>
</div>

<?php

get_footer();

?>