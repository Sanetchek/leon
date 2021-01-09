<?php 
$headerLogo = esc_attr( get_option( 'header_logo' ) );
$address = esc_attr( get_option( 'banner_address' ) );
$phoneOne = esc_attr( get_option( 'banner_phone_one' ) );
$phoneTwo = esc_attr( get_option( 'banner_phone_two' ) );
$phoneThree = esc_attr( get_option( 'banner_phone_three' ) );
?>

<header id="header">
    <?php get_template_part( 'template-parts/page/content', 'banner' ); ?>

    <div class="header-info">
        <div class="wrapper">
            <div class="left header-log-height">
                <a href="<?php echo get_home_url(); ?>" class="logo">
                <?php if( ! ($headerLogo) ) : ?>
                    <span class="leon leon-logo anim-items anim-left"></span>
                <?php else : ?>
                    <img id="header-logo" class="anim-items anim-left" src="<?php echo $headerLogo ?>" alt="<?php _e( 'Логотип', 'theme_language' ); ?>">
                <?php endif ?>
                </a>
            </div>
            <div class="right">
                <div class="header-address anim-items anim-right"><?php _e( $address, 'glegrandsale' ) ?><span class="icon-lr leon leon-pin"></span></div>
                <div class="header-phone anim-items anim-right anim-delay-03">
                    <a class="header-phone-one" href="tel:<?php echo $phoneOne ?>"><?php echo $phoneOne ?></a><span class="icon-lr leon leon-call"></span><br>
                    <a class="header-phone-two" href="tel:<?php echo $phoneTwo ?>"><?php echo $phoneTwo ?></a><span class="icon-lr leon leon-call"></span><br>
                    <a class="header-phone-two" href="tel:<?php echo $phoneThree ?>"><?php echo $phoneThree ?></a><span class="icon-lr leon leon-call"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="header-nav">
        <?php
        wp_nav_menu( [
            'theme_location'  => 'primary',
            'container'       => 'nav',
            'container_class' => 'main-menu',
            'echo'            => true,
            'fallback_cb'     => '',
            'before'          => '',
            'after'           => '<span class="und-line"></span>',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="top-menu">%3$s</ul>',
            'depth'           => 0,
            'walker'          => '',
        ] );
        ?>
        <div id="burger-menu" class="burger-menu">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </div>    

</header>
