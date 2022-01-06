<?php
  /**
   * Load Workload
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadWorkload.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->data):?>
<?php foreach($this->data as $row):?>
<div class="item align middle" data-parent="<?php echo $row->id;?>" data-filter="<?php echo $row->assigned_id;?>,<?php echo $row->project_id;?>">
  <div class="content">
    <?php echo $row->name;?>
  </div>
  <div class="content auto">
    <a class="grey" data-dropdown="#dAssigneeList_<?php echo $row->id;?>">
      <i class="icon horizontal ellipsis"></i>
    </a>
    <div class="wojo dropdown small pointing top-right dAssigneeList" id="dAssigneeList_<?php echo $row->id;?>">
      <?php foreach($this->staff as $urow):?>
      <?php if($urow->id != $row->assigned_id):?>
      <a class="item" data-value="<?php echo $urow->id;?>" data-item="<?php echo $row->id;?>">
        <?php echo $urow->name;?>
      </a>
      <?php endif;?>
      <?php endforeach;?>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>