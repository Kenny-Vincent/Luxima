<?php

if(function_exists('register_sidebar')){
    
    function codeless_register_sidebars_init(){
     
        
        register_sidebar(array(
            'id'=>'sidebar-1',
            'name' => esc_html__('Sidebar Blog','specular'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h5 class="widget-title">', 
            'after_title' => '</h5>'
        ));
      
        register_sidebar(array(
                'id'=>'sidebar-2',
                'name' => esc_html__('Sidebar Pages','specular'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">', 
                'after_title' => '</h5>'
        ));
        register_sidebar(array(
                'id'=>'sidebar-3',
                'name' => esc_html__('Sidebar Portfolio','specular'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">', 
                'after_title' => '</h5>'
        ));

        register_sidebar(array( 
                'id'=>'sidebar-4',
                'name' => esc_html__('Top Header Left','specular'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '', 
                'after_title' => ''
        ));

        register_sidebar(array(
                'id'=>'sidebar-5',
                'name' => esc_html__('Top Header Right','specular'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '', 
                'after_title' => ''
        ));

        if( codeless_get_mod('footer_columns') !== false ):
            $footer_columns = codeless_get_mod('footer_columns');
            
         for ($i = 1; $i <= $footer_columns; $i++)
            {
                register_sidebar(array(
                    'name' => esc_attr__('Footer - column', 'specular').$i,
                    'id' => 'footer-column-'.$i,
                    'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                    'after_widget' => '</div>', 
                    'before_title' => '<h5 class="widget-title">', 
                    'after_title' => '</h5>', 
                ));
            }
        endif;

        register_sidebar(array(
                'id'=>'sidebar-7',
                'name' => esc_html__('Copyright Footer Sidebar','specular'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '', 
                'after_title' => ''
        ));
        
            

        if( codeless_get_mod('pages_sidebar') !== false ):    
            $id_array = codeless_get_mod('pages_sidebar');
                if(isset($id_array[0]))
                {
                    foreach ($id_array as $page_id)
                    {   
                        
                        if($page_id != "")
                        register_sidebar(array(
                            'id' => 'sidebar-custom-page-'.$page_id,
                            'name' => esc_html__('Page','specular').': '.get_the_title($page_id).'',
                            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                            'after_widget' => '</div>', 
                            'before_title' => '<h6 class="widget-title">', 
                    'after_title' => '</h6>'
                        ));
                    
                    
                    }
                }
        endif;
                
            
            
        if( codeless_get_mod('categories_sidebar') !== false ):       
            $id_array = codeless_get_mod('categories_sidebar');
        
            if(isset($id_array[0]))
            {
                foreach ($id_array as $cat_id)
                {   
                    
                    if($cat_id != "")
                    register_sidebar(array(
                        'id' => 'sidebar-custom-category-'.get_the_category_by_ID($cat_id),
                        'name' => esc_html__('Category','specular').': '.get_the_category_by_ID($cat_id).'',
                        'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                        'after_widget' => '</div>', 
                        'before_title' => '<h6 class="widget-title">', 
                        'after_title' => '</h6>'        )); 
                
                
              }
           }
        endif;




        if( codeless_get_mod('extra_navigation') ){
            register_sidebar(array(
                'id'=>'sidebar-10',
                'name' => esc_html__('Extra Side Navigation','specular'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">', 
                'after_title' => '</h5>'
            ));
        }

        if(class_exists('Woocommerce')){
            register_sidebar(array(
                'id'=>'sidebar-11',
                'name' => esc_html__('Sidebar Woocommerce','specular'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">',   
                'after_title' => '</h5>'
            ));
        }

        if( codeless_get_mod('header_style') == 'header_6' || codeless_get_mod('header_style') == 'header_7' || codeless_get_mod('header_style') == 'header_12'){
            register_sidebar(array(
                'id'=>'sidebar-12',
                'name' => esc_html__('Header Widgetized Area','specular'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">',   
                'after_title' => '</h5>'
            ));
        }

        if( codeless_get_mod('header_style') == 'header_12' ){
            register_sidebar(array(
                'id'=>'sidebar-13',
                'name' => esc_html__('After Navigation Area','specular'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h5 class="widget-title">',   
                'after_title' => '</h5>'
            ));
        }

    }
	add_action( 'widgets_init', 'codeless_register_sidebars_init' );
		
}

?>