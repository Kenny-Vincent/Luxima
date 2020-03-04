<?php


class CodelessSlider {

	private $slider_id;
	private $height;

	var $output = array();

	function __construct($slider_id) {
		$s = 0;
		
		$s = get_term_by('id', $slider_id, 'slider');
		
		if($s != false && $s->count > 0 && $s->taxonomy == 'slider' && (int) $slider_id != 0){
			$this->slider_id = $slider_id;
			$this->createSlider();
			$this->getAllSlides();
			$this->closeSlider();
		}else{
			$this->default_func();
		}
	}

	function createSlider(){
		if( codeless_get_mod('codeless_slider_height') != '100%' )
			$height = codeless_get_mod('codeless_slider_height');
		elseif( codeless_get_mod('codeless_slider_height') == '' )
			$height = '450';
		else
			$height = 'fullscreen'; 

		$this->height = $height;

		$speed = 800;

		$extra_class = '';
		if(codeless_get_mod('slider_parallax')) 
			$extra_class .= ' parallax_slider';

		$output = '<div class="codeless_slider_swiper '.esc_attr($extra_class).'" style="'.(($height == 'fullscreen')?'':'height:'.$height.'px').'">';
		
			$output .= '<div class="loading"><i class="moon-spinner icon-spin"></i></div>';
			$output .= '<div class="codeless_slider_wrapper" data-start="transform: translateY(0px);" data-'.(($height == 'fullscreen')?'1440':$height).'="transform: translateY(-500px);">';
				$output .= '<div class="codeless-slider-container swiper-parent swiper_slider codeless_slider"  data-speed="'.$speed.'"  data-slidenumber="1" data-height="'.esc_attr($height).'">';
                	$output .= '<div class="pagination-parent nav-thumbflip nav-slider">
                					<a class="prev" href="">
										<span class="icon-wrap"><i class="icon-angle-left"></i></span>
										<div class="text">'.esc_html__('PREV','specular').'</div>
									</a>
									<a class="next" href="">
										<span class="icon-wrap"><i class="icon-angle-right"></i></span>
										<div class="text">'.esc_html__('NEXT','specular').'</div>
									</a>
								</div>';
			        $output .= '<div class="swiper-wrapper">';
 
        $this->output[] = $output;
	}

	function closeSlider(){
		global $output;
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>'; 
        $this->output[] = $output; 
	}

	function getAllSlides(){
		$term = get_term($this->slider_id, 'slider');
		query_posts(array(
	        'post_type' => 'slide',
			'slider' => $term->slug,
			'posts_per_page' => -1
	    ));

	    if (have_posts()) :

    		while (have_posts()) : the_post();

    			$id = get_the_ID();
    			$title = get_the_title();

    			$this->output[] = $this->renderSlide();

    		endwhile;

    	endif;

    	wp_reset_query();

	}

