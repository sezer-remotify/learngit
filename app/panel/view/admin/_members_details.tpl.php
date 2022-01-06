<?php
  /**
   * Members Details
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _members_details.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->MAC_TITLE2;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->ACT_INFO;?></p>
  </div>
</div>
<div class="wojo fitted segment">
  <div class="header align bottom" id="item_<?php echo $this->row->id;?>">
    <div class="items"><img src="<?php echo UPLOADURL;?>/avatars/<?php echo $this->row->avatar ? $this->row->avatar : 'blank.svg';?>" alt="" class="wojo small circular image"></div>
    <div class="items">
      <h4 class="basic"><?php echo $this->row->fname . '1 ' . $this->row->lname;?></h4>
      <?php echo $this->row->email;?>
      <small class="wojo demi caps text"> ( <?php echo $this->row->type;?> )</small>
    </div>
    <div class="items">
      <a class="grey" data-dropdown="#userDrop_<?php echo $this->row->id;?>">
      <i class="icon horizontal ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-right" id="userDrop_<?php echo $this->row->id;?>">
        <!-- Start addtoProjects -->
        <a data-set='{"option":[{"action":"addtoProjects","id": <?php echo $this->row->id;?>}], "label":"<?php echo Lang::$word->ADDPROJECT;?>", "url":"helper.php", "parent":"#item_<?php echo $this->row->id;?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->ADDPROJECT;?></a>
        
        <!-- Start addtoTeam -->
        <a data-set='{"option":[{"action":"addtoTeam","id": <?php echo $this->row->id;?>}], "label":"<?php echo Lang::$word->ADDTEAM;?>", "url":"helper.php", "parent":"#item_<?php echo $this->row->id;?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->ADDTEAM;?></a>
        <?php if($this->row->type != "owner"):?>
        <!-- Start changeCompany -->
        <a data-set='{"option":[{"action":"changeCompany","id": <?php echo $this->row->id;?>,"url":"/admin/members/details/<?php echo $this->row->id;?>/"}], "label":"<?php echo Lang::$word->CHANGECMP;?>", "url":"helper.php", "parent":"#item_<?php echo $this->row->id;?>", "redirect":true, "modalclass":"normal"}' class="item action"><?php echo Lang::$word->CHANGECMP;?></a>
        
        <!-- Start archiveUser -->
        <a data-set='{"option":[{"archive": "archiveUser","title": "<?php echo Validator::sanitize($this->row->fname . ' ' . $this->row->lname, "chars");?>","id": "<?php echo $this->row->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->DELCONFIRM5;?>", "parent":"#item_<?php echo $this->row->id;?>", "redirect":"<?php echo Url::url("/admin/members/");?>"}' class="item data">
        <?php echo Lang::$word->MTOARCHIVE;?>
        </a>
        <div class="divider"></div>
        <!-- Start trashUser -->
        <a data-set='{"option":[{"trash": "trashUser","title": "<?php echo Validator::sanitize($this->row->fname . ' ' . $this->row->lname, "chars");?>","id": "<?php echo $this->row->id;?>}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $this->row->id;?>", "redirect":"<?php echo Url::url("/admin/members/");?>"}' class="item wojo demi text data">
        <?php echo Lang::$word->MTOTRASH;?>
        </a>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="scrollbox" style="height:500px">
      <?php if(!$this->data):?>
      <div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/activity_empty.svg" alt="" class="wojo center large image">
        <p class="wojo semi grey text"><?php echo Lang::$word->ACT_NOACTIVITY;?></p>
      </div>
      <?php else:?>
      <div class="wojo small relaxed fluid celled list">
        <?php foreach ($this->data as $date => $rows):?>
        <div class="item">
          <h6 class="wojo basic grey text"><?php echo Date::doDate("short_date", $date);?></h6>
        </div>
        <?php foreach($rows as $row):?>
        <div class="item">
          <div class="content auto">
            <span class="wojo demi text"><?php echo Users::activityTypeStatus($row->type);?></span></div>
          <div class="content padding left">
            <?php echo $this->row->fname . ' ' . $this->row->lname;?>
            <?php echo Users::activityStatus($row);?>
          </div>
          <div class="content auto">
            <?php echo Date::doTime($row->hour);?>
          </div>
        </div>
        <?php endforeach;?>
        <?php endforeach;?>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>