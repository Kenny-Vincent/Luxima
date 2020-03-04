<?php
do_action('codeless_excecute_query_var_action','loop-single_portfolio_bottom');

?>

<div class="container">
    <div class="gallery row">
        <?php if( codeless_get_mod('single_portfolio_gallery')): foreach(codeless_get_mod('single_portfolio_gallery') as $slide): ?>
        <a class="lightbox-gallery" href="<?php echo esc_url($slide['image']) ?>">
            <div class="visual lightbox">
                <img src="<?php echo esc_url(codeless_image_by_id($slide['attachment_id'], 'port3', 'url'))  ?>" alt="<?php esc_attr_e('Image', 'specular') ?>">
                <span class="moon-zoom"></span>
            </div>
        </a>
        <?php endforeach; ?>
        <?php endif; ?>
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
                        <li><span class="title"><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_params')[$i]) ?></span><span><?php echo esc_attr(codeless_get_mod('single_portfolio_custom_fields', $i)) ?></span></li>
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