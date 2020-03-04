<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $image
 * @var $video
 * @var $alignment
 * @var $width
 * @var $animation
 * @var $link
 * Shortcode class
 * @var  WPBakeryShortCode_Media
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$extra_classes = '';

if( $shadow )
    $extra_classes .= 'with_shadow';
if( $rounded_left )
    $extra_classes .= ' rounded_left_corners';
if( $rounded_right )
    $extra_classes .= ' rounded_right_corners';
    $width_style="";
    
    if($alignment == 'center')
        $width_style = 'style="width:'. (int) $width.'px;position:relative; left:50%; margin-left:-'.( (int) $width/2).'px;" ';

		$output = '<div class="wpb_content_element media_align_'.$alignment.' media media_el animate_onoffset '.$extra_classes.'">';
        
        if($type == 'image'){
            $output .= '<div class="media_wrapper" '.$width_style.'>';
            if(isset($image)){
            	if(!empty($image)) {
						  
	                if(strpos($image, "http://") !== false){
	                    $image = $image;
	                } else {
	                    $bg_image_src = wp_get_attachment_image_src($image, 'full');
	                    $image = $bg_image_src[0];
                        if(empty($image))
                            $image = codeless_img_placeholder();
	                }

	               // $alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
	                $alt = esc_attr__( 'Alt Text', 'specular' );
	            }

                if($link!="#" && $link!="")
                $output .= '<a href="'.$link.'" target="_blank"><img src="'.esc_url($image).'" alt="'.esc_attr__('Media', 'specular').'" class="type_image animated fadeIn'.esc_attr($animation).' alignment_'.esc_attr($alignment).'" /></a>';
                else
                $output .= '<img src="'.esc_url($image).'" alt="'.$alt.'" class="type_image animated fadeIn'.esc_attr($animation).' alignment_'.esc_attr($alignment).'" />';
                
            }
            $output .= '</div>';
        }

        if($type == 'video'){
            $output .= '<div class="video_embeded" '.$width_style.'>';
            if(isset($video)){
                global $wp_embed;
                $output .= $wp_embed->run_shortcode('[embed class="animation_'.$animation.' video alignment_'.$alignment.' '.$width_style.'"]'.trim($video).'[/embed]');
            }
            $output .= '</div>';
        }
        
        $output .= '</div>';
        echo codeless_complex_esc($output); 
?>