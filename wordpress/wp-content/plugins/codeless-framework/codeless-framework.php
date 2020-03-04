<?php
/**
 * Plugin Name: Codeless Framework
 * Plugin URI: http://codeless.co
 * Description: Codeless Framework Tools for Specular & Tower Theme
 * Version: 1.0.2
 * Author: Codeless
 * Author URI: http://codeless.co
 * License: GPL2
 */
 
 // don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Current version
 */
if ( ! defined( 'CL_FRAMEWORK_VERSION' ) ) {

	define( 'CL_FRAMEWORK_VERSION', '1.0.1' );
}




class Cl_Framework_Manager{
    
    private $paths;
    
    private $factory = array();

	private $plugin_name;
	
	private $custom_user_templates_dir = false;
    
    private static $_instance;
    
    public function __construct(){
        
        $dir = dirname( __FILE__ );

        
		
		/**
		 * Define path settings for visual composer.
		 *
		 * APP_ROOT        - plugin directory.
		 * WP_ROOT         - WP application root directory.
		 * APP_DIR         - plugin directory name.
		 * CONFIG_DIR      - configuration directory.
		 * ASSETS_DIR      - asset directory full path.
		 * ASSETS_DIR_NAME - directory name for assets. Used from urls creating.
		 * CORE_DIR        - classes directory for core vc files.
		 * HELPERS_DIR     - directory with helpers functions files.
		 * SHORTCODES_DIR  - shortcodes classes.
		 * SETTINGS_DIR    - main dashboard settings classes.
		 * TEMPLATES_DIR   - directory where all html templates are hold.
		 * EDITORS_DIR     - editors for the post contents
		 * PARAMS_DIR      - complex params for shortcodes editor form.
		 * UPDATERS_DIR    - automatic notifications and updating classes.
		 */
		$this->setPaths( array(
			'APP_ROOT' => $dir,
			'WP_ROOT' => preg_replace( '/$\//', '', ABSPATH ),
			'APP_DIR' => basename( $dir ),
			'HELPERS_DIR' => $dir . '/include/helpers',
			'LOADER_DIR' => $dir . '/include/loader',
			'ASSETS_DIR' => $dir . '/assets',
			'ASSETS_DIR_NAME' => 'assets',


		) );
		// Load API
		require_once $this->path( 'HELPERS_DIR', 'helpers.php' );
		require_once $this->path( 'APP_ROOT', '/include/register-post-types.php' );
		require_once $this->path( 'APP_ROOT', '/include/register-shortcodes.php' );
		require_once $this->path( 'APP_ROOT', '/include/register-widgets.php' );
		require_once $this->path( 'APP_ROOT', '/include/shortcodes/shortcodes.php' );
		require_once $this->path( 'APP_ROOT', '/include/post-like.php' );
	
		// Add hooks
		add_action( 'plugins_loaded', array( &$this, 'pluginsLoaded' ), 9 );
		
		add_action( 'init', array( &$this, 'init' ), 999 );


		$this->setPluginName( $this->path( 'APP_DIR', 'codeless-framework.php' ) );
    }
    
    
    public static function getInstance() {
		if ( ! ( self::$_instance instanceof self ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	
    
    public function init() {
		
		
	}
	
    
    protected function setPaths( $paths ) {
		$this->paths = $paths;
	}
	
	
	public function path( $name, $file = '' ) {
		$path = $this->paths[ $name ] . ( strlen( $file ) > 0 ? '/' . preg_replace( '/^\//', '', $file ) : '' );
		return $path;
	}
	
	
	public function pluginsLoaded() {


		// Setup locale
		load_plugin_textdomain( 'cl_builder', false, $this->path( 'APP_DIR', 'locale' ) );
	

		
	}
	
	
	protected function setVersion() {
		$version = get_option( 'cl_framework_version' );
		if ( ! is_string( $version ) || version_compare( $version, CL_FRAMEWORK_VERSION ) !== 0 ) {
			update_option( 'cl_framework_version', CL_FRAMEWORK_VERSION );
		}
	}
	
	public function setPluginName( $name ) {
		$this->plugin_name = $name;
	}
	
	

	
	public function pluginUrl( $file ) {
		return preg_replace( '/\s/', '%20', plugins_url( $file , __FILE__ ) );
	}
	
	public function assetUrl( $file ) {
		return preg_replace( '/\s/', '%20', plugins_url( $this->path( 'ASSETS_DIR_NAME', $file ), __FILE__ ) );
	}

	public function pathUrl( $file ) {
		return preg_replace( '/\s/', '%20', plugins_url( $file, __FILE__ ) );
	}
}


global $cl_framework;
if ( ! $cl_framework ) {
	$cl_framework = Cl_Framework_Manager::getInstance();
}


 
 
 ?>