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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Midwest_Burners' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'Mnh2IfEz0btWeQrL' );

/** Database hostname */
define( 'DB_HOST', 'devkinsta_db' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'eoq>RS:Y:=*BtU_3Y_Ub*]Y#[|[<85djo,qZ{0!aehpbt<EpL?)e(aa_bS]M*`vP' );
define( 'SECURE_AUTH_KEY',   '{6HTU499E%fPJ[DT6zDTK(kRz2|GqueXAf$;(&6YL!=7{Afw)@EVa+<E.TZltb*9' );
define( 'LOGGED_IN_KEY',     '%}o=V7q}_owlekZ0Br=F ^&pHq%a.ljtStZP ?7[0hn]sUc]l_)F&&]kv&*;exg4' );
define( 'NONCE_KEY',         '6%3(J*QZFwcB[!rwP1l^oNLWHeX#WyXcV9T6G{To*KNyyc37dhOb((mgcmQsWm*|' );
define( 'AUTH_SALT',         'eaYAsmV.DI #`wWMz%Ovl,}l t3BM^lx5unPJ-Hy=H47g<U48A?)]?g@l=^a3QAG' );
define( 'SECURE_AUTH_SALT',  ';oAC }r57bVBflg@nKMKJ]7K;3yzh+`T;6j0,v6~;,/O3H?O:pxeiiaq8wPhB8-B' );
define( 'LOGGED_IN_SALT',    'b)uBgIYaFYAyqaF<URlE6Q7yK{PvT55wC*J#H/w7REITvGm$,-GJSDx)=MeT,-6;' );
define( 'NONCE_SALT',        'FcX)$NQxhA@=-4aKdAWOhkQ7->BI}C$dMn>kE:gln@O Q&tQ^Q?fM@2o]wY(mSeW' );
define( 'WP_CACHE_KEY_SALT', 'jwF`uAl<cZ0CVwThA`;1}CKA vhkWwWsSVJ)%+Cmhx&h@Ie.7>3VYtofTtPgPi1g' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}



define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', true );
$base = '/';
define( 'DOMAIN_CURRENT_SITE', 'undefined' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );

define('ADMIN_COOKIE_PATH', '/'); 
define('COOKIEPATH', ''); 
define('SITECOOKIEPATH', ''); 
// define('COOKIE_DOMAIN', false);
define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST'] );



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
