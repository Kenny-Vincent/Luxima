<?php
/*
Template Name: Archive
*/

codeless_current_view( 'blog' );

$spancontent = 12;
$layout = codeless_get_page_layout();

if($layout == 'fullwidth')
    $spancontent = 12;
else
    $spancontent = 9;

$blog_page = codeless_get_mod('blogpage');

get_header();

?>
 
<?php $blog_style = codeless_get_mod('blog_style'); ?>
   
<?php get_template_part('template_inc/page_header'); ?>
<section id="content" class="<?php echo esc_attr($layout) ?>"  style="background-color:<?php echo ( codeless_get_mod( 'page_content_background' ) )?esc_attr(codeless_get_mod( 'page_content_background' )):''; ?>;">
        <div class="container" id="blog">
            <div class="row">

            <?php if($layout == 'sidebar_left') get_sidebar() ?>   

                <div class="span<?php echo esc_attr($spancontent) ?>">
                <?php
                    if($blog_style == 'grid')
                        get_template_part( 'includes/view/blog/loop', 'grid' ); 
                    elseif($blog_style == 'alternate')
                        get_template_part( 'includes/view/blog/loop', 'second-style' );
                    elseif($blog_style == 'masonry')
                        get_template_part( 'includes/view/blog/loop', 'masonry' );
                    elseif($blog_style == 'timeline')
                        get_template_part( 'includes/view/blog/loop', 'timeline' );
                    else
                        get_template_part( 'includes/view/blog/loop', 'index' );
                ?>

            </div>

            <?php wp_reset_query(); ?> 

            <?php if($layout == 'sidebar_right') get_sidebar() ?>  

            </div>
        </div>
</section>

<?php get_footer(); ?>