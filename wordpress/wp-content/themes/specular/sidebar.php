<aside class="span3 sidebar" id="widgetarea-sidebar">

    <?php 
    
    if( is_active_sidebar( codeless_get_sidebar_name() ) ) 
        dynamic_sidebar( codeless_get_sidebar_name() );
    
    ?>

</aside>