	function renderSlide(){

		$extra_style = $extra_class = ' ';
		if(codeless_get_mod('slide_background_type') == 'image'){ 
			$extra_style .= $this->createBackgroundStyle(); 
		} 

		$title_style = $this->createTitleStyle();
		$description_style = $this->createDescriptionStyle();
		$image_style = $this->createImageStyle();
		$content_position = $this->contentPosition(); 
		

		$output = '<div class="swiper-slide" style="'.$extra_style.'" data-color="'.esc_attr(codeless_get_mod('slider_menu_nav_colors')).'">';

			$custom_font_link = add_query_arg( array(
				'family' => str_replace( '%2B', '+', urlencode( implode( '|', array( codeless_get_mod('slide_title_style', 'font-family').':100,200,300,400,500,600,700,800' ) ) ) )
			), 'https://fonts.googleapis.com/css' );
	
			wp_enqueue_style( 'codeless-slide-font', $custom_font_link  );

			if( !codeless_get_mod('remove_container') )
			$output .= '<div class="container">';  
				$output .= '<div class="content '.esc_attr($content_position['class']).'" style="'.$content_position['style'].'" data-start="opacity:1;" data-'.(( (int) $this->height == 'fullscreen')?'1000': (int)$this->height-200).'="opacity: 0;">'; 
					
					if(codeless_get_mod('slide_image_switch'))
						$output .= '<img style="'.$image_style.'" src="'.codeless_get_mod('slide_image_top', 'url').'" alt="'.esc_attr__('Slider Image','specular').'" class="'.codeless_get_mod('slide_image_alignment').'" />';

					$output .= '<h1 class="animated with_animation" data-maxfont="'.esc_attr(codeless_get_mod('slide_title_style', 'font-size')).'" data-animation="'.esc_attr(codeless_get_mod('slide_title_animation')).'" style="'.$title_style.'">'.codeless_get_mod('slide_title').'</h1>';
					if(codeless_get_mod('slide_description'))
						$output .= '<p class="animated with_animation" data-maxfont="'.esc_attr(codeless_get_mod('slide_description_style', 'font-size')).'" data-animation="'.esc_attr(codeless_get_mod('slide_description_animation')).'"  style="'.$description_style.'">'.codeless_get_mod('slide_description').'</p>';
					if(codeless_get_mod('slide_button1') || codeless_get_mod('slide_button2') ):
						$output .= '<div class="buttons animated with_animation colors-'.esc_attr(codeless_get_mod('slide_buttons_colors')).' align-'.esc_attr(codeless_get_mod('slide_description_style', 'text-align')).'" data-animation="fadeIn">';
							if( codeless_get_mod('slide_button1'))
								$output .= '<a class="btn-bt '.esc_attr(codeless_get_mod('overall_button_style', 0)).' '.esc_attr(codeless_get_mod('slide_button1_style')).'" href="'.esc_url(codeless_get_mod('slide_button1_link')).'"><span>'.codeless_get_mod('slide_button1').'</span><i class="moon-arrow-right-5"></i></a>';
							if( codeless_get_mod('slide_button2'))
								$output .= '<a class="btn-bt '.esc_attr(codeless_get_mod('overall_button_style', 0)).' '.esc_attr(codeless_get_mod('slide_button2_style')).'" href="'.esc_url(codeless_get_mod('slide_button2_link')).'"><span>'.codeless_get_mod('slide_button2').'</span><i class="moon-arrow-right-5"></i></a>';
						$output .= '</div>';
					endif;
				$output .= '</div>';
			if( !codeless_get_mod('remove_container'))
			$output .= '</div>';

			if(codeless_get_mod('slide_background_type') == 'video')
				$output .= $this->createVideoMarkup();
			if( codeless_get_mod('slide_bg_overlay'))
				$output .= '<div class="bg-overlay" style="background:'.esc_attr(codeless_get_mod('slide_bg_overlay', 'color')).'; opacity:'.esc_attr(codeless_get_mod('slide_bg_overlay', 'alpha')).';"></div>';

		$output .= '</div>';

		return $output;
	}

	function createBackgroundStyle(){
	
		$extra_style = '';
		foreach(codeless_get_mod('slide_background_image') as $key => $value){
			if($key != 'media' && $key != 'background-image')
				$extra_style .= ' '. $key . ': '.$value.'; ';
		}

		if( codeless_get_mod('slide_background_image', 'background-image')) {
			$extra_style .= " background-image: url('".esc_url(codeless_get_mod('slide_background_image', 'background-image'))."'); ";
		}

		return $extra_style;
	}

	function createTitleStyle(){
	

		$title_style = ' font-family: '. esc_attr(codeless_get_mod('slide_title_style', 'font-family')).'; ';
		$title_style .= ' font-weight: '. esc_attr(codeless_get_mod('slide_title_style', 'font-weight')).'; ';
		$title_style .= ' font-size: '. esc_attr(codeless_get_mod('slide_title_style', 'font-size')).'; ';
		$title_style .= ' text-align: '. esc_attr(codeless_get_mod('slide_title_style', 'text-align')).'; ';
		$title_style .= ' line-height: '. esc_attr(codeless_get_mod('slide_title_style', 'line-height')).'; ';
		$title_style .= ' letter-spacing: '.esc_attr(codeless_get_mod('slide_title_style', 'letter-spacing')).'; ';
		$title_style .= ' text-transform: '. esc_attr(codeless_get_mod('slide_title_style', 'text-transform')).'; ';
		$title_style .= ' color: '. esc_attr(codeless_get_mod('slide_title_style', 'color')).'; '; 
		$title_style .= ' background-color: '.(is_array(codeless_get_mod('slide_title_bg'))?'rgba('.implode(',', codeless_hexToRgb(codeless_get_mod('slide_title_bg', 'color'))).', '.codeless_get_mod('slide_title_bg', 'alpha').')':codeless_get_mod('slide_title_bg') ).'; ';
		$title_style .= ' padding-left: '. esc_attr(codeless_get_mod('slide_title_padding', 'padding-left')).'; '; 
		$title_style .= ' padding-right: '. esc_attr(codeless_get_mod('slide_title_padding', 'padding-right')).'; ';
		$title_style .= ' padding-top: '. esc_attr(codeless_get_mod('slide_title_padding', 'padding-top')).'; '; 
		$title_style .= ' padding-bottom: '. esc_attr(codeless_get_mod('slide_title_padding', 'padding-bottom')).'; '; 
		return $title_style;
	}

