<?php
/**
* Codychat
*
* @package Codychat
* @author www.boomcoding.com
* @copyright 2017
* @terms any use of this script without a legal license is prohibited
* all the content of Codychat is the propriety of BoomCoding and Cannot be 
* used for another project.
*/
session_start();
if(!isset($load_addons)){
	die();
}
$boom_access = 0;
$time = time();
require("database.php");
require("variable.php");
require("function.php");
require("function_2.php");
if(!isset($_COOKIE[$boom_config['prefix'] . 'userid']) || !isset($_COOKIE[$boom_config['prefix'] . 'utk'])){
	die();
}
if(!checkToken()){
	die();
}
require(__DIR__ . "/../addons/" . $load_addons . "/system/addons_function.php");
$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (mysqli_connect_errno()){
	die();
}
$pass = escape($_COOKIE[$boom_config['prefix'] . 'utk']);
$ident = escape($_COOKIE[$boom_config['prefix'] . 'userid']);
$get_data = $mysqli->query("SELECT boom_setting.*, boom_users.*, boom_addons.* FROM boom_users, boom_setting, boom_addons WHERE boom_users.user_id = '$ident' AND boom_users.user_password = '$pass' AND boom_setting.id = '1' AND boom_addons.addons = '$load_addons'");	
if($get_data->num_rows > 0){
	$data = $get_data->fetch_assoc();
	$boom_access = 1;
}
else {
	die();
}
require("language/{$data['user_language']}/language.php");
require(addonsLang($load_addons));
date_default_timezone_set($data['user_timezone']);
?>