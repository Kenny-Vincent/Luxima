<?php

do_action('codeless_excecute_query_var_action','loop-page');

if (have_posts()) :

	while (have_posts()) : the_post();

        $post_id    = get_the_ID();

        $title   	= get_the_title();

        $content 	= get_the_content();

        $content    = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content ));

		echo codeless_complex_esc($content); 

    wp_link_pages( array(
      'before'      => '<div class="page-links">' . __( 'Pages:', 'specular' ),
      'after'       => '</div>',
      'link_before' => '<span class="page-number">',
      'link_after'  => '</span>',
    ));  

    endwhile;

endif;

?>