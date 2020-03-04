<?php

do_action('codeless_excecute_query_var_action','loop-index');

if (have_posts()) :
    
    while (have_posts()) : the_post();
        
        $post_id    = get_the_ID();
        $title      = get_the_title();
        $font_color = (codeless_get_mod('page_header_menu_color') == 'auto')? '':'background--'.codeless_get_mod('page_header_menu_color');
        ?> 
        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('blog-article fullscreen-single '.$font_color.' intro-effect-push'); ?>>
			<div class="header_fullscreen_single">
				<div class="bg-img" style="background-image:url(<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url')) ?>)"></div>
				<div class="title">
					<h1><?php echo esc_html($title) ?></h1>
				</div>
			</div>
			<button class="trigger"><span>Trigger</span></button>
			<div class="title">
				
				<h1><?php echo esc_html($title) ?></h1>
				<ul class="info">
                    <li><i class="linecon-icon-user"></i><?php esc_html_e('Posted by', 'specular') ?> <?php echo get_the_author() ?></li>   
                    <li><i class="linecon-icon-calendar"></i><?php esc_html_e('On', 'specular') ?> <?php echo get_the_date() ?></li>                      
                    <li><i class="icon-comment-o"></i><?php echo esc_attr($count) ?> <?php esc_html_e('Comments', 'specular') ?></li> 
                    <?php if(codeless_get_mod('post_like')): ?>  
                    <li class="post-like"><?php echo codeless_get_post_like_link( get_the_ID() ); ?></li>     
                	<?php endif; ?>
                </ul>
			</div>
			<div class="content">
				<div>
					<?php the_content() ?>
                    <?php comments_template( '/includes/view/blog/comments.php');  ?>
				</div>
			</div>
        </article>
		
		<?php

    endwhile;
endif;


?>

