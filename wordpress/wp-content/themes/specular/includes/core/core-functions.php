<?php

if(!function_exists('codeless_get_post_id')){
    /**
     * codeless_get_post_id()
     * 
     * @return
     */
    function codeless_get_post_id() 
    {
		global $codeless_config, $for_online;
		$ID = false;
		
		if(!isset($codeless_config['real_ID']))
		{
			if(!empty($codeless_config['new_query']['page_id'])) 
			{ 
				$ID = $codeless_config['new_query']['page_id']; 
			}
			else
			{
				$ID = @get_the_ID();
			}
			
			$codeless_config['real_ID'] = $ID;
		}
		else
		{
			$ID = $codeless_config['real_ID'];
		}

		if(class_exists('woocommerce') && is_shop()){
			$ID = get_option('woocommerce_shop_page_id');
		}

		if(codeless_current_view() == 'blog' && !isset($for_online) )
			$ID = codeless_get_mod('blogpage');

		if( function_exists('is_product_category') && ( is_product_category() || is_product_tag() ) )
			$ID = 0;

		return $ID; 
	}
	
	add_action('wp_head', 'codeless_get_post_id');
}


if(!function_exists('codeless_image_by_id'))
{

	/**
	 * codeless_image_by_id()
	 * 
	 * @param mixed $thumbnail_id
	 * @param mixed $size
	 * @param string $output
	 * @param string $data
	 * @return
	 */
	function codeless_image_by_id($thumbnail_id, $size = array('width'=>800,'height'=>800), $output = 'image', $data = "")
	{	
		if(!is_numeric($thumbnail_id)) return false;


		
		if(is_array($size)) 
		{
			$size[0] = $size['width'];
			$size[1] = $size['height'];
		}

		$image_src = wp_get_attachment_image_src($thumbnail_id, $size);
		
		if(!$image_src){
			$image_src = array();
			$image_src[0] = get_template_directory_uri().'/img/default.jpg';
			if($output == 'image')
				return "<img src='".$image_src[0]."' ".$data."/>";
		
		}
		if ($output == 'url') return $image_src[0];
		
		
		


		$attachment = get_post($thumbnail_id);
		
		if(is_object($attachment))
		{
			
			$image_description = $attachment->post_excerpt == "" ? $attachment->post_content : $attachment->post_excerpt;
			$image_description = trim(strip_tags($image_description));
			$image_title = trim(strip_tags($attachment->post_title));
			
			return "<img src='".$image_src[0]."' title='".$image_title."' alt='".$image_description."' ".$data."/>";
		}	
	}
}


function codeless_backend_is_file($passedNeedle, $haystack){	
	
	$needle = substr($passedNeedle, strrpos($passedNeedle, '.') + 1);

	if(strlen($needle) > 4){

		if(!is_array($haystack)){

			switch($haystack){

				case 'videoService': $haystack = array('youtube.com/','vimeo.com/'); break;

			}

		}

		if(is_array($haystack)){

			foreach ($haystack as $regex){

				if(preg_match("!".$regex."!", $passedNeedle)) return true;

			}

		}	

	}else{
		
		if(!is_array($haystack)){

			switch($haystack){

				case 'image':

					$haystack = array('png','gif','jpeg','jpg','pdf','tif');
					break;

				case 'text':

					$haystack = array('doc','docx','rtf','ttf','txt','odp');

					break;

				case 'html5video':

					$haystack = array('ogv','webm','mp4');
					break;

			}

		}

		if(is_array($haystack)){

			if (in_array($needle,$haystack))

			{

				return true;

			}

		}

	}
		
	return false;

}


/*--------------------- Text Limit ----------------------------------------------- */

function codeless_text_limit($text, $limit) {

      $excerpt = explode(' ', $text, $limit);

      if (count($excerpt)>=$limit) {

        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';

      } else {

        $excerpt = implode(" ",$excerpt);
      } 

      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

      if(strlen($excerpt) > 170 && $limit <= 40)
        return substr($excerpt, 0, 170);
    
      return $excerpt;

}

/*--------------------- End Text Limit ----------------------------------*----- */


/*--------------------- HTML 5 VIDEO ---------------------------------------- */

if(!function_exists('codeless_html5_video_embed'))
{
	function codeless_html5_video_embed($path, $image = "", $types = array('webm' => 'type="video/webm"', 'mp4' => 'type="video/mp4"', 'ogv' => 'type="video/ogg"'))
	{	
		$output = '';
		if( function_exists( 'codeless_framework_html5_video_embed' ) )
			$output = codeless_framework_html5_video_embed( $path, $image, $types );
		return $output;
	}
}

/*--------------------- END HTML 5 VIDEO --------------------------------- */


/* -------------------- Used for woocommerce ----------------------------- */

function codeless_add_param($url, $paramName, $paramValue) {
     $url_data = parse_url($url);
     if(!isset($url_data["query"]))
         $url_data["query"]="";

     $params = array();
     parse_str($url_data['query'], $params);
     $params[$paramName] = $paramValue;   
     $url_data['query'] = http_build_query($params);
     return codeless_build_url($url_data);
}


 function codeless_build_url($url_data) {
     $url="";
     if(isset($url_data['host']))
     {
         $url .= $url_data['scheme'] . '://';
         if (isset($url_data['user'])) {
             $url .= $url_data['user'];
                 if (isset($url_data['pass'])) {
                     $url .= ':' . $url_data['pass'];
                 }
             $url .= '@';
         }
         $url .= $url_data['host'];
         if (isset($url_data['port'])) {
             $url .= ':' . $url_data['port'];
         }
     }
     if(isset($url_data['path']))
     	$url .= $url_data['path'];
     if (isset($url_data['query'])) { 
         $url .= '?' . $url_data['query'];
     }
     if (isset($url_data['fragment'])) {
         $url .= '#' . $url_data['fragment'];
     }
     return $url;
 }

if (class_exists('WPBakeryVisualComposerAbstract')) {

	add_action('admin_enqueue_scripts', 'codeless_vc_iconselect_css_load');
	function codeless_vc_iconselect_css_load($hook) {
		if($hook == "post-new.php" || $hook == "post.php")
		{	
	    
	    	wp_enqueue_style('jquery.fonticonpicker.min', get_template_directory_uri() . '/css/jquery.fonticonpicker.min.css');
	    	wp_enqueue_style('jquery.fonticonpicker.grey.min', get_template_directory_uri() . '/css/jquery.fonticonpicker.grey.min.css');
	    	wp_enqueue_style('vector-icons', get_template_directory_uri().'/css/vector-icons.css');
	    	wp_enqueue_style('font-awesome1',get_template_directory_uri().'/css/font-awesome.min.css' );
	    	wp_enqueue_style('linecon', get_template_directory_uri().'/css/linecon.css');
	    	wp_enqueue_style('steadysets',get_template_directory_uri().'/css/steadysets.css');

		}	
	}
}

function codeless_get_image_sizes( $size = '' ) {

        global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

                if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                        $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                        $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                        $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
                       

                } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                        $sizes[ $_size ] = array( 
                                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                        );

                }

        }

        // Get only 1 size if found
        if ( $size ) {

                if( isset( $sizes[ $size ] ) ) {
                        return $sizes[ $size ];
                } else {
                        return false;
                }

        }

        return $sizes;
}

function codeless_img_placeholder(){
	return get_template_directory_uri().'/img/default.jpg';
}

if( !function_exists( 'redux_post_meta' ) && !class_exists('Cl_Framework_Manager') ){
    function redux_post_meta( $var, $var2, $default = '' ){
        return false;
    }
}

?>
