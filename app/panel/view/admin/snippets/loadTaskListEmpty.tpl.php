<?php
  /**
   * Load Empty Task List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadTaskListEmpty.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$data) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div id="tItem_<?php echo $data->id;?>" class="wojo fitted segment">
  <div class="divided header">
    <div class="items">
      <h4 class="basic">
        <span data-set='{"type":"taskList", "id":<?php echo $data->id;?>, "key":"name", "parent_id":<?php echo $data->id;?>}'><?php echo $data->name;?></span>
      </h4>
    </div>
    <div class="items">
      <a class="grey" data-dropdown="#tasklistsDrop_<?php echo $data->id;?>">
      <i class="icon horizontal ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-right" id="tasklistsDrop_<?php echo $data->id;?>">
        <!-- Start editTaskList -->
        <a class="editTaskList item"><?php echo Lang::$word->EDIT;?></a>
        <!-- Start copyToProject -->
        <a data-set='{"option":[{"action":"copyTaskList","id":<?php echo $data->id;?>,"pid":<?php echo $data->project_id;?>, "title":"<?php echo Validator::sanitize($data->name, "chars");?>"}], "label":"<?php echo Lang::$word->TSK_SUB;?>", "url":"helper.php", "parent":"#none", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->TSK_SUB;?></a>
        <div class="divider"></div>
        <!-- Start trashTaskList -->
        <a data-set='{"option":[{"trash": "trashTaskList","title": "<?php echo Validator::sanitize($data->name, "chars");?>","id": "<?php echo $data->project_id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#tItem_<?php echo $data->id;?>", "redirect":"<?php echo Url::url("/admin/projects/tasks", $data->project_id);?>"}' class="item wojo demi text data">
        <?php echo Lang::$word->MTOTRASH;?>
        </a>
      </div>
    </div>
  </div>
  <div class="content">
    <!-- Start taskList -->
    <ol id="<?php echo $data->id;?>" data-id="<?php echo $data->id;?>" class="wojo divided sortable">
    </ol>
  </div>
</div>