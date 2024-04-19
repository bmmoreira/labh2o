<?php

$the_slug = 'labh2o-testimonial';
$args = array(
    'name'        => $the_slug,
    'post_type'   => 'page',
    'post_status' => 'publish',
    'numberposts' => 1
);
$slug_posts = get_posts($args);
$slug_post = get_post($slug_posts[0]->ID);
$post_testimonial = get_post($slug_post);

$bkgdImg = wp_get_attachment_url(get_post_thumbnail_id($post_testimonial->ID));
?>
<div class="lab-testimonial" style="background-image: linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(117, 19, 93, 0.73)),
    url(<?php echo get_theme_file_uri('/images/bg-river4.jpg') ?>);">
    <blockquote>
        <img src="<?php echo $bkgdImg; ?>" alt="Avatar" class="g-img-circle" height="120" width="120">
        <p><?php echo $post_testimonial->post_content; ?></p>
    </blockquote>
</div>