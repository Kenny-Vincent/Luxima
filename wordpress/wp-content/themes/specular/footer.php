<?php


wp_reset_query();

?>

    <a href="#" class="scrollup">Scroll</a> 

<?php // TOP wapper closed ?> 
<?php if((int) codeless_get_post_id() && redux_post_meta('cl_redata',(int) codeless_get_post_id(), 'post_style') != 'fullscreen' ): ?>
</div>
<?php endif;?>
<!-- Footer -->
    <?php 

    $main_footer_bool = false;
    $columns = esc_attr(codeless_get_mod('footer_columns')); 
    for( $i = 1; $i <= $columns; $i++ ) {

        if( is_active_sidebar('footer-column-' . $i) ){
            $main_footer_bool = true;
            break;
        }

    }
    
    ?>
    <div class="footer_wrapper">
        
        
        <footer id="footer" class="">
            <?php if( $main_footer_bool ): ?>
                <?php if(codeless_get_mod('show_footer')): ?>
                <div class="inner">
                    <div class="container">
                        <div class="row-fluid ff">
                            <!-- widget -->
                            <?php
                            
                            
                            for($i = 1; $i <= $columns; $i++): ?>
                                <div class="span<?php echo 12/$columns ?>">
                                
                                    <?php 
                                    
                                    if ( is_active_sidebar('footer-column-'.$i) )
                                        dynamic_sidebar('footer-column-'.$i);
        
                                    ?>
                                    
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>

            
            <?php if(codeless_get_mod('show_copyright') ): ?>
            <div id="copyright">
    	    	<div class="container">
    	        	<div class="row-fluid">
    		        	<div class="span12 desc"><div class="copyright_text"><?php echo codeless_complex_esc(codeless_get_mod('copyright_text')); ?></div>
                            <div class="pull-right">
                                <?php 
                                if( is_active_sidebar('sidebar-7') )
                                  dynamic_sidebar('sidebar-7');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- #copyright -->
            <?php endif; ?>
        </footer>
    </div>
    <!-- #footer -->

<?php if(codeless_get_mod('site_layout') == 'boxed'): ?> 
</div>
<?php endif; ?>
</div>
<?php wp_footer(); ?>

</body>
</html>