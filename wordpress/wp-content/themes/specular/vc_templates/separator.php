<?php
 /**
 * Shortcode attributes
 * @var $atts
 * @var $width
 * @var $height
 * @var $color
 * @var $margin_top
 * @var $margin_bottom
 * @var $position
 * Shortcode class
 * @var  WPBakeryShortCode_Separator
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


    $style = $wrapper_style = '';
    if($width != '')
        $style .= ' width:'.esc_attr($width).'; ';
    if($height != '')
        $wrapper_style .= ' height:'.esc_attr($height).'; ';
    if($color != '')
        $style .= ' background:'.esc_attr($color).'; ';
    if($margin_top != '')
        $wrapper_style .= ' margin-top:'.esc_attr($margin_top).'; ';
    if($margin_bottom != '')
        $wrapper_style .= ' margin-bottom:'.esc_attr($margin_bottom).'; ';

    if($position == 'left') 
        $style .= ' left:0; height:100%; position:absolute;';

    if($position == 'right')
        $style .= ' right:0; height:100%;position:absolute;';

    if($position == 'center' && $width != ''){
        $style .= ' left:50%;height:100%; margin-left: -'. ((int) substr($width, 0, -2) / 2 ).'px;position: absolute;';
    }
    $output = '<div class="codeless_separator" style="'.$wrapper_style.'"><span class="separator" style="'.$style.'"></span></div>';

    echo codeless_complex_esc($output);
?>