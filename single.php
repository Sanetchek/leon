<?php get_header();?>
<div class="wrapper">
    <?php if ( have_posts() ) :
        while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/post/content', 'post' );

        endwhile;
    endif; ?>
</div>
<div class="clearfix"></div>
<?php get_footer(); ?>
