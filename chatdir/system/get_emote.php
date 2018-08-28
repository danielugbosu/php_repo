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
require_once("config_session.php");

if(!isset($_SESSION['emoji'])){
	$_SESSION['emoji'] = time();
}
else {
	$emodelay = time() - 4;
	if($_SESSION['emoji'] >= $emodelay){
		echo 100;
		die();
	}
	else {
		$_SESSION['emoji'] = time();
	}
}

if (isset($_POST['target'])){
	$target = escape($_POST['target']);
	$idEmote = escape($_POST['special_action']);
	
if(checkFlood()){
	echo 100;
	die();
}
if(muted() || roomMuted()){
	die();
}
	
	if($idEmote == "bisou"){
		$content = '<font color="green"><b>' . $data["user_name"] . '</b></font><font color="red" size="2"><b> kust </b></font>:1f618: <b><font color="green">' . $target . '</b>!</font>';
		$content = textFilter($content);
		systemSay($data['user_roomid'], $content);
	}
	else if($idEmote == "salue"){
        $content = '<font color="green"><b>' . $data["user_name"] . '</b> <font color="gold" size="2"><b>geeft koud :beer: aan </b></font><b>' . $target . '</b>!</font>';
        $content = textFilter($content);
		systemSay($data['user_roomid'], $content);
	}
	else if($idEmote == "kick"){
		$content = "<b>".$data["user_name"]."</b> geeft <b>$target</b>!";
		$content = '<font color="green"><b>' . $data["user_name"] . '</b></font><font color="red" size="2"><b>  geeft </b><b><font color="green">' . $target . '</font></b><b> een schop onder ze kont! :cutoo:</b></font>';
		$content = textFilter($content);
		systemSay($data['user_roomid'], $content);
	}
	echo 44;
	die();
}
?>