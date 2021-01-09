<main class="single-page-cont content">
    <?php
    if( is_front_page() ) {

      $contacts = new WP_Query('pagename=kontakty&post_type=page');
      if( $contacts->have_posts() ){ 
          while( $contacts->have_posts() ){ 
             $contacts->the_post();
             the_content();
          }
          wp_reset_query();
      } else {
         // текст/код, если постов нет
      }
    } else {
      the_content(); 
    }
    ?>
</main>