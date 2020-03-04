<?php

$id = codeless_get_post_id(); 
$replaced = redux_post_meta('cl_redata',(int) $id);

if(!empty($replaced) && ( function_exists( 'is_product' ) && !is_product() )   )
    foreach($replaced as $key => $value){
        codeless_set_mod($key, $value);
    }

do_action( 'codeless_routing_template' , 'page' );
codeless_current_view('woocommerce');

$layout = codeless_get_page_layout();


if($layout == 'fullwidth')
    $spancontent = 12;
else if($layout == 'dual')
    $spancontent = 6;
else
    $spancontent = 9;


get_header(); 


get_template_part('includes/view/page_header'); ?>
        
<?php $extra_class = ''; if($spancontent != 12) $extra_class .= ' with_sidebar'; ?>
<section id="content" class="composer_content <?php echo esc_attr($extra_class) ?>" style="background-color:<?php echo ( codeless_get_mod('page_content_background'))?esc_attr(codeless_get_mod('page_content_background')):'#ffffff'; ?>;">
        <div class="container <?php  echo esc_attr(codeless_get_page_layout()) ?>" id="blog">
            <div class="row">
            <?php if($layout == 'sidebar_left' || $layout == 'dual') get_sidebar() ?>  
                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php woocommerce_content() ?> 

                </div>
                <?php
                
                wp_reset_query();    
    
                if($layout == 'sidebar_right' || $layout == 'dual') if($layout != 'dual') get_sidebar(); else get_sidebar('dual'); ?>

            </div>
        </div>
</section>

<?php get_footer(); ?>