<?php 

/* --------------------- Load Widgets -------------------------------- */
require_once cl_file_path( 'APP_ROOT', '/include/widgets/codeless_flickr.php' );
require_once cl_file_path( 'APP_ROOT', '/include/widgets/codeless_mostpopular.php' );
require_once cl_file_path( 'APP_ROOT', '/include/widgets/codeless_shortcodewidget.php' );
require_once cl_file_path( 'APP_ROOT', '/include/widgets/codeless_socialwidget.php' );
require_once cl_file_path( 'APP_ROOT', '/include/widgets/codeless_topnavwidget.php' );
require_once cl_file_path( 'APP_ROOT', '/include/widgets/codeless_twitter.php' );
require_once cl_file_path( 'APP_ROOT', '/include/widgets/codeless_ads.php' );
/* --------------------- End Load Widgets ---------------------------- */


add_action( 'widgets_init', 'codeless_register_widgets' );

function codeless_register_widgets(){
    codeless_widget_register( 'CodelessTwitter' );
    codeless_widget_register( 'CodelessSocialWidget' );
    codeless_widget_register( 'CodelessFlickrWidget' );
    codeless_widget_register( 'CodelessShortcodeWidget' );
    codeless_widget_register( 'CodelessMostPopularWidget');
    codeless_widget_register( 'CodelessTopNavWidget');
    codeless_widget_register( 'CodelessAdsWidget');
}

