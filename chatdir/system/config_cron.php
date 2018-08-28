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
require("database.php");
require("variable.php");
require("function.php");
require("function_2.php");
require(__DIR__ . "/../addons/" . $load_addons . "/system/addons_function.php");

$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

$get_data = $mysqli->query("SELECT boom_setting.*, boom_addons.* FROM boom_setting, boom_addons WHERE boom_setting.id = '1' AND boom_addons.addons = '" . $load_addons . "'");
if($get_data->num_rows > 0){
	$data = $get_data->fetch_assoc();
}
else {
	die();
}
require("language/" . $data['language'] . "/language.php");
require(addonsLangCron($load_addons));
date_default_timezone_set("{$data['timezone']}");
?>