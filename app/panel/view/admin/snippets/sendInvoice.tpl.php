<?php
  /**
   * Send Invoice
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: sendInvoice.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo Lang::$word->INV_SENDIV;?></h5>
</div>
<div class="body">
  <div class="wojo small form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="field">
          <label>
            <?php echo Lang::$word->INV_SELREC;?>
            <i class="icon asterisk"></i></label>
          <select class="selectbox" name="recepients" data-wselect='{"search":true, "okCancelInMulti": true, "placeholder":"<?php echo Lang::$word->INV_SELREC;?>"}' multiple>
            <?php if($this->data):?>
            <?php foreach ($this->data as $row):?>
            <option value="<?php echo $row->id;?>"><?php echo $row->name;?> [<?php echo $row->email;?>]</option>
            <?php endforeach;?>
            <?php endif;?>
          </select>
        </div>
        <div class="field">
          <label>
            <?php echo Lang::$word->MESSAGE;?>
          </label>
          <textarea name="message"></textarea>
        </div>
        <div class="field">
          <label>
            <?php echo Lang::$word->ATTACHMENT;?>
          </label>
          <div class="wojo text icon">
            <i class="icon files"></i> invoice-<?php echo Content::invoiceID($this->row->id, $this->row->custom_id);?>-from_<?php echo App::Core()->company;?>.pdf </div>
        </div>
      </div>
    </form>
  </div>
</div>