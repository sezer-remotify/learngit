<?php
  /**
   * Activity
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: activity.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->ACT_TITLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->ACT_INFO;?></p>
  </div>
</div>
<div class="wojo segment">
  <div class="header align center">
    <div class="wojo small rounded secondary inverted stacked buttons">
      <button id="prev" type="button" class="wojo button" data-date="<?php echo Date::doDate("yyyy/MM/dd", Date::NumberOfDays('-1 day'));?>">
      <i class="icon chevron left"></i><?php echo Lang::$word->ACT_PREV;?>
      </button>
      <div id="mNow" class="wojo right button">
        <span>
        <?php echo Date::doDate("short_date", Date::today());?>
        </span>
        <i class="icon small chevron down"></i>
      </div>
      <button id="next" type="button" class="wojo right button" data-date="<?php echo Date::doDate("yyyy/MM/dd", Date::NumberOfDays('1 day'));?>">
      <?php echo Lang::$word->ACT_NEXT;?>
      <i class="icon chevron right"></i>
      </button>
    </div>
  </div>
  <ul class="wojo form activity scrollbox" style="height:500px" id="acData">
    <?php if(!$this->data):?>
    <li class="center aligned">
      <img src="<?php echo ADMINVIEW;?>/images/activity_empty.svg" alt="" class="wojo center large image">
      <p class="wojo semi grey text">
        <?php echo str_replace("[NAME]", $this->core->company, Lang::$word->ACT_NOACC);?>
      </p>
    </li>
    <?php endif;?>
    <?php if($this->data):?>
    <?php foreach($this->data as $row):?>
    <li>
      <div class="intro"><?php echo Date::doTime($row->hour);?></div>
      <div class="content">
        <div class="item wojo small text">
          <a href="<?php echo Url::url("/admin/members/details", $row->uid);?>" class="inverted">
          <?php echo $row->fullname;?>
          </a>
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
  </ul>
</div>
<script src="<?php echo ADMINVIEW;?>/js/activity.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
  $(document).ready(function() {
	  $.Activity({
		  url: "<?php echo ADMINVIEW;?>",
		  weekstart: <?php echo($this->core->weekstart);?>,
		  lang: {
			  monthsFull: [<?php echo Date::monthList(false);?>],
			  monthsShort: [<?php echo Date::monthList(false, false);?>],
			  weeksFull: [<?php echo Date::weekList(false);?>],
			  weeksShort: [<?php echo Date::weekList(false, 3);?> ],
			  weeksMed: [<?php echo Date::weekList(false, 2);?>],
			  weeksSmall: [<?php echo Date::weekList(false, 1);?>],
			  ok: "<?php echo Lang::$word->OK;?>",
			  today: "<?php echo Lang::$word->TODAY;?>",
			  now: "<?php echo Lang::$word->NOW;?>",
			  clear: "<?php echo Lang::$word->CLEAR;?>",
			  removeText: "<?php echo Lang::$word->REMOVE;?>",
			  saveText: "<?php echo Lang::$word->TMR_TITLE1;?>",
			  editText: "<?php echo Lang::$word->TMR_TITLE2;?>",
			  dateformat: "<?php echo $this->core->short_date;?>",
			  catLabel: "<?php echo Lang::$word->PRJ_CATNAME;?>"
		  }
	  });
  });
// ]]>
</script>