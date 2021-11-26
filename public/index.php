<?php 

session_start(); // bắt đầu phiên

$path = $_SERVER['REQUEST_SCHEME'] . "://". $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];// lấy thông tin server
$path = str_replace("index.php", "", $path);// bỏ đoạn index.php đi, thay bằng path

define('ROOT', $path);
define('ASSETS', $path . "assets/");

include "../app/init.php";

//tạo đối tượng App
$app = new App();