<?php
  /**
   * Load Expense Record
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: loadExpenseRecordModal.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($data['data']):?>
<?php foreach($data['data'] as $day => $rows):?>
<h5><?php echo Date::doDate("short_date", $day);?></h5>
<div class="wojo relaxed small fluid divided list">
  <?php foreach($rows as $val):?>
  <?php $category = Utility::searchForValueName('id', $val->category_id, 'name', Utility::jSonToArray(App::Core()->expcats));?>
  <div class="item" id="mItem_<?php echo $val->id;?>">
    <div class="content auto margin right">
      <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $val->avatar ? $val->avatar : "blank.svg" ;?>" alt="" class="wojo tiny circular image">
    </div>
    <div class="content">
      <div class="header"><?php echo $val->title;?></div>
      <div class="description"><?php echo Utility::formatMoney($val->amount, $data['row']['currency']);?>
        <?php echo $category ? $category : "...";?> | <span class="wojo small bold text"><?php echo $val->is_billable ? Lang::$word->INV_ISBILL : Lang::$word->INV_ISNOBILL;?></span></div>
    </div>
    <div class="content auto">
      <a class="grey" data-dropdown="#rList_<?php echo $val->id;?>">
      <i class="icon horizontal ellipsis"></i>
      </a>
      <div class="wojo dropdown small pointing top-right" id="rList_<?php echo $val->id;?>">
        <a data-id="<?php echo $val->id;?>" class="is_edit item"><?php echo Lang::$word->EDIT;?></a>
        <div class="divider"></div>
        <a data-set='{"option":[{"trash": "trashExpenseRecordTask","title": "<?php echo Validator::sanitize($val->title, "chars");?>","id": "<?php echo $val->id;?>","project_id": <?php echo $val->project_id;?>,"task_id":<?php echo $data['row']['task_id'];?>, "taskname":"<?php echo $data['row']['taskname'];?>","is_billable":<?php echo $val->is_billable;?>}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#mItem_<?php echo $val->id;?>", "children":[{"#dAmount":{"totalHours":"html"}}]}' class="item wojo demi text data">
        <?php echo Lang::$word->MTOTRASH;?>
        </a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endforeach;?>
<?php endif;?>