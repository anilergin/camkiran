<?php

/** Enable W3 Total Cache 
 // Added by W3 Total Cache*/

/**
 * WordPress için taban ayar dosyası.
 *
 * Bu dosya şu ayarları içerir: MySQL ayarları, tablo öneki,
 * gizli anahtaralr ve ABSPATH. Daha fazla bilgi için 
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php düzenleme}
 * yardım sayfasına göz atabilirsiniz. MySQL ayarlarınızı servis sağlayıcınızdan edinebilirsiniz.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * @package WordPress

define("ADMIN_COOKIE_PATH", "/camkiran/mng-db"); */
// ** MySQL ayarları - Bu bilgileri sunucunuzdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */
define('DB_NAME', 'camkiran_camkiran');

/** MySQL veritabanı kullanıcısı */
define('DB_USER', 'camkiran_camkira');

/** MySQL veritabanı parolası */
define('DB_PASSWORD', 'ghtok11TIO');

/** MySQL sunucusu */
define('DB_HOST', 'localhost');

/** Yaratılacak tablolar için veritabanı karakter seti. */
define('DB_CHARSET', 'utf8mb4');

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define('DB_COLLATE', '');

/**#@+
 * Eşsiz doğrulama anahtarları.
 *
 * Her anahtar farklı bir karakter kümesi olmalı!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz. Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'EYBiU(8RN=m&a)XH#^hyCnY=IL^x+hQ{^;Nmx4u*Mi7j+hEIn86lnDRm /8Oo69|');
define('SECURE_AUTH_KEY',  'P-tAc<tR]AG2`=J(S-nGW0k`n:D}K}Tuy2{IQGxvJcD7Yui $e`mQ]Cw^HQ6L1iv');
define('LOGGED_IN_KEY',    'Nxr9/{5.h,?uuxVqs7zPT*F$P{k8!?o~xGqzVXp[mZ#b`n6,#F,JhRb?9QQwNDo3');
define('NONCE_KEY',        'liP, ta)IA{W:cr>tCOC}O* ]E[Kn.V7+0(O=4-tMP?X%(Wsl4K MHXL.y]xDHyz');
define('AUTH_SALT',        '}[n#bvMcZ:Xcx5`es5QIUs3HXIZQuxgE|_f8P$ii;pw+WU{7aTfQ@MZ8xXda,&{,');
define('SECURE_AUTH_SALT', 'Ds!Frz)zI~^9$7@f/]&I1d8Q!sO<4kl+;He?q},Qmq#Ri~0&WF.%b<47tx(5CaU|');
define('LOGGED_IN_SALT',   'M}rt|)nQ@ l9qwNVmdW;C<#%&LY0ZQ&p,[kt6p+S$DsYCM `8IOz7+VI}}!X9KPu');
define('NONCE_SALT',       'CY[%M 15?$7sGJU s6`7}Slti2X`$8HuY$kPZ{_*H.rv:1Mxk]-IjCNj3*sZyf=O');
/**#@-*/

/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix  = 'wp_';

/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri "true" yaparak geliştirme sırasında hataların ekrana basılmasını sağlayabilirsiniz.
 * Tema ve eklenti geliştiricilerinin geliştirme aşamasında WP_DEBUG
 * kullanmalarını önemle tavsiye ederiz.
 */
define('WP_DEBUG', false);

/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** WordPress değişkenlerini ve yollarını kurar. */
require_once(ABSPATH . 'wp-settings.php');
