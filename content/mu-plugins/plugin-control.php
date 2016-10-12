<?php
/*
Plugin Name: Plugin control
Description: Force-enables or force-disables plugins, according to your rules
Version: 0.2
License: GPL version 2 or any later version
Author: Mark Jaquith
Author URI: http://coveredwebservices.com/
*/
 
class CWS_Disable_Plugins {
	protected $plugins = array();
	protected $message = 'Disabled in this environment';
 
	/**
	 * Sets up the options filter, and optionally handles an array of plugins to disable
	 * @param array $disables Optional array of plugin filenames to disable
	 */
	public function __construct( Array $plugins, $message = NULL ) {
		// Handle what was passed in
		foreach ( $plugins as $plugin )
				$this->choose( $plugin );
 
		if ( ! is_null( $message ) )
			$this->message = $message;
 
		// Add the filter
		add_filter( 'option_active_plugins', array( $this, 'alter' ) );
	}
 
	/**
	 * Adds a filename to the list of plugins to disable
	 */
	public function choose( $file ) {
		$this->plugins[] = $file;
		add_filter( 'plugin_action_links_' . plugin_basename( $file ), array( $this, 'change_action_links' ) );
	}
 
	function change_action_links( $actions ) {
		unset( $actions['activate'] );
		unset( $actions['delete'] );
		$actions['disabled'] = '<i>' . esc_html( $this->message ) . '</i>';
		return $actions;
	}
 
	/**
	 * Hooks in to the option_active_plugins filter and does the disabling
	 * @param array $plugins WP-provided list of plugin filenames
	 * @return array The filtered array of plugin filenames
	 */
	public function alter( $plugins ) {
		if ( count( $this->plugins ) ) {
			foreach ( (array) $this->plugins as $plugin ) {
				$key = array_search( $plugin, $plugins );
				if ( false !== $key )
					unset( $plugins[$key] );
			}
		}
		return $plugins;
	}
}
 
class CWS_Enable_Plugins extends CWS_Disable_Plugins {
	protected $message = 'Force-enabled';
 
	function change_action_links( $actions ) {
		unset( $actions['deactivate'] );
		unset( $actions['delete'] );
		$actions['enabled'] = '<i>' . esc_html( $this->message ) . '</i>';
		return $actions;
	}
 
	/**
	 * Hooks in to the option_active_plugins filter and does the enabling
	 * @param array $plugins WP-provided list of plugin filenames
	 * @return array The filtered array of plugin filenames
	 */
	public function alter( $plugins ) {
		if ( count( $this->plugins ) ) {
			foreach ( (array) $this->plugins as $plugin ) {
				$key = array_search( $plugin, $plugins );
				if ( false === $key )
					$plugins[] = $plugin;
			}
		}
		return $plugins;
	}
}
 
/* ============================================================== */
/* == Begin customization ======================================= */
/* ============================================================== */
/*
Usage:
 
new CWS_Enable_Plugins( array( 'plugin-dir/relative-path.php', 'another/path.php' ), 'Plugins screen message to replace action links' );
new CWS_Disable_Plugins( array( 'plugin-dir/relative-path.php', 'another/path.php' ), 'Plugins screen message to replace action links' );
 
Note that you can have multiple instances of each. Go nuts.
*/
 
if ( defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV ) { // For local dev
	new CWS_Disable_Plugins( array( 'vaultpress.php', 'vaultpress/vaultpress.php' ), 'Only available in Production' );
	new CWS_Disable_Plugins( array( 'registered-users-only.php', 'registered-users-only/registered-users-only.php' ), 'Only available in Staging.' );
} elseif ( defined( 'WP_STAGING_DEV' ) && WP_STAGING_DEV ) { // Else, production
	new CWS_Disable_Plugins( array( 'vaultpress.php', 'vaultpress/vaultpress.php' ), 'Only available in Production' );
	new CWS_Disable_Plugins( array( 'uploads-by-proxy.php', 'uploads-by-proxy/uploads-by-proxy.php' ), 'Only available in Local Dev.' );
} else {
	new CWS_Disable_Plugins( array( 'registered-users-only.php', 'registered-users-only/registered-users-only.php' ), 'Only available in Staging.' );
	new CWS_Disable_Plugins( array( 'uploads-by-proxy.php', 'uploads-by-proxy/uploads-by-proxy.php' ), 'Only available in Local Dev.' );
}