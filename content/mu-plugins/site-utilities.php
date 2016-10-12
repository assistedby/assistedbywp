<?php
/*
Plugin Name: Site Utilities
Description: Site-wide snippets of code to make things happen!
Version: 0.1
License: GPL version 2 or any later version
Author: Mark Wilkinson
Author URI: http://markwilkinson.me/
*/

/**
 * function hrd_change_theme_options_menu_name()
 * changes the name of the menu item of theme options framework
 */
function hrd_change_theme_options_menu_name( $menu ) {
	
	/* alter the options menu paramters */
	$menu[ 'menu_title' ] = 'Site Options'; // set the menu title
	$menu[ 'page_title' ] = 'Site Options'; // set the menus page title
	$menu[ 'mode' ] = 'menu'; // make the menu a top level menu item
	$menu[ 'position' ] = '81'; // make the menu item appear after settings
	
	/* return our modified menu */
	return $menu;
	
}

add_filter( 'optionsframework_menu', 'hrd_change_theme_options_menu_name' );

/**
 * function optionsframework_option_name()
 *
 * overwrites the function in the options framework which
 * names the options value that stores all the options
 */
function optionsframework_option_name() {
	
	/* get the options framework setting from options */
	$optionsframework_settings = get_option( 'optionsframework' );
	
	/* set the id element as our new theme options name */
	$optionsframework_settings[ 'id' ] = 'site_options';
	
	/* save the optionsframework option setting */
	update_option( 'optionsframework', $optionsframework_settings );
	
}

/* check whether this already exists */
if( ! function_exists( 'get_site_option' ) ) {
	
	/**
	 * function get_site_option()
	 * gets a theme options specificed from the options table
	 * @param (string) $name is the name of the options to get
	 * @param (string) $default is the default value to return if no value is present
	 */
	function get_site_option( $name, $default = false ) {
		
		/* get the options framework setting option */
		$optionsframework_settings = get_option( 'optionsframework' );
		
		/* get the option with all our options stored in */
		if( get_option( $optionsframework_settings['id'] ) ) {
			$options = get_option( $optionsframework_settings['id'] );
		}
		
		/* if the name of the option request is present */
		if( isset( $options[ $name ] ) ) {
			
			/* return the option value */
			return $options[ $name ];
		
		/* options requested returns nothing */
		} else {
			
			/* return the default supplied in the function */
			return $default;
			
		}
		
	}
	
}

/* removes the loading of jquery migrate */
function hrd_remove_jquery_migrate( &$scripts ) {
	
	if( ! is_admin() ) {

		/* remove the default jquery script from wp */
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, array( 'jquery-core' ) );
	
	}

}

add_filter( 'wp_default_scripts', 'hrd_remove_jquery_migrate' );