<article id="page-content" <?php post_class(); ?>>
    <?php if ( !is_front_page() ) {?>
    <header class="entry-header">
        <?php get_template_part( 'template-parts/navigation/nav', 'breadcrumbs' );?>
    </header><!-- .entry-header -->
    <main class="single-page content">
        <?php the_title( '<h1 class="single-page-title hsize fwlight">', '</h1>' ); ?>
        <div class="single-page-content">
            <div class="single-page-content-wrapper">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </main>

    <?php } else {?>
    <main class="content front-page anim-items anim-no-hide">
        <?php the_content(); ?>
    </main>
    <?php } ?>
</article>
