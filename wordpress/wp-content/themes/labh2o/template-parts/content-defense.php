<div class="hero-slider__slide" style="background-image: url(<?php echo get_field('page_banner_background_image')['sizes']['pageBanner']; ?>)">     
                     <div class="hero-slider__interior container">
                      <div class="hero-slider__overlay">
                    <div class="headline headline--small t-center"><?php echo $label; ?>: 
                      <?php  echo $defenseDate->format('d/m/Y') . ' - ' . get_field('defense_hour'); ?> </div>
                   
                        <h2 class="headline headline--small t-center"><?php echo get_field('student_name'); ?></h2>
                        <p class="t-center" style="white-space: break-spaces;"><?php echo get_the_title(); ?></p>
                        <p class="t-center no-margin"><a href="<?php the_permalink(); ?>" class="btn btn--blue">Saiba mais</a></p>
                      </div>
                    </div>
                  </div> 