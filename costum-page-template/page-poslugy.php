<?php /* Template Name: Послуги */ ?>
<?php get_header(); ?>

<div class="wrapper">
    <article id="page-single" <?php post_class(); ?>>
        <header class="entry-header">
            <?php get_template_part( 'template-parts/navigation/nav', 'breadcrumbs' );?>
        </header><!-- .entry-header -->
        <?php get_template_part( 'template-parts/page/content', 'poslugy' );?>
    </article>
</div>

<?php get_footer(); ?>