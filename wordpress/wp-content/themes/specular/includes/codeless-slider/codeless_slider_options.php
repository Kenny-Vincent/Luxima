<?php

$redux_opt_name = "cl_redata";


/*--------------------------------------CODELESS SLIDER-----------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "codeless_add_codeless_slider_metaboxes" ) ):
    function codeless_add_codeless_slider_metaboxes($metaboxes) {

        $slide_background = array(
            'title'         => esc_html__('Background','specular'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'slide_background_type',
                    'title' => esc_html__( 'Background Type', 'specular' ),
                    'desc' => 'Select the type of the background',
                    'type' => 'select',
                    'options' => array('image' => 'Image / Color', 'video' => 'Video'),
                    'default' => 'image'
                ),

                array(
                    'id' => 'slide_background_image',
                    'type' => 'background',
                    'title' => esc_html__('Background Image / Color','specular'),
                    'subtitle' => esc_html__('Page Header background with image','specular'),
                    'default' => '',
                    'required' => array('slide_background_type','=','image')
                ),

                array(
                    'id' => 'slide_mp4_video',
                    'type' => 'text',
                    'title' => esc_html__('MP4 video Url','specular'),
                    'default' => '',
                    'required' => array('slide_background_type','=','video'),
                ), 

                array(
                    'id' => 'slide_webm_video',
                    'type' => 'text',
                    'title' => esc_html__('Webm video Url','specular'),
                    'default' => '',
                    'required' => array('slide_background_type','=','video'),
                ), 

                array(
                    'id' => 'slide_ogg_video',
                    'type' => 'text',
                    'title' => esc_html__('OGG video Url','specular'),
                    'default' => '',
                    'required' => array('slide_background_type','=','video'),
                ), 

                array(
                    'id' => 'slide_mobile_video',
                    'type' => 'media',
                    'title' => esc_html__('Image to replace video on mobile','specular'),
                    'default' => '',
                    'required' => array('slide_background_type','=','video'),
                ), 

                array(
                    'id'=>'slide_bg_overlay',
                    'type' => 'color_rgba', 
                    'title' => esc_html__('Background Color Overlay','specular'),
                    'subtitle'=> esc_html__('Use a bg overlay','specular'),
                    'default'  => array(
                        'color' => '', 
                        'alpha' => '1.0'
                    )
                )

            ),
        );


        $slide_content = array(
            'title'         => esc_html__('Content','specular'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                
                array(
                    'id' => 'slide_title',
                    'type' => 'textarea',
                    'title' => esc_html__('Title','specular')
                ),

                array(
                    'id'          => 'slide_title_style',
                    'type'        => 'typography', 
                    'title'       => esc_html__('Title Style','specular'),
                    'google'      => true, 
                    'font-backup' => false,
                    'font-style'  => false,
                    'text-transform' => true,
                    'letter-spacing' => true,
                    'text-align' => true, 
                    'units'       =>'px',
                    'default'     => array(
                        'color'       => '#222', 
                        'font-style'  => '700', 
                        'text-align'  => 'center', 
                        'font-family' => 'Open Sans', 
                        'google'      => true,
                        'font-size'   => '33px', 
                        'line-height' => '40',
                        'letter-spacing' => '1.8px'
                    )
                ),

                array(
                        'id' => 'slide_title_bg',
                        'type' => 'color_rgba',
                        'title' => esc_html__('Title Background','specular'),
                        'mode' => 'background-color', 
                        'default'  => array(
                            'color' => '#000000', 
                            'alpha' => '0'
                        ),
                        'validate' => 'colorrgba',
                ),

                array(
                    'id' => 'slide_title_padding',
                    'type' => 'spacing',
                    'mode' => 'padding', // absolute, padding, margin, defaults to padding
                    'units' => 'px', // You can specify a unit value. Possible: px, em, %
                    'title' => esc_html__('Title Padding','specular'),
                    'subtitle' => esc_html__(' ','specular'),
                    'desc' => esc_html__('Unit: px','specular'),
                    'default' => array('padding-left' => '0px', 'padding-right' => "0px", 'padding-top' => "0px", 'padding-bottom' => "0px")
                ),

                array(
                    'id' => 'slide_title_animation',
                    'title' => esc_html__( 'Title animation', 'specular' ),
                    'desc' => 'Select type of animation',
                    'type' => 'select',
                    'options' => codeless_animations(),
                    'default' => 'fadeInDown'
                ),

                array(
                    'id' => 'slide_description',
                    'type' => 'textarea',
                    'title' => esc_html__('Description','specular')
                ),

                array(
                    'id'          => 'slide_description_style',
                    'type'        => 'typography', 
                    'title'       => esc_html__('Description Style','specular'),
                    'google'      => true, 
                    'font-backup' => false,
                    'font-style'  => false,
                    'text-transform' => true,
                    'text-align' => true,
                    'units'       =>'px',
                    'default'     => array(
                        'color'       => '#666', 
                        'font-style'  => '400',
                        'text-align'  => 'center', 
                        'font-family' => 'Open Sans', 
                        'google'      => true,
                        'font-size'   => '20px', 
                        'line-height' => '32'
                    )
                ),

                array(
                    'id' => 'slide_description_animation',
                    'title' => esc_html__( 'Description animation', 'specular' ),
                    'desc' => 'Select type of animation',
                    'type' => 'select',
                    'options' => array('fadeInDown' => 'fadeInDown', 'fadeInUp' => 'fadeInUp'),
                    'default' => 'fadeInDown'
                ),

                array(
                    'id' => 'slide_image_switch',
                    'type' => 'switch',
                    'title' => esc_html__('Image On Top','specular'),
                    'subtitle' => esc_html__('Add an image on top of texts','specular'),
                    "default" => 0
                ),

                array(
                    'id'       => 'slide_image_top',
                    'type'     => 'media', 
                    'url'      => true,
                    'title'    => esc_html__('Image Media w/ URL','specular'),
                    'default'  => array(
                        'url'=>''
                    ),
                    'required' => array('slide_image_switch', 'equals', 1)
                ),

                array(
                    'id' => 'slide_image_alignment',
                    'title' => esc_html__( 'Image Alignment', 'specular' ),
                    'desc' => 'Select the position of the image',
                    'type' => 'select',
                    'options' => array('center' => 'Center', 'left' => 'Left', 'right' => 'Right'),
                    'default' => 'center',
                    'required' => array('slide_image_switch', 'equals', 1),
                 ),

                array(
                    'id'       => 'slide_image_dimension',
                    'type'     => 'dimensions',
                    'units'    => array('px'),
                    'title'    => esc_html__('Image Dimensions (Width/Height)','specular'),
                    'default'  => array(
                        'Width'   => '200', 
                        'Height'  => '100'
                    ),
                    'required' => array('slide_image_switch', 'equals', 1),
                ),

                array(
                    'id' => 'slide_button1',
                    'type' => 'text',
                    'title' => esc_html__('Button Label','specular'),
                    'subtitle' => esc_html__('First Button Label & Link','specular')
                ),

                array(
                    'id' => 'slide_button1_link',
                    'type' => 'text',
                    'title' => esc_html__('Button Link','specular')
                ),

                array(
                    'id' => 'slide_button1_style',
                    'title' => esc_html__( 'Button Style', 'specular' ),
                    'desc' => 'Select type of button',
                    'type' => 'select',
                    'options' => array('bordered' => 'Only border', 'colored' => 'Button with bg color'),
                    'default' => 'bordered'
                 ),

                array(
                    'id' => 'slide_button2',
                    'type' => 'text',
                    'title' => esc_html__('Button Label','specular'),
                    'subtitle' => esc_html__('Second Button Label & Link (Leave Blank if you want to use only one button)','specular')
                ),

                array(
                    'id' => 'slide_button2_link',
                    'type' => 'text',
                    'title' => esc_html__('Button Link','specular')
                ),

                array(
                    'id' => 'slide_button2_style',
                    'title' => esc_html__( 'Button Style', 'specular' ),
                    'desc' => 'Select type of button',
                    'type' => 'select',
                    'options' => array('bordered' => 'Only border', 'colored' => 'Button with bg color'),
                    'default' => 'bordered'
                 ),

                array(
                    'id' => 'slide_buttons_colors',
                    'title' => esc_html__( 'Overall Buttons Colors', 'specular' ),
                    'desc' => 'Select type of colors',
                    'type' => 'select',
                    'options' => array('light' => 'Light, for dark backgrounds', 'dark' => 'Dark, for light backgrounds'),
                    'default' => 'light'
                 ),

            ),
        );

        $slide_layout = array(
            'title'         => esc_html__('Layout','specular'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                 array(
                    'id' => 'slide_content_position',
                    'title' => esc_html__( 'Content Position', 'specular' ),
                    'desc' => 'Select the position for the content part',
                    'type' => 'select',
                    'options' => array('vertical_centered' => 'Vertical Centered', 'horizontal_centered' => 'Horizontal Centered', 'in_middle' => 'In Middle of slide (Horizontal and Vertical)', 'none' => 'Use only absolute position'),
                    'default' => 'in_middle'
                 ),

                 array(
                    'id'             => 'slide_content_position_absolute',
                    'type'           => 'spacing',
                    'mode'           => 'absolute',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Content custom absolute position','specular'),
                    'subtitle'       => esc_html__('Add absolute positioning','specular'),
                    'desc'           => esc_html__('In case you select vertical centered, top and bottom positions are fixed. The same for horizontal centered, left and right are fixed. Them are not considerated. If you want to use only absolute positions (Left, Right, Top, Bottom) select "Use only absolute position" ','specular'),
                    'default'            => array(
                        'top'    => '',
                        'bottom' => '',
                        'left'   => '',
                        'right'  => ''  
                    )
                ),
                
                array(
                    'id' => 'slide_content_width',
                    'type' => 'text',
                    'title' => esc_html__('Content Width','specular'),
                    'subtitle' => esc_html__('Examples: auto, 100px, 50%','specular'),
                    'default' => '700px'
                ),

                array(
                    'id' => 'remove_container',
                    'type' => 'switch',
                    'title' => esc_html__('Remove Site Container from slider','specular'),
                    'subtitle' => esc_html__('By switching this you can remove the slider container and the content should be shown from the left to the right of the screen.','specular'),
                    "default" => 0,
                ),

                array(
                    'id' => 'slider_menu_nav_colors',
                    'type' => 'select', 
                    'title' => esc_html__('Menu & Slider Navigation Color','specular'),
                    'subtitle' => esc_html__('Select Light for light colors in header, white logo and light slider nav','specular'),
                    'options' => array('dark' => 'Light logo, menu, slider navigations', 'light' => 'Dark logo, menu, slider navigations'), //Must provide key => value pairs for select options
                    'default' =>  'dark'
                ),
            )
        );

        

        $codeless_slider = array();
        $codeless_slider[] = $slide_background;
        $codeless_slider[] = $slide_content;
        $codeless_slider[] = $slide_layout;
        $metaboxes[] = array(
            'id'            => 'codeless-slider',
            'title'         => esc_html__( 'Codeless Slide Options', 'specular' ),
            'post_types'    => array( 'slide'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $codeless_slider,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'codeless_add_codeless_slider_metaboxes');
endif;

/*--------------------------------------END CODELESS SLIDER-------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/



?>