<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/**
 * Allow all file uploads eg: SVG
 * Only allow locally
 */
define('ALLOW_UNFILTERED_UPLOADS', false); 

/*
 * Compression
 */
define('COMPRESS_SCRIPTS', true);
define('COMPRESS_CSS', true);
define('ENFORCE_GZIP', true);

/**
 * Disable automatic update
 *
 * @link http://codex.wordpress.org/Configuring_Automatic_Background_Updates
 */
define('AUTOMATIC_UPDATER_DISABLED', true);

/**
 * Limit number of revisions saved
 *
 * @link https://codex.wordpress.org/Revisions
 */
define('WP_POST_REVISIONS', 10);

/**
 * Update default mem limit
 *
 * @link http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP
 */
define('WP_MEMORY_LIMIT', '64M');

/**
 * Disable dashboard file editing
 *
 * @link http://codex.wordpress.org/Hardening_WordPress#Disable_File_Editing
 */
define('DISALLOW_FILE_EDIT', true);

/**
 * WordPress Environment
 *
 * The default usage is:
 * 	development - For local development
 *	production - For live site
 */
define('WP_ENV', 'development');

// Switch MySQL settings based on environment
switch(WP_ENV){
	// Development
	case 'development':
		/** The name of the local database for WordPress */
		define('DB_NAME', 'local_database_name_here');

		/** MySQL local database username */
		define('DB_USER', 'local_username_here');

		/** MySQL local database password */
		define('DB_PASSWORD', 'local_password_here');
	break;
	// Production
	case 'production':
		/** The name of the live database for WordPress */
		define('DB_NAME', 'live_database_name_here');

		/** MySQL live database username */
		define('DB_USER', 'live_username_here');

		/** MySQL live database password */
		define('DB_PASSWORD', 'live_password_here');
	break;
}

// ** MySQL settings - You can get this info from your web host ** //
/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8mb4_unicode_ci');

/** Custom Content Directory **/
define('WP_CONTENT_DIR', dirname( __FILE__ ) . '/app');
define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/app');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/wp/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
