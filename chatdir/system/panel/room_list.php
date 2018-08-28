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
?>
<?php if(allowRoom()){ ?>
<div class="theme_btn panel_full_btn getbox" data-box="system/box/create_room.php" data-type="modal" id="chat_add_room">
	<i class="fa fa-plus-circle"></i> <?php echo $lang['add_room']; ?>
</div>
<?php } ?>
<div id="container_room">
	<?php echo getRoomList('list'); ?>
	<div class="clear"></div>
</div>