<?php
/*
* Plugin Name: Autrics Essentials
* License - GNU/GPL V2 or Later
* Description: This is a required plugin for Autrics theme.
* Version: 1.4
* text domain: autrics-essntial
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Add language
add_action( 'init', 'autrics_language_load' );
function autrics_language_load(){
    $plugin_dir = basename(dirname(__FILE__))."/languages/";
    load_plugin_textdomain( 'autrics-essntial', false, $plugin_dir );
}

// main class
class Autrics_Essentials_Includes {

    // auto load
    // ----------------------------------------------------------------------------------------
	public static function init() {
     
        self::_action_init();
        add_action( 'widgets_init', array( __CLASS__, '_action_widgets_init' ) );
	}


    // directory name to class name, transform dynamically
    // ----------------------------------------------------------------------------------------
	private static function dirname_to_classname( $dirname ) {
		$class_name	 = explode( '-', $dirname );
		$class_name	 = array_map( 'ucfirst', $class_name );
		$class_name	 = implode( '_', $class_name );

		return $class_name;
    }

    // include and register widgets
    // ----------------------------------------------------------------------------------------
	public static function include_widget( $widget_dir ) {
        $rel_path = '/widgets';
        $path = self::get_path( $rel_path ) . '/' . $widget_dir;
        if ( file_exists( $path ) ) {
            self::include_isolated( $path . '/widget-class.php' );
        }

		register_widget( 'Autrics_' . self::dirname_to_classname( $widget_dir ) );
	}

    // include method
    // ----------------------------------------------------------------------------------------
	public static function include_isolated( $path ) {
        include $path;
	}

    // directory path for theme core
    // ----------------------------------------------------------------------------------------
	private static function get_path( $append = '' ) {
		$path = plugin_dir_path( __FILE__ ) . 'includes';
		return $path . $append;
    }
    
    // include widgets
    // ----------------------------------------------------------------------------------------
	public static function _action_widgets_init() {
        self::include_widget('instagram');
        self::include_widget('recent-post');
        self::include_widget('social');
        self::include_widget('footer-address');
        self::include_widget('service-hour');
    }

    // include files
    // ----------------------------------------------------------------------------------------
	public static function _action_init() {
        self::include_isolated( self::get_path('/post-type/post-class.php') );
    }
  
}

Autrics_Essentials_Includes::init();