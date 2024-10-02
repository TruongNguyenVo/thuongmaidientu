<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'thuongmaidientu' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'A>U %8iWl<zJWC8]HYz8i-0EOIT$3*4vAiymE!d6! AS9DMzmI&=ZUz3X7H@#4iu' );
define( 'SECURE_AUTH_KEY',  'H&~bGA/b=pMk2*c04Zhx+u;Y#| ,nm?]+}>V0PRB[$hGfv9&S:>f&.|D`I/O0%(3' );
define( 'LOGGED_IN_KEY',    '5Wkb7o/$-<&rZw.&V, WiFS/#(c,goH+b YSrX4RQr.(}cutiz}+k(u6Uux=/Xs#' );
define( 'NONCE_KEY',        '*tIG@$G/wk$m#VUg+@I$Y@Ap)NbmqSO$$BIFg5%XP/=;Mm:Qp|f/O`uj5(dw~c-D' );
define( 'AUTH_SALT',        '-(^Jct/-)@@H9! IMXQg%B~s^O#-0<1%E;RQG.*p@=uM!WHKa0qt/F_Ovrb KAg|' );
define( 'SECURE_AUTH_SALT', '} |f9Qce-dE5YuNq+?9dR%m1KHOi[=YrmF(vttp7&{2n7 2GXmhlj%F. @b[`|dj' );
define( 'LOGGED_IN_SALT',   'h*moTtbTiu{*U/]F;a8Zv;D(+tvokj>p[zwP@7)&ihUIPjx6>U{oo>p83g`9LjK|' );
define( 'NONCE_SALT',       'ZYx.VQUL3s8u~_Q4;GC{z7E@HPMI)vv}ravV#wq#z&~v_jOJF8FWM9(|nJ2= <n9' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
