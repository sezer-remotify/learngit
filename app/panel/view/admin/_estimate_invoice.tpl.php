<?php
  /**
   * Estimates Invoice
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _estimate_invoice.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->INV_NEWINV;?></h3>
<div class="wojo small white stacked buttons">
  <a href="<?php echo Url::url("/admin/estimates", "new");?>" class="wojo button"><i class="icon plus alt"></i><?php echo Lang::$word->EST_NEWEST;?></a>
  <a href="<?php echo Url::url("/admin/estimates", "archive");?>" class="wojo button"><?php echo Lang::$word->EST_TITLE1;?></a>
</div>
<form method="post" id="invoiceForm" name="wojo_form">
  <div class="wojo segment spaced form">
    <h6><?php echo Lang::$word->INV_SUB2;?></h6>
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
        <textarea class="small" name="company_address" placeholder="<?php echo Lang::$word->ADDRESS;?>"><?php echo $this->row->company_address;?></textarea>
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
          <option value="<?php echo $ctrow->currency_code . ',' . $ctrow->iso_alpha2;?>"<?php echo ($this->row->currency . ',' . $this->row->country == $ctrow->currency_code . ',' . $ctrow->iso_alpha2) ? ' selected="selected"' : null;?>><?php echo $ctrow->name;?> - <?php echo $ctrow->currency_name;?> (<?php echo $ctrow->currrency_symbol;?>)</option>
          <?php endforeach;?>
        </select>
      </div>
    </div>
    <div class="wojo auto divider"></div>
    <h6><?php echo Lang::$word->INV_SUB3;?></h6>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->INV_INVOICE;?> ID</label>
      </div>
      <div class="field">
        <input placeholder="<?php echo Lang::$word->INV_INVOICE;?> ID" type="text" name="custom_id" value="<?php echo $this->row->id;?>" >
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->INV_ISSUED;?></label>
      </div>
      <div class="field">
        <input name="created" type="text" value="<?php echo Date::doDate("dd/MM/yyyy", $this->row->created);?>" readonly class="datepick">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->INV_DUEON;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <select id="iDueDate" name="due_date" class="fluid">
          <option value="<?php echo Date::today();?>"><?php echo Lang::$word->INV_DUEON0;?></option>
          <option value="<?php echo Date::NumberOfDays('+ 10 day');?>"><?php echo Lang::$word->INV_DUEON1;?></option>
          <option value="<?php echo Date::NumberOfDays('+ 15 day');?>" selected="selected"><?php echo Lang::$word->INV_DUEON2;?></option>
          <option value="<?php echo Date::NumberOfDays('+ 30 day');?>"><?php echo Lang::$word->INV_DUEON3;?></option>
          <option value="<?php echo Date::NumberOfDays('+ 60 day');?>"><?php echo Lang::$word->INV_DUEON4;?></option>
          <option value="5"><?php echo Lang::$word->INV_DUEON5;?></option>
        </select>
      </div>
      <div class="field hide-all" id="cdate">
        <input name="due_date_custom" type="text" value="<?php echo Date::doDate("dd/MM/yyyy", date('Y-m-d'));?>" readonly class="datepick">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->INV_REF;?></label>
      </div>
      <div class="field">
        <input name="reference" type="text" placeholder="<?php echo Lang::$word->INV_REF;?>" value="<?php echo $this->row->title;?>">
      </div>
    </div>
  </div>
  <div class="wojo small form">
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
        <?php $i = 1;?>
        <?php if($this->data):?>
        <?php foreach ($this->data as $row):?>
        <tr id="list<?php echo $i;?>" data-id="<?php echo $row->id;?>">
          <td class="handle"><i class="icon reorder"></i></td>
          <td class="counter"><small class="wojo bold text"><?php echo $i;?>.</small></td>
          <td><div class="wojo small input">
              <input type="text" name="item[]" value="<?php echo $row->description;?>" id="item<?php echo $i;?>">
            </div></td>
          <td><div class="wojo small input">
              <input type="text" name="quantity[]" class="quantity" value="<?php echo $row->quantity;?>" id="quantity<?php echo $i;?>">
            </div></td>
          <?php if($this->taxes):?>
          <td><select name="tax_rate[]" id="tax_rate<?php echo $i;?>" class="mini fluid tax">
              <option value="0"><?php echo Lang::$word->INV_NOTAX;?></option>
              <?php echo Utility::loopOptions($this->taxes, "id", "name", $row->tax_id);?>
            </select></td>
          <?php endif;?>
          <td><div class="wojo small input">
              <input name="price[]" type="text" class="price" value="<?php echo $row->amount;?>" data-id="<?php echo $i;?>">
            </div></td>
          <td><a class="removeItem inverted"><i class="icon delete"></i></a></td>
        </tr>
        <?php $i++;?>
        <?php endforeach;?>
        <?php endif;?>
      </tbody>
    </table>
    <div class="row horizontal gutters align middle">
      <div class="columns screen-80 tablet-60 phone-100">
        <a id="addItem" class="wojo basic wojo semi text black"><i class="icon plus alt"></i><?php echo Lang::$word->INV_ADDITEM;?></a>
      </div>
      <div class="columns screen-20 tablet-40 phone-100">
        <div class="wojo small right input">
          <input name="discount" class="discount" type="text" value="<?php echo $this->row->discount;?>">
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
            <td><span class="subtotal left-padding"><?php echo $this->row->subtotal;?></span></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->DISC;?></td>
            <td><span class="disctotal"><?php echo $this->row->discount;?></span></td>
          </tr>
          <tr>
            <td><?php echo Lang::$word->TAXES;?></td>
            <td><span class="taxtotal"><?php echo $this->row->tax;?></span></td>
          </tr>
          <tr>
            <td class="wojo demi text positive"><?php echo Lang::$word->TOTALAMT;?></td>
            <td class="wojo demi text positive"><span class="total"><?php echo $this->row->total;?></span></td>
          </tr>
        </table>
      </div>
    </div>
    <h6>
      <a id="AddNote" class="wojo simple button"><i class="icon plus alt"></i>
      <?php echo Lang::$word->INV_SUB7;?></a>
    </h6>
    <div id="invNote" class="hide-all">
      <div class="wojo fitted divider"></div>
      <h6><?php echo Lang::$word->NOTE;?></h6>
      <div class="wojo fields align middle">
        <div class="field four wide labeled">
          <label><?php echo Lang::$word->MESSAGE;?></label>
        </div>
        <div class="field">
          <textarea class="small" name="note"><?php echo $this->row->note;?></textarea>
          <p class="wojo small text"><?php echo Lang::$word->INV_INFO_1;?></p>
        </div>
      </div>
    </div>
    <h6>
      <a id="AddComment" class="wojo simple button"><i class="icon plus alt"></i><?php echo Lang::$word->INV_SUB8;?></a>
    </h6>
    <div id="invComment" class="hide-all">
      <div class="wojo fitted divider"></div>
      <h6><?php echo Lang::$word->INV_SUB8_1;?></h6>
      <div class="fields">
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->MESSAGE;?></label>
          </div>
          <div class="field">
            <textarea class="small" name="comment"></textarea>
            <p class="wojo small text"><?php echo Lang::$word->INV_INFO_1;?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="full padding center aligned">
    <a href="<?php echo Url::url("/admin/estimates");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processInvoice" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->INV_CREATE;?></button>
  </div>
  <input type="hidden" name="total_amount" value="<?php echo $this->row->total;?>">
  <input type="hidden" name="subtotal" value="<?php echo $this->row->subtotal;?>">
  <input type="hidden" name="taxes" value="<?php echo $this->row->tax;?>">
  <input type="hidden" name="eid" value="<?php echo $this->row->id;?>">
  <input type="hidden" name="is_estimate" value="1">
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