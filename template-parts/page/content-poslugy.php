<main class="single-page content">
    <div class="single-page-content">
        <div class="single-page-content-wrapper">

        	<?php
        	if( is_front_page() ) {
			  $id = 129;// Обязательно передавать переменную
			  $post = get_post($id); 
			  $content = $post->post_content;
			  
			  echo $content;
			} else {
			  the_content(); 
			}
			?>
        </div>

        <div class="page-poslugy">
        <?php 
        	$args = array(
        		'post_type'	=> 'page',
        		'posts_per_page' => -1,
        		'post_name__in' => [ 'kosmetologyia', 'parikmakherskie-uslugi', 'manicure-pedicure', 'dogliad-za-tilom', 'solyarij', 'prokol-ushej-pirsing' ],
        		'orderby' => 'post_name__in'
        	);
        	$poslugy = new WP_Query($args);

        	if( $poslugy->have_posts() ) {
        		while( $poslugy->have_posts() ) {
        			$poslugy->the_post(); ?>

        			<div class="page-poslugy-thumbnail"><?php the_post_thumbnail( 'full' ); ?></div>
        			<div class="page-poslugy-content">
        				<h2 class="page-poslugy-title"><?php the_title(); ?></h2>
        				<?php the_excerpt(); ?>
        				<p>
        					<a class="page-poslugy-get-more fwbold" href="<?php the_permalink(); ?>"><?php _e( 'Узнать больше', 'theme_language' ); ?></a>
        				</p>
        			</div>

        		<?php }
        	}
        	wp_reset_postdata();
        ?>
        </div>
    </div>
</main>