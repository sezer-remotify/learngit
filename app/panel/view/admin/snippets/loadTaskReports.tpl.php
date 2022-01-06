<?php
  /**
   * Load Task Report
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadTaskReports.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/search_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->REP_INFO11;?></p>
</div>
<?php else:?>
<table class="wojo basic table">
  <thead>
    <tr>
      <th><?php echo Lang::$word->REP_SUB22;?></th>
      <th><?php echo Lang::$word->PRJ_PROJECT;?></th>
      <th><?php echo Lang::$word->TSK_SUB4_1;?></th>
      <th><?php echo Lang::$word->INV_DUEON;?></th>
      <th><?php echo Lang::$word->CREATED;?></th>
      <th><?php echo Lang::$word->COMPLETED;?></th>
      <th><?php echo Lang::$word->AGE;?></th>
    </tr>
  </thead>
  <?php foreach($this->data as $row):?>
  <tr>
    <td><a href="<?php echo Url::url("/admin/tasks", $row->id);?>"><?php echo $row->name;?></a>
      <?php if($row->labels):?>
      <p>
        <?php $labels = Utility::jSonToArray($row->labels);?>
        <?php foreach($labels as $lrow):?>
        <small style="color:<?php echo $lrow->color;?>">
        &bull;
        <?php echo $lrow->name;?></small>
        <?php endforeach;?>
      </p>
      <?php endif;?></td>
    <td><a href="<?php echo Url::url("/admin/projects/view", $row->project_id);?>"><?php echo $row->pname;?></a></td>
    <td><?php echo $row->assagnee;?></td>
    <td><?php echo $row->due_on ? Date::doDate("short_date", $row->due_on) : null;?></td>
    <td><?php echo $row->created_by_name;?>
      <p><small><?php echo Date::doDate("short_date", $row->created);?></small></p></td>
    <td><?php echo $row->completed ? $row->completed_by_name . '<p><small>' . Date::doDate("short_date", $row->completed) . '</small></p>' : null;?></td>
    <td><?php echo $row->age;?></td>
  </tr>
  <?php endforeach;?>
</table>
<?php endif;?>