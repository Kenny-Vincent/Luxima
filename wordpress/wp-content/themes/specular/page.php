<?php

do_action( 'codeless_routing_template' , 'page' );
codeless_current_view('page');

$id = codeless_get_post_id(); 
if( function_exists( 'redux_post_meta' ) )
    $replaced = redux_post_meta('cl_redata',(int) $id);

if(!empty($replaced))
    foreach($replaced as $key => $value){
        codeless_set_mod($key, $value);
    }

$layout = codeless_get_page_layout();

if($layout == 'fullwidth')
    $spancontent = 12;
else if($layout == 'dual')
    $spancontent = 6;
else
    $spancontent = 9;


get_header();

get_template_part('includes/view/page_header'); ?>

<?php if(!codeless_get_mod('fullscreen_sections_active')): ?>    
<?php $extra_class=''; if( get_the_content() == '' ) $extra_class = 'empty-content'; ?>
<section id="content" class="composer_content <?php echo esc_attr( $extra_class ); ?>" style="background-color:<?php echo (codeless_get_mod('page_content_background'))?esc_attr(codeless_get_mod('page_content_background')):'#ffffff'; ?>;">
        <?php if($spancontent != 12 || !codeless_is_vc()){ ?>
        <div class="container <?php  echo esc_attr($layout) ?>" id="blog">
            <div class="row">
            <?php if($layout == 'sidebar_left' || $layout == 'dual') get_sidebar() ?>   
                <div class="span<?php echo esc_attr($spancontent) ?>">
                    
                    <?php get_template_part( 'includes/view/loop', 'page' ); ?>
                    <?php 
                        if ( !class_exists( 'WPBakeryShortCode' ) && comments_open() || get_comments_number() ) :
                            comments_template('/includes/view/blog/comments.php');
                        endif; 
                    ?>
                </div>
                <?php
                
                wp_reset_query();    
    
                if($layout == 'sidebar_right' || $layout == 'dual') if($layout != 'dual') get_sidebar(); else get_sidebar('dual');

                ?>

            </div>
        </div>
        <?php }else{ ?>

            <?php get_template_part( 'includes/view/loop', 'page' ); wp_reset_query(); ?>            
            <?php
                if ( !class_exists( 'WPBakeryShortCode' ) && comments_open() || get_comments_number() ) :
                    comments_template('/includes/view/blog/comments.php');
                endif;
            ?>
        <?php } ?>

</section>

<?php else: ?>
    
    <div id="fullpage">
        <?php get_template_part( 'includes/view/loop', 'page' ); wp_reset_query(); ?>
    </div>

<?php endif; ?>


<?php get_footer(); ?>