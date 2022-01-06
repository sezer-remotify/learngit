<?php
  /**
   * Projects Task View
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _project_view.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>

<h3><?php echo Lang::$word->TSK_TITLE1;?></h3>
<?php include_once(ADMINBASE . '/snippets/project_header.tpl.php');?>
<div class="row gutters">
  <div id="mainTasks" class="columns screen-80 tablet-70 mobile-100 phone-100">
    <div class="wojo segment">
      <a id="showTaskForm" class="wojo small simple button"><i class="icon plus alt"></i>
      <?php echo Lang::$word->TSK_ADD;?></a>
      <div class="hide-all wojo form" id="taskForm">
        <form method="post" id="wojo_form" name="wojo_form">
          <div class="row small horizontal gutters">
            <div class="columns screen-60 tablet-100 mobile-100 phone-100">
              <div class="small bottom padding">
                <div class="wojo big basic input">
                  <input placeholder="<?php echo Lang::$word->TSK_NAME;?> *" type="text" name="name">
                </div>
              </div>
              <textarea name="body" class="altpost" placeholder="<?php echo Lang::$word->TSK_DESC;?>"></textarea>
              <div class="small full padding">
                <div class="wojo basic uploader" id="drag-and-drop-zone">
                  <div class="content">
                    <label class="align spaced">
                      <span class="wojo small demi grey text"><?php echo Lang::$word->ATTACHMENTS;?></span>
                      <a class="wojo small demi grey text"><?php echo Lang::$word->FMG_UPLFILES;?></a>
                      <input type="file" multiple name="attach[]">
                    </label>
                  </div>
                </div>
              </div>
              <!-- Start fileUploads -->
              <div id="fileList" class="wojo items celled"></div>
              <div class="wojo basic divider"></div>
              <div class="small full padding">
                <div class="flex align spaced">
                  <span class="wojo small demi grey text"><?php echo Lang::$word->TSK_SUB6;?></span>
                  <a data-slide="true" data-trigger="#subData" class="wojo small demi grey text"><?php echo Lang::$word->CHOOSE;?></a>
                </div>
                <div id="subData" class="hide-all">
                  <p id="subList" class="wojo small semi text"></p>
                  <?php if($this->puserdata):?>
                  <div class="row grid screen-2 tablet-2 mobile-1 phone-2" id="subscList">
                    <?php foreach($this->puserdata as $prow):?>
                    <div class="columns">
                      <div id="dSbList_<?php echo $prow->id;?>" class="wojo small checkbox">
                        <input type="checkbox" data-name="<?php echo $prow->name;?>" name="subscribers[]" value="<?php echo $prow->id;?>" id="subs_<?php echo $prow->id;?>">
                        <label for="subs_<?php echo $prow->id;?>"><?php echo $prow->name;?></label>
                      </div>
                    </div>
                    <?php endforeach;?>
                  </div>
                  <?php endif;?>
                </div>
              </div>
            </div>
            <div class="columns screen-40 tablet-100 mobile-100 phone-100">
              <div class="wojo simple right button" data-dropdown="#dTaskList">
                <span class="text"><?php echo Lang::$word->TSK_INFO1;?></span>
                <i class="icon chevron down"></i>
              </div>
              <div class="wojo dropdown small pointing top-center" id="dTaskList">
                <a class="item" data-value="0" data-html="<?php echo Lang::$word->NONE;?>"><?php echo Lang::$word->NONE;?></a>
                <div class="divider"></div>
                <?php if($this->tasklists):?>
                <?php foreach($this->tasklists as $trow):?>
                <a class="item" data-html="<?php echo $trow->name;?>" data-value="<?php echo $trow->id;?>">
                <?php echo $trow->name;?>
                </a>
                <?php endforeach;?>
                <?php endif;?>
                <input type="hidden" name="list_id">
              </div>
              <div class="wojo basic space divider"></div>
              <div class="wojo simple right button" data-dropdown="#dAssignList">
                <span class="text"><?php echo Lang::$word->TSK_INFO2;?></span>
                <i class="icon chevron down"></i>
              </div>
              <div class="wojo dropdown small pointing top-center" id="dAssignList">
                <a class="item" data-value="0" data-html="<?php echo Lang::$word->NONE;?>"><?php echo Lang::$word->NONE;?></a>
                <div class="divider"></div>
                <?php if($this->puserdata):?>
                <?php foreach($this->puserdata as $prow):?>
                <?php if($prow->type != "member"):?>
                <a class="item" data-html="<?php echo $prow->name;?>" data-value="<?php echo $prow->id;?>">
                <?php echo $prow->name;?>
                </a>
                <?php endif;?>
                <?php endforeach;?>
                <?php endif;?>
                <input type="hidden" name="assignee">
              </div>
              <div class="wojo basic space divider"></div>
              <a data-dropdown="#tLabels_<?php echo $trow->id;?>" class="wojo simple right button"><?php echo Lang::$word->TSK_INFO3;?>
              <i class="icon chevron down"></i></a>
              <div class="wojo static dropdown small pointing top-center" id="tLabels_<?php echo $trow->id;?>">
                <div style="max-width:400px">
                  <div class="row grid phone-1 mobile-1 tablet-2 screen-2">
                    <?php if($this->tasklabels):?>
                    <?php foreach($this->tasklabels as $tskrow):?>
                    <div class="columns">
                      <div class="wojo small checkbox">
                        <input type="checkbox" name="labels[]" value="<?php echo $tskrow->id;?>" id="labels_<?php echo $tskrow->id;?>">
                        <label for="labels_<?php echo $tskrow->id;?>" style="color:<?php echo $tskrow->color;?>"><?php echo $tskrow->name;?></label>
                      </div>
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>
                  </div>
                </div>
              </div>
              <div class="wojo basic space divider"></div>
              <div id="dDueDate" class="datepick" data-element="input[name=due_date]" data-parent="#elButton > span">
                <div id="elButton" class="wojo simple right button">
                  <span><?php echo Lang::$word->TSK_INFO4;?></span>
                  <i class="icon chevron down"></i></div>
              </div>
              <input type="hidden" name="due_date">
              <div class="wojo simple small form segment">
                <label class="wojo small demi text"><?php echo Lang::$word->TSK_SUB3;?>
                  <span id="jobrate" class="wojo grey text"></span></label>
                <div class="wojo space divider"></div>
                <div class="wojo fields">
                  <div class="field">
                    <div class="wojo small input">
                      <input placeholder="Eg: 1.30" type="text" name="job_hours">
                    </div>
                  </div>
                  <div class="field">
                    <select name="job_id" class="">
                      <?php if($this->job_types):?>
                      <?php foreach($this->job_types as $jrow):?>
                      <option value="<?php echo $jrow->id;?>"><?php echo $jrow->name;?></option>
                      <?php endforeach;?>
                      <?php endif;?>
                    </select>
                  </div>
                </div>
                <div class="wojo fields align middle">
                  <div class="basic field">
                    <button name="set" type="button" class="wojo small secondary button" disabled><?php echo Lang::$word->SET;?></button>
                  </div>
                  <div class="basic field auto">
                    <a id="removeJob" class="wojo small simple negative icon button"><i class="icon delete"></i></a>
                  </div>
                </div>
              </div>
              <div id="dIsHidden" class="wojo toggle checkbox">
                <input type="checkbox" name="is_hidden" value="1" id="hid_1">
                <label for="hid_1"><?php echo Lang::$word->TSK_SUB7;?></label>
              </div>
              <div id="dIsPriority" class="wojo toggle checkbox">
                <input type="checkbox" name="is_priority" value="1" id="hid_2">
                <label for="hid_2"><?php echo Lang::$word->TSK_SUB8;?></label>
              </div>
            </div>
          </div>
          <div class="full padding">
            <a id="hideTaskForm" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
            <button type="button" data-action="processTask" name="dosubmit" class="wojo small primary button"><?php echo Lang::$word->TSK_ADDN;?></button>
          </div>
          <input type="hidden" name="pid" value="<?php echo $this->row->id;?>">
        </form>
      </div>
    </div>
    <!-- Start Tasks-->
    <div id="taskHolder" class="editable">
      <?php if($this->tasklists):?>
      <?php foreach($this->tasklists as $tlrow):?>
      <div id="tItem_<?php echo $tlrow->id;?>" class="wojo fitted segment">
        <div class="divided header">
          <div class="items">
            <h4 class="basic">
              <span data-set='{"type":"taskList", "id":<?php echo $tlrow->id;?>, "key":"name", "parent_id":<?php echo $tlrow->id;?>}'><?php echo $tlrow->name;?></span>
            </h4>
          </div>
          <div class="items">
            <a class="grey" data-dropdown="#tasklistsDrop_<?php echo $tlrow->id;?>">
            <i class="icon horizontal ellipsis"></i>
            </a>
            <div class="wojo dropdown small pointing top-right" id="tasklistsDrop_<?php echo $tlrow->id;?>">
              <!-- Start editTaskList -->
              <a class="editTaskList item"><?php echo Lang::$word->EDIT;?></a>
              
              <!-- Start copyToProject -->
              <a data-set='{"option":[{"action":"copyTaskList","id":<?php echo $tlrow->id;?>,"pid":<?php echo $this->row->id;?>, "title":"<?php echo Validator::sanitize($tlrow->name, "chars");?>"}], "label":"<?php echo Lang::$word->TSK_SUB;?>", "url":"helper.php", "parent":"#none", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->TSK_SUB;?></a>
              <div class="divider"></div>
              
              <!-- Start trashTaskList -->
              <a data-set='{"option":[{"trash": "trashTaskList","title": "<?php echo Validator::sanitize($tlrow->name, "chars");?>","id": "<?php echo $this->row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#tItem_<?php echo $tlrow->id;?>", "redirect":"<?php echo Url::url("/admin/projects/tasks", $this->row->id);?>"}' class="item wojo demi text data">
              <?php echo Lang::$word->MTOTRASH;?>
              </a>
            </div>
          </div>
        </div>
        <div class="content">
          <ol id="<?php echo $tlrow->id;?>" data-id="<?php echo $tlrow->id;?>" class="wojo divided sortable">
            <?php if($tasks = Utility::findInArray($this->taskdata, "task_list_id", $tlrow->id)):?>
            <?php foreach ($tasks as $k => $trow):?>
            <?php $k++;?>
            <?php $lrows = ($trow->labels) ? Utility::jSonToArray($trow->labels) : null;?>
            <li data-tags="<?php echo ($lrows) ? implode(',', array_column(array_map(function($o){return (array)$o;},$lrows),'name')) . ',' : null;?><?php echo $trow->fullname;?>,<?php echo $tlrow->name;?>" data-type="list" data-id="<?php echo $trow->id;?>" id="item_<?php echo $trow->id;?>">
              <div class="item auto">
                <a class="handle"><i class="icon reorder"></i></a>
              </div>
              <div class="item auto">
                <div class="wojo inline fitted checkbox">
                  <input type="checkbox" class="is_completed" value="<?php echo $trow->id;?>" data-list="<?php echo $tlrow->id;?>" id="is_completed_<?php echo $trow->id;?>">
                  <label for="is_completed_<?php echo $trow->id;?>"><b data-tooltip="<?php echo Lang::$word->PRJ_SUB6;?>"><i class="icon check"></i></b></label>
                </div>
                <span class="wojo small label"><?php echo $trow->fullname;?></span>
              </div>
              <div class="item">
                <a href="<?php echo Url::url("/admin/tasks", $trow->id);?>" id="ePriority_<?php echo $trow->id;?>" class="wojo text icon"><?php echo ($trow->is_priority) ? '<i class="icon warning sign"></i>' : '';?><?php echo $trow->name;?></a>
                <span id="eHidden_<?php echo $trow->id;?>" class="wojo small icon simple button"><i class="icon mask<?php echo ($trow->is_hidden) ? ' negative' : ' positive';?>"></i></span>
                <?php if($trow->due_on):?>
                <span id="eDueDate_<?php echo $trow->id;?>" class="wojo small <?php echo Date::dateLabels($trow->due_on);?> text left padding" data-tooltip="<?php echo Lang::$word->INV_DUED;?>">(<?php echo Date::doDate("short_date", $trow->due_on);?>)</span>
                <?php endif;?>
              </div>
              <div class="item auto">
                <a data-dropdown="#tActions_<?php echo $trow->id;?>" class="grey"><i class="icon vertical ellipsis"></i></a>
                <div class="wojo dropdown small pointing top-right" id="tActions_<?php echo $trow->id;?>">
                  <div class="datepick" data-id="<?php echo $trow->id;?>" data-element="#eDueDate_<?php echo $trow->id;?>">
                    <div class="wojo simple compact fluid right button">
                      <?php echo Lang::$word->TSK_INFO4;?>
                      <i class="icon small chevron down"></i></div>
                  </div>
                  <div class="big divider"></div>
                  <div class="wojo toggle checkbox">
                    <input class="is_hidden" type="checkbox" value="<?php echo $trow->id;?>" <?php Validator::getChecked($trow->is_hidden, 1); ?> id="is_hidden_<?php echo $trow->id;?>">
                    <label for="is_hidden_<?php echo $trow->id;?>"><?php echo Lang::$word->TSK_SUB7;?></label>
                  </div>
                  <div class="wojo toggle checkbox">
                    <input class="is_priority" type="checkbox" value="<?php echo $trow->id;?>" <?php Validator::getChecked($trow->is_priority, 1); ?> id="is_priority_<?php echo $trow->id;?>">
                    <label for="is_priority_<?php echo $trow->id;?>"><?php echo Lang::$word->TSK_SUB8;?></label>
                  </div>
                  <div class="divider"></div>
                  <!-- Start editTask -->
                  <a class="wojo positive small button is_edit" data-id="<?php echo $trow->id;?>"><i class="icon note"></i><?php echo Lang::$word->EDIT;?></a>
                  
                  <!-- Start trashTask -->
                  <a class="wojo negative small button is_trash" data-id="<?php echo $trow->id;?>" data-name="<?php echo $trow->name;?>" data-list="<?php echo $tlrow->id;?>">
                  <i class="icon trash"></i><?php echo Lang::$word->MTOTRASH;?></a>
                </div>
              </div>
            </li>
            <?php endforeach;?>
            <?php endif;?>
          </ol>
        </div>
      </div>
      <?php endforeach;?>
      <?php endif;?>
      
      <!-- Start noTaskList -->
      <?php if($tasks = Utility::findInArray($this->taskdata, "task_list_id", 0)):?>
      <h6><?php echo Lang::$word->TSK_INFO6;?></h6>
      <ol id="0" data-id="0" class="wojo divided sortable">
        <?php foreach ($tasks as $trow):?>
        <?php $lrows = ($trow->labels) ? Utility::jSonToArray($trow->labels) : null;?>
        <li data-tags="<?php echo ($lrows) ? implode(',', array_column(array_map(function($o){return (array)$o;},$lrows),'name')) . ',' : null;?><?php echo $trow->fullname;?>,<?php echo $tlrow->name;?>" data-type="list" data-id="<?php echo $trow->id;?>" id="item_<?php echo $trow->id;?>">
          <div class="item auto">
            <a class="handle"><i class="icon reorder"></i></a>
          </div>
          <div class="item auto">
            <div class="wojo inline fitted checkbox">
              <input type="checkbox" class="is_completed" value="<?php echo $trow->id;?>" data-list="<?php echo $tlrow->id;?>" id="is_completed_<?php echo $trow->id;?>">
              <label for="is_completed_<?php echo $trow->id;?>">&nbsp;</label>
            </div>
          </div>
          <div class="item">
            <span class="wojo small primary label"><?php echo $trow->fullname;?></span>
            <a href="<?php echo Url::url("/admin/tasks", $trow->id);?>" id="ePriority_<?php echo $trow->id;?>" class="wojo text icon"><?php echo ($trow->is_priority) ? '<i class="icon warning sign"></i>' : '';?><?php echo $trow->name;?></a>
            <span id="eHidden_<?php echo $trow->id;?>" class="wojo small icon simple button"><i class="icon mask<?php echo ($trow->is_hidden) ? ' negative' : ' positive';?>"></i></span>
            <?php if($trow->due_on):?>
            <span id="eDueDate_<?php echo $trow->id;?>" class="wojo small <?php echo Date::dateLabels($trow->due_on);?> text padding left" data-tooltip="<?php echo Lang::$word->INV_DUED;?>">(<?php echo Date::doDate("short_date", $trow->due_on);?>)</span>
            <?php endif;?>
          </div>
          <div class="item auto">
            <a data-dropdown="#tActions_<?php echo $trow->id;?>"><i class="icon horizontal ellipsis"></i></a>
            <div class="wojo dropdown small pointing top-right" id="tActions_<?php echo $trow->id;?>">
              <div class="datepick" data-id="<?php echo $trow->id;?>" data-element="#eDueDate_<?php echo $trow->id;?>">
                <div class="wojo simple compact fluid right button">
                  <?php echo Lang::$word->TSK_INFO4;?>
                  <i class="icon small chevron down"></i></div>
              </div>
              <div class="big divider"></div>
              <div class="wojo toggle checkbox">
                <input class="is_hidden" type="checkbox" value="<?php echo $trow->id;?>" <?php Validator::getChecked($trow->is_hidden, 1); ?> id="is_hidden_<?php echo $trow->id;?>">
                <label for="is_hidden_<?php echo $trow->id;?>"><?php echo Lang::$word->TSK_SUB7;?></label>
              </div>
              <div class="wojo toggle checkbox">
                <input class="is_priority" type="checkbox" value="<?php echo $trow->id;?>" <?php Validator::getChecked($trow->is_priority, 1); ?> id="is_priority<?php echo $trow->id;?>">
                <label for="is_priority<?php echo $trow->id;?>"><?php echo Lang::$word->TSK_SUB8;?></label>
              </div>
              <div class="divider"></div>
              <!-- Start editTask -->
              <a class="wojo positive small button is_edit" data-id="<?php echo $trow->id;?>"><i class="icon note"></i><?php echo Lang::$word->EDIT;?></a>
              
              <!-- Start trashTask -->
              <a class="wojo negative small button is_trash" data-id="<?php echo $trow->id;?>" data-name="<?php echo $trow->name;?>" data-list="<?php echo $tlrow->id;?>">
              <i class="icon trash"></i><?php echo Lang::$word->MTOTRASH;?></a>
            </div>
          </div>
        </li>
        <?php endforeach;?>
      </ol>
      <?php endif;?>
    </div>
  </div>
  <!-- Right Panel-->
  <div class="columns screen-20 tablet-30 mobile-100 phone-100">
    <div class="vertical margin">
      <div class="row align middle">
        <div class="columns">
          <h5 class="basic"><?php echo Lang::$word->TSK_SUB5;?></h5>
        </div>
        <div class="columns auto">
          <a data-dropdown="#aTaskList" class="wojo small icon positive button"><i class="icon plus alt link"></i></a>
          <div class="wojo dropdown small pointing top-right" id="aTaskList">
            <div class="wojo mini input">
              <input type="text" placeholder="<?php echo Lang::$word->TSK_LISTNAME;?>" name="listname">
              <button id="addTaskList" class="wojo mini primary button" type="button">
              <?php echo Lang::$word->ADD;?>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="sortTaskList" class="filterable">
      <ol class="wojo sortable selection" id="taskListData">
        <?php if($this->tasklists):?>
        <?php foreach ($this->tasklists as $tlrow):?>
        <li id="listItem_<?php echo $tlrow->id;?>" class="drop" data-id="<?php echo $tlrow->id;?>">
          <div class="item auto">
            <a class="handle"><i class="icon reorder"></i></a>
          </div>
          <div class="item" data-name="<?php echo $tlrow->name;?>" data-id="<?php echo $tlrow->id;?>">
            <span><?php echo $tlrow->name;?></span> (<span><?php echo $tlrow->total;?></span>)</div>
        </li>
        <?php endforeach;?>
        <?php endif;?>
      </ol>
    </div>
    <div class="wojo divider"></div>
    <h5><?php echo Lang::$word->TSK_SUB4;?></h5>
    <div class="filterable">
      <ol class="wojo sortable selection">
        <?php if($this->taskdata):?>
        <?php foreach ($this->assignees as $name => $arow):?>
        <li>
          <div class="item" data-name="<?php echo $name;?>"><?php echo $name;?> (<?php echo count($arow);?>)</div>
        </li>
        <?php endforeach;?>
        <?php unset($name);?>
        <?php endif;?>
      </ol>
    </div>
    <div class="wojo divider"></div>
    <h5><?php echo Lang::$word->PRJ_LABELS;?></h5>
    <div class="filterable">
      <ol class="wojo sortable selection">
        <?php if($this->plabels):?>
        <?php foreach ($this->plabels as $name => $lrow):?>
        <li>
          <div class="item wojo small semi text" data-name="<?php echo $name;?>"><?php echo $name;?> (<?php echo count($lrow);?>)</div>
        </li>
        <?php endforeach;?>
        <?php unset($name);?>
        <?php endif;?>
      </ol>
    </div>
    <div class="wojo divider"></div>
    <h5><?php echo Lang::$word->TSK_SUB1;?></h5>
    <div id="taskProgress">
      <p class="wojo grey text"><?php echo str_replace(array("[a]", "[b]", "[c]"), array($this->stats->closed, $this->stats->total, "<br>" . $this->stats->open), Lang::$word->TSK_TSKPRGS);?></p>
      <div class="wojo mini positive progress">
        <div class="bar" style="width:<?php echo $this->stats->total ? Utility::doPercent($this->stats->closed, $this->stats->total) : 0;?>%"></div>
      </div>
      <?php if($this->stats->closed):?>
      <a href="<?php echo Url::url("/admin/tasks/completed", $this->row->id);?>" class="wojo demi text"><?php echo Lang::$word->TSK_SUB2;?></a>
      <?php endif;?>
    </div>
  </div>
</div>
<script src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script src="<?php echo ADMINVIEW;?>/js/tasks.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Tasks({
		url: "<?php echo ADMINVIEW;?>",
		surl: "<?php echo SITEURL;?>",
        lang: {
            removeText: "<?php echo Lang::$word->REMOVE;?>",
			jobHours: "<?php echo Lang::$word->TSK_HOURSOF;?>",
			updateTask: "<?php echo Lang::$word->TSK_UPDATE;?>",
        }
    });
});
// ]]>
</script>