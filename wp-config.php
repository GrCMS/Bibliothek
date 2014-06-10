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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'd01a1d4f');

/** MySQL database username */
define('DB_USER', 'd01a1d4f');

/** MySQL database password */
define('DB_PASSWORD', 'nX8rmppRpHVtSM6h');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '2{LUeK{OW4?+qI|X_#+{en_]j#i5gShvWMKI,Db-FS),`+mMGSt%/YD+$m`>1Em#');
define('SECURE_AUTH_KEY',  'hscna:9rezG|l=Uhm-iFOw^I|Jb9Lp&C!%# xdGO<AFOwPYI^U,bg:f$?}Uk2Xf4');
define('LOGGED_IN_KEY',    'gYCth9JzkEDR3!0nrQlThD3Ll0(vr_imD?CFA #7s;m91K1}/t#my,l0z&#$T`[:');
define('NONCE_KEY',        'WDa{$Rq>-|&@2+TZ<n<z4YlW~mh9ebbWJZ=QUj+}83`?D8x9G<X;=+w0`m$[|.CM');
define('AUTH_SALT',        'w+B6%fP_-lpgyT!CvR}&6k-D}ieZG@V:&~-!D8{ue?Z@y|z68+EodS?8%PcR6U-R');
define('SECURE_AUTH_SALT', 'd|HoRQRD#-KS0eF!#oA}qgAA&)$zamj1JH/zsEF14Fj@zvwqg9iQvP8~|vNw6{.@');
define('LOGGED_IN_SALT',   ':C-)tB&orZX*2G![D3dW_P%Y.+@vE{}tIg->&4+X)-+yOlxGD/NQYzF5x2-B#<6]');
define('NONCE_SALT',       '{@NkW+:LWGY+Xs|Ft)QRna?|pQe68:uKMl{&`x9!Tll%:(gF>--a^V@0>z{Dk-_ ');

/**#@-*/

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
define('WPLANG', 'de_DE');

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
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
