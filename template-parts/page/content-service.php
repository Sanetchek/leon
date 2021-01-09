<main class="single-page content">
    <div class="single-page-content">
        <div class="single-page-content-wrapper">
            <?php the_title( '<h1 class="single-page-title hsize fwlight">', '</h1>' ); ?>
        	<?php
			  the_content();
			?>
        </div>

        
            <?php

            $args = array( 
                'child_of' => get_the_ID(),
            );

            $mypages = get_pages( $args );

            if( $mypages ) { ?>
            <div class="single-page-service">
                <?php
                foreach( $mypages as $page ) { ?>     
                    <div class="single-page-service-child">
                        <a class="single-page-service-child-link" href="<?php echo get_page_link( $page->ID ); ?>">
                            <div class="single-page-service-child-thumbnail">
                            <?php echo get_the_post_thumbnail( $page->ID, 'large'); ?>
                            </div>
                            <h4 class="single-page-service-child-title">
                            <?php echo get_the_title($page); ?>   
                            </h4>                     
                        </a>
                    </div>
                <?php
                } ?>
            </div>
            <?php
            }     
            ?>        
    </div>
</main>