<?php

global $codeless_used_for_element;

$columns = (isset($codeless_used_for_element)) ? $codeless_used_for_element['columns'] : codeless_get_mod('portfolio_columns');
$sidebar = codeless_get_page_layout();
$style = (isset($codeless_used_for_element)) ? $codeless_used_for_element['style'] : codeless_get_mod('portfolio_style');

$extra_class = '';
if(isset($codeless_used_for_element) && $codeless_used_for_element['carousel'] == 'yes')
    $extra_class .= ' swiper-slide';

if(!isset($codeless_used_for_element))
    codeless_set_portfolio_query(); 

if(have_posts()){
    $item_grid_class = '';
    
    switch($columns){
        case "1": $item_grid_class = 12; break;
        case "2": $item_grid_class = 6; break;
        case "3": $item_grid_class = 4; break;
        case "4": $item_grid_class = 3; break;
        case "5": $item_grid_class = 5; break;
    }
     
    ?>
    
    <?php if(!isset($codeless_used_for_element)): ?>
        <div class="filterable row">
    <?php endif ?>

    <?php

    $the_id = 0;
    $loop_counter = 0;


    while (have_posts()) : the_post();	
	
		$loop_counter++;
    	$the_id 	= get_the_ID();
        $alt = get_post_meta($the_id, '_wp_attachment_image_alt', true);
    	$sort_classes = "";
    	$item_categories = get_the_terms( $the_id, 'portfolio_entries' );
    
    	if(is_object($item_categories) || is_array($item_categories))
    	{
    		foreach ($item_categories as $cat)
    		{
    			$sort_classes .= $cat->slug.' ';
    		}
    	}

        $cats = wp_get_object_terms(get_the_ID(), 'portfolio_entries');
        $link = get_permalink();
        if(codeless_get_mod('single_custom_link_switch') && codeless_get_mod('single_custom_link') )
            $link = codeless_get_mod('single_custom_link');
    ?>
      
       <!-- Portfolio Normal Mode -->
       <?php if($style == 'overlayed'){ ?>
    <!-- item -->
        
    	                    <div class="portfolio-item mix <?php echo esc_attr($sort_classes) ?> <?php echo esc_attr($extra_class) ?> <?php echo esc_attr($style) ?>" data-id="<?php echo esc_attr(get_the_ID()) ?>">
                                        <div class="he-wrap tpl2">
                                        <a href="<?php echo esc_url($link) ?>"></a>

                                        <?php if($item_grid_class == 5){ ?>
                                            <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port4', 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                   
                                        <?php } ?>
                                        <?php if($item_grid_class == 3){ ?>
                                            <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port4', 'url')) ?>" alt="'.$alt.'">
                                   
                                        <?php } ?>
                                        <?php if($item_grid_class == 4){ ?>
                                            <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port3', 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                          
						 <?php } ?>
                                        <?php if($item_grid_class == 6){ ?>
                                            <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port2', 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                         
						<?php } ?>
                                        <?php if($item_grid_class == 12){ ?>
                                            <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port1', 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                       	 
						 <?php } ?>
                                       <div class="overlay he-view">
                                            <div class="bg a0" data-animate="fadeIn">
                                                <div class="center-bar v1">
                                                    <h4 data-animate="fadeInUp" class="a1"><?php echo get_the_title() ?></h4>
                                                    <h6 data-animate="fadeInUp" class="a2"><?php echo codeless_complex_esc($sort_classes) ?></h6>
                                                </div>
                                            </div>
                                             
                                        </div>   
                                            
                                            
                                                
                                     </div>      
                                           
	                    </div>
            <?php }else if($style == 'grayscale'){ ?>
              <div class="portfolio-item mix <?php echo esc_attr($sort_classes) ?> <?php echo esc_attr($extra_class) ?>  <?php echo esc_attr($style) ?>" data-id="<?php echo get_the_ID() ?>">
                                        <div class="">
                                            <?php if($item_grid_class == 5){  ?>
                                                <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port4', 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                           
                                            <?php } ?>
                                            <?php if($item_grid_class == 3){  ?>
                                                <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port4', 'url')) ?>" aalt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                           
                                            <?php } ?>
                                            <?php if($item_grid_class == 4){ ?>
                                                <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port3_grayscale', 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                          
                             <?php } ?>
                                            <?php if($item_grid_class == 6){ ?>
                                                <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port2_grayscale', 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                            
                            <?php } ?>
                                            <?php if($item_grid_class == 12){ ?>
                                                <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port1', 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                          
                             <?php } ?>
                                           <div class="project">
                                                <h5><a href="<?php echo esc_url($link) ?>"><?php echo get_the_title() ?></a></h5>
                                                <h6><?php echo esc_html($sort_classes) ?></h6>
                                            </div>   
                                            
                                            
                                                
                                        </div>          
                                        
                                           
                        </div>



            <?php }else if($style == 'basic'){ ?>

                 <div class="portfolio-item mix <?php echo esc_attr($sort_classes) ?> <?php echo esc_attr($extra_class) ?>  <?php echo esc_attr($style) ?>" data-id="<?php echo get_the_ID() ?>">
                    <div class="he-wrap tpl2">
                        <?php if($columns == 5) $columns = 4; ?>                
                        <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'port'.$columns, 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                                     
                        <div class="overlay he-view">
                            <div class="bg a0" data-animate="fadeIn">
                                <div class="center-bar v1">
                                    <a href="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), array("width"=> 1200, "height" => 1200), "url")) ?>" class="link a2 lightbox-gallery lightbox" data-animate="fadeInRight"><i class="moon-search-3"></i></a></a>
                                    <a href="<?php echo esc_url($link) ?>" class="link a1" data-animate="fadeInLeft"><i class="moon-link-4"></i></a></a>
                                </div>
                             </div> 
                        </div>                          
                    </div>   

                                     
                    <div class="show_text">
                        <h5><a href="<?php echo esc_url($link) ?>"><?php echo get_the_title() ?></a></h5>
                        <h6><?php echo esc_html($sort_classes) ?></h6>
                    </div>         
                 
                </div>

            <?php }else if($style == 'chrome'){ ?>
                
                <div class="portfolio-item mix <?php echo esc_attr($sort_classes) ?> <?php echo esc_attr($extra_class) ?>  <?php echo esc_attr($style) ?>" data-id="<?php echo get_the_ID() ?>">
                    <div class="overlay">
                        <div class="bar"></div>
                        <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'staff_full', 'url')) ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                        <span>
                            <a href="<?php echo esc_url($link) ?>" class="btn-bt <?php echo esc_attr(codeless_get_mod('overall_button_style', 0)) ?>"><?php esc_html_e('View', 'specular') ?></a>
                        </span>
                    </div>
                          
                    <div class="show_text">
                        <h5><a href="<?php echo esc_url($link) ?>"><?php echo get_the_title() ?></a></h5>
                    </div>         
                 
                </div>

            <?php } ?>
        <!-- Portfolio Normal Mode End -->


<?php endwhile;  ?>

<?php if(!isset($codeless_used_for_element)): ?>
    </div>
<?php endif; ?>

<?php } ?>

<?php if(!isset($codeless_used_for_element)): ?>

<?php codeless_pagination_display(); ?>

<?php endif; ?>