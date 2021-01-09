<?php get_header(); ?>

<div class="wrapper">
    <main>
        <section class="error-404 not-found">
            <header>
                <h1><?php _e( 'Oops! Эта страница не найдена.', 'theme_language' ); ?></h1>
            </header><!-- .page-header -->
            <div class="not-found-search">
                <p><?php _e( 'Похоже ничего не найдено. Воспользуйтесь поиском.', 'theme_language' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        </section>
    </main>
</div>
<div class="clearfix"></div>
<?php get_footer(); ?>
