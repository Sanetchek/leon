<?php
/*
===================================================================
          Add Customize Menu
===================================================================
*/
function customize_add_admin_page () {
    $siteName = strval( get_bloginfo( 'name' ) );
    // Создаем меню в админке
    add_menu_page( __('Пользовательские Настройки Темы', 'theme_language'), // Текст, который будет использован в теге title на странице.
        __( $siteName , 'theme_language'), // Название пункта в меню
        'manage_options', // Уровень доступа пользователя
        'customize_theme', // SLUG URL страницы (должно быть уникальным)
        'customize_theme_create_page', //  регистрация функции
        'dashicons-money', // иконка для меню (get_template_directory_uri(). '/img/icon.png' ) или dashicon wp
        '3' // позиция меню, по умолчанию в самый конец.
    );

    // Создаем подменю
    add_submenu_page (
        'customize_theme', // SLUG главной страницы
        __( 'Пользовательские Настройки Темы', 'theme_language' ), //тег title на странице,
        __( 'Настройка', 'theme_language' ), // Название пункта в меню
        'manage_options', // Уровень доступа пользователя
        'customize_theme', // SLUG URL страницы (должно быть уникальным)
        'customize_theme_create_page' //  регистрация функции
    );

    // Включить пользовательские настройки
    add_action( 'admin_init', 'customize_banner_settings' );
}
add_action( 'admin_menu', 'customize_add_admin_page' );

/*
===================================================================
          Add thumbnails to Post and Pages
===================================================================
*/

add_theme_support( 'post-thumbnails', array( 'customize-gallery' ) );

require_once( 'functions/function-general-settings.php' );
