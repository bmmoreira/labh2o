<div class="professor-summary">
                    <img class="professor-summary__date t-center" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
                 <div class="professor-summary__content">
                     <h5 class="professor-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                     <p><?php if (has_excerpt()){
                        echo get_the_excerpt();
                     } else {
                        echo wp_trim_words( get_the_content( ), 18);
                     }
                    
                     ?> </br><a href="<?php the_permalink(); ?>" class="nu gray"><?php _e( 'Read more','university-theme' ); ?></a></p>
                 </div>
</div>