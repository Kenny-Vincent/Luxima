<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $test_cat
 * @var $duration
 * Shortcode class
 * @var  WPBakeryShortCode_Testimoniual_Carousel
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
        
<div class="wpb_content_element left_testimonial_carousel_element">

    <section class="left_testimonial_carousel owl-carousel owl-theme" data-duration="<?php echo esc_attr($duration) ?>"> 

        <?php
        if((int) $test_cat == 0)
            $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'testimonial' );                          
        else{
            $query_post = array('posts_per_page'=> 9999, 
                                'post_type'=> 'testimonial',
                                'tax_query' => array(   array(  'taxonomy'  => 'testimonial_entries', 
                                                                                    'field'     => 'id', 
                                                                                    'terms'     => (int) $test_cat,  
                                                                                    'operator'  => 'IN')) );
        }
        $loop = new WP_Query($query_post);

        if($loop->have_posts()){

            while($loop->have_posts()){

                $loop->the_post();
                
                ?>

                    <div class="item">

                        <p><?php echo get_the_content() ?></p>

                            <div class="param">

                                <?php if( has_post_thumbnail() ): ?>
                                    <img src="<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(), 'thumbnail', 'url')) ?>" alt="<?php echo esc_attr__('Testimonial Image', 'specular') ?>" />
                                <?php endif; ?>

                                <div class="content">
                                    <h6><?php echo esc_html(get_the_title()) ?>, </h6>
                                    <span class="position"> <?php echo esc_attr(codeless_get_mod('staff_position')) ?></span>
                                </div>
                            </div>

                    </div>

                <?php
            }

        }

        wp_reset_postdata();

        ?>

    </section>

</div>