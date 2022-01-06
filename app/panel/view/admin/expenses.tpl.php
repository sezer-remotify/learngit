<?php
  /**
   * Expenses
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: expenses.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3>
  <?php echo Lang::$word->EXP_TITLE;?>
</h3>
<?php include_once(ADMINBASE . '/snippets/project_header.tpl.php');?>
<div class="wojo segment">
  <div class="row gutters">
    <div class="columns phone-100">
      <a id="showExpForm" class="wojo secondary button stacked"><i class="icon plus alt"></i><?php echo Lang::$word->EXP_TITLE1;?></a>
    </div>
    <div class="columns auto">
      <?php if(isset($_GET['mode']) and $_GET['mode'] == "weekly"):?>
      <a class="wojo basic disabled icon button"><i class="icon calendar"></i></a>
      <a href="<?php echo Url::url("/admin/projects/expenses/" . $this->row->id);?>" class="wojo primary icon button"><i class="icon unordered list"></i></a>
      <?php else:?>
      <a class="wojo basic disabled icon button"><i class="icon unordered list"></i></a>
      <a href="<?php echo Url::url("/admin/projects/expenses/" . $this->row->id, "?mode=weekly");?>" class="wojo primary icon button"><i class="icon calendar"></i></a>
      <?php endif;?>
    </div>
  </div>
  <div id="expForm" class="hide-all">
    <form method="post" id="wojo_form" name="wojo_form">
      <div class="wojo form">
        <div class="row gutters">
          <div class="columns screen-60 tablet-50 mobile-100 phone-100">
            <div class="wojo simple grey100 bg segment">
              <div class="wojo small block fields">
                <div class="field">
                  <div class="wojo input">
                    <input placeholder="<?php echo Lang::$word->TITLE;?> *" type="text" name="title">
                  </div>
                </div>
                <div class="field">
                  <div class="wojo input">
                    <textarea name="description" placeholder="<?php echo Lang::$word->DESCRIPTION;?>"></textarea>
                  </div>
                </div>
              </div>
              <button type="button" data-action="processExpenseRecord" name="dosubmit" class="wojo small primary button"><?php echo Lang::$word->EXP_TITLE1;?></button>
              <a id="hideExpForm" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
            </div>
          </div>
          <div class="columns screen-40 tablet-50 mobile-100 phone-100">
            <div class="wojo small block fields">
              <div class="field">
                <label><?php echo Lang::$word->_HOURS;?></label>
                <div class="wojo input">
                  <input placeholder="<?php echo Lang::$word->INV_AMOUNT;?> *" type="text" name="amount">
                  <span class="wojo simple label">
                  <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?>
                  </span>
                </div>
              </div>
              <?php if(Auth::checkAcl("owner")):?>
              <div class="field">
                <div class="wojo small dark inverted rounded right button" data-dropdown="#mUserList">
                  <span class="text"><?php echo Lang::$word->TSK_SUB11;?></span>
                  <i class="icon chevron down"></i>
                </div>
                <div class="wojo dropdown small pointing top-center" id="mUserList">
                  <?php if($this->puserdata):?>
                  <?php foreach($this->puserdata as $prow):?>
                  <?php if($prow->type != "member"):?>
                  <a class="item" data-html="<?php echo $prow->name;?>" data-value="<?php echo $prow->id;?>">
                  <?php echo $prow->name;?></a>
                  <?php endif;?>
                  <?php endforeach;?>
                  <?php endif;?>
                  <input type="hidden" name="user_id" value="<?php echo Auth::$userdata->id;?>">
                </div>
              </div>
              <?php endif;?>
              <div class="field">
                <div class="wojo small dark inverted rounded right button" data-dropdown="#mJobList">
                  <span class="text"><?php echo Lang::$word->EXP_CATS;?></span>
                  <i class="icon chevron down"></i>
                </div>
                <div class="wojo dropdown small  pointing top-center" id="mJobList">
                  <?php if($this->core->expcats):?>
                  <?php foreach(Utility::jSonToArray($this->core->expcats) as $jrow):?>
                  <a class="item" data-html="<?php echo $jrow->name;?>" data-value="<?php echo $jrow->id;?>">
                  <?php echo $jrow->name;?></a>
                  <?php endforeach;?>
                  <?php endif;?>
                  <input type="hidden" name="category_id" value="0">
                </div>
              </div>
              <div class="field">
                <div id="mCreated" class="datepick inline flex" data-element="input[name=created]" data-parent="#elButton > span">
                  <div class="wojo small dark inverted rounded right button" id="elButton">
                    <span><?php echo Date::doDate("short_date", Date::today());?></span>
                    <i class="icon chevron down"></i></div>
                </div>
                <input type="hidden" name="created" value="<?php echo Date::doDate("short_date", Date::today());?>">
              </div>
              <div class="field">
                <div class="wojo toggle checkbox">
                  <input type="checkbox" name="is_billable" value="1" id="mBillable">
                  <label for="mBillable"><?php echo Lang::$word->INV_ISBILL;?></label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="task_id" value="0">
      <input type="hidden" name="taskname" value="<?php echo $this->row->name;?>">
      <input type="hidden" name="not_modal" value="1">
      <input type="hidden" name="project_id" value="<?php echo $this->row->id;?>">
      <input type="hidden" name="currency" value="<?php echo $this->row->currency;?>">
      <?php if(isset($_GET['mode']) and $_GET['mode'] == "weekly"):?>
      <input type="hidden" name="return" value="<?php echo Url::url("/admin/projects/expenses/" . $this->row->id, "?mode=weekly");?>">
      <?php else:?>
      <input type="hidden" name="return" value="<?php echo Url::url("/admin/projects/expenses", $this->row->id);?>">
      <?php endif;?>
    </form>
  </div>
  <div class="row">
    <div class="columns screen-50 tablet-70 mobile-100 phone-100">
      <div class="wojo small horizontal divided list">
        <div class="item"><?php echo Lang::$word->TMR_SUB1;?>: <span class="wojo bold text"><?php echo Utility::formatNumber($this->row->expenses);?></span>
          <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?>
        </div>
        <div class="item"><?php echo Lang::$word->PRJ_BUDGET;?>: <span class="wojo bold text"><?php echo Utility::formatNumber($this->row->budget);?></span>
          <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?>
          <span class="wojo <?php echo (($this->row->budget == 0 or $this->row->budget > $this->grand_total) ? "positive" : "negative");?> text">(<?php echo ($this->row->budget == 0) ? 100 : Utility::doPercent($this->grand_total, $this->row->budget);?>% <?php echo strtolower(Lang::$word->SPENT);?>)</span></div>
        <a onclick="$('#showStats').slideToggle()" id="toggleStats" class="item grey"><?php echo Lang::$word->SHOW_D;?></a>
      </div>
      <div id="showStats" class="wojo light full padding bg hide-all">
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
              <?php echo Lang::$word->TMR_SUB2;?>: <span class="left-padding"><?php echo Utility::formatNumber($this->grand_total);?>
              <?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="expHolder">
  <?php if(isset($_GET['mode']) and $_GET['mode'] == "weekly"):?>
  <?php include_once (ADMINBASE . "/_expenses_weekly.tpl.php");?>
  <?php else:?>
  <?php include_once (ADMINBASE . "/_expenses_list.tpl.php");?>
  <?php endif;?>
</div>
<script src="<?php echo ADMINVIEW;?>/js/expenses.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Expense({
		url: "<?php echo ADMINVIEW;?>",
		surl: "<?php echo SITEURL;?>",
		pid: "<?php echo $this->row->id;?>",
		weekstart: "<?php echo($this->core->weekstart);?>",
		currency: "<?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?>",
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
			saveText: "<?php echo Lang::$word->EXP_TITLE1;?>",
			editText: "<?php echo Lang::$word->EXP_TITLE2;?>",
        }
    });
});
// ]]>
</script>