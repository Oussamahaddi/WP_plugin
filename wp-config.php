<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'WP_plugin' );

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
define( 'AUTH_KEY',         'Z5EC28ol+0yLi;#Cz.8%ji_V4H%{p+O)Nz/!5DO)/ujTUzwfALZnQ9~Q7k7/8|L$' );
define( 'SECURE_AUTH_KEY',  ',9~;XL,K}T#znqV1QPI49;,bDEho*O6<g41r>`YG8}t8H78{KcCHA/HDKna4Zo<Z' );
define( 'LOGGED_IN_KEY',    'qrmTUhCeZO5o!x5?BXYR~Q(~~US!yqIz7NfY04%[=gXhh_KyyAQ6F Hs2z&O* ^6' );
define( 'NONCE_KEY',        'CA&kn5[Kj4:}vhc[J~l>P2|eoq`y=Ecs2-pq!e5N9E_>=rUy(-DCLP![hPHhjy)P' );
define( 'AUTH_SALT',        '#+uM?OF@;}E<L93G!CY>:z! P6|43l[{NP7.:&GF7$eg~n@/m=~QNsAhY,Z^-XY+' );
define( 'SECURE_AUTH_SALT', 'N]ejjbxnx-=M}oWe&,?emRA#fq+Y3(Z|n;b=>W1+uMD3QeBsI.<.rH)mM0b%gO6f' );
define( 'LOGGED_IN_SALT',   'H~p*ST9)OMwTjN[=A~PO qZre&kpZ_:ZAT%dN5j~MooaVo ,hXbbSr^VPnIa5j@,' );
define( 'NONCE_SALT',       'CT:|lbjx!/)hDK[UbCG*5&zjRWyqz;c;>jDS;GxP76TB|F=Wse.(G,O7>:)_xe[.' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
