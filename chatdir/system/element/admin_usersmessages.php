<div class="tab_element sub_list" id="found<?php echo $boom['user_id']; ?>">
	<div class="admin_sm_avatar">
		<img class="admin_user<?php echo $boom['user_tumb']; ?> avatar_userlist" src="<?php echo myavatar($boom['user_tumb']); ?>"/>
	</div>
	<div class="admin_sm_username username <?php echo $boom['user_color']; ?>">
			<?php echo $boom['post_message']; ?>

	</div>
	<?php if(boomAllow(10) && notMe($boom['user_id']) && !isBot($boom['user_bot'])){ ?>
	<div onclick="eraseAccount(<?php echo $boom['user_id']; ?>);" class="admin_sm_option">
		
	</div>
	<?php } ?>
</div>