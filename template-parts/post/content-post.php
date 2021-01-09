<article class="single-post content">
    <header class="post-header">
        <?php get_template_part( 'template-parts/navigation/nav', 'breadcrumbs' ); ?>

        

    </header><!-- .entry-header -->

    <main class="single-post-container">
        <div class="single-post-container-thumbnail">
        <?php 
        the_post_thumbnail( 'large' );
        ?>
        </div>

        <div class="single-post-container-content">
        <?php 
        the_title( '<h1 class="single-post-container-content-title">', '</h1>' );
        the_content(); 
        ?>
        </div>
    </main>

    <?php
    the_post_navigation( array(
        'prev_text' => '<span>' . __( 'Предыдущая страница: ', 'theme_language' ) . '</span>'.  '<span class="post-title">%title</span>',
        'next_text' => '<span>' . __( 'Следующая страница: ', 'theme_language' ) . '</span>'.  '<span class="post-title">%title</span>',
        'before_page_number' => '<span>' . __( 'Страница: ', 'theme_language' ) . ' </span>',
    ) );
    ?>

    <?php if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;?>

</article><!-- #post-## -->
