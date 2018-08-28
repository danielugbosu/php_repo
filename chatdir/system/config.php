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
$boom_access = 0;
$time = time();
require("database.php");
require("variable.php");
require("function.php");
require("function_2.php");
$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (mysqli_connect_errno() || $check_install != 1) {
	if($check_install != 1){
		$chat_install = 2;
	}
	else{
		$chat_install = 3;
	}
}
else{
	$chat_install = 1;
	if(isset($_COOKIE[$boom_config['prefix'] . 'userid']) && isset($_COOKIE[$boom_config['prefix'] . 'utk'])){
		$ident = escape($_COOKIE[$boom_config['prefix'] . 'userid']);
		$pass = escape($_COOKIE[$boom_config['prefix'] . 'utk']);
		$get_data = $mysqli->query("SELECT boom_setting.*, boom_users.* FROM boom_users, boom_setting WHERE boom_users.user_id = '$ident' AND boom_users.user_password = '$pass' AND boom_setting.id = '1'");
		if($get_data->num_rows > 0){
			$data = $get_data->fetch_assoc();
			$boom_access = 1;
		}
		else {
			$get_data = $mysqli->query("SELECT * FROM boom_setting WHERE boom_setting.id = '1'");
			$data = $get_data->fetch_assoc();
			sessionCleanup();
		}
	}
	else {
		$get_data = $mysqli->query("SELECT * FROM boom_setting WHERE boom_setting.id = '1'");
		$data = $get_data->fetch_assoc();
		sessionCleanup();
	}
	$cur_lang = getLanguage();
	require("language/" . $cur_lang . "/language.php");
}
if($chat_install == 1){
	date_default_timezone_set("{$data['timezone']}");
}
else {
	date_default_timezone_set("America/Montreal");
}
?>