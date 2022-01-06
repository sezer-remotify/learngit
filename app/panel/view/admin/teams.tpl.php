<?php
  /**
   * Teams
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: teams.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_teams')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->TMS_TEAMS;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->TMS_INFO4;?></p>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns">
    <div class="wojo small white stacked buttons">
      <a href="<?php echo Url::url("/admin/members", "invite");?>" class="wojo button"><?php echo Lang::$word->MAC_INVPEOPLE;?></a>
      <a href="<?php echo Url::url("/admin/companies", "new");?>" class="wojo button"><?php echo Lang::$word->CMP_NEW;?></a>
      <a class="wojo active passive button"><?php echo Lang::$word->TMS_TEAMS;?></a>
      <a href="<?php echo Url::url("/admin/members", "archive");?>" class="wojo button"><?php echo Lang::$word->ARCHIVE;?></a>
    </div>
  </div>
  <div class="columns auto">
    <a data-set='{"option":[{"action":"newTeam"}], "label":"<?php echo Lang::$word->TMS_CREATE;?>", "url":"helper.php", "parent":".wojo.mason", "complete":"prepend", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":".wojo.mason"}]}' class="wojo primary inverted icon button action"><i class="icon plus"></i></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/teams_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->TMS_NOTEAM;?></p>
</div>
<?php endif;?>
<div class="wojo mason">
  <?php if($this->data):?>
  <?php foreach ($this->data as $team):?>
  <?php $color = Utility::getColors();?>
  <div class="item" id="item_<?php echo $team['id'];?>">
    <div class="wojo fitted attached segment">
      <div class="header">
        <div class="wojo label" style="background:<?php echo ($team['color']) ? $team['color'] : "#000";?>;border-color:<?php echo ($team['color']) ? $team['color'] : "#000";?>">
          <?php echo $team['name'];?>
        </div>
      </div>
      <div class="content">
        <div class="wojo divided items">
          <?php foreach ($team['members'] as $row) :?>
          <?php if($row['fullname']):?>
          <div class="item">
            <div class="columns auto">
              <?php if($row['avatar']):?>
              <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $row['avatar'];?>" alt="" class="wojo category image">
              <?php else:?>
              <span style="background-color:<?php echo $color;?>;color:#fff;border-color:<?php echo $color;?>;" class="wojo initials circular label"><?php echo Utility::getInitials($row['fullname']);?></span>
              <?php endif;?>
            </div>
            <div class="columns">
              <span class="wojo semi text"><?php echo $row['fullname'];?></span>
            </div>
          </div>
          <?php endif;?>
          <?php endforeach;?>
        </div>
      </div>
      <div class="footer divided">
        <div class="center aligned">
          <a data-set='{"option":[{"action":"editTeam","id":<?php echo $team['id'];?>, "name": "<?php echo Validator::sanitize($team['name'], "chars");?>"}], "label":"<?php echo Lang::$word->TMS_UPDATE;?>", "url":"helper.php", "parent":"#item_<?php echo $team['id'];?>", "complete":"update", "modalclass":"normal","callback":[{"type": "mason","method":"refresh", "element":".wojo.mason"}]}' class="wojo positive inverted small icon button action"><i class="icon note"></i></a>
          <a data-set='{"option":[{"delete": "deleteTeam","title": "<?php echo Validator::sanitize($team['name'], "chars");?>","id": <?php echo $team['id'];?>}],"action":"delete","parent":"#item_<?php echo $team['id'];?>", "complete":"refresh"}' class="wojo negative small inverted icon button data"><i class="icon trash"></i></a>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
  <?php endif;?>
</div>