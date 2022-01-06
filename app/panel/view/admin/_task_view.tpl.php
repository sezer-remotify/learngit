<?php
  /**
   * Task View
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _task_view.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->TSK_TITLE3;?></h3>
<h4><?php echo $this->row->pname;?></h4>
<div class="row gutters">
  <div class="columns screen-70 tablet-60 mobile-100 phone-100">
    <div class="wojo segment">
      <p class="wojo small text">
        <a href="<?php echo Url::url("/admin/projects/tasks", $this->row->project_id);?>"><?php echo $this->row->pname;?></a>
        - <?php echo Lang::$word->TSK_TASK . '#' . $this->row->id;?> - <?php echo Lang::$word->CREATED_BY;?>
        <a href="<?php echo Url::url("/admin/members/details", $this->row->created_by_id);?>"><?php echo $this->row->created_by_name;?></a>
        <?php echo strtolower(Lang::$word->ON) . ' ' . Date::doDate("short_date", $this->row->created);?>
      </p>
      <div class="wojo space divider"></div>
      <div class="wojo checkbox">
        <input type="checkbox" class="is_completed" value="<?php echo $this->row->project_id;?>" id="is_complete">
        <label for="is_complete"><span class="wojo large text"><?php echo $this->row->name;?></span></label>
      </div>
      <?php echo $this->row->body;?>
      <?php if($this->filedata):?>
      <!-- Start Attachments -->
      <div class="wojo space divider"></div>
      <h6><?php echo Lang::$word->ATTACHMENTS;?></h6>
      <div id="fileList" class="wojo small fluid relaxed celled list">
        <?php foreach($this->filedata as $frow):?>
        <div class="item align middle">
          <div class="content auto padding right">
            <img src="<?php echo SITEURL;?>/assets/images/filetypes/<?php echo File::getFileType($frow->name);?>" class="wojo default rounded image">
          </div>
          <div class="content">
            <p class="header"><?php echo $frow->caption;?></p>
            <p class="wojo tiny text">
              <?php echo File::getSize($frow->fsize);?> - <a href="<?php echo SITEURL;?>/download.php?id=<?php echo $frow->id;?>"><?php echo Lang::$word->DOWNLOAD;?></a>
            </p>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <?php endif;?>
    </div>
    <h6><?php echo Lang::$word->MSG_DISC;?></h6>
    <div class="row align middle">
      <div class="columns auto"><img src="<?php echo UPLOADURL;?>/avatars/<?php echo App::Auth()->avatar ? App::Auth()->avatar : "blank.svg";?>" alt="" class="wojo small circular image"></div>
      <div class="columns padding left">
        <div class="is_editor wojo segment"><?php echo Lang::$word->TSK_INFO5;?></div>
        <div id="cButtons" class="hide-all small full padding">
          <button name="doComments" type="button" data-id="0" class="wojo small primary button">
          <?php echo Lang::$word->TSK_SUB16;?>
          </button>
          <a id="cCancel" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
        </div>
      </div>
    </div>
    
    <!-- Start Comments -->
    <ul id="dComments" class="wojo timeline">
      <?php if($this->messages):?>
	  <?php $i = count($this->messages);?>
      <?php foreach($this->messages as $mrow):?>
      <li class="item" id="item_<?php echo $mrow->id;?>">
        <div class="badge">
          <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $mrow->avatar ? $mrow->avatar : "blank.svg" ;?>">
        </div>
        <div class="content">
          <div class="row align middle">
            <div class="columns">
              <a class="wojo secondary inverted rounded label" href="<?php echo Url::url("/admin/members/details", $mrow->created_by_id);?>"><span class="counter"><?php echo $i--;?></span><?php echo $mrow->created_by_name;?></a>
              <?php echo Date::timesince($mrow->created);?></div>
            <div class="columns auto">
              <a class="grey" data-dropdown="#discDrop_<?php echo $mrow->id;?>">
              <i class="icon horizontal ellipsis"></i>
              </a>
              <div class="wojo dropdown small pointing top-right" id="discDrop_<?php echo $mrow->id;?>">
                <!-- Start editMessage -->
                <a class="editMessage item" data-id="<?php echo $mrow->id;?>"><?php echo Lang::$word->EDIT;?></a>
                <div class="divider"></div>
                <!-- Start trashDiscMessage -->
                <a data-set='{"option":[{"trash": "trashTaskMessage","title": "<?php echo Validator::sanitize(Lang::$word->TSK_SUB15 . ' #' . $i, "chars");?>","id":<?php echo $mrow->id;?>,"task_id":<?php echo $this->row->id;?>, "pid":<?php echo $this->row->project_id;?>,"taskname": "<?php echo $this->row->name;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $mrow->id;?>"}' class="item wojo demi text data">
                <?php echo Lang::$word->MTOTRASH;?>
                </a>
              </div>
            </div>
          </div>
          <div id="msg_<?php echo $mrow->id;?>" class="description"><?php echo $mrow->body;?></div>
        </div>
      </li>
      <?php endforeach;?>
      <?php endif;?>
    </ul>
    <p><a id="showHistory" class="wojo small demi icon right text"><?php echo Lang::$word->TSK_SUB12;?>
      <i class="icon chevron black down"></i></a>
    </p>
    <div id="tHistory" class="hide-all"></div>
  </div>
  <div class="columns screen-30 tablet-40 mobile-100 phone-100">
    <div class="wojo simple form segment">
      <div class="wojo block fields">
        <div class="field">
          <label><?php echo Lang::$word->TSK_SUB5;?></label>
          <div class="wojo small dark inverted rounded right button" data-dropdown="#dTaskList">
            <span class="text"><?php echo Utility::searchForValueName("id", $this->row->task_list_id, "name", $this->tasklists);?></span>
            <i class="icon chevron down"></i>
          </div>
          <div class="wojo dropdown small pointing top-center" id="dTaskList">
            <?php if($this->tasklists):?>
            <?php foreach($this->tasklists as $trow):?>
            <a class="item <?php echo Validator::getActive($trow->id, $this->row->task_list_id);?>" data-html="<?php echo $trow->name;?>" data-value="<?php echo $trow->id;?>">
            <?php echo $trow->name;?>
            </a>
            <?php endforeach;?>
            <?php endif;?>
            <input type="hidden" name="list_id" value="<?php echo $this->row->task_list_id;?>">
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->TSK_SUB4;?></label>
          <div class="row">
            <div class="columns">
              <div class="wojo small dark inverted rounded right button" data-dropdown="#dAssignList">
                <span class="text"><?php echo Utility::searchForValueName("id", $this->row->assigned_id, "name", $this->puserdata);?></span>
                <i class="icon chevron down"></i>
              </div>
            </div>
            <div class="columns auto">
              <div class="wojo mini circular shadow image">
                <img id="dAvatar" src="<?php echo UPLOADURL;?>/avatars/<?php echo $this->row->avatar ? $this->row->avatar : "blank.svg" ;?>" alt="">
              </div>
            </div>
          </div>
          <div class="wojo dropdown small pointing top-center" id="dAssignList">
            <?php if($this->puserdata):?>
            <?php foreach($this->puserdata as $prow):?>
            <?php if($prow->type != "member"):?>
            <a class="item <?php echo Validator::getActive($prow->id, $this->row->assigned_id);?>" data-html="<?php echo $prow->name;?>" data-value="<?php echo $prow->id;?>">
            <?php echo $prow->name;?>
            </a>
            <?php endif;?>
            <?php endforeach;?>
            <?php endif;?>
            <input type="hidden" name="assignee" value="<?php echo $this->row->assigned_id;?>">
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->INV_DUEON;?></label>
          <div id="dDueDate" class="datepick inline flex" data-pid="<?php echo $this->row->project_id;?>"  data-element="input[name=due_date]" data-parent="#elButton > span">
            <div class="wojo small dark inverted rounded right button" id="elButton">
              <span><?php echo Date::doDate("short_date", $this->row->due_on);?></span>
              <i class="icon chevron down"></i></div>
          </div>
          <input type="hidden" name="due_date" value="<?php echo $this->row->due_on;?>">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->PRJ_LABELS;?></label>
          <a data-dropdown="#dLabelList" class="wojo small dark inverted rounded right button"><?php echo Lang::$word->TSK_INFO3;?>
          <i class="icon chevron down"></i></a>
          <div class="wojo dropdown small pointing top-center" id="dLabelList">
            <div style="max-width:400px">
              <div class="row grid phone-1 mobile-1 tablet-2 screen-2">
                <?php if($this->tasklabels):?>
                <?php foreach($this->tasklabels as $tskrow):?>
                <div class="columns">
                  <div class="wojo small checkbox">
                    <input type="checkbox" name="labels[]" value="<?php echo $tskrow->id;?>" id="labels_<?php echo $tskrow->id;?>" <?php echo in_array($tskrow->id, array_column($this->itemlabels, 'id')) ? 'checked="checked"' : null;?>>
                    <label for="labels_<?php echo $tskrow->id;?>" style="color:<?php echo $tskrow->color;?>"><?php echo $tskrow->name;?></label>
                  </div>
                </div>
                <?php endforeach;?>
                <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="dIsHidden" class="wojo toggle checkbox">
        <input type="checkbox" name="is_hidden" value="1" id="hid_1" <?php Validator::getChecked($this->row->is_hidden, 1);?>>
        <label for="hid_1"><?php echo Lang::$word->TSK_SUB7;?></label>
      </div>
      <div id="dIsPriority" class="wojo toggle checkbox">
        <input type="checkbox" name="is_priority" value="1" id="hid_2" <?php Validator::getChecked($this->row->is_priority, 1);?>>
        <label for="hid_2"><?php echo Lang::$word->TSK_SUB8;?></label>
      </div>
      <div class="wojo fitted auto divider"></div>
      <h6><?php echo Lang::$word->TSK_SUB9;?></h6>
      <div class="wojo simple segment">
        <!-- Start addTimeRecord -->
        <div class="row align middle">
          <div class="columns">
            <span id="dHours" class="wojo large text">
            <?php echo Utility::decimalToHour($this->terow->total_hours);?>
            </span>
            <small class="wojo grey text"><?php echo Lang::$word->_HOURS;?></small>
          </div>
          <div class="columns auto">
            <a data-set='{"option":[{"action":"addTimeRecord","id":<?php echo $this->row->id;?>}], "label":"<?php echo Lang::$word->TSK_TITLE2;?>", "url":"helper.php", "parent":"#dHours", "complete":"replace", "modalclass":"medium","buttons":false}' class="wojo small simple button action">+ <?php echo Lang::$word->TSK_BTN1;?></a>
          </div>
        </div>
        <div class="wojo small divider"></div>
        <!-- Start addExpense -->
        <div class="row align middle">
          <div class="columns">
            <span id="dAmount" class="wojo large text"><?php echo Utility::formatNumber($this->terow->total_amount);?>
            </span><small class="wojo grey text"><?php echo ($this->row->currency) ? $this->row->currency : $this->core->currency;?></small>
          </div>
          <div class="columns auto">
            <a data-set='{"option":[{"action":"addExpenseRecord","id":<?php echo $this->row->id;?>}], "label":"<?php echo Lang::$word->TSK_TITLE2;?>", "url":"helper.php", "parent":"#dAmount", "complete":"replace", "modalclass":"medium","buttons":false}' class="wojo small simple button action">+ <?php echo Lang::$word->TSK_BTN2;?></a>
          </div>
        </div>
      </div>
      
      <!-- Start Time Estimation  -->
      <a data-dropdown="#eJobHours" id="dJobHours" class="wojo small dark inverted fluid right button"><?php echo ($this->row->job_id) ? $this->row->job_hours . ' ' . Lang::$word->OF . ' ' . Utility::searchForValueName('id', $this->row->job_id, 'name', Utility::jSonToArray($this->core->job_types)). ' ' .  Lang::$word->TSK_SUB10 : Lang::$word->TSK_SUB3;?>
      <i class="icon chevron down"></i></a>
      <div id="eJobHours" class="wojo dropdown small pointing top-center">
        <div class="wojo small fields">
          <div class="field">
            <div class="wojo small input">
              <input placeholder="Eg: 1.30" value="<?php echo $this->row->job_hours;?>" type="text" name="job_hours">
              <select name="job_id" class="small selectbox">
                <?php if($this->core->job_types):?>
                <?php foreach(Utility::jSonToArray($this->core->job_types) as $jrow):?>
                <option value="<?php echo $jrow->id;?>"<?php echo ($this->row->job_id == $jrow->id ? 'selected="selected"' : null);?>><?php echo $jrow->name;?></option>
                <?php endforeach;?>
                <?php endif;?>
              </select>
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="basic field">
            <button name="set" type="button" class="wojo small secondary button" <?php echo ($this->row->job_hours ? "" : "disabled");?>><?php echo Lang::$word->SET;?></button>
          </div>
          <div class="basic field content-right"><a id="removeJob" class="wojo small simple negative icon button"><i class="icon delete"></i></a>
          </div>
        </div>
      </div>
      <div class="wojo fitted auto divider"></div>
      <!-- Start Subscribers  -->
      <h6><?php echo Lang::$word->TSK_SUB6;?></h6>
      <div id="subData">
        <div class="wojo space divider"></div>
        <?php if($this->puserdata):?>
        <?php $key = $this->taskusers ? explode(",", $this->taskusers->uid) : [];?>
        <div id="subscList">
          <?php foreach($this->puserdata as $prow):?>
          <?php $checked = (in_array($prow->id, $key) ? ' checked="checked"' : '');?>
          <div id="dSbList_<?php echo $prow->id;?>" class="wojo small checkbox">
            <input type="checkbox" data-name="<?php echo $prow->name;?>" name="subscribers[]" value="<?php echo $prow->id;?>" id="subs_<?php echo $prow->id;?>"<?php echo $checked;?>>
            <label for="subs_<?php echo $prow->id;?>"><?php echo $prow->name;?></label>
          </div>
          <?php endforeach;?>
          <?php endif;?>
        </div>
      </div>
      <div class="wojo fitted auto divider"></div>
      <div id="taskProgress" class="padding"></div>
    </div>
  </div>
</div>
<script src="<?php echo ADMINVIEW;?>/js/view_tasks.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Tasks({
		url: "<?php echo ADMINVIEW;?>",
		surl: "<?php echo SITEURL;?>",
		pid: "<?php echo $this->row->project_id;?>",
		taskname: "<?php echo $this->row->name;?>",
		  lang: {
			  removeText: "<?php echo Lang::$word->REMOVE;?>",
			  jobHours: "<?php echo Lang::$word->TSK_HOURSOF;?>",
			  timeEst: "<?php echo Lang::$word->TSK_SUB3;?>",
			  updateTask: "<?php echo Lang::$word->TSK_UPDATE;?>",
			  showHistory: "<?php echo Lang::$word->TSK_SUB12;?>",
			  hideHistory: "<?php echo Lang::$word->TSK_SUB13;?>",
			  btnmAdd: "<?php echo Lang::$word->TSK_SUB16;?>",
			  btnmUpd: "<?php echo Lang::$word->TSK_SUB17;?>",
		  }
    });
});
// ]]>
</script>