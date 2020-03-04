<?php


get_header();

get_template_part('includes/view/page_header');

?>

   
<section id="content"  style="background-color:<?php echo ( codeless_get_mod('page_content_background'))?esc_attr(codeless_get_mod('page_content_background')):'#ffffff'; ?>;">

<?php if(have_posts()){ 

    while (have_posts()) : the_post(); ?>
        
        <div class="row-fluid">
            
            <div class="portfolio_single single_portfolio_<?php echo esc_attr(codeless_get_mod('single_portfolio_style')) ?>" data-id="<?php echo esc_attr(get_the_ID()) ?>">
                
                <?php if( ! codeless_get_mod('single_portfolio_style') ):
                    codeless_set_mod('single_portfolio_style', 'container');
                    codeless_set_mod('single_portfolio_content_position_container', 'bottom');
                endif; ?>      

                <?php get_template_part('includes/view/portfolio/single', codeless_get_mod('single_portfolio_style'));  ?>    


                <?php if( codeless_get_mod('single_portfolio_related') ): ?>
                    <div class="single_portfolio_related">
                            <div class="row-fluid">
                                <div class="container">
                                    <div class="span12">
                                        <h4><?php esc_attr_e( 'Related Items', 'specular' ); ?></h4>
                                        <?php echo do_shortcode( '[recent_portfolio columns="4" related="1"]' ) ?>
                                    </span>
                                </div>

                            </div>
                    </div>
                <?php endif; ?>
            </div>
        
        </div>

        

<?php endwhile; } ?>

        <div class="nav-growpop">
            <?php if(is_object(get_previous_post())): ?>
            <a class="prev" href="<?php echo esc_url(get_permalink(get_previous_post()->ID)); ?>">
                <span class="icon-wrap"><i class="icon-angle-left"></i></span>
                <div>
                    <h3><?php echo esc_html(get_previous_post()->post_title); ?></h3>
                    <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(get_previous_post()->ID), 'blog_grid', 'url')) ?>" alt="Previous thumb"/>
                </div>
            </a>

            <?php endif; ?>
            <?php if(is_object(get_next_post())): ?>
            <a class="next" href="<?php echo esc_url(get_permalink(get_next_post()->ID)); ?>">
                <span class="icon-wrap"><i class="icon-angle-right"></i></span>
                <div>
                    <h3><?php echo esc_html(get_next_post()->post_title); ?></h3>
                    <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(get_next_post()->ID), 'blog_grid', 'url')) ?>" alt="Next thumb"/>
                </div>
            </a>
            <?php endif; ?> 
        </div>


        
                 
</section><!-- #content -->   

<?php get_footer() ?>