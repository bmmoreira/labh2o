<?php
get_header();
   while(have_posts()) {
    the_post(); 
    pageBanner();
    
    ?>

   

    <div class="container container--narrow page-section">
         
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
          <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('professor'); ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php _e( 'Home - Professors','university-theme' ); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>
        <div class="generic-content">
            <div class="row group">
                <div class="one-fourth">
                <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
                </div>
                <div class="two-thirds">
                   
                        <?php  
                            $likeCount = new WP_Query(array(
                                'post_type' => 'like',
                                'meta_query' => array(
                                    array(
                                        'key' => 'liked_professor_id',
                                        'compare' => '=',
                                        'value' => get_the_ID()
                                    )
                                )
                            ));

                            $existStatus = 'no';
                            // to avoid the 'author be evaluate to 0 and not to be included in the query
                            // if place a if  *video 106
                            if(is_user_logged_in()) {
                                $existQuery = new WP_Query(array(
                                    // this query will only contain results if
                                    //  the current user has already like the current professor
                                    'author' => get_current_user_id(),
                                    'post_type' => 'like',
                                    'meta_query' => array(
                                        array(
                                            'key' => 'liked_professor_id',
                                            'compare' => '=',
                                            'value' => get_the_ID()
                                        )
                                    )
                                ));
    
                                if($existQuery->found_posts) {
                                    $existStatus = 'yes';
                                }
                            }

                           
                            
                        ?>

                <?php if( get_field('professor_email') ): ?>
                    <div class="professor-email"><i class="fa fa-address-book" aria-hidden="true"></i> <?php echo __( 'Email') . ' : ' .  get_field('professor_email') ; ?></div>
                <?php endif; ?>

                <?php if( get_field('lates') ): ?>
                    <div class="lattes"><i class="fa fa-address-card-o" aria-hidden="true"></i>
                    Lattes ID: <a href="http://lattes.cnpq.br/<?php echo get_field('lates'); ?>" target="_blank" rel="noopener noreferrer"><?php echo get_field('lates'); ?></a></div>
                <?php endif; ?> 

                <?php the_content(); ?>

                <?php if( get_field('scholar') ): ?>

                    <div class="generic-content flex center" style="margin-top: 30px; text-align: center">
                    <p><?php _e( 'Citations per year','university-theme' ); ?> - <?php _e( 'Source:','university-theme' ); ?> Google Scholar</p>
                    </div>
                           
                    <?php
                    
                    function filter_content($content, $url)
                    {
                        $contentText = '';
                        $output = preg_match_all('/<div class="gsc_rsb_s gsc_prf_pnl" id="gsc_rsb_cit" role="region" aria-labelledby="gsc_prf_t-cit">(.*)<\/div><div class="gsc_rsb_s gsc_prf_pnl" id="gsc_rsb_co" role="region" aria-labelledby="gsc_prf_t-ath">/is',$content,$matches);
                       
                        // if this has not worked try another variant:
                        if(!isset($matches[1][0]))
                        {
                        $output = preg_match_all('/<div class="gsc_rsb_s gsc_prf_pnl" id="gsc_rsb_cit" role="region" aria-labelledby="gsc_prf_t-cit">(.*)<\/div><div class="gsc_lcl" role="main" id="gsc_prf_w">/is',$content,$matches);
                        }
                        
                        $contentText = isset($matches[1][0])?$matches[1][0]:'e1';

                       // print($contentText);

                
                
                        preg_match_all('/<style>(.+)/is',$contentText,$matches);
                        $contentText2 = isset($matches[1][0])?$matches[1][0]:'e4';


                        $contentText2 = '<style>'.$contentText2;
                        //$contentText2 = preg_replace('#<div class="gsc_rsb_m_title">(.*?)</div>#si', '', $contentText2);
                        //$contentText2 = preg_replace('#<div class="gsc_rsb_m_na">(.*?)</div>#', '', $contentText2);

                        $doc = new DOMDocument();
                        @$doc->loadHTML($contentText2);

                        $selector = new DOMXPath($doc);
                        foreach($selector->query('//div[contains(attribute::class, "gsc_rsb_s gsc_prf_pnl")]') as $e ) {
                            $e->parentNode->removeChild($e);
                        }

                    //echo $doc->saveHTML($doc->documentElement);
                        
                        return $doc->saveHTML($doc->documentElement); 
                    }

                    $id = get_field( 'scholar');
                    $curl = curl_init();
                    $url = "http://scholar.google.com.br/citations?user=".$id."&hl=pt-BR";
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
                    //print(curl_exec($curl));
                    print filter_content( curl_exec($curl), $url );
                    
                    
                    ?>  
                <?php endif; ?>               

                  
                </div>
            </div>
           
        </div>
        <?php
            $relatedPrograms = get_field('related_programs');
            if($relatedPrograms){
            // each item in the for will be a post
            echo '<hr class="section-brake" style="margin: 20px">';
            echo '<h4 class="headline headline--small">Related Program(s)</h2>';
            echo '<ul class="link-list min-list">';
            foreach($relatedPrograms as $program) { ?>
                
                
                    <li><a href="<?php echo get_the_permalink($program) ?>"><?php echo get_the_title($program); ?></a></li>
                
            <?php  }
            echo '</ul>';
        } ?>

   </div>
    <?php
   }
get_footer();

?>