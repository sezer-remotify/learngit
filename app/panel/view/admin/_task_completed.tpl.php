<?php
  /**
   * Completed Tasks
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _task_completed.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<a href="<?php echo Url::url("/admin/projects/tasks", $this->row->id);?>" class="wojo small button">
<i class="icon long arrow left"></i>
<?php echo str_replace("[NAME]", $this->row->name, Lang::$word->BACKTO);?>
</a>
<div class="wojo fitted segment">
  <div class="header divided">
    <div class="items">
      <h4><?php echo Lang::$word->TSK_SUB14;?></h4>
    </div>
    <div class="items"><span id="counter" class="wojo small primary inverted label"><?php echo $this->data ? count($this->data) : 0;?></span></div>
  </div>
  <div class="content">
    <?php if(!$this->data):?>
    <div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/tasks_empty.svg" alt="" class="wojo center large image">
      <p class="wojo semi grey text"><?php echo Lang::$word->TSK_NOTSK;?></p>
    </div>
    <?php else:?>
    <div class="wojo very relaxed fluid divided list">
      <?php foreach ($this->data as $row):?>
      <div class="item" id="item_<?php echo $row->id;?>">
        <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $row->avatar ? $row->avatar : "blank.svg" ;?>" alt="" class="wojo category image">
        <div class="content">
          <div class="header"><?php echo $row->name;?></div>
          <div class="wojo small text description"><?php echo Lang::$word->COMPLETED . ' ' . Lang::$word->BY;?>: <?php echo $row->completed_by_name;?>
            <?php echo  Lang::$word->ON;?>
            <?php echo Date::doDate("short_date", $row->completed);?></div>
        </div>
        <div class="content auto">
          <a class="grey" data-dropdown="#taskDrop_<?php echo $row->id;?>">
          <i class="icon horizontal ellipsis link"></i>
          </a>
          <div class="wojo dropdown small pointing top-right" id="taskDrop_<?php echo $row->id;?>">
            <!-- Start restoreTask -->
            <a data-set='{"option":[{"restore": "restoreTask","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id":<?php echo $row->id;?>,"pid": "<?php echo $this->row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#item_<?php echo $row->id;?>"}' class="item data">
            <?php echo Lang::$word->RESTORE;?>
            </a>
            <div class="divider"></div>
            <!-- Start trashTask -->
            <a data-set='{"option":[{"trash": "trashTask","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id":<?php echo $row->id;?>}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
            <?php echo Lang::$word->MTOTRASH;?>
            </a>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    <?php endif;?>
  </div>
</div>