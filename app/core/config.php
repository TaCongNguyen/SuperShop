<?php 

define("WEBSITE_TITLE", 'SUPER SHOP');

//ten database 
if($_SERVER['SERVER_NAME'] == "localhost"||$_SERVER['SERVER_NAME'] == "supershop.local")
{
	define('DB_NAME', "eshop_db");
	define('DB_USER', "nguyen");
	define('DB_PASS', "123456");
	define('DB_TYPE', "mysql");
	define('DB_HOST', "localhost");	
}else
{
	define('DB_NAME', "eshop_db");
	define('DB_USER', "root");
	define('DB_PASS', "root");
	define('DB_TYPE', "mysql");
	define('DB_HOST', "localhost");
}


$url = 'http://' . $_SERVER['SERVER_NAME'] .':'. $_SERVER['SERVER_PORT'] . str_replace("index.php", "", $_SERVER['PHP_SELF']) . str_replace('url=', "", $_SERVER['QUERY_STRING']);
// định nghĩa 1 số hằng số
define('FULL_URL',$url);
define('THEME','eshop/');
//debug
define('DEBUG', true);

if(DEBUG){

	ini_set('display_errors', 1);
}else{
	ini_set('display_errors', 0);
}
