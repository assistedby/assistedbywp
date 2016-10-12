<?php
/*
 * set constants for local / staging / production
 * whichever environment you're working in set that constant to true
 * the rest should remain set to false
 */
define( 'WP_LOCAL', false );
define( 'WP_STAGING', false );
define( 'WP_PRODUCTION', false );

/**
 * these are the connection details for this environments database
 * used for this instance of WordPress
 */
define( 'DB_NAME', '' );
define( 'DB_USER', '' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

/**
 * custom content directory
 * available here in case staging is on a sub domain then in a folder
 * no need to change for local or live most likely
 */
define( 'WP_CONTENT_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . '/content' );