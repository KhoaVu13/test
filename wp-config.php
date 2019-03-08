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
define( 'DB_NAME', 'text' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '@m[5VeGx#ZY$*%#VXgLP).`a*W8Vh.rp-VbIDIt&~<!nD6T6U.kW/$Vw=u}X+~H[' );
define( 'SECURE_AUTH_KEY',  'P]yg`{e[_IG0zOs&NqbI8ttkLMAC@*M`?~_}gOma3]o^JI@YJ4nuqLJ/vr]65//e' );
define( 'LOGGED_IN_KEY',    'dTgaqFU$i|~ElxibgaC=$C)#==<9WQ:5aVk9_!S%q8N{4RtOl{${I|uQm,mK_i_c' );
define( 'NONCE_KEY',        'DBAVBe39F7Qil0IUZR,0-Sj[jFXZn+gwmlMIJ~Oa(;DZ.,:bIpW]u]k+8AEPV@q9' );
define( 'AUTH_SALT',        'F:Ce<N%O&D6:QV[e9t+Ll88g{z.2u{$1*(T-M:qV9K&sd5]e%:_o/tLn%>Ky}E0e' );
define( 'SECURE_AUTH_SALT', '>i42hCnSAY2YUiSI@W5P%)(T5}K<w]U!0}%_,;XC~QZ)YY?16hm7SsAKO1yjK]4#' );
define( 'LOGGED_IN_SALT',   'U(8iU=eO<ik#cc~.8Su6LyLkEUYv6v-xR>=bKv]Mmbkp4jeql4hk9usj mC~g1:=' );
define( 'NONCE_SALT',       'zM=ADS[0{By*Lp{wn-HJa:G14:e?3cv%GQ+1s,4{*v_R2(*Mez._+$y +<3N-^&Y' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
