<?php
  /**
   * Members Archive
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _members_archive.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->MAC_TITLE6;?></h3>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
      <a href="<?php echo Url::url("/admin/members", "invite");?>" class="wojo button"><?php echo Lang::$word->MAC_INVPEOPLE;?></a>
      <a href="<?php echo Url::url("/admin/companies", "new");?>" class="wojo button"><?php echo Lang::$word->CMP_NEW;?></a>
      <a href="<?php echo Url::url("/admin/teams");?>" class="wojo button"><?php echo Lang::$word->TMS_TEAMS;?></a>
      <a class="wojo active passive button"><?php echo Lang::$word->ARCHIVE;?></a>
    </div>
  </div>
</div>
<?php if(!$this->members and !$this->companies):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/archive_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->MAC_SUB14;?></p>
</div>
<?php else:?>
<?php if($this->members):?>
<!-- Start members -->
<div class="bottom margin">
  <div class="wojo inverted rounded primary label"><?php echo count($this->members);?>
    <?php echo Lang::$word->USERS;?></div>
</div>
<?php foreach ($this->members as $row):?>
<?php $color = Utility::getColors();?>
<div class="wojo fitted attached segment" id="item_<?php echo $row->id;?>">
  <div class="wojo items">
    <div class="item">
      <div class="columns auto">
        <?php if($row->avatar):?>
        <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $row->avatar;?>" alt="" class="wojo category image">
        <?php else:?>
        <span style="background-color:<?php echo $color;?>;color:#fff;border-color:<?php echo $color;?>" class="wojo initials circular label"><?php echo Utility::getInitials($row->name);?></span>
        <?php endif;?>
      </div>
      <div class="columns">
        <?php echo $row->name;?>
        <span class="wojo small text">(<?php echo $row->email;?>)</span></div>
      <div class="columns auto">
        <a class="wojo small dark inverted icon button" data-dropdown="#userDrop_<?php echo $row->id;?>">
        <i class="icon vertical ellipsis"></i>
        </a>
        <div class="wojo dropdown small pointing top-right" id="userDrop_<?php echo $row->id;?>">
          <!-- Start unArchiveUser -->
          <a data-set='{"option":[{"unarchive": "unArchiveUser","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"unarchive","subtext":"<?php echo Lang::$word->DELCONFIRM8;?>", "parent":"#item_<?php echo $row->id;?>"}' class="item data">
          <?php echo Lang::$word->RFARCHIVE;?>
          </a>
          <div class="divider"></div>
          <!-- Start trashUser -->
          <a data-set='{"option":[{"trash": "trashUser","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
          <?php echo Lang::$word->MTOTRASH;?>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>
<?php if($this->companies):?>
<!-- Start companies -->
<div class="vertical margin">
  <div class="wojo inverted rounded primary label"><?php echo count($this->companies);?>
    <?php echo Lang::$word->CMP_COMPANIES;?></div>
</div>
<?php foreach ($this->companies as $row):?>
<?php $color = Utility::getColors();?>
<div class="wojo fitted attached segment" id="cmp_<?php echo $row->id;?>">
  <div class="wojo items">
    <div class="item">
      <div class="columns auto">
        <?php if($row->logo):?>
        <img src="<?php echo UPLOADURL;?>/logos/<?php echo $row->logo;?>" alt="" class="wojo category image">
        <?php else:?>
        <span style="background-color:<?php echo $color;?>;color:#fff;border-color:<?php echo $color;?>" class="wojo initials circular label"><?php echo Utility::getInitials($row->name);?></span>
        <?php endif;?>
      </div>
      <div class="columns">
        <?php echo $row->name;?>
        <span class="wojo small text">(<?php echo $row->email;?>)</span>
      </div>
      <div class="columns auto">
        <a class="wojo small dark inverted icon button" data-dropdown="#companyDrop_<?php echo $row->id;?>">
        <i class="icon vertical ellipsis"></i>
        </a>
        <div class="wojo dropdown small pointing top-right" id="companyDrop_<?php echo $row->id;?>">
          <!-- Start companyHistory -->
          <a data-set='{"option":[{"action":"companyHistory","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->HISOCHGE;?>", "url":"helper.php", "parent":"#cmp_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal", "buttons":false}' class="item action"><?php echo Lang::$word->HISOCHGE;?></a>
          
          <!-- Start unArchiveCompany -->
          <a data-set='{"option":[{"unarchive": "unArchiveCompany","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"unarchive","subtext":"<?php echo Lang::$word->DELCONFIRM8;?>", "parent":"#cmp_<?php echo $row->id;?>"}' class="item data">
          <?php echo Lang::$word->RFARCHIVE;?>
          </a>
          <div class="divider"></div>
          <!-- Start trashCompany -->
          <a data-set='{"option":[{"trash": "trashCompany","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#cmp_<?php echo $row->id;?>"}' class="item wojo demi text data">
          <?php echo Lang::$word->MTOTRASH;?>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>
<?php endif;?>