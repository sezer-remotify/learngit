<?php
  /**
   * Task Completed
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: task_completed.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
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
      </div>
      <?php endforeach;?>
    </div>
    <?php endif;?>
  </div>
</div>