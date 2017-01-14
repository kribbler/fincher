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
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'WP_MEMORY_LIMIT', '256M' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '!5,r(c_lQ)FEaG;:>h-)~&zxn[rtvo(0^H40G7EZH7Up;,K+9Yq}_9ZHT[p,#``Y');
define('SECURE_AUTH_KEY',  'yy|b:Ws@smv?]=pOcETnk+&fCQ@|k)n_DtH]sAU_oq()Kn07b*jX~~LS1Oie%~Xz');
define('LOGGED_IN_KEY',    'KoCQa+UKXu0ERA{T_Lh* nmq[jQbQLfc@!un{XQss`%dtrBuUl1T(#G<_Ri*Crd0');
define('NONCE_KEY',        '{o19m>EtBu-O[.!|l$?5}N}t+]dft4Q_pVqzD6]%{iq|g-HGzfWY-Nv|A:43A()h');
define('AUTH_SALT',        'A&6Y37.pSq|FqXeejd-D#|$U`)Z-sM<q=|HW/B:F>{kN+{+Lu_+*IAI+S9>n!{|<');
define('SECURE_AUTH_SALT', 'I:;;,9B9-RLG7gH9MxR`-WiVX5xtlkG%COcHJ=PMr _1 _:!Wh(FM -VxgSsW_#2');
define('LOGGED_IN_SALT',   '_XbLT+r<k)D2rF+tc5w>U-_+i)#QBYW_p}v(<t~5g+7NIIg<++O|*n]M#ai}{W:G');
define('NONCE_SALT',       '^})s(SP|1wR/+.TJ=:zZEEs5mNRg.|~mC(m?SIyCteB22tYeVI&-^aIgu$H:0Twm');

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

if ($_SERVER['REMOTE_ADDR'] == '83.103.200.163'){
	define('WPLANG', 'en_US');
} else {
	define('WPLANG', 'nb_NO');
}

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if ($_SERVER['REMOTE_ADDR'] == '83.103.200.163'){
	define('WP_DEBUG', false);
} else {
	define('WP_DEBUG', false);
}


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
