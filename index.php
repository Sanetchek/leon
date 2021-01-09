<?php get_header(); ?>
<div class="wrapper">
    <?php get_template_part( 'template-parts/navigation/nav', 'breadcrumbs' ); ?>

    <main id="main-post-content" class="post-single">
        <div class="post-single-grid content">
            <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'template-parts/post/content', 'loop' ); ?>

            <?php endwhile; ?>
        </div>

        <?php if ( function_exists( 'wp_corenavi' ) ) wp_corenavi(); ?>
        <?php wp_reset_postdata(); ?>

        <?php else:  ?>

        <?php endif; ?>

    </main>
</div>
<div class="clearfix"></div>
<?php get_footer(); ?>
