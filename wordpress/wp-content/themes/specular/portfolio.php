<?php
/*
Template Name: Portfolio Page
*/

codeless_current_view('portfolio');

$id = codeless_get_post_id(); 
$replaced = redux_post_meta('cl_redata',(int) $id);

if(!empty($replaced))
    foreach($replaced as $key => $value){
        codeless_set_mod($key, $value);
    }
$layout = codeless_get_page_layout();
get_header();
get_template_part('includes/view/page_header');

?>

<section id="content" class="content_portfolio <?php echo esc_attr(codeless_get_mod('portfolio_layout')) ?> layout-<?php echo esc_attr($layout) ?>">
    
    <?php if(codeless_get_mod('portfolio_content') == 'top'): ?>
        <?php get_template_part( 'includes/view/loop', 'page' ); ?>
    <?php endif; ?>

    <?php if(codeless_get_mod('portfolio_layout') == 'in_container'): ?>
    <div class="container">
    <?php endif; ?>

        <?php if( codeless_get_mod( 'portfolio_filters' ) == 'enabled' ): ?>
            <div class="row-fluid filter-row">
                <?php if( codeless_get_mod('portfolio_categories') ): ?>
                    <?php if(codeless_get_mod('portfolio_layout') == 'fullwidth'): ?>
                    <div class="container">
                    <?php endif; ?>
                        <!-- Portfolio Filter -->
                        <nav id="portfolio-filter" class="span12">
                            <ul class="">
                                <li class="filter active all" data-filter="all"><a href="#" class="filter active" data-filter="all"><?php esc_html_e('View All', 'specular') ?></a></li>
                                
                                <?php foreach(codeless_get_mod('portfolio_categories') as $cat): ?>
                                    <?php $cat = get_term($cat, 'portfolio_entries'); ?>
                                    <?php if(is_object($cat)): ?>
                                    <li class="other filter"  data-filter=".<?php echo esc_attr($cat->slug) ?>"><a href="#" class="filter" data-filter=".<?php echo esc_attr($cat->slug) ?>"><?php echo esc_html($cat->name) ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    <?php if(codeless_get_mod('portfolio_layout') == 'fullwidth'): ?>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    

	    <?php 
	    	
            $grid = 'three-cols';
		    switch(codeless_get_mod('portfolio_columns')){
		        case '3':
		            $grid = 'three-cols';
		            break;
		        case '2':
		            $grid = 'two-cols';
		            break;
		        case '4':
		            $grid = 'four-cols';
		            break;
                case '5':
                    $grid = 'five-cols';
                    break;
		        case '1':
		            $grid = 'one-cols';
		            break;
		    }

    	?>
        <div class="row-fluid">
            <?php if($layout == 'sidebar_left') get_sidebar(); ?>

            <?php if($layout != 'fullwidth'): ?>
            <div class="span9">
            <?php endif; ?>

                <section id="portfolio-preview-items" class="<?php echo esc_attr($grid) ?> <?php echo esc_attr(codeless_get_mod('portfolio_space')) ?>" data-cols="<?php echo esc_attr(codeless_get_mod('portfolio_columns')) ?>">
                <?php
                        
                        if(codeless_get_mod('portfolio_mode') == 'grid')
                            get_template_part('includes/view/portfolio/loop', 'grid');

                        else if(codeless_get_mod('portfolio_mode') == 'masonry')
                            get_template_part('includes/view/portfolio/loop', 'masonry');
                        
                        wp_reset_query();
                        
                ?>
                </section>
                
            <?php if($layout != 'fullwidth'): ?>
            </div>
            <?php endif; ?>

            <?php if($layout == 'sidebar_right') get_sidebar(); ?>
		</div>
    <?php if(codeless_get_mod('portfolio_layout') == 'in_container'): ?>
	</div>
    <?php endif; ?>
    <?php if(codeless_get_mod('portfolio_content') == 'bottom'): ?>
        <?php get_template_part( 'includes/view/loop', 'page' ); ?>
    <?php endif; ?>
</section>
<?php get_footer(); ?>