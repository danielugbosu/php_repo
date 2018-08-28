<?php
require('../config_session.php');

$delay = getDelay();
$friend_list = '';
$friends = 0;

$find_friend = $mysqli->query("SELECT boom_users.user_name, boom_users.user_id, boom_users.user_tumb, boom_users.user_status,
 boom_users.user_color, boom_users.last_action, boom_users.user_rank, boom_users.user_sex, boom_users.user_bot, boom_friends.* FROM boom_users, boom_friends 
WHERE hunter = '{$data['user_id']}' AND status = '3' AND target = boom_users.user_id ORDER BY last_action DESC, user_name ASC");

if($find_friend->num_rows > 0){				
	while($find = $find_friend->fetch_assoc()){
		$friends++;
		if($find['last_action'] > getDelay()){
			$st = "online";
			$stt = $lang['online'];
		}
		if($find['last_action'] < getDelay() || !userVisible($find['user_status'])){
			$st = "gone";
			$stt = $lang['offline'];
		}
		$friend_list .= '<div onclick="dropUser(this,'.$find['user_id'].',\''.$find['user_name'].'\','.$find['user_rank'].','.$find['user_bot'].',0);" class="list_element list_item user_lm_box fitem">
							<div class="user_lm_avatar">
								<img class="avsex ' . sex($find['user_sex']) . ' avatar_userlist" src="' . myavatar($find['user_tumb']) . '"/>
							</div>
							<div class="user_lm_data username ' . $find['user_color'] . '">
								' . $find["user_name"] . '
							</div>
							<div title="' . $stt . '" class="user_lm_icon">
								<i class="st_icon ' . $st . ' fa fa-circle"></i>
							</div>
						</div>
						<div class="drop_list sub_menu_in">
						</div>';
		
	}
}
else {
	$friend_list .= emptyZone($lang['no_friend']);
}
?>
<?php if($friends > 0){ ?>
<div id="friend_search_box">
	<div class="search_bar">
		<input id="search_friend" placeholder="&#xf002;" class="full_input" type="text"/>
		<div class="clear"></div>
	</div>
</div>
<?php } ?>
<div class="boom_keep" id="container_friends">
	<?php echo $friend_list; ?>
</div>