<?php
  /**
   * Add Invoice Payment
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: invoiceAddPayment.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->row) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h5><?php echo Lang::$word->INV_ADDPAY;?>
    <?php echo Content::invoiceID($this->row->id);?></h5>
</div>
<div class="body">
  <div class="wojo form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo block fields">
        <div class="field">
          <label>
            <?php echo Lang::$word->INV_AMTIN;?>
            <?php echo $this->row->currency;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->INV_AMTIN;?> <?php echo $this->row->currency;?>" name="amount">
        </div>
        <div class="field">
          <div class="wojo fitted toggle checkbox">
            <input type="checkbox" name="full" value="1" id="fullpay">
            <label for="fullpay"><?php echo Lang::$word->INV_PAYFULL;?></label>
          </div>
        </div>
        <div class="basic field">
          <label><?php echo Lang::$word->INV_PAYDATE;?></label>
          <input name="paydate" type="text" value="<?php echo Date::doDate("dd/MM/yyyy", Date::today());?>" readonly class="datepick">
        </div>
      </div>
      <input type="hidden" name="full_amount" value="<?php echo Utility::formatNumber($this->row->balance_due);?>">
    </form>
  </div>
</div>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function () {
    $("input[name=full]").change(function() {
        if ($(this).is(':checked')) {
            $("input[name=amount]").prop('readonly', true).val($("input[name=full_amount]").val());
        } else {
            $("input[name=amount]").prop('readonly', false).val('');
        }
    });
});
// ]]>
</script>