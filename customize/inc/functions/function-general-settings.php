<?php
/* Admin Banner settings and custom fields */
function customize_banner_settings() {
    ///////////////////////////////////////////
    register_setting( 
        'customize-settings-group' , //уникальное имя для хранения информации в базе дынных 
        'header_logo' // slug meta field
    );
    register_setting( 'customize-settings-group' , 'footer_logo' );
    register_setting( 'customize-settings-group' , 'favicon' );
    register_setting( 'customize-settings-group' , 'banner_image' );
    register_setting( 'customize-settings-group' , 'banner_address' );
    register_setting( 'customize-settings-group' , 'theme_address_near' );
    register_setting( 'customize-settings-group' , 'banner_phone_one' );
    register_setting( 'customize-settings-group' , 'banner_phone_two' );
    register_setting( 'customize-settings-group' , 'banner_phone_three' );
    register_setting( 'customize-settings-group' , 'banner_mode' );
    register_setting( 'customize-settings-group' , 'facebook' );
    register_setting( 'customize-settings-group' , 'instagram', 'customize_sanitize_instagram' );

    //////////////////////////////////////////
    add_settings_section(
        'customize-banner-options', // id
        __( 'Внешний вид', 'theme_language' ), // title
        'customize_top_options', // регистрация функции
        'customize_theme'  // page место где выводится форма (SLUG URL страницы)
    );

    //////////////////////////////////////////
    add_settings_field( 
        'favicon', // id
        __( 'Favicon', 'theme_language' ),  // title
        'customize_favicon',  // регистрация функции
        'customize_theme',  // page
        'customize-banner-options'  // section ID
    );
    add_settings_field( 'header-footer-logo', __( 'Логотип сайта', 'theme_language' ), 'customize_header_footer_logo', 'customize_theme', 'customize-banner-options' );
    add_settings_field( 'banner-image', __( 'Картинка банера', 'theme_language' ), 'customize_banner_image', 'customize_theme', 'customize-banner-options' );
    add_settings_field( 'banner-address', __( 'Адрес', 'theme_language' ), 'customize_banner_address', 'customize_theme', 'customize-banner-options' );
    add_settings_field( 'theme-address_near', __( 'Возле Адреса', 'theme_language' ), 'customize_theme_address_near', 'customize_theme', 'customize-banner-options' );
    add_settings_field( 'banner-phone', __( 'Телефон', 'theme_language' ), 'customize_banner_phone', 'customize_theme', 'customize-banner-options' );
    add_settings_field( 'banner-mode', __( 'Режим работы', 'theme_language' ), 'customize_banner_mode', 'customize_theme', 'customize-banner-options' );
    add_settings_field( 'facebook', __( 'Facebook', 'theme_language' ), 'customize_facebook', 'customize_theme', 'customize-banner-options' );
    add_settings_field( 'instagram', __( 'Instagram', 'theme_language' ), 'customize_instagram', 'customize_theme', 'customize-banner-options' );
}

function customize_top_options() {
    echo __( 'Страница редактирования информации в Банере', 'theme_language' );
}

function customize_favicon() {
    $banner = 'favicon';
    $bannerField = esc_attr( get_option( $banner ) );
    $blogName = get_bloginfo( 'name' );

    echo '        
    <input type="button" class="button button-secondary" value="'. __( 'Загрузить favicon', 'theme_language' ) .'" id="upload-favicon-button">
    <input type="hidden" id="value-favicon" name="'. $banner .'" value="'. $bannerField .'" />
    <div class="favicon">
        <img id="favicon" src="'. $bannerField .'" alt="Favicon">
        <span class="fav-site-name">'. $blogName .'</span>
        <a href="#" class="cross"></a>
    </div>
    <hr>
    '; // name = SLUG meta field
}

function customize_header_footer_logo() {
    $headerLogo = 'header_logo';
    $headerLogoField = esc_attr( get_option( $headerLogo ) );
    $footerLogo = 'footer_logo';
    $footerLogoField = esc_attr( get_option( $headerLogo ) );

    function showLogo( $logo ) {
        if( ! $logo ) {
            return '<span class="leon leon-logo"></span>';
        } else {
            return '<img id="logo" src="'. $logo .'" alt="Logo">';
        }
    }

    echo '
    <input type="button" class="button button-secondary" value="'. __( 'Загрузить Логотип шапки', 'theme_language' ) .'" id="upload-header-logo-button">
    <input type="hidden" id="value-header-logo" name="'. $headerLogo .'" value="'. $headerLogoField .'" />
    <div class="logo">
        '. showLogo($headerLogoField) .'
    </div>
    '; // name = SLUG meta field
    echo '
    <input type="button" class="button button-secondary" value="'. __( 'Загрузить Логотип подвала', 'theme_language' ) .'" id="upload-footer-logo-button">
    <input type="hidden" id="value-footer-logo" name="'. $footerLogo .'" value="'. $footerLogoField .'" />
    <div class="logo">
        '. showLogo($footerLogoField) .'
    </div>
    '; // name = SLUG meta field
}

