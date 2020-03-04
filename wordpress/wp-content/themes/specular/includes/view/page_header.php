<?php
   
    $id = codeless_get_post_id();
  
    $replaced = array();
    if((int) $id != 0)
        $replaced = redux_post_meta('cl_redata',(int) $id);
    
    
    if(!empty($replaced)  )
        foreach($replaced as $key => $value){
            codeless_set_mod($key, $value);
        }

 
    if( function_exists( 'is_product' ) && is_product() )
        codeless_set_mod( 'page_header_style', 'normal' );
    
    
    $title = get_the_title($id);
    if(is_search())
        $title = esc_html__('Search Results', 'specular');
    if(is_404()) 
        $title = esc_html__('404 Not Found', 'specular');

    $page_parents = codeless_page_parents();
    $extra_class = '';

    if(function_exists('is_product_category') && is_product_category()){
        global $wp_query;
        // get the query object
        $cat_obj = $wp_query->get_queried_object();   
        if($cat_obj)
            $title = $cat_obj->name;
    }
  
    if(codeless_get_mod('page_header_bool') || codeless_get_mod( 'single_product_page_header_bool' ) ):   
        $extra_class .= codeless_get_mod('page_header_style');

    if( codeless_get_mod('page_header_background', 'background-image') !== false && codeless_get_mod('page_header_background', 'background-image') != '' )
        $extra_class .= ' without_shadow';

    if( codeless_get_mod('page_header_background', 'background-attachment') !== false && codeless_get_mod('page_header_background', 'background-attachment') != 'fixed')
        $extra_class .= ' no_parallax'; 

    if(codeless_get_mod('subtitle_bool'))
        $extra_class .= ' with_subtitle'; 

    if(codeless_get_mod('page_header_design_style') == 'padd')
        $extra_class .= ' with_padding_style';
    ?>

    
    <?php if( is_home() ) $title = get_the_title( get_option( 'page_for_posts' ) ); ?>
    <?php 
    if( codeless_is_blog_query() )
        $title = esc_html__( 'Blog', 'specular' ); 
    ?>


    <!-- Page Head -->
    <div class="header_page <?php echo esc_attr($extra_class) ?>">
             <?php if( codeless_get_mod('page_header_background', 'background-image') !== false && codeless_get_mod('page_header_background', 'background-image') != '' && codeless_get_mod('page_header_background', 'background-color') !== false && codeless_get_mod('page_header_background', 'background-color') != ''): ?>
                <?php $rgb_color = codeless_hexToRgb(codeless_get_mod('page_header_background', 'background-color'));  ?>
                <div class="overlay" style="background:rgba(<?php echo esc_attr($rgb_color['r']) ?>, <?php echo esc_attr($rgb_color['g']) ?>, <?php echo esc_attr($rgb_color['b']) ?>, 0.75"></div>
             <?php endif; ?> 
             <div class="container">
                    
                    <?php if(codeless_get_mod('subtitle_bool')): ?>
                    <div class="titles">
                    <?php endif; ?>

                        <h1><?php echo esc_html($title) ?></h1> 
                        <span class="divider"></span>

                        <?php if(codeless_get_mod('subtitle_bool')): ?>
                            <h3><?php echo esc_html(codeless_get_mod('subtitle')) ?></h3>
                        <?php endif; ?>

                    <?php if(codeless_get_mod('subtitle_bool')): ?>
                    </div>
                    <?php endif; ?>

                    <?php if(codeless_get_mod('page_header_style') == 'normal'): ?>
                    <div class="breadcrumbss">
                        
                        <ul class="page_parents pull-right">
                            <li><?php esc_html_e("You are here", 'specular'); ?>: </li>
                            <li class="home"><a href="<?php echo esc_url(home_url()) ?>"><?php esc_html_e("Home", 'specular'); ?></a></li>
                            
                            <?php 
                            if(isset($page_parents)){
                                for($i = count($page_parents) - 1; $i >= 0; $i-- ){ ?>
                            

                            <li><a href="<?php echo esc_url(get_permalink($page_parents[$i])) ?>"><?php echo esc_html(get_the_title($page_parents[$i])) ?> </a></li>

                            <?php   } 
                                }

                             ?>
                            <li class="active"><a href="<?php echo esc_url(get_permalink()) ?>"><?php echo esc_html($title) ?></a></li>

                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            
    </div> 
   
    
    <?php endif; ?>