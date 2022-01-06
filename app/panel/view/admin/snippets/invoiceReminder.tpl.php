<?php
  /**
   * Invoice Reminder
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: invoiceReminder.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="header">
  <h5><?php echo $this->row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <p><?php echo $this->row->reminder ? Lang::$word->INV_DISREM_D : Lang::$word->INV_ENREM_T;?></p>
      <input type="hidden" name="reminder" value="<?php echo $this->row->reminder ? 0 : 1;?>">
    </form>
  </div>
</div>