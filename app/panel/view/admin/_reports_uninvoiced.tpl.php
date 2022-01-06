<?php
  /**
   * Reports Uninvoiced
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _reports_uninvoiced.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo fitted segment">
  <div class="divided header align middle spaced">
    <div class="items">
      <h4 class="basic"><?php echo Lang::$word->REP_SUB2_1;?></h4>
    </div>
    <div class="items" data-tooltip="<?php echo Lang::$word->REP_EXPORT;?>"><a href="<?php echo ADMINVIEW;?>/helper.php?action=getUninvoicedCvs" class="wojo small primary inverted icon button"><i class="icon wysiwyg table"></i></a>
    </div>
  </div>
  <div class="content">
    <?php if(!$this->data):?>
    <div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/time_empty.svg" alt="" class="wojo center large image">
      <p class="wojo semi grey text"><?php echo Lang::$word->REP_INFO2_2;?></p>
    </div>
    <?php else:?>
    <table class="wojo basic table">
      <thead>
        <tr>
          <th><?php echo Lang::$word->PRJ_PROJECT;?></th>
          <th><?php echo Lang::$word->CLIENT;?></th>
          <th><?php echo Lang::$word->_HOURS;?> (hh:mm)</th>
          <th><?php echo Lang::$word->INV_SUB5_2;?></th>
          <th><?php echo Lang::$word->REP_SUB2_2;?></th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($this->data as $row):?>
        <tr>
          <td><?php echo $row->name;?></td>
          <td><?php echo $row->company_name;?></td>
          <td><?php echo $row->total_hours ? Utility::decimalToHour($row->total_hours) : '-';?></td>
          <td><?php echo $row->total_amount ? Utility::formatMoney($row->total_amount, $row->currency) : '-';?></td>
          <td><?php echo Utility::formatMoney($row->total_tamount + $row->total_amount, $row->currency);?></td>
          <td class="right aligned"><a href="<?php echo Url::url("/admin/invoices/project", $row->id);?>" class="wojo small button"><?php echo Lang::$word->INV_CREATE;?></a></td>
        </tr>
        <?php endforeach;?>
        <?php unset($row);?>
      </tbody>
    </table>
    <?php endif;?>
  </div>
</div>