<?php
do_action('codeless_excecute_query_var_action','loop-single_portfolio_bottom');

?>

<div class="container">
    

    <?php if(codeless_get_mod('single_portfolio_content_position_container') != 'bottom' && codeless_get_mod('single_portfolio_content_position_container') != 'top'): ?>
    <div class="row-fluid">
            
        <?php if(codeless_get_mod('single_portfolio_content_position_container') == 'left'): ?>
            <div class="span3">
                <div class="description">
                    <h4><?php esc_html_e('Project Description', 'specular') ?></h4>
                    <?php the_content(); ?>
                </div>
                <div class="details">
                    <h4><?php esc_html_e('Project Details', 'specular') ?></h4>

                    <ul class="info">
                        <?php if( codeless_get_mod('single_portfolio_custom_params') ): for($i = 0; $i < count(codeless_get_mod('single_portfolio_custom_params')); $i++): ?>
                            <?php if( codeless_get_mod('single_portfolio_custom_fields', $i) ): ?>
                                <li><span class="title"><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_params', $i)) ?></span><span><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_fields', $i)) ?></span></li>
                            <?php endif; ?>
                        <?php endfor;  endif; ?>
                        <?php if(codeless_get_mod('portfolio_post_like')): ?>   
                            <li class="share_link"><a href="javascript:void(0)"><i class="steadysets-icon-share"></i></a></li>
                            <li class="post-like"><?php echo codeless_get_post_like_link( get_the_ID() ); ?></li> 
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        
        <?php endif; ?> 
        
        <div class="span9">
            <div class="media">
                
                <?php if(codeless_get_mod('single_portfolio_media') == 'featured'): ?>
                    <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
                <?php endif; ?>
                <?php 
                    if(codeless_get_mod('single_portfolio_media') == 'slideshow'): 
                        $slider = new codeless_slideshow(get_the_ID(), 'flexslider');
                            $slider->slides = codeless_get_mod('single_portfolio_gallery');
                            $slider->slide_number = count(codeless_get_mod('single_portfolio_gallery'));
                            if($slider && $slider->slide_number > 0){  
                                $slider->img_size = '';
                                $sliderHtml = $slider->render_slideshow();
                                echo codeless_complex_esc($sliderHtml);
                            }
                    endif; 
                ?>
                <?php 
                    if(codeless_get_mod('single_portfolio_media') == 'video'){
                            $video = ""; 

                            if(codeless_backend_is_file( codeless_get_mod('single_portfolio_video'), 'html5video')){

                                $video = codeless_html5_video_embed(codeless_get_mod('single_portfolio_video'));

                            }
                            else if(strpos(codeless_get_mod('single_portfolio_video'),'<iframe') !== false)
                            {
                                $video = codeless_get_mod('single_portfolio_video');
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim(codeless_get_mod('single_portfolio_video'))."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url(codeless_get_mod('single_portfolio_video')).'"></iframe>';
                            } 

                            echo codeless_complex_esc($video);               
                    }
                ?>
            </div>
        </div>
   
    <!------------ end single portfolio item with content at left-->


<!------------ single portfolio item with content at right-->
        <?php if(codeless_get_mod('single_portfolio_content_position_container') == 'right'): ?>
            <div class="span3">
                <div class="description">
                    <h4><?php esc_html_e('Project Description', 'specular') ?></h4>
                    <?php the_content(); ?>
                </div>
                <div class="details">
                    <h4><?php esc_html_e('Project Details', 'specular') ?></h4>

                    <ul class="info">
                        <?php if( codeless_get_mod('single_portfolio_custom_params') ): for($i = 0; $i < count(codeless_get_mod('single_portfolio_custom_params')); $i++): ?>
                            <?php if( codeless_get_mod('single_portfolio_custom_fields', $i) ): ?>
                                <li><span class="title"><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_params')[$i]) ?></span><span><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_fields')[$i]) ?></span></li>
                            <?php endif; ?>
                        <?php endfor;  endif; ?>
                        <?php if(codeless_get_mod('portfolio_post_like')): ?>   
                            <li class="shares"><a href="javascript:void(0)"><i class="steadysets-icon-share"></i></a></li>
                            <li class="share_link"><a href="javascript:void(0)"><i class="steadysets-icon-share"></i></a></li>
                            <li class="post-like"><?php echo codeless_get_post_like_link( get_the_ID() ); ?></li> 
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?> 
    </div>
    <?php endif; ?>
    <!------------end single portfolio item with content at right-->


