<?php
  /**
   * Load Team
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadTeam.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($data):?>
<?php foreach ($data as $team):?>
<?php $color = Utility::getColors();?>
  <div class="item" id="item_<?php echo $team['id'];?>">
    <div class="wojo fitted segment">
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
        <a data-set='{"option":[{"action":"editTeam","id":<?php echo $team['id'];?>, "name": "<?php echo Validator::sanitize($team['name'], "chars");?>"}], "label":"<?php echo Lang::$word->TMS_UPDATE;?>", "url":"helper.php", "parent":"#item_<?php echo $team['id'];?>", "complete":"update", "modalclass":"normal"}' class="wojo positive inverted small icon button action"><i class="icon note"></i></a>
          <a data-set='{"option":[{"delete": "deleteTeam","title": "<?php echo Validator::sanitize($team['name'], "chars");?>","id": <?php echo $team['id'];?>}],"action":"delete","parent":"#item_<?php echo $team['id'];?>", "complete":"refresh"}' class="wojo negative small inverted icon button data"><i class="icon trash"></i></a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach;?>
<?php endif;?>