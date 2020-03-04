<?php

do_action('codeless_excecute_query_var_action','loop-single_portfolio_bottom');

?>

<div class="media">
    <?php if(codeless_get_mod('single_portfolio_media') == 'featured'): ?>
        <div class="featured" style="background-image:url('<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url'))  ?>');"></div>
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
        }
                           
    ?>
</div>
<div class="container">
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
                        <li><span class="title"><?php echo codeless_complex_esc(codeless_get_mod('single_portfolio_custom_params', $i)) ?></span><span><?php echo codeless_complex_esc(codeless_get_mod('single_portfolio_custom_fields', $i) ) ?></span></li>
                    <?php endif; ?>
                <?php endfor;  endif; ?>
                <?php if(codeless_get_mod('portfolio_post_like')): ?>   
                    <li class="post-like"><?php echo codeless_get_post_like_link( get_the_ID() ); ?></li> 
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php if(codeless_get_mod('single_portfolio_active_comments')) comments_template( '/includes/view/blog/comments.php');  ?>
</div>
