<?php
  /**
   * Load ExpenseRecords Weekly
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadExpensesWeekly.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
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
      <?php $tamount = 0;?>
      <?php foreach ($this->pheader as $value):?>
      <?php if($value->format('Y-m-d') == $trow->trdate):?>
      <?php $tamount += $trow->amount;?>
      <?php $daily[$trow->trdate][] = $trow->amount;?>
      <?php endif;?>
      <td class="center aligned"><?php echo ($value->format('Y-m-d') == $trow->trdate) ? Utility::formatNumber($trow->amount) : "";?></td>
      <?php endforeach;?>
      <td class="right aligned"><?php echo Utility::formatNumber($tamount);?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
  <tfoot>
    <tr>
      <th><?php echo Lang::$word->TMR_SUB6;?></th>
      <?php foreach ($this->pheader as $value):?>
      <th class="center aligned">
	  <?php echo isset($daily[$value->format('Y-m-d')]) ? Utility::formatMoney(array_sum($daily[$value->format('Y-m-d')]), $this->currency) : '';?></th>
      <?php endforeach;?>
      <th class="right aligned"><?php echo Utility::formatMoney(Stats::doArraySum($this->results, "amount"), $this->currency);?></th>
    </tr>
  </tfoot>
  <?php endif;?>
</table>
<?php if(!$this->results):?>
<div class="wojo wojo grey bg dimmed segment center aligned">
  <div class="full padding wojo small bold text">
    <?php echo Lang::$word->TMR_INFO3;?>
  </div>
</div>
<?php endif;?>