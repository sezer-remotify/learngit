<?php
  /**
   * Load Budget Report
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadBudgetReport.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/search_empty.svg" alt="">
  <p class="wojo semi grey text"><?php echo Lang::$word->REP_INFO11;?></p>
</div>
<?php else:?>
<table class="wojo small basic table">
  <thead>
    <tr>
      <th class="seven wide"><?php echo Lang::$word->CMP_JOBT;?></th>
      <th class="three wide right aligned"><?php echo Lang::$word->REP_SUB31;?></th>
      <th class="three wide right aligned"><?php echo Lang::$word->REP_SUB26;?></th>
      <th class="three wide right aligned"><?php echo Lang::$word->REP_SUB32;?></th>
    </tr>
  </thead>
  <?php foreach($this->data as $row):?>
  <tr>
    <td><?php echo $row->name;?></td>
    <td class="right aligned"><?php echo $row->hrate;?></td>
    <td class="right aligned"><?php echo ($row->hours > 0) ? Utility::decimalToHour($row->hours) : $row->hours;?></td>
    <td class="right aligned"><?php echo Utility::formatNumber($row->amount);?></td>
  </tr>
  <?php endforeach;?>
</table>
<?php endif;?>