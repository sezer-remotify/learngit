<?php
  /**
   * Project Times
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: time.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->INV_SUB5_1;?></h3>
<?php include_once(THEMEBASE . '/snippets/project_header.tpl.php');?>
<div class="wojo segment">
  <div class="row">
    <div class="columns right aligned">
      <?php if(isset($_GET['mode']) and $_GET['mode'] == "weekly"):?>
      <a class="wojo basic disabled icon button"><i class="icon calendar"></i></a>
      <a href="<?php echo Url::url("/dashboard/projects/time/" . $this->row->id);?>" class="wojo primary icon button"><i class="icon reorder"></i></a>
      <?php else:?>
      <a class="wojo basic disabled icon button"><i class="icon reorder"></i></a>
      <a href="<?php echo Url::url("/dashboard/projects/time/" . $this->row->id, "?mode=weekly");?>" class="wojo primary icon button"><i class="icon calendar"></i></a>
      <?php endif;?>
    </div>
  </div>
  <div class="row">
    <div class="columns screen-50 tablet-70 mobile-100 phone-100">
      <div class="wojo small horizontal divided list">
        <div class="item"><?php echo Lang::$word->TMR_SUB1;?>: <span class="wojo bold text"><?php echo $this->total_hours;?></span>
          <?php echo strtolower(Lang::$word->_HOURS);?></div>
        <div class="item"><?php echo Lang::$word->PRJ_BUDGET;?>: <span class="wojo bold text"><?php echo Utility::formatNumber($this->row->budget);?></span>
          <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?>
          <span class="wojo <?php echo (($this->row->budget == 0 or $this->row->budget > $this->grand_total) ? "positive" : "negative");?> text">(<?php echo ($this->row->budget == 0) ? 100 : Utility::doPercent($this->grand_total, $this->row->budget);?>% <?php echo strtolower(Lang::$word->SPENT);?>)</span></div>
        <a onclick="$('#showStats').slideToggle()" id="toggleStats" class="item grey"><?php echo Lang::$word->SHOW_D;?></a>
      </div>
      <div id="showStats" class="hide-all wojo light full padding bg">
        <div class="wojo small relaxed fluid divided list">
          <?php if($this->stats):?>
          <?php foreach($this->stats as $srow):?>
          <div class="item">
            <div class="content">
              <span class="wojo bold text"><?php echo Utility::decimalToHour($srow->total_hours);?>h</span>
              <?php echo $srow->name;?> @ <?php echo $srow->hrate;?>
              <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?> / h </div>
            <div class="content auto">
              <span class="wojo bold text"><?php echo Utility::formatNumber($srow->hrate * $srow->total_hours);?>
              <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?></span>
            </div>
          </div>
          <?php endforeach;?>
          <?php endif;?>
          <div class="item">
            <div class="content wojo bold text right aligned">+ <?php echo Lang::$word->INV_SUB5_2;?>: <span class="left-padding"><?php echo Utility::formatNumber($this->row->expenses);?>
              <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?></span>
            </div>
          </div>
          <div class="item">
            <div class="content wojo bold text right aligned">
              <?php echo Lang::$word->TMR_SUB2;?>:<span class="left-padding"><?php echo Utility::formatNumber($this->grand_total);?>
              <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="timeHolder">
  <?php if(isset($_GET['mode']) and $_GET['mode'] == "weekly"):?>
  <?php include_once (THEMEBASE . "/_time_weekly.tpl.php");?>
  <?php else:?>
  <?php include_once (THEMEBASE . "/_time_list.tpl.php");?>
  <?php endif;?>
</div>
<script src="<?php echo THEMEURL;?>/js/time.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Time({
		url: "<?php echo FRONTVIEW;?>",
		surl: "<?php echo SITEURL;?>",
		pid: "<?php echo $this->row->id;?>",
		weekstart: <?php echo($this->core->weekstart);?>,
        lang: {
            removeText: "<?php echo Lang::$word->REMOVE;?>",
			saveText: "<?php echo Lang::$word->TMR_TITLE1;?>",
			editText: "<?php echo Lang::$word->TMR_TITLE2;?>",
			monthsFull: [ <?php echo Date::monthList(false);?> ],
			monthsShort: [ <?php echo Date::monthList(false, false);?> ],
			weeksShort: [ <?php echo Date::weekList(false, false);?> ],
			today: "<?php echo Lang::$word->TODAY;?>",
        }
    });
});
// ]]>
</script>