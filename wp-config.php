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
define('DB_NAME', 'rcarlosc_wandergt');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'MyNewPass');

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
define('AUTH_KEY',         '0|R6;vp;F^0@[~6o#,*i C+:-Mv<eO%--CXU{B]U%.wdH?XGwx<wW^0MM5d{+%2$');
define('SECURE_AUTH_KEY',  'YJn2Prk6_I:;l|_[%ikJ*;eG+dSjENPu[surT+5/P;b[B@t]DQSK|H,(k#l 6??D');
define('LOGGED_IN_KEY',    'r)@M+r%So`g}#2*U5:J-Ht-`1-eE^1fpCx]c|NiN(|!n+}-:|MS_QGw~&?9B%t~3');
define('NONCE_KEY',        'Q>>]~S}ljz]2^Ot2=PLO_Xm7RU>%S=]t7A%MQnx1*.PPURX6H,M].Y#mJOh,}+=;');
define('AUTH_SALT',        'WV09G#,=CP/Y`RdhBx8l[(h?/|k5H3n!;bJz.p??V@H-vE;0S()S_lasXU4UL5*Z');
define('SECURE_AUTH_SALT', '*6KXUam#Bdg^rTDy(f^Y8O)9y:[@Kj.&`^.-k>u{@h0d2X!|Q{g-6*+)g0?/n~5p');
define('LOGGED_IN_SALT',   'P]qb79:hT:kof+|Hz}-ku9d&Bel/j:#yCvgkomH6F.A{T{Asyw9hNq.:91/~}--m');
define('NONCE_SALT',       '.k!4`it|=}0fzTUe=(A`r(kQ:vY65N ukM+J8u/IcQI{j% ,+Bk3-31(golAx4|e');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wan_';

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
