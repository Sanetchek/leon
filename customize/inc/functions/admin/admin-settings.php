<h1><?php _e('Настройка темы', 'theme_language'); ?></h1>

<form method="post" action="options.php">
    <?php settings_fields( 'customize-settings-group' ); // function-admin-menu => function customize_theme_settings() ?>
    <?php do_settings_sections( 'customize_theme' ); //имя страницы на которой выводим поля ?>
    <?php submit_button(); ?>
</form>
