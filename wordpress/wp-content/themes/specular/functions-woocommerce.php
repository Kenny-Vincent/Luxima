<?php

add_theme_support('woocommerce');

if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
    add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
    define( 'WOOCOMMERCE_USE_CSS', false );
}

function codeless_enqueue_woocommerce_style(){
    
    if ( class_exists( 'woocommerce' ) ) {
        wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
    }
}

add_action( 'wp_enqueue_scripts', 'codeless_enqueue_woocommerce_style' );

if ( ! function_exists( 'woocommerce_content' ) ) {

    /**
     * Output WooCommerce content.
     *
     * This function is only used in the optional 'woocommerce.php' template
     * which people can add to their themes to add basic woocommerce support
     * without hooks or modifying core templates.
     *
     * @access public
     * @return void
     */
    function woocommerce_content() {

        if ( is_singular( 'product' ) ) {

            while ( have_posts() ) : the_post();

                wc_get_template_part( 'content', 'single-product' );

            endwhile;

        } else { ?>


            <?php do_action( 'woocommerce_archive_description' ); ?>

            <?php if ( have_posts() ) : ?>

                <?php do_action('woocommerce_before_shop_loop'); ?>

                <?php woocommerce_product_loop_start(); ?>

                    <?php woocommerce_product_subcategories(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'product' ); ?>

                    <?php endwhile; // end of the loop. ?>

                <?php woocommerce_product_loop_end(); ?>

                <?php do_action('woocommerce_after_shop_loop'); ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                <?php wc_get_template( 'loop/no-products-found.php' ); ?>

            <?php endif;

        }
    }
}


remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10);

add_filter('loop_shop_per_page', function(){ return 8; }, 20 );


// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        
        if(codeless_get_page_layout() == 'fullwidth')
            return 4;
        return 3;
    }
}


function codeless_woo_related_products_limit() {

  global $product;
    
    $limit = 4;

    $args = array( 

        'post_type'             => 'product',

        'no_found_rows'         => 1, 
 
        'posts_per_page'        => $limit,

        'ignore_sticky_posts'   => 1,

        'post__not_in'          => array($product->get_id())

    );

    return $args; 

}

add_filter( 'woocommerce_related_products_args', 'codeless_woo_related_products_limit' );


function codeless_woocommerce_output_related_products() {

    woocommerce_related_products(4,4); // Display 4 products in rows of 2

}

add_action('admin_init','codeless_shop_thumbnails');


function codeless_shop_thumbnails()

{

    global $pagenow;

    if(is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) 

    {

        update_option('shop_catalog_image_size', array('width' => 350, 'height' => 500, 1));

        update_option('shop_single_image_size', array('width' => 600, 'height' => 600, 1));

        update_option('shop_thumbnail_image_size', array('width' => 160, 'height' => 160, 1));

    }

} 



add_filter('woocommerce_add_to_cart_fragments', 'codeless_woocommerce_header_add_to_cart_fragment');

function codeless_woocommerce_header_add_to_cart_fragment( $fragments ) {

    global $woocommerce;

    ob_start();

    ?>

    

    <div class="cart">

        <?php if(!$woocommerce->cart->cart_contents_count): ?>

        <a class="cart_icon" href="<?php echo esc_url(get_permalink(get_option('woocommerce_cart_page_id'))); ?>"><i class="moon-cart"></i></a>
        
        <div class="content">
            <span class="empty"><?php esc_html_e('Cart is empty', 'specular'); ?></span>
            <div class="checkout">

                <div class="view_cart  <?php echo esc_attr(codeless_get_mod('cart_dropdown_button')) ?>"><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_cart_page_id'))); ?>" class="btn-bt <?php echo esc_attr(codeless_get_mod('overall_button_style', 0)) ?>"><?php esc_html_e('View Cart', 'specular'); ?></a></div>

                <div class="subtotal"> 
                           <span class="subtotal_title"><?php esc_html_e('Subtotal:', 'specular'); ?> </span>
                           <?php $cart_subtotal = $woocommerce->cart->get_cart_subtotal(); 
                              echo codeless_complex_esc($cart_subtotal);?>
                </div>
            </div>
        </div>

        <?php else: ?> 

        <a class="cart_icon cart_icon_active" href="<?php echo esc_url(get_permalink(get_option('woocommerce_cart_page_id'))); ?>"><i class="moon-cart"></i></a> 



        <div class="content">


            <div class="items">
          
            <?php foreach($woocommerce->cart->cart_contents as $key => $cart_item): ?>

            

                <div class="cart_item">

                    <a href="<?php echo esc_url( get_permalink($cart_item['product_id']) ); ?>">

                    <?php echo get_the_post_thumbnail($cart_item['product_id'], array(70, 70)); ?>

                    <div class="description">

                        <span class="title"><?php echo esc_html($cart_item['data']->post->post_title); ?></span>

                        <span class="price"><?php echo esc_html($cart_item['quantity']); ?> x <?php echo codeless_complex_esc($woocommerce->cart->get_product_subtotal($cart_item['data'], $cart_item['quantity'])); ?></span> 

                    </div>

                    </a>

                    <a class="remove" href="<?php echo esc_url(wc_get_cart_remove_url($key)) ?>"></a>

                </div>

            <?php endforeach; ?>

            </div>
               

            <div class="checkout">
                
                <div class="view_cart <?php echo esc_attr( codeless_get_mod('cart_dropdown_button') ) ?>"><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_cart_page_id'))); ?>" class="btn-bt <?php echo esc_attr(codeless_get_mod('overall_button_style', 0)) ?>"><?php esc_html_e('View Cart', 'specular'); ?></a></div>

                <div class="subtotal"> 
                           <span class="subtotal_title"><?php esc_html_e('Subtotal:', 'specular'); ?> </span>
                           <?php $cart_subtotal = $woocommerce->cart->get_cart_subtotal(); 
                              echo codeless_complex_esc($cart_subtotal);?>
                </div>
            </div>

        </div>

        <?php endif; ?>

    </div>

    <?php

    $fragments['header#header .cart'] = ob_get_clean();
    $fragments['.sticky_menu .cart'] = $fragments['header#header .cart'];

    return $fragments;  

}

?>