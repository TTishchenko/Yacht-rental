<?
error_reporting(E_ALL);

//@setlocale('LC_CTYPE', 'ru_RU.UTF8');
//@setlocale('LC_TIME', 'ru_RU.UTF8');

define('DATABASE_HOST',  'u415056.mysql.masterhost.ru');
define('DATABASE_NAME',  'u415056_base');
define('DATABASE_LOGIN', 'u415056_base');
define('DATABASE_PASSW', '.heCTi2siouTH');

define('DEBUG_SQL', false);

//создание объекта соединения с базой данных
$db_link = new mysqli(DATABASE_HOST, DATABASE_LOGIN, DATABASE_PASSW, DATABASE_NAME);
//принудительно устанавливаем utf8 чтобы избежать проблем с кодировкой
$db_link->query("SET NAMES 'utf8'");


?>