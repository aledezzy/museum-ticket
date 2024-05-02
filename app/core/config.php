<?php 

define("WEBSITE_TITLE", 'MY SHOP');

//database name
if($_SERVER['SERVER_NAME'] == "localhost")
{
	define('DB_NAME', "eshop_db");
	define('DB_USER', "scuola");
	define('DB_PASS', "paolino");
	define('DB_TYPE', "mysql");
	define('DB_HOST', "192.168.1.33");
}else
{
	define('DB_NAME', "eshop_db");
	define('DB_USER', "scuola");
	define('DB_PASS', "paolino");
	define('DB_TYPE', "mysql");
	define('DB_HOST', "localhost");
}



$url = 'http://' . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] . str_replace("index.php", "", $_SERVER['PHP_SELF']) . str_replace('url=', "", $_SERVER['QUERY_STRING']);

define('FULL_URL',$url);
define('THEME','eshop/');

define('DEBUG', true);

if(DEBUG){

	ini_set('display_errors', 1);
}else{
	ini_set('display_errors', 0);
}
