<div class="comment_form">
    <div class="form">
        <div id="comments">

            <ol class="commentlist">
                <?php if ( have_comments() ) : ?>


                <?php
                    /*
                     * Loop through and list the comments. Tell wp_list_comments()
                     * to use ispynyc_comment() to format the comments.
                     * If you want to overload this in a child theme then you can
                     * define ispynyc_comment() and that will be used instead.
                     * See ispynyc_comment() in glegrand/functions.php for more.
                     */
                    wp_list_comments( array(
                        'callback'           => 'customize_comment_list_callback',
                        'max_depth'          => '',
                        'reverse_top_level'  => true,
                        'login_text' => ''
                    ) );
                    ?>

                <?php the_comments_pagination(); ?>

                <?php else : ?>


                <?php endif; // end have_comments() ?>
            </ol>



            <?php
            $requireNameEmail = get_option('require_name_email');

            if( !( is_user_logged_in() ) && ! $requireNameEmail  ) {
                echo '
                <div class="comment-register">
                    <p class="must-log-in">'. _e( 'Чтобы оставить комментарий войдите или зарегистрируйтесь.', 'theme_language' ) .'</p>
                </div>';
                wp_login_form();
            } else {
                $args = array(
                    'fields'               => array(
                        'author' => '<p class="comment-form-author">' . '<input id="author" class="author required" name="author" type="text" value="" size="30" aria-required="true" placeholder="nickname"></p>',
                        'email'  => '<p class="comment-form-email">' . '<input id="email" class="email required" name="email" type="email" value="" size="30" aria-required="true" placeholder="email"></p>',

                    ),
                    'comment_field' =>
                        '<p class="comment-form-comment">
                    <textarea id="comment" name="comment" class="comment-form-item required" cols="45" rows="8" placeholder="'. __( 'Напишите свой комментарий', 'theme_language' ) .'"></textarea>
                    </p>',
                    'comment_notes_after'   => '',
                    'label_submit'          => __( 'Написать', 'theme_language' ),
                    'title_reply'           => __( 'Поделитесь мыслями!', 'theme_language' ),
                    'comment_notes_before'  => '',
                    'title_reply_to'        => __( 'Ответить %s или ', 'theme_language' ),
                    'cancel_reply_link'     => __( ' Отменить', 'theme_language' ),
                    'format'                => 'html5',
                    'logged_in_as'          => '',
                );
                comment_form($args);
            } ?>

        </div>
    </div>
</div><!-- #comments -->
