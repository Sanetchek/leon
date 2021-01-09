<?php get_header(); ?>

<div class="wrapper">
    <article id="page-single" <?php post_class(); ?>>
        <?php get_template_part( 'template-parts/page/content', 'poslugy' );?>
    </article>
</div>

<div id="content-page">
    <div class="wrapper">
        <div class="content-about">
            <?php if ( have_posts() ) :
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/page/content', 'page' );

            endwhile;
        endif; ?>
        </div>
    </div>
</div>

<article id="page-contacts" <?php post_class(); ?>>
    <main class="single-page-cont content">
        <?php get_template_part( 'template-parts/page/content', 'contacts' );?>
        <div class="clearfix"></div>
    </main>
</article>

<?php get_footer(); ?>
