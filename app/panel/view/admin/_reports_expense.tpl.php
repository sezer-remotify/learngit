<?php
  /**
   * Reports Expense Tracking
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _reports_expense.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo card">
  <div class="wojo small text secondary header">
    <div class="items">
      <h4><?php echo Lang::$word->REP_SUB8;?></h4>
    </div>
    <div class="items"><?php echo Lang::$word->INV_ISBILL . ': ' . Stats::doArraySum($this->result, "amount");?></div>
  </div>
  <div class="content">
    <div class="row">
      <div class="columns">
        <div class="wojo small light rounded buttons" id="dSort">
          <div class="wojo simple disabled button"><?php echo Lang::$word->REP_SUB25;?>: </div>
          <a data-type="project" class="wojo button active"><?php echo Lang::$word->PRJ_PROJECT;?></a>
          <a data-type="client" class="wojo button"><?php echo Lang::$word->CLIENT;?></a>
          <a data-type="user" class="wojo button"><?php echo Lang::$word->TSK_SUB4_1;?></a>
          <a data-type="category" class="wojo button"><?php echo Lang::$word->REP_SUB28;?></a>
        </div>
      </div>
      <div class="columns auto"><a href="<?php echo ADMINVIEW;?>/helper.php?getExpenseRecordsCvs=1" class="wojo small icon button"><i class="icon wysiwyg table"></i></a>
      </div>
    </div>
  </div>
</div>
<div class="wojo segment" id="results">
  <?php if(!$this->result):?>
  <div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/search_empty.svg" alt="" class="wojo center large image">
    <p class="wojo semi grey text"><?php echo Lang::$word->REP_INFO11;?></p>
  </div>
  <?php else:?>
  <div id="dWrap">
    <table class="wojo small basic table">
      <thead>
        <tr>
          <th class="twelve wide"><?php echo Lang::$word->PRJ_PROJECT;?></th>
          <th class="three wide"><?php echo Lang::$word->REP_SUB29;?></th>
        </tr>
      </thead>
      <?php $i = 0;?>
      <?php foreach($this->data as $name => $rows):?>
      <?php $i++;?>
      <?php $amount = Stats::doArraySum($this->data[$name], "amount");?>
      <tr>
        <td><a data-id="<?php echo $i;?>" class="showDetails"><?php echo $name;?></a></td>
        <td><?php echo $amount;?></td>
      </tr>
      <?php endforeach;?>
      <?php unset($i);?>
    </table>
  </div>
  <?php $i = 0;?>
  <?php foreach($this->data as $name => $rows):?>
  <?php $i++;?>
  <div id="details_<?php echo $i;?>" class="hide-all">
  <a data-id="<?php echo $i;?>" class="wojo small icon tex hideDetailst"><i class="icon close"></i>
      <?php echo Lang::$word->REP_SUB27;?></a>
    <table class="wojo small basic table">
      <thead>
        <tr>
          <th class="four wide"><?php echo Lang::$word->PRJ_PROJECT;?></th>
          <th class="four wide"><?php echo Lang::$word->TSK_SUB4_1;?></th>
          <th class="four wide"><?php echo Lang::$word->REP_SUB28;?></th>
          <th class="two wide"><?php echo Lang::$word->INV_SUB5_2;?></th>
          <th class="two wide"><?php echo Lang::$word->CREATED;?></th>
        </tr>
      </thead>
      <?php foreach($rows as $row):?>
      <tr>
        <td><?php echo $row->name;?></td>
        <td><?php echo $row->assagnee;?></td>
        <td><?php echo $row->category;?></td>
        <td><?php echo Utility::formatMoney($row->amount, $row->currency);?></td>
        <td><?php echo Date::doDate("short_date", $row->date);?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <?php endforeach;?>
  <?php endif;?>
</div>
<script src="<?php echo ADMINVIEW;?>/js/reportsExpense.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.reportsExpense({
		url: "<?php echo ADMINVIEW;?>"
    });
});
// ]]>
</script>