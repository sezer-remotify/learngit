<?php
  /**
   * Invoice Access
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: invoiceAccess.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo Lang::$word->INV_ACCESS;?>: <span><?php echo Content::invoiceID($this->row->id, $this->row->custom_id);?></span></h5>
</div>
<div class="body">
  <?php if(!$this->data):?>
  <p class="wojo icon text"><i class="info sign icon"></i><?php echo Lang::$word->INV_NOACCESS;?></p>
  <?php else:?>
  <?php foreach($this->data as $date => $rows):?>
  <div class="wojo small relaxed fluid divided list">
    <div class="item">
      <h6 class="wojo basic grey text"><?php echo Date::doDate("short_date", $date);?></h6>
    </div>
    <?php foreach($rows as $row):?>
    <div class="item">
      <div class="content auto">
        <span class="wojo demi text"><?php echo Lang::$word->INV_SUB14;?>:</span></div>
      <div class="content padding left">
        <p><?php echo $row->user;?></p>
        <?php echo $row->ip;?>
      </div>
      <div class="content auto">
        <?php echo Date::doTime($row->hour);?>
      </div>
    </div>
    <?php endforeach;?>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>