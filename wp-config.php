<?php
/**
 * include our environment specific config file
 * this is used to define db connection details for different dev environments
 * as well as setting some constants specific to the environment being worked in
 */
include( dirname( __FILE__ ) . '/env-config.php' );

/* if this is a production / staging dev */
if ( defined( 'WP_PRODUCTION' ) && WP_PRODUCTION || defined( 'WP_STAGING' ) && WP_STAGING ) {
	
	/**
	 * prevents any file modifications from happening
	 * this includes wordpress auto updates
	 * also includes removing the file editor for themes and plugins
	 */
	define( 'DISALLOW_FILE_MODS', true );
	
}

/**
 * custom content folder
 * path to the custom content directory set here
 * see local env-config.php for the WP_CONTENT_URL definition
 */
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );

/**
 * You almost certainly do not want to change these
 */
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/**
 * Salts, for security - https://api.wordpress.org/secret-key/1.1/salt
 */
define('AUTH_KEY',         '');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    '');
define('NONCE_KEY',        '');
define('AUTH_SALT',        '');
define('SECURE_AUTH_SALT', '');
define('LOGGED_IN_SALT',   '');
define('NONCE_SALT',       '');

/**
 * Table prefix
 */
$table_prefix  = 'site_';

/**
 * limit the number of post revision to store
 */
define( 'WP_POST_REVISIONS', 25 );

/**
 * empty the trash for posts every 14 days
 */
define( 'EMPTY_TRASH_DAYS', 14 );

/**
 * Bootstrap WordPress
 */
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/cms/' );

require_once( ABSPATH . 'wp-settings.php' );