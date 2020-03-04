<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $desc
 * @var $style
 * Shortcode class
 * @var  WPBakeryShortCode_List_Item
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
	

        $output = '<li class="'.esc_attr($style).'">';
        	if($style == 'simple'){
				$output .= '<i class=""></i>';
				if( isset( $link ) && !empty( $link ) )
					$output .= '<a href="'.esc_url( $link ).'">';
				$output .= esc_html($title);
				if( isset( $link ) && !empty( $link ) )
					$output .= '</a>';	
        	}else{
        		$output .= '<dl class="dl-horizontal">';
        			$output .= '<dt><span class="circle"><i class=""></i></span></dt>';
					$output .= '<dd>';
					
					$output .= '<h6>';
					if( isset( $link ) && !empty( $link ) )
						$output .= '<a href="'.esc_url( $link ).'">';	
					$output .= esc_html($title);
					if( isset( $link ) && !empty( $link ) )
						$output .= '</a>';	
					$output .= '</h6>';
					$output .= '<p>'.$desc.'</p>';
					
					$output .= '</dd>';
        		$output .= '</dl>';
        	}
        	
        $output .= '</li>';

        echo codeless_complex_esc($output);

?>