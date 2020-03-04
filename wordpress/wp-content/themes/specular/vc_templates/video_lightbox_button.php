<?php

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$extra_class = '';

if( $image ){
    $bg_image_src = wp_get_attachment_image_src($image, 'full');
    $image = $bg_image_src[0];
    $extra_class = 'with-image';
}



?>

<div class="video_lightbox_button wpb_content_element <?php echo esc_attr( $extra_class ) ?>">
    <?php if( $image ): ?>
        <img src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr__('Placeholder', 'specular') ?>" />
    <?php endif; ?>
    <a href="<?php echo esc_url( $link ) ?>" class="lightbox"><i class="moon-play-4"></i></a>
</div>