<?php

if(!defined('CODELESS_BASE')) define('CODELESS_BASE', get_template_directory().'/');

if(!defined('CODELESS_IMPORTER_BASE')) define('CODELESS_IMPORTER_BASE', get_template_directory().'/admin/inc/fields/codeless_import');

if(!defined('CODELESS_BASE_URL' ) ) define( 'CODELESS_BASE_URL', get_template_directory_uri().'/'); 

if(function_exists('wp_get_theme'))
{
	$wp_theme_obj = wp_get_theme();
	$codeless_base_data['prefix'] = $codeless_base_data['Title'] = $wp_theme_obj->get('Name');
    if(!defined('THEMENAME')) define('THEMENAME', $codeless_base_data['Title']);
}

if(!defined('THEMETITLE')) define('THEMETITLE', $codeless_base_data['Title']);



if(is_admin()){
	add_action('admin_print_scripts','codeless_global_js');

	function codeless_global_js(){
	    echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
	    echo "var codeless_global = {\n \tframeworkUrl: '".esc_url(get_template_directory_uri())."', \n \tinstalledAt: '".esc_url(get_template_directory_uri())."', \n \tajaxurl: '".esc_url(admin_url( 'admin-ajax.php' ))."'\n \t}; \n /* ]]> */ \n ";
	    echo "</script>\n \n ";
	}
}


