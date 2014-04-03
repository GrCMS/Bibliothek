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
define('AUTH_KEY',         'olz?+L=}1?ct9Vpb{3}Zw!XlGi+>!,R>:Zj%bT:TU3A[6{lRks?jsOncBISh%-#X');
define('SECURE_AUTH_KEY',  '-0Xjsb%g;Rwe+JMNa&kzS`zBo%B[<RD4O>%te;-43-AO~K_}otxr^A_`/Us>DLW*');
define('LOGGED_IN_KEY',    '^2O*_mTZ{0prBF?%+z0W:v9mU0KhK=D9Mc4062oT&iLugf;*y/|`E?I$rCXF U|a');
define('NONCE_KEY',        '^ef+3Pb}-PBzs|id-xU?f:Z}2xPrV=LfQ|T+l-E0~`NeDceTRRGvF;9Km%Db+.5-');
define('AUTH_SALT',        '~4{/Fjs5#EyHsln|9@}>lt%*b`*-Ma:%FiKX0^t[cc&ypN{C;|~M9Y+cqHN4j-Z]');
define('SECURE_AUTH_SALT', 'ZA /`<%p_VK}Z]lG-VLBUExn#rB8D-:]VNCcm<S+Mg~}#?;lx+5@@#en~`p(y~j8');
define('LOGGED_IN_SALT',   '+OoK?-mY,(MmxY!f}j^<& G%sD,GP63.~{)q]Mw7+Sfn2nc{{19lo{*&veYfgqUg');
define('NONCE_SALT',       'TSx_| GCKVCE8zEi_?.G6p/4+5$1jRh:[vL##WunTfD_D @cz1POjFU0C-ys.F)V');

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
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
