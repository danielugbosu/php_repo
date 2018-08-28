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

$wall_content = '';
$post_count = 0;
$find_friend = $mysqli->query("SELECT target FROM boom_friends WHERE hunter = '{$data['user_id']}' AND status = '3'");
$friend_array = array($data['user_id']);
if($find_friend->num_rows > 0){
	while($add_friend = $find_friend->fetch_assoc()){
		array_push($friend_array, $add_friend['target']);
	}
}
$newarray = implode(", ", $friend_array);	
$wall_post = $mysqli->query("SELECT boom_post.*, boom_users.user_name, boom_users.user_id,  boom_users.user_rank, boom_users.user_color, boom_users.user_tumb,
(SELECT count( parent_id ) FROM boom_post_reply WHERE parent_id = boom_post.post_id ) as reply_count,
(SELECT count( post_id ) FROM boom_post WHERE post_user IN ($newarray)) as post_count,
(SELECT like_type FROM boom_post_like WHERE uid = '{$data['user_id']}' AND like_post = boom_post.post_id) as liked,
(SELECT count(id) FROM boom_post_like WHERE like_post = boom_post.post_id AND like_type = 1 ) as like_count,
(SELECT count(id) FROM boom_post_like WHERE like_post = boom_post.post_id AND like_type = 2 ) as unlike_count
FROM  boom_post, boom_users 
WHERE boom_post.post_user = boom_users.user_id AND boom_post.post_user IN ($newarray)
ORDER BY boom_post.post_actual DESC LIMIT 10");

if($wall_post->num_rows > 0){
	while ($wall = $wall_post->fetch_assoc()){
		$post_count = $wall['post_count'];
		$wall_content .= boomTemplate('element/wall_post',$wall);
	}
}
else { 
	$wall_content .= emptyZone($lang['wall_empty']);
}
?>
<div class="panel_wrap boom_keep">
<?php 
if(!muted()){
	echo boomTemplate('element/wall_input');
}
 ?>
<div id="container_wall">
<?php echo $wall_content; ?>
</div>
<?php if($post_count > 10){ ?>
<div id="data_count" onclick="moreWall(this);" class="load_more default_btn full_button"  data-current="10" data-total="<?php echo $post_count; ?>">
	<?php echo $lang['load_more']; ?>
</div>
<?php } ?>
</div>
