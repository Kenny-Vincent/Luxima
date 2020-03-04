<?php 

/* ---------- Slider ---------------- */

wp_reset_postdata();

$extra_class= '';
if(( is_home() || is_page()) && !is_single() ){

    if(codeless_get_mod('slider_fixed'))
        $extra_class = 'fixed_parallax';

    $slider = new codeless_slideshow(codeless_get_post_id());
    if($slider && $slider->slide_number > 0 && $slider->slide_type != '' && $slider->slide_type != 'none'){

        if($slider->options['slideshow_layout'] == 'boxed'){

            $slider->img_size = 'portfolio_bottom';

    ?>

    

    <section id="slider-fixed" class="slider <?php echo esc_attr($extra_class) ?>" style="<?php echo esc_attr($extra_style) ?>">

        <div class="container">

            <div class="row">

                <div class="span12">

    <?php

    }elseif($slider->options['slideshow_layout'] == 'fullwidth'){

    ?>


    <section id="slider-fullwidth"  class="slider <?php echo esc_attr($extra_class) ?>">
                                       
    <?php }  ?>

        <?php echo codeless_complex_esc( $slider->display() ); 

        if($slider->options['slideshow_layout'] == 'boxed'){ ?>


                </div>    
            </div>
        </div>
    </section>

     <?php }else{ ?>

    </section>


    <?php }

    }else{ ?>
        <?php  if( codeless_get_post_id() != 0 && has_post_thumbnail(codeless_get_post_id() ) && codeless_get_mod('use_featured_image_as_photo')): ?>
        
            <span class="slider-img" style="background-image:url('<?php echo esc_url(codeless_image_by_id(get_post_thumbnail_id(codeless_get_post_id()), '', 'url')) ?>');"></span>
        
        <?php endif; ?>
    <?php }

}
/* ---------- End Slider -------------- */
?>   