	function createDescriptionStyle(){
		
		
		$title_style = ' font-family: '. esc_attr(codeless_get_mod('slide_description_style', 'font-family')).'; ';
		$title_style .= ' font-weight: '. esc_attr(codeless_get_mod('slide_description_style', 'font-weight')).'; ';
		$title_style .= ' font-size: '. esc_attr(codeless_get_mod('slide_description_style', 'font-size')).'; ';
		$title_style .= ' text-align: '. esc_attr(codeless_get_mod('slide_description_style', 'text-align')).'; ';
		$title_style .= ' line-height: '. esc_attr(codeless_get_mod('slide_description_style', 'line-height')).'; ';
		$title_style .= ' text-transform: '. esc_attr(codeless_get_mod('slide_description_style', 'text-transform')).'; ';
		$title_style .= ' color: '. esc_attr(codeless_get_mod('slide_description_style', 'color')).'; ';

		return $title_style;
	}

	function createImageStyle(){
	
		
		$image_style = ' width: '. esc_attr(codeless_get_mod('slide_image_dimension', 'Width')).'; ';
		$image_style .= ' height: '. esc_attr(codeless_get_mod('slide_image_dimension', 'Height')).'; ';

		return $image_style;
	}

	function contentPosition(){
	

		$extra = array();
		$extra['style'] = '';
		$extra['class'] = '';

		if(codeless_get_mod('slide_content_position') == 'none'){
			$extra['style'] = 'position:absolute; top:'.esc_attr(codeless_get_mod('slide_content_position_absolute', 'top')).'; ';
			$extra['style'] .= 'left:'.esc_attr(codeless_get_mod('slide_content_position_absolute', 'left')).'; ';
			$extra['style'] .= 'right:'.esc_attr(codeless_get_mod('slide_content_position_absolute', 'right')).'; ';
			$extra['style'] .= 'bottom:'.esc_attr(codeless_get_mod('slide_content_position_absolute', 'bottom')).'; ';
		}

		if(codeless_get_mod('slide_content_position') == 'vertical_centered'){
			$extra['class'] = ' vertical_centered ';
			$extra['style'] .= ' position:absolute;left:'.esc_attr(codeless_get_mod('slide_content_position_absolute', 'left')).'; ';
			$extra['style'] .= ' right:'.esc_attr(codeless_get_mod('slide_content_position_absolute', 'right')).'; ';
		}

		if(codeless_get_mod('slide_content_position') == 'horizontal_centered'){
			$extra['class'] = ' horizontal_centered ';
			$extra['style'] .= ' top:'.esc_attr(codeless_get_mod('slide_content_position_absolute', 'top')).'; ';
			$extra['style'] .= ' bottom:'.esc_attr(codeless_get_mod('slide_content_position_absolute', 'bottom')).'; ';
		}

		$width = 'auto';

		if(strpos(codeless_get_mod('slide_content_width'), 'px' ) !== false )
			$width = substr(codeless_get_mod('slide_content_width'), 0, -2);

		if(codeless_get_mod('slide_content_position') == 'in_middle'){
			$extra['class'] = ' vertical_centered ';
			$extra['style'] .= 'position:absolute; left:50%; margin-left: -'.($width/2).'px; ';
		}

		$extra['style'] .= ' width:'.esc_attr(codeless_get_mod('slide_content_width')).'; ';

		return $extra;
	}

	function createVideoMarkup(){

		$video_markup = '<div class="video-wrap">';
		$extra_mobile_cl = '';
			if( codeless_get_mod('slide_mobile_video', 'url') ):
				$video_markup .= '<span class="video_replace_mobile" style="background-image:url('.esc_url(codeless_get_mod('slide_mobile_video', 'url')).' );"></span>';
				$extra_mobile_cl = 'remove_on_mobile';
			endif;
			$video_markup .= '<video class="'.$extra_mobile_cl.'" id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0"> ';
				
				if( codeless_get_mod('slide_webm_video') )
	        		$video_markup .= '<source src="'.esc_url(codeless_get_mod('slide_webm_video')).'" type="video/webm">'; 
	            
	            if( codeless_get_mod('slide_mp4_video') )
	            	$video_markup .= '<source src="'.esc_url(codeless_get_mod('slide_mp4_video')).'" type="video/mp4">';
	            
	            if( codeless_get_mod('slide_ogg_video') )
	            	$video_markup .= '<source src="'.esc_url(codeless_get_mod('slide_ogg_video')).'" type="video/ogg">';  

	            $video_markup .= 'Video not supported';
	        $video_markup .= '</video>';
        $video_markup .= '</div>';

        return $video_markup;
	}

	function default_func(){
		$output = '<div class="default">Please select a Codeless Slider before. Click Edit Page -> Slider Options (at the bottom of page options)</div>';
		$this->output[] = $output;
	}

	function output(){
		echo implode("\n\n", $this->output);
	}

}

?>