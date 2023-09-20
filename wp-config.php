<?php
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
define('DB_NAME', 'yangon_transformer');

/** MySQL database username */
define('DB_USER', 'yangon_transformer');

/** MySQL database password */
define('DB_PASSWORD', 'NZYSYkWjDytN2Csn');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'r! =4*Re/Y;.>,#v_+80{EIUU}=H DK.H:gYA/~Fb@-kd3%+q)tIY.2j{-v900lU');
define('SECURE_AUTH_KEY',  '`;%7Rv=,3f||~9>y0xSo!0g}[S#,CB}p(Mc%B*2P11uHm!4wOx?d#o3~1m~A_a|s');
define('LOGGED_IN_KEY',    '( a3M}*OAzgI/(8CtL7uH-pLlW8-uxhltu[#lrr6@v0VIk61*:^Yo4S1JT4_4u%/');
define('NONCE_KEY',        'c?q-W!#>(=+(E^4Mye*:3p!8xnM}]I]ai*@Sz9qv3]Z-= euV0cAiOAGu7y[8;k6');
define('AUTH_SALT',        'f>q3t_RKOWrlto >@v[fpJw98mrH5+g=XSj2Eg7&j*&Wi|<WYrV]*|v4q6 ?uoLT');
define('SECURE_AUTH_SALT', 'AUD:g1<n6yhN6%q}yI>rO-~]Y7hq&D$+eu1zKpo-;?) h,M)g;F+jX:e`zFqlsn~');
define('LOGGED_IN_SALT',   's.E}70Coto<jgJ6^jo&Tb@YbEsH/`-.?It7SEhr~B1PHRe+>$-/5ic%{H)O~)c]<');
define('NONCE_SALT',       'aTk5LnhsPBt}yj#sL:#LZ(VAyH.:Y~:E:j3(R~D/sC=mOT<>}. sk7s Ti236W0[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_HOME','https://yangontransformer.com' );
define('WP_SITEURL','https://yangontransformer.com' );
