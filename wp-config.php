<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kolayekr_remotifyNew' );

/** MySQL database username */
define( 'DB_USER', 'kolayekr_remotifyNew' );

/** MySQL database password */
define( 'DB_PASSWORD', '#NlkK=1YT~uQ' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'H77TRa41:5o@Q/d%C(4iCcLrUs4Vjz0x0H(5E*AS]2p3b1U+[/4K_tJLWdkxJIWE');
define('SECURE_AUTH_KEY', ';::W@z5:]i8*vXX-71~h!mkv~-vt4M~gu+Mp4M4M4xBFvLur48EFx25-0%7894h&');
define('LOGGED_IN_KEY', '3S5B!1JmI!SM26D9#!]|-Bo(41dy4&U&b|9x]4~w8vaw~hJ7G45!-x154(/S04~i');
define('NONCE_KEY', '7R7O%JV)l-:27AE/p/j2Ge!8A&h6(2Ji|Jcv%+EDYAf)M2l77S7lF98D51Q6BQ-@');
define('AUTH_SALT', 'glL17zJ-y|;umZE58kNw@s%_K:D8g(0#9E|H;fEeg:5lxqb]2Er@B-g1Qs6569xK');
define('SECURE_AUTH_SALT', ')0I74-v:xwbQrT82!e&oid#2Ui2:M)2ENQIp4z]6A9~2c0h:q|yz;/Dj&I4H]aD@');
define('LOGGED_IN_SALT', '32u9#Gw+3UQ3G4m65m6d9ssx20;Zb7wA94j2Nt9[6D![Gp)EcSlp[4893v#:h03t');
define('NONCE_SALT', '8vPX_WXuO]Pg:548x!hjP22q4m796v;U--IG75!VfSU6GeH8[19e5yf[Ujy%57vv');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'remotify_';


define('WP_ALLOW_MULTISITE', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
