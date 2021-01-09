<?php /* Template Name: Contacts */ ?>
<?php get_header(); ?>

<div class="wrapper">
    <article id="page-contacts" <?php post_class(); ?>>
        <header class="entry-header">
            <?php get_template_part( 'template-parts/navigation/nav', 'breadcrumbs' );?>
        </header><!-- .entry-header -->
        <?php get_template_part( 'template-parts/page/content', 'contacts' );?>
    </article>
</div>

<?php get_footer(); ?>
