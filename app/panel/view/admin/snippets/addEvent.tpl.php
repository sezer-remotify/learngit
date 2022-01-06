<?php
  /**
   * Add Event
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: addEvent.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo float" id="dropdown-addCalendar">
  <div class="wojo small form" style="min-width:420px;max-width:420px">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="field">
          <label><?php echo Lang::$word->CAL_ETITLE;?></label>
          <input placeholder="<?php echo Lang::$word->CAL_ETITLE;?> *" type="text" name="name">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->CAL_CALENDAR;?></label>
          <select name="calendar_id" class="small">
            <?php if($this->data):?>
            <?php echo Utility::loopOptions($this->data, "id", "name");?>
            <?php endif;?>
          </select>
        </div>
      </div>
      <div class="wojo fields">
        <div class="basic field">
          <label>
            <?php echo Lang::$word->CAL_WHEN;?>
          </label>
        </div>
        <div class="basic field">
          <label>
            <?php echo empty($_GET['date']) ? Date::doDate("short_date", Date::today()) : Date::doDate("short_date", $_GET['date']);?>
          </label>
        </div>
      </div>
      <p>
        <span class="wojo small primary link demi text" onclick="$('#showDates').show()"><?php echo Lang::$word->CAL_SUB2;?></span>
      </p>
      <div class="hide-all" id="showDates">
        <div class="wojo fields">
          <div class="field">
            <div class="wojo icon input">
              <i class="icon calendar"></i>
              <input name="starts_on" type="text"  value="<?php echo empty($_GET['date']) ? Date::doDate("dd/MM/yyyy", Date::today()) : Date::doDate("dd/MM/yyyy", $_GET['date']);?>" placeholder="<?php echo Lang::$word->CAL_START_DATE;?>" readonly>
              <i class="icon clock"></i>
              <input name="starts_on_time" type="text" placeholder="<?php echo Lang::$word->CAL_START_TIME;?>" readonly>
            </div>
          </div>
        </div>
        <div class="wojo fields">
          <div class="field">
            <div class="wojo icon input">
              <i class="icon calendar"></i>
              <input name="ends_on" type="text" placeholder="<?php echo Lang::$word->CAL_END_DATE;?>" readonly>
              <i class="icon clock"></i>
              <input name="ends_on_time" type="text" placeholder="<?php echo Lang::$word->CAL_END_TIME;?>" readonly>
            </div>
          </div>
        </div>
      </div>
      <p>
        <span class="wojo small primary link demi text" onclick="$('#showNote').show()"><?php echo Lang::$word->INV_SUB7;?></span>
      </p>
      <div id="showNote" class="hide-all">
        <textarea name="comment" class="small"></textarea>
      </div>
      <div class="wojo divider"></div>
      <div class="center aligned">
        <button id="cancelEvent" type="button" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></button>
        <button id="processEvent" type="button" class="wojo small primary button"><?php echo Lang::$word->SAVE;?></button>
      </div>
      <input type="hidden" name="action" value="processEvent">
    </form>
  </div>
</div>
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function () {
	  $('input[name=starts_on]').wDate({
		  monthsFull: [<?php echo Date::monthList(false);?>],
		  monthsShort: [<?php echo Date::monthList(false, false);?>],
		  weeksFull: [<?php echo Date::weekList(false);?>],
		  weeksShort: [<?php echo Date::weekList(false, 3);?> ],
		  weeksMed: [<?php echo Date::weekList(false, 2);?>],
		  weeksSmall: [<?php echo Date::weekList(false, 1);?>],
		  rangeTo: $('input[name=ends_on]'),
		  format: 'dd/mm/yyyy',
		  clearBtn: true,
		  todayBtn: true,
		  cancelBtn: true,
		  ok: "<?php echo Lang::$word->OK;?>",
		  today: "<?php echo Lang::$word->TODAY;?>",
		  clear: "<?php echo Lang::$word->CLEAR;?>",
		  weekStart: <?php echo($this->core->weekstart);?>,
		  
	  });
	  $('input[name=ends_on]').wDate({
		  monthsFull: [<?php echo Date::monthList(false);?>],
		  monthsShort: [<?php echo Date::monthList(false, false);?>],
		  weeksFull: [<?php echo Date::weekList(false);?>],
		  weeksShort: [<?php echo Date::weekList(false, 3);?> ],
		  weeksMed: [<?php echo Date::weekList(false, 2);?>],
		  weeksSmall: [<?php echo Date::weekList(false, 1);?>],
		  rangeFrom: $('input[name=starts_on]'),
		  format: 'dd/mm/yyyy',
		  weekStart: <?php echo($this->core->weekstart);?>,
		  clearBtn: true,
		  todayBtn: true,
		  cancelBtn: true,
		  ok: "<?php echo Lang::$word->OK;?>",
		  today: "<?php echo Lang::$word->TODAY;?>",
		  clear: "<?php echo Lang::$word->CLEAR;?>",
	  });
	  
	  $('input[name=starts_on_time]').wTime({
		  rangeTo: $('input[name=ends_on_time]'),
		  format: "<?php echo ($this->core->time_format) == "HH:mm" ? "hh:mm" : "h:mm tt";?>",
		  hourPadding: false,
		  now: "<?php echo Lang::$word->NOW;?>",
	  });
	  $('input[name=ends_on_time]').wTime({
		  rangeFrom: $('input[name=starts_on_time]'),
		  format: "<?php echo ($this->core->time_format) == "HH:mm" ? "hh:mm" : "h:mm tt";?>",
		  now: "<?php echo Lang::$word->NOW;?>",
	  });
  });
// ]]>
</script>