if( !class_exists('Redux') ){
	global $cl_redata;

	$cl_redata = array(
		'responsive_bool' => 1,
		'logo' => array(
			'url' => get_template_directory_uri() . '/img/logo.png',
		) ,
		'logo_light' => array(
			'url' => get_template_directory_uri() . '/img/logo_light.png',
		) ,
		'logo_height' => array(
			'height' => 50,
		) ,
		'nicescroll' => 0,
		'frontpage' => '0',
		'blogpage' => '0',
		'comingsoon_page' => '0',
		'404_error_message' => esc_attr__('Sorry but the page you are looking for has not been found. Try checking the URL for errors, then hit the refresh button on your browser', 'specular' ),
		'tracking_code' => '/*jQuery(document).ready(function(){ });*/',
		'custom_css' => '/*#header{ margin: 0 auto; }*/',
		'custom_js' => '/*jQuery(document).ready(function(){ });*/',
		'header_style' => 'header_1',
		'header_transparency' => 1,
		'header_overlay_color' => array(
			'color' => '#000000',
			'alpha' => '0.95',
		) ,
		'header_navigation' => array(
			'color' => '#000000',
			'alpha' => '1.00',
		) ,
		'header_6_nav_height' => array(
			'height' => 45,
		) ,
		'header_6_transparent' => 0,
		'header_7_width' => array(
			'width' => 280,
		) ,
		'header_7_padding' => array(
			'padding-left' => '20px',
			'padding-right' => '20px',
			'padding-top' => '20px',
			'padding-bottom' => '20px',
		) ,
		'header_7_margin' => array(
			'margin-top' => '40px',
		) ,
		'header_7_position' => 'left',
		'header_7_border' => 0,
		'header_7_border_top' => 0,
		'header_10_border' => 1,
		'header_height' => array(
			'height' => 80,
		) ,
		'header_background' => array(
			'color' => '#fff',
			'alpha' => '1.00',
		) ,
		'show_search' => '1',
		'header_container_full' => '0',
		'show_button' => '0',
		'header_button' => esc_attr__('Donate Now', 'specular') ,
		'header_button_link' => '#',
		'header_border_bottom' => array(
			'color' => '',
			'border-style' => 'solid',
			'border-bottom' => '0px',
		) ,
		'header_shadow' => 'no_shadow',
		'responsive_menu_dropdown' => 1,
		'header_responsive_tools' => 0,
		'menu_font_style' => array(
			'color' => '#222',
			'font-weight' => '600',
			'font-family' => 'Open Sans',
			'google' => true,
			'font-size' => '13px',
			'line-height' => '20px',
			'text-align' => 'center',
			'text-transform' => 'uppercase',
			'letter-spacing' => '1px',
		) ,
		'menu_padding' => array(
			'padding-left' => '5px',
			'padding-right' => '5px',
		) ,
		'menu_margin' => array(
			'margin-left' => '0px',
			'margin-right' => '0px',
		) ,
		'dropdown_width' => array(
			'width' => 220,
		) ,
		'background_dropdown' => '#222222',
		'dropdown_border_color' => '#222222',
		'dropdown_font' => array(
			'color' => '#888',
			'font-size' => '11px',
			'letter-spacing' => '0.3px',
			'text-transform' => 'uppercase',
		) ,
		'megamenu_title' => array(
			'color' => '#fff',
			'font-size' => '14px',
			'font-weight' => '600',
			'letter-spacing' => '1px',
			'text-transform' => 'uppercase',
		) ,
		'cart_dropdown_button' => 'light',
		'top_navigation' => 0,
		'topnav_bg' => '#f5f5f5',
		'topnav_border_top' => array(
			'color' => '',
			'border-style' => 'solid',
			'border-top' => '0px',
		) ,
		'topnav_border_bottom' => array(
			'color' => '',
			'border-style' => 'solid',
			'border-bottom' => '0px',
		) ,
		'topnav_font_style' => array(
			'color' => '#999',
			'font-family' => 'Open Sans',
			'google' => true,
			'font-size' => '11px',
		) ,
		'topnav_height' => array(
			'height' => 40,
		) ,
		'page_header_bool' => 1,
		'page_header_height' => array(
			'height' => 80,
		) ,
		'page_header_style' => 'normal',
		'page_header_f_color' => '#444',
		'page_header_background' => array(
			'background-color' => '#f5f5f5',
		) ,
		'page_header_border' => array(
			'color' => '',
			'border-style' => 'solid',
			'border-bottom' => '0px',
		) ,
		'sticky' => 0,
		'sticky_header_height' => array(
			'height' => 60,
		) ,
		'sticky_header_background' => array(
			'color' => '#fff',
			'alpha' => '0.80',
		) ,
		'sticky_logo' => 0,
		'sticky_mobile' => 0,
		'primary_color' => '#10b8c7',
		'link_color' => '#10b8c7',
		'body_font_color' => '#777777',
		'headings_font_color' => '#444444',
		'base_border_color' => '#e7e7e7',
		'highlighted_background_main' => '#f5f5f5',
		'body_background' => 'transparent',
		'page_content_background_overall' => 'transparent',
		'page_header_normal_typography' => array(
			'font-size' => '24px',
			'font-weight' => '600',
			'text-transform' => 'uppercase',
		) ,
		'page_header_normal_typography_subtitle_title' => array(
			'font-size' => '20px',
			'font-weight' => '600',
			'text-transform' => 'uppercase',
		) ,
		'page_header_normal_typography_subtitle_subtitle' => array(
			'font-size' => '13px',
			'font-weight' => '400',
			'text-transform' => 'none',
		) ,
		'page_header_centered_typography_nosub_title' => array(
			'font-size' => '38px',
			'font-weight' => '300',
			'text-transform' => 'none',
		) ,
		'page_header_centered_typography_subtitle_title' => array(
			'font-size' => '48px',
			'font-weight' => '600',
			'text-transform' => 'uppercase',
			'letter-spacing' => '4px',
		) ,
		'page_header_centered_typography_subtitle_subtitle' => array(
			'font-size' => '26px',
			'font-weight' => '300',
			'text-transform' => 'none',
		) ,
		'page_header_design_style' => 'normal',
		'page_header_padd_bg_title' => array(
			'color' => '#000',
			'alpha' => '0.70',
		) ,
		'page_header_padd_bg_subtitle' => array(
			'color' => '#fff',
			'alpha' => '0.70',
		) ,
		'page_header_padd_bg_subtitle_font' => '#222',
		'fppter_headings_typography' => array(
			'color' => '#cdcdcd',
			'font-weight' => '700',
			'font-size' => '14px',
			'text-transform' => 'uppercase',
			'letter-spacing' => '1px',
		) ,
		'footer_body_color' => '#818181',
		'footer_links_color' => '#cdcdcd',
		'footer_background_color' => '#1c1c1c',
		'copyright_background_color' => '#222222',
		'footer_border_top' => array(
			'color' => '',
			'border-style' => 'solid',
			'border-top' => '0px',
		) ,
		'footer_social_icons_bg' => '#222222',
		'footer_social_icons_icon' => '#ffffff',
		'blog_title_typography' => array(
			'font-weight' => '700',
			'color' => '#444444',
			'text-transform' => 'uppercase',
			'line-height' => '30px',
			'font-size' => '20px',
		) ,
		'blog_info_typography' => array(
			'color' => '#999999',
			'font-size' => '12px',
			'line-height' => '20px',
		) ,
		'blog_info_typography_icon' => array(
			'font-size' => '15px',
		) ,
		'timeline_box_shadow' => 1,
		'timeline_bg_color' => '#ffffff',
		'fullscreen_blog_box_bg' => array(
			'color' => '#ffffff',
			'alpha' => '0.00',
		) ,
		'sidebar_widget_title' => array(
			'font-weight' => '700',
			'color' => '#444444',
			'font-size' => '15px',
			'text-transform' => 'uppercase',
			'line-height' => '20px',
			'letter-spacing' => '1px',
		) ,
		'sidebar_widget_title_margin' => array(
			'margin-bottom' => '24px',
		) ,
		'sidebar_widget_margin' => array(
			'margin-bottom' => '35px',
		) ,
		'sidebar_tagcloud_bg' => '#222',
		'sidebar_tagcloud_color' => '#fff',
		'codeless_slider_wrapper_bg' => '#222',
		'portfolio_filter_basic_typography' => array(
			'font-weight' => '600',
			'color' => '#bebebe',
			'text-transform' => 'uppercase',
			'letter-spacing' => '1px',
		) ,
		'portfolio_filter_basic_typography_active' => '#222',
		'portfolio_filter_full_bg' => '#222',
		'portfolio_filter_full_link_color' => array(
			'color' => '#ffffff',
			'alpha' => '0.80',
		) ,
		'portfolio_filter_full_link_color_hover' => array(
			'color' => '#ffffff',
			'alpha' => '1.00',
		) ,
		'portfolio_overlay_bg' => array(
			'color' => '#10b8c7',
			'alpha' => '0.90',
		) ,
		'portfolio_overlay_title' => array(
			'font-weight' => '600',
			'color' => '#fff',
			'text-transform' => 'uppercase',
			'letter-spacing' => '',
		) ,
		'portfolio_overlay_subtitle' => array(
			'font-size' => '14px',
			'font-weight' => '300',
			'color' => '#fff',
			'text-transform' => 'none',
		) ,
		'portfolio_grayscale_bg' => '#fff',
		'portfolio_grayscale_title' => array(
			'color' => '',
			'font-weight' => '600',
		) ,
		'portfolio_grayscale_subtitle' => '#bebebe',
		'portfolio_basic_overlay_bg' => array(
			'color' => '#fff',
			'alpha' => '0.90',
		) ,
		'portfolio_basic_overlay_icon_color' => '#fff',
		'portfolio_basic_title' => array(
			'color' => '#222',
			'font-weight' => '600',
			'text-transform' => 'uppercase',
			'letter-spacing' => '1px',
			'text-align' => 'center',
		) ,
		'portfolio_basic_subtitle' => array(
			'color' => '#888',
			'font-weight' => '400',
			'text-align' => 'center',
		) ,
		'toggle_title_typography' => array(
			'color' => '#555',
			'font-weight' => '600',
			'font-size' => '15px',
			'text-transform' => 'uppercase',
			'letter-spacing' => '1px',
		) ,
		'toggle_active_color' => '#222',
		'block_title_column_title' => array(
			'color' => '#222',
			'font-weight' => '600',
			'text-transform' => 'uppercase',
			'letter-spacing' => '1px',
			'line-height' => '24px',
			'text-align' => 'left',
		) ,
		'block_title_column_subtitle' => array(
			'color' => '#888',
			'font-weight' => '300',
			'text-transform' => 'none',
			'text-align' => 'left',
		) ,
		'block_title_section_title' => array(
			'color' => '',
			'font-size' => '20px',
			'font-weight' => '700',
			'text-transform' => 'uppercase',
			'line-height' => '38px',
			'letter-spacing' => '1.5px',
		) ,
		'block_title_section_desc' => array(
			'color' => '#555',
			'font-weight' => '400',
			'text-transform' => '',
			'line-height' => '20px',
			'font-size' => '14px',
		) ,
		'animated_counter_typ' => array(
			'color' => '#444',
			'font-weight' => '600',
			'font-size' => '48px',
			'line-height' => '48px',
			'letter-spacing' => '-1px',
		) ,
		'testimonial_text' => array(
			'color' => '#444',
			'font-weight' => '300',
			'font-size' => '18px',
			'line-height' => '30px',
		) ,
		'textbar_title_typography' => array(
			'color' => '#222',
			'font-weight' => '600',
			'font-size' => '24px',
			'text-transform' => 'none',
			'letter-spacing' => '0px',
		) ,
		'contact_border' => 'transparent',
		'overall_button_style' => array(
			0 => 'default',
		) ,
		'button_typography' => array(
			'color' => '#222',
			'font-weight' => '600',
			'font-size' => '13px',
			'text-transform' => 'uppercase',
			'letter-spacing' => '1.5px',
		) ,
		'button_background_color' => array(
			'color' => '#ffffff',
			'alpha' => '0.00',
		) ,
		'button_border_color' => array(
			'color' => '#444444',
			'alpha' => '0.20',
		) ,
		'button_hover_font_color' => '#222',
		'button_hover_background' => array(
			'color' => '#ffffff',
			'alpha' => '0.00',
		) ,
		'button_hover_border' => array(
			'color' => '#444',
			'alpha' => '1.00',
		) ,
		'button_light_font_color' => '#fff',
		'button_light_background' => array(
			'color' => '#fff',
			'alpha' => '0.00',
		) ,
		'button_light_border' => array(
			'color' => '#fff',
			'alpha' => '0.40',
		) ,
		'button_light_hover_font_color' => '#fff',
		'button_light__hover_background' => array(
			'color' => '#fff',
			'alpha' => '0.00',
		) ,
		'button_light_hover_border' => array(
			'color' => '#fff',
			'alpha' => '1.00',
		) ,
		'shop_single_title' => array(
			'font-weight' => '700',
			'letter-spacing' => '1.5',
			'text-transform' => 'uppercase',
		) ,
		'shop_product_overlay' => array(
			'color' => '#10b8c7',
			'alpha' => '0.90',
		) ,
		'body_typography' => array(
			'color' => '#777',
			'font-family' => 'Open Sans',
			'google' => true,
			'line-height' => '28px',
			'font-size' => '16px',
			'font-weight' => '400',
		) ,
		'headings_font_type' => array(
			'font-family' => 'Open Sans',
			'google' => true,
			'font-weight' => '600',
		) ,
		'heading_1_font' => array(
			'line-height' => '48px',
			'google' => true,
			'font-size' => '36px',
		) ,
		'heading_2_font' => array(
			'line-height' => '30px',
			'google' => true,
			'font-size' => '24px',
		) ,
		'heading_3_font' => array(
			'line-height' => '26px',
			'google' => true,
			'font-size' => '18px',
		) ,
		'heading_4_font' => array(
			'line-height' => '24px',
			'google' => true,
			'font-size' => '16px',
		) ,
		'heading_5_font' => array(
			'line-height' => '22px',
			'google' => true,
			'font-size' => '15px',
		) ,
		'heading_6_font' => array(
			'line-height' => '20px',
			'google' => true,
			'font-size' => '14px',
		) ,
		'footer_columns' => '2',
		'copyright_text' => '@2014 Specular - Multi-Purpose theme from Code-less, builded with Wordpress, Visual Composer and Redux',
		'show_footer' => 1,
		'show_copyright' => 0,
		'blog_style' => 'normal',
		'post_style' => 'modern',
		'blog_grid_col' => '3',
		'bloglayout' => 'sidebar_right',
		'singlebloglayout' => 'sidebar_right',
		'post_like' => 0,
		'social_shares' => 0,
		'blog_pagination' => 'with_pagination',
		'blog_info_author' => 1,
		'blog_info_date' => 1,
		'blog_info_comments' => 1,
		'blog_info_tags' => 1,
		'portfolio_slug' => 'codeless_portfolio',
		'portfolio_post_like' => 0,
		'site_layout' => 'fullwidth',
		'page_overall_layout' => 'fullwidth',
		'page_container_width' => array(
			'width' => '1100px',
		) ,
		'page_container_width_percent' => array(
			'width' => '87%',
		) ,
		'boxed_container_width' => array(
			'width' => '1100px',
		) ,
		'boxed_container_width_percent' => array(
			'width' => '87%',
		) ,
		'boxed_container_margin' => array(
			'margin-bottom' => '30px',
			'margin-top' => '30px',
		) ,
		'boxed_shadow' => 1,
		'boxed_border' => array(
			'color' => '#e7e7e7',
			'border-style' => 'solid',
			'border' => '0px',
		) ,
		'extra_navigation' => 0,
		'extra_navigation_position' => 'right',
		'row_margin_bottom' => array(
			'margin-bottom' => '85px',
		) ,
		'content_padding' => array(
			'padding-bottom' => '85px',
			'padding-top' => '85px',
		) ,
		'codeless_import_export' => 'default',
		'slide_background_type' => 'image',
		'slide_background_image' => '',
		'slide_mp4_video' => '',
		'slide_webm_video' => '',
		'slide_ogg_video' => '',
		'slide_mobile_video' => '',
		'slide_bg_overlay' => array(
			'color' => '',
			'alpha' => '1.0',
		) ,
		'slide_title' => '',
		'slide_title_style' => array(
			'color' => '#222',
			'font-style' => '700',
			'text-align' => 'center',
			'font-family' => 'Open Sans',
			'google' => true,
			'font-size' => '33px',
			'line-height' => '40',
			'letter-spacing' => '1.8px',
		) ,
		'slide_title_bg' => array(
			'color' => '#000000',
			'alpha' => '0',
		) ,
		'slide_title_padding' => array(
			'padding-left' => '0px',
			'padding-right' => '0px',
			'padding-top' => '0px',
			'padding-bottom' => '0px',
		) ,
		'slide_title_animation' => 'fadeInDown',
		'slide_description' => '',
		'slide_description_style' => array(
			'color' => '#666',
			'font-style' => '400',
			'text-align' => 'center',
			'font-family' => 'Open Sans',
			'google' => true,
			'font-size' => '20px',
			'line-height' => '32',
		) ,
		'slide_description_animation' => 'fadeInDown',
		'slide_image_switch' => 0,
		'slide_image_top' => array(
			'url' => '',
		) ,
		'slide_image_alignment' => 'center',
		'slide_image_dimension' => array(
			'Width' => '200',
			'Height' => '100',
		) ,
		'slide_button1' => '',
		'slide_button1_link' => '',
		'slide_button1_style' => 'bordered',
		'slide_button2' => '',
		'slide_button2_link' => '',
		'slide_button2_style' => 'bordered',
		'slide_buttons_colors' => 'light',
		'slide_content_position' => 'in_middle',
		'slide_content_position_absolute' => array(
			'top' => '',
			'bottom' => '',
			'left' => '',
			'right' => '',
		) ,
		'slide_content_width' => '700px',
		'remove_container' => 0,
		'slider_menu_nav_colors' => 'dark',
		'single_custom_link_switch' => 0,
		'single_custom_link' => '',
		'single_portfolio_style' => 'container',
		'single_portfolio_content_position_floating' => 'right',
		'single_portfolio_content_position_container' => 'right',
		'single_portfolio_media' => 'featured',
		'single_portfolio_video' => '',
		'single_portfolio_gallery' => '',
		'single_portfolio_active_comments' => 0,
		'single_portfolio_custom_fields' => '',
		'portfolio_categories' => '',
		'portfolio_mode' => 'grid',
		'portfolio_columns' => '3',
		'portfolio_style' => 'overlayed',
		'portfolio_layout' => 'in_container',
		'portfolio_space' => 'normal',
		'portfolio_content' => 'top',
		'portfolio_pagination' => 'with_pagination',
		'overwrite_layout' => 0,
		'layout' => 'fullwidth',
		'left_sidebar_dual' => '',
		'right_sidebar_dual' => '',
		'page_header_overwrite' => 0,
		'subtitle_bool' => 0,
		'subtitle' => esc_attr__('A sample page description', 'specular') ,
		'slider_type' => 'none',
		'gallery' => '',
		'gallery_effect' => 'simple',
		'revslider' => 'none',
		'layerslider' => 'none',
		'codeless_slider' => '',
		'codeless_slider_speed' => '800',
		'codeless_slider_height' => '',
		'codeless_news_featured_1' => '',
		'codeless_news_featured_2' => '',
		'slider_layout' => 'fullwidth',
		'slider_fixed' => 0,
		'slider_parallax' => 0,
		'slider_onmobile_remove' => 0,
		'page_content_background' => '',
		'page_header_menu_color' => 'light',
		'one_page_active' => '0',
		'fullscreen_sections_active' => '0',
		'use_featured_image_as_photo' => 1,
		'staff_position' => '',
		'facebook_link' => '#',
		'twitter_link' => '#',
		'google_link' => '#',
		'pinterest_link' => '',
		'linkedin_link' => '',
		'instagram_link' => '',
		'mail_link' => '',
		'fullscreen_post_style' => 0,
		'fullscreen_post_effect' => 'fadeInLeft',
		'fullscreen_post_delay' => '200',
		'fullscreen_post_position' => 'left',
		'future_date_events' => '',
		'media_post_link' => '',
		);
}

?>