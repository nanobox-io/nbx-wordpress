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
define('DB_NAME', "gonano");

/** MySQL database username */
define('DB_USER', $_SERVER["DB_USER"]);

/** MySQL database password */
define('DB_PASSWORD', $_SERVER["DB_PASS"]);

/** MySQL hostname */
define('DB_HOST', $_SERVER["DB_HOST"]);

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
define('AUTH_KEY',         '^J~nIZ6lsA] cyT| e)CUgs}G4:8smD+D5|p}Z]O~:z[PCoWv0/0>^ZUIkmS.=(/');
define('SECURE_AUTH_KEY',  '9pjKCHy9-9^b|.d9h ByTl5#HaNpK8o.yG1a;}|Dk4@(nA$.}OQXQh-0Tyk*t*]n');
define('LOGGED_IN_KEY',    'e!o&P0rk8|oa{f2>m)^tR1Is#R|L[YX2fsG1%Wg<vdl{AT-_FG@)|H+Ix8V_jswx');
define('NONCE_KEY',        'QG!33JG^E:?3o}]/$q{-WR:r+J9pmvYqE4T{(/Q+ 7 ,hcMjMoNAoqvOv>2*URby');
define('AUTH_SALT',        'xkgb4LC6AEr[o5g2l]u>#kgH_A+6<CyI=]5$vF(%C&<;OJ#}&Z5!-14t;!b`r=AO');
define('SECURE_AUTH_SALT', 'kD_hmY:lgo0NvLW*btl1U)i1d`nx$8DO|mgpeJ<JGu1Nki>+kzB{J (gxD-d|C-B');
define('LOGGED_IN_SALT',   'Ev:=uHa7V$5k3W^&SKucjNr*Opo$(ijKqNvN$5M+zo,wgq]Us9e:IWzLso.O,bT|');
define('NONCE_SALT',       '`SdlV;,}uY[{|q)aS+$3#+^%`CC0;5W|,lw}5z#;=Lu6CP+(Ad&nAWlGkEA`y;8H');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
