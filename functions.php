<?php
/*
===================================================================
          Require all functions from /inc folder
===================================================================
*/

/*
 * Remove Admin bar                                     -   Off
 * Remove WordPress Meta Generator                      -   ON
 * REMOVE WP EMOJI                                      -   ON
 * Removing WordPress Version from pages,
   RSS, scripts and styles                              -   ON
 * Change logotype link to site (not to wordpress.org)  -   ON
 * Remove title in logotype "сайт работает на wordpress"-   ON
 * Custom WordPress Footer                              -   ON
 * Remove WordPress Version From The Admin Footer       -   ON
 *
 * */
require_once('inc/functions-remove.php');

/*
 * Theme Customizer                                    -   ON
 */
require_once('customize/functions-customize.php');

/*
 * Breadcrumbs                                          -   ON
 * Cyr to lat                                           -   ON
 */
require_once ('inc/functions-plugins.php');

/*
 * ACF                                          -   ON
 */
require_once ('inc/functions-acf.php');

/*
 * Прописываем путь к форме комментариев    -   ON
 * Enqueue scripts                          -   ON
 * Simple ajax comment form mod             -   ON
 * Disable comment js                       -   ON
 * Comment form                             -   ON
 * Reorder comment fields                   -   ON
 *
 **/
require_once('comments/function-comments.php');

/*
===================================================================
          Custom site background
===================================================================
*/
require_once ('inc/functions-background-image.php');

/*
===================================================================
          Custom site background
===================================================================
*/
require_once ('inc/vendor/Mobile_Detect.php');

/*
===================================================================
          Установим глобальную переменную для Mobile_Detect
===================================================================
*/
function mobileDetectGlobal() {
    global $detect;
    $detect = new Mobile_Detect;
}
add_action('after_setup_theme', 'mobileDetectGlobal');

/*
===================================================================
          Switch default core markup for search form, comment form,
          and comments to output valid HTML5.
===================================================================
*/

add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
));

/*
===================================================================
          Enable support for Post Formats.
===================================================================
*/

add_theme_support('post-formats', array(
    'aside',
    'image',
    'video',
    'quote',
    'link',
    'gallery',
    'status',
    'audio',
    'chat',
));

/*
===================================================================
          Enable support for Page Excerpt.
===================================================================
*/

add_post_type_support( 'page', 'excerpt' );

/*
===================================================================
          Register styles and scripts
===================================================================
*/

function glegrand_scripts()
{
    // Styles
    wp_enqueue_style('style', get_template_directory_uri() . '/style.min.css');

    // Scripts
    wp_enqueue_script('jquery');

    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/scripts.min.js', false, null, true);
}
add_action('wp_enqueue_scripts', 'glegrand_scripts');

/*
===================================================================
          Отключить jQuery Migrate и подключить jQuery через CDN Google
===================================================================
*/
function smt_register_scripts() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js' );
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'googlemaps', 'http://maps.google.com/maps/api/js?sensor=false', array( 'jquery' ), '3' );
    wp_enqueue_script( 'googlemaps' );
}
add_action('init', 'smt_register_scripts');


/*
===================================================================
          Register Nav Menu
===================================================================
*/

register_nav_menus(array(
    'primary' => 'Primary Menu',
    'second' => 'Second Menu',
    'third' => 'Banner Menu'
));

add_filter( 'nav_menu_css_class', 'change_menu_item_css_classes', 10, 4 );

function change_menu_item_css_classes( $classes, $item, $args, $depth ) {
    if ( $args->theme_location === 'third' ) {
        $classes[] = 'three-col';
        $classes[] = 'anim-items';
    } elseif ($args->theme_location === 'second') {
        $classes[] = 'four-col';
        $classes[] = 'anim-items';
    }
    return $classes;
}

/*
===================================================================
          Register sidebar
===================================================================
*/

function glegrand_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'theme_language' ),
        'id' => 'sidebar',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme_language' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ) );
}
add_action( 'widgets_init', 'glegrand_widgets_init' );

/*
===================================================================
          Add thumbnails to Post and Pages
===================================================================
*/

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

/*
===================================================================
          Постраничная навигация
===================================================================
*/
function wp_corenavi() {
    global $wp_query;
    $total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
    $a['total'] = $total;
    $a['mid_size'] = 3; // сколько ссылок показывать слева и справа от текущей
    $a['end_size'] = 1; // сколько ссылок показывать в начале и в конце
    $a['prev_text'] = '&laquo;'; // текст ссылки "Предыдущая страница"
    $a['next_text'] = '&raquo;'; // текст ссылки "Следующая страница"

    if ( $total > 1 ) echo '<nav class="pagination">';
    echo paginate_links( $a );
    if ( $total > 1 ) echo '</nav>';
}

/*
===================================================================
          Shortcode
===================================================================
*/