<!------------ single portfolio item with content in bottom-->

    <?php if(codeless_get_mod('single_portfolio_content_position_container') == 'bottom'): ?>
    <div class="media">
        <?php if(codeless_get_mod('single_portfolio_media') == 'featured'): ?>
            <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
        <?php endif; ?>
        <?php 
            if(codeless_get_mod('single_portfolio_media') == 'slideshow'): 
                $slider = new codeless_slideshow(get_the_ID(), 'flexslider');
                    $slider->slides = codeless_get_mod('single_portfolio_gallery');
                    $slider->slide_number = count(codeless_get_mod('single_portfolio_gallery'));
                    if($slider && $slider->slide_number > 0){  
                        $slider->img_size = 'blog';
                        $sliderHtml = $slider->render_slideshow();
                        echo codeless_complex_esc($sliderHtml);
                    }
            endif; 
        ?>
        <?php 
                    if(codeless_get_mod('single_portfolio_media') == 'video'){
                            $video = ""; 

                            if(codeless_backend_is_file( codeless_get_mod('single_portfolio_video'), 'html5video')){

                                $video = codeless_html5_video_embed(codeless_get_mod('single_portfolio_video'));

                            }
                            else if(strpos(codeless_get_mod('single_portfolio_video'),'<iframe') !== false)
                            {
                                $video = codeless_get_mod('single_portfolio_video');
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim(codeless_get_mod('single_portfolio_video'))."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url(codeless_get_mod('single_portfolio_video')).'"></iframe>';
                            } 

                            echo codeless_complex_esc($video);               
                    }
        ?>

    </div>
    <div class="row-fluid content"> 
        <div class="span9">
            <h4><?php esc_html_e('Project Description', 'specular') ?></h4>
            <?php the_content(); ?>
        </div>
        <div class="span3">
            <h4><?php esc_html_e('Project Details', 'specular') ?></h4>

            <ul class="info">
                <?php if( codeless_get_mod('single_portfolio_custom_params') ): for($i = 0; $i < count(codeless_get_mod('single_portfolio_custom_params')); $i++): ?>
                    <?php if( codeless_get_mod('single_portfolio_custom_fields', $i) ): ?>
                        <li><span class="title"><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_params')[$i]) ?></span><span><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_fields')[$i]) ?></span></li>
                    <?php endif; ?>
                <?php endfor;  endif; ?>
                <?php if(codeless_get_mod('portfolio_post_like')): ?>   
                    <li class="post-like"><?php echo codeless_get_post_like_link( get_the_ID() ); ?></li> 
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
<!------------end single portfolio item with content in bottom-->


<!------------single portfolio item with content on top-->

    <?php if(codeless_get_mod('single_portfolio_content_position_container') == 'top'): ?>
    
    <div class="row-fluid content"> 
        <div class="span9">
            <h4><?php esc_html_e('Project Description', 'specular') ?></h4>
            <?php the_content(); ?>
        </div>
        <div class="span3">
            <h4><?php esc_html_e('Project Details', 'specular') ?></h4>

            <ul class="info">
                <?php if( codeless_get_mod('single_portfolio_custom_params') ): for($i = 0; $i < count(codeless_get_mod('single_portfolio_custom_params')); $i++): ?>
                    <?php if( codeless_get_mod('single_portfolio_custom_fields', $i) ): ?>
                        <li><span class="title"><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_params')[$i]) ?></span><span><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_fields')[$i]) ?></span></li>
                    <?php endif; ?>
                <?php endfor;  endif; ?>
                <?php if(codeless_get_mod('portfolio_post_like')): ?>   
                    <li class="post-like"><?php echo codeless_get_post_like_link( get_the_ID() ); ?></li> 
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="media">
        <?php if(codeless_get_mod('single_portfolio_media') == 'featured'): ?>
            <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">
        <?php endif; ?>
        <?php 
            if(codeless_get_mod('single_portfolio_media') == 'slideshow'): 
                $slider = new codeless_slideshow(get_the_ID(), 'flexslider');
                    $slider->slides = codeless_get_mod('single_portfolio_gallery');
                    $slider->slide_number = count(codeless_get_mod('single_portfolio_gallery'));
                    if($slider && $slider->slide_number > 0){  
                        $slider->img_size = 'blog';
                        $sliderHtml = $slider->render_slideshow();
                        echo codeless_complex_esc($sliderHtml);
                    }
            endif; 
        ?>
        <?php 
                    if(codeless_get_mod('single_portfolio_media') == 'video'){
                            $video = ""; 

                            if(codeless_backend_is_file( codeless_get_mod('single_portfolio_video'), 'html5video')){

                                $video = codeless_html5_video_embed(codeless_get_mod('single_portfolio_video'));

                            }
                            else if(strpos(codeless_get_mod('single_portfolio_video'),'<iframe') !== false)
                            {
                                $video = codeless_get_mod('single_portfolio_video');
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim(codeless_get_mod('single_portfolio_video'))."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url(codeless_get_mod('single_portfolio_video')).'"></iframe>';
                            } 

                            echo codeless_complex_esc($video);               
                    }
        ?>

    </div>

    <?php endif; ?>
<!------------end single portfolio item with content on top-->

    <?php if(codeless_get_mod('single_portfolio_active_comments')) comments_template( '/includes/view/blog/comments.php');  ?>
</div>