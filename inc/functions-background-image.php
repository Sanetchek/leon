<?php

/*
   ===================================================================
               Подключаем интерфейс для картинок и цвета на задний фон
                сайта в админке (Внешний вид => Фон)
   ===================================================================

*/
add_theme_support( 'custom-background' );

function true_custom_background_support(){
    add_theme_support( 'custom-background' );
}

add_action('after_setup_theme', 'true_custom_background_support');

$defaults = array(
    'default-image'          => '', // без изображения
    'default-repeat'         => 'repeat', // повторять
    'default-position-x'     => 'left', // выровнять по левому краю
    'default-attachment'     => 'scroll', // фон прокручивается со страницей
    'default-color'          => '', // без цвета
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
);
add_theme_support( 'custom-background', $defaults );

$defaults = array(
    'default-color'          => '',
    'default-image'          => '',
    'default-repeat'         => '',
    'default-position-x'     => '',
    'default-attachment'     => ''
);
add_theme_support( 'custom-background', $defaults );
