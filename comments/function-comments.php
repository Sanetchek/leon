<?php

/*
 * Прописываем путь к форме комментариев    -   ON
 * Enqueue scripts                          -   ON
 * Simple ajax comment form mod             -   ON
 * Disable comment js                       -   ON
 * Comment form                             -   ON
 * Reorder comment fields                   -   ON
 *
 **/

/*
===================================================================
          Прописываем путь к форме комментариев
===================================================================
*/
add_filter( 'comments_template', 'custom_comment_template' );
function custom_comment_template($comment_template){
    global $post, $withcomments;
    if ( ! ( is_single() || is_page() || $withcomments ) || empty( $post ) ) {
        return;
    }
    // Path to our new comment template file
    $new_theme_template = get_template_directory() . '/comments/template-parts/content-comments.php';

    // Override if it exsits
    if( file_exists( $new_theme_template ) )
        $comment_template = $new_theme_template;
    return $comment_template;
}

/*
===================================================================
          Register Scripts and Css
===================================================================
*/
add_action( 'wp_enqueue_scripts', 'custom_comments_scripts');

function custom_comments_scripts()
{
    if ( comments_open() || get_comments_number() ) {
        // Styles
        wp_enqueue_style('comments-form', get_template_directory_uri() . '/comments/css/comments-form.min.css');


        // Scripts
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'comments', get_template_directory_uri() . '/comments/js/comments.min.js', array('jquery'), null, true );

        // добавим comment_reply для ответа на комментарии
        wp_enqueue_script( 'comment-reply' );
    }
}



add_action( 'wp_ajax_ajaxcomments', 'submit_ajax_comment' ); // wp_ajax_{action} for registered user
add_action( 'wp_ajax_nopriv_ajaxcomments', 'submit_ajax_comment' ); // wp_ajax_nopriv_{action} for not registered users

function submit_ajax_comment(){
    $inputs = $_POST["page"];

    echo $inputs . 'submit_ajax_comment';

    die();

}


/*
   ===================================================================
               Simple ajax comment form mod
   ===================================================================
*/
/**
 * Adding processing message at comment form
 * Use inline style so we don't need to load more file
 */
add_action( 'comment_form', 'simple_ajax_comment_form_mod' );

function simple_ajax_comment_form_mod( $settings ){
    printf( '<div class="submitting-comment" style="padding: 15px 20px; text-align: center; display: none;">%s</div>', __( 'Отправка сообщения...', 'theme_language' ) );
}

/*
   ===================================================================
               Comment list form
   ===================================================================
*/
function customize_comment_list_callback( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case '' :
        case 'comment' :
            ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
            <?php printf( __( '%s <span class="says">:</span>', 'theme_language' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
        </div><!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Комментарий на модерации', 'theme_language' ); ?></em>
        <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata">
            <?php
                        /* translators: 1: date, 2: time */
                        printf( __( '%1$s в %2$s', 'theme_language' ), get_comment_date(),  get_comment_time() ); ?>
            <?php if( ( is_user_logged_in() )) {edit_comment_link( __( ' (Изменить)', 'theme_language' ), ' ' );}
                    ?>
        </div><!-- .comment-meta .commentmetadata -->

        <div class="comment-body"><?php comment_text(); ?></div>

        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div><!-- .reply -->
    </div><!-- #comment-##  -->

    <?php
            break;
        case 'pingback'  :
        case 'trackback' :
            ?>
<li class="post pingback">
    <p><?php _e( 'Pingback:', 'theme_language' ); ?> <?php comment_author_link(); ?><?php if( ( is_user_logged_in() )) {edit_comment_link( __( ' (Изменить)', 'theme_language' ), ' ' );} ?></p>
    <?php
            break;
    endswitch;
}

/*
   ===================================================================
               Reorder comment fields
   ===================================================================
*/

add_filter('comment_form_fields', 'kama_reorder_comment_fields' );
function kama_reorder_comment_fields( $fields ){
    // die(print_r( $fields )); // посмотрим какие поля есть

    $new_fields = array(); // сюда соберем поля в новом порядке

    $myorder = array('author','email','comment'); // нужный порядок

    foreach( $myorder as $key ){
        $new_fields[ $key ] = $fields[ $key ];
        unset( $fields[ $key ] );
    }

    // если остались еще какие-то поля добавим их в конец
    if( $fields )
        foreach( $fields as $key => $val )
            $new_fields[ $key ] = $val;

    return $new_fields;
}
