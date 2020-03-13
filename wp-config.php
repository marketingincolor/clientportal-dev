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
define( 'DB_NAME', 'clientportal_dev' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'Hlda-j1$a&bGErHjUJ3TaQ|KEDOZySoxr=K*Gzjf~KO5Bbu^EIWxq[5T>_,Fd>qP' );
define( 'SECURE_AUTH_KEY',  'j$!qtC- S[R#tQVY%@ly9Wcz3DX22h.0iL[>rGAuGE-K%0doF(E#h~dMZ!c0G^]Q' );
define( 'LOGGED_IN_KEY',    '.7.V=p:<9il4 h-MXC&l^3tHFiVm2(hYD!-$z sd>s?)3S~mpno+4Q9WW%9d?@fI' );
define( 'NONCE_KEY',        ',tDd@:WYGP=?{[u[kXo%rt2hfG~8T|jn1b3H.VokS }*`w75tvxlR%tTAnS$ib;C' );
define( 'AUTH_SALT',        ';q`lO4dTfM 1Ielg0Hw>VPfQGgzZ5WMa:H1J coSI:I3=bLc?,Oftm:ESB$,*+T8' );
define( 'SECURE_AUTH_SALT', '9T,u.ly{;NSNjDd?u2g&ZUUs2Fa5/;T;F@7qBuEq)7Xr+5mN!8SEmX*V]V`c%0Y:' );
define( 'LOGGED_IN_SALT',   'nb&`2_2B,q*^:AFy40+O7<|]rLtFcaj{cMqNH7{, ,[NJZ^y0`V,Z3Ta&WF#srQU' );
define( 'NONCE_SALT',       '{vp+iHiUMmTPoYcPt_Jz8.Zp5RX7 T O.=kbs{W.`Q/(htR_vNZ:p!h($8G&=+^9' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
