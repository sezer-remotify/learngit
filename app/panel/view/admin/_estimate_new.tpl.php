<?php
  /**
   * Estimates New
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _estimate_new.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->EST_TITLE4;?></h3>
<div class="wojo small white stacked buttons">
  <a href="<?php echo Url::url("/admin/estimates", "archive");?>" class="wojo button"><?php echo Lang::$word->EST_TITLE1;?></a>
</div>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment spaced form">
    <h6><?php echo Lang::$word->INV_SUB3;?></h6>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->EST_NAME;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input name="title" type="text" placeholder="<?php echo Lang::$word->EST_NAME;?>">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->INV_CLCMP;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <select name="company_id">
          <option value="">--- <?php echo Lang::$word->CMP_SELECT;?> ---</option>
          <?php echo $this->companies;?>
        </select>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->ADDRESS;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <div class="wojo fluid input">
          <textarea class="small" name="company_address" placeholder="<?php echo Lang::$word->ADDRESS;?>"></textarea>
        </div>
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CFG_SCURRENCY_S;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <select class="selectbox" name="currency" data-wselect='{"search":true,"placeholder":"<?php echo Lang::$word->CFG_SCURRENCY_S;?>"}'>
          <?php foreach($this->countries as $ctrow):?>
          <option value="<?php echo $ctrow->currency_code . ',' . $ctrow->iso_alpha2;?>"><?php echo $ctrow->name;?> - <?php echo $ctrow->currency_name;?> (<?php echo $ctrow->currrency_symbol;?>)</option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
  </div>
  <div class="wojo small fitted segment form">
    <div class="header">
      <h4>
        <?php echo Lang::$word->EST_SUB2;?>
      </h4>
    </div>
    <div class="content">
      <table class="wojo small segment responsive table invoice">
        <thead>
          <tr>
            <th class="auto"></th>
            <th class="auto">#</th>
            <th><?php echo Lang::$word->PRJ_DESC;?></th>
            <th class="two wide"><?php echo Lang::$word->INV_QTY;?></th>
            <?php if($this->taxes):?>
            <th class="two wide"><?php echo Lang::$word->INV_TAXRATE;?></th>
            <?php endif;?>
            <th class="two wide"><?php echo Lang::$word->INV_ITEMCST;?></th>
            <th class="auto"></th>
          </tr>
        </thead>
        <tbody id="ivTable">
          <tr id="item1" data-id="1">
            <td class="handle"><i class="icon reorder"></i></td>
            <td><small class="wojo bold text">1.</small></td>
            <td><div class="wojo small input">
                <input type="text" name="item[]" id="item1">
              </div></td>
            <td><div class="wojo small input">
                <input type="text" name="quantity[]" class="quantity" id="quantity1" value="1.00">
              </div></td>
            <?php if($this->taxes):?>
            <td><select name="tax_rate[]" id="tax_rate1" class="tax">
                <option value="0" selected="selected"><?php echo Lang::$word->INV_NOTAX;?></option>
                <?php foreach($this->taxes as $tax):?>
                <option value="<?php echo $tax->id;?>"><?php echo $tax->name;?>
                <?php echo $tax->amount;?>%</option>
                <?php endforeach;?>
              </select></td>
            <?php endif;?>
            <td><div class="wojo small input">
                <input name="price[]" type="text" class="price" data-id="1">
              </div></td>
            <td><a class="removeItem grey"><i class="icon delete"></i></a></td>
          </tr>
          <tr id="item2" data-id="2">
            <td class="handle"><i class="icon reorder"></i></td>
            <td><small class="wojo bold text">2.</small></td>
            <td><div class="wojo small input">
                <input type="text" name="item[]" id="item2">
              </div></td>
            <td><div class="wojo simple small input">
                <input type="text" name="quantity[]" id="quantity2" class="quantity" value="1.00">
              </div></td>
            <?php if($this->taxes):?>
            <td><select name="tax_rate[]" id="tax_rate2" class="tax">
                <option value="0" selected="selected"><?php echo Lang::$word->INV_NOTAX;?></option>
                <?php foreach($this->taxes as $tax):?>
                <option value="<?php echo $tax->id;?>"><?php echo $tax->name;?>
                <?php echo $tax->amount;?>%</option>
                <?php endforeach;?>
              </select></td>
            <?php endif;?>
            <td><div class="wojo small input">
                <input name="price[]" type="text" class="price" data-id="2">
              </div></td>
            <td><a class="removeItem grey"><i class="icon delete"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row horizontal gutters align middle">
    <div class="columns screen-80 tablet-60 phone-100">
      <a id="addItem" class="wojo simple button"><i class="icon plus alt"></i><?php echo Lang::$word->INV_ADDITEM;?></a>
    </div>
    <div class="columns screen-20 tablet-40 phone-100">
      <div class="wojo small right input">
        <input name="discount" class="discount" type="text" value="0.00">
        <div class="wojo simple label">
          <?php echo Lang::$word->DISC;?> % </div>
      </div>
    </div>
  </div>
  <div class="flex align end">
    <div class="vertical margin">
      <table class="wojo basic collapsing table">
        <tr>
          <td><?php echo Lang::$word->SUBTOTAL;?></td>
          <td><span class="subtotal">0.00</span></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->DISC;?></td>
          <td><span class="disctotal">0.00</span></td>
        </tr>
        <tr>
          <td><?php echo Lang::$word->TAXES;?></td>
          <td><span class="taxtotal">0.00</span></td>
        </tr>
        <tr>
          <td class="wojo demi text positive"><?php echo Lang::$word->TOTALAMT;?></td>
          <td class="wojo demi text positive"><span class="total">0.00</span></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="wojo small form">
    <h6>
      <a id="AddNote" class="wojo simple button"><i class="icon plus alt"></i>
      <?php echo Lang::$word->INV_SUB7;?></a>
    </h6>
    <div id="invNote" class="hide-all">
      <div class="wojo divider"></div>
      <h6><?php echo Lang::$word->NOTE;?></h6>
      <div class="wojo fields align middle">
        <div class="field four wide labeled">
          <label><?php echo Lang::$word->MESSAGE;?></label>
        </div>
        <div class="field">
          <textarea class="small" name="note"></textarea>
          <p class="wojo small text"><?php echo Lang::$word->INV_INFO_2;?></p>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="total_amount" value="0.00">
  <input type="hidden" name="subtotal" value="0.00">
  <input type="hidden" name="taxes" value="0.00">
  <div class="full padding center aligned">
    <a href="<?php echo Url::url("/admin/estimates");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processEstimate" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->EST_CREATE;?></button>
  </div>
</form>
<script src="<?php echo ADMINVIEW;?>/js/invoice.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $.Invoice({
        tax_rates: <?php echo json_encode($this->taxes ? $this->taxes : array());?>,
		url: "<?php echo ADMINVIEW;?>",
		taxes: {},
        lang: {
            add_error: "<?php echo Lang::$word->INV_ITMERROR;?>",
            add_errort: "<?php echo Lang::$word->ERROR;?>",
			no_tax: "<?php echo Lang::$word->INV_NOTAX;?>",
			no_items: "<?php echo Lang::$word->INV_NOITEMS;?>",
			ialert: "<?php echo Lang::$word->ALERT;?>",
        }
    });
});
// ]]>
</script>