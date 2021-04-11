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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'arclab6_wp' );

/** MySQL database username */
define( 'DB_USER', 'arclab6_wp' );

/** MySQL database password */
define( 'DB_PASSWORD', 'XjUgMTtTynZF' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '?4=8_wD88ep+}pomJ32Ok:RzpG[M>.6Ev]As{>g6m#by~1VEZJwwCv`bVXr5.(s6' );
define( 'SECURE_AUTH_KEY',   '+GfF+Z|l,e$/%7&/qkT@cBZkl51Y<CT/A>&vbP-<78A?.(KO0H/lE(<leXH6]lvo' );
define( 'LOGGED_IN_KEY',     ':-uA(UvhnMd_] Z7PO*=;af#VNnr8TP^TdqZIP%m.K&e}(||;T8mG]:T`g3yG{vg' );
define( 'NONCE_KEY',         '5J[@:@M^sPoFuGkax;3A+$w3m+B0z(*nV*qZCNZSZugG//LgE;NC@0m/ml5lZyd@' );
define( 'AUTH_SALT',         'yzP]NCsKO@<e~#AEh5ZjY5F,YDbiC4;)ej]>>]Q/Non;= p>Q_f,?.xYJ;#rU4:k' );
define( 'SECURE_AUTH_SALT',  'a_Jo4-2ru+_Ud|XjerQEVn$@S,SSiXKB96+Ts1b,R[?.-a)//OGHz|8{i)3f>vge' );
define( 'LOGGED_IN_SALT',    'ByjMC>b>kh<*siyxP^)$I/GiOD2/ QI.Go=`@@ge|bc3}j`S(JRyyh_S-:4zA&}k' );
define( 'NONCE_SALT',        'V&L`frD=m7Bn 62}:/67ku0 zQEqv*:fD[-s2>?`CW-qO;jqL8cz[@q(v8J!];AL' );
define( 'WP_CACHE_KEY_SALT', 'jD{?AoNkWmBEnGeH9dD7p37?j9U-!E^}Xxx;#u[ZvYbIIH-,&JI,p@deCZ>;A=QT' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpstg0_'; // Changed by WP Staging

define(‘WP_POST_REVISIONS’, true);
//define( 'WP_DEBUG', true );


define( 'MEDIA_TRASH', true );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
define('UPLOADS', 'wp-content/uploads'); 
define('WP_PLUGIN_DIR', __DIR__ . "/wp-content/plugins"); 
define('WP_LANG_DIR', __DIR__ . "/wp-content/languages"); 
define('WP_HOME', 'https://wp.arclabs.ca/staging'); 
define('WP_SITEURL', 'https://wp.arclabs.ca/staging'); 
define('WP_CACHE', false); 
define('WP_ENVIRONMENT_TYPE', 'staging'); 
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
