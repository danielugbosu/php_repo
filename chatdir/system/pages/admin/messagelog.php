<?php
require_once('../../config_session.php');
if(!boomAllow(11)){
	die();
}
?>
<?php echo elementTitle('envelope-o', $lang['chat_logs']); ?>
<div class="page_full">
	<div class="page_element">
		<div id="ip_search">
			<div class="search_bar">
				<input id="search_ip" placeholder="<?php echo $lang['search']; ?>" class="search_input" type="text"/>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php
		$list_ip = '';
		$getip = $mysqli->query("SELECT hunter, message, target FROM boom_private ORDER BY id DESC LIMIT 3200");
		if($getip->num_rows > 0){
			while($ip = $getip->fetch_assoc()){
				$list_ip .= '<div class="tab_element sub_list ip_box">
								<div class="admin_sm_content">
								' . $ip['ip'] . '
								</div>
								<div data="' . $ip['id'] . '" class="admin_sm_option delete_ip">
									<i class="fa fa-times"></i>
								</div>
							</div>';
			}
		}
		else {
			$list_ip .= emptyZone($lang['empty']);
		}
	?>
		<?php
		$list_ip = '';
		$getMessage = $mysqli->query("SELECT hunter, message, target FROM boom_private ORDER BY id DESC LIMIT 3200");
		if($getMessage->num_rows > 0){
			while($id = $getMessage->fetch_assoc()){
				$list_ip .= '<div class="tab_element sub_list ip_box">
												<div class="admin_sm2_option">
								' . $id['hunter'] . '
								</div>
								<div class="admin_sm_content">
								' . $id['message'] . '
								</div>
																<div class="admin_sm2_option">
								' . $id['target'] . '
								</div>
								
							</div>';

			}
		}
		else {
			$list_ip .= emptyZone($lang['empty']);
		}
	?>
	<div class="page_element">
		<div id="ip_list">
			<?php echo $list_ip; ?>
		</div>
	</div>
</div>


	<div class="page_element">
		<div id="ip_list">
			<?php echo $list_ip; ?>
				<div class="clear"></div>
			</div>
		</div>
	</div>

		</div>
	</div>
</div>



