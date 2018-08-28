<?php
include_once("/var/www/chillplanet.nl/public_html/blockscript/detector.php");
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
$page_info = array(
	'page'=> 'home',
	'page_nohome'=> 1,
);
require_once("system/config.php");
if($chat_install != 1){
	include('builder/installer.php');
	die();
}
$chat_room = getRoomId();
if($chat_room > 0){
	$data['user_roomid'] = $chat_room;
	$page_info['page'] = 'chat';
}

// loading head tag element
include('control/head_load.php');

// loading page content
if($page['page'] == 'chat'){
	include('control/chat.php');
}
else {
	include('control/lobby.php');
}

// close page body
include('control/body_end.php');
?>


<script type="text/javascript">
	console.log('%cSTOP!', 'font-weight: bold; font-size: 80px; color: red');
	console.log('%cDit is een browserfunctie die is bedoeld voor ontwikkelaars. Als iemand tegen je heeft gezegd om hier iets te kopiëren en te plakken om een Chillplanet-functie in te schakelen of het account van iemand anders te hacken, is dit een vorm van oplichting en probeert diegene toegang te krijgen tot je Chillplanet-account.', 'font-weight: bold; font-size: 21px; color: black');
</script>