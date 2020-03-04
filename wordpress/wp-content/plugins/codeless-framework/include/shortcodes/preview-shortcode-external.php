<?php 

$full_path = __FILE__;
$path = explode( 'wp-content', $full_path );
require_once( $path[0] . '/wp-load.php' );

$shortcode_css = get_template_directory_uri().'/css/bootstrap.css';


if(!current_user_can('edit_files')) die("");



?>

<html>

<head>


<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri().'/js/jquery-1.7.2.min.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri().'/js/bootstrap.js' ); ?>"></script>

<link rel="stylesheet" href="<?php echo esc_url($shortcode_css); ?>">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri().'/style.css') ?>">
</head>
<body class='shortcode_prev'>

<?php

$shortcode = isset($_REQUEST['shortcode']) ? $_REQUEST['shortcode'] : '';


$shortcode = stripslashes($shortcode);

echo do_shortcode($shortcode);

?>
<script type="text/javascript">

    jQuery('#scn-preview h3:first', window.parent.document).removeClass('scn-loading');

</script>
</body>
</html>
