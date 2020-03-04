<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'luxima' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'root' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '^0*kL)Vo8%CoL/6SQC`Ej7W#9E/,0$|(`%a)Gp4=v3^02&[!52cDqF][Nu3.{i1@' );
define( 'SECURE_AUTH_KEY',  '&izQUD  JFGX#(Z|M^~Fi4!a7.Z;+W.:s`LXX/.3dj_zZ)c*Z+] kUBD[_dzN4/B' );
define( 'LOGGED_IN_KEY',    ' BRA(=T;H^PBz~qc]eE;Mx+W8524rqcQ%:gS;.,C;RnLdj[q|bJekmaC%M3fx/tU' );
define( 'NONCE_KEY',        'ksq[!b>}B!Dh}*LeOwp7zoD}[^0F u*rAWX>F~bON0y7~+r.]e/~3({rA|~;5*vg' );
define( 'AUTH_SALT',        'D[rr4yStsH;a4$_,h;MeD6d]~AE.3-az5#tmDbp)V^[:vPS[!fSp(UV)St/Zk(2R' );
define( 'SECURE_AUTH_SALT', 'TP.TyTrqEn4fz2,*N*z A<kk)$lN0x6?!2D)F12_Ne[Gb(MBEAEVG<M93M!6cz [' );
define( 'LOGGED_IN_SALT',   'B[qFhKU5z `#Sg!%HRh:uqGbw]#JO^8o/t1;wk=Qmj/kq)0}>zkD8H;Z0^*t&-4u' );
define( 'NONCE_SALT',       'iHHr/oz}!Pjn4p<HWfo^HpHzGsNCPDz;+HNBvZ&npW|!+==Y<r,{>_6*orY:D<)Y' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
