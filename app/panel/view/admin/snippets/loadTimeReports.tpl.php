<?php
  /**
   * Load Time Reports
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadTimeReports.tpl.php,, v1.00 2019-03-02 10:12:05 gewa Exp $
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
	  
	  case "job":
	  $group = "jobname";
	  break;
	  
  }
  
  $data = Utility::groupToLoop($this->result, $group);
?>
<?php if($this->result):?>
<div id="dWrap">
  <table class="wojo small basic table">
    <thead>
      <tr>
        <th class="four wide"><?php echo ucwords($this->type);?></th>
        <th class="eight wide">&nbsp;</th>
        <th class="three wide"><?php echo Lang::$word->REP_SUB26;?></th>
      </tr>
    </thead>
    <?php $i = 0;?>
    <?php foreach($data as $name => $rows):?>
    <?php $i++;?>
    <?php $hours = Utility::decimalToHumanHour(Stats::doArraySum($data[$name], "hours"));?>
    <?php $k = ($i === 1) ? 100 : Utility::doPercent(intval($hours), 100);?>
    <tr>
      <td><a data-id="<?php echo $i;?>" class="showDetails"><?php echo $name;?></a></td>
      <td><div class="wojo small positive fitted progress">
          <div class="bar" style="width:<?php echo $k;?>%;"></div>
        </div></td>
      <td><?php echo Lang::$word->TOTAL . ': ' . $hours;?></td>
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
        <th class="four wide"><?php echo Lang::$word->CMP_JOBT;?></th>
        <th class="two wide"><?php echo Lang::$word->_HOURS;?></th>
        <th class="two wide"><?php echo Lang::$word->CREATED;?></th>
      </tr>
    </thead>
    <?php foreach($rows as $row):?>
    <tr>
      <td><?php echo $row->name;?></td>
      <td><?php echo $row->assagnee;?></td>
      <td><?php echo $row->jobname;?></td>
      <td><?php echo Utility::decimalToHumanHour($row->hours);?></td>
      <td><?php echo Date::doDate("short_date", $row->date);?></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php endforeach;?>
<?php endif;?>