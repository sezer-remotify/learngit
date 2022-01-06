<?php
  /**
   * Load TimeRecords Weekly
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadTimeWeekly.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<table class="wojo small simple segment table responsive">
  <thead>
    <tr>
      <th><?php echo Lang::$word->TMR_SUB4;?></th>
      <?php foreach ($this->pheader as $value):?>
      <th class="auto center aligned"><?php echo Date::dodate("EE", $value->format('y-m-d')) . ' - ' . $value->format('d');?></th>
      <?php endforeach;?>
      <th class="auto"><?php echo Lang::$word->TMR_SUB5;?></th>
    </tr>
  </thead>
  <tbody>
    <?php if($this->results):?>
    <?php foreach ($this->results as $i => $trow):?>
    <tr>
      <td><?php if($trow->task_id):?>
        <a href="<?php echo Url::url("/dashboard/tasks/" . $trow->project_id, $trow->task_id);?>">
        <?php echo $trow->title;?>
        </a>
        <?php else:?>
        <a href="<?php echo Url::url("/dashboard/projects/tasks", $trow->project_id);?>">
        <?php echo $trow->title;?>
        </a>
        <?php endif;?></td>
      <?php $thours = 0;?>
      <?php foreach ($this->pheader as $value):?>
      <?php if($value->format('Y-m-d') == $trow->trdate):?>
      <?php $thours += $trow->hours;?>
      <?php $daily[$trow->trdate][] = $trow->hours;?>
      <?php endif;?>
      <td class="center aligned"><?php echo ($value->format('Y-m-d') == $trow->trdate) ? Utility::decimalToHour($trow->hours) : "";?></td>
      <?php endforeach;?>
      <td class="right aligned"><?php echo Utility::decimalToHour($thours);?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
  <tfoot>
    <tr>
      <th><?php echo Lang::$word->TMR_SUB6;?></th>
      <?php foreach ($this->pheader as $value):?>
      <th class="center aligned"><?php echo isset($daily[$value->format('Y-m-d')]) ? Utility::decimalToHour(array_sum($daily[$value->format('Y-m-d')])) : '';?></th>
      <?php endforeach;?>
      <th class="right aligned"><?php echo Utility::decimalToHour(Stats::doArraySum($this->results, "hours"));?></th>
    </tr>
  </tfoot>
  <?php endif;?>
</table>
<?php if(!$this->results):?>
<div class="wojo grey bg segment center aligned">
  <div class="wojo full padding small semi text">
    <?php echo Lang::$word->EXP_INFO;?>
  </div>
</div>
<?php endif;?>