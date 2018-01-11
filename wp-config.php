<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'admin_calc');

/** Имя пользователя MySQL */
define('DB_USER', 'admin_calc');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'c88WFVGCxA');

/** Имя сервера MySQL */
define('DB_HOST', '0.0.0.0');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/** FTP **/
//define('FS_CHMOD_FILE', 777); //права доступа к записываемым файлам, выставляемые по-умолчанию
//define('FS_CHMOD_DIR', 777); //права доступа к записываемым папкам, выставляемые по-умолчанию
define('FS_METHOD', 'direct');
//define('FTP_BASE', '/home/admin/web/calc.idea-relax.it/public_html/'); //корневая папка сайта
//define('FTP_CONTENT_DIR', '/home/admin/web/calc.idea-relax.it/public_html/wp-content/'); //основная папка контента
//define('FTP_PLUGIN_DIR ', '/home/admin/web/calc.idea-relax.it/public_html/wp-content/plugins/'); //основная папка плагинов
define('FTP_USER', 'admin_calc'); //FTP-логин
define('FTP_PASS', 'W1caFzue43'); //FTP-пароль
define('FTP_HOST', 'idea-relax.it'); //адрес FTP
define('FTP_SSL', false); // если используете SSL то ставьте  true
//define('WP_TEMP_DIR','/home/admin/web/calc.idea-relax.it/public_html/tmp/');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Nghhz`vEMw4 YEoc?&KN#/2!C;.?JLI.s1`|Y}5&=v2e{TQJ}NMu>F}l_?_dQL~-');
define('SECURE_AUTH_KEY',  '3,236s!Fk[|4^0iZ@iHUNdUZiZsjR?y?Pi<ifjf)^<{3Tbfm`b9GY!VwMYj%RJ4M');
define('LOGGED_IN_KEY',    'hv6zq[tWNVZijUZ]Ap{A#at8T^9MiYlmacV/=]t-QY=Z{PXx-f*$EAiy#g)j6_`Z');
define('NONCE_KEY',        '* WQ%%<<Y-.lYe=J:0ld<>3HpgveHpkN-2TJt5qk{B`cL7h*sNj}Zww?ybM<YQQ)');
define('AUTH_SALT',        'gJf/jFTbb+cO)0:R6`ffcZTVWMZU.#H:g4+vW>j<CYRLv+n3l[F||X+]_oCj<SKF');
define('SECURE_AUTH_SALT', 'E }D#bd})Ae>Su%m>B)AJ}wN6sjnUsez5a]n% tAC8j9,$R?gw:$5u9*wubSWy){');
define('LOGGED_IN_SALT',   '68{5bluwcmst~N3b1SQ;sy`-EID4(N4V!Vg*Drw@-8QM]v+D8F56 Fd t%~0cx+E');
define('NONCE_SALT',       'Km)8<|VYCzYOf(TZV))][hxBMP=^hQH<E,3&FmR$RQm/s-=T.PTVGe.)jO(=_vD=');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
