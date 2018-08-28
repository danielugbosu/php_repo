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
require_once('../config_session.php');

$check_action = getDelay();
$online_delay = time() - ( 86400 * 7 );
$online_user = '';
$offline_user = '';
$offcount = 1;
$staff = 0;
if(boomRole(4) || boomAllow(9)){
	$staff = 1;
}
if($data['last_action'] < getDelay()){
	$mysqli->query("UPDATE boom_users SET last_action = '" . time() . "' WHERE user_id = '{$data['user_id']}'");
}
function createUserlist($list, $type, $staff){
	global $data, $lang;
	$status = '';
	$icon = '';
	$offcolor = '';
	$muted = lmIcon(isMuted($list), 'icmute');
	if($type == 2){
		$offcolor = 'offline';
	}
	if($type != 2){
		$status = lmIcon(getStatus($list['user_status']), 'icstatus');
	}
	if($data['ico'] == 1){
		$icon = lmIcon(rankIcon($list,2), 'icrank');
	}
	return '<div onclick="dropUser(this,'.$list['user_id'].',\''.$list['user_name'].'\','.$list['user_rank'].','.$list['user_bot'].',1);" class="list_element list_item user_lm_box ' . $offcolor . '">
				<div class="user_lm_avatar"><img class="avsex ' . sex($list['user_sex']) . ' avatar_userlist ' . ownAvatar($list['user_id']) . '" src="' . myavatar($list['user_tumb']) . '"/></div>
				<div class="user_lm_data"><p class="username bellips ' . $list['user_color'] . '">' . $list["user_name"] . '</p>' . userState($list['user_mood']) . '</div>
				' . $muted . $status  . $icon . '
			</div>
			<div class="drop_list sub_menu_in"></div>';
}
$data_list = $mysqli->query("SELECT user_name, user_color, user_rank, user_join, user_tumb, user_status, user_sex, user_id, ureg_mute, user_mute, user_word_mute, room_mute, last_action, user_bot, user_role, owner, user_mood
FROM `boom_users`
WHERE `user_roomid` = {$data["user_roomid"]}  AND last_action > '$check_action' AND user_status != 6 || user_bot = 1
ORDER BY `user_rank` DESC, `user_name` ASC ");

if($data['max_offcount'] > 0){
	$offline_list = $mysqli->query("SELECT user_name, user_color, user_rank, user_join, user_tumb, user_status, user_sex, user_id, ureg_mute, user_mute, user_word_mute, room_mute, last_action, user_bot, user_role, owner, user_mood
	FROM `boom_users`
	WHERE `user_roomid` = {$data["user_roomid"]}  AND last_action > '$online_delay' AND last_action < '$check_action' AND user_status != 6 AND  user_rank != 0 AND user_bot = 0
	ORDER BY last_action DESC LIMIT {$data['max_offcount']}");
}
mysqli_close($mysqli);
if ($data_list->num_rows > 0){
	while ($list = $data_list->fetch_assoc()){
		$online_user .= createUserlist($list, 1, $staff);
	}
}
if($data['max_offcount'] > 0){
	if($offline_list->num_rows > 0){
		while($offlist = $offline_list->fetch_assoc()){
			$offline_user .= createUserlist($offlist, 2, $staff);
		}
	}
}

?>
<div id="container_user">
	<?php if($data['max_offcount'] > 0 && $offline_user != ''){ ?>
	<h3 class="user_count"><?php echo $lang['online']; ?></h3>
	<?php } ?>
	<div class="online_user"><?php echo $online_user; ?></div>
	<?php if($offline_user != ''){ ?>
	<h3 class="user_count offline_count"><?php echo $lang['offline']; ?></h3>
	<div class="online_user"><?php echo $offline_user; ?></div>
	<?php } ?>
	<div class="clear"></div>
</div>