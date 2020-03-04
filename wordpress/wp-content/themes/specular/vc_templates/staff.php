<?php   
/**
 * Shortcode attributes
 * @var $atts
 * @var $staff
 * @var $staff_position
 * @var $style
 * Shortcode class
 * @var  WPBakeryShortCode_Staff
 */



$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


        $output = '';
        if(isset($staff)){
        $output .= '<div class="wpb_content_element">';
       
        $query_post = array( 'p' => $staff, 'posts_per_page'=>1, 'post_type'=> 'staff' );
        $additional_loop = new WP_Query($query_post);
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                
                $content = get_the_content();
                 
                 
                $featured = codeless_image_by_id(get_post_thumbnail_id(), 'staff', 'url');
                $position = codeless_get_mod('staff_position');
                $output .= '<div class="single_staff '.esc_attr($style).'">';
                            $output .= '<div class="he-wrap tpl2">';
                                $output .= '<div class="featured_img">';
                                
                                    $output .= '<img src="'.esc_url($featured).'" alt="'.esc_attr__('Team Image', 'specular').'">';
                                    if($style == 'style_1'):
                                        $output .= '<div class="overlay he-view">';
                                            $output .= '<div class="bg a0" data-animate="fadeIn">';
                                                $output .= '<div class="center-bar">';

                                                    if(codeless_get_mod('facebook_link') != '')
                                                        $output .= '<a href="'.esc_url(codeless_get_mod('facebook_link')).'" class="a1" data-animate="fadeInUp" title="Facebook"><i class="moon-facebook"></i></a>';
                                                    if(codeless_get_mod('twitter_link') != '')
                                                        $output .= '<a href="'.esc_url(codeless_get_mod('twitter_link')).'" class="a1" data-animate="fadeInUp" title="Twitter"><i class="moon-twitter"></i></a>';
                                                    if(codeless_get_mod('google_link') != '')
                                                        $output .= '<a href="'.esc_url(codeless_get_mod('google_link')).'" class="a1" data-animate="fadeInUp" title="Google Plus"><i class="moon-google_plus"></i></a>';
                                                    if(codeless_get_mod('pinterest_link') != '')
                                                        $output .= '<a href="'.esc_url(codeless_get_mod('pinterest_link')).'" class="a1" data-animate="fadeInUp" title="pinterest"><i class="moon-pinterest"></i></a>';
                                                    if(codeless_get_mod('linkedin_link') != '')
                                                        $output .= '<a href="'.esc_url(codeless_get_mod('linkedin_link')).'" class="a1" data-animate="fadeInUp" title="linkedin"><i class="moon-linkedin"></i></a>';
                                                    if(codeless_get_mod('instagram_link') != '')
                                                        $output .= '<a href="'.esc_url(codeless_get_mod('instagram_link')).'" class="a1" data-animate="fadeInUp" title="instagram"><i class="moon-instagram"></i></a>';
                                                    if(codeless_get_mod('mail_link')!= '')
                                                        $output .= '<a href="'.esc_url(codeless_get_mod('mail_link')).'" class="a1" data-animate="fadeInUp" title="mail"><i class="moon-mail"></i></a>';
                                                  
                                                $output .= '</div>';
                                            $output .= '</div>';
                                        $output .= '</div>';
                                    endif;
                                $output .= '</div>';
                            
				
                            $output .= '<div class="content">';
                                $output .= '<h5>';
                                if( codeless_get_mod('staff_link') )
                                    $output .= '<a href="'.esc_url( codeless_get_mod('staff_link') ).'">';

                                    $output .= esc_html(get_the_title());

                                if( codeless_get_mod('staff_link') )    
                                    $output .= '</a>';

                                $output .= '</h5>';
                                $output .= '<span class="position">'.esc_attr($position).'</span>';
                            	$output .= '<p>'.codeless_text_limit(get_the_excerpt(), 25).'</p>';
                            $output .= '</div>';

                            $output .= "</div>";

                 $output .= '</div>';
                
            }
            
        }
        
        $output .= '</div>';
        wp_reset_query();
        }
    
        echo codeless_complex_esc($output);
?>