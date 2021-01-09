<?php
$bannerImage = esc_attr( get_option( 'banner_image' ) );
$attachment_id = attachment_url_to_postid( $bannerImage );
?>

<div class="banner">
    <?php if( ! ($bannerImage) ) : ?>
        <img src="<?php echo get_template_directory_uri(). '/assets/images/banner-img.jpg' ?>" alt="<?php _e( 'Salon Leon', 'theme_language' ); ?>">
    <?php else : ?>
        <img src="<?php wp_get_attachment_image_url( $attachment_id, 'full' )   ?>" srcset="<?php echo wp_get_attachment_image_srcset( $attachment_id, 'full' ) ?>"
        sizes="<?php echo wp_get_attachment_image_sizes( $attachment_id, 'full' ) ?>" alt="<?php _e( 'Salon Leon', 'theme_language' ); ?>">
    <?php endif ?>
</div>

