<?php

$sidebar_style = "";



if(codeless_get_page_layout() != 'fullwidth'):  ?>

    

    <aside class="span3 sidebar" id="widgetarea-sidebar">

        <?php dynamic_sidebar(codeless_get_mod('right_sidebar_dual')); ?>

    </aside>



<?php endif; ?>