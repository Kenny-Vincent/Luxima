<?php

 /**
 * Shortcode attributes
 * @var $atts
 * @var $testimon
 * Shortcode class
 * @var  WPBakeryShortCode_Single_Testionial
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


		$output = ''; 

        $output = '<div class="wpb_content_element">';

        if(!isset($testimon))

        $testimon = 0;          

        $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'testimonial', 'p' => $testimon );                          

        $loop = new WP_Query($query_post);

        if($loop->have_posts()){

            while($loop->have_posts()){

                $loop->the_post();  

                            $output .= '<div class="single_testimonial"><dl class="dl-horizontal"><dt><img src="'.esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'thumbnail', 'url')).'" alt="'.esc_attr__('Testimonial Image', 'specular').'"></dt><dd>';

                            $output .= '<p>'.get_the_content().'</p>';

                            $output .= '<div class="param">';

                            $output .= '<h6>'.esc_html(get_the_title()).', </h6><span class="position"> '.esc_attr(codeless_get_mod('staff_position')).'</span>';

                            $output .= '</div>';

                            $output .= '</dd></dl></div>';
            }

        }

        wp_reset_query();

        $output .= '</div>';

        echo codeless_complex_esc($output);

?>