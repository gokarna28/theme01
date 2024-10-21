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
define( 'DB_NAME', 'theme01' );

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
define( 'AUTH_KEY',         '0FV*Quj`c`[Y-a$iOtZ}-Imf&c_!<SY2)nb)Q!h{Gx@Bcwa1CUH3&A#E[9q$`]y8' );
define( 'SECURE_AUTH_KEY',  'zshYb4jPKjm;$PjLC^#R]V^~YedCJCiBOdI<W;?R,F|Cg|t@Y2a~xntXqTV:&>+3' );
define( 'LOGGED_IN_KEY',    ' Y;I;BbprG4<Y0wTy>?[(7V#znX`~lR+CEpVa+d}-9ZdJ`3o)1dh}OIN6_>p_HJ~' );
define( 'NONCE_KEY',        'dYz?sK@jC$XXc/0![mp4E92-g5*VQhp*v40TAUKA,*SS!B~1E&4^?QRb603jgF+g' );
define( 'AUTH_SALT',        '3QU_0I/^7sH/T|(PC-faBtD/b`U`scT*I*di`APmN}8:cCH7Sqg[[[vw}!NJV,BM' );
define( 'SECURE_AUTH_SALT', '[YjD<|G J)>DJDEso+F$#MQ(mL[+:Ln{m2Tpol(>p>U0%(4?!onUed9UD,#&UlN ' );
define( 'LOGGED_IN_SALT',   'TPRUpx{d(YroA{VQBE$1W@BA:@t:OR>psp/&y`SfuX#Ut^.Rq6sI;*k@S%]YJJC&' );
define( 'NONCE_SALT',       'hpH@GmQDh`WP(0PKv/?o~;p.0c7faC`j`5Kr:@D9@}akQos<S_;4;ENe&jM#rNMG' );

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
