<?php
  /**
   * Load Activity
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadActivity.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if(!$this->data):?>
<li class="center aligned">
  <img src="<?php echo ADMINVIEW;?>/images/activity_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text">
    <?php echo str_replace("[NAME]", App::Core()->company, Lang::$word->ACT_NOACC);?>
  </p>
</li>
<?php endif;?>
<?php if($this->data):?>
<?php foreach($this->data as $row):?>
<li>
  <div class="intro"><?php echo Date::doTime($row->hour);?></div>
  <div class="content">
    <div class="item wojo small text">
      <a href="<?php echo Url::url("/admin/members/details", $row->uid);?>" class="inverted"><?php echo $row->fullname;?></a>
      <span class="wojo separator"></span>
      <?php if($row->groups == "history"):?>
      <?php echo Users::activityHistoryStatus($row);?>
      <?php else:?>
      <?php echo Users::activityStatus($row);?>
      <?php endif;?>
    </div>
  </div>
</li>
<?php endforeach;?>
<?php endif;?>
