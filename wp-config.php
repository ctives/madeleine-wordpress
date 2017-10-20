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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         ']6qreVQ(ctFb_mQ_/GaKtUG|hHWDjyH+$Ms9Q#{.lS_tJJUV.Bm$^QQ-1J{G,ie-');
define('SECURE_AUTH_KEY',  '.}G~YL8!niInQ&JrU,YgY-*D6qZ^E<?89,i-WYr[787(^ac#$p5rTI_^mc:o;M|d');
define('LOGGED_IN_KEY',    'pj:Z;`cI%D3!Q!Wz;R!tbJrev2&R~pn#p5[XL9BX7bfTN.o&~Y<?~+gewakm4_8i');
define('NONCE_KEY',        'n]v]avZngReYD5+7-d.X3PQvEx6w8IcA6Y17BPY6hG,*nXOYJ$(olTl4lF$#[P3y');
define('AUTH_SALT',        'Ubd3z{TiW7EF|x?U1a8@w$D1Df7xU-.G<oA<>)[Q_LDXlNZ6[_-]`ArlHdu:RnVW');
define('SECURE_AUTH_SALT', '{+4]?^u%$2EbGM#h0{I]O^t3rVGz;} dG,(`Or7>07AY_MI+:><pCIWeU29W3jU8');
define('LOGGED_IN_SALT',   'JyNuj[G%z[Rp?*d(gB44QZ$9-NSRnmd$[)ldF+H_bl;,8qvuU0?Uc|%bzxU{SV*n');
define('NONCE_SALT',       '&~b[Is7Qg}{yJB:KQ~/~{^+q~Gy9&dvS*.p#*EF6ua!l$96uk_Ji&rgiCYKja/*]');

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
