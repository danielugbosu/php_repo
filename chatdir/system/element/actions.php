<div data="" value="" class="elem_in aclist aclist_name gprivate rself">
    <span class="list_icon"><i class="fa fa-comments theme_color"></i></span><?php echo $lang['private_chat']; ?>
</div>
<div data="" class="elem_in aclist get_info rglobal">
    <span class="list_icon"><i class="fa fa-user-circle-o default_color"></i></span><?php echo $lang['info']; ?>
</div>
 
 <?php if(boomAllow(2)){ ?>
<div data="" value="" onclick="specialCommand(this, 'bisou')" class="elem_in aclist aclist_name rcustom">
    <span class="list_icon"><i class="fa fa-heart heart"></i></span>Geef een kus!
</div>
<div data="" value="" onclick="specialCommand(this, 'salue')" class="elem_in aclist aclist_name rcustom">
    <span class="list_icon"><i class="fa fa-beer beer_time bolt"></i></span>Geef een biertje!
</div>
<div data="" value="" onclick="specialCommand(this, 'kick')" class="elem_in aclist aclist_name rcustom">
    <span class="list_icon"><i class="fa fa-crosshairs glazba heart"></i></span>schop onder z'n kont
</div>
 <?php } ?>
 
<?php if(boomAllow(9)){ ?>
    <div data="" onclick="listAction(this, 'mute');" class="elem_inadmins  aclist list_action rcustom">
        <span class="list_iconadmins"><i class="fa fa-microphone warn"></i></span> <?php echo $lang['mute']; ?>
    </div>
    <div data="" onclick="listAction(this, 'unmute');" class="elem_inadmins  aclist list_action rcustom">
        <span class="list_iconadmins"><i class="fa fa-microphone success"></i></span> <?php echo $lang['unmute']; ?>
    </div>
<?php } ?>
<?php if(boomAllow(9)){ ?>
    <div data="" onclick="listAction(this, 'ban');" class="elem_inadmins  aclist list_action rcustom">
        <span class="list_iconadmins"><i class="fa fa-ban error"></i></span> <?php echo $lang['ban']; ?>
    </div>
<?php } ?>