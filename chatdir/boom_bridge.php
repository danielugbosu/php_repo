<?php
/**
* CodyChat
*
* @package CodyChat
* @author www.codychat.com
* @copyright 2017
* @terms any use of this script without a legal license is prohibited
* all the content of CodyChat is the propriety of BoomCoding and Cannot be 
* used for another project.
*/
$path = htmlspecialchars($_POST['path']);
require($path . '/system/config_bridge.php');

if(file_exists('../site/wp-config.php')){
	require_once('../site/wp-config.php');
}
else {
	echo 'wp-config not found please contact support for help.';
	die();
}
if (!is_user_logged_in()){
	die();
}
$wpuser = wp_get_current_user();
$cms = array(
	'id'=> $wpuser->ID,
	'name'=> $wpuser->display_name,
	'email'=> $wpuser->user_email
);
$bridge_user = createBridgeUser('wordpress', $cms);
echo 1;
?>