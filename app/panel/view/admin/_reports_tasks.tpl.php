<?php
  /**
   * Reports Uninvoiced
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _reports_tasks.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo fitted segment">
  <div class="divided header">
    <h4 class="basic"><?php echo Lang::$word->TSK_TASKS;?></h4>
  </div>
  <div class="wojo form content">
    <form method="post" id="task_form" name="wojo_form">
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label><?php echo Lang::$word->PRJ_PROJECTS;?></label>
        </div>
        <div class="field">
          <select name="project_id">
            <option value="any"><?php echo Lang::$word->REP_SUB11;?></option>
            <option value="active"><?php echo Lang::$word->PRJ_SUB4;?></option>
            <option value="completed"><?php echo Lang::$word->REP_SUB12;?></option>
            <option value="category"><?php echo Lang::$word->REP_SUB13;?>...</option>
            <option value="company"><?php echo Lang::$word->REP_SUB14;?>...</option>
            <option value="selected"><?php echo Lang::$word->SELECTED;?>...</option>
          </select>
        </div>
        <div class="field" id="project_id"></div>
      </div>
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label>
            <?php echo Lang::$word->REP_SUB15;?></label>
        </div>
        <div class="field">
          <select name="assign_id">
            <option value="any"><?php echo Lang::$word->ANYBODY;?></option>
            <option value="users"><?php echo Lang::$word->REP_SUB16;?>...</option>
          </select>
        </div>
        <div class="field" id="assign_id"></div>
      </div>
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label>
            <?php echo Lang::$word->TSK_SUB5_1;?></label>
        </div>
        <div class="field">
          <select name="tasklist_id">
            <option value="any"><?php echo Lang::$word->ANY;?></option>
            <option value="nolist"><?php echo Lang::$word->REP_SUB17;?></option>
            <option value="selected"><?php echo Lang::$word->SELECTED;?>...</option>
          </select>
        </div>
        <div class="field" id="tasklist_id"></div>
      </div>
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label>
            <?php echo Lang::$word->LABEL;?></label>
        </div>
        <div class="field">
          <select name="label_id">
            <option value="any"><?php echo Lang::$word->ANY;?></option>
            <option value="nolabel"><?php echo Lang::$word->REP_SUB18;?></option>
            <option value="selected"><?php echo Lang::$word->SELECTED;?>...</option>
          </select>
        </div>
        <div class="field" id="label_id"></div>
      </div>
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label>
            <?php echo Lang::$word->INV_DUED;?></label>
        </div>
        <div class="field">
          <select name="duedate_id">
            <option value="any"><?php echo Lang::$word->ANY;?></option>
            <option value="noduedate"><?php echo Lang::$word->REP_SUB19;?></option>
            <option value="today"><?php echo Lang::$word->TODAY;?></option>
            <option value="tomorrow"><?php echo Lang::$word->TOMORROW;?></option>
            <option value="thisweek"><?php echo Lang::$word->THIS_WEEK;?></option>
            <option value="nextweek"><?php echo Lang::$word->NEXT_WEEK;?></option>
            <option value="thismonth"><?php echo Lang::$word->THIS_MONTH;?></option>
            <option value="nextmonth"><?php echo Lang::$word->NEXT_MONTH;?></option>
            <option value="selected"><?php echo Lang::$word->SELECTED;?>...</option>
            <option value="range"><?php echo Lang::$word->REP_SUB20;?>...</option>
          </select>
        </div>
        <div class="field" id="duedate_id"></div>
      </div>
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label>
            <?php echo Lang::$word->CREATED_BY;?></label>
        </div>
        <div class="field">
          <select name="createdby_id">
            <option value="any"><?php echo Lang::$word->ANYBODY;?></option>
            <option value="users"><?php echo Lang::$word->SELECTED;?>...</option>
          </select>
        </div>
        <div class="field" id="createdby_id"></div>
      </div>
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label>
            <?php echo Lang::$word->CREATED_ON;?></label>
        </div>
        <div class="field">
          <select name="created_id">
            <option value="any"><?php echo Lang::$word->ANY;?></option>
            <option value="today"><?php echo Lang::$word->TODAY;?></option>
            <option value="yesterday"><?php echo Lang::$word->YESTERDAY;?></option>
            <option value="thisweek"><?php echo Lang::$word->THIS_WEEK;?></option>
            <option value="thismonth"><?php echo Lang::$word->THIS_MONTH;?></option>
            <option value="lastweek"><?php echo Lang::$word->LAST_WEEK;?></option>
            <option value="lastmonth"><?php echo Lang::$word->LAST_MONTH;?></option>
            <option value="selected"><?php echo Lang::$word->SELECTED;?>...</option>
            <option value="range"><?php echo Lang::$word->REP_SUB20;?>...</option>
          </select>
        </div>
        <div class="field" id="created_id"></div>
      </div>
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label><?php echo Lang::$word->COMPLETED_BY;?></label>
        </div>
        <div class="field">
          <select name="completedby_id">
            <option value="any"><?php echo Lang::$word->ANYBODY;?></option>
            <option value="users"><?php echo Lang::$word->SELECTED;?>...</option>
          </select>
        </div>
        <div class="field" id="completedby_id"></div>
      </div>
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label>
            <?php echo Lang::$word->COMPLETED_ON;?></label>
        </div>
        <div class="field">
          <select name="completed_id">
            <option value="open"><?php echo Lang::$word->REP_SUB21;?></option>
            <option value="today"><?php echo Lang::$word->TODAY;?></option>
            <option value="yesterday"><?php echo Lang::$word->YESTERDAY;?></option>
            <option value="thisweek"><?php echo Lang::$word->THIS_WEEK;?></option>
            <option value="thismonth"><?php echo Lang::$word->THIS_MONTH;?></option>
            <option value="lastweek"><?php echo Lang::$word->LAST_WEEK;?></option>
            <option value="lastmonth"><?php echo Lang::$word->LAST_MONTH;?></option>
            <option value="selected"><?php echo Lang::$word->SELECTED;?>...</option>
            <option value="range"><?php echo Lang::$word->REP_SUB20;?>...</option>
          </select>
        </div>
        <div class="field" id="completed_id"></div>
      </div>
      <div class="wojo fields align middle">
        <div class="field three wide labeled">
          <label>&nbsp;</label>
        </div>
        <div class="field">
          <button type="button" name="run" class="wojo small primary button"><?php echo Lang::$word->REP_RUN;?></button>
        </div>
      </div>
      <input type="hidden" name="action" value="loadTaskReports">
    </form>
  </div>
  <div id="results" class="wojo basic attached segment">
      <div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/search_empty.svg" alt="" class="wojo center large image">
        <p class="wojo semi grey text"><?php echo Lang::$word->REP_INFO11;?></p>
      </div>
  </div>
</div>
<script src="<?php echo ADMINVIEW;?>/js/reportsTasks.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.reportsTasks({
		url: "<?php echo ADMINVIEW;?>",
		weekstart: <?php echo($this->core->weekstart);?>,
		short_date: '<?php echo($this->core->short_date);?>',
        lang: {
			monthsFull: [<?php echo Date::monthList(false);?>],
			monthsShort: [<?php echo Date::monthList(false, false);?>],
			weeksShort: [<?php echo Date::weekList(false, false);?>],
			today: "<?php echo Lang::$word->TODAY;?>",
			from: "<?php echo Lang::$word->FROM;?>",
			to: "<?php echo Lang::$word->TO;?>",
        }
    });
});
// ]]>
</script>