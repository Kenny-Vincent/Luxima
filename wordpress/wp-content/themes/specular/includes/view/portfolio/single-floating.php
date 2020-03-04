<?php

do_action('codeless_excecute_query_var_action','loop-single_portfolio_bottom');

?>

<div class="container">
    <div class="row-fluid">
            
        <?php if(codeless_get_mod('single_portfolio_content_position_floating') == 'left'): ?>
            <div class="span3 fixed_sidebar">
                <div class="description">
                    <h4><?php esc_html_e('Project Description', 'specular') ?></h4>
                    <?php the_content(); ?>
                </div>
                <div class="details">
                    <h4><?php esc_html_e('Project Details', 'specular') ?></h4>

                    <ul class="info">
                        <?php if( codeless_get_mod('single_portfolio_custom_params') ): for($i = 0; $i < count(codeless_get_mod('single_portfolio_custom_params')); $i++): ?>
                            <?php if( codeless_get_mod('single_portfolio_custom_fields', $i) ): ?>
                                <li><span class="title"><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_params', $i)) ?></span><span><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_fields', $i) ) ?></span></li>
                            <?php endif; ?>
                        <?php endfor;  endif; ?>
                        <?php if(codeless_get_mod('portfolio_post_like')): ?>   
                            <li class="post-like"><?php echo codeless_get_post_like_link( get_the_ID() ); ?></li> 
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?> 

        <div class="span9">
            <div class="media">
                <?php if( codeless_get_mod('single_portfolio_gallery')): foreach(codeless_get_mod('single_portfolio_gallery') as $slide): ?>

                    <img src="<?php echo esc_url(codeless_image_by_id($slide['attachment_id'], '', 'url'))  ?>" alt="<?php echo esc_attr__('Portfolio Image', 'specular') ?>">

                <?php endforeach; ?>
                <?php endif; ?>
                
            </div>
        </div>

        <?php if(codeless_get_mod('single_portfolio_content_position_floating') == 'right'): ?>
            <div class="span3 fixed_sidebar">
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
                            <li class="post-like"><?php echo codeless_get_post_like_link( get_the_ID() ); ?></li> 
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?> 
    </div>

    <?php if(codeless_get_mod('single_portfolio_active_comments')) comments_template( '/includes/view/blog/comments.php');  ?>
</div>