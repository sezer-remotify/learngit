<?php
  /**
   * Load Expense Reports
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadExpenseReports.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  switch($this->type) {
	  case "project":
	  $group = "name";
	  break;
	  
	  case "client":
	  $group = "company_name";
	  break;
	  
	  case "user":
	  $group = "assagnee";
	  break;
	  
	  case "category":
	  $group = "category";
	  break;
	  
  }
  
  $data = Utility::groupToLoop($this->result, $group);
?>
<?php if($this->result):?>
<div id="dWrap">
  <table class="wojo small basic table">
    <thead>
      <tr>
        <th class="twelve wide"><?php echo ucwords($this->type);?></th>
        <th class="three wide"><?php echo Lang::$word->REP_SUB29;?></th>
      </tr>
    </thead>
    <?php $i = 0;?>
    <?php foreach($data as $name => $rows):?>
    <?php $i++;?>
    <?php $amount = Stats::doArraySum($data[$name], "amount");?>
    <tr>
      <td><a data-id="<?php echo $i;?>" class="showDetails"><?php echo $name;?></a></td>
      <td><?php echo $amount;?></td>
    </tr>
    <?php endforeach;?>
    <?php unset($i);?>
  </table>
</div>
<?php $i = 0;?>
<?php foreach($data as $name => $rows):?>
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