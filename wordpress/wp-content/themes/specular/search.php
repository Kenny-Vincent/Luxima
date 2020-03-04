<?php

codeless_current_view('blog');

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

<?php get_template_part('includes/view/page_header'); ?>

<section id="content" class="<?php echo esc_attr($layout) ?>">
        
        <div class="container" id="blog">
            <div class="row">

            <?php if($layout == 'sidebar_left') get_sidebar() ?>   

                <div class="span<?php echo esc_attr($spancontent) ?>">
                <?php
                    if(have_posts()):
                        if($blog_style == 'grid')
                            get_template_part( 'includes/view/blog/loop', 'grid' ); 
                        elseif($blog_style == 'alternate')
                            get_template_part( 'includes/view/blog/loop', 'second-style' );
                        elseif($blog_style == 'timeline')
                            get_template_part( 'includes/view/blog/loop', 'timeline' );
                        else
                            get_template_part( 'includes/view/blog/loop', 'index' );
                    else:       
                ?>
                    <h3 style="font-weight:normal;"><?php esc_html_e('Your search did not match any entries', 'specular') ?></h3>
                    <p></p>
                    <p><?php esc_html_e('Suggestions', 'specular') ?>:</p>
                    <ul style="margin-left:40px">
                        <li><?php esc_html_e('Make sure all words are spelled correctly', 'specular') ?>.</li>
                        <li><?php esc_html_e('Try different keywords', 'specular') ?>.</li>
                        <li><?php esc_html_e('Try more general keywords', 'specular') ?>.</li>
                    </ul>
                <?php endif; ?>
                </div>

            <?php wp_reset_query(); ?> 

            <?php if($layout == 'sidebar_right') get_sidebar() ?>  

            </div>
        </div> 
        

        

</section>
<?php get_footer(); ?>