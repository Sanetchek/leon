<div class="post-single-grid-cols">
    <div class="block">
        <article class="article">
            <?php
            the_post_thumbnail('large');
            the_title('<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>');
            the_excerpt(  );
            ?>
        </article>
    </div>
</div>
