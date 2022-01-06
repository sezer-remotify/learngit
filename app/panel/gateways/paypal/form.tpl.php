<?php
  /**
   * Paypal Form
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: form.tpl.php, v1.00 2016-03-20 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php $url = ($this->gateway->live) ? 'www.paypal.com' : 'www.sandbox.paypal.com';?>
<form action="https://<?php echo $url;?>/cgi-bin/webscr" method="post" id="pp_form" name="pp_form" class="center aligned">
<input type="image" src="<?php echo SITEURL;?>/gateways/paypal/logo_large.png" style="width:150px" name="submit" class="wojo simple button" title="Pay With Paypal" alt="" onclick="document.pp_form.submit();">
  <?php if($this->row->recurring == 1):?>
  <input type="hidden" name="cmd" value="_xclick-subscriptions">
  <input type="hidden" name="a3" value="<?php echo Utility::numberParse($this->row->balance_due - $this->row->paid_amount);?>">
  <input type="hidden" name="p3" value="<?php echo $this->row->days;?>">
  <input type="hidden" name="t3" value="<?php echo $this->row->period;?>">
  <input type="hidden" name="src" value="1">
  <input type="hidden" name="sr1" value="1">
  <?php else:?>
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="amount" value="<?php echo Utility::numberParse($this->row->balance_due - $this->row->paid_amount);?>">
  <?php endif;?>
  <input type="hidden" name="business" value="<?php echo $this->gateway->extra;?>">
  <input type="hidden" name="item_name" value="<?php echo Content::invoiceID($this->row->id, $this->row->custom_id);?>">
  <input type="hidden" name="item_number" value="<?php echo $this->row->id . '_' . App::Auth()->uid;?>">
  <input type="hidden" name="return" value="<?php echo Url::url("/dashboard/invoices");?>">
  <input type="hidden" name="rm" value="2">
  <input type="hidden" name="notify_url" value="<?php echo SITEURL . '/gateways/'. $this->gateway->dir;?>/ipn.php">
  <input type="hidden" name="cancel_return" value="<?php echo Url::url("/dashboard/invoices");?>">
  <input type="hidden" name="no_note" value="1">
  <input type="hidden" name="currency_code" value="<?php echo ($this->row->currency) ? $this->row->currency : App::Core()->currency;?>">
</form>