<?php

global$for_element;

do_action('codeless_excecute_query_var_action','loop-index');

if (have_posts()) :

    ?>
    <div id="blogmasonry" class="<?php if(codeless_get_mod('blog_grid_col')) echo 'cols'.codeless_get_mod('blog_grid_col'); else echo 'cols3';  ?>">
        <div class="row filterable">
            <div class="grid-size"></div>
    <?php

    while (have_posts()) : the_post();



        $post_id    = get_the_ID();

        $title      = get_the_title();

        $content    = get_the_content();

        $content    = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content ));

                

        $post_format = get_post_format($post_id);

        if(strlen($post_format) == 0)

            $post_format = 'standart';

        $count = 0;

        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));

        if(count($comment_entries) > 0){

            foreach($comment_entries as $comment){

                if($comment->comment_approved)

                    $count++;

            }

        }


        $tags = get_the_tags();
        $tag_out = '';
        if( $tags ){
            $num=count($tags);
            $i=0;
            foreach($tags as $tag):
                if(++$i === $num){
                    $tag_out .= $tag->name;
                }
                else {
                    $tag_out .= $tag->name.', ';
                }
            endforeach;
        }
        
        $no_shadow = '';
        if(!codeless_get_mod('timeline_box_shadow'))
            $no_shadow = 'no_shadow';

        ?>

        

        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('row-fluid blog-article grid-style shadowbox-style '.$no_shadow.' normal'); ?>>                    
            
            <div class="gridbox">
            
         <?php if($post_format == 'standart'){
                $icon_class="pencil";
            }elseif($post_format == 'audio'){
                $icon_class="music";
            }elseif($post_format == 'soundcloud'){
                $icon_class="music";
            }elseif($post_format == 'video'){
                $icon_class="play";
            }elseif($post_format == 'quote'){
                $icon_class="quote-left";
            }elseif($post_format == 'gallery'){
                $icon_class="image";
            }elseif($post_format == 'image'){
                $icon_class="images";
            }


         ?>



                <div class="media">
                    <!-- <div class="post_type"><i class="moon-<?php echo esc_attr($icon_class) ?>"></i></div> -->
                    <?php if($post_format == 'audio'){

                        echo do_shortcode('[soundcloud]'.get_the_excerpt().'[/soundcloud]');

                    }elseif(get_post_thumbnail_id()){ ?>
                        <a href="<?php echo esc_url(get_permalink()) ?>"><div class="overlay"><div class="post_type_circle"><i class="icon-chevron-right"></i></div></div></a>
                        <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), '', 'url')) ?>" alt="<?php echo esc_attr__('Featured Image', 'specular') ?>">
                                                        
                    <?php }elseif($post_format == 'gallery'){

                            $slider = new codeless_slideshow(get_the_ID(), 'flexslider');

                            if($slider && $slider->slide_number > 0){
                                
                                $slider->img_size = 'blog_grid';
                                $sliderHtml = $slider->render_slideshow();
                                echo codeless_complex_esc($sliderHtml);

                            }

                    }elseif($post_format == 'video'){

                            $video = ""; 

                            $link = codeless_get_mod('media_post_link');

                            if(codeless_backend_is_file( $link, 'html5video')){

                                $video = codeless_html5_video_embed($link);

                            }
                            else if(strpos($link,'<iframe') !== false)
                            {
                                $video = $link;
                            }
                            else
                            {
                                global $wp_embed;
                                $video = $wp_embed->run_shortcode("[embed]".trim($link)."[/embed]");
                            }

                            if(strpos($video, '<a') === 0)
                            {
                                $video = '<iframe src="'.esc_url($link).'"></iframe>';
                            } 

                            echo codeless_complex_esc($video);

                    } ?>
                
                </div>

                <div class="content">
                    <?php echo get_the_category_list(); ?>
                    <h3><a href="<?php echo get_permalink() ?>"><?php echo esc_html(get_the_title()) ?></a></h3>
                    
                    
                    <div class="author-img"> 
                        <div class="img-wrap"><?php 
                            echo get_avatar( get_the_author_meta('email'), '60' ); 
                        ?></div>
                    </div>
                    <ul class="post-info">
                        <li><?php echo get_the_author() ?></li>
                        <li><?php echo get_the_date() ?></li>
                    </ul>

                </div>
            </div>
        </article>

    <?php endwhile; ?>

    </div>
</div> 
    
    <?php if(!is_single() && (!isset($for_element) || !$for_element)): ?>

        <?php codeless_pagination_display(); ?>
    
    <?php endif; ?>

<?php endif;

?>