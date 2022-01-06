<?php
  /**
   * Project Tasks
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: project_tasks.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->PRJ_SUB12;?></h3>
<?php include_once(THEMEBASE . '/snippets/project_header.tpl.php');?>
<?php if(!$taskdata = Utility::findInArray($this->taskdata, "is_hidden", 0)):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/tasks_empty.svg" alt="" class="wojo center large image">
  <p class="wojo semi grey text"><?php echo Lang::$word->TSK_NOTSK1;?></p>
</div>
<?php else:?>
<table class="wojo table segment">
  <?php foreach ($taskdata as $k => $trow):?>
  <tr>
    <td><a href="<?php echo Url::url("/dashboard/task/" . $this->row->id, $trow->id);?>" id="ePriority_<?php echo $trow->id;?>" class="wojo text icon"><?php echo ($trow->is_priority) ? '<i class="icon black warning sign"></i>' : '';?><?php echo $trow->name;?></a></td>
    <td><?php echo $trow->fullname;?></td>
    <?php if($trow->due_on):?>
    <td><span class="wojo small <?php echo Date::dateLabels($trow->due_on);?> text left-padding" data-tooltip="<?php echo Lang::$word->INV_DUED;?>">(<?php echo Date::doDate("short_date", $trow->due_on);?>)</span></td>
    <?php endif;?>
  </tr>
  <?php endforeach;?>
</table>
<div class="wojo divider"></div>
<h4 class="wojo black text"><?php echo Lang::$word->TSK_SUB1;?></h4>
<div id="taskProgress">
  <p><?php echo str_replace(array("[a]", "[b]", "[c]"), array($this->stats->closed, $this->stats->total, "<br>" . $this->stats->open), Lang::$word->TSK_TSKPRGS);?></p>
  <div class="wojo small positive progress">
    <div class="bar" style="width:<?php echo $this->stats->total ? Utility::doPercent($this->stats->closed, $this->stats->total) : 0;?>%"></div>
  </div>
  <?php if($this->stats->closed):?>
    <a href="<?php echo Url::url("/dashboard/tasks/completed", $this->row->id);?>" class="wojo semi text"><?php echo Lang::$word->TSK_SUB2;?></a>
  <?php endif;?>
</div>
<?php endif;?>