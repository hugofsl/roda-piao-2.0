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
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\xampp\htdocs\roda-piao-2.0\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'rodapiao-db' );

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
define( 'AUTH_KEY',         'r/Z[d iBT`JixEWcy_Kf+-KE$rr*Bcu;]{giJWdRE@fVuWy2qO#t;363t%Bcmru-' );
define( 'SECURE_AUTH_KEY',  'qgfJ K0vvRTPiUI@U8X%rhfe8!moi >IIFks]bu446*-mR<tJxXU$1_$]SsUQ.x3' );
define( 'LOGGED_IN_KEY',    'bu|fYI%]A9GJ%Z+]=1N!EY?dPuH`lpXlO=pf&@eOnc(r {(I0M?)Xfesu-._BJD&' );
define( 'NONCE_KEY',        '!NBU@WrxUy2oI1+dL 3r5BiRyHDaOynhS5*|{y )&nuArD5lRD,Q7,a@;tN},$98' );
define( 'AUTH_SALT',        '{@-_{%K]yfe2bw@Tz6zn{d)+];}Q53wg7 ??MuzW(e ~||+dL;9cjVhb|q6[{&PK' );
define( 'SECURE_AUTH_SALT', '`QO+.y`RE)gJ.Bt[W5Dcm>k7MU9T!_Fu/O8Nob*mLzB bUn9<@)N/_(3N#ml<9`h' );
define( 'LOGGED_IN_SALT',   't`},9OR}f9SrAs*W{wTMu[eh4s#V&ZZh-=D:b:hfpe$~$O$45$xDrN!0tIBO5[Gw' );
define( 'NONCE_SALT',       'nMK-z((vF{RTgo4i i0>V;g{=BPh[HcOYJ>B(xkZk>1LH50&<C/$8q#%{&}>JT?b' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
