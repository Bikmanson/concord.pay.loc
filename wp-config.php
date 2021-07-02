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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'concord' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );

/** MySQL hostname */
define( 'DB_HOST', 'concord-mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'MMBVq`AKy@X)wtIj|gxX*kzRUdyy_9KuxH53eE{*/6*=.|  FyRu]*C>(.Ieuyc?');
define('SECURE_AUTH_KEY',  '^ajdP)a%0}C%& 9X::fq!SU=-iGd}0qD-S~-Ft/.(dAod)6/zHFcy_$A$4/Zp)V!');
define('LOGGED_IN_KEY',    'B G- }_}%xo<# )tu^Y:mZF7@4e+KGc80oj6C}}Ush|;tl+fE^(><Y9<#;--Wtl7');
define('NONCE_KEY',        '.-,559BRkR1 V$fHB6:Nba(5^ASH,HHH@!O%/0Z/F,2!K]d(If[]Ae|7KHm_3wol');
define('AUTH_SALT',        's436.o7VV7oE|0Vp{4|zls_AixA-W-]b+5m`01({J7/+DZ5$qQXMPVLZ4DwL =x]');
define('SECURE_AUTH_SALT', 'Kr~+piNEY::5* C-ncg7^>]Hfur`j,b7=_4w>ng)|sxzG-D0y1e-k` (>URtF{j}');
define('LOGGED_IN_SALT',   '42|5gvl}IY7TmDZ8ehtm#P0#{qTIw-A0OfxM<#:/G0Lb7TI6hi3O@$mL+BV[f_ep');
define('NONCE_SALT',       'Mq!hK464J-o8QAMMs0,.J9#h6#[:{&-,?4sE%2B8LGUTtYrmhS=!,[W7BM|3&$k|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
