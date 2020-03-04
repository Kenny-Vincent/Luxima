<?php

if ( ! function_exists( 'cl_framework' ) ) {
	
	function cl_framework() {
		return Cl_Framework_Manager::getInstance();
	}
}

if ( ! function_exists( 'cl_asset_url' ) ) {

	function cl_asset_url( $file ) {
		return cl_framework()->assetUrl( $file );
	}
}

if ( ! function_exists( 'cl_path_url' ) ) {

	function cl_path_url( $file ) {
		return cl_framework()->pathUrl( $file );
	}
}


if ( ! function_exists( 'cl_file_path' ) ) {

	function cl_file_path( $dir, $path ) {
		return cl_framework()->path( $dir, $path );
	}
}


if( !function_exists( 'codeless_widget_register' ) ){
    function codeless_widget_register( $widget ){
        register_widget( $widget );
    }
}

function codeless_server_var( $param ){
    return $_SERVER[$param];
}

function codeless_show_extra_coding_functions(){
    global $cl_redata;
    // Google analytics
    $google_analytics = isset( $cl_redata['tracking_code'] ) ? $cl_redata['tracking_code'] : '';
    ?>
    <script type="text/javascript">
        <?php echo esc_js($google_analytics); ?>
    </script>
    
    <?php 
        $custom_js = isset( $cl_redata['custom_js'] ) ? $cl_redata['custom_js'] : '';
        if(!empty($custom_js)):
    ?>
    
    <script type="text/javascript">
        <?php echo esc_js($custom_js) ?>
    </script>
    
    <?php endif;
}


function codeless_decode_content($data){
	return base64_decode( $data );
}

function codeless_encode_content($data){
	return base64_encode( $data );
}

function codeless_builder_generic_read_file( $file ){
	$content = "";
    
    if( ! function_exists('codeless_decode_content') )
        return false;

    if ( file_exists($file) ) {
                
        $content = codeless_builder_generic_get_content($file);

        if ($content) {

            if( ! empty( $content ) ){
                $decoded_content = codeless_decode_content($content);

                if( !empty( $decoded_content ) )
                    $unserialized_content = unserialize( $decoded_content );

                if ($unserialized_content) {
                    return $unserialized_content;
                }
            }else{
                return '';
            }
        }
        return false;
    }
}

function codeless_builder_generic_get_content($file){
	$content = '';
    if ( function_exists('realpath') )
        $filepath = realpath($file);

    if ( !$filepath || !@is_file($filepath) )
        return '';

    if( ini_get('allow_url_fopen') ) {
        $method = 'fopen';
    } else {
        $method = 'file_get_contents';
    }
    
    if ( $method == 'fopen' ) {
        $handle = fopen( $filepath, 'rw' );

        if( $handle !== false ) {
            if( filesize( $filepath ) > 0 ){
                while (!feof($handle)) {
                    $content .= fread($handle, filesize( $filepath ) );
                }
                fclose( $handle );
            }
        }
        return $content;
    } else {
        return file_get_contents($filepath);
    }
}

function codeless_builder_file_read( $var1, $var2 ){
	return fread( $var1, $var2 );
}

function codeless_builder_file_open( $filename, $mode ){
	return fopen( $filename, $mode );
}

function codeless_builder_file_close( $fp ){
	return fclose( $fp );
}

function codeless_builder_f_get_contents( $data ){
	return file_get_contents($data);
}

function codeless_builder_f_put_contents( $data, $var2 ){
	return file_put_contents($data, $var2);
}

function codeless_http_user_agent(){
	return isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';
}

function codeless_isLocalhost(){
	return ( $_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === 'localhost' || $_SERVER['REMOTE_ADDR'] === '::1') ? 1 : 0;
}

function codeless_server_software(){
	return $_SERVER['SERVER_SOFTWARE'];
}

function codeless_load_redux_metaboxes_extension(){
    // The loader will load all of the extensions automatically based on your $redux_opt_name
    require_once cl_file_path('APP_ROOT', 'include/redux/loader/loader.php');
}

function codeless_redux_import_export_load_dir(){
    return cl_file_path('APP_ROOT', 'include/redux/inc/fields/codeless_import/codeless_import.php');
}

function codeless_redux_import_export_load(){
    require_once cl_file_path('APP_ROOT', 'include/redux/inc/fields/codeless_import/import_export.php');
}

function vc_shortcode_add_param($param1, $param2, $param3){
    vc_add_shortcode_param($param1, $param2, $param3);  
}

function codeless_framework_html5_video_embed( $path, $image, $types ){
    preg_match("!^(.+?)(?:\.([^.]+))?$!", $path, $path_split);
		
		$output = "";
		if(isset($path_split[1]))
		{
			if(!$image && file_get_contents($path_split[1].'.jpg',0,NULL,0,1))
			{
				$image = 'poster="'.$path_split[1].'.jpg"';
			}
			
			$uid = 'player_'.get_the_ID().'_'.mt_rand().'_'.mt_rand();
		
			$output .= '<video class="codeless_video" '.$image.' controls id="'.$uid.'">';

			foreach ($types as $key => $type)
			{
				if($path_split[2] == $key || file_get_contents($path_split[1].'.'.$key,0,NULL,0,1)) 
				{  
					$output .= '	<source src="'.$path_split[1].'.'.$key.'" '.$type.' />';
				}
			}

			$output .= '</video>';
        }
        
    return $output;
}