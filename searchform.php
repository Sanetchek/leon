<section class="search-and-filter">
    <div class="search-wrap">
        <form role="search" method="get" class="search-form" action="><?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" class="search-field" placeholder="<?php echo _e( 'Что найти &hellip; ?', 'placeholder', 'theme_language' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />

            <button type="submit" class="search-submit button button-primary"><span class="search-text"><?php echo _e( 'Найти', 'submit button', 'theme_language' ); ?></span></button>
        </form>
    </div>
</section>
<div class="clearfix"></div>
