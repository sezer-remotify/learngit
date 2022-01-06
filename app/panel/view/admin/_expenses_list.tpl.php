<?php
  /**
   * Expenses List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _expenses_list.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if(!$this->data):?>
<div class="center aligned full padding"><img src="<?php echo ADMINVIEW;?>/images/time_empty.svg" alt="" class="wojo center big image">
  <p class="wojo semi grey text"><?php echo Lang::$word->TMR_NOTIME;?></p>
</div>
<?php else:?>
<?php foreach ($this->data as $date => $rows):?>
<div class="wojo fitted segment">
  <div class="header">
    <h5 class="basic"><?php echo Date::doDate("short_date", $date);?></h5>
  </div>
  <table class="wojo responsive basic table">
    <?php foreach ($rows as $trow):?>
    <tr id="item_<?php echo $trow->id;?>">
      <td class="auto"><?php echo Utility::formatNumber($trow->amount);?>
        <span class="wojo bold text"><?php echo $this->row->currency ? $this->row->currency : $this->core->currency;?></span>
        <?php echo $trow->category;?></td>
      <td class="four wide"><a href="<?php echo Url::url("/admin/members/details", $trow->user_id);?>" class="grey">
        <?php if($trow->avatar):?>
        <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $trow->avatar;?>" alt="" class="wojo category image">
        <?php else:?>
        <span class="wojo initials circular label"><?php echo Utility::getInitials($trow->uname);?></span>
        <?php endif;?>
        <?php echo $trow->uname;?></a></td>
      <td class="nine wide"><?php if($trow->task_id):?>
        <a href="<?php echo Url::url("/admin/tasks", $trow->task_id);?>">
        <?php echo $trow->title;?>
        </a>
        <?php else:?>
        <a href="<?php echo Url::url("/admin/projects/tasks", $trow->project_id);?>">
        <?php echo $trow->title;?>
        </a>
        <?php endif;?>
        <p class="wojo small text"><?php echo $trow->description;?></p></td>
      <td><span class="wojo small demi <?php echo $trow->is_billable ? "positive" : "negative";?> text"><?php echo $trow->is_billable ? Lang::$word->INV_ISBILL : Lang::$word->INV_ISNOBILL;?></span></td>
      <td class="auto"><a class="wojo simple icon button" data-dropdown="#mExpList_<?php echo $trow->id;?>">
        <i class="icon vertical ellipsis"></i>
        </a>
        <div class="wojo dropdown small pointing top-right" id="mExpList_<?php echo $trow->id;?>">
          <a class="item is_edit" data-id="<?php echo $trow->id;?>"><?php echo Lang::$word->EDIT;?></a>
          <div class="divider"></div>
          <!-- Start trashExpenseRecord -->
          <a data-set='{"option":[{"trash": "trashExpenseRecord","title": "<?php echo Validator::sanitize($trow->title, "chars");?>","id":<?php echo $trow->id;?>,"is_billable":<?php echo $trow->is_billable;?>}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $trow->id;?>", "redirect":"<?php echo Url::url("/admin/projects/expenses", $this->row->id);?>"}' class="item wojo demi text data">
          <?php echo Lang::$word->MTOTRASH;?>
          </a>
        </div></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php endforeach;?>
<?php endif;?>