<?php
  /**
   * Invoice Mark Sent
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: invoiceMarkSent.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="header">
  <h5><?php echo Lang::$word->INV_TITLE4;?></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo icon text"><i class="icon info sign"></i><?php echo Lang::$word->INV_SUB11;?></div>
      <input type="hidden" name="reminder" value="<?php echo $this->row->reminder ? 0 : 1;?>">
    </form>
  </div>
</div>