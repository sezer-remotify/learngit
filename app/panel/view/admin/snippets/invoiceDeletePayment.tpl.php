<?php
  /**
   * Delete Invoice Payment
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: invoiceDeletePayment.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <?php echo Lang::$word->INV_TITLE5;?></div>
<div class="body">
  <div class="wojo small form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo info icon message"><i class="icon info sign"></i>
        <?php echo Lang::$word->INV_SUB12;?></div>
    </form>
  </div>
</div>