function customize_banner_image () {
    $banner = 'banner_image';
    $bannerField = esc_attr( get_option( $banner ) );

    function showBanner( $picture ) {
        if( ! $picture ) {
            return '<img id="banner-picture" loading="lazy" src="'. get_template_directory_uri(). '/assets/images/1-3.jpg' .'" alt="Leon">';
        } else {
            return '<img id="banner-picture"  src="'. $picture .'" alt="Leon">';
        }
    }

    echo '
    <input type="button" class="button button-secondary" value="'. __( 'Загрузить картинку', 'theme_language' ) .'" id="upload-button">
    <input type="hidden" id="banner-image" name="'. $banner .'" value="'. $bannerField .'" />

    <div class="banner">
        '. showBanner( $bannerField ) .'
    </div>
    '; // name = SLUG meta field
}

function customize_banner_address () {
    $banner = 'banner_address';
    $bannerField = esc_attr( get_option( $banner ) );
    echo '<input type="text" id="banner-input-address" name="'. $banner .'" value="'. $bannerField .'" placeholder="'.__( 'Адрес', 'theme_language' ).'" />'; // name = SLUG meta field
}

function customize_theme_address_near () {
    $banner = 'theme_address_near';
    $bannerField = esc_attr( get_option( $banner ) );
    echo '<input type="text" id="banner-input-address" name="'. $banner .'" value="'. $bannerField .'" placeholder="'.__( 'метро Дружбы Народов', 'theme_language' ).'" />'; // name = SLUG meta field
}

function customize_banner_phone () {
    $bannerPhoneOne = 'banner_phone_one';
    $bannerPhoneTwo = 'banner_phone_two';
    $bannerPhoneThree = 'banner_phone_three';
    $bannerPhoneOneField = esc_attr( get_option( $bannerPhoneOne ) );
    $bannerPhoneTwoField = esc_attr( get_option( $bannerPhoneTwo ) );
    $bannerPhoneThreeField = esc_attr( get_option( $bannerPhoneThree ) );
    echo '
    <input type="text" id="banner-input-phone-one" name="'. $bannerPhoneOne .'" value="'. $bannerPhoneOneField .'" placeholder="'.__( 'Номер телефона', 'theme_language' ).'" />
    <input type="text" id="banner-input-phone-two" name="'. $bannerPhoneTwo .'" value="'. $bannerPhoneTwoField .'" placeholder="'.__( 'Номер телефона', 'theme_language' ).'" />
    <input type="text" id="banner-input-phone-two" name="'. $bannerPhoneThree .'" value="'. $bannerPhoneThreeField .'" placeholder="'.__( 'Номер телефона', 'theme_language' ).'" />
    '; // name = SLUG meta field
}

function customize_banner_mode () {
    $banner = 'banner_mode';
    $bannerField = esc_attr( get_option( $banner ) );
    echo '<input type="text" id="banner-input-mode" name="'. $banner .'" value="'. $bannerField .'" placeholder="'.__( 'Режим работы', 'theme_language' ).'" />'; // name = SLUG meta field
}

function customize_theme_create_page () {
    // Генерация Админ Страницы
    require_once('admin/admin-settings.php');
}

function customize_facebook() {
    $footer = 'facebook';
    $footerField = esc_attr( get_option( $footer ) );
    echo '<input type="text" name="'. $footer .'" value="'. $footerField .'" placeholder="'.__( 'Facebook', 'theme_language' ).'" />'; // name = SLUG meta field
}

function customize_instagram() {
    $footer = 'instagram';
    $footerField = esc_attr( get_option( $footer ) );
    echo '<input type="text" name="'. $footer .'" value="'. $footerField .'" placeholder="'.__( 'Instagram', 'theme_language' ).'" />'; // name = SLUG meta field
}

// Sanitization settings
function customize_sanitize_instagram( $input ) {
    $output = sanitize_text_field($input);
    $output = str_replace('@', '', $output);
    return $output;
}