// Shortcode для вывода номеров телефона
function phone_shortcode(){
    ob_start();
    $bannerPhoneOne = esc_attr( get_option( 'banner_phone_one' ) );
    $bannerPhoneTwo = esc_attr( get_option( 'banner_phone_two' ) );
    $bannerPhoneThree = esc_attr( get_option( 'banner_phone_three' ) );

    return '<div class="phone-number">
            <div class="phone-icon leon leon-call y-text"></div>
            <div class="phone-info">
            <a href="tel:'. $bannerPhoneOne .'">'.  $bannerPhoneOne .'</a><br>
            <a href="tel:'. $bannerPhoneTwo .'">'. $bannerPhoneTwo .'</a><br>
            <a href="tel:'. $bannerPhoneThree .'">'. $bannerPhoneThree .'</a>
            </div>
            </div>
    ';
    ob_end_clean();
}
add_shortcode('shortcode_phone_tag', 'phone_shortcode');

function phone_one_shortcode(){
    $bannerPhoneOne = esc_attr( get_option( 'banner_phone_one' ) );

    return '<a href="tel:'. $bannerPhoneOne .'">'.  $bannerPhoneOne .'</a>';
}
add_shortcode('shortcode_phone_one', 'phone_one_shortcode');

function phone_two_shortcode(){
    $bannerPhoneTwo = esc_attr( get_option( 'banner_phone_two' ) );

    return '<a href="tel:'.  $bannerPhoneTwo .'">'. $bannerPhoneTwo .'</a>';
}
add_shortcode('shortcode_phone_two', 'phone_two_shortcode');

function phone_three_shortcode(){
    $bannerPhoneThree = esc_attr( get_option( 'banner_phone_three' ) );

    return '<a href="tel:'.  $bannerPhoneThree .'">'. $bannerPhoneThree .'</a>';
}
add_shortcode('shortcode_phone_three', 'phone_three_shortcode');

function address_shortcode(){
    $bannerAddress = esc_attr( get_option( 'banner_address' ) );

    return '<span>'. $bannerAddress .'</span>';
}
add_shortcode('shortcode_address', 'address_shortcode');

function address_near_shortcode(){
    $themeAddress = esc_attr( get_option( 'theme_address_near' ) );

    return '<span>'. $themeAddress .'</span>';
}
add_shortcode('shortcode_address_near', 'address_near_shortcode');

function the_address_shortcode(){
    ob_start();
    $bannerAddress = esc_attr( get_option( 'banner_address' ) );
    $themeAddress = esc_attr( get_option( 'theme_address_near' ) );

    return '<div class="address">
            <div class="adress-icon leon leon-pin y-text"></div>
            <div class="address-info">
            <span>'. $bannerAddress .'</span><br>
            <span>'. $themeAddress .'</span>
            </div>
            </div>
    ';
    ob_end_clean();
}
add_shortcode('shortcode_the_address', 'the_address_shortcode');

function mode_shortcode(){
    $bannerMode = esc_attr( get_option( 'banner_mode' ) );
    $clockImage = get_template_directory_uri() . '/assets/images/clock.png';

    return '
        <div class="mode">
        <span class="clock-icon"><img src="'. $clockImage .'" alt=""></span>
        <span>'. $bannerMode .'</span>
        </div>
    ';
}
add_shortcode('shortcode_mode', 'mode_shortcode');

function social_shortcode(){
    $fbSlug = esc_attr( get_option( 'facebook' ) );
    $instaSlug = esc_attr( get_option( 'instagram' ) );
    $fbImage = get_template_directory_uri() . '/assets/images/facebook.png';
    $instaImage = get_template_directory_uri() . '/assets/images/instagram.png';

    return '<div class="social-icon">
    <a target="_blank" href="https://www.facebook.com/'. $fbSlug .'/"><img src="'. $fbImage .'" alt=""></a>
    <a target="_blank" href="https://www.instagram.com/'. $instaSlug .'/"><img src="'. $instaImage .'" alt=""></a>
    </div>';
}
add_shortcode('shortcode_social', 'social_shortcode');

/*
===================================================================
          Подключаем MO файл перевода и указываем ему ID — theme_language:
===================================================================
*/
load_theme_textdomain( 'theme_language', get_template_directory() . '/languages' );

/*
===================================================================
          Выводит родительскую страницу и дочерние
===================================================================
*/
function services_query( $pageID ) { 
    $page = get_post($pageID);
    ?>
    <div class="footer-nav-service-container">
        <h4 class="footer-nav-service-title"><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h4>

        <?php

        $args = array( 
            'child_of' => $pageID,
        );

        $mypages = get_pages( $args );
        
        if( !$mypages ) { ?>
            </div>
        <?php return;
        } 

        foreach( $mypages as $page ) { ?>     
            <li class="footer-nav-service-page-child"><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></li>
        <?php
        } ?>
    </div>
<?php
}