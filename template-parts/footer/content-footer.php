<?php 
$headerLogo = esc_attr( get_option( 'header_logo' ) );
?>

<div class="wrapper">
	<nav class="footer-nav">
		<div class="footer-nav-service">			
			<?php 
				services_query(83);
				services_query(85);
			 ?>		
		</div>
		<div class="footer-nav-service">
			<?php 
				services_query(21);
				services_query(88);
			 ?>	
		</div>
		<div class="footer-nav-service">
			<?php 
				services_query(71);
				services_query(67);
			 ?>	
		</div>
	</nav>

     <div class="footer-logo">
        <a href="<?php echo get_home_url(); ?>" class="logo">
        <?php if( ! ($headerLogo) ) : ?>
            <span class="leon leon-logo"></span>
        <?php else : ?>
            <img id="header-logo" src="<?php echo $headerLogo ?>" alt="<?php _e( 'Логотип', 'theme_language' ); ?>">
        <?php endif ?>
        </a>
    </div>
</div>
